@extends('layouts.main')

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Manajemen Materi /</span> Kelas</h4>
        <div class="row mb-5">
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img class="card-img card-img-top" src="{{ asset('assets/img/kelas/10.jpg') }}" alt="Kelas 10"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Kelas 10</h5>
                                <p class="card-text">
                                    Materi pembelajaran untuk siswa kelas 10
                                </p>
                                <a href="{{ route('guru.materi.kelas', 10) }}" class="btn btn-primary">Masuk
                                    Kelas 10</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img class="card-img card-img-top" src="{{ asset('assets/img/kelas/11.jpg') }}" alt="Kelas 11"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Kelas 11</h5>
                                <p class="card-text">
                                    Materi pembelajaran untuk siswa kelas 11
                                </p>
                                <a href="{{ route('guru.materi.kelas', 11) }}" class="btn btn-primary">Masuk
                                    Kelas 11</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="row g-0">
                        <div class="col-md-12">
                            <img class="card-img card-img-top" src="{{ asset('assets/img/kelas/12.jpg') }}" alt="Kelas 12"
                                style="height: 200px; object-fit: cover;">
                            <div class="card-body text-center">
                                <h5 class="card-title">Kelas 12</h5>
                                <p class="card-text">
                                    Materi pembelajaran untuk siswa kelas 12
                                </p>
                                <a href="{{ route('guru.materi.kelas', 12) }}" class="btn btn-primary">Masuk
                                    Kelas 12</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
