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
@include('MainPages.AdminPages.equipments.equipmentModal.Add')
        <h4 class="top">Equipments</h4>
        <div class="main">
            <p id="greater">Home <a class="greater" href="#"><i class="fas fa-greater-than"></i></a>Equipments</p>
            <div>
                <form class="d-flex" action="{{ route('AdminEquipments') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="query"
                        value="{{ request()->input('query') }}">
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Add">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                </form>
            </div>
        </div>
        <center>
            <div>
                <h4 class="text ">Total: {{ count($equipments) }}</h4>
            </div>
        </center>
    </main>

    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="oll">
                        <th>#</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($equipments->isEmpty())
                        <tr>
                            <td colspan="7">
                                <center>
                                    <h3>No Results</h3>
                                </center>
                            </td>
                        </tr>
                    @else
                        @foreach ($equipments as $equipment)
                        @include('MainPages.AdminPages.equipments.equipmentModal.Delete')
                        @include('MainPages.AdminPages.equipments.equipmentModal.Edit')
                            <tr>
                                <td>{{ $equipment->id }}</td>
                                <td>
                                    @if (isset($equipment->path))
                                        <a class="fancybox" href="{{ asset('storage/' . $equipment->path) }}">
                                            <img class="imgg" src="{{ asset('storage/' . $equipment->path) }}">
                                        </a>
                                    @else
                                    <center>
                                        <i class="fa-solid fa-dumbbell fa-2x" style="color: rgb(19, 225, 0);"></i>
                                    </center>
                                    @endif
                                </td>
                                <td>{{ $equipment->name }}</td>
                                <td>{{ $equipment->quantity }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#Edit-{{ $equipment->id }}">
                                        <i class="far fa-edit"></i>
                                    </button>
                                    <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#delete-{{ $equipment->id }}">
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
@if($errors->has('name') || $errors->has('quantity') || $errors->has('path'))
<script>
    window.onload = function() {
        @if($errors->has('name'))
            UIkit.notification({message: '{{ $errors->first('name') }}', status: 'danger', pos: 'top-right'});
        @endif

        @if($errors->has('quantity'))
            UIkit.notification({message: '{{ $errors->first('quantity') }}', status: 'danger', pos: 'top-right'});
        @endif

        @if($errors->has('path'))
            UIkit.notification({message: '{{ $errors->first('path') }}', status: 'danger', pos: 'top-right'});
        @endif
    };
</script>
@endif
<script src="{{asset('js/DashSid.js')}}"></script>
@endsection

