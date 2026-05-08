<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BlogHub - Blog Management System')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        :root{
            --primary:#6C63FF;
            --secondary:#4F46E5;
            --dark:#111827;
            --light:#F3F4F6;
            --card:#ffffff;
            --text:#1F2937;
            --muted:#6B7280;
            --radius:16px;
        }

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Segoe UI',sans-serif;
            background:linear-gradient(135deg,#eef2ff,#f8fafc);
            color:var(--text);
            min-height:100vh;
        }

        /* Navbar */
        .navbar{
            background:rgba(17,24,39,0.9)!important;
            backdrop-filter:blur(10px);
            padding:14px 0;
            box-shadow:0 4px 20px rgba(0,0,0,0.15);
        }

        .navbar-brand{
            font-size:1.7rem;
            font-weight:700;
            color:#fff!important;
        }

        .nav-link{
            color:#d1d5db!important;
            margin-left:12px;
            transition:0.3s;
            font-weight:500;
        }

        .nav-link:hover{
            color:#fff!important;
            transform:translateY(-1px);
        }

        /* Blog Cards */
        .blog-card{
            border:none;
            border-radius:var(--radius);
            overflow:hidden;
            background:rgba(255,255,255,0.9);
            backdrop-filter:blur(8px);
            box-shadow:0 6px 20px rgba(0,0,0,0.08);
            transition:0.35s ease;
        }

        .blog-card:hover{
            transform:translateY(-8px);
            box-shadow:0 12px 30px rgba(0,0,0,0.15);
        }

        .blog-card img{
            height:220px;
            object-fit:cover;
        }

        .blog-card-body{
            padding:1.5rem;
        }

        .card-category{
            display:inline-block;
            background:linear-gradient(135deg,var(--primary),var(--secondary));
            color:#fff;
            padding:6px 14px;
            border-radius:30px;
            font-size:0.75rem;
            font-weight:600;
            margin-bottom:10px;
        }

        .card-title{
            font-size:1.3rem;
            font-weight:700;
            margin-bottom:10px;
            color:var(--dark);
        }

        .card-date{
            font-size:0.9rem;
            color:var(--muted);
        }

        /* Buttons */
        .btn-primary{
            background:linear-gradient(135deg,var(--primary),var(--secondary));
            border:none;
            border-radius:12px;
            padding:10px 20px;
            font-weight:600;
            transition:0.3s;
        }

        .btn-primary:hover{
            transform:translateY(-2px);
            opacity:0.95;
        }

        /* Filters */
        .filter-section{
            background:rgba(255,255,255,0.9);
            backdrop-filter:blur(10px);
            border-radius:var(--radius);
            padding:2rem;
            box-shadow:0 6px 20px rgba(0,0,0,0.08);
            margin-bottom:2rem;
        }

        .filter-section h5{
            font-weight:700;
            margin-bottom:1rem;
        }

        .form-control,
        .form-select{
            border-radius:12px;
            padding:12px;
            border:1px solid #d1d5db;
        }

        .form-control:focus,
        .form-select:focus{
            border-color:var(--primary);
            box-shadow:0 0 0 0.2rem rgba(108,99,255,0.25);
        }

        /* Alerts */
        .alert{
            border:none;
            border-radius:14px;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        }

        /* No Results */
        .no-results{
            text-align:center;
            padding:4rem 1rem;
            color:var(--muted);
        }

        .no-results i{
            font-size:4rem;
            margin-bottom:1rem;
            opacity:0.4;
        }

        /* Footer */
        footer{
            margin-top:4rem;
            background:#111827;
            color:#fff;
            border-top-left-radius:20px;
            border-top-right-radius:20px;
        }

        footer p{
            margin:0;
        }

        footer .text-muted{
            color:#9ca3af!important;
        }

        /* Responsive */
        @media(max-width:768px){

            .navbar-brand{
                font-size:1.4rem;
            }

            .blog-card img{
                height:180px;
            }

            .filter-section{
                padding:1.5rem;
            }
        }
    </style>

    @yield('custom-css')
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container-lg">
            <a class="navbar-brand" href="{{ route('home') }}">
                <i class="fas fa-blog"></i> BlogHub
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">
                            <i class="fas fa-home"></i> Home
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.login') }}">
                            <i class="fas fa-lock"></i> Admin
                        </a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>

    <!-- Flash Messages -->
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show m-3">
            <strong><i class="fas fa-exclamation-circle"></i> Oops!</strong>

            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show m-3">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show m-3">
            <i class="fas fa-times-circle"></i>
            {{ session('error') }}

            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- Main Content -->
    <main class="py-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-4 text-center">
        <div class="container-lg">
            <p class="fw-bold">&copy; 2026 BlogHub - Blog Management System</p>
        </div>
    </footer>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- AJAX JS -->
    <script src="{{ asset('js/blog-ajax.js') }}"></script>

    @yield('custom-js')

</body>
</html>