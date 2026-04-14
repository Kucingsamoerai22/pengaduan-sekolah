<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Aspirasi Siswa</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #000);
            color: #e5e7eb;
            font-family: 'Poppins', sans-serif;
        }

        /* NAVBAR */
        .navbar {
            background: rgba(255,255,255,0.05);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        /* GLASS */
        .glass {
            background: rgba(255,255,255,0.04);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            border: 1px solid rgba(255,255,255,0.08);
            box-shadow: 0 0 30px rgba(0,0,0,0.6);
        }

        /* ANIMATION */
        .fade-in {
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {opacity: 0; transform: translateY(10px);}
            to {opacity: 1; transform: translateY(0);}
        }

        /* LOGOUT BUTTON */
        .logout-btn {
            background: linear-gradient(45deg, #ef4444, #dc2626);
            color: white;
            font-size: 13px;
            font-weight: bold;
            padding: 8px 18px;
            border-radius: 999px;
            transition: 0.3s;
            border: none;
        }

        .logout-btn:hover {
            transform: scale(1.08);
            box-shadow: 0 0 12px #ef444488;
        }

        .logout-btn:active {
            transform: scale(0.95);
        }
    </style>
</head>

<body class="antialiased">

    <!-- NAVBAR -->
    <nav class="navbar px-6 py-4 flex justify-between items-center">

        <!-- LOGO / TITLE -->
        <h1 class="text-lg font-bold tracking-wide text-white">
            🎓 Aspirasi Siswa <span class="text-green-400 text-sm">v1.0</span>
        </h1>

        <!-- USER + LOGOUT -->
        <div class="flex items-center gap-4">

            <span class="text-sm text-gray-300 font-medium">
                👋 {{ Auth::user()->name }}
            </span>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">
                    ⏻ Logout
                </button>
            </form>

        </div>

    </nav>

    <!-- HEADER -->
    @isset($header)
        <header class="px-6 py-6">
            <div class="max-w-7xl mx-auto">
                <div class="text-2xl font-bold text-white fade-in">
                    {{ $header }}
                </div>
            </div>
        </header>
    @endisset

    <!-- CONTENT -->
    <main class="px-6 pb-10">
        {{ $slot }}
    </main>

</body>
</html>     