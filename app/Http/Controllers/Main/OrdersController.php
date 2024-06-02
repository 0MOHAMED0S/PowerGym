<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ordersItems;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function index()
    {
        $orders=order::where('user_id',auth()->user()->id)->get();
        return view('MainPages.orders',compact('orders'));
    }
    public function details($id)
    {
        $products=ordersItems::where('order_id',$id)->get();
        return view('MainPages.OrdersDetails',compact('products'));
    }
}
