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
                    <h4 class="top">LOGO & NAME</h4>
                    <div class="main">
                        <p id="greater">Home <a class="greater" href="#"><i class="fas fa-greater-than"></i></a>LOGO
                            & NAME</p>
                    </div>
                </main>

                <div class="container mt-3">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr class="oll">
                                    <th>Logo</th>
                                    <th>First Name</th>
                                    <th>Second Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('MainPages.AdminPages.logo&Name.LogoNameModal.EditPackage')
                                <tr>
                                    <td>
                                        @if ($ModelsLogoName->logopath == null)
                                            <i class="fa-solid fa-dumbbell" style="color: rgb(19, 225, 0);"></i>
                                        @else
                                            <div uk-lightbox>
                                                <a href="{{ asset('storage/' . $ModelsLogoName->logopath) }}"
                                                    data-caption="LOGO">
                                                    <img class="imgg"
                                                        src="{{ asset('storage/' . $ModelsLogoName->logopath) }}">
                                            </div>
                                        @endif
                                    </td>
                                    <td>{{ $ModelsLogoName->firstname }}</td>
                                    <td>{{ $ModelsLogoName->secondname }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#Edit-{{ $ModelsLogoName->id }}">
                                            <i class="far fa-edit"></i>
                                        </button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    @if ($errors->has('firstname') || $errors->has('secondname') || $errors->has('path'))
        <script>
            window.onload = function() {
                @if ($errors->has('firstname'))
                    UIkit.notification({
                        message: '{{ $errors->first('firstname') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif

                @if ($errors->has('secondname'))
                    UIkit.notification({
                        message: '{{ $errors->first('secondname') }}',
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
            };
        </script>
    @endif
    <script src="{{ asset('js/DashSid.js') }}"></script>
@endsection
