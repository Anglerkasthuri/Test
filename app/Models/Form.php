<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends AdminModel
{
    use HasFactory;
    
    protected $table = 'forms';
    protected $fillable = ['title', 'sub_title', 'form_instruction', 'description', 'active'];

    protected $log_except = ['description'];
    
    public function form_fields()
    {
        return $this->hasMany(FormField::class)->orderBy("sequence_number");
    }

    public function formdata()
    {
        return $this->morphMany('App\Models\FormData', 'formable');
    }

}