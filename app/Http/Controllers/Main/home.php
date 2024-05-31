<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Admin\packages;
use App\Http\Controllers\Controller;
use App\Models\LogoName;
use App\Models\Package;
use App\Models\User;
use Illuminate\Http\Request;

class home extends Controller
{
    public function index()
    {
        $coaches = User::where('role', 'Coache')->get();
        $packages = Package::where('status', 1)->take(3)->get();
        $allpackages = Package::where('status', 1)->get();
        return view('welcome',compact('packages','allpackages','coaches'));
    }
}
