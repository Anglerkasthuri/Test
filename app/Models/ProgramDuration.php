<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramDuration extends AdminModel
{
    use HasFactory;

    protected $table = 'program_durations';
    protected $fillable = ['title', 'years', 'months', 'weeks', 'active'];
}
