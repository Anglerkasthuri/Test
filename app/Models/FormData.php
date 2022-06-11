<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormData extends AdminModel
{
    use HasFactory;
    
    protected $table = 'form_datas';
    protected $fillable = ['form_id', 'formable_type', 'formable_id', 'data', 'active']; 
    
    protected $log_with = ['form.title'];
    
    protected $casts = [
        'data' => 'object',
    ];

    public function form()
    {
        return $this->belongsTo(Form::class);
    }
  
    public function formable()
    {
        return $this->morphTo();
    }

}