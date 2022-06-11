<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\CombinedIntake;

use App\Models\Month;

use Arr;

class CombinedIntakes extends AdminComponent
{
    public $page_title = "Combined Intake";

    public $sortField = "title", $sortDirection = "DESC", $sortFieldData = [];
    
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.combined-intake.combined-intake-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new CombinedIntake;
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
        $conditions['equalTo']['code'] = Arr::get($this->search, 'code');
        $conditions['equalTo']['month_id'] = Arr::get($this->search, 'month_id');
        $conditions['equalTo']['year'] = Arr::get($this->search, 'year');
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
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], // 'alpha_numeric_with_special_chars', 
            'fdata.month_id' => ['required'],
            'fdata.year' => ['required', 'numeric', 'min:1900', 'digits:4'],
            'fdata.active' => ['nullable'],
        ];

        $messages = [
            // 'fdata.title.required' => 'Please enter the Title',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Combined Intake';

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

    public function getSearchMonthListProperty()
    {
        return Month::query()->tobase()->pluck('title', 'id');
    }

    public function getMonthListProperty()
    {
        return Month::query()->tobase()->pluck('title', 'id');
    }
    
}

