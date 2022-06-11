<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class EnrollmentComponentType extends AdminModel
{
    use HasFactory;
    
    protected $table = 'enrollment_component_types';
    protected $fillable = ['enrollment_component_group_id', 'academic_component_type_id', 'maximum_mark', 'due_date', 'active'];
    protected $log_with = ['enrollment_component_group.title', 'academic_component_type.title'];
    
    public function dueDateDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['due_date']) ? __dpDateConvertOrgTZ($this->attributes['due_date']) : '' 
            
        );
    }
    
    public function enrollment_component_group()
    {
        return $this->belongsTo(EnrollmentComponentGroup::class);
    }

    public function academic_component_type()
    {
        return $this->belongsTo(AcademicComponentType::class)->orderBy("sequence_number");
    }

    public function student_mark()
    {
        return $this->belongsTo(StudentMark::class, "id", "enrollment_component_type_id");
    }
}