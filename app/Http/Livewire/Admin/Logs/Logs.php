<?php
namespace App\Http\Livewire\Admin\Logs;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Log;
use App\Models\User;

use Arr;
use Carbon\Carbon;

class Logs extends AdminComponent
{
    public $page_title = "Logs";

    public $sortField = "created_at", $sortDirection = "DESC", $sortFieldData = [];

    public $subject_type;
    public $subject_id;

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.logs.log-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new Log;
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

        if($this->subject_id) {
            $conditions['equalTo']['subject_id'] = $this->subject_id;
        } else {
            $conditions['equalTo']['subject_id'] = Arr::get($this->search, 'subject_id');
        }

        if($this->subject_type) {
            $conditions['equalTo']['subject_type'] = 'App\\Models\\'.$this->subject_type;
        } else if(Arr::get($this->search, 'subject_type')) {
            $conditions['equalTo']['subject_type'] = 'App\\Models\\'. Arr::get($this->search, 'subject_type');
        }
        
        $conditions['equalTo']['log_name'] = Arr::get($this->search, 'log_name');
        $conditions['equalTo']['event'] = Arr::get($this->search, 'event');
        $conditions['equalTo']['causer_id'] = Arr::get($this->search, 'causer_id');
        
        if(Arr::get($this->search, 'log_from')) {
            $conditions['gte']['created_at'] = Carbon::parse(Arr::get($this->search, 'log_from'))->startOfDay()->format(config('settings.db_date_time_format'));
        }

        if(Arr::get($this->search, 'log_to')) {
            $conditions['lte']['created_at'] = Carbon::parse(Arr::get($this->search, 'log_to'))->endOfDay()->format(config('settings.db_date_time_format'));
        }

        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {

    }

    public function validation_rules()
    {

    }
    
    public function customCreate()
    {
    }

    public function customEdit()
    {
    }    
    
    public function delete($id)
    {
        // $this->model->where('id', $id)->delete();
    }

    public function getUserListProperty()
    {
        return User::query()->tobase()->pluck('name', 'id');
    }

    public function getModelListProperty()
    {
        $models = $this->getModels();
        $models = array_combine($models, $models);
        return $models;
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

    public function export() 
    {
        $this->export_fields = 
        [
            // 'id' => 'ID', 
            // 'created_at' => 'Created At',
            // 'causerable.name' => 'Created By',
            // 'event' => 'Event',
            // 'log_name' => 'Model',
            // 'subject_id' => 'Record Id',
            // 'properties' => 'properties',
        ];
        $this->export_type = "view";
    return $this->exportExcel(['view_file' =>'exports.excel-log']);
    }

}