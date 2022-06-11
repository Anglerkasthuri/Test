<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends AdminModel
{
    use HasFactory;
    
    protected $table = 'programs';

    protected $fillable = ['title', 'degree_name', 'crm_program_name', 'code', 'short_name', 'degree_awarding_body_id', 'campus_id', 'program_category_id', 'program_sub_category_id', 'program_level_id', 'program_group_id', 'program_type_id', 'study_mode_id', 'program_duration_id', 'academic_pattern_id', 'number_of_pattern', 'accreditation_id', 'description', 'active'];

    protected $log_except = ['description'];
    protected $log_with = ['degree_awarding_body.title', 'campus.title', 'program_category.title', 'program_sub_category.title', 'program_level.title', 'program_group.title', 'program_type.title', 'study_mode.title', 'program_duration.title', 'academic_pattern.title', 'accreditation.title'];
    
    public function degree_awarding_body()
    {
        return $this->belongsTo(DegreeAwardingBody::class);
    }
    
    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function program_category()
    {
        return $this->belongsTo(ProgramCategory::class);
    }

    public function program_sub_category()
    {
        return $this->belongsTo(ProgramSubCategory::class);
    }

    public function program_level()
    {
        return $this->belongsTo(ProgramLevel::class);
    }

    public function program_group()
    {
        return $this->belongsTo(ProgramGroup::class);
    }

    public function program_type()
    {
        return $this->belongsTo(MasterOption::class, 'program_type_id');
    }

    public function study_mode()
    {
        return $this->belongsTo(MasterOption::class, 'study_mode_id');
    }

    public function program_duration()
    {
        return $this->belongsTo(ProgramDuration::class);
    }

    public function academic_pattern()
    {
        return $this->belongsTo(MasterOption::class, 'academic_pattern_id');
    }

    public function accreditation()
    {
        return $this->belongsTo(Accreditation::class);
    }

}