<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use App\Models\FormField;
use App\Models\SystemModel;
use Illuminate\Database\Eloquent\Model;

use function Ramsey\Uuid\v1;

class SystemModelSelect extends Component
{
    public $form_field_id, $form_field, $system_model_id, $optionsList, $fieldAttributes;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($formFieldId = null, $fieldAttributes = [])
    {
        $this->form_field_id = $formFieldId;
        
        $form_field = FormField::with([])->find($formFieldId);      
        $this->form_field =  $form_field;
        $this->system_model_id = $form_field->system_model_id ?? null;
        $this->system_model_name = "App\\Models\\".$form_field->system_model->model_name ?? null;
        $this->system_model_field = $form_field->system_model->field_name ?? "title";
        $this->fieldAttributes =  $fieldAttributes;    
        if(class_exists($this->system_model_name)) {
            $this->model = new $this->system_model_name;
            if(empty($fieldAttributes['option_list'])) {
                $this->fieldAttributes['option_list'] = $this->getOptionsList();
            }
        } else {
            $this->fieldAttributes['option_list'][''] = " Contact administrator, No Option Found in this Model";
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

     public function getOptionsList()
    {
       
        $this->system_model_field = !empty($this->system_model_field) ?  $this->system_model_field : "title" ;
        return  $this->model->query()->tobase()->pluck($this->system_model_field, 'id');
    }
    
    public function render()
    {
        return view('components.forms.select');
    }
}
