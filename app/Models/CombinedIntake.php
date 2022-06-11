<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CombinedIntake extends AdminModel
{
    use HasFactory;

    protected $table = 'combined_intakes';

    protected $fillable = ['title', 'month_id', 'year','active'];

    protected $log_with = ['month.title'];
    
    public function month()
    {
        return $this->belongsTo(Month::class);
    }

}
