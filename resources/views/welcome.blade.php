<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <title>Bilik Belajar - LMS Pembelajaran Biologi</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/bilikbelajar/icon/icon.png') }}" />


    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600&family=Nunito:wght@600;700;800&display=swap"
        rel="stylesheet">

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="{{ asset('assets/landingpages/lib/animate/animate.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/landingpages/lib/owlcarousel/assets/owl.carousel.min.css') }}" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="{{ asset('assets/landingpages/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="{{ asset('assets/landingpages/css/style.css') }}" rel="stylesheet">
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
    @endif
</head>

<body>
    <!-- Spinner Start -->
    <div id="spinner"
        class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <!-- Spinner End -->


    <!-- Navbar Start -->
    <nav class="navbar navbar-expand-lg bg-white navbar-light shadow sticky-top p-0">
        <a href="index.html" class="navbar-brand d-flex align-items-center px-4 px-lg-5">
            <h2 class="m-0 text-primary"></h2>
            <img src="{{ asset('assets/landingpages/bilikbelajar/images/icon.png') }}" alt="Bilik Belajar Logo"
                class="img-fluid" style="max-height: 60px; width: auto;">
            Bilik Belajar
            </h2>
        </a>
        <button type="button" class="navbar-toggler me-4" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarCollapse">
            <div class="navbar-nav ms-auto p-4 p-lg-0">
                <a href="#home" class="nav-item nav-link active">Home</a>
                <a href="#about" class="nav-item nav-link">About</a>
                <!-- <a href="#courses" class="nav-item nav-link">Courses</a> -->
                <a href="#Author" class="nav-item nav-link">Author</a>
                <a href="#contact" class="nav-item nav-link">Contact</a>
            </div>
            <a href="#about" class="btn btn-primary py-4 px-lg-5 d-none d-lg-block">Join Now<i
                    class="fa fa-arrow-right ms-3"></i></a>
        </div>
    </nav>
    <!-- Navbar End -->


    <!-- Carousel Start -->
    <div class="container-fluid p-0 mb-5" id="home">
        <div class="owl-carousel header-carousel position-relative">
            <div class="owl-carousel-item position-relative">
                <img class="img-fluid" src="{{ asset('assets/landingpages/bilikbelajar/images/corusel1.jpg') }}"
                    alt="">
                <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center"
                    style="background: rgba(24, 29, 56, .7);">
                    <div class="container">
                        <div class="row justify-content-start">
                            <div class="col-sm-10 col-lg-8">
                                <h5 class="text-primary text-uppercase mb-3 animated slideInDown">Platform Pembelajaran
                                    Biologi</h5>
                                <h1 class="display-3 text-white animated slideInDown">Media Digital Pembelajaran Biologi
                                    Berbasis LMS</h1>
                                <p class="fs-5 text-white mb-4 pb-2">Sistem pembelajaran berbasis Learning Management
                                    System</p>
                                <!-- <a href="#about" class="btn btn-primary py-md-3 px-md-5 me-3 animated slideInLeft">Pelajari Lebih Lanjut</a> -->
                                <a href="#about" class="btn btn-light py-md-3 px-md-5 animated slideInRight">Mulai
                                    Belajar</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Carousel End -->


    <!-- Service Start -->
    <div class="container-xxl py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-book-open text-primary mb-4"></i>
                            <h5 class="mb-3">Materi Pembelajaran</h5>
                            <p>Akses materi pembelajaran yang lengkap dan terstruktur untuk memudahkan proses belajar
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-tasks text-primary mb-4"></i>
                            <h5 class="mb-3">Kuis</h5>
                            <p>Evaluasi awal pemahaman siswa melalui soal pilihan ganda dengan penilaian otomatis</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.5s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-file-alt text-primary mb-4"></i>
                            <h5 class="mb-3">Evaluasi</h5>
                            <p>Penilaian komprehensif melalui soal essay dengan sistem penilaian otomatis</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                    <div class="service-item text-center pt-3">
                        <div class="p-4">
                            <i class="fa fa-3x fa-user-circle text-primary mb-4"></i>
                            <h5 class="mb-3">Manajemen Profil</h5>
                            <p>Kelola profil dan pantau perkembangan pembelajaran dengan mudah</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Service End -->


    <!-- About Start -->
    <div class="container-xxl py-5" id="about">
        <div class="container">
            <div class="row g-5">
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.1s" style="min-height: 400px;">
                    <div class="position-relative h-100">
                        <img class="img-fluid position-absolute w-100 h-100"
                            src="{{ asset('assets/landingpages/img/about.jpg') }}" alt=""
                            style="object-fit: cover;">
                    </div>
                </div>
                <div class="col-lg-6 wow fadeInUp" data-wow-delay="0.3s">
                    <h6 class="section-title bg-white text-start text-primary pe-3">Tentang Bilik Belajar</h6>
                    <h1 class="mb-4">Selamat Datang di Platform Pembelajaran Digital</h1>
                    <p class="mb-4">Bilik Belajar merupakan platform pembelajaran digital berbasis Learning
                        Management System (LMS) untuk mata pelajaran Biologi</p>
                    <div class="row gy-2 gx-4 mb-4">
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Materi Pembelajaran
                            </p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Kuis</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Evaluasi</p>
                        </div>
                        <div class="col-sm-6">
                            <p class="mb-0"><i class="fa fa-arrow-right text-primary me-2"></i>Manajemen Profil</p>
                        </div>
                    </div>
                    <div class="text-center text-sm-start">
                        <div class="d-flex flex-column flex-sm-row gap-2">
                            <a href="{{ route('login') }}" class="btn btn-primary w-100 w-sm-auto" type="button">
                                <i class="bx bx-user-circle me-1"></i> Masuk sebagai Guru
                            </a>
                            <a href="{{ route('siswa') }}" class="btn btn-primary w-100 w-sm-auto" type="button">
                                <i class="bx bx-user me-1"></i> Masuk sebagai Siswa
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- About End -->






    <!-- Team Start -->
    <div class="container-xxl py-5" id="Author">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Pengembang</h6>
                <h1 class="mb-5">Tentang Pengembang</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <div class="col-lg-4 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <div class="team-item bg-light">
                        <div class="overflow-hidden">
                            <img class="img-fluid"
                                src="{{ asset('assets/landingpages/bilikbelajar/images/people.jpg') }}"
                                alt="Zahra Ramadhani" style="width: 100%; height: auto;">
                        </div>
                        <div class="text-center p-4">
                            <h5 class="mb-0">Zahra Ramadhani</h5>
                            <small>Mahasiswa Tadris Biologi<br>UIN Mahmud Yunus Batusangkar</small>
                            <p class="mt-3 small">Lahir di Pekanbaru, 19 November 2002</p>
                            <hr>
                            <p class="small text-muted text-start">
                                <strong>Tujuan Pengembang:</strong><br>
                                Pengembangan Media Digital Pembelajaran Biologi Berbasis Learning Management System
                                Materi Perubahan Lingkungan Kelas X/Fase E ini merupakan suatu produk
                                dari karya tulis penulis untuk menyelesaikan jenjang pendidikan dan memperoleh gelar
                                sarjana (S1) pada Jurusan Tadris Biologi UIN Mahmud Yunus Batusangkar.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Team End -->




    <!-- Contact Start -->
    <div class="container-xxl py-5" id="contact">
        <div class="container">
            <div class="text-center wow fadeInUp" data-wow-delay="0.1s">
                <h6 class="section-title bg-white text-center text-primary px-3">Contact Us</h6>
                <h1 class="mb-5">Contact For Any Query</h1>
            </div>
            <div class="row g-4 justify-content-center">
                <!-- Kontak Kampus -->
                <div class="col-lg-5 col-md-6 wow fadeInUp" data-wow-delay="0.1s">
                    <!-- Logo Kampus -->
                    <div class="mb-4 text-center">
                        <img src="{{ asset('assets/landingpages/bilikbelajar/images/logokampus.png') }}"
                            alt="Logo UIN MY Batusangkar" style="max-width: 120px;">
                    </div>
                    <h5>Get In Touch</h5>
                    <p class="mb-4">Silakan hubungi kami untuk pertanyaan lebih lanjut mengenai Universitas Islam
                        Negeri Mahmud Yunus Batusangkar.</p>

                    <div class="d-flex align-items-center mb-3">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-map-marker-alt text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Office</h5>
                            <p class="mb-0">Jl. Jenderal Sudirman No.137, Limo Kaum, Kabupaten Tanah Datar, Sumatera
                                Barat</p>
                        </div>
                    </div>

                   

                    <div class="d-flex align-items-center">
                        <div class="d-flex align-items-center justify-content-center flex-shrink-0 bg-primary"
                            style="width: 50px; height: 50px;">
                            <i class="fa fa-envelope-open text-white"></i>
                        </div>
                        <div class="ms-3">
                            <h5 class="text-primary">Email</h5>
                            <p class="mb-0">info@uinmybatusangkar.ac.id</p>
                        </div>
                    </div>
                </div>

                <!-- Peta Google Maps -->
                <div class="col-lg-6 col-md-6 wow fadeInUp" data-wow-delay="0.3s">
                    <iframe class="position-relative rounded w-100 h-100"
                        src="https://www.google.com/maps?q=Universitas+Islam+Negeri+Mahmud+Yunus+Batusangkar&output=embed"
                        frameborder="0" style="min-height: 400px; border:0;" allowfullscreen="" aria-hidden="false"
                        tabindex="0"></iframe>
                </div>
            </div>
        </div>
    </div>


    <!-- Contact End -->


    <!-- Footer Start -->
    <div class="container-fluid bg-dark text-light footer pt-5 mt-5 wow fadeIn" data-wow-delay="0.1s">
        <div class="container py-5">
            <div class="row g-5">
                <!-- Quick Link -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Quick Link</h4>
                    <a class="btn btn-link" href="#about">Tentang Kami</a>
                    <a class="btn btn-link" href="#contact">Kontak</a>
                    <a class="btn btn-link" href="#">Kebijakan Privasi</a>
                    <a class="btn btn-link" href="#">Syarat & Ketentuan</a>
                    <a class="btn btn-link" href="#">Bantuan</a>
                </div>

                <!-- Contact -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Kontak</h4>
                    <p class="mb-2"><i class="fa fa-map-marker-alt me-3"></i>Jl. Jenderal Sudirman No.137, Limo
                        Kaum, Kabupaten Tanah Datar, Sumatera Barat</p>
                    <p class="mb-2"><i class="fa fa-phone-alt me-3"></i>-</p>
                    <p class="mb-2"><i class="fa fa-envelope me-3"></i>info@uinmybatusangkar.ac.id</p>
                    <div class="d-flex pt-2">
                        <a class="btn btn-outline-light btn-social" href="#"><i
                                class="fab fa-facebook-f"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i
                                class="fab fa-instagram"></i></a>
                        <a class="btn btn-outline-light btn-social" href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>

                <!-- Logo / Branding -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Bilik Belajar</h4>
                    <div class="d-flex align-items-center mb-3">
                        <img src="{{ asset('assets/landingpages/bilikbelajar/images/icon.png') }}"
                            alt="Logo Bilik Belajar" style="max-width: 60px; margin-right: 10px;">
                        <img src="{{ asset('assets/landingpages/bilikbelajar/images/logokampus.png') }}"
                            alt="Logo UIN MY Batusangkar" style="max-width: 60px;">
                    </div>
                    <p>Tujuan pengembang: Pengembangan Media Digital
                        Pembelajaran Biologi Berbasis Learning Management System Materi
                        Perubahan Lingkungan Kelas X/Fase E ini merupakan suatu produk dari karya
                        tulis penulis untuk menyelesaikan jenjang pendidikan dan memperoleh gelar sarjana (S1) pada
                        Jurusan Tadris Biologi UIN Mahmud Yunus Batusangkar</p>
                    <p>Dikembangkan oleh: Zahra Ramadhani, mahasiswa Jurusan Tadris Biologi UIN Mahmud Yunus Batusangkar
                    </p>
                </div>

                <!-- Newsletter -->
                <div class="col-lg-3 col-md-6">
                    <h4 class="text-white mb-3">Newsletter</h4>
                    <p>Berlangganan untuk mendapatkan informasi dan update terbaru dari Bilik Belajar.</p>
                    <div class="position-relative mx-auto" style="max-width: 400px;">
                        <input class="form-control border-0 w-100 py-3 ps-4 pe-5" type="email"
                            placeholder="Email Anda">
                        <button type="button"
                            class="btn btn-primary py-2 position-absolute top-0 end-0 mt-2 me-2">Daftar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Copyright -->
        <div class="container">
            <div class="copyright">
                <div class="row">
                    <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                        &copy; <a class="border-bottom" href="#">Bilik Belajar</a>, Hak Cipta Dilindungi.
                    </div>
                    <div class="col-md-6 text-center text-md-end">
                        <div class="footer-menu">
                            <a href="#">Beranda</a>
                            <a href="#">Cookies</a>
                            <a href="#">Bantuan</a>
                            <a href="#">FAQ</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/landingpages/lib/wow/wow.min.js') }}"></script>
    <script src="{{ asset('assets/landingpages/lib/easing/easing.min.js') }}"></script>
    <script src="{{ asset('assets/landingpages/lib/waypoints/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/landingpages/lib/owlcarousel/owl.carousel.min.js') }}"></script>

    <!-- Template Javascript -->
    <script src="{{ asset('assets/landingpages/js/main.js') }}"></script>
</body>

</html>
