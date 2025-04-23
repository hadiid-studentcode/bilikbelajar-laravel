@extends('layouts.main')

@push('css')
    <style>
        .textarea-wrapper {
            margin-bottom: 2rem;
        }

        .textarea-counter {
            font-size: 0.875rem;
            color: #697a8d;
            text-align: right;
            margin-top: 0.25rem;
        }

        .nav-tabs .nav-link {
            padding: 1rem 1.5rem;
            font-weight: 500;
        }

        .grade-card {
            transition: all 0.3s ease;
        }

        .grade-card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .cp-card {
            border-left: 4px solid #696cff;
            margin-bottom: 1rem;
        }

        .cp-badge {
            background-color: #e7e7ff;
            color: #696cff;
        }

        .semester-divider {
            border-top: 1px dashed #d9dee3;
            margin: 1.5rem 0;
        }

        .cp-item {
            background-color: #f8f9fa;
            border-radius: 0.5rem;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .cp-text {
            min-height: 80px;
            background: white;
            border: 1px solid #d9dee3;
            border-radius: 0.375rem;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Capaian Pembelajaran</h4>

        @include('components.alertComponents')

        <div class="nav-align-top mb-4">
            <ul class="nav nav-tabs nav-fill" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#kelas10">Kelas 10</button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#kelas1112">Kelas 11 & 12</button>
                </li>
            </ul>

            <div class="tab-content">
                <!-- Kelas 10 -->
                <div class="tab-pane fade show active" id="kelas10">
                    <div class="card">
                        <div class="card-body">


                            <div class="alert alert-info mb-4">
                                <i class="bx bx-info-circle me-1"></i>
                                Capaian Pembelajaran untuk Kelas 10
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="mb-0">Daftar Capaian Pembelajaran</h6>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addModal10">
                                    <i class="bx bx-plus me-1"></i>Tambah CP
                                </button>
                            </div>



                            <!-- CP Items -->
                            <div class="cp-item">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge cp-badge">CP Kelas 10</span>
                                    @if($capaianKelas10 != null)
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal_{{ $capaianKelas10?->id }}">

                                            <i class="bx bx-edit-alt"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal_{{ $capaianKelas10?->id }}">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                <div class="cp-text">
                                    {{ $capaianKelas10?->deskripsi }}
                                </div>
                            </div>


                        </div>
                    </div>
                </div>

                <!-- Kelas 11 & 12 -->
                <div class="tab-pane fade" id="kelas1112">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info mb-4">
                                <i class="bx bx-info-circle me-1"></i>
                                Capaian Pembelajaran untuk Kelas 11 & 12
                            </div>

                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h6 class="mb-0">Daftar Capaian Pembelajaran</h6>
                                <button class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#addModal1112">
                                    <i class="bx bx-plus me-1"></i>Tambah CP
                                </button>
                            </div>

                            <!-- CP Items -->
                            <div class="cp-item">
                                <div class="d-flex justify-content-between mb-2">
                                    <span class="badge cp-badge">CP Kelas 11 & 12</span>
                                    <div class="d-flex gap-2">
                                        <button class="btn btn-sm btn-icon btn-outline-primary" data-bs-toggle="modal"
                                            data-bs-target="#editModal" onclick="editCP(this)" data-id="3"
                                            data-content="Siswa mampu mengembangkan aplikasi web menggunakan framework modern dan menerapkan konsep pemrograman berorientasi objek.">
                                            <i class="bx bx-edit-alt"></i>
                                        </button>
                                        <button class="btn btn-sm btn-icon btn-outline-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" onclick="deleteCP(this)" data-id="3">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="cp-text">
                                    Siswa mampu mengembangkan aplikasi web menggunakan framework modern dan menerapkan
                                    konsep pemrograman berorientasi objek.
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal for Kelas 10 -->
        <div class="modal fade" id="addModal10" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Capaian Pembelajaran Kelas 10</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('guru.cp.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="kelas" value="10">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Capaian Pembelajaran</label>
                                <textarea class="form-control" name="cp" rows="4" placeholder="Masukkan capaian pembelajaran..." required
                                    maxlength="1000"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        @if($capaianKelas10 != null)
        <!-- Edit Modal for Kelas 10 -->
        <div class="modal fade" id="editModal_{{ $capaianKelas10?->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Capaian Pembelajaran Kelas {{ $capaianKelas10?->kelas }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('guru.cp.update', 10) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Capaian Pembelajaran</label>
                                <textarea class="form-control" name="cp" id="editContent" rows="16" required maxlength="1000">{{ $capaianKelas10?->deskripsi }}</textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Delete Modal for Kelas 10 -->
        <div class="modal fade" id="deleteModal_{{ $capaianKelas10?->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Hapus Capaian Pembelajaran Kelas 10</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="{{ route('guru.cp.destroy', 10) }}" method="POST">
                        @csrf
                        @method('DELETE')

                        <div class="modal-body">
                            <p>Apakah Anda yakin ingin menghapus capaian pembelajaran ini?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        @endif

        <!-- Modal for Kelas 11 & 12 -->
        <div class="modal fade" id="addModal1112" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Capaian Pembelajaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <form action="" method="POST">
                        @csrf
                        <input type="hidden" name="kelas" value="11">
                        <div class="modal-body">
                            <div class="mb-3">
                                <label class="form-label">Capaian Pembelajaran</label>
                                <textarea class="form-control" name="content" rows="4" placeholder="Masukkan capaian pembelajaran..." required
                                    maxlength="1000"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary"
                                data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
@endsection
