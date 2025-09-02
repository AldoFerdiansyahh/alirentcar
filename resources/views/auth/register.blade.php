<x-guest-layout>
    <div class="auth-card">
        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Ali Rent Logo" style="height: 60px;">
            </a>
        </div>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-input-label for="name" value="Name" class="text-white"/>
                <x-text-input id="name" class="block mt-1 w-full auth-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="email" value="Email" class="text-white"/>
                <x-text-input id="email" class="block mt-1 w-full auth-input" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Password" class="text-white"/>
                <x-text-input id="password" class="block mt-1 w-full auth-input"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" value="Confirm Password" class="text-white"/>
                <x-text-input id="password_confirmation" class="block mt-1 w-full auth-input"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm auth-link" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ms-4 auth-button">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>

        <div class="register-prompt">
            <p>Sudah punya akun? <a href="{{ route('login') }}">Masuk</a></p>
        </div>
    </div>
</x-guest-layout>