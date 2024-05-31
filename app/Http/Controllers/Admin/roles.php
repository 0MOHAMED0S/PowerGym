<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class roles extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');

    $roles = Role::where(function ($q) use ($query) {
        $q->where('name', 'LIKE', "%$query%");
    })
    ->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END")
    ->get();

    $rolesc = user::where('role', 'Coache')->get();
        $CoacheRoleCount = $rolesc->count();
        $rolesa = user::where('role', 'Admin')->get();
        $AdminRoleCount = $rolesa->count();
        $roless = user::where('role', 'SuberAdmin')->get();
        $SuberAdminRoleCount = $roless->count();
        $rolesu = user::where('role', 'User')->get();
        $UserRoleCount = $rolesu->count();
    return view('MainPages.AdminPages.roles.roles', compact('roles','CoacheRoleCount','AdminRoleCount','SuberAdminRoleCount','UserRoleCount'));
}

public function AdminRolesCounter($role)
{
    $roles = user::where('role', $role)->get();
        return view('MainPages.AdminPages.roles.rolesCounter',['role_name' => $role], compact('roles'));
}

}
