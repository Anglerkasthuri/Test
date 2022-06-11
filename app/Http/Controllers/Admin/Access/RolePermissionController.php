<?php

namespace App\Http\Controllers\Admin\Access;

use Illuminate\Support\Arr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;
use App\Models\Role;

class RolePermissionController extends Controller
{
    public function index($role_id)
    {
        $role = Role::findOrFail($role_id);

        $data['type'] = "role_permission";
        $data['page_title'] = "Assign Permissions to Role - {$role->name}";
        $data['role'] = $role;
        $data['permissions'] = Permission::pluck('id', 'name')->toArray();
        $data['existing_permission'] = $role->permissions->keyBy('name')->toArray();
        return view('admin.access.permission.permission-create',compact('data'))->layout('app.admin');
    }

    public function store(Request $request, $role_id)
    {
        $role = Role::findOrFail($role_id);
        if(!empty($role->id)) {
            if(isset($request->permissions) && is_array($request->permissions)) {
                $role->syncPermissions($request->permissions);
            } else {
                $role->syncPermissions([]);
            }
        }
        $message = __('msg.update', ['name' => '']);
        return redirect()->route('role.permissions.index', ["role" => $role_id ])->with('alert_success',$message);
    }
}
