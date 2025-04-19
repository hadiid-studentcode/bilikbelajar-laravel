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
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <h4 class="fw-bold py-3 mb-4">Tujuan & Capaian Pembelajaran</h4>

        <div class="row">
            <div class="col-md-12">
                <div class="card mb-4">
                    <h5 class="card-header">Input Tujuan dan Capaian Pembelajaran</h5>
                    <div class="card-body">
                        <form id="formTujuanCapaian"
                            action="@if ($capaian && $tujuan) {{ route('guru.cptp.update', [$capaian->id, $tujuan->id]) }}@else{{ route('guru.cptp.store') }} @endif"
                            method="POST">
                            @csrf
                            @if ($capaian && $tujuan)
                                @method('PUT')
                            @endif
                            <div class="row">
                                <div class="col-12 textarea-wrapper">
                                    <label for="capaian_pembelajaran" class="form-label">Capaian Pembelajaran</label>
                                    <textarea class="form-control" id="capaian_pembelajaran" name="cp" rows="8"
                                        placeholder="Masukkan capaian pembelajaran...">{{ $capaian?->dekripsi }}</textarea>
                                    <div class="textarea-counter">
                                        <span id="capaian-count">0</span>/1000 karakter
                                    </div>
                                </div>

                                <div class="col-12 textarea-wrapper">
                                    <label for="tujuan_pembelajaran" class="form-label">Tujuan Pembelajaran</label>
                                    <textarea class="form-control" id="tujuan_pembelajaran" name="tp" rows="8   "
                                        placeholder="Masukkan tujuan pembelajaran...">{{ $tujuan?->dekripsi }}</textarea>
                                    <div class="textarea-counter">
                                        <span id="tujuan-count">0</span>/1000 karakter
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        @if ($capaian && $tujuan)
                                            Ubah
                                        @else
                                            Tambah
                                        @endif (CTRL + S)
                                    </button>
                                    <button type="reset" class="btn btn-outline-secondary">Reset</button>
                                    @if ($capaian && $tujuan)
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal">
                                            Delete
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </form>

                        <!-- Delete Modal -->
                        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="deleteModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p>Apakah Anda yakin ingin menghapus data ini?</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                            Batal
                                        </button>
                                        @if ($capaian && $tujuan)
                                            <form action="{{ route('guru.cptp.destroy', [$capaian->id, $tujuan->id]) }}"
                                                method="post" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Hapus</button>
                                            </form>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tujuanTextarea = document.getElementById('tujuan_pembelajaran');
            const capaianTextarea = document.getElementById('capaian_pembelajaran');
            const tujuanCount = document.getElementById('tujuan-count');
            const capaianCount = document.getElementById('capaian-count');

            // Initialize counters
            updateCounter(tujuanTextarea, tujuanCount);
            updateCounter(capaianTextarea, capaianCount);

            function updateCounter(textarea, counter) {
                if (!textarea || !counter) return;
                counter.textContent = textarea.value.length;
                if (textarea.value.length > 1000) {
                    textarea.value = textarea.value.substring(0, 1000);
                    counter.textContent = 1000;
                }
            }

            tujuanTextarea?.addEventListener('input', () => updateCounter(tujuanTextarea, tujuanCount));
            capaianTextarea?.addEventListener('input', () => updateCounter(capaianTextarea, capaianCount));

            // Modal handling
            const deleteModal = document.getElementById('deleteModal');
            if (deleteModal) {
                deleteModal.addEventListener('shown.bs.modal', function() {
                    const cancelButton = deleteModal.querySelector('.btn-outline-secondary');
                    if (cancelButton) {
                        cancelButton.focus();
                    }
                });
            }
        });
    </script>
@endpush
