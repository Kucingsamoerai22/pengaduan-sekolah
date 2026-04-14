<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            height: 100vh;
            font-family: 'Segoe UI', sans-serif;
        }

        .bg-image {
            background: url("{{ asset('kuil.png') }}") no-repeat center center/cover;
            height: 100vh;
            position: relative;
        }

        .overlay {
            position: absolute;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
        }

        .content {
            position: relative;
            z-index: 2;
            height: 100%;
        }

        .title {
            color: white;
            font-size: 48px;
            font-weight: bold;
        }

        .subtitle {
            color: #ddd;
            font-size: 18px;
        }

        .btn-custom {
            width: 150px;
            margin: 10px;
        }
    </style>
</head>
<body>

<div class="bg-image">
    <div class="overlay"></div>

    <div class="container content d-flex align-items-center justify-content-between">

        <!-- KIRI (TEXT) -->
        <div>
            <h1 class="title">Sistem Pengaduan Sekolah</h1>
            <p class="subtitle">Kami tidak pernah meragukan tamu, meski permintaannya aneh-aneh.</p>
        </div>

        <!-- KANAN (BUTTON) -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-custom">Login</a><br>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg btn-custom">Register</a>
        </div>

    </div>
</div>

</body>
</html>