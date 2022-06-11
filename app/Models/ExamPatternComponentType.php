<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamPatternComponentType extends AdminModel
{
    use HasFactory;
    
    protected $table = 'exam_pattern_component_types';
    protected $fillable = ['exam_pattern_component_group_id', 'academic_component_type_id', 'maximum_mark', 'active'];
    protected $log_with = ['exam_pattern_component_group.title', 'academic_component_type.title'];

    public function exam_pattern_component_group()
    {
        return $this->belongsTo(ExamPatternComponentGroup::class);
    }

    public function academic_component_type()
    {
        return $this->belongsTo(academicComponentType::class);
    }

}