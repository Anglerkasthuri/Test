<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Traits\Sequenceable;

use App\Models\AcademicComponentType;
use App\Models\Campus;
use App\Models\AcademicComponentGroup;
use App\Models\AcademicComponentCategory;

use Arr;

class AcademicComponentTypes extends AdminComponent
{
    use Sequenceable;

    public $page_title = "Academic Component Type";

    // Sequenceable
    public $max_sequence_number;
    public $sortField = "sequence_number", $sortDirection = "DESC", $sortFieldData = [];

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.academic-component-type.academic-component-type-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new AcademicComponentType;
    }

    public function index()
    {
        $query = $this->model->with([]);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        
        return $records;
    }
    
    public function applySearchFilter($query) 
    {
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['equalto']['campus_id'] = Arr::get($this->search, 'campus_id');
        $conditions['equalto']['academic_component_group_id'] = Arr::get($this->search, 'academic_component_group_id');
        $conditions['equalto']['academic_component_category_id'] = Arr::get($this->search, 'academic_component_category_id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function store($next='')
    {
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];

        // Sequenceable
        $conditions = [];
        if(!empty($this->fdata['academic_component_group_id'])) {
            $conditions['equalto']['academic_component_group_id'] = $this->fdata['academic_component_group_id'];
        }
        $old_sequence = $this->max_sequence_number;
        if($this->record_id) {
            $record = $this->model->findOrFail($this->record_id);
            $old_sequence = $record['sequence_number'];
        }        
        $sequence_params = [
            'sequence_field' => 'sequence_number',
            'record_id' => $this->record_id,
            'old_sequence' => $old_sequence,
            'new_sequence' => $validatedData['sequence_number'],
            'conditions' =>  $conditions,
        ];
        $this->setSequence($this->model, $sequence_params);

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        if($next == 'close') {
            $this->makeModalClose();
        } else if($next == 'add') {
            $this->create();
            $this->fdata['campus_id'] = $validatedData['campus_id'];
            $this->fdata['academic_component_group_id'] = $validatedData['academic_component_group_id'];
            $this->fdata['academic_component_category_id'] = $validatedData['academic_component_category_id'];
            $this->fdata['active'] = $validatedData['active'];
        }
    }
    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,".$this->record_id.",id,academic_component_group_id,".($this->fdata['academic_component_group_id'] ?? NULL).""], 
            'fdata.campus_id' => ['required'],
            'fdata.academic_component_group_id' => ['required'],
            'fdata.academic_component_category_id' => ['required'],
            'fdata.sequence_number' => ['required','numeric'], //Sequenceable
            'fdata.active' => ['nullable'],
        ];
        $messages = [ ];
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Academic Component Type';

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function customCreate()
    {
        $this->fdata['active'] = 1;
        $this->fdata['sequence_number'] = $this->max_sequence_number = 1;
    }

    public function customEdit()
    {
        $this->getCustomMaxSequence();
    }    

    public function getCustomMaxSequence()
    {
        $sequence_conditions = [];
        if(!empty($this->fdata['academic_component_group_id'])) {
            $sequence_conditions['equalto']['academic_component_group_id'] = $this->fdata['academic_component_group_id'];
        }
        
       $this->max_sequence_number = $this->getMaxSequence($this->model, ['record_id' => $this->record_id, 'sequence_field' => 'sequence_number', "conditions" => $sequence_conditions ]);
    }

    public function updated($name, $value)
    {
        if($name === "fdata.academic_component_group_id") {
            $this->getCustomMaxSequence();
            $this->fdata['sequence_number'] = $this->max_sequence_number;
        }
    }    

    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getCampusListProperty()
    {
        return Campus::query()->tobase()->pluck('title', 'id');
    }

    public function getAcademicComponentGroupListProperty()
    {
        return AcademicComponentGroup::query()->tobase()->pluck('title', 'id');
    }

    public function getAcademicComponentCategoryListProperty()
    {
        return AcademicComponentCategory::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchCampusListProperty()
    {
        return Campus::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchAcademicComponentGroupListProperty()
    {
        return AcademicComponentGroup::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchAcademicComponentCategoryListProperty()
    {
        return AcademicComponentCategory::query()->tobase()->pluck('title', 'id');
    }
    
    public function export() 
    {
        $this->export_fields = 
        [
            'id' => 'ID', 
            'title' => 'Academic Component Type', 
            'campus.title' => 'Campus',
            'academic_Component_group.title' => 'Academic Component Group',
            'academic_Component_category.title' => 'Academic Component Category	',
            'active' => 'Active',
            'created_by.name' => 'Created By',
            'created_at_display' => 'Created At',
            'updated_by.name' => 'Updated By',
            'updated_at_display' => 'Updated At',
        ];
        return $this->exportExcel();
    }

}
