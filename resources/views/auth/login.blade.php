<x-guest-layout>
    <div class="auth-card">
        <div class="flex justify-center mb-6">
            <a href="/">
                <img src="{{ asset('images/logo.png') }}" alt="Ali Rent Logo" style="height: 60px;">
            </a>
        </div>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-input-label for="email" value="Email" class="text-white" />
                <x-text-input id="email" class="block mt-1 w-full auth-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" value="Password" class="text-white" />
                <div class="password-wrapper">
                    <x-text-input id="password" class="block mt-1 w-full auth-input"
                                    type="password"
                                    name="password"
                                    required autocomplete="current-password" />
                    <span id="toggle-password" class="toggle-password">
                        <i id="eye-icon-fa" class="fa-solid fa-eye"></i>
                    </span>
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-400">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm auth-link" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3 auth-button">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>

        <div class="register-prompt">
            <p>Belum punya akun? <a href="{{ route('register') }}">Daftar sekarang</a></p>
        </div>
    </div>
</x-guest-layout>

{{-- SCRIPT BARU UNTUK FONT AWESOME --}}
<script>
    const togglePassword = document.getElementById('toggle-password');
    const passwordInput = document.getElementById('password');
    const eyeIcon = document.getElementById('eye-icon-fa');

    togglePassword.addEventListener('click', function () {
        // Ganti tipe input dari password ke text atau sebaliknya
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);

        // Ganti ikon dengan mengubah class dari Font Awesome
        if (type === 'password') {
            eyeIcon.className = 'fa-solid fa-eye';
        } else {
            eyeIcon.className = 'fa-solid fa-eye-slash';
        }
    });
</script>