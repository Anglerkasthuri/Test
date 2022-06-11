<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormField extends AdminModel
{
    use HasFactory;
    
    protected $table = 'form_fields';
    protected $fillable = ['title', 'form_id', 'form_field_type_id', 'form_dropdown_type_id', 'master_category_id', 'system_model_id', 'is_required', 'show_in_filter', 'sequence_number', 'active']; 

    protected $log_with = ['form.title', 'form_field_type.title', 'form_dropdown_type.title', 'master_category.title','system_model.title',];
    
    
    public function form()
    {
        return $this->belongsTo(Form::class);
    }
    
    public function form_field_type()
    {
        return $this->belongsTo(FormFieldType::class);
    }

    public function form_dropdown_type()
    {
        return $this->belongsTo(FormDropdownType::class);
    }

    public function master_category()
    {
        return $this->belongsTo(MasterCategory::class);
    }

    public function system_model()
    {
        return $this->belongsTo(SystemModel::class)->orderBy("title");
    }
    
    public function master_options()
    {
        return $this->hasMany(MasterOption::class, "master_category_id", "master_category_id");
    }
}