<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campus extends AdminModel
{
    use HasFactory;
  
    protected $table = 'campuses';

    protected $fillable = ['title', 'short_name', 'deferment_duration_days', 'active', 'sequence_number'];

    protected $log_except = ['sequence_number'];
}
