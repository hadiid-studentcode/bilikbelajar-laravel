@extends('layouts.main')

@push('css')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/apex-charts/apex-charts.css') }}" />
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Welcome Card -->
        <div class="row">
            <div class="col-lg-8 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Selamat Datang Kembali, {{ auth()->user()->username }}! 👋
                                </h5>
                                <p class="mb-4">
                                    Anda memiliki <span class="fw-bold">{{ $total_kelas ?? 0 }}</span> kelas aktif dengan
                                    total <span class="fw-bold">{{ $total_materi ?? 0 }}</span> materi pembelajaran.
                                </p>
                                <a href="" class="btn btn-sm btn-outline-primary">Lihat Kelas
                                    Saya</a>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="{{ asset('assets/img/illustrations/teaching.png') }}" height="140"
                                    alt="Teacher teaching illustration" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stats -->
            <div class="col-lg-4 col-md-4 order-1">
                <div class="row">
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span class="fw-semibold d-block mb-1">Total Kelas</span>
                                        <h3 class="card-title mb-0">{{ $total_kelas ?? 0 }}</h3>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-chalkboard fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <span class="fw-semibold d-block mb-1">Total Siswa</span>
                                        <h3 class="card-title mb-0">{{ $total_siswa ?? 0 }}</h3>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-success">
                                            <i class="bx bx-group fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Access -->
            <div class="col-12 order-3">
                <div class="row">
                    <!-- Materi Card -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <h5>Manajemen Materi</h5>
                                        <p class="mb-3">Kelola materi pembelajaran untuk seluruh kelas</p>
                                        <div class="d-flex gap-2">
                                            <a href="" class="btn btn-primary">Tambah
                                                Materi</a>
                                            <a href="{{ route('guru.materi.index') }}" class="btn btn-outline-primary">Lihat
                                                Semua</a>
                                        </div>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-book-content fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pre Test Card -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <h5>Bank Soal Pre-Test</h5>
                                        <p class="mb-3">Kelola soal pilihan ganda dan set penilaian</p>
                                        <div class="d-flex gap-2">
                                            <a href="" class="btn btn-primary">Buat
                                                Soal</a>
                                            <a href=""
                                                class="btn btn-outline-primary">Lihat Soal</a>
                                        </div>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-success">
                                            <i class="bx bx-task fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Evaluasi Card -->
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100">
                            <div class="card-body">
                                <div class="d-flex align-items-start justify-content-between">
                                    <div class="content-left">
                                        <h5>Evaluasi Pembelajaran</h5>
                                        <p class="mb-3">Kelola soal essay dan evaluasi siswa</p>
                                        <div class="d-flex gap-2">
                                            <a href="" class="btn btn-primary">Buat
                                                Evaluasi</a>
                                            <a href=""
                                                class="btn btn-outline-primary">Lihat Evaluasi</a>
                                        </div>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-info">
                                            <i class="bx bx-clipboard fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Class Activities -->
            <div class="col-md-6 col-lg-4 order-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Aktivitas Kelas Terkini</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            @forelse($class_activities ?? [] as $activity)
                                <li class="d-flex mb-4 pb-1">
                                    <div class="avatar flex-shrink-0 me-3">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx {{ $activity->icon }}"></i>
                                        </span>
                                    </div>
                                    <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                        <div class="me-2">
                                            <h6 class="mb-0">{{ $activity->kelas }} - {{ $activity->title }}</h6>
                                            <small class="text-muted">{{ $activity->description }}</small>
                                        </div>
                                        <div>
                                            <small class="text-muted">{{ $activity->created_at->diffForHumans() }}</small>
                                        </div>
                                    </div>
                                </li>
                            @empty
                                <li class="text-center py-4">
                                    <p class="mb-0 text-muted">Belum ada aktivitas kelas</p>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Class Performance -->
            <div class="col-md-6 col-lg-8 order-4 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Performa Kelas</h5>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button"
                                id="performanceFilter" data-bs-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                Pilih Kelas
                            </button>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="performanceFilter">
                                @foreach ($kelas_list ?? [] as $kelas)
                                    <a class="dropdown-item" href="javascript:void(0);"
                                        onclick="updatePerformanceChart('{{ $kelas->id }}')">
                                        {{ $kelas->nama }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="classPerformanceChart"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
    <script>
        // Class Performance Chart Configuration
        const performanceOptions = {
            series: [{
                name: 'Nilai Pre-Test',
                data: [65, 70, 75, 80, 85, 90]
            }, {
                name: 'Nilai Evaluasi',
                data: [70, 75, 80, 85, 90, 95]
            }],
            chart: {
                height: 350,
                type: 'line',
                toolbar: {
                    show: false
                }
            },
            grid: {
                show: true,
                padding: {
                    left: 0,
                    right: 0
                }
            },
            stroke: {
                width: [2, 2],
                curve: 'smooth'
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'right'
            },
            // ... additional chart configuration
        };

        const performanceChart = new ApexCharts(document.querySelector("#classPerformanceChart"), performanceOptions);
        performanceChart.render();

        // Function to update chart data based on selected class
        function updatePerformanceChart(kelasId) {
            // Ajax call to get class performance data
            // Update chart data
        }
    </script>
@endpush
