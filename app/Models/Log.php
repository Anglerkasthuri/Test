<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Log extends Model
{
    use HasFactory;

    protected $table = 'activity_log';

    protected $fillable = ['id', 'log_name', 'description', 'subject_type', 'event', 'subject_id', 'causer_type', 'causer_id', 'properties', 'batch_uuid', 'created_at'];

    protected $casts = [
        'properties' => 'object'
    ]; 

    public function causerable()
    {
        return $this->morphTo(__FUNCTION__, 'causer_type', 'causer_id');
    }

    public function createdAtDisplay(): Attribute
    {
        return Attribute::make(
            get: fn ($value, $attributes) => isset($this->attributes['created_at']) ? __dpDatetimeConvertOrgTZ($this->attributes['created_at']) : '' 
            
        );
    }

    // protected function getCreatedAtDisplayAttribute()
    // {
    //     return isset($this->attributes['created_at']) ? __dpDatetimeConvertOrgTZ($this->attributes['created_at']) : ''; 
    // }

}
