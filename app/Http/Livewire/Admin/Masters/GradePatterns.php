<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\GradeType;
use App\Models\GradeCategory;
use App\Models\GradePattern;

use Arr;

class GradePatterns extends AdminComponent
{
    public $page_title = "Grade Pattern";
    
    public $grade_category_id, $grade_category_details;

    public $internal_inputs = [], $internal_i = 0;
    public $external_inputs = [], $external_i = 0;
    public $final_inputs = [], $final_i = 0;

    public function render()
    {
        if(count($this->getErrorBag()->all()) > 0) {
            $this->alert("warning",  __('msg.validation_error'));
        }
        return view('livewire.admin.masters.grade-category.grade-pattern-create');
    }

    public function mount()
    {
        $this->model = new GradePattern;
        
        $this->grade_category_details = GradeCategory::findorFail($this->grade_category_id);

        if($this->grade_category_details->internal_calculation_available) {
            $this->setInternal();
        }

        if($this->grade_category_details->external_calculation_available) {
            $this->setExternal();
        }

        if($this->grade_category_details->final_calculation_available) {
            $this->setFinal();
        }
    }

    public function store()
    {
        // dd($this->fdata);
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        
        // Internal
        foreach ($validatedData['fdata']['internal'] as $data) {
            $data['grade_category_id'] = $this->grade_category_id;
            $data['is_internal'] = 1;
            $this->model->updateOrCreate(['id' => $data['id'] ?? ''], $data);
        }

        // External
        foreach ($validatedData['fdata']['external'] as $data) {
            $data['grade_category_id'] = $this->grade_category_id;
            $data['is_external'] = 1;
            $this->model->updateOrCreate(['id' => $data['id'] ?? ''], $data);
        }

        // Final
        foreach ($validatedData['fdata']['final'] as $data) {
            $data['grade_category_id'] = $this->grade_category_id;
            $data['is_final'] = 1;
            $this->model->updateOrCreate(['id' => $data['id'] ?? ''], $data);
        }

        return redirect(request()->header('Referer'));
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.internal.*.id' => ['nullable'],
            'fdata.internal.*.mark_from' => ['required', 'numeric', 'min:0', 'max:100'],
            'fdata.internal.*.mark_to' => ['required', 'numeric', 'min:0', 'max:100'],
            'fdata.internal.*.grade_type_id' => ['required', 'distinct'],
            'fdata.internal.*.grade_points' => ['required', 'numeric', 'min:0', 'max:100'],

            'fdata.external.*.id' => ['nullable'],
            'fdata.external.*.mark_from' => ['required', 'numeric', 'min:0', 'max:100'],
            'fdata.external.*.mark_to' => ['required', 'numeric', 'min:0', 'max:100'],
            'fdata.external.*.grade_type_id' => ['required', 'distinct'],
            'fdata.external.*.grade_points' => ['required', 'numeric', 'min:0', 'max:100'],

            'fdata.final.*.id' => ['nullable'],
            'fdata.final.*.mark_from' => ['required', 'numeric', 'min:0', 'max:100'],
            'fdata.final.*.mark_to' => ['required', 'numeric', 'min:0', 'max:100'],
            'fdata.final.*.grade_type_id' => ['required', 'distinct'],
            'fdata.final.*.grade_points' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
        
        $attributes = __getAttributesFromNested($rules);

        $messages = [];

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function customCreate()
    {
        // $this->fdata['active'] = 1;
    }

    public function customEdit()
    {
        
    }     
    
    public function delete($id)
    {
        // $this->model->where('id', $id)->delete();
    }

    public function getGradeTypeListProperty()
    {
        return GradeType::query()->tobase()->pluck('title', 'id');
    }    

    public function setInternal()
    {
        $records = $this->model::internal($this->grade_category_id)->orderBy('mark_from')->select('id', 'mark_from', 'mark_to', 'grade_type_id', 'grade_points')->get();
        $this->fdata['internal'] = $records->toArray();
        $records_count = $records->count();
        $records_count = $records_count ? $records_count : 2;
        for($loop=0; $loop<$records_count; $loop++) {
            $this->addInternal($loop);
        }
    }

    public function addInternal($internal_i)
    {
        array_push($this->internal_inputs, $internal_i);
        if(!isset($this->fdata['internal'][$internal_i]['id'])) {
            $this->fdata['internal'][$internal_i]['id'] = "";
        }
        $this->internal_i = $internal_i + 1;
    }
    
    public function removeInternal($internal_i)
    {
        if(!empty($this->fdata['internal'][$internal_i]['id'])) {
            $this->model->where('id', $this->fdata['internal'][$internal_i]['id'])->delete();
        }
        unset($this->internal_inputs[$internal_i]);
        $this->internal_inputs = array_values($this->internal_inputs);

        $this->resetErrorBag();
        $this->resetValidation();
    }

    public function setExternal()
    {
        $records = $this->model::external($this->grade_category_id)->orderBy('mark_from')->select('id', 'mark_from', 'mark_to', 'grade_type_id', 'grade_points')->get();
        $this->fdata['external'] = $records->toArray();
        $records_count = $records->count();
        $records_count = $records_count ? $records_count : 2;
        for($loop=0; $loop<$records_count; $loop++) {
            $this->addExternal($loop);
        }
    }

    public function addExternal($external_i)
    {
        array_push($this->external_inputs, $external_i);
        if(!isset($this->fdata['external'][$external_i]['id'])) {
            $this->fdata['external'][$external_i]['id'] = "";
        }
        $this->external_i = $external_i + 1;
    }
    
    public function removeExternal($external_i)
    {
        if(!empty($this->fdata['external'][$external_i]['id'])) {
            $this->model->where('id', $this->fdata['external'][$external_i]['id'])->delete();
        }
        unset($this->external_inputs[$external_i]);
        $this->external_inputs = array_values($this->external_inputs);

        $this->resetErrorBag();
        $this->resetValidation();
    }
    
    public function setFinal()
    {
        $records = $this->model::final($this->grade_category_id)->orderBy('mark_from')->select('id', 'mark_from', 'mark_to', 'grade_type_id', 'grade_points')->get();
        $this->fdata['final'] = $records->toArray();
        $records_count = $records->count();
        $records_count = $records_count ? $records_count : 5;
        for($loop=0; $loop<$records_count; $loop++) {
            $this->addFinal($loop);
        }
    }

    public function addFinal($final_i)
    {
        array_push($this->final_inputs, $final_i);
        if(!isset($this->fdata['final'][$final_i]['id'])) {
            $this->fdata['final'][$final_i]['id'] = "";
        }
        $this->final_i = $final_i + 1;
    }
    
    public function removeFinal($final_i)
    {
        if(!empty($this->fdata['final'][$final_i]['id'])) {
            $this->model->where('id', $this->fdata['final'][$final_i]['id'])->delete();
        }
        unset($this->final_inputs[$final_i]);
        $this->final_inputs = array_values($this->final_inputs);

        $this->resetErrorBag();
        $this->resetValidation();
    }


}