<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Country extends AdminModel
{
    use HasFactory;

    protected $table = 'countries';
    protected $fillable = ['title', 'nationality', 'continent_id', 'sub_continent_id', 'timezone_id', 'dial_code', 'iso2_code', 'iso3_code', 'active'];

    protected $appends = ['created_at_display', 'updated_at_display'];

    // protected $log_disabled = true;
    //protected $log_only = ['title'

    protected $log_with = ['continent.title', 'sub_continent.title', 'timezone.title'];

    public function continent()
    {
        return $this->belongsTo(Continent::class);
    }
    
    public function sub_continent()
    {
        return $this->belongsTo(SubContinent::class);
    }

    public function timezone()
    {
        return $this->belongsTo(Timezone::class);
    }    
}