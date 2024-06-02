<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\ordersItems;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function order(request $request)
    {
        return redirect()->route('paypal');
    }
}
