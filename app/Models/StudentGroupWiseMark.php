<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentGroupWiseMark extends AdminModel
{
    use HasFactory;

    protected $table = 'student_group_wise_marks';
    protected $fillable = ['uuid', 'enrollment_component_group_id', 'student_id', 'converted_mark', 'active'];

    protected $log_with = ['student.title'];
    
    public function enrollment_component_group()
    {
        return $this->belongsTo(EnrollmentComponentGroup::class);
    }

    public function student()
    {
        return $this->belongsTo(Student::class, "student_id");
    }
  
}
