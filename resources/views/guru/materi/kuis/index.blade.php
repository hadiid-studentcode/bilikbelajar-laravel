@extends('layouts.main')

@push('css')
    <style>
        .custom-accordion .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #435971;
        }

        .custom-accordion .accordion-button:focus {
            box-shadow: none;
            border-color: rgba(0, 0, 0, .125);
        }

        .option-item .card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .option-item .card:hover:not(.bg-success) {
            background-color: #f8f9fa;
        }

        .modal-dialog-scrollable .modal-content {
            max-height: 90vh;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Daftar Kuis</h5>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createQuizModal">
                            <i class="bx bx-plus"></i> Tambah Kuis
                        </button>
                    </div>
                    <div class="card-body">
                       
                        <div class="card">
                            <div class="card-body">
                                <div class="row g-3">
                                    <div class="col-md-3 col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge rounded-pill bg-label-primary me-3 p-2">
                                                <i class="bx bx-user fs-3"></i>
                                            </div>
                                            <div class="card-info">
                                                <h5 class="mb-0">35</h5>
                                                <small>Total Siswa</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge rounded-pill bg-label-success me-3 p-2">
                                                <i class="bx bx-check-circle fs-3"></i>
                                            </div>
                                            <div class="card-info">
                                                <h5 class="mb-0">28</h5>
                                                <small>Sudah Selesai</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge rounded-pill bg-label-warning me-3 p-2">
                                                <i class="bx bx-time fs-3"></i>
                                            </div>
                                            <div class="card-info">
                                                <h5 class="mb-0">7</h5>
                                                <small>Belum Selesai</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 col-6">
                                        <div class="d-flex align-items-center">
                                            <div class="badge rounded-pill bg-label-info me-3 p-2">
                                                <i class="bx bx-trending-up fs-3"></i>
                                            </div>
                                            <div class="card-info">
                                                <h5 class="mb-0">85</h5>
                                                <small>Rata-rata Nilai</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Status</th>
                                        <th>Waktu Mulai</th>
                                        <th>Waktu Selesai</th>
                                        <th>Nilai</th>
                                        <th>Detail</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>Ahmad Rizky</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                        <td>19/04/2025 08:00</td>
                                        <td>19/04/2025 09:00</td>
                                        <td><span class="fw-bold">85</span>/100</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="bx bx-detail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Budi Santoso</td>
                                        <td><span class="badge bg-warning">Sedang Mengerjakan</span></td>
                                        <td>19/04/2025 08:30</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="bx bx-detail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>3</td>
                                        <td>Citra Dewi</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                        <td>19/04/2025 08:15</td>
                                        <td>19/04/2025 09:10</td>
                                        <td><span class="fw-bold">90</span>/100</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="bx bx-detail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>4</td>
                                        <td>Dini Putri</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                        <td>19/04/2025 08:05</td>
                                        <td>19/04/2025 09:05</td>
                                        <td><span class="fw-bold">95</span>/100</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="bx bx-detail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>5</td>
                                        <td>Eko Prasetyo</td>
                                        <td><span class="badge bg-warning">Sedang Mengerjakan</span></td>
                                        <td>19/04/2025 08:45</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>
                                            <a href="#" class="btn btn-sm btn-info">
                                                <i class="bx bx-detail"></i>
                                            </a>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kuis -->
    <div class="modal fade" id="createQuizModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Kuis Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('guru.materi.kuis.store', $materi_id) }}" method="POST" id="createQuizForm">
                        @csrf
                       
                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3">Daftar Soal</h6>
                                @for ($i = 1; $i <= 10; $i++)
                                    <div class="card mb-3">
                                        <div class="card-body">
                                            <h6 class="mb-3">Soal {{ $i }}</h6>
                                            <div class="mb-3">
                                                <label class="form-label">Pertanyaan</label>
                                                <textarea class="form-control" name="soal[{{ $i }}][pertanyaan]" rows="2" required></textarea>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <label class="form-label">Bobot Nilai</label>
                                                    <input type="number" class="form-control" name="soal[{{ $i }}][bobot]" required min="1" max="100" value="10">
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label d-block">Pilihan Jawaban</label>
                                                @foreach (['a', 'b', 'c', 'd', 'e'] as $opsi)
                                                    <div class="form-check mb-2">
                                                        <input class="form-check-input" type="radio" 
                                                            name="soal[{{ $i }}][jawaban_benar]" 
                                                            value="{{ $opsi }}" 
                                                            id="soal{{ $i }}Opsi{{ $opsi }}"
                                                            {{ $opsi == 'a' ? 'required' : '' }}>
                                                        <label class="form-check-label w-100" for="soal{{ $i }}Opsi{{ $opsi }}">
                                                            <div class="input-group">
                                                                <span class="input-group-text">{{ strtoupper($opsi) }}</span>
                                                                <input type="text" class="form-control" 
                                                                    name="soal[{{ $i }}][opsi][{{ $opsi }}]" 
                                                                    required>
                                                            </div>
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Kuis</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Detail Jawaban -->
    <div class="modal fade" id="detailJawabanModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Detail Jawaban Kuis</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <table class="table table-sm">
                                <tr>
                                    <th>Nama Siswa</th>
                                    <td>:</td>
                                    <td class="fw-bold">Ahmad Rizky</td>
                                </tr>
                                <tr>
                                    <th>Waktu Mulai</th>
                                    <td>:</td>
                                    <td>19/04/2025 08:00</td>
                                </tr>
                                <tr>
                                    <th>Waktu Selesai</th>
                                    <td>:</td>
                                    <td>19/04/2025 09:00</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td><span class="badge bg-success">Selesai</span></td>
                                </tr>
                                <tr>
                                    <th>Nilai Total</th>
                                    <td>:</td>
                                    <td><span class="fw-bold">85</span>/100</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h6 class="card-title mb-0">Rincian Jawaban</h6>
                        </div>
                        <div class="card-body">
                            <div class="accordion" id="accordionJawaban">
                                <!-- Soal 1 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#soal1">
                                            <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                                <span>Soal #1</span>
                                                <span class="badge bg-success">Benar (+10)</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="soal1" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <p class="fw-medium mb-3">Apa yang dimaksud dengan algoritma?</p>
                                            <div class="mb-3">
                                                <div class="fw-medium mb-1">Pilihan Jawaban:</div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" checked disabled>
                                                    <label class="form-check-label text-success">
                                                        <i class="bx bx-check"></i> Langkah-langkah sistematis untuk menyelesaikan masalah
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label">
                                                        Kumpulan data yang terstruktur
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label">
                                                        Program komputer
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label">
                                                        Bahasa pemrograman
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Soal 2 -->
                                <div class="accordion-item">
                                    <h2 class="accordion-header">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#soal2">
                                            <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                                <span>Soal #2</span>
                                                <span class="badge bg-danger">Salah (+0)</span>
                                            </div>
                                        </button>
                                    </h2>
                                    <div id="soal2" class="accordion-collapse collapse">
                                        <div class="accordion-body">
                                            <p class="fw-medium mb-3">Manakah yang bukan merupakan tipe data primitif?</p>
                                            <div class="mb-3">
                                                <div class="fw-medium mb-1">Pilihan Jawaban:</div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label">
                                                        Integer
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label">
                                                        Boolean
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" checked disabled>
                                                    <label class="form-check-label text-danger">
                                                        <i class="bx bx-x"></i> Float
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" disabled>
                                                    <label class="form-check-label text-success">
                                                        <i class="bx bx-check"></i> Array (Jawaban Benar)
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Handle detail button click
    const detailButtons = document.querySelectorAll('.btn-info');
    detailButtons.forEach(button => {
        button.addEventListener('click', function() {
            const modal = new bootstrap.Modal(document.getElementById('detailJawabanModal'));
            modal.show();
        });
    });
});
</script>
@endpush
