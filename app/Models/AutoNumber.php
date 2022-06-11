<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AutoNumber extends AdminModel
{
    use HasFactory;

    protected $table = 'auto_numbers';
    protected $fillable = ['model_name', 'field_name', 'prefix', 'last_seqence'];

}
