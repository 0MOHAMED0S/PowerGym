<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class users extends Controller
{
    public function index(Request $request)
    {
        $query = trim($request->input('query'));

        $users = User::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%$query%")
                ->orWhere('email', 'LIKE', "%$query%");
        })
            ->orderByRaw("CASE WHEN name LIKE '$query%' THEN 1 ELSE 2 END")
            ->get();
        $roles = Role::get();

        return view('MainPages.AdminPages.users.users', compact('users', 'roles'));
    }

    public function delete($id)
    {
        $user = user::find($id);
        // Check if user is trying to edit a superadmin role
        if ($user->role === 'SuberAdmin') {
            return redirect()->back()->with('success', 'You cannot delete a SuperAdmin.');
        }
        // Check if the product exists
        if (!$user) {
            return redirect()->route('AdminUsers')->with('error', 'user Not Found');
        }
        // Proceed with the deletion
        $user->delete();
        return redirect()->back()->with('success', 'Data Deleted successfully');
    }



    public function update(Request $request, $id)
    {
        $user = User::find($id);
        // Check if user is trying to edit a superadmin role
        if ($user->role === 'SuberAdmin') {
            return redirect()->back()->with('success', 'You cannot update a SuperAdmin.');
        } else {
            $validatedData = $request->validate([
                'name' => 'required|string|max:25',
                'email' => 'required|max:25|unique:users,email,' . $id,
                'role' => 'required',
                'phone_number' => 'nullable|max:255|unique:users,phone_number,' . $id,
                'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
            ]);
            // Handle image upload if a file is present in the request
            if ($request->hasFile('path')) {
                $image = $request->file('path');
                $imageName = $image->getClientOriginalName();
                $path = $image->storeAs('Images', $imageName, 'public');
                // Find user's image record
                $userImage = Images::where('user_id', $id)->first();
                // Update or create user's image record
                if ($userImage) {
                    $userImage->path = $path;
                    $userImage->save();
                } else {
                    $userImage = new Images();
                    $userImage->user_id = $id;
                    $userImage->path = $path;
                    $userImage->save();
                }
            }
            $user->name = $validatedData['name'];
            $user->role = $validatedData['role'];
            $user->email = $validatedData['email'];
            $user->phone_number = $validatedData['phone_number'];
            $user->save();
            return redirect()->back()->with('success', 'Data Updated successfully');
        }
    }
}
