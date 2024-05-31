<div id="sidebar">
    <!-- <button class="close-btn" onclick="closeSidebar()">✕ </button> -->
    <hr id="hr_side">

   <div id="d">
    <a class=" @if(Request::is('/')) active @endif" href="{{route('home')}}">Home</a>
    <hr id="hr_side">
    @auth
    @if (Auth::user()->role=="SuberAdmin")
    <a href="{{route('AdminDashboard')}}">DASHBOARD</a>
    @endif
    @endauth
    <hr id="hr_side">
    <a  class=" @if(Request::is('shop')) active @endif" href="{{route('usershop')}}">Shop</a>
    <hr id="hr_side">
    <a class=" @if(Request::is('favorite')) active @endif"  href="{{route('Favorites')}}">FAVORITES</a>
    <hr id="hr_side">
    <a href="#start">Orders</a>
    <hr id="hr_side">
   </div>
    @if(Request::is('/'))
    <a href="#start">ABOUT US</a>
    <hr id="hr_side">
    @if (isset($coaches) && count($coaches) > 0)
    @foreach ($coaches as $coach)
        @if (isset($coach->image->path))
            <a href="#coach">Coaches</a>
            <hr id="hr_side">
            @break 
        @endif
    @endforeach
@endif

    <a href="#pack2">Features</a>
    <hr id="hr_side">
    @if (isset($packages) && count($packages) > 0)
    <a href="#pack">Packages</a>
    <hr id="hr_side">
    @endif
    <a href="#btn_c">CONTACT US</a>
    <hr id="hr_side">
    @endif
    @auth
        <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')"
            onclick="event.preventDefault();
                            this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
    @else
    <a href="{{ route('login') }}">Login</a>
    @endauth
</div>
