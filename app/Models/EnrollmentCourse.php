<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentCourse extends AdminModel
{
    use HasFactory;
    
    protected $table = 'enrollment_courses';
    protected $fillable = [ 'enrollment_id', 'course_id', 'credited_hours', 'exam_pattern_id', 'active' ];

    protected $log_with = [ 'enrollment.title', 'course.title'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function student_mark()
    {
        return $this->hasMany(StudentMark::class);
    }

    public function enrollment_component_groups()
    {
        return $this->hasMany(EnrollmentComponentGroup::class);
    }

    public function student_course_wise_marks()
    {
        return $this->hasMany(StudentCourseWiseMark::class);
    }

}



