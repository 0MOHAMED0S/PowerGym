<div id="sidebar">
    <!-- Uncomment if needed -->
    <!-- <button class="close-btn" onclick="closeSidebar()">✕</button> -->
    <hr id="hr_side">
    <div id="d">
        @auth
        @if (Auth::user()->role == "SuberAdmin")
        <a href="{{ route('AdminDashboard') }}" class="sidebar-link @if(Request::is('dashboard')) active @endif">DASHBOARD</a>
        @endif
        @endauth
        <hr id="hr_side">
    </div>
    <a href="{{ route('AdminUsers') }}" class="sidebar-link @if(Request::is('dashboard/users')) active @endif">USERS</a>
    <hr id="hr_side">
    <a href="{{ route('AdminCoaches') }}" class="sidebar-link @if(Request::is('dashboard/coaches')) active @endif">COACHES</a>
    <hr id="hr_side">
    <a href="{{ route('AdminSubscribers') }}" class="sidebar-link @if(Request::is('dashboard/subscribers')) active @endif">SUBSCRIBERS</a>
    <hr id="hr_side">
    <a href="{{ route('AdminShop') }}" class="sidebar-link @if(Request::is('dashboard/products')) active @endif">PRODUCTS</a>
    <hr id="hr_side">
    <a href="{{ route('orders') }}" class="sidebar-link @if(Request::is('dashboard/Orders')) active @endif">Orders</a>
    <hr id="hr_side">
    <a href="{{ route('AdminPackages') }}" class="sidebar-link @if(Request::is('dashboard/packages')) active @endif">PACKAGES</a>
    <hr id="hr_side">
    <a href="{{ route('AdminEquipments') }}" class="sidebar-link @if(Request::is('dashboard/equipments')) active @endif">EQUIPMENTS</a>
    <hr id="hr_side">
    <a href="{{ route('logoname') }}" class="sidebar-link @if(Request::is('dashboard/logoname')) active @endif">LOGO & NAME</a>
    <hr id="hr_side">
    <a href="{{ route('AdminContact') }}" class="sidebar-link @if(Request::is('dashboard/contact')) active @endif">CONTACT & INFO</a>
    <hr id="hr_side">
    <a href="{{ route('DiteTrainAdmin') }}" class="sidebar-link @if(Request::is('dashboard/Dite')) active @endif">DITE </a>
    <hr id="hr_side">
    @auth
    <!-- Authentication -->
    <form method="POST" action="{{ route('logout') }}">
        @csrf

        <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
            {{ __('Log Out') }}
        </x-dropdown-link>
    </form>
    @else
    <a href="{{ route('login') }}" class="sidebar-link @if(Request::is('login')) active @endif">Login</a>
    @endauth
</div>
<script>
    $(document).ready(function () {
        // Get the current URL
        var currentUrl = window.location.href;

        // Check if the URL contains the 'AdminDashboard' route
        if (currentUrl.includes('/AdminDashboard')) {
            // Add the 'active' class to the Dashboard link
            $('.sidebar-link[href="{{ route('AdminDashboard') }}"]').addClass('active');
        }
    });
</script>
