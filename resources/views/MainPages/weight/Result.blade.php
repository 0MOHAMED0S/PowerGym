<x-app-layout>
    @section('style')
        <link rel="stylesheet" href="{{ asset('css/perfectweight.css') }}">
        {{-- Fonts --}}
        <link href="https://fonts.googleapis.com/css2?family=Monoton&display=swap" rel="stylesheet">
    @endsection
<div style="height: 100px"></div>
@include('layouts.sidebar.sidebar')

        <!--Contact Us Section-->
        <section id="con_section">
            <center>
                <h1 style="color:#13ff00;" class="bebas-neue-regular"><i class="bi bi-envelope-check"></i>Perfect Weight
                </h1>
            </center>
            <div class="marg">
                <div class="half">
                    <form class="card2"  >
                        <center><h2>Weight Status : <span>{{$weightStatus}}</span></h2></center>
                        <center><h2>Min Perfect Weight : <span>{{$minPerfectWeight}}</span></h2></center>
                        <center><h2>Max Perfect Weight : <span>{{$maxPerfectWeight}}</span></h2></center>
                        <center><a href="{{route('perfectweight')}}">Calculate Another Request </a></center>
                    </form>
                </div>
            </div>
        </section>


    @section('script')
        {{-- Coaches --}}
        <script src="{{ asset('js/coaches.js') }}"></script>
    @endsection
</x-app-layout>
