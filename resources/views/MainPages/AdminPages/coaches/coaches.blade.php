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
                    <h4 class="top">Coaches</h4>
                    <div class="main">
                        <p id="greater">Home <a class="greater" href="#"><i
                                    class="fas fa-greater-than"></i></a>Coaches</p>
                        <div>
                            <form class="d-flex" action="{{ route('AdminCoaches') }}" method="GET">
                                <input class="form-control me-2" type="search" placeholder="Search" name="query"
                                    value="{{ request()->input('query') }}">
                                <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                    <center>
                        <div>
                            <h4 class="text ">Total: {{ count($coaches) }}</h4>
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
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($coaches->isEmpty())
                                    <tr>
                                        <td colspan="7">
                                            <center>
                                                <h3>No Results</h3>
                                            </center>
                                        </td>
                                    </tr>
                                @else
                                    @foreach ($coaches as $coache)
                                    @include('MainPages.AdminPages.coaches.coachesModal.Edit')
                                    @include('MainPages.AdminPages.coaches.coachesModal.Delete')
                                        <tr>
                                            <td>{{ $coache->id }}</td>
                                            <td>
                                                @if (isset($coache->image->path))
                                                    <div uk-lightbox>
                                                        <a href="{{ asset('storage/' . $coache->image->path) }}"
                                                            data-caption="{{ $coache->name }}">
                                                            <img class="imgg"
                                                                src="{{ asset('storage/' . $coache->image->path) }}">
                                                    </div>
                                                @else
                                                    <center>
                                                        <i class="fa-solid fa-dumbbell fa-2x"
                                                            style="color: rgb(19, 225, 0);"></i>
                                                    </center>
                                                @endif
                                            </td>
                                            <td>{{ $coache->name }}</td>
                                            <td>{{ $coache->email }}</td>
                                            <td>{{ $coache->phone_number }}</td>
                                            <td>{{ $coache->role }}</td>
                                            <td>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#Edit-{{ $coache->id }}">
                                                <i class="far fa-edit"></i>
                                                </button>
                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#delete-{{ $coache->id }}">
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
    @if($errors->has('name') || $errors->has('email') || $errors->has('phone_number') || $errors->has('path') || $errors->has('role'))
        <script>
            window.onload = function() {
                @if($errors->has('name'))
                    UIkit.notification({message: '{{ $errors->first('name') }}', status: 'danger', pos: 'top-right'});
                @endif

                @if($errors->has('email'))
                    UIkit.notification({message: '{{ $errors->first('email') }}', status: 'danger', pos: 'top-right'});
                @endif

                @if($errors->has('path'))
                    UIkit.notification({message: '{{ $errors->first('path') }}', status: 'danger', pos: 'top-right'});
                @endif

                @if($errors->has('phone_number'))
                    UIkit.notification({message: '{{ $errors->first('phone_number') }}', status: 'danger', pos: 'top-right'});
                @endif

                @if($errors->has('status'))
                    UIkit.notification({message: '{{ $errors->first('status') }}', status: 'danger', pos: 'top-right'});
                @endif
            };
        </script>
        @endif
@endsection
