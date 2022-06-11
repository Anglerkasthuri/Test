<?php

namespace App\Http\Livewire\Admin\Masters;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Program;
use App\Models\DegreeAwardingBody;
use App\Models\Campus;
use App\Models\ProgramCategory;
use App\Models\ProgramSubCategory;
use App\Models\ProgramLevel;
use App\Models\ProgramGroup;
use App\Models\ProgramDuration;
use App\Models\MasterOption;
use App\Models\Accreditation;
use App\Models\AcademicPattern;

use App\Models\MailTemplate;

use App\Mail\CommonMail;
use Illuminate\Support\Facades\Mail;

use Arr, DbView;

class Programs extends AdminComponent
{

    public $page_title = "Program";  
    public $program_id;
    public function render()
    {
        if($this->program_id ) {
            $record = $this->model->findOrFail($this->program_id);
            $this->fdata = $record->toArray();
            return view('livewire.admin.masters.program.program-view', compact('record'));
        } else {
            $records = $this->index();
            return view('livewire.admin.masters.program.program-list', compact('records'));
        }
            
    }
 
    public function mount()
    {
        $this->model = new Program;
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
        $conditions['boolean']['active'] = Arr::get($this->search, 'active');
        $conditions['equalto']['degree_name'] = Arr ::get($this->search, 'degree_name');
        $conditions['equalto']['code'] = Arr ::get($this->search, 'code');
        $conditions['equalto']['short_name'] = Arr ::get($this->search, 'short_name');
        $conditions['equalto']['academic_pattern_id'] = Arr ::get($this->search, 'academic_pattern_id');
        $conditions['equalto']['number_of_pattern'] = Arr ::get($this->search, 'number_of_pattern');
        $conditions['equalto']['degree_awarding_body_id'] = Arr ::get($this->search, 'degree_awarding_body_id');
        $conditions['equalto']['campus_id'] = Arr ::get($this->search, 'campus_id');
        $conditions['equalto']['program_category_id'] = Arr ::get($this->search, 'program_category_id');
        $conditions['equalto']['program_sub_category_id'] = Arr ::get($this->search, 'program_sub_category_id');
        $conditions['equalto']['program_level_id'] = Arr ::get($this->search, 'program_level_id');
        $conditions['equalto']['program_group_id'] = Arr ::get($this->search, 'program_group_id');
        $conditions['equalto']['program_type_id'] = Arr ::get($this->search, 'program_type_id');
        $conditions['equalto']['study_mode_id'] = Arr ::get($this->search, 'study_mode_id');
        $conditions['equalto']['program_duration_id'] = Arr ::get($this->search, 'program_duration_id');
        $conditions['equalto']['accreditation_id'] = Arr ::get($this->search, 'accreditation_id');
        return  __reportConditions($query, $conditions);
    }
    
    public function store()
    {
        $this->fdata = collect($this->fdata)->trim();
        $this->fdata['active'] = !empty($this->fdata['active']) ?? "0";
        $rule_set = $this->validation_rules();
        $validatedData = $this->validate($rule_set['rules'], $rule_set['messages'], $rule_set['attributes']);
        $validatedData = $validatedData['fdata'];

       $data_mail =  $this->model->updateOrCreate(['id' => $this->record_id], $validatedData);
       
    //    $template = MailTemplate::first();
    //    $message = (new CommonMail($template, $data_mail))
    //            ->onQueue('emails');
               
    //     Mail::to('ranjith.kumar@texila.org')->queue($message);

        $this->alertMessage();
        $this->makeModalClose();
    }

    public function validation_rules()
    {
        $rules = [
            'fdata.title' => ['required', 'max:100', 'alpha_numeric_with_special_chars', "unique:". $this->model->getTable() .",title,$this->record_id,id"], 
            'fdata.degree_name' => ['required', 'max:100'],
            'fdata.code' => ['required', 'max:25'],
            'fdata.short_name' => ['required', 'alpha_spaces', 'max:25'],
            'fdata.degree_awarding_body_id' => ['required'],
            'fdata.campus_id' => ['required'],
            'fdata.program_category_id' => ['required'],
            'fdata.program_sub_category_id' => ['required'],
            'fdata.program_level_id' => ['required'],
            'fdata.program_group_id' => ['required'],
            'fdata.program_type_id' => ['required'],
            'fdata.study_mode_id' => ['required'],
            'fdata.program_duration_id' => ['required'],
            'fdata.academic_pattern_id' => ['required'],
            'fdata.number_of_pattern' => ['required', 'numeric', 'min:1', 'max:20'],
            'fdata.accreditation_id' => ['required'],
            'fdata.description' => ['nullable', 'max:5000'],
            'fdata.active' => ['nullable'],
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Program';

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

    public function getDegreeAwardingBodyListProperty()
    {
        return DegreeAwardingBody::query()->tobase()->orderBy('title')->pluck('title', 'id');
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
    
    public function getProgramGroupListProperty()
    {
        return ProgramGroup::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getProgramTypeListProperty()
    {
        return MasterOption::code('program_type')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }
    
    public function getStudyModeListProperty()
    {
        return MasterOption::code('study_mode')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }
    
    public function getProgramDurationListProperty()
    {
        return ProgramDuration::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getAcademicPatternListProperty()
    {
        return AcademicPattern::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getAccreditationListProperty()
    {
        return Accreditation::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    //in Filter
    public function getSearchprogramSubCategoryListProperty()
    {
        return ProgramSubCategory::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function getSearchprogramLevelListProperty()
    {
        return ProgramLevel::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getSearchprogramTypeListProperty()
    {
        return MasterOption::code('program_type')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }
    
    public function getSearchprogramDurationListProperty()
    {
        return ProgramDuration::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }
    
    public function getSearchAcademicPatternListProperty()
    {
        return AcademicPattern::query()->tobase()->orderBy('title')->pluck('title', 'id');
    }

    public function export() 
    {
        $this->export_fields = 
        [
            'id' => 'ID', 
            'title' => 'Program Name', 
            'program_sub_category.title' => 'Program Subcategory',
            'program_level.title' => 'Program Level',
            'program_type.title' => 'Program Type',
            'program_duration.title' => 'Program Duration',
            'academic_pattern.title' => 'Academic Pattern',
            'number_of_pattern' => 'Number of Pattern',
            'active' => 'Active',
            'created_by.name' => 'Created By',
            'created_at_display' => 'Created At',
            'updated_by.name' => 'Updated By',
            'updated_at_display' => 'Updated At',
        ];
      
        return $this->exportExcel();
    }
    
}
