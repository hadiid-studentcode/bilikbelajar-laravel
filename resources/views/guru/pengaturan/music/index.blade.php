@extends('layouts.main')

@push('css')
    <!-- Tambahkan CSS jika diperlukan -->
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Pengaturan Musik</h1>

        <div class="row">
            <!-- Input Musik Kuis Evaluasi -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Musik untuk Kuis Evaluasi</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $musikKuis ? route('guru.pengaturan.music.update', $musikKuis->id) : route('guru.pengaturan.music.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($musikKuis !== null)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="type" value="kuisEvaluasi">
                            <div class="mb-3">
                                <label for="music" class="form-label">Pilih File Musik</label>
                                <input class="form-control" type="file" name="music" id="music" accept="audio/*"
                                    required>

                            </div>
                            <button type="submit"
                                class="btn btn-primary mb-3">{{ $musikKuis ? 'Ubah Musik Kuis & Evaluasi' : 'Simpan Musik Kuis & Evaluasi' }}</button>
                        </form>

                        @if ($musikKuis)
                            <label for="audioKuis">Musik Kuis & Evaluasi:</label><br>
                            <audio id="audioKuis" controls preload="auto">
                                <source src="{{ asset('storage/' . $musikKuis->file_name) }}" type="audio/mpeg">
                                Browser Anda tidak mendukung elemen audio.
                            </audio>
                        @endif
                    </div>
                    @if($musikKuis)
                    {{-- Tombol Hapus Musik --}}
                    <button type="button" class="btn btn-danger mt-3 " data-bs-toggle="modal" data-bs-target="#hapusModal">
                        Hapus Musik
                    </button>
                    @endif
                </div>

                @if ($musikKuis !== null)
                    {{-- Modal Konfirmasi Hapus --}}
                    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Musik</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus musik ini? Operasi ini tidak dapat dibatalkan.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('guru.pengaturan.music.destroy', $musikKuis->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus Musik</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>

            <!-- Input Musik Baca Materi -->
           
              <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Musik untuk Baca Materi</h5>
                    </div>
                    <div class="card-body">
                        <form
                            action="{{ $musikMateri ? route('guru.pengaturan.music.update', $musikMateri->id) : route('guru.pengaturan.music.store') }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @if ($musikMateri !== null)
                                @method('PUT')
                            @endif
                            <input type="hidden" name="type" value="materi">
                            <div class="mb-3">
                                <label for="music" class="form-label">Pilih File Musik</label>
                                <input class="form-control" type="file" name="music" id="music" accept="audio/*"
                                    required>
                            </div>
                            <button type="submit"
                                class="btn btn-primary mb-3">{{ $musikMateri ? 'Ubah Musik Materi' : 'Simpan Musik Materi' }}</button>
                        </form>

                        @if ($musikMateri)
                            <label for="audioKuis">Musik Baca Materi :</label><br>
                            <audio id="audioKuis" controls preload="auto">
                                <source src="{{ asset('storage/' . $musikMateri->file_name) }}" type="audio/mpeg">
                                Browser Anda tidak mendukung elemen audio.
                            </audio>
                        @endif
                    </div>
                    @if($musikMateri)
                    {{-- Tombol Hapus Musik --}}
                    <button type="button" class="btn btn-danger mt-3 " data-bs-toggle="modal" data-bs-target="#hapusMusikMateri">
                        Hapus Musik
                    </button>
                    @endif
                </div>

                @if ($musikKuis !== null)
                    {{-- Modal Konfirmasi Hapus --}}
                    <div class="modal fade" id="hapusModal" tabindex="-1" aria-labelledby="hapusModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Musik</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus musik ini? Operasi ini tidak dapat dibatalkan.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('guru.pengaturan.music.destroy', $musikKuis->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus Musik</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                   @if ($musikMateri !== null)
                    {{-- Modal Konfirmasi Hapus --}}
                    <div class="modal fade" id="hapusMusikMateri" tabindex="-1" aria-labelledby="hapusModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="hapusModalLabel">Konfirmasi Hapus Musik</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Apakah Anda yakin ingin menghapus musik ini? Operasi ini tidak dapat dibatalkan.
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                    <form action="{{ route('guru.pengaturan.music.destroy', $musikMateri->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Hapus Musik</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- Tambahkan JS jika diperlukan -->
@endpush
