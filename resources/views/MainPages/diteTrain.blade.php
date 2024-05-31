<x-app-layout>
    @section('style')
        <link rel="stylesheet" href="{{ asset('css/perfectweight.css') }}">
        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
            <!-- UIkit CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/css/uikit.min.css" />
    <!-- UIkit JS -->
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/js/uikit.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/uikit@3.19.2/dist/js/uikit-icons.min.js"></script>
    @endsection
<div style="height: 100px"></div>
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
    @include('layouts.sidebar.sidebar')
        <!--Contact Us Section-->
        <section id="con_section">
            <center>
                <h1 style="color:#13ff00;" class="bebas-neue-regular"><i class="bi bi-envelope-check"></i>Dite
                </h1>
            </center>
            <div class="marg">
                <div class="half">
                    <form class="card2" method="POST" action="{{route('send')}}"  >
                        @csrf
                        <div class="row1">
                            <div class="start_s">
                                <center>
                                    <label for="username">Your Number or email</label>
                                </center>
                                <input type="text" name="connection"  required autocomplete="0">
                            </div>
                        </div>
                        <div class="row1">
                            <div class="start_s">
                                <center>
                                    <label for="username">Your Weight (kg)</label>
                                </center>
                                <input type="number" name="weight"  required autocomplete="0">
                            </div>
                        </div>
                        <div class="row1">
                            <div class="start_s">
                                <center>
                                    <label for="username">Your Height (cm)</label>
                                </center>
                                <input type="number" name="height" required autocomplete="0">
                            </div>
                        </div>
                        <br>
                        <div class="row2">
                            <label for="message">Notes</label>
                            <textarea class="form-control" name="notes" rows="5" required></textarea>
                        </div>
                        <br>
                        <center><button type="submit">Calc</button></center>
                    </form>
                </div>
            </div>
        </section>


        @section('script')
            @if (
                    $errors->has('weight') ||
                    $errors->has('height') ||
                    $errors->has('notes')||
                    $errors->has('connection')
                    )

                <script>
                    window.onload = function() {


                        @if ($errors->has('weight'))
                            UIkit.notification({
                                message: '{{ $errors->first('weight') }}',
                                status: 'danger',
                                pos: 'top-right'
                            });
                        @endif



                        @if ($errors->has('height'))
                            UIkit.notification({
                                message: '{{ $errors->first('height') }}',
                                status: 'danger',
                                pos: 'top-right'
                            });
                        @endif

                        @if ($errors->has('notes'))
                            UIkit.notification({
                                message: '{{ $errors->first('notes') }}',
                                status: 'danger',
                                pos: 'top-right'
                            });
                        @endif

                        @if ($errors->has('connection'))
                            UIkit.notification({
                                message: '{{ $errors->first('connection') }}',
                                status: 'danger',
                                pos: 'top-right'
                            });
                        @endif

                    };
                </script>
            @endif
        @endsection
</x-app-layout>
