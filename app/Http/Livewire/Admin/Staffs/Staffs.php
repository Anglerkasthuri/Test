<?php
namespace App\Http\Livewire\Admin\Staffs;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\User;
use App\Models\Staff;
use App\Models\MasterOption;

use Arr;

class Staffs extends AdminComponent
{
    public $page_title = "Staff";
    public $sortField = "created_at", $sortDirection = "DESC", $sortFieldData = [];

    public $record;
   
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.staffs.staff.staff-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new Staff;
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
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['like']['email'] = Arr::get($this->search, 'email');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }

    public function store()
    {
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        
        $auth_user_id = null;
        if($this->record_id) {
            $auth_record = $this->model->where('id', $this->record_id)->firstOrFail();
            $auth_user = $auth_record->authuser()->get()->first();
            
            if (!empty($auth_user)) {
                $auth_user_id = $auth_user->id;
            }
        }

        // Validate in Users Table
        $user_validate_data['fdata']['email'] = "";
        if(isset($this->fdata['email'])) {
            $user_validate_data['fdata']['email'] = $this->fdata['email'];
        }
        $user_rule_set = $this->user_validation_rules($auth_user_id);
        $validator = Validator::make($user_validate_data, $user_rule_set['rules'], $user_rule_set['messages'], $user_rule_set['attributes']);
        $validator->validate();
                
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];

        $staff = $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);
        if ($staff) {
            $authuser_data['name'] = $validatedData['title'];
            $authuser_data['email'] = $validatedData['email'];
            if(isset($validatedData['password'])) {
                $authuser_data['password'] = Hash::make($validatedData['password']);
            }
            $authuser_data['is_allow_login'] = $validatedData['active'];
            $authuser_data['user_type'] = config('settings.user_type_id.staff');
            $auth_user_id = !empty($staff->authuser) ? $staff->authuser->id : null;
            $user = $staff->authuser()->updateOrCreate(['id' => $auth_user_id], $authuser_data);
        }

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'string', 'max:100'],
            'fdata.email' => ['required', 'string', 'email', 'max:100', "unique:". $this->model->getTable() .",email,$this->record_id,id"], // 'alpha_numeric_with_special_chars', 
            'fdata.date_of_joined' => ['required'],
            'fdata.employee_code' => ['required','max:50'],
            'fdata.gender_id' => ['required'],
            'fdata.date_of_birth' => ['required'],
            'fdata.staff_type_id' => ['required'],
            'fdata.work_type_id' => ['required'],
            'fdata.password' => [($this->record_id) ? 'nullable' : 'required', 'min:6'],
            'fdata.active' => ['nullable'],
        ];

        $messages = [
            // 'fdata.title.required' => 'Please enter the Name',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Name';

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function user_validation_rules($auth_user_id)
    {
        $rules = [
            'fdata.email' => ['required', 'string', 'email', 'max:100', "unique:users,email,$auth_user_id,id"], 
        ];

        $messages = [
            // 'fdata.title.required' => 'Please enter the Name',
        ];

        $attributes = __getAttributesFromNested($rules);
        // $attributes['fdata.title'] = 'Name';

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

    public function customEdit($record)
    {
        
    }      
    
    public function delete($id)
    {
        // $this->model->where('id', $id)->delete();
    }

    public function getGenderListProperty()
    {
        return MasterOption::code('gender')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }

    public function getStaffTypeListProperty()
    {
        return MasterOption::code('staff_type')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }

    public function getWorkTypeListProperty()
    {
        return MasterOption::code('work_type')->tobase()->where('parent_option_id', $this->fdata['staff_type_id']??null)->orderBy('sequence_number')->pluck('title', 'id');
    }

    public function updated($name, $value)
    {
        if($name === "fdata.staff_type_id") {
            Arr::set($this->fdata, 'work_type_id', null);
        }
    }

}
