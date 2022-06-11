<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Accreditation;
use App\Models\Country;

use Arr;

class Accreditations extends AdminComponent
{
   
    public $page_title = "Accreditation";

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.accreditation.accreditation-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new Accreditation;
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
        $conditions['equalto']['country_id'] = Arr::get($this->search, 'country_id');
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
            'fdata.address' => ['nullable', 'max:5000'],
            'fdata.country_id' => ['required'],
            'fdata.contact_number1' => ['nullable', 'phone_number', 'max:15'],
            'fdata.contact_number2' => ['nullable', 'phone_number', 'max:15'],
            'fdata.whatsapp_number' => ['nullable', 'phone_number', 'max:15'],
            'fdata.fax_number' => ['nullable', 'phone_number', 'max:15'],
            'fdata.email_address' => ['nullable', 'email','max:50'],
            'fdata.skype' => ['nullable','max:100'],
            'fdata.expiry_date' => ['nullable','after_or_equal:tomorrow'],
            'fdata.active' => ['nullable'],
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Accreditation';

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
    }

    public function customEdit()
    {

    }      
    
    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getCountryListProperty()
    {
        return Country::query()->tobase()->pluck('title', 'id');
    }
    public function getSearchCountryListProperty()
    {
        return Country::query()->tobase()->pluck('title', 'id');
    }

}
