<x-app-layout>
    @section('style')
        <!-- Welcome -->
        <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
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
        </style>
    @endsection
    @include('layouts.sidebar.sidebar')
    <div style="height: 100px;"></div>
    <div class="all">
        <center style="    padding: 19px;
        background-color: #00800040;">
            <h1 class="bebas-neue-regular">MY Favorites </h1>
            <br>
            <form id="form" action="{{ route('usershop') }}" method="GET">
                <input value="{{ request()->input('query') }}" id="input" type="text" name="query"
                    placeholder="Search...">
                <button id="button" type="submit">Search</button>
            </form>
        </center>
        <div class="shop">
            @foreach ($favorites as $favorite)
                <div class="img_continer">
                    @if ($favorite->product->quantity == 0)
                        <h1 id="out">OUT OF STOCK</h1>
                    @endif
                    <img src="{{ asset('storage/' . $favorite->product->path) }}" class="img" />

                    <div class="icon">
                        <livewire:favorites :productID="$favorite->product->id" />
                        <livewire:cart :productId="$favorite->product->id" />
                    </div>

                    <div class="text">
                        <h2>{{ $favorite->product->name }}</h2>
                    </div>
                    <div class="text">
                        @if (isset($favorite->product->newprice))
                            <h4>Old Price <del><span> {{ $favorite->product->price }} EGP</span< /del>></h4>
                            <h4>New Price <span> {{ $favorite->product->newprice }} EGP</span></h4>
                        @else
                            <h4> Price <span> {{ $favorite->product->price }} EGP</span></h4>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    @section('script')
        {{-- Coaches --}}
        <script src="{{ asset('js/shop.js') }}"></script>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const containers = document.querySelectorAll('.img_continer');
                containers.forEach(container => {
                    const icons = container.querySelectorAll('.icon i');
                    icons.forEach(icon => {
                        icon.addEventListener('click', function() {
                            this.classList.toggle('icon-clicked');
                        });
                    });
                });
            });
        </script>
    @endsection
</x-app-layout>
