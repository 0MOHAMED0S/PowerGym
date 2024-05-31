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
    <link rel="stylesheet" href="{{ asset('css/dashSide.css') }}">
@endsection
@section('content')
@include('MainPages.AdminPages.shop.ShopModal.Add')
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
    <div class="container-fluid">
        <div class="row">
            <!-- Left Content (3:1 width ratio) -->
            <div class="col-lg-10">
                <div style="height: 50px;"></div>
                <main>
                    <h4 class="top">SHOP</h4>
                    <div class="main">
                        <p id="greater">Home <a class="greater" href="#"><i
                                    class="fas fa-greater-than"></i></a>SHOP</p>
                        <div>
                            <form class="d-flex" action="{{ route('AdminShop') }}"  method="GET">
                                <input class="form-control me-2" type="search" placeholder="Search" name="query"
                                    value="{{ request()->input('query') }}">
                                <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Add">
                                    <i class="fas fa-plus-circle"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                    <center>
                        <div>
                            <h4 class="text ">Total: {{ count($products) }}</h4>
                        </div>
                    </center>
                </main>
                <div class="container mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="oll">
                                    <th> #</th>
                                    <th> Image</th>
                                    <th> Name</th>
                                    <th> Price</th>
                                    <th> New Price</th>
                                    <th> quantity</th>
                                    <th> Description</th>
                                    <th> Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($products->isEmpty())
                                    <tr>
                                        <td colspan="7">
                                            <center>
                                                <h3>No Results</h3>
                                            </center>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($products as $product)
                                    @include('MainPages.AdminPages.shop.ShopModal.Delete')
                                    @include('MainPages.AdminPages.shop.ShopModal.Edit')
                                        <tr>
                                            <td>{{ $product->id }}</td>
                                            <td>
                                                @if (isset($product->path))
                                                    <div uk-lightbox>
                                                        <a href="{{ asset('storage/' . $product->path) }}"
                                                            data-caption="{{ $product->name }}">
                                                            <img class="imgg"
                                                                src="{{ asset('storage/' . $product->path) }}">
                                                    </div>
                                                @else
                                                    <center>
                                                        <i class="fa-solid fa-dumbbell fa-2x"
                                                            style="color: rgb(19, 225, 0);"></i>
                                                    </center>
                                                @endif
                                            </td>
                                            <td>{{ $product->name }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->newprice }}</td>
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#Edit-{{ $product->id }}">
                                                    <i class="far fa-edit"></i>
                                                </button>
                                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#delete-{{ $product->id }}">
                                                    <i class="far fa-trash-alt"></i>
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
    <script src="{{ asset('js/DashSid.js') }}"></script>
    @if (
            $errors->has('name') ||
            $errors->has('path') ||
            $errors->has('price')||
            $errors->has('description')||
            $errors->has('status')||
            $errors->has('quantity')
)
        <script>
            window.onload = function() {


                @if ($errors->has('name'))
                    UIkit.notification({
                        message: '{{ $errors->first('name') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif



                @if ($errors->has('price'))
                    UIkit.notification({
                        message: '{{ $errors->first('price') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif

                @if ($errors->has('description'))
                    UIkit.notification({
                        message: '{{ $errors->first('description') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('path'))
                    UIkit.notification({
                        message: '{{ $errors->first('path') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('status'))
                    UIkit.notification({
                        message: '{{ $errors->first('status') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('newprice'))
                    UIkit.notification({
                        message: '{{ $errors->first('newprice') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('quantity'))
                    UIkit.notification({
                        message: '{{ $errors->first('quantity') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
            };
        </script>
    @endif
@endsection
