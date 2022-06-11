<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends AdminModel
{
    use HasFactory;
    
    protected $table = 'courses';
    protected $fillable = ['title', 'active', 'campus_id', 'program_category_id', 'program_sub_category_id', 'program_level_id', 'course_type_id', 'course_category_id', 'code', 'short_name', 'description', 'approval_id', 'approval_link'];
    
    protected $log_except = ['description'];
    protected $log_with = ['campus.title', 'program_category.title', 'program_sub_category.title', 'program_level.title', 'course_type.title', 'course_category.title'];
    
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

    public function course_type()
    {
        return $this->belongsTo(MasterOption::class, 'course_type_id');
    }

    public function course_category()
    {
        return $this->belongsTo(MasterOption::class, 'course_category_id');
    }
}
