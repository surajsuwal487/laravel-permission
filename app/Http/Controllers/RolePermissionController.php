<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Repository\RoleRepository;

class RolePermissionController extends Controller
{
    protected  $roleRepository;
    public function __construct(RoleRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function viewRoles(Request $request)
    {
        try {
            $roles = Role::WhereNotIn('name', ['admin'])->get();
            return view('admin.view-roles', compact('roles'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }
    public function viewPermissions(Request $request)
    {
        try {
            $permissions = Permission::all();
            return view('admin.view-permissions', compact('permissions'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function editRole(Request $request)
    {
        try {
            $permissions = Permission::all();
            $role = Role::findorfail($request->id);
            return view('admin.edit-role', compact('role', 'permissions'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function updateRole(Request $request)
    {
        $student = $this->roleRepository->getById($request->id);

        $data = [
            'name' => $request->name,
        ];

        $this->roleRepository->update($request->id, $data);


        return redirect()->route('view_roles');
    }

    public function givePermission(Request $request)
    {

        $role = Role::where('id', $request->id)->first();
        if ($role->hasPermissionTo($request->permission)) {
            return back();
        }
        $role->givePermissionTo($request->permission);
        return back();
    }

    public function removePermission(Role $role, Permission $permission){
        if($role->hasPermissionTo($permission)){
            $role->revokePermissionTo($permission);
            return back();
        }
    }

    
}
