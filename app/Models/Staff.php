<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Staff extends AdminModel
{
    use HasFactory;

    protected $table = 'staffs';
    protected $fillable = ['title', 'email', 'date_of_joined', 'employee_code', 'gender_id', 'date_of_birth', 'staff_type_id', 'work_type_id', 'active'];
   
    protected $log_with = ['gender.title', 'staff_type.title', 'work_type.title'];
    public function dateOfJoinedDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['date_of_joined']) ? __dpDateConvertOrgTZ($this->attributes['date_of_joined']) : '' 
            
        );
    }

    public function dateOfBirthDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['date_of_birth']) ? __dpDateConvertOrgTZ($this->attributes['date_of_birth']) : '' 
            
        );
    }


    public function authuser()
    {
        return $this->morphOne('App\Models\User', 'authenticable');
    }

    public function nationality()
    {
        return $this->belongsTo(Counry::class);
    }

    public function gender()
    {
        return $this->belongsTo(MasterOption::class);
    }

    public function work_type()
    {
        return $this->belongsTo(MasterOption::class);
    }

    public function staff_type()
    {
        return $this->belongsTo(MasterOption::class);
    }
}
