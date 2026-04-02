<x-guest-layout>
    <style>
        html, body {
            height: 100%;
            margin: 0;
        }

        body {
            background: url("{{ asset('rose.png') }}") no-repeat center center/cover;
            position: relative;
        }

        /* 🔥 OVERLAY FULL SCREEN */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.6);
            z-index: 1;
        }

        /* WRAPPER */
        .login-wrapper {
            position: relative;
            z-index: 2;

            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* CARD */
        .login-card {
            width: 100%;
            max-width: 400px;
            padding: 30px;
            border-radius: 15px;
            background: rgba(255,255,255,0.1);
            backdrop-filter: blur(12px);
            color: white;
            box-shadow: 0 0 40px rgba(0,0,0,0.7);
        }

        /* LOGO */
        .logo {
            display: block;
            margin: 0 auto 20px;
            width: 80px;
        }

        label, span, a {
            color: #ddd !important;
        }

        input {
            background: rgba(255,255,255,0.2) !important;
            color: white !important;
            border: none !important;
        }

        button:hover {
            transform: scale(1.05);
            transition: 0.3s;
        }
    </style>

    <div class="login-wrapper">
        <div class="login-card">

            <img src="{{ asset('peger.png') }}" class="logo" alt="logo">

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div>
                    <x-input-label for="username" :value="__('Username')" />
                    <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                        :value="old('username')" required autofocus />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="block mt-3">
                    <label class="inline-flex items-center">
                        <input type="checkbox" name="remember">
                        <span class="ms-2 text-sm">Remember me</span>
                    </label>
                </div>

                <div class="mt-4 text-center">
                    <x-primary-button class="w-full justify-center">
                        Login
                    </x-primary-button>
                </div>

                @if (Route::has('password.request'))
                    <div class="text-center mt-3">
                        <a href="{{ route('password.request') }}" class="text-sm">
                            Forgot password?
                        </a>
                    </div>
                @endif
            </form>

        </div>
    </div>
</x-guest-layout>