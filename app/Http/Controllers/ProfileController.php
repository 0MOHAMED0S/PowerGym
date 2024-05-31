<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\images;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Illuminate\Support\Facades\Hash;
use App\Rules\MatchOldPassword;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $data = $request->validated();

        // Update name
        $user->name = $data['name'];
        $user->save();

        // Handle image upload if a file is present in the request
        if ($request->hasFile('path')) {
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('Images', $imageName, 'public');

            // Find user's image record
            $userImage = Images::where('user_id', $user->id)->first();

            // Update or create user's image record
            if ($userImage) {
                $userImage->path = $path;
                $userImage->save();
            } else {
                $userImage = new Images();
                $userImage->user_id = $user->id;
                $userImage->path = $path;
                $userImage->save();
            }
        }
        return Redirect::back()->with('status', 'profile-updated');
    }
    public function profile()
    {
        $user = auth()->user();
        $qrText = 'Name: ' . $user->name . "\n" . 'Code: ' . $user->id;
        $qrCode = QrCode::size(150)->generate($qrText);
        return view('profile.profile',compact('qrCode'));
    }
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    public function editimage(Request $request, $id)
    {
        $validatedData = $request->validate([
            'path' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Adjusted for images
        ]);

        $path = null;

        if ($request->file('path')) {
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('Equipments', $imageName, 'public');
        }

        try {
            $Equipments = Images::updateOrCreate(
                ['user_id' => $id],
                ['path' => $path]
            );
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error occurred: ' . $e->getMessage());
        }

        return redirect()->back()->with('success', 'Data updated successfully');
    }

    public function updatepass(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->back()->with('status', 'Password updated successfully.');
    }


}
