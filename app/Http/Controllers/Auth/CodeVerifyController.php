<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CodeVerifyController extends Controller
{
    public function CodeVerify()
    {
        return view('auth.CodeVerify');
    }
    public function CheckCodeVerify(Request $request)
    {
        $user = auth()->user();
        $code = $request->input('code');

        if ($user->code && $user->code == $code) {
            DB::table('users')
                ->where('id', $user->id)
                ->update([
                    'code' => null,
                    'expired_at' => null,
                    'email_verified_at' => now(),
                ]);

            return redirect()->route('home');
        }

        return redirect()->back()->withErrors(['code' => 'Wrong Code']);
    }
}
