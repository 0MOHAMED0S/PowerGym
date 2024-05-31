<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\images;
use App\Models\Social;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;

class googleAuth extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }
    public function callback() {
        $googleUser = Socialite::driver('google')->user();

        // Check if the email exists in the database
        $user = User::where('email', $googleUser->email)->first();

        // If the user exists, update the social ID and token
        if ($user) {
            $user->update([
                'social_id' => $googleUser->id,
                'social_type' => 'google',
                'social_token' => $googleUser->token,
            ]);

            // Authenticate the user
            Auth::login($user);

            return redirect('/')->withCookie('remember_token', $user->remember_token);
        }

        // If the user does not exist, create a new user
        $user = User::create([
            'name' => $googleUser->name,
            'email' => $googleUser->email,
            'social_id' => $googleUser->id,
            'social_type' => 'google',
            'social_token' => $googleUser->token,
            'email_verified_at' => now(), 
        ]);
        // Create a record in the Social table
        $social = Social::create([
            'social_id' => $googleUser->id,
            'social_type' => 'google',
            'social_token' => $googleUser->token,
            'user_id' => $user->id,
        ]);

        // Generate a remember token and save it
        $rememberToken = Str::random(60);
        $user->forceFill([
            'remember_token' => hash('sha256', $rememberToken),
        ])->save();

        // Authenticate the user
        Auth::login($user);
        return redirect('/')->withCookie('remember_token', $rememberToken);
    }

}
