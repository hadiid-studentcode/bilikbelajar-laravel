<!DOCTYPE html>
<html lang="en" class="light-style" dir="ltr" data-theme="theme-default">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <title>Bilik Belajar - Platform Pembelajaran Online</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #2C7BE5;
            --secondary-color: #6B7A99;
            --accent-color: #00D097;
            --gradient-start: #2C7BE5;
            --gradient-end: #2563EB;
        }

        body {
            background: linear-gradient(135deg, #F8FAFF 0%, #EDF2FF 100%);
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar {
            background: rgba(255, 255, 255, 0.95) !important;
            backdrop-filter: blur(10px);
        }

        .navbar-brand {
            color: var(--primary-color) !important;
            font-weight: 700;
            font-size: 1.5rem;
        }

        .hero-section {
            padding: 80px 0;
        }

        .display-4 {
            color: #2b2c40;
            font-weight: 700;
            font-size: 3.5rem;
        }

        .lead {
            color: var(--secondary-color);
            font-size: 1.2rem;
            line-height: 1.8;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--gradient-start), var(--gradient-end)) !important;
            border: none !important;
            padding: 12px 30px !important;
            box-shadow: 0 4px 15px rgba(44, 123, 229, 0.4);
            transition: all 0.3s ease !important;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 123, 229, 0.5);
        }

        .btn-outline-primary {
            border: 2px solid var(--primary-color) !important;
            padding: 12px 30px !important;
            transition: all 0.3s ease !important;
        }

        .btn-outline-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(44, 123, 229, 0.3);
        }

        .feature-card {
            background: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 20px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 15px;
        }

        footer {
            background: white !important;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/bilikbelajar/icon/icon.png') }}" />

       @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="#"> <img src="{{ asset('assets/bilikbelajar/icon/icon.png') }}"
                    alt="" class=" h-auto" width="50"></i>Bilik Belajar</a>
        </div>
    </nav>

    <div class="hero-section min-vh-100 d-flex align-items-center">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h1 class="display-4 mb-4">Belajar Lebih Mudah di Bilik Belajar</h1>
                    <p class="lead mb-5">Platform pembelajaran yang inovatif untuk mendukung pendidikan digital dengan
                        fitur interaktif dan pengalaman belajar yang menyenangkan.</p>
                    <div class="d-grid gap-3 d-md-flex">
                        <a href="{{ route('login') }}" class="btn btn-primary btn-lg"><i
                                class="fas fa-chalkboard-teacher me-2"></i>Login Guru</a>
                        <a href="{{ route('siswa') }}" class="btn btn-outline-primary btn-lg"><i
                                class="fas fa-user-graduate me-2"></i>Login Siswa</a>
                    </div>
                </div>
                <div class="col-lg-6 d-none d-lg-block">
                    <div class="text-center">
                        <img src="https://images.unsplash.com/photo-1563394867331-e687a36112fd?q=80&w=1752&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
                            alt="Education Image" class="img-fluid rounded-4 shadow">
                    </div>
                </div>
            </div>

            <div class="row mt-5 pt-5">
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-laptop-code feature-icon"></i>
                        <h4>Pembelajaran Digital</h4>
                        <p>Akses materi pembelajaran kapan saja dan dimana saja</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-users feature-icon"></i>
                        <h4>Kolaborasi Interaktif</h4>
                        <p>Diskusi aktif antara guru dan siswa</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center">
                        <i class="fas fa-chart-line feature-icon"></i>
                        <h4>Pantau Perkembangan</h4>
                        <p>Lacak kemajuan belajar dengan mudah</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="py-4 mt-auto">
        <div class="container text-center">
            <p class="mb-0 text-muted">&copy; 2024 Bilik Belajar. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
