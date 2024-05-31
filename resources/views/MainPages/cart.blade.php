@extends('layouts.cart')
@section('style')
    <link rel="stylesheet" href="{{ asset('css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection
@section('content')
    <div style="height: 100px;"></div>
    <center style="padding: 19px; margin-bottom: 20px; background-color: #00800040;">
        <h1 class="bebas-neue-regular">Shopping Cart</h1>
        <br>
    </center>
    <div class="container">
        <div class="shopping-cart">
            <h1></h1>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total Price</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="cart-items">
                    @foreach ($carts as $cart )
                    <tr data-id="{{ $cart->id }}" data-price="{{ $cart->product->newprice ?? $cart->product->price }}">
                        <td class="product">
                            <div class="product-log">
                                <img src="{{asset('storage/'.$cart->product->path)}}" alt="" />
                            </div>
                            <div class="product-name">
                            <span class="subtext">{{$cart->product->name}}</span>
                            </div>
                        </td>
                        <td>
                            <span>$</span>{{ $cart->product->newprice ?? $cart->product->price }}
                        </td>
                        <td>
                            <button class="qty-btn decrease">-</button>
                            <span class="qty">{{ $cart->quantity }}</span>
                            <button class="qty-btn increase">+</button>
                        </td>
                        <td>$<span class="total-price">{{ $cart->product->newprice * $cart->quantity ?? $cart->product->price * $cart->quantity }}</span></td>
                        <td class="close">
                            <p>X</p>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="summary">
                <div class="summary-flex">
                    <h2>Total: $<span id="total"></span></h2>
                    <a href="{{route('usershop')}}" class="continue-shopping">&lt; Continue Shopping</a>
                </div>
            </div>
        </div>
        <div class="payment-info">
            <h1>Payment Info.</h1>
            <form>
                <div class="payment-method">
                    <label>
                        <input type="radio" name="payment" checked /> PayPal
                    </label>
                    <label> <input disabled type="radio" name="payment" /> Soon </label>
                </div>
                <div class="card-details">
                    <label>Address</label>
                    <textarea name="address" id="address" cols="30" rows="5"></textarea>
                </div>
                <button type="button" class="checkout-btn">Check Out</button>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            function updateTotal() {
                let total = 0;
                document.querySelectorAll('#cart-items tr').forEach(function(row) {
                    const price = parseFloat(row.getAttribute('data-price'));
                    const quantity = parseInt(row.querySelector('.qty').textContent);
                    total += price * quantity;
                    row.querySelector('.total-price').textContent = (price * quantity).toFixed(2);
                });
                document.getElementById('total').textContent = total.toFixed(2);
            }

            document.querySelectorAll('.qty-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const qtyElement = row.querySelector('.qty');
                    let quantity = parseInt(qtyElement.textContent);

                    if (this.classList.contains('decrease') && quantity > 1) {
                        quantity--;
                    } else if (this.classList.contains('increase')) {
                        quantity++;
                    }

                    qtyElement.textContent = quantity;
                    updateTotal();
                });
            });

            updateTotal();
        });
    </script>
@endsection
