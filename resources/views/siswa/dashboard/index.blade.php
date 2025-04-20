@extends('layouts.main')

@push('css')
    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
    <style>
        .hero-section {
            min-height: 80vh;
            background: linear-gradient(135deg, var(--bs-primary) 0%, #8854c0 100%);
            position: relative;
            overflow: hidden;
        }

        .hero-content {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease forwards;
        }

        .search-container {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.3s forwards;
        }

        .hero-buttons {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.8s ease 0.6s forwards;
        }

        .hero-image {
            opacity: 0;
            transform: translateX(20px);
            animation: fadeInRight 0.8s ease 0.9s forwards;
            transition: transform 0.3s ease;
        }

        .hero-image:hover {
            transform: scale(1.02);
        }

        .card {
            transition: all 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInRight {
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .materi-card {
            opacity: 0;
            transform: translateY(20px);
        }

        .materi-card.visible {
            animation: fadeInUp 0.6s ease forwards;
        }

        @media (max-width: 768px) {
            .hero-section {
                min-height: auto;
                padding: 4rem 0;
            }

            .hero-content h1 {
                font-size: 2rem;
            }

            .hero-buttons .btn {
                width: 100%;
                margin: 0.5rem 0;
            }
        }
    </style>
@endpush

@section('content')
    <section class="hero-section py-5 mt-4">
        <div class="container">
            <div class="row align-items-center g-4">
                <div class="col-lg-6 col-md-12">
                    <div class="hero-content text-white">
                        <h1 class="display-4 fw-bold mb-3 text-white">
                            Selamat Datang di Bilik Belajar
                        </h1>
                        <p class="lead mb-4 text-white">
                            Platform pembelajaran interaktif untuk meningkatkan pengalaman belajar Anda. Mari belajar dengan
                            cara yang menyenangkan dan efektif.
                        </p>
                    </div>
                    <div class="search-container mb-4">
                        <div class="input-group input-group-lg">
                            <input type="text" class="form-control border-0 shadow-sm"
                                placeholder="Cari materi pembelajaran..." />
                            <button class="btn btn-light shadow-sm" type="button">
                                <i class="bx bx-search"></i>
                            </button>
                        </div>
                    </div>
                    <div class="hero-buttons d-flex flex-wrap gap-2">
                        <a href="#kursus" class="btn btn-light btn-lg">
                            <i class="bx bx-book-reader me-1"></i> Mulai Belajar
                        </a>

                    </div>
                </div>
                <div class="col-lg-6 col-md-12">
                    <div class="hero-image">
                        <img src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&q=80"
                            alt="Learning Illustration" class="img-fluid rounded-3 shadow-lg" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="container-xxl flex-grow-1 container-p-y">

        <div class="row" id="kursus">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang {{ session('siswa')->nama }}!</h5>
                                <p class="mb-4">
                                    Halo, selamat datang di Bilik Belajar! <br>
                                    Anda adalah siswa dari {{ session('siswa')->asal_sekolah }}. <br>
                                    Kami harap Anda mendapatkan pengalaman belajar yang menyenangkan dan bermanfaat.
                                    Mari kita mulai petualangan belajar bersama!
                                </p>
                                <div class="row">
                                    <div class="col">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button type="button" class="accordion-button collapsed"
                                                    data-bs-toggle="collapse" data-bs-target="#cp" aria-expanded="false"
                                                    aria-controls="cp">
                                                    Capaian Pembelajaran
                                                </button>
                                            </h2>

                                            <div id="cp" class="accordion-collapse collapse" data-bs-parent="#cp"
                                                style="">
                                                <div class="accordion-body">
                                                    {{ $capaianPembelajaran?->dekripsi }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="card accordion-item">
                                            <h2 class="accordion-header" id="headingOne">
                                                <button type="button" class="accordion-button collapsed"
                                                    data-bs-toggle="collapse" data-bs-target="#tp" aria-expanded="false"
                                                    aria-controls="accordionOne">
                                                    Tujuan Pembelajaran
                                                </button>
                                            </h2>

                                            <div id="tp" class="accordion-collapse collapse" data-bs-parent="#tp"
                                                style="">
                                                <div class="accordion-body">
                                                    {{ $tujuanPembelajaran?->dekripsi }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/man-with-laptop-light.png') }}" height="140"
                                    alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png"
                                    data-app-light-img="illustrations/man-with-laptop-light.png" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-6 mb-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-start justify-content-between">
                                    <div class="avatar flex-shrink-0">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class='bx bx-chalkboard fs-4'></i>
                                        </span>
                                    </div>
                                </div>
                                <span class="fw-semibold d-block mb-1 text-muted">Kelas Saat Ini</span>
                                <h3 class="card-title mb-2 text-primary">{{ session('siswa')->kelas }}</h3>
                                <small class="text-success fw-semibold">
                                    <i class="bx bx-user-check me-1"></i> Aktif
                                </small>
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}

        </div>
        <div class="row">
            <!-- Order Statistics -->
            <div class="col-md-12">
                <div class="card h-100">

                    <div class="card-body">
                        @if ($materi->isEmpty())
                            <div class="col-12">
                                <div class="alert alert-info d-flex align-items-center" role="alert">
                                    <span class="alert-icon text-info me-2">
                                        <i class="bx bx-info-circle"></i>
                                    </span>
                                    <div>
                                        <h6 class="alert-heading mb-1">Hai {{ session('siswa')->nama }}!</h6>
                                        <p class="mb-0">
                                            Maaf, belum ada materi pembelajaran yang tersedia untuk kelas {{ session('siswa')->kelas }} saat ini.
                                            Silakan cek kembali beberapa saat lagi.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <div class="row row-cols-1 row-cols-md-4 g-4 mb-5">

                            @foreach ($materi as $m)
                                <div class="col">
                                    <div class="card h-100 shadow-sm hover-elevate-up">
                                        <img class="card-img-top" src="{{ asset('assets/img/kursus/1.jpg') }}"
                                            alt="{{ $m->nama }}" style="height: 200px; object-fit: cover;" />

                                        <div class="card-body d-flex flex-column">
                                            <h5 class="card-title text-primary mb-3">{{ $m->nama }}</h5>

                                            <div class="mt-auto">
                                                <div class="btn-group" role="group">
                                                    <a href="{{ route('siswa.materi.show', $m->id) }}" class="btn btn-primary btn-sm">
                                                        <i class="bx bx-book-open me-1"></i>
                                                         Materi
                                                    </a>
                                                    <a href="{{ route('siswa.kuis.index', $m->id) }}" class="btn btn-info btn-sm">
                                                        <i class="bx bx-task me-1"></i>
                                                        Kuis
                                                    </a>
                                                    <a href="#" class="btn btn-success btn-sm">
                                                        <i class="bx bx-file me-1"></i>
                                                        Evaluasi
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <!--/ Order Statistics -->


        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script src="{{ asset('assets/js/dashboards-analytics.js') }}"></script>
    <script>
        // Animate materi cards on scroll
        document.addEventListener('DOMContentLoaded', function() {
            const cards = document.querySelectorAll('.card');

            const observer = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.classList.add('visible');
                        }, index * 100);
                    }
                });
            }, {
                threshold: 0.1
            });

            cards.forEach(card => {
                card.classList.add('materi-card');
                observer.observe(card);
            });
        });
    </script>
@endpush
