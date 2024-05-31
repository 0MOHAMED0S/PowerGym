<x-app-layout>
    @section('style')
        <!-- Welcome -->
        {{-- <link rel="stylesheet" href="{{ asset('css/shop.css') }}"> --}}
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
        <style>
            button {
                background-color: transparent;
                border: none;
            }

            button i {
                font-size: 25px
            }

            #out {
                position: absolute;
                color: white;
                background-color: red;
                padding: 10px;
                font-size: 13px;
            }

            #form {
                display: flex;
                justify-content: center;
                align-items: center;
                margin-bottom: 20px;
                gap: 10px
            }

            #input[type="text"] {
                padding: 10px;
                width: 200px;
                border: 1px solid #ccc;
                border-radius: 5px;
                outline: none;
            }

            #button {
                padding: 10px 20px;
                background-color: #00ff1a;
                color: #fff;
                border: none;
                border-radius: 5px;
                cursor: pointer;

            }

            #button:hover {
                background-color: #1eb300;
            }
        </style>
        {{-- Subscribe --}}
        <link rel="stylesheet" href="{{ asset('css/subscribe.css') }}">
    @endsection
    @include('layouts.sidebar.sidebar')
    <div style="height: 100px;"></div>
    <div class="all">
        <center style="    padding: 19px;
        background-color: #00800040;">
            <h1 class="bebas-neue-regular">Packages </h1>
            <br>
            <form id="form" action="{{ route('Packages') }}" method="GET">
                <input value="{{ request()->input('query') }}" id="input" type="text" name="query"
                    placeholder="Search...">
                <button id="button" type="submit">Search</button>
            </form>
        </center>
        <div class="container2">
            <div class="card_section">
                @foreach ($packages as $package)
                    <div class="card">
                        <div class="card_head">
                            <h2 class="bebas-neue-regular">{{ $package->name }}</h2>
                            <h2 id="gray" class="bebas-neue-regular">$ {{ $package->price }}</h2>
                        </div>
                        <div class="card_body">
                            @if (isset($package->features))
                                @foreach ($package->features as $features)
                                    <div class="features">
                                        <i class="fa-solid fa-star fa-lg" style="color: #13ff00;"></i>
                                        <h2 class="nanum-gothic-regular">{{ $features->feature }}</h2>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div>
                            <form action="{{ route('paypal', ['id' => $package->id]) }}" method="post">
                                @csrf
                                <center>
                                    <button type="submit" class="Subscripe">Subscribe</button>
                                </center>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
