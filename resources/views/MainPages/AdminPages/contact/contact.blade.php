@extends('layouts.adminapp')
@section('style')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/js/uikit-icons.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/table2.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashSide.css') }}">
@endsection
@section('content')
@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
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

                <h4 class="top">contact info</h4>
                <div class="main">
                    <p id="greater">Home <a class="greater" href="#"><i
                    class="fas fa-greater-than"></i></a>CONTACT US</p>
                    <div>
                    </div>
                </div>
            </main>
@include('MainPages.AdminPages.contact.ContactsModal.location')
@include('MainPages.AdminPages.contact.ContactsModal.Edit')
            <div class="container mt-3">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Key</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">location</th>
                                <td>
                                    <button type="button" class="btn poll" data-bs-toggle="modal"
                                        data-bs-target="#location-{{ $contacts->id }}">
                                        <i class="fas fa-poll"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <th scope="row">phone</th>
                                <td>{{ $contacts->phone }}</td>
                            </tr>
                            <tr>
                                <th scope="row">email</th>
                                <td>{{ $contacts->email }}</td>
                            </tr>

                            <tr>
                                <th scope="row">whatsapp</th>
                                <td>{{ $contacts->whatsapp }}</td>
                            </tr>

                            <tr>
                                <th scope="row">facebook link</th>
                                <td>{{ $contacts->facebooklink }}</td>
                            </tr>

                            <tr>
                                <th scope="row">instgram link</th>
                                <td>{{ $contacts->instgramlink }}</td>
                            </tr>

                            <tr>
                                <th scope="row">X link</th>
                                <td>{{ $contacts->xlink }}</td>
                            </tr>
                            <tr>
                                <th scope="row">open days</th>
                                <td>{{ $contacts->daysopen }}</td>
                            </tr>
                            <tr>
                                <th scope="row">open time</th>
                                <td>{{ $contacts->timeopen }}</td>
                            </tr>
                            <tr>
                                <th scope="row">Actions</th>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#Edit-{{ $contacts->id }}">
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
    @if ($errors->has('location') || $errors->has('phone') || $errors->has('whatsapp' || $errors->has('facebooklink') || $errors->has('instgramlink') || $errors->has('xlink')) )
        <script>
            window.onload = function() {
                @if ($errors->has('location'))
                    UIkit.notification({
                        message: '{{ $errors->first('location') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif

                @if ($errors->has('phone'))
                    UIkit.notification({
                        message: '{{ $errors->first('phone') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif

                @if ($errors->has('whatsapp'))
                    UIkit.notification({
                        message: '{{ $errors->first('whatsapp') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('facebooklink'))
                    UIkit.notification({
                        message: '{{ $errors->first('facebooklink') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('instgramlink'))
                    UIkit.notification({
                        message: '{{ $errors->first('instgramlink') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
                @if ($errors->has('xlink'))
                    UIkit.notification({
                        message: '{{ $errors->first('xlink') }}',
                        status: 'danger',
                        pos: 'top-right'
                    });
                @endif
            };
        </script>
    @endif
    <script src="{{ asset('js/DashSid.js') }}"></script>
@endsection
