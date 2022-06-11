<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GradeType extends AdminModel
{
    use HasFactory;

    protected $table = 'grade_types';
    protected $fillable = ['title', 'code', 'description', 'active', 'sequence_number'];
    
    protected $log_except = ['description', 'sequence_number'];
}
