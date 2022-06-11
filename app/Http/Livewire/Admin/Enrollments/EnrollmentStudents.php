<?php

namespace App\Http\Livewire\Admin\Enrollments;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Enrollment;
use App\Models\EnrollmentStudent;
use App\Models\Student;
use App\Models\Program;
use App\Models\CombinedIntake;
use Arr;

class EnrollmentStudents extends AdminComponent
{

    public $page_title = "Enrollment Student";  
    public $enrollment_id, $enrollment_details, $enrollment_students, $last_update_student_id;
    public $studentSearch;
    public $sortField = "";
    
    public function render()
    {
        $records = $this->index();
        
        return view('livewire.admin.enrollments.enrollment-student.enrollment-student-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new EnrollmentStudent;
        $this->enrollment_details = Enrollment::findOrFail( $this->enrollment_id);
    }

    public function index()
    {
      
        $query = $this->model->with([])->where('enrollment_id', $this->enrollment_id);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        return $records;
    }
    
    public function students()
    {
        if(!empty($this->studentSearch)) {
            $query =Student::with([])->whereNotIn('id',$this->enrollment_students->values())->orderBy("title");
            $query = $this->applyStudentSearchFilter($query);
            $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'), ['*'], 'student');
            return $records;
        }
        return []; 
    }

    public function studentSearch()
    {
       $this->students();
    }

    public function applyStudentSearchFilter($query) 
    {
        // $conditions['equalto']['program_id'] = Arr::get($this->studentSearch, 'program_id');
        // $conditions['equalto']['combined_intake_id'] = Arr::get($this->studentSearch, 'combined_intake_id');
        $conditions['like']['code'] = Arr::get($this->studentSearch, 'code');
        $conditions['like']['title'] = Arr::get($this->studentSearch, 'title');
        return  __reportConditions($query, $conditions);
    }

    public function applySearchFilter($query) 
    {
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function storeStudent($student_id)
    {
        unset($this->fdata['student_id']);
        $this->fdata['student_id'][$student_id] = $student_id;
        
        $rule_set = $this->validation_rules($student_id);

        
        
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
       
        $student_id = $validatedData['fdata']['student_id'][$student_id];
    
        $last_update_student = $this->model->updateOrCreate(['enrollment_id' => $this->enrollment_id ,'student_id' => $student_id], ['student_id' => $student_id]);
        $this->last_update_student_id[$last_update_student->student_id] = $last_update_student->id;
        
        //$this->alertMessage();
    }

    public function validation_rules($student_id)
    {
        $rules = [
            'fdata.student_id.*' => ['required', "unique:". $this->model->getTable() .",student_id,NULL,NULL,enrollment_id,".$this->enrollment_id.",deleted_at,NULL"], 
            
        ];
        
        $attributes = __getAttributesFromNested($rules);

        $messages = [
            'fdata.student_id.*.unique' => 'Student was already taken',
        ];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }
    
    public function customCreate()
    {
        $this->fdata['active'] = 1;
        
        $this->enrollment_students = EnrollmentStudent::query()->tobase()->where('enrollment_id', $this->enrollment_id)->pluck('student_id', 'id');    
        foreach ( $this->enrollment_students as $enrollment_student_id => $id ) {
            $this->fdata['student'][$enrollment_student_id]['id'] = $id;
        }
        unset( $this->last_update_student_id );
    }

    public function customEdit()
    {
        
    }     
    
    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->alert('success',__('msg.delete',["name" => $this->page_title]));
    }

    public function getSearchProgramListProperty()
    {
        return Program::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchCombinedIntakeListProperty()
    {
        return CombinedIntake::query()->tobase()->pluck('title', 'id');
    }

    public function updated($name, $value)
    {
        
    }    

}
