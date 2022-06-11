<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentComponentGroup extends AdminModel
{
   use HasFactory;
    protected $table = 'enrollment_component_groups';
    protected $fillable = ['enrollment_course_id', 'academic_component_group_id', 'contribution_percentage', 'active'];
    protected $log_with = ['enrollment_course.title', 'academic_component_group.title'];

    public function enrollment_course()
    {
        return $this->belongsTo(EnrollmentCourse::class);
    }

    public function academic_component_group()
    {
        return $this->belongsTo(AcademicComponentGroup::class)->orderBy("sequence_number");
    }

    public function enrollment_component_types()
    {
        return $this->hasMany(EnrollmentComponentType::class);
    }

    public function student_group_wise_marks()
    {
        return $this->hasMany(StudentGroupWiseMark::class);
    }
    
}
