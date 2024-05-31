<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Vonage\Client;
use Illuminate\Support\Facades\Config;
use Vonage\Verify\Request as VerifyRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Social;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class phoneAuth extends Controller
{
    public function register(Request $request)
    {
        return view('auth.Phoneregister');
    }
    public function PhoneCodeVerify($register_id){
        $registerId=$register_id;
        return view('auth.PhoneCodeVerify',compact('registerId'));
    }
    public function startVerification(Request $request)
    {
        // Validate request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'phone_number' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // Create a new user
        $user = User::create([
            'name' => $request->input('name'),
            'phone_number' => $request->input('phone_number'),
            'password' => Hash::make($request->input('password')),
        ]);

        // Start phone number verification
        $phoneNumber = $request->input('phone_number');
        $basic = new \Vonage\Client\Credentials\Basic(
            Config::get('services.vonage.key'),
            Config::get('services.vonage.secret')
        );
        $client = new Client($basic);

        try {
            $verifyRequest = new VerifyRequest($phoneNumber, "Power");
            $response = $client->verify()->start($verifyRequest);

            $requestId = $response->getRequestId();
            if (!$requestId) {
                throw new \Exception("Failed to get request ID");
            }

            // Create a new social record with user_id and request_id
            $social = Social::create([
                'user_id' => $user->id,
                'register_id' => $requestId,
            ]);

            // Authenticate the user
            Auth::login($user);

            // Redirect to a verification page with register_id
            return redirect()->route('PhoneCodeVerify', ['register_id' => $requestId]);

        } catch (\Exception $e) {
            // If an error occurs, delete the user
            $user->delete();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }



public function checkVerification2(Request $request)
    {
        $requestId = $request->input('request_id');
        $code = $request->input('code');

        $basic  = new \Vonage\Client\Credentials\Basic(
            Config::get('services.vonage.key'),
            Config::get('services.vonage.secret')
        );

        $client = new Client($basic);

        try {
            $result = $client->verify()->check($requestId, $code);
            return response()->json($result->getResponseData());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }



    // public function cancelVerification(Request $request)
    // {
    //     $requestId = $request->input('request_id');

    //     $basic  = new \Vonage\Client\Credentials\Basic(
    //         Config::get('services.vonage.key'),
    //         Config::get('services.vonage.secret')
    //     );

    //     $client = new Client($basic);

    //     try {
    //         $result = $client->verify()->cancel($requestId);
    //         return response()->json($result->getResponseData());
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }



    public function checkVerification(Request $request)
    {
        $request->validate([
            'request_id' => 'required',
            'code' => 'required',
        ]);

        $requestId = $request->input('request_id');
        $code = $request->input('code');

        $basic = new \Vonage\Client\Credentials\Basic(
            Config::get('services.vonage.key'),
            Config::get('services.vonage.secret')
        );

        $client = new Client($basic);

        try {
            $result = $client->verify()->check($requestId, $code);
            $responseData = $result->getResponseData();

            if ($responseData['status'] === '0') {
                $user = User::where('register_id', $requestId)->first();
                if ($user) {
                    // Authenticate user
                    Auth::login($user);

                    // Update user's email_verified_at column
                    $user->email_verified_at = now();
                    $user->save();

                    // Generate a remember token and save it
                    $rememberToken = Str::random(60);
                    $user->forceFill([
                        'remember_token' => hash('sha256', $rememberToken),
                    ])->save();

                    // Log successful verification
                    Log::info('Verification successful for user: ' . $user->id);

                    return redirect('/')->withCookie('remember_token', $rememberToken);
                }
            }

            // Log failed verification
            Log::warning('Invalid verification code for request ID: ' . $requestId);

            return redirect()->back()->withErrors(['code' => 'Wrong Code']);
        } catch (\Vonage\Client\Exception\Request $e) {
            // Log Vonage API errors
            Log::error('Vonage API error: ' . $e->getMessage());

            return redirect()->back()->withErrors(['code' => 'Verification failed. Please try again later.']);
        } catch (\Exception $e) {
            // Log other unexpected errors
            Log::error('Unexpected error: ' . $e->getMessage());

            return redirect()->back()->withErrors(['code' => 'Something went wrong. Please try again later.']);
        }
    }


}
