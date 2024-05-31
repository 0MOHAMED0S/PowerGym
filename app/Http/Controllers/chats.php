<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chats extends Controller
{
    public function index(){
        return view('MainPages.chat');
    }
}
