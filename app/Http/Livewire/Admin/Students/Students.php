<?php
namespace App\Http\Livewire\Admin\Students;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\User;
use App\Models\MasterOption;
use App\Models\Country;
use App\Models\Student;

use Arr;

class Students extends AdminComponent
{
    public $page_title = "Student";
    public $sortField = "created_at", $sortDirection = "DESC", $sortFieldData = [];

    public $record;
   
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.students.student.student-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new Student;
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
        dump( $this->fdata);
        $this->fdata = collect($this->fdata)->trim();
        dd( $this->fdata);
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
        $validatedData['title'] = $validatedData['first_name'];

        $student = $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);
        if ($student) {
            $authuser_data['name'] = $validatedData['title'];
            $authuser_data['email'] = $validatedData['email'];
            if(isset($validatedData['password'])) {
                $authuser_data['password'] = Hash::make($validatedData['password']);
            }
            $authuser_data['is_allow_login'] = $validatedData['active'];
            $authuser_data['user_type'] = config('settings.user_type_id.student');
            $auth_user_id = !empty($student->authuser) ? $student->authuser->id : null;
            $user = $student->authuser()->updateOrCreate(['id' => $auth_user_id], $authuser_data);
        }

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['nullable', 'string', 'max:100'],
            'fdata.first_name' => ['required','max:100'],
            'fdata.last_name' => ['nullable','max:100'],
            'fdata.gender_id' => ['required'],
            'fdata.date_of_birth' => ['required'],
            'fdata.country_id' => ['required'],
            'fdata.natinality_id' => ['nullable'],            
            'fdata.email' => ['required', 'string', 'email', 'max:100', "unique:". $this->model->getTable() .",email,$this->record_id,id"], // 'alpha_numeric_with_special_chars', 
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

    public function getCountryListProperty()
    {
        return Country::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getNationalityListProperty()
    {
        return Country::query()->tobase()->orderBy('nationality')->pluck('nationality', 'id');
    }

}