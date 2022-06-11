<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Course;
use App\Models\Campus;
use App\Models\ProgramCategory;
use App\Models\ProgramSubCategory;
use App\Models\ProgramLevel;
use App\Models\MasterOption;

use Arr;

class Courses extends AdminComponent
{

    public $page_title = "Course";  

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.masters.course.course-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new Course;
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
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['like']['title'] = Arr::get($this->search, 'title');
        $conditions['equalto']['id'] = Arr::get($this->search, 'id');
        $conditions['equalto']['short_name'] = Arr::get($this->search,'short_name');
        $conditions['equalto']['description'] = Arr::get($this->search,'description');
        $conditions['equalto']['approval_id'] = Arr::get($this->search,'approval_id');
        $conditions['equalto']['approval_link'] = Arr::get($this->search,'approval_link');
        $conditions['equalto']['campus_id'] = Arr::get($this->search,'campus_id');
        $conditions['equalto']['program_category_id'] = Arr::get($this->search,'program_category_id');
        $conditions['equalto']['program_sub_category_id'] = Arr::get($this->search,'program_sub_category_id');
        $conditions['equalto']['program_level_id'] = Arr::get($this->search,'program_level_id');
        $conditions['equalto']['course_type_id'] = Arr::get($this->search,'course_type_id');
        $conditions['equalto']['course_category_id'] = Arr::get($this->search,'course_category_id');
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];

        $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.code' => ['required', 'max:25'],
            'fdata.short_name' => ['required', 'max:25'],
            'fdata.description' => ['nullable', 'max:5000'],
            'fdata.approval_id' => ['nullable', 'max:100'],
            'fdata.approval_link' => ['nullable', 'max:500'],
            'fdata.campus_id' => ['required'],
            'fdata.program_category_id' => ['required'],
            'fdata.program_sub_category_id' => ['required'],
            'fdata.program_level_id' => ['required'],
            'fdata.course_type_id' => ['required'],
            'fdata.course_category_id' => ['required'],
            'fdata.active' => ['nullable'],
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Course';

        $messages = [];

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

    public function customEdit()
    {
        
    }     
    
    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getCampusListProperty()
    {
        return Campus::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getProgramCategoryListProperty()
    {
        return ProgramCategory::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getProgramSubCategoryListProperty()
    {
        return ProgramSubCategory::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getProgramLevelListProperty()
    {
        return ProgramLevel::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getCourseTypeListProperty()
    {
        return MasterOption::code('course_type')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }
    
    public function getCourseCategoryListProperty()
    {
        return MasterOption::code('course_category')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }
    public function export() 
    {
        $this->export_fields = 
        [
            'id' => 'ID', 
            'title' => 'Course Name', 
            'program_sub_category.title' => 'Program Subcategory',
            'program_level.title' => 'Program Level',
            'course_type.title' => 'Course Type',
            'course_category.title' => 'Course Duration',
            'code' => 'Course code',
            'active' => 'Active',
            'created_by.name' => 'Created By',
            'created_at_display' => 'Created At',
            'updated_by.name' => 'Updated By',
            'updated_at_display' => 'Updated At',
        ];
        return $this->exportExcel();
    }
}
