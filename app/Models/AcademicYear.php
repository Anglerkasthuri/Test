<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends AdminModel
{
    use HasFactory;

    protected $table = 'academic_years';
    protected $fillable = ['title', 'active'];
}
