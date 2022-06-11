<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timezone extends AdminModel
{
    use HasFactory;
    
    protected $table = 'timezones';

    protected $fillable = ['title', 'gmt_sign', 'gmt_hour', 'gmt_min', 'utc', 'active'];
}
