<?php
namespace App\Http\Livewire\Admin\Access;

use Illuminate\Support\Facades\Hash;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\User;
use App\Models\Role;

use Livewire\WithFileUploads;

use Arr, Str;

class Users extends AdminComponent
{

    use WithFileUploads;
    
    public $page_title = "User";
    public $sortField = "name", $sortDirection = "DESC", $sortFieldData = [];

    public $record;
   
    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.access.user.user-list', compact('records'));
    }
    
    public function mount()
    {
        $this->model = new User;
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
        $conditions['equalTo']['user_type'] = config('settings.user_type_id.staff');
        $conditions['equalTo']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['name'] = Arr::get($this->search, 'name');
        $conditions['like']['email'] = Arr::get($this->search, 'email');
        // $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }

    public function store()
    {
        // $this->fdata = collect($this->fdata)->trim();
        // $this->fdata = array_map('trim', $this->fdata);
        
        // $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];
        if(!$this->record_id) {
            // $validatedData['uuid'] = (string) Str::uuid();
            // $validatedData['created_by_id'] = auth()->user()->id;
        }
        // $validatedData['updated_by_id'] = auth()->user()->id;
        
        if( !empty($this->fdata['password']) ) {
            $validatedData['password'] = Hash::make($this->fdata['password']);
        }

        $user = $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

    //    if(!empty($this->fdata['profile_photo_path'])) {
    //         $user->addMedia($this->fdata['profile_photo_path']->getRealPath())
    //         ->usingName($this->fdata['profile_photo_path']->getClientOriginalName())
    //         ->usingFileName($this->fdata['profile_photo_path']->getClientOriginalName())                
    //         ->toMediaCollection();
    //    }

        if(isset($this->fdata['roles'])) {
            $user->syncRoles($this->fdata['roles']);
        } else {
            $user->syncRoles([]);
        }
        

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.name' => ['required', 'string', 'max:100'],
            'fdata.email' => ['required', 'string', 'email', 'max:100', "unique:". $this->model->getTable() .",email,$this->record_id,id"], // 'alpha_numeric_with_special_chars', 
            'fdata.password' => [($this->record_id) ? 'nullable' : 'required', 'min:6'],
            'fdata.profile_photo_path' => ['nullable', 'image','max:1024'] // 1MB Max
            // 'password' => $this->passwordRules(),
            // 'fdata.active' => ['nullable'],
        ];

        $messages = [
            // 'fdata.name.required' => 'Please enter the Name',
        ];

        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.name'] = 'Name';

        return [
            'rules' => $rules,
            'messages' => $messages,
            'attributes' => $attributes,
        ];
    }

    public function customCreate()
    {
        $this->fdata['active'] = 1;
        //$this->fdata['profile_picture'] =  $this->fdata['profile_p_path'];
        // $this->fdata['roles'] = ['Admin', 'Academic Masters'];
        $this->emit('selectLoadOk');

    }

    public function customEdit($record)
    {
        $this->fdata['roles'] = $record->roles->pluck('name')->toArray();
        $this->emit('selectLoadOk');
    }      
    
    public function delete($id)
    {
        // $this->model->where('id', $id)->delete();
    }

    public function getRoleListProperty()
    {
        return Role::all()->pluck('name', 'name');
    }

}