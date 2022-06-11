<?php

namespace App\Http\Livewire\Admin\Forms;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Form;
use App\Models\FormData;

use Arr;

class FormPreviews extends AdminComponent
{

    public $page_title = "Form Data";
    public $form_id, $form_data_id = null, $formFields, $validation_attributes;

    public function render()
    {
        if(!empty($this->form_data_id)) {
            $this->formDataEdit();
        }

        $record = $this->index();       
        
        return view('livewire.admin.forms.form.form-preview', compact('record'));
    }

    public function mount()
    {
        $this->model = new Form;
    }
    
    public function formDataEdit()
    {
        $formData = FormData::findorFail($this->form_data_id);
        $this->form_id = $formData->form_id;
        foreach ($formData->data as $form_field_id => $form_field_value) {
            $this->fdata['df'][$form_field_id] = $form_field_value;    
        }        
    }

    public function index()
    {
        $formFields = [];
        $this->validation_attributes['rules'] = [];
        $this->validation_attributes['attributes'] = [];
        $form = $this->model->with([])->findOrFail($this->form_id);
        $this->form = $form;

        $form_fields = $form->form_fields->where("active", "=", 1);
        
        foreach ($form_fields as $form_field) {
            $field_id = $form_field->id;
            $field_model_id = "fdata.df.{$field_id}";
            $form_field_type_code = $form_field->form_field_type->code ?? null;
            $field_title = $form_field->title;
            $is_required = $form_field->is_required;

            $attributes = [];

            $formFields[$field_model_id] = [
                'id' => $field_model_id,
                'form_field_id' => $field_id,
            ];

            $notRequired =config("settings.form_fields.not_validated");

            if(!collect($notRequired)->contains($form_field_type_code)) {
                $this->validation_attributes['rules'][$field_model_id] =  !empty($is_required) ? "required" : "nullable"  ;
                $this->validation_attributes['attributes'][$field_model_id] =   $field_title ?? null ;
            }
            //$this->validation_attributes['rules'][$field_model_id] =  !empty($is_required) ? "required" : "nullable"  ;
            

            switch ($form_field_type_code) {

                case "select":
                    $form_dropdown_type_id = $form_field->form_dropdown_type->code ?? null;
                    
                    switch ($form_dropdown_type_id) {
                        case "master_category" : 
                            $formFields[$field_model_id]['type'] = "master-option-select"; 

                            $formFields[$field_model_id][$form_dropdown_type_id] = $form_dropdown_type_id; 

                            $attributes['label'] = [ 'class' => "form-label" ];

                            $attributes['field'] = [
                                    'wire:model.defer' => $field_model_id,
                                    'class' => "form-control",
                                    'placeholder' => "-- Select {$field_title}--"
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
                            break;
                        case "system_model" : 
                                $formFields[$field_model_id]['type'] = "system-model-select"; 
    
                                $formFields[$field_model_id][$form_dropdown_type_id] = $form_dropdown_type_id; 
    
                                $attributes['label'] = [ 'class' => "form-label" ];
    
                                $attributes['field'] = [
                                        'wire:model.defer' => $field_model_id,
                                        'class' => "form-control",
                                        'placeholder' => "-- Select {$field_title}--"
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
                                break;
                            
                            break;
                    }
                   
                    break;

                case "text":

                    $formFields[$field_model_id]['type'] = "input"; 

                    $attributes['label'] = [ 'class' => "form-label" ];

                    $attributes['field'] = [
                            'wire:model.defer' => $field_model_id,
                            'class' => "form-control" 
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
                    
                    break;

                case "textarea":

                    $formFields[$field_model_id]['type'] = "textarea"; 

                    $attributes['label'] = [ 'class' => "form-label" ];

                    $attributes['field'] = [
                            'wire:model.defer' => $field_model_id,
                            'class' => "form-control" ,
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
                    break;

                case "number":

                    $formFields[$field_model_id]['type'] = "input"; 

                    $attributes['label'] = [ 'class' => "form-label" ];

                    $attributes['field'] = [
                            'wire:model.defer' => $field_model_id,
                            'class' => "form-control" 
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
                    break;

                    case "label":

                        $formFields[$field_model_id]['type'] = "text"; 
    
                        $attributes['label'] = [ ];
    
                        // $attributes['field'] = [
                        //         'wire:model.defer' => $field_model_id,
                        //         'class' => "form-control" 
                        //     ];                    
        
                        $formFields[$field_model_id]['label'] = [
                            'id' => $field_model_id,
                            "type" => "p",
                            "value" => $field_title,
                            "attributes" => $attributes['label']
                        ];
    
                        // $formFields[$field_model_id]['field'] = [
                        //     'id' => $field_model_id,
                        //     "attributes" => $attributes['field']
                        // ];
                        break;

                    case "heading":
                        $formFields[$field_model_id]['type'] = "text"; 
    
                        $attributes['label'] = [ ];
    
                        // $attributes['field'] = [
                        //         'wire:model.defer' => $field_model_id,
                        //         'class' => "form-control" 
                        //     ];                    
        
                        $formFields[$field_model_id]['label'] = [
                            'id' => $field_model_id,
                            "type" => "heading",
                            "line" => true,
                            "heading" => "h5",
                            "value" => $field_title,
                            "attributes" => $attributes['label']
                        ];
    
                        // $formFields[$field_model_id]['field'] = [
                        //     'id' => $field_model_id,
                        //     "attributes" => $attributes['field']
                        // ];
                        break;
            }
        }
       
        $this->formFields = $formFields;
    }

    public function store()
    {
        $this->fdata['df'] = collect($this->fdata['df'] ?? [])->trim();
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata']['df'];

        $form = $this->model->find($this->form_id);
        $formdata = $form->formdata()->UpdateOrCreate(["id" => $this->form_data_id ?? null],['form_id' => $this->form_id, 'data' => $validatedData]);
        
        $this->alertMessage();
    }

    public function validation_rules()
    {
        $rules =  $this->validation_attributes['rules'] ?? [];
        $messages = [ ];
        $attributes = $this->validation_attributes['attributes'] ?? [];
        $attributes['fdata.title'] = 'Form';

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    } 
    
}
