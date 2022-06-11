<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Continent extends AdminModel
{
    use HasFactory;

    protected $table = 'continents';

    protected $fillable = ['title', 'active'];

}
