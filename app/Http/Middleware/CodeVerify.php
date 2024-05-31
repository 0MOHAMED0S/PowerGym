<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Notifications\CodeVerify as VerifyNotification;
use App\Models\User;

class CodeVerify
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the authenticated user
        $user = auth()->user();

        // Check if the user is authenticated and their email is not verified
        if($user && empty($user->email_verified_at)){
            // Check if the current request is not related to the verification process
            if(!$request->is('verify*')){
                // Retrieve the user instance using the user's ID
                $user = User::where('id', $user->id)->first();

                // Send verification notification to the user
                $user->notify(new VerifyNotification);

                // Redirect the user to the verification page
                return redirect()->route('CodeVerify');
            }
        }

        return $next($request);
    }
}
