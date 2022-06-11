<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterGroup extends AdminModel
{
    use HasFactory;

    protected $table = 'master_groups';
    protected $fillable = ['title', 'description', 'active', 'sequence_number'];
    
    protected $log_except = ['description', 'sequence_number'];
    
    public function master_category() {
        return $this->hasMany(MasterCategory::class);
    }
}
