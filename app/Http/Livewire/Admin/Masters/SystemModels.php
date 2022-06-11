<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\SystemModel;

use Arr;

class SystemModels extends AdminComponent
{
    
    public $page_title = "System Model";
  

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.system-model.system-model-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new SystemModel;
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
        $conditions['like']['model_name'] = Arr::get($this->search, 'model_name');
        $conditions['like']['field_name'] = Arr::get($this->search, 'field_name');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['boolean']['show_in_form'] = Arr::get($this->search, 'show_in_form');        
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    
    public function syncModel() 
    {
        $ddd= [];
        $models = $this->getModels();
        $models = array_combine($models, $models);
        foreach( $models as  $model ) {
            $setData = [
                    "title" => $model,
                ];
            $ddd[]=$this->model->firstOrCreate(['model_name' => $model], $setData);
        }
        $this->alert("success", "System Model Synced Successfully");
    }

    public function getModels() {
        $path = app_path() . "/Models";
        $out = [];
        $results = scandir($path);
        foreach ($results as $result) {
            if ($result === '.' or $result === '..') continue;
            $filename = $path . '/' . $result;
            if (is_dir($filename)) {
                $out = array_merge($out, getModels($filename));
            }else{
                // $out[] = substr($filename,0,-4);
                $out[] = substr(basename($filename), 0, -4);
            }
        }
        return $out;
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
            'fdata.model_name' => ['required'],
            'fdata.field_name' => ['nullable'],
            'fdata.show_in_form' => ['nullable'],
            'fdata.active' => ['nullable'],
        ];
        $messages = [ ];
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'System Model';

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

    public function getSearchShowInFormListProperty()
    {
        return [
            1 => "Show",
            0 => "Hide"
        ];
    }
}
