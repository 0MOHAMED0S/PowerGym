<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\diteTrain;
use App\Models\Equipment;
use App\Models\Order;
use App\Models\Package;
use App\Models\Products;
use App\Models\Role;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Http\Request;

class dashboard extends Controller
{
        public function index(){
        $users = User::where('role', 'Coache')->get();
        $coachesCount = $users->count();
        $usersCount=User::count();
        $packagesCount = Package::count();
        $rolesCount=Role::count();
        $productscount=Products::count();
        $Equipmentscount=Equipment::count();
        $train=diteTrain::count();
        $orders=Order::count();
        $sub = Subscribe::where('active', 1)->get();
        $Subscribecount=$sub->count();
        return view('dashboard', compact('coachesCount', 'usersCount', 'packagesCount','rolesCount','productscount','Equipmentscount','Subscribecount','train','orders'));
    }
}
