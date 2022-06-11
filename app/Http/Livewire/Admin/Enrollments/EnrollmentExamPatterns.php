<?php

namespace App\Http\Livewire\Admin\Enrollments;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Enrollment;
use App\Models\EnrollmentCourse;
use App\Models\EnrollmentComponentGroup;
use App\Models\EnrollmentComponentType;
use App\Models\ExamPattern;
use App\Models\ExamPatternComponentGroup;
use App\Models\ExamPatternComponentType;
use App\Models\AcademicComponentGroup;
use App\Models\AcademicComponentType;

use Arr;

class EnrollmentExamPatterns extends AdminComponent
{

    public $page_title = "Enrollment Exam Pattern";  
    public $enrollment_course_id, $enrollment_course_details, $enrollment_id, $enrollment_details;
    public $exam_pattern_id, $exam_pattern_details, $campus_id, $setting_data, $academic_component_type_modal, $academic_component_type, $academic_component_group_modal;
    public $studentSearch;
    public $sortField = "";
    
    public function render()
    {    
        if(count($this->getErrorBag()->all()) > 0) {
            $this->alert("warning",  __('msg.validation_error'));
        }
        return view('livewire.admin.enrollments.enrollment-exam-pattern.enrollment-exam-pattern-list');
    }

    public function mount()
    {
        $this->model = new EnrollmentCourse;
        $this->enrollment_course_details = EnrollmentCourse::findOrFail( $this->enrollment_course_id );
        $this->enrollment_id = $this->enrollment_course_details->enrollment_id;
        $this->fdata['exam_pattern_id'] = $this->enrollment_course_details->exam_pattern_id;
        $this->enrollment_details = Enrollment::findOrFail( $this->enrollment_id );
        $this->getEnrollmentExamPattern(); 
    }

    public function getExamPattern()
    {
        if(!empty($this->fdata['exam_pattern_id'])) {

            $this->exam_pattern_id = $this->fdata['exam_pattern_id'];

            $this->exam_pattern_details = ExamPattern::findOrFail($this->exam_pattern_id);     
            $this->campus_id = $this->exam_pattern_details->campus_id ?? null;     
            $this->fdata['group'] = [];
            $this->setting_data['group']['count'] = 0;

            $ExamPatternComponentGroup = ExamPatternComponentGroup::with(['exam_pattern_component_types'])->where('exam_pattern_id',$this->exam_pattern_id)->get()->toArray();
            
            foreach( $ExamPatternComponentGroup as $group) {
                $this->fdata['group'][$group['academic_component_group_id']] =   [ 
                                                            'id' => $group['id'],
                                                            'key' => $group['academic_component_group_id'],
                                                            'contribution' => $group['contribution_percentage']
                                                        ];
                $this->setExamPatternGroup($group['academic_component_group_id']);
            
                foreach( $group['exam_pattern_component_types'] as $type) {

                    $this->fdata['group'][$group['academic_component_group_id']]['type'][$type['academic_component_type_id']] = [
                        'key' => $type['academic_component_type_id'],
                        'mark' => $type['maximum_mark'],
                        'show' => true,
                    ];
                }
            }
        } else {
            $this->alert("warning", "Please Select Enrollment");
        }
    }


    public function getEnrollmentExamPattern()
    {

        $this->campus_id = $this->enrollment_course_details->course->campus_id ?? null;     
        $this->fdata['group'] = [];
        $this->setting_data['group']['count'] = 0;

        $EnrollmentComponentGroup = EnrollmentComponentGroup::with(['enrollment_component_types'])->where('enrollment_course_id',$this->enrollment_course_id)->get()->toArray();
        
        foreach( $EnrollmentComponentGroup as $group) {
            $this->fdata['group'][$group['academic_component_group_id']] =   [ 
                                                        'id' => $group['id'],
                                                        'key' => $group['academic_component_group_id'],
                                                        'contribution' => $group['contribution_percentage']
                                                    ];
            $this->setExamPatternGroup($group['academic_component_group_id']);
        
            foreach( $group['enrollment_component_types'] as $type) {

                $this->fdata['group'][$group['academic_component_group_id']]['type'][$type['academic_component_type_id']] = [
                    'id' => $type['id'],
                    'key' => $type['academic_component_type_id'],
                    'mark' => $type['maximum_mark'],
                    'show' => true,
                ];
            }
        }
     
    }

    public function setExamPatternGroup($academic_component_group_id)
    {
        if( !empty( $this->fdata['group'][$academic_component_group_id]['key'] ) ) {
            //dd( $this->fdata['group']);
            $this->setting_data['group']['count']++;
            $this->fdata['group'][$academic_component_group_id]['sequence'] = $this->setting_data['group']['count'];
            $this->academic_component_type[$academic_component_group_id] = AcademicComponentType::with(['academic_component_category'])->where(['academic_component_group_id' => $academic_component_group_id, 'campus_id'=> $this->campus_id])->orderBy('sequence_number')->get()->toArray();
            $this->emit("focus-input-name","fdata.group.".$academic_component_group_id.".contribution");
        } else {
            if(!empty($this->fdata['group'][$academic_component_group_id]['id'])) {
                //dd("hai");
                $this->deleteGroup($this->fdata['group'][$academic_component_group_id]['id']);
            } 
            unset($this->fdata['group'][$academic_component_group_id]);             
        }
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setExamPatternGroupType($academic_component_type_id,$academic_component_group_id)
    {
        if( !empty( $this->fdata['group'][$academic_component_group_id]['type'][$academic_component_type_id]['key'] ) ) {
            $this->fdata['group'][$academic_component_group_id]['type'][$academic_component_type_id]['show'] = true;
            $this->emit("focus-input-name","fdata.group.".$academic_component_group_id.".type.".$academic_component_type_id.".mark");
        } else {
            $this->fdata['group'][$academic_component_group_id]['type'][$academic_component_type_id]['show'] = false;
            if(!empty($this->fdata['group'][$academic_component_group_id]['type'][$academic_component_type_id]['id'])) {
                $this->deleteGroupType($this->fdata['group'][$academic_component_group_id]['type'][$academic_component_type_id]['id']);
            }
            unset($this->fdata['group'][$academic_component_group_id]['type'][$academic_component_type_id]);
        }
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setting_store()
    {
        $rule_set = $this->setting_validation_rules();

        $this->fdata['overall_contribution'] = collect(data_get($this->fdata, 'group.*.contribution'))->sum();
        //dd( $this->fdata['overall_contribution']);
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata']; 
        
        foreach($validatedData['group'] as $group_id => $group) {
            $group_data = [ 
                "enrollment_course_id" => $this->enrollment_course_id,
                "academic_component_group_id" => $group_id,
                "contribution_percentage"=> $group['contribution']
            ];
            $current_group = EnrollmentComponentGroup::updateOrCreate([ "enrollment_course_id" => $this->enrollment_course_id, "academic_component_group_id" => $group_id ], $group_data);
            if( !empty( $group['type'] )) {
                foreach($group['type'] as $type_id => $type) {
                    $type_data = [ 
                        "enrollment_component_group_id" => $current_group->id,
                        "academic_component_type_id" => $type_id,
                        "maximum_mark"=> $type['mark']
                    ];
                    $current_type = EnrollmentComponentType::updateOrCreate([ "enrollment_component_group_id" => $current_group->id, "academic_component_type_id" => $type_id], $type_data );
                }
            }
        }
        if( !empty( $validatedData['exam_pattern_id']) ) {
            $this->model->updateOrCreate(['id' => $this->enrollment_course_id], ["exam_pattern_id" => $validatedData['exam_pattern_id']]);
        }
        $this->alertMessage();
    }
    
    public function setting_validation_rules()
    {
        $rules = [
            'fdata.exam_pattern_id' => ['nullable'],
            
            'fdata.group.*.contribution' => ['required', 'numeric', 'max:100'],
            
            "fdata.group.*.type" => ["required", "array", "min:1"],
            'fdata.group.*.type.*.mark' => ['required', 'numeric', 'max:100'],
            
            "fdata.overall_contribution" => ["required", 'numeric', "min:100", 'max:100'], // Custom Field Validation 
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Exam Pattern';

        $messages = [
             'fdata.group.*.type.required' => 'Select at least one from type',
        ];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function customCreate()
    {
      
    }

    public function customEdit()
    {
        
    }     
    
    public function delete($id)
    {
        $this->model->where('id', $id)->delete();
        $this->alert('success',__('msg.delete',["name" => $this->page_title]));
    }
    
    public function deleteGroup($id)
    {
        EnrollmentComponentGroup::where('id', $id)->delete();
        EnrollmentComponentType::where('enrollment_component_group_id', $id)->delete();
    }

    public function deleteGroupType($id)
    {
        EnrollmentComponentType::where('id', $id)->delete();
    }
    
    public function updated($name, $value)
    {
        
    }    

    public function getExamPatternListProperty()
    {
        return ExamPattern::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getAcademicComponentGroupModalProperty()
    {
        return AcademicComponentGroup::has('academic_component_types', '>', 0)
        ->whereHas('academic_component_types', function ($query) {
            $query->where('campus_id', '=', $this->campus_id);
        })
        ->orderBy('title')->get()->pluck('title','id');
    }

}
