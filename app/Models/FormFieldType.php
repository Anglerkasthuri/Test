<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormFieldType extends AdminModel
{
    use HasFactory;
    
    protected $table = 'form_field_types';
    protected $fillable = ['title', 'code', 'sequence_number', 'active']; 
    //INSERT INTO `form_field_types` (`id`, `uuid`, `title`, `code`, `sequence_number`, `active`, `created_by_id`, `updated_by_id`, `created_at`, `updated_at`, `deleted_by_id`, `deleted_at`) VALUES (NULL, '1', 'DropDown', 'select', '1', '1', NULL, NULL, NULL, NULL, NULL, NULL), (NULL, '2', 'Text', 'text', '2', '1', NULL, NULL, NULL, NULL, NULL, NULL), (NULL, '3', 'Textarea', 'textarea', '3', '1', NULL, NULL, NULL, NULL, NULL, NULL), (NULL, '4', 'Number', 'number', '4', '1', NULL, NULL, NULL, NULL, NULL, NULL), (NULL, '5', 'Label', 'label', '5', '1', NULL, NULL, NULL, NULL, NULL, NULL), (NULL, '6', 'Heading', 'heading', '6', '1', NULL, NULL, NULL, NULL, NULL, NULL);

}
 