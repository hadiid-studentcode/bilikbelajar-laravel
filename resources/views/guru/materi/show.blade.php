@extends('layouts.main')

@push('css')
    <style>
        .materi-card {
            transition: transform 0.3s;
        }

        .materi-card:hover {
            transform: translateY(-5px);
        }

        .card-img-top {
            height: 200px;
            object-fit: cover;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Daftar Materi</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMateriModal">
                <i class="bx bx-plus"></i> Tambah Materi
            </button>
        </div>

        <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari materi...">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="bx bx-search"></i>
                    </button>
                </div>
            </div>
        </div>

        <div class="row g-4">
            @for ($i = 1; $i <= 6; $i++)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card materi-card h-100">
                        <img src="https://source.unsplash.com/random/800x600?education,{{ $i }}"
                            class="card-img-top" alt="Materi Image">
                        <div class="card-body">
                            <h5 class="card-title">Matematika Dasar {{ $i }}</h5>
                            <p class="card-text text-muted mb-0">Kelas: X</p>
                            <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia,
                                molestiae quas vel sint commodi...</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="text-muted"><i class="bx bx-time"></i> {{ date('d M Y') }}</span>
                                <div>
                                    <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal"
                                        data-bs-target="#editMateriModal{{ $i }}">
                                        <i class="bx bx-edit"></i>
                                    </button>
                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                        data-bs-target="#deleteMateriModal{{ $i }}">
                                        <i class="bx bx-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createMateriModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Materi Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Judul Materi</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Kelas</label>
                            <select class="form-select">
                                <option>X</option>
                                <option>XI</option>
                                <option>XII</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar</label>
                            <input type="file" class="form-control">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    @for ($i = 1; $i <= 6; $i++)
        <div class="modal fade" id="editMateriModal{{ $i }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Materi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Judul Materi</label>
                                <input type="text" class="form-control" required
                                    value="Matematika Dasar {{ $i }}">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Kelas</label>
                                <select class="form-select">
                                    <option selected>X</option>
                                    <option>XI</option>
                                    <option>XII</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <textarea class="form-control" rows="3">Lorem ipsum dolor sit amet consectetur adipisicing elit. Maxime mollitia, molestiae quas vel sint commodi...</textarea>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar</label>
                                <input type="file" class="form-control">
                                <div class="mt-2">
                                    <img src="https://source.unsplash.com/random/800x600?education,{{ $i }}"
                                        class="img-thumbnail" width="200">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-primary">Simpan Perubahan</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Delete Modal -->
        <div class="modal fade" id="deleteMateriModal{{ $i }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus materi "Matematika Dasar {{ $i }}"?</p>
                        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger"
                            onclick="deleteMateri({{ $i }})">Hapus</button>
                    </div>
                </div>
            </div>
        </div>
    @endfor
@endsection

@push('js')
    <script>
        function confirmDelete(id) {
            if (confirm('Apakah Anda yakin ingin menghapus materi ini?')) {
                // Handle delete action
                console.log('Deleting materi with id:', id);
            }
        }

        function deleteMateri(id) {
            // Handle delete action here
            console.log('Deleting materi with id:', id);
            // Close modal after deletion
            $(`#deleteMateriModal${id}`).modal('hide');
            // Show success message
            alert('Materi berhasil dihapus!');
        }
    </script>
@endpush
