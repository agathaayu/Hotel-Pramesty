<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Navbar Redesign</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
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
    </style>
  </head>
  <body>
    
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">PRAMESTI HOTEL</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
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
                        <a class="nav-link" href="/send-email"> Send-Email</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  </body>
</html>
