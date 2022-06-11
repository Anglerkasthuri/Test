<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class StudentCourseWiseMark extends AdminModel
{
    use HasFactory;

    protected $table = 'student_course_wise_marks';
    protected $fillable = ['uuid', 'enrollment_course_id', 'student_id', 'internal_mark', 'external_mark', 'final_mark', 'active'];

    protected $log_with = ['student.title'];

    public function enrollment_course()
    {
        return $this->belongsTo(EnrollmentCourse::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }

    protected function internalMark(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => round($value, 2),
        );
    }

    protected function externalMark(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => round($value, 2),
        );
    }

    protected function finalMark(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => round($value, 2),
        );
    }
}
