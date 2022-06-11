<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class StudentMark extends AdminModel
{
    use HasFactory;

    protected $table = 'student_marks';
    protected $fillable = ['uuid', 'enrollment_course_id', 'enrollment_component_type_id', 'exam_date', 'active'];

    public function examDateDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['exam_date']) ? __dpDateConvertOrgTZ($this->attributes['created_at']) : '' 
            
        );
    }

    public function enrollment_component_type()
    {
        return $this->belongsTo(EnrollmentComponentType::class);
    }

    public function enrollment_course()
    {
        return $this->belongsTo(EnrollmentCourse::class);
    }
    
    public function student_mark_details()
    {
        return $this->hasMany(StudentMarkDetail::class);
    }
}

