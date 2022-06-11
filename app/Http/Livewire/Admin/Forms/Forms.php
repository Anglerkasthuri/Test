<?php

namespace App\Http\Livewire\Admin\Forms;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Form;

use Arr;

class Forms extends AdminComponent
{

    public $page_title = "Form";

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.forms.form.form-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new Form;
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
        
        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.sub_title' => ['nullable', 'max:100',],
            'fdata.form_instruction' => ['nullable', 'max:5000'],
            'fdata.description' => ['nullable', 'max:5000'],
            'fdata.active' => ['nullable', 'max:5000'],
        ];
        $messages = [ ];
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Form';

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

}
