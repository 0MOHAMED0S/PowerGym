<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\ordersItems;
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
            $user = User::find(auth()->user()->id);
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
            return redirect()->route('home')->with('success', 'Payment is successful');
        } else {
            return redirect()->route('cancel');
        }
    }
    public function cancel()
    {
        return redirect()->route('home')->with('success', '"Payment is canceled"');
    }








    public function order(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string|max:255',
            'phone_number' => 'required|max:15',
        ]);
        $auth = auth()->user()->id;
        $cart = Cart::where('user_id', $auth)->get();

        // Sum the total_price of all items in the cart
        $totalPrice = $cart->sum('total_price');

        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('ordersuccess'),
                "cancel_url" => route('ordercancel')
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => "USD",
                        "value" => $totalPrice
                    ]
                ]
            ]
        ]);

        if (isset($response['id']) && $response['id'] != null) {
            foreach ($response['links'] as $link) {
                if ($link['rel'] === 'approve') {
                    session()->put('total_price', $totalPrice);
                    session()->put('address',  $validatedData['address']);
                    session()->put('phone_number',  $validatedData['phone_number']);
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('ordercancel')->with('error', 'There was an error processing your PayPal payment.');
        }
    }



    public function ordersuccess(Request $request)
    {
        $provider = new PayPalClient;
        $provider->setApiCredentials(config('paypal'));
        $paypalToken = $provider->getAccessToken();
        $response = $provider->capturePaymentOrder($request->token);
        // dd($response);
        if (isset($response['status']) && $response['status'] == 'COMPLETED') {
            $user = User::find(auth()->user()->id);
            // Insert data into database
            $payment = new Order;
            // $payment->payment_id = $response['id'];
            $payment->total_price = session()->get('total_price');
            $payment->address = session()->get('address');
            $payment->phone_number = session()->get('phone_number');
            $payment->user_id = auth()->user()->id;
            $payment->type ='paypal';
            $payment->save();
            // Get the authenticated user's ID
            $auth = auth()->user()->id;

            // Retrieve all products in the user's cart
            $products = Cart::where('user_id', $auth)->get();
            // Iterate over each product in the cart
            foreach ($products as $product) {
                // Create a new order item for each product
                $orderItem = new ordersItems;
                $orderItem->user_id = $auth;
                $orderItem->product_id = $product->product_id;
                $orderItem->order_id = $payment->id;
                $orderItem->quantity = $product->quantity;
                $orderItem->total_price = $product->total_price;
                $orderItem->save();
            }
            // Optionally, clear the cart after transferring products to the ordersItems table
            Cart::where('user_id', $auth)->delete();
            return redirect()->route('home')->with('success', 'Payment is successful');
        } else {
            return redirect()->route('ordercancel');
        }
    }
    public function ordercancel()
    {
        return redirect()->route('home')->with('success', '"Payment is canceled"');
    }
}
