@extends('layouts.cart')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
@endsection
@section('content')
    <div style="height: 100px;"></div>
    <center style="padding: 19px; margin-bottom: 20px; background-color: #00800040;">
        <h1 class="bebas-neue-regular">Orders</h1>
        <br>
    </center>
    <div class="order_page">
        @foreach ($orders as $order)
            <div class="order_1">
                <div class="first">
                    <h2> Order {{ $order->id }}</h2>
                    <p id="p" style="color: green;"><a href="{{route('orderdetails',['id'=> $order->id])}}"> VIEW ORDER</a> </p>
                </div>
                <div class="secound">
                    @if ($order->status == 'pending')
                        <p> <span style="background-color: rgb(246, 255, 0);" id="span"> ` </span> Pending </p>
                    @elseif ($order->status == 'canceled')
                        <p> <span style="background-color: rgb(255, 0, 0);" id="span"> ` </span> Canceled </p>
                    @elseif ($order->status == 'inreview')
                        <p> <span style="background-color: rgb(255, 157, 0);" id="span"> ` </span> In Review </p>
                    @elseif ($order->status == 'completed')
                        <p> <span style="background-color: rgb(43, 255, 0);" id="span"> ` </span> Completed
                            {{ $order->updated_at }} </p>
                    @endif
                </div>
                <div class="secound">
                <p>Total Price: {{$order->total_price}}</p>
                </div>
            </div>
        @endforeach
    </div>
@endsection
