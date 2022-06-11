<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSubCategory extends AdminModel
{
    use HasFactory;

    protected $table = 'program_sub_categories';

    protected $fillable = ['title', 'program_category_id', 'short_name', 'sequence_number', 'active'];

    protected $log_except = ['sequence_number'];
    protected $log_with = ['program_category.title'];

    public function program_category()
    {
        return $this->belongsTo(ProgramCategory::class);
    }
}
