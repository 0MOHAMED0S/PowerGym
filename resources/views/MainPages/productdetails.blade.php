
<x-app-layout>
    @section('style')
    <link rel="stylesheet" href="{{{asset('css/productdetails.css')}}}">
    <link rel="stylesheet" href="{{{asset('css/all.css')}}}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    @endsection
    @include('layouts.sidebar.sidebar')
    <div style="height:100px;"></div>
    <center style="    padding: 19px;
    background-color: #00800040;">
        <h1 class="bebas-neue-regular">Product Details</h1>
    </center>
    <div class="content">
        <div class="img_content">
            @if ($product->quantity == 0)
                        <h1 id="out">OUT OF STOCK</h1>
                    @endif
            <img src="{{asset('storage/'.$product->path)}}">
        </div>
        <div class="text_content">
            <h2>{{$product->name}}</span></h2>
            <h2><span>$ <span>{{$product->price}}</span></h2>
            <p>
                {!! nl2br(e($product->description)) !!}
            </p>
        <div id="butons" style="display: flex;gap:30px">
            <livewire:favorites :productID="$product->id" />
                <livewire:cart :productId="$product->id" />
                </div>
                </div>
    </div>
    @section('script')

    @endsection
</x-app-layout>
