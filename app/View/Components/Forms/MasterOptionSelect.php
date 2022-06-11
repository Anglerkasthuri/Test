<?php

namespace App\View\Components\Forms;

use Illuminate\View\Component;
use App\Models\FormField;
use App\Models\MasterOption;
class MasterOptionSelect extends Component
{
    public $form_field_id, $form_field, $master_category_id, $optionsList, $fieldAttributes;
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
        $this->master_category_id = $form_field->master_category_id;

        $this->fieldAttributes =  $fieldAttributes;    

        if(empty($fieldAttributes['option_list'])) {
            $this->fieldAttributes['option_list'] = $this->getOptionsList();
        }
        
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */

     public function getOptionsList()
    {
        return MasterOption::query()->tobase()->where("master_category_id", "=", $this->master_category_id)->pluck('title', 'id');
    }
    
    public function render()
    {
        return view('components.forms.select');
    }
}
