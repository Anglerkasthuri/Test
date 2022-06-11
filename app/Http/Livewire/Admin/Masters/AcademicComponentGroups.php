<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;
use App\Traits\Sequenceable;

use App\Models\AcademicComponentGroup;
use App\Models\AcademicComponentCategory;

use Arr;

class AcademicComponentGroups extends AdminComponent
{

    use Sequenceable;
    
    public $page_title = "Academic Component Group";
    // Sequenceable
    public $max_sequence_number;
    public $sortField = "sequence_number", $sortDirection = "DESC", $sortFieldData = [];

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.academic-component-group.academic-component-group-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new AcademicComponentGroup;
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

        // Sequenceable
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
        ];
        $this->setSequence($this->model, $sequence_params);

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.academic_component_category_id' => ['required'],
            'fdata.sequence_number' => ['required','numeric'], //Sequenceable
            'fdata.active' => ['nullable'],
        ];
        $messages = [ ];
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Academic Component Group';

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function customCreate()
    {
        $this->fdata['active'] = 1;
        
        // Sequenceable
        $this->fdata['sequence_number'] = $this->max_sequence_number = $this->getMaxSequence($this->model, ['record_id' => $this->record_id, 'sequence_field' => 'sequence_number']);
    }

    public function customEdit()
    {
        // Sequenceable
        $this->max_sequence_number = $this->getMaxSequence( $this->model, ['record_id' => $this->record_id, 'sequence_field' => 'sequence_number']);
    }    

    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getAcademicComponentCategoryListProperty()
    {
        return AcademicComponentCategory::query()->tobase()->pluck('title', 'id');
    }

}
