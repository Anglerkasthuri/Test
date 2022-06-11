<?php

namespace App\Http\Livewire\Admin\Enrollments;

use App\Http\Livewire\AdminComponent as AdminComponent;

use App\Models\Enrollment;
use App\Models\Campus;
use App\Models\Program;
use App\Models\GradeCategory;
use App\Models\AcademicYear;
use App\Models\AcademicPattern;
use App\Models\CombinedIntake;
use App\Models\MasterOption;
use Carbon\Carbon;

use Arr;

class Enrollments extends AdminComponent
{

    public $page_title = "Enrollment";  

    public function render()
    {
        $records = $this->index();
        return view('livewire.admin.enrollments.enrollment.enrollment-list', compact('records'));
    }

    public function mount()
    {
        $this->model = new Enrollment;
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
        $conditions['equalto']['campus_id'] = Arr::get($this->search, 'campus_id');
        $conditions['equalto']['program_id'] = Arr::get($this->search, 'program_id');
        $conditions['equalto']['academic_year_id'] = Arr::get($this->search, 'academic_year_id');
        $conditions['equalto']['academic_pattern_number'] = Arr::get($this->search, 'academic_pattern_number');
        $conditions['equalto']['academic_pattern_id'] = Arr::get($this->search, 'academic_pattern_id');
        $conditions['equalto']['batch_id'] = Arr::get($this->search, 'batch_id');
        $conditions['gte']['duration_from'] = Arr::get($this->search, 'duration_start_from');
        $conditions['lte']['duration_from'] = Arr::get($this->search, 'duration_end_from');
        $conditions['gte']['duration_to'] = Arr::get($this->search, 'duration_start_to');
        $conditions['lte']['duration_to'] = Arr::get($this->search, 'duration_end_to');
        
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
            'fdata.campus_id' => ['required'],
            'fdata.program_id' => ['required'],
            'fdata.grade_category_id' => ['required'],
            'fdata.academic_year_id' => ['required'],
            'fdata.academic_pattern_id' => ['required'],
            'fdata.academic_pattern_number' => ['required','numeric', 'max:100'],
            'fdata.batch_id' => ['required'],
            'fdata.duration_from' => ['required', 'date'],
            'fdata.duration_to' => ['required', 'date', 'after_or_equal:fdata.duration_from'],
            'fdata.medium_of_instruction_id' => ['required'],
            'fdata.enrollment_type_id' => ['required'],
            'fdata.active' => ['nullable'],
            'fdata.remarks' => ['nullable'],
        ];
        
        $attributes = __getAttributesFromNested($rules);
        $attributes['fdata.title'] = 'Enrollment';

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
        $from_date = Carbon::parse($this->fdata['duration_from']);
        $to_date = Carbon::parse($this->fdata['duration_to']);
        
        $duration = ($from_date.' - '.$to_date);

        $this->fdata['duration'] = $duration;
    }     
    
    public function delete($id)
    {
        //$this->model->where('id', $id)->delete();
    }

    public function getSearchCampusListProperty()
    {
        return Campus::query()->tobase()->pluck('title', 'id');
    }
    
    public function getCampusListProperty()
    {
        return Campus::query()->tobase()->pluck('title', 'id');
    }
    
    public function getSearchProgramListProperty()
    {
        return Program::query()->tobase()->pluck('title', 'id');
    }

    public function getProgramListProperty()
    {
        return Program::query()->tobase()->where('campus_id', $this->fdata['campus_id'] ?? 0)->pluck('title', 'id');
    }

    public function getGradeCategoryListProperty()
    {
        return GradeCategory::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchAcademicYearListProperty()
    {
        return AcademicYear::query()->tobase()->pluck('title', 'id');
    }

    public function getAcademicYearListProperty()
    {
        return AcademicYear::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchAcademicPatternListProperty()
    {
        return AcademicPattern::query()->tobase()->pluck('title', 'id');
    }

    public function getAcademicPatternListProperty()
    {
        return AcademicPattern::query()->tobase()->pluck('title', 'id');
    }

    public function getSearchBatchListProperty()
    {
        return CombinedIntake::query()->tobase()->pluck('title', 'id');
    }

    public function getBatchListProperty()
    {
        return CombinedIntake::query()->tobase()->pluck('title', 'id');
    }

    public function getMediumOfInstructionListProperty()
    {
        return MasterOption::code('medium_of_instruction')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }

    public function getEnrollmentTypeListProperty()
    {
        return MasterOption::code('enrollment_type')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }

    public function getEnrollmentStatusListProperty()
    {
        return MasterOption::code('enrollment_status')->tobase()->orderBy('sequence_number')->pluck('title', 'id');
    }

    public function updated($name, $value)
    {
        if($name === "fdata.campus_id") {
            Arr::set($this->fdata, 'program_id', null);
        }
        // if($name === "fdata.duration") {
        //     $duration = explode(' - ', $value);

        //     $from_date = Carbon::createFromFormat('d/m/Y', $duration[0])->format('Y-m-d');

        //     $to_date = Carbon::createFromFormat('d/m/Y', $duration[1])->format('Y-m-d');

        //     Arr::set($this->fdata, 'duration_from', $from_date);
        //     Arr::set($this->fdata, 'duration_to', $to_date);
            
            
        // }
    }    

}
