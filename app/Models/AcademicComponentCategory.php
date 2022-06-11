<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicComponentCategory extends AdminModel
{
    use HasFactory;

    protected $table = 'academic_component_categories';
    protected $fillable = ['title', 'active'];
}
