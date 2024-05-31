<x-guest-layout>
    <div style="display: flex;">
        <div class="login-container">
            <h1 class="login-title">Login To Power Gym</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="login-form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="login-input-container">
                    <label for="email">Your email</label>
                    <input type="email" id="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <div class="login-input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                </div>
                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                    </label>
                </div>
                <br>
                <button type="submit" class="login-button">Sign In</button>
            </form>
            <center><h1 style="color:rgb(30, 255, 0)">OR</h1></center>
            <center>
                <a href="{{ route('GoogleRedirect') }}" type="button" class="login-with-google-btn" >
                    Sign in with Google
                </a>
            </center>
            <br>
            <div class="login-links">
                <a href="{{route('register')}}">Don't have an account? Sign Up</a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
            </div>
        </div>
        <div id="img">
            <img src="{{ asset('Files/images/AboutUs/7e430418-6cd8-4dcd-919c-290dcabb31ff.jpg') }}" alt=""
                style="width: 400px; box-shadow: 0px 0px 10px rgb(14 255 4);" height="400px">
        </div>
    </div>
</x-guest-layout>
