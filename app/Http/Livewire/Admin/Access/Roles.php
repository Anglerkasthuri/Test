<?php

namespace App\Http\Livewire\Admin\Access;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Role;

use Arr, Str;

class Roles extends AdminComponent
{
    public $page_title = "Role";
    public $sortField = "name", $sortDirection = "DESC", $sortFieldData = [];
   
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.access.role.role-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new Role;
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
        $conditions['like']['name'] = Arr::get($this->search, 'name');
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
        if(!$this->record_id) {
            $validatedData['uuid'] = (string) Str::uuid();
            $validatedData['created_by_id'] = auth()->user()->id;
        }
        $validatedData['updated_by_id'] = auth()->user()->id;
        $validatedData['guard_name'] = 'web';

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.name' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",name,$this->record_id,id"], // 'alpha_numeric_with_special_chars', 
            'fdata.description' => ['nullable', 'max:5000'],
            'fdata.active' => ['nullable'],
        ];

        $messages = [
            // 'fdata.name.required' => 'Please enter the Name',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.name'] = 'Role';

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
        // $this->model->where('id', $id)->delete();
    }

}