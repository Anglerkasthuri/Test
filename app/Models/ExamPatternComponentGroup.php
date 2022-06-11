<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPatternComponentGroup extends AdminModel
{
   use HasFactory;
    protected $table = 'exam_pattern_component_groups';
    protected $fillable = ['exam_pattern_id', 'academic_component_group_id', 'contribution_percentage', 'active'];
    protected $log_with = ['exam_pattern.title', 'academic_component_group.title'];

    public function exam_pattern()
    {
        return $this->belongsTo(ExamPattern::class);
    }

    public function academic_component_group()
    {
        return $this->belongsTo(AcademicComponentGroup::class);
    }

    public function exam_pattern_component_types()
    {
        return $this->hasMany(ExamPatternComponentType::class);
    }
}
