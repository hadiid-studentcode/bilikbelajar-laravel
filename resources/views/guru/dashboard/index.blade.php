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
                                <h5 class="card-title text-primary">Selamat Datang Kembali, {{ auth()->user()->username }}!
                                    👋
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
                                <img src="{{ asset('assets/bilikbelajar/images/5211204.jpg') }}" height="140"
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
                                        <span class="fw-semibold d-block mb-1">Total Siswa</span>
                                        <h3 class="card-title mb-0">2,856</h3>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-primary">
                                            <i class="bx bx-user-circle fs-4"></i>
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
                                        <span class="fw-semibold d-block mb-1">Total Sekolah</span>
                                        <h3 class="card-title mb-0">124</h3>
                                    </div>
                                    <div class="avatar">
                                        <span class="avatar-initial rounded bg-label-success">
                                            <i class="bx bx-buildings fs-4"></i>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Students -->
            <div class="col-md-6 order-3 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Nilai Kuis Tertinggi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    @php
                                        $nama = "Sarah Johnson";
                                        $initials = implode('', array_map(function($word) {
                                            return strtoupper(substr($word, 0, 1));
                                        }, explode(' ', $nama)));
                                    @endphp
                                    <span class="avatar-initial rounded-circle bg-primary">{{ substr($initials, 0, 2) }}</span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Sarah Johnson</h6>
                                        <small class="text-muted">SMA Negeri 1 Bandung</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">98</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded-circle bg-success">AR</span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Ahmad Rizki</h6>
                                        <small class="text-muted">SMA Negeri 3 Jakarta</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">95</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded-circle bg-info">MP</span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Maya Putri</h6>
                                        <small class="text-muted">SMA Negeri 5 Surabaya</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">92</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-md-6 order-3 mb-4">
                <div class="card h-100">
                    <div class="card-header d-flex align-items-center justify-content-between">
                        <h5 class="card-title m-0 me-2">Nilai Evaluasi Tertinggi</h5>
                    </div>
                    <div class="card-body">
                        <ul class="p-0 m-0">
                            <li class="d-flex mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded-circle bg-warning">BS</span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Budi Santoso</h6>
                                        <small class="text-muted">SMA Negeri 2 Medan</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">96</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded-circle bg-danger">DL</span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Dewi Lestari</h6>
                                        <small class="text-muted">SMA Negeri 1 Yogyakarta</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">94</small>
                                    </div>
                                </div>
                            </li>
                            <li class="d-flex mb-3">
                                <div class="avatar flex-shrink-0 me-3">
                                    <span class="avatar-initial rounded-circle bg-dark">RH</span>
                                </div>
                                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                    <div class="me-2">
                                        <h6 class="mb-0">Rudi Hermawan</h6>
                                        <small class="text-muted">SMA Negeri 4 Semarang</small>
                                    </div>
                                    <div class="user-progress">
                                        <small class="fw-semibold">91</small>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

           
        </div>
    </div>
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
  
@endpush
