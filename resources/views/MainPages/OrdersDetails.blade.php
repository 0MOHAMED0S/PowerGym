@extends('layouts.cart')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('content')
    <div style="height: 100px;"></div>
    <center style="padding: 19px; margin-bottom: 20px; background-color: #00800040;">
        <h1 class="bebas-neue-regular">Order Details</h1>
        <br>
    </center>
    <div style="grid-template-columns: none;" class="container">
        <div class="shopping-cart">
            <h1></h1>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    @foreach ($products as $product )
                    <tr>
                        <td>
                            {{$product->id}}
                        </td>
                        <td style="display: block" class="product">
                            <div class="product-log">
                                <img src="{{asset('storage/'.$product->product->path)}}" alt="" />
                            </div>
                            <div class="product-name">
                                {{$product->name}}
                            </div>
                        </td>
                        <td>
                            <span>$</span>{{ $product->newprice ?? $product->price }}
                        </td>
                        <td>
                        <span class="qty">{{ $product->quantity }}</span>
                        </td>
                        <td>$<span class="total-price">{{$product->total_price}}</span></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="summary">
                <div class="summary-flex">
                    <h2>Total: $<span id="total">{{        $totalPrice = $products->sum('total_price')                    }}</span></h2>
                </div>
            </div>
        </div>
    </div>
@endsection
