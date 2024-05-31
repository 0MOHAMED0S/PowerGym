<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Favorite;
use Illuminate\Http\Request;

class favorites extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id',auth()->user()->id)->get();
        return view('MainPages.favorites',compact('favorites'));
    }
}
