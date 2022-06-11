<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicPattern extends AdminModel
{
    use HasFactory;

    protected $table = 'academic_patterns';
    protected $fillable = ['title', 'active'];
}