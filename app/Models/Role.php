<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Spatie\Permission\Models\Role as SpatieRole;

class Role extends SpatieRole
{
    use HasFactory;

    protected $table = 'roles';
    protected $fillable = ['uuid', 'name', 'guard_name', 'description', 'active', 'created_by_id', 'updated_by_id'];

    private $admin_model;

    protected $log_except = ['description'];
    protected $log_with = ['created_by.title', 'updated_by.title'];

}
