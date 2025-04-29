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
                                <h5 class="card-title text-primary mb-3">
                                    Selamat Datang Kembali, {{ auth()->user()->username }}! 👋
                                </h5>
                                <p class="mb-4">
                                    Anda telah masuk sebagai guru. Silahkan kelola pembelajaran Anda dengan maksimal.
                                </p>
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
                                        <h3 class="card-title mb-0">{{ $totalSiswa }}</h3>
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
                                        <h3 class="card-title mb-0">{{ $totalSekolah }}</h3>
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

            <!-- Highest Quiz Scores -->
            <div class="col-12 order-3">
                <div class="row">
                    <!-- Kelas 10 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Nilai Kuis Kelas 10</h5>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($KuisKelas10 as $k10)
                                        <li class="d-flex mb-3">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span
                                                    class="avatar-initial rounded-circle bg-primary">{{ substr(strtoupper($k10->siswa->nama), 0, 2) }}</span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $k10->siswa->nama }}</h6>
                                                    <small class="text-muted">{{ $k10->siswa->asal_sekolah }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $k10->total_nilai }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas 11 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Nilai Kuis Kelas 11</h5>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($KuisKelas11 as $k11)
                                        <li class="d-flex mb-3">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span
                                                    class="avatar-initial rounded-circle bg-success">{{ substr(strtoupper($k11->siswa->nama), 0, 2) }}</span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $k11->siswa->nama }}</h6>
                                                    <small class="text-muted">{{ $k11->siswa->asal_sekolah }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $k11->total_nilai }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas 12 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Nilai Kuis Kelas 12</h5>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($KuisKelas12 as $k12)
                                        <li class="d-flex mb-3">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span
                                                    class="avatar-initial rounded-circle bg-info">{{ substr(strtoupper($k12->siswa->nama), 0, 2) }}</span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $k12->siswa->nama }}</h6>
                                                    <small class="text-muted">{{ $k12->siswa->asal_sekolah }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $k12->total_nilai }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Highest Evaluation Scores -->
            <div class="col-12 order-4">
                <div class="row">
                    <!-- Kelas 10 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Nilai Evaluasi Kelas 10</h5>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($EvaluasiKelas10 as $e10)
                                        <li class="d-flex mb-3">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span
                                                    class="avatar-initial rounded-circle bg-warning">{{ substr(strtoupper($e10->siswa->nama), 0, 2) }}</span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $e10->siswa->nama }}</h6>
                                                    <small class="text-muted">{{ $e10->siswa->asal_sekolah }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $e10->total_nilai }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas 11 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Nilai Evaluasi Kelas 11</h5>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($EvaluasiKelas11 as $e11)
                                        <li class="d-flex mb-3">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded-circle bg-danger">{{ substr(strtoupper($e11->siswa->nama), 0, 2) }}</span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $e11->siswa->nama }}</h6>
                                                    <small class="text-muted">{{ $e11->siswa->asal_sekolah }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $e11->total_nilai }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Kelas 12 -->
                    <div class="col-md-4 mb-4">
                        <div class="card h-100">
                            <div class="card-header d-flex align-items-center justify-content-between">
                                <h5 class="card-title m-0 me-2">Nilai Evaluasi Kelas 12</h5>
                            </div>
                            <div class="card-body">
                                <ul class="p-0 m-0">
                                    @foreach ($EvaluasiKelas12 as $e12)
                                        <li class="d-flex mb-3">
                                            <div class="avatar flex-shrink-0 me-3">
                                                <span class="avatar-initial rounded-circle bg-dark">{{ substr(strtoupper($e12->siswa->nama), 0, 2) }}</span>
                                            </div>
                                            <div
                                                class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                <div class="me-2">
                                                    <h6 class="mb-0">{{ $e12->siswa->nama }}</h6>
                                                    <small class="text-muted">{{ $e12->siswa->asal_sekolah }}</small>
                                                </div>
                                                <div class="user-progress">
                                                    <small class="fw-semibold">{{ $e12->total_nilai }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                  
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection

@push('js')
    {{-- <script src="{{ asset('assets/vendor/libs/apex-charts/apexcharts.js') }}"></script> --}}
@endpush
