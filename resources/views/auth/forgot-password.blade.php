<x-guest-layout>
    {{-- <div class="mb-4 text-sm text-gray-600">
        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Email Password Reset Link') }}
            </x-primary-button>
        </div>
    </form> --}}

    <div style="display: flex;">
        <div class="login-container">
            <h1 class="login-title">Forgot your password</h1>
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />
            <form class="login-form" method="POST" action="{{ route('password.email') }}">
                @csrf
                <div class="login-input-container">
                    <label for="email">Your email</label>
                    <input type="email" id="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username">
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>
                <br>
                <button type="submit" class="login-button">Email Password Reset Link</button>
            </form>
        </div>
        <div id="img">
            <img src="{{ asset('Files/images/AboutUs/7e430418-6cd8-4dcd-919c-290dcabb31ff.jpg') }}" alt=""
                style="width: 400px; box-shadow: 0px 0px 10px rgb(14 255 4);" height="400px">
        </div>
    </div>
</x-guest-layout>
