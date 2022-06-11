<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accreditation extends AdminModel
{
    use HasFactory;

    protected $table = 'accreditations';
    protected $fillable = ['title', 'address', 'country_id', 'contact_number1', 'contact_number2', 'whatsapp_number', 'fax_number', 'email_address', 'skype', 'expiry_date', 'active'];

    protected $log_with = ['country.title'];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
}
