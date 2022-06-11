<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicComponentGroup extends AdminModel
{
    use HasFactory;

    protected $table = 'academic_component_groups';
    protected $fillable = ['title', 'academic_component_category_id', 'sequence_number', 'active'];

    public function academic_component_category()
    {
        return $this->belongsTo(AcademicComponentCategory::class);
    }
    
    public function academic_component_types()
    {
        return $this->hasMany(AcademicComponentType::class);
    }

}
