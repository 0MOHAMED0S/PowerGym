<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class subscribers extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('query');

        $subscribers = Subscribe::where(function ($q) use ($query) {
            $q->where('active', 'LIKE', "%$query%")
                ->orWhere('id', 'LIKE', "%$query%");
        })
            ->orderByRaw("CASE WHEN active LIKE '$query%' THEN 1 ELSE 2 END")->get();
        $packages = Package::get();

        return view('MainPages.AdminPages.subscribers.subscribe', compact('subscribers', 'packages'));
    }
    public function renew(Request $request, $id)
    {
        $subscribers = Subscribe::find($id);
        $subscribers->created_at = now();
        $subscribers->end_at = Carbon::parse($subscribers->end_at)->addMonth();
        $subscribers->active = 1;
        $subscribers->save();
        return redirect()->route('AdminSubscribers')->with('success', 'Data Updated successfully');
    }
    public function reset(Request $request, $id)
    {
        $subscribers = Subscribe::find($id);
        $subscribers->created_at = null;
        $subscribers->end_at = null;
        $subscribers->active = 0;
        $subscribers->save();
        return redirect()->route('AdminSubscribers')->with('success', 'Data Updated successfully');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required_without:phone_number|max:255',
            'phone_number' => 'required_without:email|max:255',
            'package_id' => 'required',
        ]);

        // Find user based on email or phone number
        $user = null;
        if ($request->has('email')) {
            $user = User::where('email', $validatedData['email'])->first();
        } elseif ($request->has('phone_number')) {
            $user = User::where('phone_number', $validatedData['phone_number'])->first();
        }

        if (!$user) {
            return redirect()->back()->with('success', 'User not found');
        }

        // Check if user already has a subscription for the provided package
        $existingSubscription = Subscribe::where('user_id', $user->id)->first();

        if ($existingSubscription) {
            return redirect()->back()->with('success', 'User already subscribed in package');
        }

        // Retrieve package details
        $package = Package::find($validatedData['package_id']);

        // Now you have $user, proceed with saving the subscription
        $subscription = new Subscribe;
        $subscription->user_id = $user->id;
        $subscription->user_name = $user->name;
        $subscription->package_id = $validatedData['package_id'];
        $subscription->amount = $package->price;
        $subscription->created_at = now();
        $subscription->end_at = Carbon::parse($subscription->end_at)->addMonth();
        $subscription->active = 1;
        $subscription->save();

        return redirect()->back()->with('success', 'Data stored successfully');
    }
}
