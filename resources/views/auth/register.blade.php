<x-guest-layout>
    <style>
        /* VIDEO BACKGROUND */
        #bg-video {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        body {
            height: 100vh;
            font-family: 'Montserrat', sans-serif;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.7);
            z-index: 1;
        }

        .container-custom {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 2;
        }

        form {
            background: rgba(0,0,0,0.6);
            padding: 2.5em;
            border-radius: 20px;
            backdrop-filter: blur(12px);
            box-shadow: 0 0 40px rgba(0,0,0,0.8);
            text-align: center;
            width: 340px;
        }

        /* FIX LOGO ANTI GEPENG */
        .logo-wrapper {
            display: flex;
            justify-content: center;
            margin-bottom: 15px;
        }

        .logo-wrapper img {
            width: 95px;
            height: 95px;
            object-fit: cover; /* 🔥 FIX UTAMA BIAR TIDAK GEPENG */
            border-radius: 50%;
            background: rgba(255,255,255,0.1);
            padding: 6px;
            box-shadow: 0 0 15px rgba(255,255,255,0.4);
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
            100% { transform: translateY(0px); }
        }

        p.title {
            color: white;
            font-size: 1.4rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .input-field {
            width: 100%;
            margin-bottom: 12px;
        }

        input {
            width: 100%;
            padding: 10px 15px;
            border-radius: 50px;
            border: none;
            background: rgba(255,255,255,0.05);
            color: white;
        }

        input::placeholder {
            color: #aaa;
        }

        input:focus {
            outline: none;
            background: rgba(255,255,255,0.1);
        }

        button {
            width: 100%;
            padding: 10px;
            border-radius: 50px;
            border: none;
            background: white;
            color: black;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        button:hover {
            transform: scale(1.05);
        }

        .back {
            position: absolute;
            top: -60px;
            left: 0;
            color: white;
            text-decoration: none;
            background: rgba(255,255,255,0.1);
            padding: 8px 16px;
            border-radius: 50px;
            backdrop-filter: blur(10px);
        }

        .back:hover {
            background: white;
            color: black;
        }
    </style>

    <!-- VIDEO BACKGROUND -->
    <video autoplay muted loop playsinline id="bg-video">
        <source src="{{ asset('jap.mp4') }}" type="video/mp4">
    </video>

    <div class="container-custom">

        <a href="{{ url('/') }}" class="back">← Back</a>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- LOGO -->
            <div class="logo-wrapper">
                <img src="{{ asset('peger.png') }}" alt="Logo">
            </div>

            <p class="title">Register</p>

            <!-- NAME -->
            <div class="input-field">
                <input type="text" name="name" placeholder="Name"
                    value="{{ old('name') }}" required autofocus>
                <x-input-error :messages="$errors->get('name')" class="mt-1 text-red-400 text-sm" />
            </div>

            <!-- USERNAME -->
            <div class="input-field">
                <input type="text" name="username" placeholder="Username"
                    value="{{ old('username') }}" required>
                <x-input-error :messages="$errors->get('username')" class="mt-1 text-red-400 text-sm" />
            </div>

            <!-- CLASS -->
            <div class="input-field">
                <input type="text" name="class" placeholder="Kelas (contoh: 10 PPLG)"
                    value="{{ old('class') }}" required>
                <x-input-error :messages="$errors->get('class')" class="mt-1 text-red-400 text-sm" />
            </div>

            <!-- PASSWORD -->
            <div class="input-field">
                <input type="password" name="password" placeholder="Password" required>
                <x-input-error :messages="$errors->get('password')" class="mt-1 text-red-400 text-sm" />
            </div>

            <!-- CONFIRM PASSWORD -->
            <div class="input-field">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-1 text-red-400 text-sm" />
            </div>

            <button type="submit">Register</button>

            <br><br>
            <a href="{{ route('login') }}" style="color:white;">
                Already registered?
            </a>
        </form>
    </div>
</x-guest-layout>