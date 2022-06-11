<?php
namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Traits\Sequenceable;

use App\Models\MasterCategory;
use App\Models\MasterGroup;

use Arr, Str;

class MasterCategories extends AdminComponent
{
    use Sequenceable;

    public $page_title = "Master Category";

    public $sortField = "sequence_number", $sortDirection = "DESC", $sortFieldData = [];

    public $field_show;

    // Sequenceable
    public $max_sequence_number;
    
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.master-category.master-category-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new MasterCategory;
    }

    public function index()
    {
        $query = $this->model->with([])->withCount('master_option');
        $query = $this->applySearchFilter($query);
        $query = $this->applyOrderBy($query);
        $records = $query->paginate($this->search['perPage'] ?? config('settings.perPage'));
        
        return $records;
    }
    
    public function applySearchFilter($query) 
    {
        $conditions['equalTo']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['like']['code'] = Arr::get($this->search, 'code');
        $conditions['equalTo']['master_group_id'] = Arr::get($this->search, 'master_group_id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {
        //$this->fdata = collect($this->fdata)->trim();
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
        $sequence_params = [
            'sequence_field' => 'sequence_number',
            'record_id' => $this->record_id,
            'old_sequence' => $old_sequence,
            'new_sequence' => $validatedData['sequence_number'],
        ];
        $this->setSequence($this->model, $sequence_params);

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.code' => ['required', 'max:25', 'alpha_dash', "unique:". $this->model->getTable() .",code,$this->record_id,id"],
            'fdata.master_group_id' => ['required'],
            'fdata.parent_category_id' => ['required_if:fdata.is_dependent,1'],
            'fdata.is_dependent' => ['nullable'],
            'fdata.show_in_form' => ['required'],
            'fdata.description' => ['nullable', 'max:5000'],
            'fdata.sequence_number' => ['required','numeric'], // Sequenceable
            'fdata.active' => ['nullable'],
        ];

        $messages = [
            // 'fdata.title.required' => 'Please enter the Title',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Master Group';

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
        $this->fdata['sequence_number'] = $this->max_sequence_number = $this->getMaxSequence($this->model, ['record_id' => $this->record_id, 'sequence_field' => 'sequence_number']);
    }

    public function customEdit()
    {
        // Sequenceable
        $this->max_sequence_number = $this->getMaxSequence( $this->model, ['record_id' => $this->record_id, 'sequence_field' => 'sequence_number']);
        $this->isDependentValidate($this->fdata['is_dependent']);
    }    
    
    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getMasterGroupListProperty()
    {
        return MasterGroup::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getParentCategoryListProperty()
    {
        return MasterCategory::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }


    public function getShowInFormListProperty()
    {
        return [ 0 => "Hide", 1 => "Show" ];
    }

    public function isDependentValidate($value)
    {
        $this->field_show['fdata.parent_category_id'] = !empty($value) ? true : false;
    }

    public function updated($name, $value)
    {
        if($name === "fdata.title") {
            if(!$this->record_id) {
                Arr::set($this->fdata, 'code', Str::of($value)->snake());
            }
        } elseif ($name === "fdata.is_dependent") {
                $this->isDependentValidate($value);
        }
    }

}

