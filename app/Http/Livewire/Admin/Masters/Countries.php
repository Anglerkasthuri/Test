<?php

namespace App\Http\Livewire\Admin\Masters;

use Illuminate\Support\Arr;

use App\Models\User;


use App\Models\Country;
use App\Models\Timezone;
use App\Models\Continent;

use App\Models\SubContinent;
use App\Models\AutoNumber;

use Spatie\Permission\Models\Role;

use App\Http\Livewire\AdminComponent as AdminComponent;

class Countries extends AdminComponent
{
    public $page_title = "Country", $eventName="";
    protected $listeners = ['searchValue' ,'resetSearch','export'];

    public $page_title11 = "Country";
    
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.country.country-list', compact('records')); //->layout('layouts.admin');
    }
    
    public function mount()
    {
        $this->model = new Country;
    }

    public function index()
    {
        // $this->skipRender();
        $query = $this->model->with([]);
        
        $query = $this->applySearchFilter($query);
  
        // Facet
        $this->facet_data['Continent'] = __reportFacet(["field" => "continent_id", "data" => $this->continentList, "query" => clone $query]);
        //$this->facet_data['Sub Continent'] = __reportFacet(["field" => "sub_continent_id", "data" => $this->subContinentList, "query" => clone $query]);

        $query = $this->applyFacetFilter($query);
        $query = $this->applyOrderBy($query);
        
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        
        return $records;
    }
    
    public function applySearchFilter($query) {
        $conditions['equalTo']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['equalTo']['dial_code'] = Arr::get($this->search, 'dial_code');
        $conditions['equalTo']['iso2_code'] = Arr::get($this->search, 'iso2_code');
        $conditions['in']['continent_id'] = Arr::get($this->search, 'continent_id');
        $conditions['in']['sub_continent_id'] = Arr::get($this->search, 'sub_continent_id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }

    public function store()
    {
        // $prefix = "INV/HDFC/JAN/2022/";
        // $action = [
        //     'model_name' => get_class($this->model),
        //     'field_name' => "title",
        //     'start_from' => 0,
        //     'length' => 5,
        //     'padding' => 0
        // ];
        // $auto_number = __setAutoNumber($prefix , $action);
        // dd($auto_number);

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
            'fdata.nationality' => ['required', 'max:100', "unique:". $this->model->getTable() .",nationality,$this->record_id,id"],
            'fdata.timezone_id' => ['required'],
            'fdata.dial_code' => ['required', 'max:10'],
            'fdata.iso2_code' => ['required', 'min:2', 'max:2', "unique:". $this->model->getTable() .",iso2_code,$this->record_id,id"],
            'fdata.iso3_code' => ['required', 'min:3', 'max:3', "unique:". $this->model->getTable() .",iso3_code,$this->record_id,id"],
            'fdata.continent_id' => ['required'],
            'fdata.sub_continent_id' => ['required'],
            'fdata.active' => ['nullable']
        ];

        $messages = [
            // 'fdata.title.required' => 'Please enter the Title',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Country Name';

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
        $this->model->where('id', $id)->delete();
    }

    public function getContinentListProperty()
    {
        return Continent::query()->tobase()->pluck('title', 'id');
    }

    public function getSubContinentListProperty()
    {
        return 
        SubContinent::query()
        ->when(Arr::get($this->fdata, 'continent_id'), fn($query, $continentId) => $query->where('continent_id','=', $continentId))
        ->toBase()
        ->pluck('title', 'id'); 
    }

    public function getTimezoneListProperty()
    {
        return Timezone::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchTimezoneListProperty()
    {
        return Timezone::query()->tobase()->pluck('title', 'id');
    }
    
    public function getSearchSubContinentListProperty()
    {
        return 
        SubContinent::select(['id', 'title', 'continent_id'])
        ->with('continent')
        ->get()
        ->groupBy('continent.title')->map(function($q) {
            return $q->pluck('title', 'id');
        });

        // return 
        // SubContinent::query()
        // ->when(Arr::get($this->search, 'continent_id'), fn($query, $continentId) => $query->where('continent_id', $continentId))
        // ->toBase()
        // ->pluck('title', 'id'); 
    }

    // public function updated($name, $value)
    // {
    //     if($name === "fdata.continent_id") {
    //         Arr::set($this->fdata, 'sub_continent_id', null);
    //     }

    //     if($name === "search.continent_id") {
    //         Arr::set($this->search, 'sub_continent_id', null);
    //     }
    // }    

    /*
    public function deleteSelected()
    {
        $this->model->whereIn('id', $this->selectedItems)->delete();
        $this->selectedItems = [];
        $this->selectAll = false;
    }
    
    public function updatedselectAll($value)
    {
        if($value) {
            $this->selectedItems = $this->model->pluck('id');
            $this->bulkDisabled = false;
        } else {
            $this->bulkDisabled = true;
            $this->selectedItems = [];
        }
    }
    */
    
    public function export() 
    {
       
        $this->export_fields = 
        [
            'id' => 'ID', 
            'title' => 'Country Name', 
            'nationality' => 'Nationality',
            'timezone.title' => 'Timezone',
            'dial_code' => 'Dial Code',
            'iso2_code' => 'ISO2 Code',
            'iso3_code' => 'ISO3 Code',
            'continent.title' => 'Continent',
            'sub_continent.title' => 'Sub Continent',
            'active' => 'Active',
            'created_by.name' => 'Created By',
            'created_at_display' => 'Created At',
            'updated_by.name' => 'Updated By',
            'updated_at_display' => 'Updated At',
        ];
        return $this->exportExcel();
    }

}