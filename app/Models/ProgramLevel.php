<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramLevel extends AdminModel
{
    use HasFactory;

    protected $table = 'program_levels';
    protected $fillable = ['title', 'short_name', 'active', 'sequence_number'];

    protected $log_except = ['sequence_number'];
}
