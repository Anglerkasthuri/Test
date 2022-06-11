<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramGroup extends AdminModel
{
    use HasFactory;

    protected $table = 'program_groups';
    protected $fillable = ['title', 'active'];

}
