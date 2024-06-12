<x-app-layout>
    @section('style')
        <!-- Welcome -->
        <link rel="stylesheet" href="{{ asset('css/home.css') }}">
        {{-- About Us --}}
        <link rel="stylesheet" href="{{ asset('css/about.css') }}">
        {{-- Coaches --}}
        <link rel="stylesheet" href="{{ asset('css/coaches.css') }}">
        {{-- features --}}
        <link rel="stylesheet" href="{{ asset('css/features.css') }}">
        {{-- Subscribe --}}
        <link rel="stylesheet" href="{{ asset('css/subscribe.css') }}">
        {{-- Contact Us --}}
        <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
                {{-- products
                <link rel="stylesheet" href="{{ asset('css/products.css') }}">
                <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'> --}}
                {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    @endsection
    @include('MainPages.home')
    @section('script')
        {{-- Coaches --}}
        <script src="{{ asset('js/coaches.js') }}"></script>
    @endsection
</x-app-layout>
