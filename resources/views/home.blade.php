<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Room Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #3498db;
            --secondary-color: #2ecc71;
            --dark-color: #2c3e50;
        }
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            color: var(--dark-color);
        }
        .hero-section {
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.9), rgba(46, 204, 113, 0.9)), 
                        url('/api/placeholder/1920/1080') center/cover;
            color: white;
            padding: 150px 0;
            position: relative;
            overflow: hidden;
        }
        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(52, 152, 219, 0.7), rgba(46, 204, 113, 0.7));
        }
        .hero-content {
            position: relative;
            z-index: 10;
        }
        .card-hover {
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        .card-hover:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.15);
        }
        .section-title {
            position: relative;
            margin-bottom: 30px;
        }
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 100px;
            height: 3px;
            background: var(--primary-color);
            transform: translateX(-50%);
        }
        .icon-box {
            display: flex;
            align-items: center;
            margin-bottom: 20px;
        }
        .icon-box i {
            font-size: 3rem;
            color: var(--primary-color);
            margin-right: 20px;
        }
        .navbar {
            background: linear-gradient(135deg, #6a11cb, #2575fc);
            padding: 12px 20px;
        }
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
            color: #fff !important;
        }
        .nav-link {
            color: white !important;
            font-weight: 500;
            transition: 0.3s ease-in-out;
            padding: 8px 15px;
        }
        .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #ffeb3b !important;
        }
        .navbar-toggler {
            border: none;
            background: rgba(255, 255, 255, 0.2);
        }
        .navbar-toggler-icon {
            filter: invert(1);
        }
        .auth-buttons .btn {
            font-weight: 500;
            margin-left: 10px;
            border-radius: 8px;
            position: relative;
            overflow: hidden;
            transition: all 0.4s ease;
            z-index: 1;
        }
        .btn-login {
            background-color: transparent;
            border: 2px solid white;
            color: white;
        }
        .btn-login:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: white;
            transition: all 0.4s ease;
            z-index: -1;
        }
        .btn-login:hover {
            color: #6a11cb;
        }
        .btn-login:hover:before {
            left: 0;
        }
        .btn-register {
            background-color: white;
            color: #6a11cb;
            border: 2px solid white;
        }
        .btn-register:before {
            content: '';
            position: absolute;
            top: 0;
            right: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: all 0.4s ease;
            z-index: -1;
        }
        .btn-register:hover {
            color: white;
            background-color: transparent;
        }
        .btn-register:hover:before {
            right: 0;
        }
        .btn-logout {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }
        .btn-logout:hover {
            background-color: rgba(255, 0, 0, 0.3);
            border-color: white;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }
        .user-welcome {
            color: white;
            margin-right: 10px;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .auth-buttons .btn:active {
            transform: scale(0.95);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }
    
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">PRAMESTI HOTEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('kamar') }}">List Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/tipe-kamar">List Tipe-Kamar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/send-email">Send-Email</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('user.management') }}">Management User</a>
                    </li>
                
                </ul>
                
                <!-- Authentication Links -->
                <div class="auth-buttons">
                    @guest
                        <a href="{{ route('login') }}" class="btn btn-login">Login</a>
                        <a href="{{ route('register') }}" class="btn btn-register">Register</a>
                    @else
                        <span class="user-welcome">Welcome, {{ Auth::user()->name }}</span>
                        <a href="{{ route('logout') }}" 
                           class="btn btn-logout"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    @endguest
                </div>
            </div>
        </div>
    </nav>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                confirmButtonText: 'OK'
            });
        </script>
    @endif

    <!-- Hero Section -->
    <div class="hero-section text-center">
        <div class="container hero-content">
            <h1 class="display-4 fw-bold mb-4">Smart Room Management</h1>
            <p class="lead mb-5">Efisien, Modern, dan Terpadu</p>
            <div class="d-flex justify-content-center">
                <a href="{{ route('kamar.create') }}" class="btn btn-light btn-lg me-3">
                    <i class="fas fa-plus-circle me-2"></i>Tambah Kamar
                </a>
                <a href="{{ route('tipe-kamar.create') }}" class="btn btn-outline-light btn-lg">
                    <i class="fas fa-layer-group me-2"></i>Tambah Tipe Kamar
                </a>
            </div>
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="container mt-5">
        <div class="row">
            @php
                $totalKamar = $kamars->count();
                $availableKamar = $kamars->where('status', 'tersedia')->count();
                $tipekamarCount = $tipekamars->count();
            @endphp
            <div class="col-md-4 mb-4">
                <div class="card card-hover bg-primary text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-hotel mb-3 display-4"></i>
                        <h3>Total Kamar</h3>
                        <h2>{{ $totalKamar }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-hover bg-success text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-check-circle mb-3 display-4"></i>
                        <h3>Kamar Tersedia</h3>
                        <h2>{{ $availableKamar }}</h2>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card card-hover bg-warning text-white">
                    <div class="card-body text-center">
                        <i class="fas fa-tags mb-3 display-4"></i>
                        <h3>Tipe Kamar</h3>
                        <h2>{{ $tipekamarCount }}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Room Types Section -->
    <div class="container mt-5">
        <h2 class="text-center mb-5 section-title">Tipe Kamar Kami</h2>
        <div class="row">
            @foreach($tipekamars as $tipe)
            <div class="col-md-4 mb-4">
                <div class="card card-hover h-100 shadow-sm">
                    <div class="card-body">
                        <div class="icon-box">
                            <i class="fas fa-door-open"></i>
                            <h3 class="card-title">{{ $tipe->nama_tipe }}</h3>
                        </div>
                        <p class="card-text text-muted">
                            <strong>Harga:</strong> Rp {{ number_format($tipe->harga, 0, ',', '.') }}
                        </p>
                        <p>{{ Str::limit($tipe->fasilitas, 100) }}</p>
                        <div class="d-flex justify-content-between mt-3">
                            <span class="badge bg-info">
                                <i class="fas fa-home me-1"></i>
                                Total: {{ $tipe->kamars->count() }}
                            </span>
                            <span class="badge bg-success">
                                <i class="fas fa-check me-1"></i>
                                Tersedia: {{ $tipe->kamars()->where('status', 'tersedia')->count() }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Available Rooms Section -->
    <div class="container mt-5 mb-5">
        <h2 class="text-center mb-5 section-title">Kamar Tersedia</h2>
        <div class="row">
            @foreach($kamars->where('status', 'tersedia')->take(6) as $kamar)
            <div class="col-md-4 mb-4">
                <div class="card card-hover h-100 shadow-sm">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h4 class="card-title mb-0">
                                <i class="fas fa-door-open me-2 text-primary"></i>
                                Kamar {{ $kamar->nomor_kamar }}
                            </h4>
                            <span class="badge bg-success">Tersedia</span>
                        </div>
                        <div class="mb-2">
                            <strong>Tipe:</strong> {{ $kamar->tipekamar->nama_tipe }}
                        </div>
                        <div>
                            <strong>Lantai:</strong> {{ $kamar->lantai }}
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <footer class="bg-dark text-white text-center py-3">
        <div class="container">
            <p class="mb-0">©️ {{ date('Y') }} Hotel Room Management System</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>