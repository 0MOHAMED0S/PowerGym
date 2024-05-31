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
            <h1> {{$LogoName->firstname}}  <span> {{$LogoName->secondname}} </span></h1>
        </div>
        <div id="hh">
            <ul>
                <li><a href="/">Home</a></li>
                @auth
                @if (Auth::user()->role == "SuberAdmin")
                <li><a href="{{ route('AdminDashboard') }}" class="sidebar-link @if(Request::is('dashboard')) active @endif">DASHBOARD</a>                </li>
                @else
                <li><a href="{{route('login')}}">Login</a></li>
                @endif
                @endauth
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

@include('layouts.sidebar.adminsidebar')
        </div>
    </nav>
</header>
<link rel="stylesheet" href="{{ asset('js/sidebar.js') }}">
