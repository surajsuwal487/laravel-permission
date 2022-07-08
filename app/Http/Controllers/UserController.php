<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function viewUsers(Request $request)
    {
        try {
            $users = User::all();
            return view('users.view-users', compact('users'));
        } catch (\Exception $e) {
            $exception = $e->getMessage();
            dd($e->getMessage());
            return redirect()->back()->with('error', $exception);
        }
    }

    public function show(User $user)
    {
        $roles = Role::all();
        $permissions = Permission::all();

        return view('users.role', compact('user', 'roles', 'permissions'));
    }

    public function assignRole(Request $request, User $user)
    {

        // dd($request->id);
        // $user = User::where('id', $request->id)->first();
        if ($user->hasRole($request->role)) {
            return back();
        }
        $user->assignRole($request->role);
        return back();
    }

    public function removeRole(User $user, Role $role)
    {
        if ($user->hasRole($role)) {
            $user->removeRole($role);
            return back();
        }
        return back();
    }
}
