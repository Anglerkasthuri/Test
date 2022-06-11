<?php

namespace App\Http\Livewire\Admin\Enrollments;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Enrollment;
use App\Models\EnrollmentCourse;
use App\Models\Course;
use App\Models\Campus;
use App\Models\ProgramCategory;
use Arr;

class EnrollmentCourses extends AdminComponent
{

    public $page_title = "Enrollment Course";  
    public $enrollment_id, $enrollment_details, $enrollment_courses, $last_update_course_id;
    public $courseSearch;
    public $sortField = "";
    
    public function render()
    {
        $records = $this->index();
        
        return view('livewire.admin.enrollments.enrollment-course.enrollment-course-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new EnrollmentCourse;
        $this->enrollment_details = Enrollment::findOrFail( $this->enrollment_id);
    }

    public function index()
    {
      
        $query = $this->model->with(["enrollment_component_groups", "enrollment_component_groups.enrollment_component_types"])->where('enrollment_id', $this->enrollment_id);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        return $records;
    }
    
    public function courses()
    {
        if(!empty($this->courseSearch)) {
            $query = Course::with([]);
            $query = $this->applyCourseSearchFilter($query);
            $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'), ['*'], 'course');
            return $records;
        }
        return []; 
    }

    public function courseSearch()
    {
       $this->courses();
    }

    public function applyCourseSearchFilter($query) 
    {
        $conditions['equalto']['campus_id'] = Arr::get($this->courseSearch, 'campus_id');
        $conditions['equalto']['program_category_id'] = Arr::get($this->courseSearch, 'program_category_id');
        $conditions['like']['code'] = Arr::get($this->courseSearch, 'code');
        $conditions['like']['title'] = Arr::get($this->courseSearch, 'title');
        return  __reportConditions($query, $conditions);
    }

    public function applySearchFilter($query) 
    {
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function storeCourse($course_id)
    {
        
        $rule_set = $this->validation_rules($course_id);
       
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
    
        $validatedData = $validatedData['fdata']['course'][$course_id];

        $last_update_course = $this->model->updateOrCreate(['enrollment_id' => $this->enrollment_id ,'course_id' => $course_id], $validatedData);
        $this->last_update_course_id[$last_update_course->course_id] = $last_update_course->id;

        //$this->alertMessage();
    }

    public function validation_rules($course_id)
    {
        $rules = [
            "fdata.course.{$course_id}.credited_hours" => ['required', "numeric", "min:0", "max:100"],
        ];
        
        $attributes = __getAttributesFromNested($rules);

        $messages = [];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }
    
    public function customCreate()
    {
        $this->fdata['active'] = 1;
        
        $this->enrollment_courses = EnrollmentCourse::query()->tobase()->where('enrollment_id', $this->enrollment_id)->pluck('credited_hours', 'course_id');    
        foreach ( $this->enrollment_courses as $enrollment_course_id => $credited_hours ) {
            $this->fdata['course'][$enrollment_course_id]['credited_hours'] = $credited_hours;
        }
        unset( $this->last_update_course_id );
    }

    public function customEdit()
    {
        
    }     
    
    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->alert('success',__('msg.delete',["name" => $this->page_title]));
    }

    public function getSearchCampusListProperty()
    {
        return Campus::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchProgramCategoryListProperty()
    {
        return ProgramCategory::query()->tobase()->pluck('title', 'id');
    }

    public function updated($name, $value)
    {
        
    }    

}
