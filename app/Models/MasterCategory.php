<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class MasterCategory extends AdminModel
{
    use HasFactory;

    protected $table = 'master_categories';
    
    protected $fillable = ['title', 'code', 'master_group_id', 'is_dependent', 'parent_category_id', 'description', 'show_in_form', 'active', 'sequence_number'];

    // protected $log_disabled = true;
    //protected $log_only = ['title', 'code'];
    protected $log_except = ['description', 'sequence_number'];
    protected $log_with = ['master_group.title', 'parent_category.title'];

    public function master_group()
    {
        return $this->belongsTo(MasterGroup::class);
    }

    public function parent_category()
    {
        return $this->belongsTo(MasterCategory::class);
    }

    public function master_option()
    {
        return $this->hasMany(MasterOption::class);
    }

    public static function getMasterCategoryId($master_category_code)
    {
        return MasterCategory::where('code', $master_category_code)->first();
    }
        
}
