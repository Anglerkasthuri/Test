<?php

namespace App\Http\Controllers\Admin\Access;

use Illuminate\Support\Arr;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Permission;
use App\Models\Role;

class PermissionController extends Controller
{
    public function index()
    {
        $data = [];
        $data['type'] = "permission";
        $data['page_title'] = "Sync Permissions";
        // $data['permissions'] = Permission::select('id', 'name')->get()->keyBy('name')->toArray();
        $data['permissions'] = Permission::pluck('id', 'name')->toArray();
        return view('admin.access.permission.permission-create',compact('data'))->layout('app.admin');
    }

    public function store(Request $request)
    {
        if(isset($request->permissions) && is_array($request->permissions) ) {
            [$key, $permissions] = Arr::divide($request->permissions);

            foreach($permissions as $permission) {
                $permission = Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
            }
        }
        $message = __('msg.update', ['name' => '']);
        return redirect()->route('permission.index')->with('alert_success',$message);
    }

}
