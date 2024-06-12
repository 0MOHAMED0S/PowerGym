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
        $user = auth()->user();
        if($user && empty($user->email_verified_at)){
            if(!$request->is('verify*')){
                $user = User::where('id', $user->id)->first();
                $user->notify(new VerifyNotification);
                return redirect()->route('CodeVerify');
            }
        }

        return $next($request);
    }
}
