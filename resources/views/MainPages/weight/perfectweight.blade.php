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
                    <form class="card2" method="POST" action="{{route('weightresult')}}"  >
                        @csrf
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
                        <center><button type="submit">Calc</button></center>
                    </form>
                </div>
            </div>
        </section>


    @section('script')
        {{-- Coaches --}}
        <script src="{{ asset('js/coaches.js') }}"></script>
    @endsection
</x-app-layout>
