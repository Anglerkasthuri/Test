<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramCategory extends AdminModel
{
    use HasFactory;

    protected $table = 'program_categories';
    protected $fillable = ['title', 'short_name', 'sequence_number', 'active'];

    protected $log_except = ['sequence_number'];
}
