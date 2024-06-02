<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('MainPages.AdminPages.orders.orders',compact('orders'));
    }
    public function update(request $request,$id){
        $validatedData = $request->validate([
            'status'=>'required',
        ]);
        $order = Order::find($id);
        $order->status = $validatedData['status'];
        $order->save();
        return redirect()->route('orders')->with('success', 'Data Updated successfully');
    }
}
