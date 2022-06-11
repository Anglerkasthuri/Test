<?php
namespace App\Http\Livewire\Admin\Masters;

use App\Exports\ExcelExport;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use App\Models\MasterOption;
use App\Traits\Sequenceable;
use App\Models\MasterCategory;
use App\Http\Livewire\AdminComponent as AdminComponent;

use Illuminate\Database\Eloquent\Builder;

class MasterOptions extends AdminComponent
{
    use Sequenceable;

    public $page_title = "Master Option";

    public $sortField = "sequence_number", $sortDirection = "DESC", $sortFieldData = [];

    // Sequenceable
    public $max_sequence_number;

    // URL Variables & Related
    public $master_category_id;
    public $master_category_details;
    public $parent_category_id, $field_show;
    
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.master-option.master-option-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new MasterOption;

        if($this->master_category_id) {
            $this->master_category_details = MasterCategory::findorFail($this->master_category_id);
            $this->parent_category_id =  !empty($this->master_category_details['is_dependent']) ? $this->master_category_details['parent_category_id'] : null;
            
        }
    }

    public function index()
    {
        $query = $this->model->with([]);
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        
        return $records;
    }
    
    public function applySearchFilter($query) {
        $conditions['equalTo']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['like']['code'] = Arr::get($this->search, 'code');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        $conditions['equalTo']['master_category_id'] = $this->master_category_id ?? Arr::get($this->search, 'master_category_id');
        // $conditions['equalTo']['master_category_id'] = $this->master_category_id;
        return  __reportConditions($query, $conditions);
    }

    public function store($next='')
    {
        $this->fdata['master_category_id'] = $this->master_category_id;
       // $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";

        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];

        // Sequenceable
        $old_sequence = $this->max_sequence_number;
        if($this->record_id) {
            $record = $this->model->findOrFail($this->record_id);
            $old_sequence = $record['sequence_number'];
        }        
        
        $sequence_conditions['equalTo']['master_category_id'] = $this->master_category_id;
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

        if($next == 'close') {
            $this->makeModalClose();
        } else if($next == 'add') {
            $this->create();
        }
    }

    public function validation_rules()
    {
        $attributes['fdata.title'] = 'Master Option';

        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id,master_category_id,$this->master_category_id"], 
            'fdata.code' => ['required', 'max:25', 'alpha_dash', "unique:". $this->model->getTable() .",code,$this->record_id,id,master_category_id,$this->master_category_id"],
            'fdata.master_category_id' => ['required'],
            'fdata.parent_option_id' => ['required_if:fdata.is_dependent,1'],
            'fdata.description' => ['nullable', 'max:5000'],
            'fdata.sequence_number' => ['required','numeric'], // Sequenceable
            'fdata.active' => ['nullable'],
        ];

        $messages = [
             'fdata.parent_option_id.required_if' => 'Please select the Parent Option',
        ];

        $attributes = __getAttributesFromNested($rules);
        
        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }
    
    public function customCreate()
    {
        $this->fdata['active'] = 1;

        // Sequenceable
        $sequence_conditions['equalTo']['master_category_id'] = $this->master_category_id;
        $sequence_params = [
            'record_id' => $this->record_id,
            'sequence_field' => 'sequence_number',
            'conditions' => $sequence_conditions,
        ];
        $this->fdata['sequence_number'] = $this->max_sequence_number = $this->getMaxSequence($this->model, $sequence_params);
        $this->fdata['is_dependent'] = $this->master_category_details['is_dependent'] ?? null;
        $this->parentOptionIdValidate($this->fdata['is_dependent']);
    }

    public function customEdit()
    {
        // Sequenceable
        $sequence_conditions['equalTo']['master_category_id'] = $this->master_category_id;
        $sequence_params = [
            'record_id' => $this->record_id,
            'sequence_field' => 'sequence_number',
            'conditions' => $sequence_conditions,
        ];
        $this->max_sequence_number = $this->getMaxSequence($this->model, $sequence_params);

        $this->fdata['is_dependent'] = $this->master_category_details['is_dependent'] ?? null;
        
        $this->parentOptionIdValidate($this->fdata['is_dependent']);
    }    

    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getMasterCategoryListProperty()
    {
        return MasterCategory::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getParentOptionListProperty()
    {
        return MasterOption::query()->tobase()->where("master_category_id", $this->parent_category_id??null)->orderBy('title')->pluck('title', 'id');
    }

    public function parentOptionIdValidate($value = false)
    {
        $this->field_show['fdata.parent_option_id'] = !empty($value) ? true : false;
    }

    public function updated($name, $value)
    {
        if($name === "fdata.title") {
            if(!$this->record_id) {
                Arr::set($this->fdata, 'code', Str::of($value)->snake());
            }
        }
    }

    public function export() 
    {
        $this->export_fields = 
        [
            'id' => 'ID', 
            'title' => 'Master Option', 
            'code' => 'Code',
            'master_category.title' => 'Master Category',
            'sequence_number' => 'Sequence',
            'description' => 'Description',
            'active' => 'Active',
            'created_by.name' => 'Created By',
            'created_at_display' => 'Created At',
            'updated_by.name' => 'Updated By',
            'updated_at_display' => 'Updated At',
        ];
        // $this->export_type = "view";
        return $this->exportExcel();
    }

}
