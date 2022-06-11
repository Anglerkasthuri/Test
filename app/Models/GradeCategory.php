<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeCategory extends AdminModel
{
    use HasFactory;

    protected $table = 'grade_categories';
    protected $fillable = ['title', 'internal_calculation_available', 'external_calculation_available', 'final_calculation_available', 'active'];
}
