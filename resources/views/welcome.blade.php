<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Landing Page</title>

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
            background: rgba(0,0,0,0.4);
        }

        .content {
            position: relative;
            z-index: 2;
            height: 100%;
        }

        /* GLASS BOX STYLE */
        .glass-box {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(15px); /* Efek Buram Kaca */
            -webkit-backdrop-filter: blur(15px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 40px;
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .logo-pgri {
            width: 120px; /* Ukuran logo agak besar */
            height: auto;
            margin-bottom: 20px;
            filter: drop-shadow(0 0 10px rgba(0,0,0,0.5));
        }

        .title {
            color: white;
            font-size: 42px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .subtitle {
            color: rgba(255, 255, 255, 0.8);
            font-size: 18px;
            margin-bottom: 0;
        }

        .btn-custom {
            width: 180px;
            margin: 10px;
            border-radius: 12px;
            font-weight: 600;
            transition: 0.3s;
        }

        .btn-primary {
            background: #3b82f6;
            border: none;
        }

        .btn-primary:hover {
            background: #2563eb;
            transform: translateY(-3px);
        }

        .btn-outline-light:hover {
            transform: translateY(-3px);
        }
    </style>
</head>
<body>

<div class="bg-image">
    <div class="overlay"></div>

    <div class="container content d-flex align-items-center justify-content-between">

        <div class="glass-box text-start">
            <img src="{{ asset('peger.png') }}" alt="Logo PGRI" class="logo-pgri">
            
            <h1 class="title">Sistem Pengaduan Sekolah</h1>
            <p class="subtitle">Kami tidak pernah meragukan tamu, meski permintaannya aneh-aneh.</p>
        </div>

        <div class="text-center d-flex flex-column align-items-center">
            <a href="{{ route('login') }}" class="btn btn-primary btn-lg btn-custom shadow">Login</a>
            <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg btn-custom">Register</a>
        </div>

    </div>
</div>

</body>
</html>