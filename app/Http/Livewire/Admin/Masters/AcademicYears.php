<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\AcademicYear;

use Arr;

// use App\Jobs\TestJob;
// use App\Mail\CommonMail;
// use Illuminate\Support\Facades\Mail;


class AcademicYears extends AdminComponent
{
   
    public $page_title = "Academic Year";

    public function render()
    {
        // TestJob::dispatch();
        // Mail::to('udhay.g@texila.org')->send(new CommonMail());
        $records = $this->index();
        return view('livewire.admin.masters.academic-year.academic-year-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new AcademicYear;
    }

    public function index()
    {
        $query = $this->model->with([]);

        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        $query = __reportConditions($query, $conditions);

        $query = __reportOrderBy($query, $this->sortField, $this->sortDirection);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        
        return $records;
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
            'fdata.title' => ['required', 'numeric', 'min:1', 'digits_between:4,4', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.active' => ['nullable'],
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Academic Year';

        $messages = [
            'fdata.title.digits_between' => "The Academic Year must be 4 digits."
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

}
