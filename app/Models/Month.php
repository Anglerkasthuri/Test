<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends AdminModel
{
    use HasFactory;

    protected $table = 'months';

    protected $fillable = ['title', 'code', 'sequence_number', 'active'];
    
}
