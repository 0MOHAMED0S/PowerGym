<?php

namespace App\Http\Controllers;

use App\Models\Package;
use App\Models\Subscribe;
use Illuminate\Http\Request;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use App\Models\Payment;
use App\Models\User;

class PaypalController extends Controller
{
    public function paypal(Request $request, $id)
    {
        $subscriptions = Subscribe::where('user_id', auth()->user()->id)->get();
        if (!$subscriptions->isEmpty()) {
            return redirect()->route('home')->with('success', 'Data Updated successfully');
        } else {
            $package = Package::find($id);
            $provider = new PayPalClient;
            $provider->setApiCredentials(config('paypal'));
            $paypalToken = $provider->getAccessToken();
            $response = $provider->createOrder([
                "intent" => "CAPTURE",
                "application_context" => [
                    "return_url" => route('success'),
                    "cancel_url" => route('cancel')
                ],
                "purchase_units" => [
                    [
                        "amount" => [
                            "currency_code" => "USD",
                            "value" => $package->price
                        ]
                    ]
                ]
            ]);
            //dd($response);
            if (isset($response['id']) && $response['id'] != null) {
                foreach ($response['links'] as $link) {
                    if ($link['rel'] === 'approve') {
                        session()->put('package_id', $package->id);
                        return redirect()->away($link['href']);
                    }
                }
            } else {
                return redirect()->route('cancel');
            }
        }
    }
    public function success(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        // dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
        $user=User::find(auth()->user()->id);
            // Insert data into database
            $payment = new Subscribe;
            $payment->payment_id = $response['id'];
            $payment->package_id = session()->get('package_id');
            $payment->user_name = $user->name;
            $payment->user_id = auth()->user()->id;
            $payment->end_at = now()->addMonths(1);
            $payment->amount = $response['purchase_units'][0]['payments']['captures'][0]['amount']['value'];
            $payment->currency = $response['purchase_units'][0]['payments']['captures'][0]['amount']['currency_code'];
            $payment->payer_name = $response['payer']['name']['given_name'];
            $payment->payer_email = $response['payer']['email_address'];
            $payment->payment_status = $response['status'];
            $payment->payment_method = "PayPal";
            $payment->save();
            return redirect()->route('home')->with('success','Payment is successful');
            unset($_SESSION['product_name']);
        } else {
            return redirect()->route('cancel');
        }
    }
    public function cancel()
    {
        return redirect()->route('home')->with('success','"Payment is canceled"');
    }
}
