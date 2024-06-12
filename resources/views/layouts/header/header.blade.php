<header>
    <nav>
        <div class="power">
            <a href="">
                @if ($LogoName->logopath == null)
                    <i class="fa-solid fa-dumbbell" style="color: rgb(19, 225, 0);"></i>
                @else
                    <a class="fancybox" href="{{ asset('storage/' . $LogoName->logopath) }}">
                        <img   width="50" height="50" src="{{ asset('storage/' . $LogoName->logopath) }}">
                    </a>
                @endif
            </a>
            <h1>{{ $LogoName->firstname }} <span>{{ $LogoName->secondname }}</span></h1>
        </div>
        <div id="hh">
            <ul>
                <li><a class=" @if(Request::is('/')) active @endif"  href="/">Home</a></li>
                <li><a class=" @if(Request::is('shop')) active @endif" href="{{route('usershop')}}">Shop</a></li>
                <li><a class=" @if(Request::is('favorite')) active @endif"   href="{{route('Favorites')}}">My Favorites</a></li>
                <li><a class=" @if(Request::is('Cart')) active @endif" href="{{route('cart')}}">Cart</a></li>
                <li><a class=" @if(Request::is('Orders')) active @endif" href="{{route('userorders')}}">Orders</a></li>
                @auth
                @if (Auth::user()->role=="SuberAdmin")
                <li><a href="{{route('AdminDashboard')}}">DASHBOARD</a></li>
                @endif
                @else
                <li><a href="{{route('login')}}">Login</a></li>
                @endauth
                {{-- <li><a href="{{ route('dashboard') }}">Dash</a></li> --}}
                <!-- <li><a href="#">About Us</a></li>
                <li><a href="#">Coaches</a></li>
                <li><a href="#">Contact us</a></li> -->
            </ul>
            <hr id="hr_home">
        </div>

        <div class="icons">
            @auth
            <div class="fill">
                <a href="{{route('profile')}}"> <i style="color: rgb(255, 255, 255) "  class="bi bi-person-circle fa-2x"></i></a>
            </div>
            @endauth
            <div class="fill">
                <i id="i" class="bi bi-list open-btn" onclick="toggleSidebar()"></i>
            </div>
            {{-- @include('layouts.sidebar.sidebar') --}}
        </div>
    </nav>
</header>
<link rel="stylesheet" href="{{ asset('js/sidebar.js') }}">
