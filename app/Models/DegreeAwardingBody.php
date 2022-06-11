<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DegreeAwardingBody extends AdminModel
{
    use HasFactory;

    protected $table = 'degree_awarding_bodies';
    protected $fillable = ['title', 'active'];
}
