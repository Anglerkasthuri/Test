<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentStudent extends AdminModel
{
    use HasFactory;
    
    protected $table = 'enrollment_students';
    protected $fillable = [ 'enrollment_id', 'student_id',  'active' ];

    protected $log_with = [ 'enrollment.title', 'student.title'];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class)->orderBy("title", "ASC");
    }

    public function enrollment_course()
    {
        return $this->hasMany(EnrollmentCourse::class, 'enrollment_id', 'enrollment_id');
    }
}
