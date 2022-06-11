<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterOption extends AdminModel
{
    use HasFactory;

    protected $table = 'master_options';
    protected $fillable = ['title', 'code', 'parent_option_id', 'master_category_id', 'campus_id', 'description', 'active', 'sequence_number'];

    protected $log_except = ['description', 'sequence_number'];
    protected $log_with = ['master_category.title', 'campus.title', 'parent_option.title'];

    public function master_category()
    {
        return $this->belongsTo(MasterCategory::class);
    }

    public function parent_option()
    {
        return $this->belongsTo(MasterOption::class);
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function scopeCode($query, $master_category_code)
    {
        /*        
        Usage
        MasterOption::code('gender')->order()->pluck('title', 'id');
        */
        
        $query->whereHas('master_category', function($query) use ($master_category_code)  
        {
            $query->where('code', $master_category_code);
        });

        /* Alternate Method */
        // $code_det = MasterCategory::getMasterCategoryId($master_category_code);
        // $query->where('master_category_id', $code_det->id ?? 0);
    }

    public function scopeOrder($query, $field='sequence_number', $direction='ASC')
    {
        $query->orderBy($field, $direction);
    }

    public static function getMasterOptions($master_category_code)
    {
        /*        
        Usage
        MasterOption::getMasterOptions('gender')->pluck('title', 'id');
        */

        $result = [];

        $code_det = MasterCategory::getMasterCategoryId($master_category_code);
        return MasterOption::where('master_category_id', $code_det->id ?? 0)->get();
        
        // Alternate Method
        // $result = MasterOption::whereHas('master_category', function($query) use ($master_category_code)  
        // {
        //     $query->where('code', $master_category_code);
        // })->get();
    }

}
