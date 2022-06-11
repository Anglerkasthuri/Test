<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\ExamPattern;
use App\Models\Campus;
use App\Models\AcademicComponentType;
use App\Models\AcademicComponentGroup;
use App\Models\ExamPatternComponentGroup;
use App\Models\ExamPatternComponentType;
use Arr;

class ExamPatterns extends AdminComponent
{

    public $page_title = "Exam Pattern";  
    public $exam_pattern_id;  
    public $campus_id;  
    public $setting_data;
    public $academic_component_type_modal;
    public $academic_component_type;
    public $academic_component_group_modal;
    
    public function render()
    {
        if($this->exam_pattern_id) {
            $record = $this->settings();
            return view('livewire.admin.masters.exam-pattern.exam-pattern-view', compact('record'));
        } else {
            $records = $this->index();
            return view('livewire.admin.masters.exam-pattern.exam-pattern-list', compact('records'));
        }
        
    }

    public function mount()
    {
        $this->model = new ExamPattern;
        if( !empty( $this->exam_pattern_id ) ) {
            $record = $this->model->findOrFail($this->exam_pattern_id);     
            $this->campus_id = $record['campus_id'] ?? null;     
            $this->fdata['group'] = [];
            $this->setting_data['group']['count'] = 0;

            $ExamPatternComponentGroup = ExamPatternComponentGroup::with(['exam_pattern_component_types'])->where('exam_pattern_id',$this->exam_pattern_id)->get()->toArray();
            foreach( $ExamPatternComponentGroup as $group) {
                $this->fdata['group'][$group['academic_component_group_id']] =   [ 
                                                            'id' => $group['id'],
                                                            'key' => $group['academic_component_group_id'],
                                                            'contribution' => $group['contribution_percentage']
                                                        ];
                $this->setGroup($group['academic_component_group_id']);
            
                foreach( $group['exam_pattern_component_types'] as $type) {

                    $this->fdata['group'][$group['academic_component_group_id']]['type'][$type['academic_component_type_id']] = [
                        'id' => $type['id'],
                        'key' => $type['academic_component_type_id'],
                        'mark' => $type['maximum_mark'],
                        'show' => true,
                    ];
                }
            }
        }
       
    }

    public function index()
    {
        $query = $this->model->with([]);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        return $records;
    }

    public function settings()
    {
        if(count($this->getErrorBag()->all()) > 0) {
            $this->alert("warning",  __('msg.validation_error'));
        }
        $record = $this->model->findOrFail($this->exam_pattern_id);     
        $this->campus_id = $record['campus_id'] ?? null;     
        return $record;
    }
    
    public function setGroup($academic_component_group_id)
    {
        if( !empty( $this->fdata['group'][$academic_component_group_id]['key'] ) ) {
            $this->setting_data['group']['count']++;
            $this->fdata['group'][$academic_component_group_id]['sequence'] = $this->setting_data['group']['count'];
            $this->academic_component_type[$academic_component_group_id] = AcademicComponentType::with(['academic_component_category'])->where(['academic_component_group_id' => $academic_component_group_id, 'campus_id'=> $this->campus_id])->orderBy('sequence_number')->get()->toArray();
            $this->emit("focus-input-name","fdata.group.".$academic_component_group_id.".contribution");
        } else {
            if(!empty($this->fdata['group'][$academic_component_group_id]['id'])) {
                $this->deleteGroup($this->fdata['group'][$academic_component_group_id]['id']);
            } 
            unset($this->fdata['group'][$academic_component_group_id]);             
        }
        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setGroupType($academic_component_type_id,$academic_component_group_id)
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

    public function applySearchFilter($query) 
    {
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }
    
    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.campus_id' => ['nullable'],
            'fdata.active' => ['nullable'],
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Exam Pattern';

        $messages = [];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function setting_store()
    {
        $rule_set = $this->setting_validation_rules();

        $this->fdata['overall_contribution'] = collect(data_get($this->fdata, 'group.*.contribution'))->sum();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata']; 
        
        foreach($validatedData['group'] as $group_id => $group) {
            $group_data = [ 
                "exam_pattern_id" => $this->exam_pattern_id,
                "academic_component_group_id" => $group_id,
                "contribution_percentage"=> $group['contribution']
            ];
            $current_group = ExamPatternComponentGroup::updateOrCreate([ "exam_pattern_id" => $this->exam_pattern_id, "academic_component_group_id" => $group_id ], $group_data);
            if( !empty( $group['type'] )) {
                foreach($group['type'] as $type_id => $type) {
                    $type_data = [ 
                        "exam_pattern_component_group_id" => $current_group->id,
                        "academic_component_type_id" => $type_id,
                        "maximum_mark"=> $type['mark']
                    ];
                    $current_type = ExamPatternComponentType::updateOrCreate([ "exam_pattern_component_group_id" => $current_group->id, "academic_component_type_id" => $type_id], $type_data );
                }
            }
            
        }
        $this->alertMessage();
    }
    
    public function setting_validation_rules()
    {
        $rules = [
            'fdata.group.*.type.*.mark' => ['required', 'numeric', 'max:100'],
            'fdata.group.*.contribution' => ['required', 'numeric', 'max:100'],
            "fdata.group.*.type" => ["required", "array", "min:1"],
            
            "fdata.overall_contribution" => ["required", 'numeric', "min:100", 'max:100'],
            
            'fdata.active' => ['nullable'],
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
        $this->fdata['active'] = 1;
    }

    public function customEdit()
    {
        
    }     
    
    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }
    public function deleteGroup($id)
    {
        //ExamPatternComponentGroup::where('id', $id)->delete();
        //ExamPatternComponentType::where('exam_pattern_component_group_id', $id)->delete();
    }
    public function deleteGroupType($id)
    {
        //ExamPatternComponentType::where('id', $id)->delete();
    }

    public function getCampusListProperty()
    {
        return Campus::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getAcademicComponentGroupModalProperty()
    {
        return AcademicComponentGroup::has('academic_component_types', '>', 0)
        ->whereHas('academic_component_types', function ($query) {
            $query->where('campus_id', '=', $this->campus_id);
        })
        ->orderBy('sequence_number')->get()->pluck('title','id');
    }
}
