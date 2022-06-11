<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class StudentMarkDetail extends AdminModel
{
    use HasFactory;

    protected $table = 'student_mark_details';
    protected $fillable = ['uuid', 'student_mark_id', 'student_id', 'is_absent', 'individual_exam_date', 'mark', 'active'];

    protected $log_with = ['student.name'];

    public function individualExamDateDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['individual_exam_date']) ? __dpDateConvertOrgTZ($this->attributes['created_at']) : '' 
            
        );
    }

    public function student_mark()
    {
        return $this->belongsTo(StudentMark::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }

   
}

