<?php

namespace App\Http\Livewire\Admin\Enrollments;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Enrollment;
use App\Models\StudentMark;
use App\Models\EnrollmentCourse;
use App\Models\EnrollmentComponentType;
//use App\Models\MasterOption;
use App\Models\StudentMarkDetail;
use App\Models\StudentGroupWiseMark;
use App\Traits\StudentMarkGroupable;

use Arr;

class EnrollmentMarks extends AdminComponent
{
    use StudentMarkGroupable;

    public $page_title = "Enrollment Mark";  
    public $enrollment_id, $enrollment_details, $enrollment_course_id, $enrollment_course_details, $enrollment_students, $student_mark_id, $component_type_details;
    public $studentSearch;
    public $sortField = "";
    
    public function render()
    {
        // $EnrollmentMark = StudentMark::where( ["enrollment_component_type_id" => 12]);
        if(count($this->getErrorBag()->all()) > 0) {
            $this->alert("warning",  __('msg.validation_error'));
        }
        $records = $this->index();
        return view('livewire.admin.enrollments.enrollment-mark.enrollment-mark-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new EnrollmentCourse;

        $this->enrollment_course_details = EnrollmentCourse::find( $this->enrollment_course_id );
        $this->enrollment_id = $this->enrollment_course_details->enrollment_id;
        //$this->fdata['exam_pattern_id'] = $this->enrollment_course_details->exam_pattern_id;
        $this->enrollment_details = Enrollment::find( $this->enrollment_id );
        $this->enrollment_students = $this->enrollment_details->enrollment_students()->with(['student'])->get()->toArray();
    }

    public function index()
    {
        $query = $this->model->with([]);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        return $records;
    }

    public function applyStudentSearchFilter($query) 
    {
        // $conditions['equalto']['program_id'] = Arr::get($this->studentSearch, 'program_id');
        // $conditions['equalto']['combined_intake_id'] = Arr::get($this->studentSearch, 'combined_intake_id');
        $conditions['like']['code'] = Arr::get($this->studentSearch, 'code');
        $conditions['like']['name'] = Arr::get($this->studentSearch, 'title');
        return  __reportConditions($query, $conditions);
    }

    public function applySearchFilter($query) 
    {
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function getStudents()
    {   
        $rule_set = $this->student_validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']); 
        $studentMarkData = $validatedData['fdata'];
        //$studentMarkData = [ "exam_date" => $validatedData["exam_date"] , "enrollment_component_type_id" =>  $validatedData["component_type_id"]];
        $EnrollmentMark = StudentMark::where(['enrollment_component_type_id' => $studentMarkData['component_type_id'] ?? ''], $studentMarkData)->first();
         
        $this->student_mark_id = $EnrollmentMark['id'] ??  null;
        foreach ($this->enrollment_students as $student) {
            $student_id = $student['student_id'];
            $studentMark = StudentMarkDetail::where( ["student_mark_id" => $this->student_mark_id, "student_id" => $student_id ])->first();
            $sendData = [
                        "student_mark_detail_id"  =>  $studentMark['id'] ?? null,
                        "mark"  =>  $studentMark['mark'] ?? null,
                        "individual_exam_date"  =>  $studentMark['individual_exam_date'] ?? null,
                        "is_absent"  =>  $studentMark['is_absent'] ?? null,                        
                    ];
            
            if(!empty($studentMark['is_absent'])) {
                $sendData['key'] = 1;
                $sendData['show'] = false;
            } else {
                $sendData['key'] = 0;
                $sendData['show'] = true;
            }

            if(!empty($sendData)) {
                $this->fdata['student'][ $student_id] = $sendData;
            }

            if( empty( $this->fdata['student'][$student_id]['key'] ) ) {
                $this->fdata['student'][$student_id]['show'] = true;
            } else {
                $this->fdata['student'][$student_id]['show'] = false;
                
            }
            
        }
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setStudentMarkShow($student_id)
    {
        $this->fdata['student'][$student_id]['key'] = 0; 
        $this->fdata['student'][$student_id]['show'] = true;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setStudentMarkHide($student_id)
    {
        $this->fdata['student'][$student_id]['key'] = 1; 
        $this->fdata['student'][$student_id]['show'] = false;
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function customCreate()
    {
  
    }

    public function customEdit()
    {
        
    }   
   
    public function storeMark()
    {
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];
        $studentMarkData = [ 
            "exam_date" => $validatedData["exam_date"],
            "enrollment_component_type_id" =>  $validatedData["component_type_id"],
            "enrollment_course_id" => $this->enrollment_course_id
        ];
        $StudentMark = StudentMark::updateOrCreate(['id' => $this->student_mark_id ?? ''], $studentMarkData);

        foreach ( $validatedData['student'] as $student_id => $student ) {

            $mark = $student["mark"] ?? null;
            $studentMarkDetailData =  [
                                        "student_mark_id " => $StudentMark["id"],
                                        "student_id" => $student_id,
                                        "is_absent" => $student["key"] ?? 0 ,
                                        "individual_exam_date" => $student["individual_exam_date"] ?? null,
                                        "mark" => $mark
                                    ];
                $StudentMarkDetail = StudentMarkDetail::where(['student_id' => $student_id , 'student_mark_id' => $StudentMark["id"]])->get()->toArray();
           
                if(!empty($StudentMarkDetail) || !empty($mark) || !empty($student["key"])) {
                    StudentMarkDetail::updateOrCreate(['student_id' => $student_id, 'student_mark_id' => $StudentMark["id"]],  $studentMarkDetailData);
                }
        }
        $this->setConvertedMark($this->enrollment_course_id);
        
        $this->getStudents();
        $this->alertMessage();
    }   

    public function validation_rules()
    {
        $rules = [
            'fdata.component_type_id' => ['required'],
            'fdata.exam_date' => ['required'],

            'fdata.student.*.key' => ['nullable'],
            'fdata.student.*.mark' => ['nullable', 'numeric', "max:{$this->component_type_details->maximum_mark}"],
            'fdata.student.*.individual_exam_date' => ['nullable', 'date'],
        ];
        
        $attributes = __getAttributesFromNested($rules);

        $messages = [ ];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    
    public function student_validation_rules()
    {
        $rules = [
            'fdata.exam_date' => ['nullable'],
            'fdata.component_type_id' => ['required'],
        ];
        
        $attributes = __getAttributesFromNested($rules);

        $messages = [ ];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->alert('success',__('msg.delete',["name" => $this->page_title]));
    }

    public function deleteMark($id)
    {
        StudentMarkDetail::where('id', $id)->delete();
        $this->getStudents();
        $this->alert('success',__('msg.delete',["name" => $this->page_title]));
    }

    public function getEnrollmentComponentTypeListProperty()
    {
        $enrollment_course_id = $this->enrollment_course_id;

        return EnrollmentComponentType::with(['academic_component_type'])
                                        ->whereHas('enrollment_component_group', function ($query) use ($enrollment_course_id)                            {
                                            $query->where('enrollment_course_id', '=', $this->enrollment_course_id);
                                        })
                                        ->get()
                                        ->sortBy("academic_component_type.title")
                                        ->pluck('academic_component_type.title', 'id');
    }

    public function updated($name, $value)
    {
        if($name === "fdata.component_type_id") {
            $StudentMark = StudentMark::where(['enrollment_component_type_id' => $value ])->first();
            $this->fdata['exam_date'] = $StudentMark['exam_date'] ?? null;
            $this->component_type_details = EnrollmentComponentType::find($value);
            $this->getStudents();
        }        
    }
}
