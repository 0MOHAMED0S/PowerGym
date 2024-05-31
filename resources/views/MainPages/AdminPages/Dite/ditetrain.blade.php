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
        <h4 class="top">Dite </h4>
        <div class="main">
            <p id="greater">Home <a class="greater" href="#"><i class="fas fa-greater-than"></i></a>Dite</p>
            <div>
                <form class="d-flex" action="{{ route('DiteTrainAdmin') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="query"
                        value="{{ request()->input('query') }}">
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <center>
            <div>
                <h4 class="text ">Total: {{ count($dites) }}</h4>
            </div>
        </center>
    </main>

    <div class="container mt-3">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr class="oll">
                        <th>#</th>
                        <th>name</th>
                        <th>connection</th>
                        <th>weight</th>
                        <th>height</th>
                        <th>notes</th>
                        <th>read</th>
                        <th>make as read</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($dites->isEmpty())
                        <tr>
                            <td colspan="7">
                                <center>
                                    <h3>No Results</h3>
                                </center>
                            </td>
                        </tr>
                    @else
                        @foreach ($dites as $dite)
                            <tr>
                                <td>{{ $dite->id }}</td>
                                <td>{{$dite->user->name}}</td>
                                <td>{{ $dite->connection }}</td>
                                <td>{{ $dite->weight }}</td>
                                <td>{{ $dite->height }}</td>
                                <td>{{ $dite->notes }}</td>
                                <td>
                                    @if ($dite->read == 1)
                                    <p class="red"></p>

                                    @else
                                    <p class="green"></p>

                                    @endif
                                </td>

                                <td>
                                    <a href="{{route('read',['id'=>$dite->id])}}" class="btn btn-primary" >
                                    </a>
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
@if($errors->has('weight') || $errors->has('height') || $errors->has('connection') || $errors->has('notes'))
<script>
    window.onload = function() {
        @if($errors->has('weight'))
            UIkit.notification({message: '{{ $errors->first('weight') }}', status: 'danger', pos: 'top-right'});
        @endif

        @if($errors->has('height'))
            UIkit.notification({message: '{{ $errors->first('height') }}', status: 'danger', pos: 'top-right'});
        @endif

        @if($errors->has('connection'))
            UIkit.notification({message: '{{ $errors->first('connection') }}', status: 'danger', pos: 'top-right'});
        @endif
        @if($errors->has('notes'))
            UIkit.notification({message: '{{ $errors->first('connection') }}', status: 'danger', pos: 'top-right'});
        @endif
    };
</script>
@endif
<script src="{{asset('js/DashSid.js')}}"></script>
@endsection

