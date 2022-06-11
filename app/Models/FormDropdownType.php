<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormDropdownType extends AdminModel
{
    use HasFactory;
    
    protected $table = 'form_dropdown_types';
    protected $fillable = ['title', 'code', 'sequence_number', 'active']; 
    //INSERT INTO `form_dropdown_types` (`id`, `uuid`, `title`, `code`, `sequence_number`, `active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_by_id`, `deleted_at`) VALUES (NULL, '1', 'Common Master', 'master_category', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL), (NULL, '2', 'System Master', 'system_model', NULL, '1', NULL, NULL, NULL, NULL, NULL, NULL);
}
 