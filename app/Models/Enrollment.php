<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Enrollment extends AdminModel
{
    use HasFactory;

    protected $table = 'enrollments';
    protected $fillable = [ 'title', 'campus_id', 'program_id', 'grade_category_id', 'academic_year_id', 'academic_pattern_id', 'academic_pattern_number', 'batch_id', 'duration_from', 'duration_to', 'remarks', 'medium_of_instruction_id', 'enrollment_type_id', 'enrollment_status_id', 'active' ];

    protected $log_with = [ 'campus.title', 'program.title', 'grade_category.title', 'academic_year.title', 'academic_pattern.itle', 'batch.title', 'medium_of_instruction.title', 'enrollment_type.title', 'enrollment_status.title' ];
    
    
    public function durationFromDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['duration_from']) ? __dpDateConvertOrgTZ($this->attributes['created_at']) : '' 
            
        );
    }

      
    public function durationToDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['duration_to']) ? __dpDateConvertOrgTZ($this->attributes['created_at']) : '' 
            
        );
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function program()
    {
        return $this->belongsTo(Program::class);
    }

    public function grade_category()
    {
        return $this->belongsTo(GradeCategory::class);
    }

    public function academic_year()
    {
        return $this->belongsTo(AcademicYear::class);
    }

    public function academic_pattern()
    {
        return $this->belongsTo(AcademicPattern::class);
    }

    public function batch()
    {
        return $this->belongsTo(CombinedIntake::class);
    }
    
    public function medium_of_instruction()
    {
        return $this->belongsTo(MasterOption::class, 'medium_of_instruction_id');
    }

    public function enrollment_type()
    {
        return $this->belongsTo(MasterOption::class, 'enrollment_type_id');
    }

    public function enrollment_status()
    {
        return $this->belongsTo(MasterOption::class, 'enrollment_status_id');
    }

    public function enrollment_courses()
    {
        return $this->hasMany(EnrollmentCourse::class);
    }

    public function enrollment_students()
    {
        return $this->hasMany(EnrollmentStudent::class);
    }
}
