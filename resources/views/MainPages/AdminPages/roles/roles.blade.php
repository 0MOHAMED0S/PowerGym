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
        <h4 class="top">Roles</h4>
        <div class="main">
            <p id="greater">Home <a class="greater" href="#"><i class="fas fa-greater-than"></i></a>Roles</p>
            <div>
                <form class="d-flex" action="{{ route('AdminRoles') }}" method="GET">
                    <input class="form-control me-2" type="search" placeholder="Search" name="query"
                        value="{{ request()->input('query') }}">
                    <button class="btn btn-success" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
        <center>
            <div>
                <h4 class="text ">Total: {{ count($roles) }}</h4>
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
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($roles->isEmpty())
                        <tr>
                            <td colspan="7">
                                <center>
                                    <h3>No Results</h3>
                                </center>
                            </td>
                        </tr>
                    @else
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @if ($role->name == 'Admin')
                                    {{$AdminRoleCount}}
                                    @elseif ($role->name == 'SuberAdmin')
                                    {{$SuberAdminRoleCount}}
                                    @elseif ($role->name == 'Coache')
                                    {{$CoacheRoleCount}}
                                    @elseif ($role->name == 'User')
                                    {{$UserRoleCount}}
                                    @endif
                                </td>
                                <td>
                                    <a class="pin" href="{{ route('AdminRolesCounter', ['role' => $role->name]) }}"><i class="fa-regular fa-eye" style="color: #ffffff;"></i></a>
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
    <script src="{{asset('js/DashSid.js')}}"></script>
    @endsection
