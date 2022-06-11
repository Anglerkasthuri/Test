<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicComponentType extends AdminModel
{
    use HasFactory;

    protected $table = 'academic_component_types';
    protected $fillable = ['title', 'campus_id', 'academic_component_group_id', 'academic_component_category_id', 'sequence_number', 'active'];

    protected $log_with = ['campus.title','academic_component_group.title','academic_component_category.title'];

    public function academic_component_group()
    {
        return $this->belongsTo(AcademicComponentGroup::class);
    }
    
    public function academic_component_category()
    {
        return $this->belongsTo(AcademicComponentCategory::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

}