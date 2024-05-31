@include('layouts.sidebar.sidebar')

    <!--  Welcome Section -->
@include('MainPages.HomeSections.welcome')
<br id="start">
<br>
<hr >
    <!--  About Us Section -->
@include('MainPages.HomeSections.aboutUs')

    <!--  Coaches Section -->
@include('MainPages.HomeSections.coaches')
<br id="pack2">
<hr>
<br>
    <!--  features Section -->
@include('MainPages.HomeSections.features')
<br id="pack">

    {{-- Subscribe Section --}}
@include('MainPages.HomeSections.subscribe')
<br id="btn_c">
<hr>
<br>
    {{-- Products Section --}}
    {{-- @include('MainPages.HomeSections.products')
    <br id="btn_c">
    <hr>
    <br> --}}

    <!--Contact Us Section-->
@include('MainPages.HomeSections.contactUs')
