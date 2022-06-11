<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Student extends AdminModel
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = ['title', 'email', 'first_name', 'last_name', 'gender_id', 'date_of_birth', 'country_id', 'mobile_number', 'alternative_mobile_1','alternative_mobile_2', 'alternative_email_1', 'alternative_email_2', 'skype_id', 'whatsapp_number', 'blood_group_id', 'natinality_id', 'community', 'caste', 'religion', 'ethnicity', 'language_known', 'active'];
    

    protected $log_with = ['gender.title', 'country.title', 'blood_group.title', 'natinality.title'];

    // protected function title(): Attribute
    // {
       
    //     return Attribute::make(
    //         set: function  ($value) {
    //              return $this->first_name." ".$this->last_name; }
    //     );
    // }

    // public function setTitleAttribute()
    // {
    //     $this->attributes['title'] = $this->attributes['first_name']." ".$this->attributes['last_name'];
    // }    

    public function authuser()
    {
        return $this->morphOne('App\Models\User', 'authenticable');
    }
    
    public function country()
    {
        return $this->belongsTo(Counry::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Counry::class);
    }

    public function gender()
    {
        return $this->belongsTo(MasterOption::class, 'gender_id');
    }

    public function blood_group()
    {
        return $this->belongsTo(MasterOption::class, 'blood_group_id');
    }    
    
}
