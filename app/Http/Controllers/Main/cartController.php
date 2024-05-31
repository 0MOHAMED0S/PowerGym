<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class cartController extends Controller
{
    public function index()
    {
        $carts = Cart::where('user_id',auth()->user()->id)->get();
        return view('MainPages.cart',compact('carts'));
    }
}
