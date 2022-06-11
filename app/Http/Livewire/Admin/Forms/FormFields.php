<?php

namespace App\Http\Livewire\Admin\Forms;

use App\Http\Livewire\AdminComponent as AdminComponent;
use App\Traits\Sequenceable;

use App\Models\Form;
use App\Models\FormField;
use App\Models\MasterCategory;
use App\Models\FormFieldType;
use App\Models\SystemModel;
use App\Models\FormDropdownType;
use Arr;

class FormFields extends AdminComponent
{

    use Sequenceable;

    public $page_title = "Form Fields";
    public $form_id, $field_show;
    // Sequenceable
    public $max_sequence_number;
    public $sortField = "sequence_number", $sortDirection = "ASC", $sortFieldData = [];

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.forms.form-field.form-field-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new FormField;
        $this->form = Form ::with([])->find($this->form_id);
    }

    public function index()
    {
        $query = $this->model->with([])->where("form_id", $this->form_id);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        
        return $records;
    }
    
    public function applySearchFilter($query) 
    {
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {
    
       // dd($this->fdata);
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        $this->fdata['form_field_type_id'] = !empty($this->fdata['form_field_type_id']) ? $this->fdata['form_field_type_id'] : null;
        $this->fdata['form_dropdown_type_id'] = !empty($this->fdata['form_dropdown_type_id']) ? $this->fdata['form_dropdown_type_id'] : null;
        $this->fdata['master_category_id'] = !empty($this->fdata['master_category_id']) ? $this->fdata['master_category_id'] : null;
        $this->fdata['system_model_id'] = !empty($this->fdata['system_model_id']) ? $this->fdata['system_model_id'] : null;
        



        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];
        
        // Sequenceable
        $old_sequence = $this->max_sequence_number;
        if($this->record_id) {
            $record = $this->model->findOrFail($this->record_id);
            $old_sequence = $record['sequence_number'];
        }    

        $sequence_conditions['equalTo']['form_id'] = $this->form_id;
       
        $sequence_params = [
            'sequence_field' => 'sequence_number',
            'record_id' => $this->record_id,
            'old_sequence' => $old_sequence,
            'new_sequence' => $validatedData['sequence_number'],
            'conditions' => $sequence_conditions,
        ];
        $this->setSequence($this->model, $sequence_params);

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
       
        $rules = [
            'fdata.form_id' => ['required'],
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.form_field_type_id' => ['required'],
            'fdata.is_required' => ['nullable'],
            'fdata.show_in_filter' => ['nullable'],
            'fdata.form_dropdown_type_id' => ['nullable', "required_if:fdata.form_field_type_id,".($this->validatationFieldTypeList['select']??null)],
            'fdata.master_category_id' => ['nullable', "required_if:fdata.form_dropdown_type_id,".($this->validatationDropdownTypeList['master_category']??null)],
            'fdata.system_model_id' => ['nullable', "required_if:fdata.form_dropdown_type_id,".($this->validatationDropdownTypeList['system_model']??null)],
            'fdata.sequence_number' => ['required','numeric'], //Sequenceable
            'fdata.active' => ['nullable'],
        ];
        $messages = [
            "fdata.form_dropdown_type_id.required_if" => "The Dropdown Type field is required",
            "fdata.master_category_id.required_if" => "The Custom Master field is required",
            "fdata.system_model_id.required_if" => "The System Model Type field is required",

         ];
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Form';
        

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function customCreate()
    {
        $this->fdata['form_id'] = $this->form_id;
        $this->fdata['active'] = 1;     
        $this->dropdownTypeIdValidate( $this->fdata['form_dropdown_type_id'] ?? null);
        $this->fieldTypeIdValidate($this->fdata['form_field_type_id'] ?? null);        
        
        // Sequenceable
         $sequence_conditions['equalTo']['form_id'] = $this->form_id;
         $sequence_params = [
             'record_id' => $this->record_id,
             'sequence_field' => 'sequence_number',
             'conditions' => $sequence_conditions,
         ];
         $this->fdata['sequence_number'] = $this->max_sequence_number = $this->getMaxSequence($this->model, $sequence_params);
    }

    public function customEdit()
    {
        $this->fieldTypeIdValidate($this->fdata['form_field_type_id'] ?? null);
        $this->dropdownTypeIdValidate( $this->fdata['form_dropdown_type_id'] ?? null);        
        // Sequenceable
          // Sequenceable
          $sequence_conditions['equalTo']['form_id'] = $this->form_id;
          $sequence_params = [
              'record_id' => $this->record_id,
              'sequence_field' => 'sequence_number',
              'conditions' => $sequence_conditions,
          ];
          $this->max_sequence_number = $this->getMaxSequence($this->model, $sequence_params);
    }    
  
    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function fieldTypeIdValidate($value)
    {
        if($value == ($this->validatationFieldTypeList['select']??null)) {
            $this->field_show['fdata.form_dropdown_type_id'] = true;
            $this->field_show['fdata.system_model_id'] = false;
            $this->field_show['fdata.master_category_id'] = false;
        } else {
            $this->field_show['fdata.form_dropdown_type_id'] = false;
            $this->field_show['fdata.system_model_id'] = false;
            $this->field_show['fdata.master_category_id'] = false;
        }

        if($value == ($this->validatationFieldTypeList['label']??null) || $value == ($this->validatationFieldTypeList['heading']??null)) {
            $this->field_show['fdata.is_required'] = false;
        } else {
            $this->field_show['fdata.is_required'] = true;
        }
    }

    public function dropdownTypeIdValidate($value)
    {
        if(($this->field_show['fdata.form_dropdown_type_id'] ?? false ) == true) {
          
            if($value == ($this->validatationDropdownTypeList['system_model']??null)) {                
                $this->field_show['fdata.system_model_id'] = true;    
                $this->field_show['fdata.master_category_id'] = false;
            } elseif($value == ($this->validatationDropdownTypeList['master_category']??null)) {
                $this->field_show['fdata.system_model_id'] = false;    
                $this->field_show['fdata.master_category_id'] = true;
            } else {
                $this->field_show['fdata.system_model_id'] = false;
                $this->field_show['fdata.master_category_id'] = false;
            }
        } else {
            $this->field_show['fdata.system_model_id'] = false;
            $this->field_show['fdata.master_category_id'] = false;
        }
            
    }
    
    public function updated($name, $value)
    {
        if($name === "fdata.form_field_type_id") {
            $this->fieldTypeIdValidate($value);
        }

        if($name === "fdata.form_dropdown_type_id") {
            $this->dropdownTypeIdValidate($value);
        }
    }
    public function getFormFieldTypeListProperty()
    {
        return FormFieldType::query()->tobase()->orderBy("sequence_number")->pluck('title', 'id');
    }

    public function getDropdownTypeListProperty()
    {
        return FormDropdownType::query()->tobase()->orderBy("sequence_number")->pluck('title', 'id');
    }

    public function getMasterCategoryListProperty()
    {
        return MasterCategory::query()->tobase()->where("show_in_form", "=", 1)->orderBy("sequence_number")->pluck('title', 'id');
    }

    public function getSystemModelListProperty()
    {
        return SystemModel::query()->tobase()->where("show_in_form", "=", 1)->orderBy("title")->pluck('title', 'id');
    }
    
    public function getValidatationDropdownTypeListProperty()
    {
        return FormDropdownType::query()->tobase()->orderBy("sequence_number")->pluck('id', 'code');
    }


    public function getValidatationFieldTypeListProperty()
    {
        return FormFieldType::query()->tobase()->orderBy("title")->pluck('id', 'code');
    }

}
