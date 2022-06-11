<?php

namespace App\Http\Livewire\Admin\Forms;

use App\Http\Livewire\AdminComponent as AdminComponent;
use App\Traits\Sequenceable;

use App\Models\Form;
use App\Models\FormField;
use App\Models\FormData;
use App\Models\MasterOption;
use Arr;

class FormDatas extends AdminComponent
{

    use Sequenceable;

    public $page_title = "Form Data";
    public $form_id, $form_data_id, $field_show, $table_headers, $formFieldFilter;
    public $sortField = "created_at", $sortDirection = "ASC", $sortFieldData = [];
    public $formFieldSearch;

    public function render()
    {
        if(!empty($this->form_data_id)) {
            $record = $this->model->with([])->findOrFail($this->form_data_id);
            $this->form = Form ::with([])->findOrFail($record->form_id);
            $this->getFormFields();
            return view('livewire.admin.forms.form-data.form-data-view', compact('record'));
            
        } else {
            $this->form = Form ::with([])->findOrFail($this->form_id);
            $this->getFormFields("validated");
            $this->getFormFieldFilters();
           
            $records = $this->index();
           
            return view('livewire.admin.forms.form-data.form-data-list', compact('records'));
            
        }        
    }

    public function mount()
    {
        $this->model = new FormData;
    }

    public function getFormFields($type = "all")
    {
        $this->table_headers = $this->form->form_fields;
        if($type == "validated") {
            $this->table_headers = $this->table_headers->whereNotIn("form_field_type.code", config("settings.form_fields.not_validated"));
        }

    }
    public function getFormFieldFilters()
    {
        $table_headers = $this->table_headers->where("show_in_filter",'1');
        
        $formFields = [];
        $formFieldSearch = [];

        foreach ( $table_headers as $table_header) {
            $form_field_type_code = $table_header->form_field_type->code ?? null;
            $form_field =   $table_header;
            $field_id =   $table_header->id;
            $field_model_id = "search.df.{$form_field->id}";
            $field_title = $table_header->title;
          

            
            $attributes = [];

            $formFields[$field_model_id] = [
                'id' => $field_model_id,
                'form_field_id' => $field_id,
            ];

            switch ($form_field_type_code) {
            
                case "select":
                    $form_dropdown_type_id = $form_field->form_dropdown_type->code ?? null;
                    
                    switch ($form_dropdown_type_id) {
                        case "master_category" : 
                            $formFields[$field_model_id]['type'] = "master-option-select"; 
                           
                            $formFields[$field_model_id][$form_dropdown_type_id] = $form_dropdown_type_id; 

                            $attributes['label'] = [ 'class' => "focus-label" ];

                            $attributes['field'] = [
                                    'wire:model.defer' => $field_model_id,
                                    'class' => "form-control input-rounded search-input floating",
                                    'placeholder' => ""
                                ];   

                            if(!empty($is_required)) {
                                $attributes['required'] = "required";
                                $attributes['label']['class'].= " required";
                            }

                            $formFields[$field_model_id]['label'] = [
                                "value" => $field_title,
                                "attributes" => $attributes['label']
                            ];

                            $formFields[$field_model_id]['field'] = [
                                'id' => $field_model_id,
                                "attributes" => $attributes['field']
                            ];

                            $formFieldSearch['filter'][] = [
                                "condition" => "equalto",
                                "id" => $field_model_id,
                                "data_field" =>"data->".$field_id
                            ];
                            break;
                            
                        case "system_model" : 
                                $formFields[$field_model_id]['type'] = "system-model-select"; 

                                $formFields[$field_model_id][$form_dropdown_type_id] = $form_dropdown_type_id; 

                                $attributes['label'] = [ 'class' => "focus-label" ];

                                $attributes['field'] = [
                                        'wire:model.defer' => $field_model_id,
                                        'class' => "form-control input-rounded search-input floating",
                                        'placeholder' => ""
                                    ];   

                                if(!empty($is_required)) {
                                    $attributes['required'] = "required";
                                    $attributes['label']['class'].= " required";
                                }

                                $formFields[$field_model_id]['label'] = [
                                    "value" => $field_title,
                                    "attributes" => $attributes['label']
                                ];

                                $formFields[$field_model_id]['field'] = [
                                    'id' => $field_model_id,
                                    "attributes" => $attributes['field']
                                ];

                                $formFieldSearch['filter'][] = [
                                    "condition" => "equalto",
                                    "id" => $field_model_id,
                                    "data_field" =>"data->".$field_id
                                ];
                                break;
                            
                            break;
                    }
                
                    break;

                case "text":

                    $formFields[$field_model_id]['type'] = "input"; 

                    $attributes['label'] = [ 'class' => "focus-label" ];

                    $attributes['field'] = [
                            'wire:model.defer' => $field_model_id,
                            'class' => "form-control input-rounded search-input floating" 
                        ];                    

                    if(!empty($is_required)) {
                        $attributes['required'] = "required";
                        $attributes['label']['class'].= " required";
                    }

                    $formFields[$field_model_id]['label'] = [
                        "value" => $field_title,
                        "attributes" => $attributes['label']
                    ];

                    $formFields[$field_model_id]['field'] = [
                        'id' => $field_model_id,
                        "attributes" => $attributes['field']
                    ];
                    
                    $formFieldSearch['filter'][] = [
                        "condition" => "like",
                        "id" => $field_model_id,
                        "data_field" =>"data->".$field_id
                    ];
                    break;

                case "textarea":

                    $formFields[$field_model_id]['type'] = "textarea"; 

                    $attributes['label'] = [ 'class' => "focus-label" ];

                    $attributes['field'] = [
                            'wire:model.defer' => $field_model_id,
                            'class' => "form-control input-rounded search-input floating" ,
                            'rows' => 4
                        ];  

                    if(!empty($is_required)) {
                        $attributes['required'] = "required";
                        $attributes['label']['class'].= " required";
                    }

                
                    $formFields[$field_model_id]['label'] = [
                        "value" => $field_title,
                        "attributes" => $attributes['label']
                    ];

                    $formFields[$field_model_id]['field'] = [
                        'id' => $field_model_id,
                        "attributes" => $attributes['field']
                    ];

                    $formFieldSearch['filter'][] = [
                        "condition" => "like",
                        "id" => $field_model_id,
                        "data_field" =>"data->".$field_id
                    ];
                    break;

                case "number":

                    $formFields[$field_model_id]['type'] = "input"; 

                    $attributes['label'] = [ 'class' => "focus-label" ];

                    $attributes['field'] = [
                            'wire:model.defer' => $field_model_id,
                            'class' => "form-control input-rounded search-input floating" 
                        ];                    

                    if(!empty($is_required)) {
                        $attributes['required'] = "required";
                        $attributes['label']['class'].= " required";
                    }

                    $formFields[$field_model_id]['label'] = [
                        "value" => $field_title,
                        "attributes" => $attributes['label']
                    ];

                    $formFields[$field_model_id]['field'] = [
                        'id' => $field_model_id,
                        'type'=> "number",
                        "attributes" => $attributes['field']
                    ];

                    $formFieldSearch['filter'][] = [
                        "condition" => "like",
                        "id" => $field_model_id,
                        "data_field" =>"data->".$field_id
                    ];
                    break;

                    case "label":

                    
                        break;

                    case "heading":
                     
                        break;
            }
          
        }
       
        $this->formFieldFilters = $formFields;
        $this->formFieldSearch = $formFieldSearch;
    }

    public function getFormDataValue( $form_field_id, $value = "")
    {
        $form_field = $this->table_headers->where('id',"=",$form_field_id)->first();
        $form_field_type_code = $form_field->form_field_type->code ?? null;
        
        switch ($form_field_type_code) {

            case "select":
                $form_dropdown_type_id = $form_field->form_dropdown_type->code ?? null;
                
                switch ($form_dropdown_type_id) {
                    case "master_category" :                      
                        $result = MasterOption::find($value);
                        return $result->title ?? null;                    
                        break;
                    case "system_model" : 
                        $system_model_name = "App\\Models\\".$form_field->system_model->model_name ?? null;
                        $system_model_field = $form_field->system_model->field_name ?? "title";
                        if(class_exists($system_model_name)) {
                            $current_model = new $system_model_name;
                            $system_model_field = !empty($this->system_model_field) ?  $this->system_model_field : "title" ;
                            $result = $current_model::find($value);
                            return $result->$system_model_field ?? null;
                        }
                        return $value;
                        break;
                }
               
                break;

            default : 
                return $value;
                break;
            }
        return $value;
    }
    public function index()
    {
        $query = $this->model->with([])->where("form_id", $this->form_id);
        // $query = $query->where('data->7', 19);
        // $query = $query->whereIn('data->7', [19, 20]);
        // $query = $query->where('data->7', '>=', 20);
        // $query = $query->where('data->2', 'like', '%Ra%');

         $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));    
        return $records;
    }

    public function view()
    {
        $records = $this->model->with([])->where("form_id", $this->form_id);
      
        return $records;
    }
    
    public function applySearchFilter($query) 
    {
        $conditions = $this->applyFormFieldSearchFilter();
        
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }

    public function applyFormFieldSearchFilter() 
    {
        $conditions = [];  
        $formFieldSearchs = $this->formFieldSearch['filter'] ?? [];
        foreach ($formFieldSearchs as $formFieldSearch) {
            $conditions[$formFieldSearch['condition']][$formFieldSearch['data_field']] =  data_get($this, "{$formFieldSearch['id']}");
        }  
        return $conditions;   
    }
    
    public function store()
    {
    
      
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
