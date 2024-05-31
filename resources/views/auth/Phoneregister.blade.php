<x-guest-layout>
    {{-- <form method="POST" action="{{ route('start') }}">
        @csrf
        <input type="text" name="phone_number" placeholder="Enter your phone number">
        <button type="submit">Start Verification</button>
    </form>
    <form method="POST" action="{{ route('check') }}">
        @csrf
        <input type="hidden" name="request_id" value="798b35a6319040cdadffe05fdb2f0cfd">
        <input type="text" name="code" placeholder="Enter verification code">
        <button type="submit">Verify</button>
    </form> --}}
    <div style="display: flex;">
        <div class="login-container">
            <h1 class="login-title">Login To Power Gym</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <!-- Display error message -->
            @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            <form class="login-form" method="POST" action="{{ route('start') }}">
                @csrf
                <div class="login-input-container">
                    <label for="name">User Name</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>
                <div class="login-input-container">
                    <label for="phone_number">Your phone</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number') }}" placeholder="Enter your phone number" required />
                    <x-input-error :messages="$errors->get('phone_number')" class="mt-2" />
                </div>
                <div class="login-input-container">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required autocomplete="current-password">
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>
                <div class="login-input-container">
                    <label for="password_confirmation">Confirm Password</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
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
                <a href="{{ route('register') }}">Don't have an account? Sign Up</a>
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
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
