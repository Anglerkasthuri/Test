<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Traits\Sequenceable;

use App\Models\Campus;

use Arr;

class Campuses extends AdminComponent
{
    use Sequenceable;

    public $page_title = "Campus";
    public $sortField = "sequence_number", $sortDirection = "DESC", $sortFieldData = [];

    // Sequenceable
    public $max_sequence_number;
    
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.campus.campus-list', compact('records')); //->layout('layouts.admin')
    }
    
    public function mount()
    {
        $this->model = new Campus;
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
        $conditions['equalTo']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['equalTo']['short_name'] = Arr::get($this->search, 'short_name');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        // $this->fdata = array_map('trim', $this->fdata);
        
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

        $result = $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        // $url = 'https://cdn-aidaf.nitrocdn.com/tHMhmlOskzCLOcKGRHvdXNsCnlPHTsvJ/assets/static/optimized/rev-44754da/wp-content/uploads/2017/07/tauedu-logo.png';
        // $result
        //    ->addMediaFromUrl($url)
        //    ->toMediaCollection('campus/field1');
        
        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.short_name' => ['required', 'max:25', 'alpha_dash', "unique:". $this->model->getTable() .",short_name,$this->record_id,id"],
            'fdata.deferment_duration_days' => ['required', 'numeric', 'min:0', 'max:365'],
            'fdata.sequence_number' => ['required','numeric'], //Sequenceable
            'fdata.active' => ['nullable'],
        ];

        $messages = [
            // 'fdata.title.required' => 'Please enter the Title',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Campus Name';

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
        $this->max_sequence_number = $this->getMaxSequence($this->model, ['record_id' => $this->record_id, 'sequence_field' => 'sequence_number']);
    }    
    
    public function delete($id)
    {
        // $this->model->where('id', $id)->delete();
    }

}
