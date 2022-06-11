<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemModel extends AdminModel
{
    use HasFactory;
    
    protected $table = 'system_models';
    protected $fillable = ['title', 'model_name', 'field_name', 'show_in_form', 'active']; 
    
}
 