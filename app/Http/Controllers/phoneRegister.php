<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Vonage\Client;
use Vonage\Verify\Request as VerifyRequest;

class phoneRegister extends Controller
{
    public function startVerification(Request $request)
    {
        $phoneNumber = $request->input('phone_number');

        $basic  = new \Vonage\Client\Credentials\Basic(
            Config::get('services.vonage.key'),
            Config::get('services.vonage.secret')
        );

        $client = new Client($basic);

        try {
            $verifyRequest = new VerifyRequest($phoneNumber, "Power");
            $response = $client->verify()->start($verifyRequest);
            return response()->json(['request_id' => $response->getRequestId()]);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function checkVerification(Request $request)
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
}
