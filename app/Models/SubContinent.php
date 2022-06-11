<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubContinent extends AdminModel
{
    use HasFactory;

    protected $table = 'sub_continents';

    protected $fillable = ['title', 'continent_id', 'active'];
    
    protected $log_with = ['continent.title'];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }
    
}
