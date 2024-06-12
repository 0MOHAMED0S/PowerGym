@extends('layouts.adminapp')
@section('style')
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
        <link rel="stylesheet" href="{{asset('css/dashSide.css')}}">
    @endsection
@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Left Content (3:1 width ratio) -->
            <div class="col-lg-10">
                <div style="height: 150px"></div>
                <div class="card-columns d-lg-flex ">
                    <div class="card">
                        <div class="card-body2">
                            <a class="card-icon" href="{{route('AdminUsers')}}"><i class="far fa-id-card"></i></a>
                            <pre class="card-text1 text-light">{{$usersCount}}</pre>
                            <p class="card-text text-light">USERS</p>
                            <a href="{{route('AdminUsers')}}" class="btn btn-light">SEE ALL </a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body2">
                            <a class="card-icon" href="{{route('AdminCoaches')}}"><i class="far fa-id-card"></i></a>
                            <pre class="card-text1 text-light">{{$coachesCount}}</pre>
                            <p class="card-text text-light">COACHES</p>
                            <a href="{{route('AdminCoaches')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body3">
                            <a class="card-icon" href="{{route('AdminRoles')}}"><i class="far fa-id-card"></i></a>
                            <pre class="card-text1 text-light">{{$rolesCount}}</pre>
                            <p class="card-text text-light">ADMIN ROLES </p>
                            <a href="{{route('AdminRoles')}}" class="btn btn-light">SEE ALL </a>
                        </div>
                    </div>
                </div>
                <pre></pre>
                <div class="card-columns d-lg-flex ">
                    <div class="card">
                        <div class="card-body4">
                            <a class="card-icon" href="{{route('AdminPackages')}}"><i class="far fa-compass"></i></a>
                            <pre class="card-text1 text-light">{{$packagesCount}}</pre>
                            <p class="card-text text-light">PACKAGES </p>
                            <a href="{{route('AdminPackages')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body5">
                            <a class="card-icon" href="{{route('logoname')}}"><i class="fas fa-money-check-alt"></i></a>
                            <pre class="card-text1 text-light"></pre>
                            <p class="card-text text-light">LOGO & Name</p>
                            <a href="{{route('logoname')}}" class="btn btn-light">SEE ALL</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body6">
                            <a class="card-icon" href="{{route('AdminContact')}}"><i class="fas fa-shopping-bag"></i></a>
                            <pre class="card-text1 text-light"></pre>
                            <p class="card-text text-light"> CONTACT US</p>
                            <a href="{{route('AdminContact')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>

                </div>
                <pre></pre>
                <div class="card-columns d-lg-flex ">
                    <div class="card">
                        <div class="card-body4">
                            <a class="card-icon" href="{{route('AdminEquipments')}}"><i class="far fa-compass"></i></a>
                            <pre class="card-text1 text-light">{{$Equipmentscount}}</pre>
                            <p class="card-text text-light">Equipments </p>
                            <a href="{{route('AdminEquipments')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body5">
                            <a class="card-icon" href="{{route('AdminSubscribers')}}"><i class="fas fa-money-check-alt"></i></a>
                            <pre class="card-text1 text-light">{{$Subscribecount}}</pre>
                            <p class="card-text text-light">Subscribers</p>
                            <a href="{{route('AdminSubscribers')}}" class="btn btn-light">SEE ALL</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body6">
                            <a class="card-icon" href="{{route('AdminShop')}}"><i class="fas fa-shopping-bag"></i></a>
                            <pre class="card-text1 text-light">{{$productscount}}</pre>
                            <p class="card-text text-light"> Products </p>
                            <a href="{{route('AdminShop')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>
                </div>
                <pre></pre>
                <div class="card-columns d-lg-flex ">
                    <div class="card">
                        <div class="card-body6">
                            <a class="card-icon" href="{{route('DiteTrainAdmin')}}"><i class="fas fa-shopping-bag"></i></a>
                            <pre class="card-text1 text-light">{{$train}}</pre>
                            <p class="card-text text-light"> Dite Train </p>
                            <a href="{{route('DiteTrainAdmin')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body6">
                            <a class="card-icon" href="{{route('orders')}}"><i class="fas fa-shopping-bag"></i></a>
                            <pre class="card-text1 text-light">{{$orders}}</pre>
                            <p class="card-text text-light"> Orders </p>
                            <a href="{{route('orders')}}" class="btn btn-light"> SEE ALL</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
    @section('script')
    <script src="{{asset('js/DashSid.js')}}"></script>
    @endsection
