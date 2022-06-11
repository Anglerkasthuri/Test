<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradePattern extends AdminModel
{
    use HasFactory;

    protected $table = 'grade_patterns';
    protected $fillable = ['title', 'grade_category_id', 'mark_from', 'mark_to', 'grade_type_id', 'grade_points', 'is_internal', 'is_external', 'is_final', 'active'];
    

    protected $log_with = ['grade_category.title', 'grade_type.title'];

    public function scopeActive($query)
    {
        $query->where('active', 1);
    }
    
    public function scopeInternal($query, $grade_category_id='')
    {
        $query->where('is_internal', 1);
        if($grade_category_id) {
            $query->where('grade_category_id', $grade_category_id);
        }
    }
    
    public function scopeExternal($query, $grade_category_id='')
    {
        $query->where('is_external', 1);
        if($grade_category_id) {
            $query->where('grade_category_id', $grade_category_id);
        }
    }
    
    public function scopeFinal($query, $grade_category_id='')
    {
        $query->where('is_final', 1);
        if($grade_category_id) {
            $query->where('grade_category_id', $grade_category_id);
        }
    }

}

