<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use app\Models\User;
class coaches extends Controller
{
    public function index(Request $request)
{
    $query = $request->input('query');

    $coaches = User::where('role', 'Coache')
        ->where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%");
        })
        ->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END")
        ->get();

        $roles = Role::get();
    return view('MainPages.AdminPages.coaches.coaches', compact('coaches','roles'));
}



}
