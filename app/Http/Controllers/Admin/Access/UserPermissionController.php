<?php

namespace App\Http\Controllers\Admin\Access;

use Illuminate\Support\Arr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;
// use App\Models\Role;
use App\Models\User;

class UserPermissionController extends Controller
{
    public function index($user_id)
    {
        $user = User::findOrFail($user_id);
        // dd($user->permissions);
        $data['type'] = "user_permission";
        $data['page_title'] = "Assign Permissions to User - {$user->name}";
        $data['user'] = $user;
        $data['permissions'] = Permission::pluck('id', 'name')->toArray();
        $data['existing_permission'] = $user->permissions->keyBy('name')->toArray();
        return view('admin.access.permission.permission-create',compact('data'))->layout('app.admin');
    }

    public function store(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);
        if(!empty($user->id)) {
            if(isset($request->permissions) && is_array($request->permissions)) {
                $user->syncPermissions($request->permissions);
            } else {
                $user->syncPermissions([]);
            }
        }
        $message = __('msg.update', ['name' => '']);
        return redirect()->route('user.permissions.index', ["user" => $user_id ])->with('alert_success',$message);
    }
}
