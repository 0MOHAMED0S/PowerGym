<x-guest-layout>



    <div style="display: flex;">
        <div class="login-container">
            <h1 class="login-title">Register To Power Gym</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="login-form" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="login-input-container">
                    <label for="name">User Name </label>
                    <input type="text" id="name" name="name" value="{{old('name')}}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="login-input-container">
                    <label for="email">Your Email </label>
                    <input type="email" id="name" name="email" value="{{old('email')}}" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="login-input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                <div class="login-input-container">
                    <label for="password_confirmation">Conferm Password</label>
                    <input type="password" id="password"  name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>
                <br>
                <button type="submit" class="login-button">Sign In</button>
            </form>
            <center><h1 style="color:rgb(30, 255, 0)">OR</h1></center>
            <center>
                <a href="{{ route('GoogleRedirect') }}" type="button" class="login-with-google-btn" >
                    Sign up with Google
                </a>
            </center>
            <br>
            <div class="login-links">
                <a href="{{route('login')}}">Already registered?</a>
            </div>
        </div>
        <div id="img">
            <img src="{{ asset('Files/images/AboutUs/7e430418-6cd8-4dcd-919c-290dcabb31ff.jpg') }}" alt=""
                style="width: 400px; box-shadow: 0px 0px 10px rgb(14 255 4);    height: 100%;">
        </div>
    </div>
</x-guest-layout>

