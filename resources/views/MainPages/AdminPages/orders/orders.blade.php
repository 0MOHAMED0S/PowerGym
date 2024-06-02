@extends('layouts.adminapp')
    @section('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- UIkit CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/css/uikit.min.css" />
        <!-- UIkit JS -->
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/js/uikit.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/js/uikit-icons.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/table.css') }}">
        <link rel="stylesheet" href="{{asset('css/dashSide.css')}}">
    @endsection
    @section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Left Content (3:1 width ratio) -->
            <div class="col-lg-10">
    <div style="height: 50px;"></div>
    <main>
        @if (session('success'))
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    UIkit.notification({
                        message: '{{ session('success') }}',
                        status: 'success',
                        pos: 'top-right'
                    });
                });
            </script>
        @endif

        @include('MainPages.AdminPages.packages.PackagesModal.AddPackage')
        <h4 class="top">Orders</h4>
        <div class="main">
            <p id="greater">Home <a class="greater" href="#"><i class="fas fa-greater-than"></i></a>Orders</p>
            <div>
                {{-- <form class="d-flex" action="{{ route('AdminPackages') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="query"
                        value="{{ request()->input('query') }}">
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Add">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </form> --}}
            </div>
        </div>
        <center>
            <div>
                <h4 class="text ">Total: {{ count($orders) }}</h4>
            </div>
        </center>
    </main>
    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="oll">
                        <th>#</th>
                        <th>Name</th>
                        <th>Phone</th>
                        <th>Address</th>
                        <th>Price</th>
                        <th>Products</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($orders->isEmpty())
                        <tr>
                            <td colspan="7">
                                <center>
                                    <h3>No Orders</h3>
                                </center>
                            </td>
                        </tr>
                    @else
                        @foreach ($orders as $order)
                        @include('MainPages.AdminPages.orders.ordersModal.products')
                        @include('MainPages.AdminPages.orders.ordersModal.Edit')
                            <tr>
                                <td>{{ $order->id }}</td>
                                <td>{{ $order->user->name }}</td>
                                <td>0{{ $order->phone_number }}</td>
                                <td>{{ $order->address }}</td>
                                <td>{{ $order->total_price }}</td>
                                <td>
                                <button type="button" class="btn poll" data-bs-toggle="modal"
                                    data-bs-target="#products-{{ $order->id }}">
                                    <i class="fas fa-poll"></i>
                                </button>
                                    </td>
                                <td>{{ $order->status}}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#Edit-{{ $order->id }}">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@if($errors->has('name') || $errors->has('price') || $errors->has('features'))
<script>
    window.onload = function() {
        @if($errors->has('name'))
            UIkit.notification({message: '{{ $errors->first('name') }}', status: 'danger', pos: 'top-right'});
        @endif

        @if($errors->has('price'))
            UIkit.notification({message: '{{ $errors->first('price') }}', status: 'danger', pos: 'top-right'});
        @endif

        @if($errors->has('features'))
            UIkit.notification({message: '{{ $errors->first('features') }}', status: 'danger', pos: 'top-right'});
        @endif
    };
</script>
@endif
<script src="{{asset('js/DashSid.js')}}"></script>
@endsection

