@extends('layouts.main')

@push('css')
    <style>
        .custom-accordion .accordion-button:not(.collapsed) {
            background-color: #f8f9fa;
            color: #435971;
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
                    <div class="card-header">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <h5 class="mb-0">Daftar Evaluasi</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('guru.materi.kelas', $materi->kelas) }}"
                                    class="btn btn-secondary d-flex align-items-center gap-1">
                                    <i class="bx bx-arrow-back"></i>
                                    <span>Kembali</span>
                                </a>

                                <button type="button" class="btn btn-primary d-flex align-items-center gap-1"
                                    data-bs-toggle="modal" data-bs-target="#createEvaluasiModal">
                                    <i class="bx bx-plus"></i>
                                    <span>
                                        @if (isset($evaluasi) && !empty($evaluasi) && $evaluasi->count() >= 1)
                                            Edit
                                        @else
                                            Tambah
                                        @endif Evaluasi
                                    </span>
                                </button>

                                @if (isset($evaluasi) && !empty($evaluasi) && $evaluasi->count() >= 1)
                                    <button type="button" class="btn btn-danger d-flex align-items-center gap-1"
                                        data-bs-toggle="modal" data-bs-target="#deleteEvaluasiModal">
                                        <i class="bx bx-trash"></i>
                                        <span>Hapus Evaluasi</span>
                                    </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Status</th>
                                        <th>Nilai</th>
                                        <th>Tanggal Pengumpulan</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiEvaluasi as $ne)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $ne->siswa->nama }}</td>
                                            <td>
                                                @if ($ne->total_nilai == 0)
                                                    <span class="badge bg-danger">Belum Dinilai</span>
                                                @else
                                                    <span class="badge bg-success">Sudah Dinilai</span>
                                                @endif
                                            </td>
                                            <td><span class="badge bg-success">{{ $ne->total_nilai }}/100</span></td>
                                            <td>{{ $ne->created_at->format('d F Y H:i') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#detailJawabanModal_{{ $ne->id }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bx bx-detail"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteJawabanModal_{{ $ne->id }}">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @foreach ($nilaiEvaluasi as $ne)
        <!-- Modal Detail Jawaban -->
        <div class="modal fade" id="detailJawabanModal_{{ $ne->id }}" tabindex="-1">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Detail Jawaban Evaluasi</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row mb-4">
                            <div class="col-md-12">
                                <table class="table table-sm">
                                    <tr>
                                        <th width="150">Nama Siswa</th>
                                        <td>:</td>
                                        <td class="fw-bold">{{ $ne->siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Pengumpulan</th>
                                        <td>:</td>
                                        <td>{{ $ne->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td>
                                            @if ($ne->total_nilai == 0)
                                                <span class="badge bg-danger">Belum Dinilai</span>
                                            @else
                                                <span class="badge bg-success">Sudah Dinilai</span>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <form action="{{ route('guru.materi.evaluasi.update.nilaiEvaluasi', $ne->id) }}" method="POST"
                            class="nilai-form">
                            @csrf
                            @method('PUT')
                            <div class="accordion" id="accordionJawaban">
                                @foreach ($jawabanEvaluasi as $index => $jawaban)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}"
                                                type="button" data-bs-toggle="collapse"
                                                data-bs-target="#pertanyaan{{ $index + 1 }}">
                                                <div class="d-flex justify-content-between align-items-center w-100 me-3">
                                                    <span>Soal #{{ $index + 1 }}</span>
                                                </div>
                                            </button>
                                        </h2>
                                        <div id="pertanyaan{{ $index + 1 }}"
                                            class="accordion-collapse collapse {{ $index === 0 ? 'show' : '' }}">
                                            <div class="accordion-body">
                                                <div class="card mb-3">
                                                    <div class="card-body">
                                                        <h6 class="card-title mb-2">Pertanyaan:</h6>
                                                        <div class="mb-3">{!! $jawaban->evaluasi->soal !!}</div>

                                                        <h6 class="card-title mb-2">Jawaban Siswa:</h6>
                                                        <div class="mb-3">{!! $jawaban->jawaban !!}</div>

                                                        <h6 class="card-title mb-2">Contoh Jawaban:</h6>
                                                        <div class="mb-3 text-muted">{!! $jawaban->evaluasi->jawaban !!}</div>

                                                        <div class="row align-items-center">
                                                            <div class="col-md-6">
                                                                <h6 class="card-title mb-2">Bobot Soal: <span
                                                                        class="text-primary">{{ $jawaban->evaluasi->poin }}
                                                                        poin</span></h6>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="mb-3">
                                                    <label class="form-label">Nilai
                                                        (0-{{ $jawaban->evaluasi->poin }})
                                                    </label>
                                                    <input type="number" class="form-control" name="nilai[]" min="0"
                                                        max="{{ $jawaban->evaluasi->poin }}"
                                                        value="{{ $jawaban->nilai }}">
                                                    <input type="hidden" name="jawaban_id[]" value="{{ $jawaban->id }}">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            <div class="mb-3">
                                <label class="form-label">Catatan Guru (Opsional)</label>
                                <textarea class="form-control" name="catatan" rows="3">{{ $ne->catatan }}</textarea>
                            </div>

                            <div class="d-flex justify-content-end mt-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="bx bx-check me-1"></i>
                                    Simpan Semua Nilai
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @foreach ($nilaiEvaluasi as $ne)
        
        <!-- Modal Hapus Jawaban Evaluasi -->
        <div class="modal fade" id="deleteJawabanModal_{{ $ne->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus Jawaban</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Apakah Anda yakin ingin menghapus jawaban evaluasi dari siswa
                            <strong>{{ $ne->siswa->nama }}</strong>? Tindakan ini akan menghapus semua jawaban dan nilai
                            siswa. Tindakan ini tidak
                            dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('guru.materi.evaluasi.destroy.nilaiEvaluasi', $ne->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus Jawaban</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- <!-- Modal Hapus Jawaban Evaluasi -->
    <div class="modal fade" id="deleteJawabanModal_2" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Jawaban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus jawaban evaluasi dari siswa <strong>Jane
                            Smith</strong>? Tindakan ini akan menghapus semua jawaban dan nilai siswa. Tindakan ini tidak
                        dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <form action="#" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Jawaban</button>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}

    <!-- Modal Tambah Evaluasi -->
    <div class="modal fade" id="createEvaluasiModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if (isset($evaluasi) && !empty($evaluasi) && $evaluasi->count() >= 1)
                            Edit
                        @else
                            Tambah
                        @endif Evaluasi
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form
                        action="@if (isset($evaluasi) && !empty($evaluasi) && $evaluasi->count() >= 1) {{ route('guru.materi.evaluasi.update', $materi_id) }} @else  {{ route('guru.materi.evaluasi.store', $materi_id) }} @endif"
                        method="POST">
                        @csrf
                        @if (isset($evaluasi) && !empty($evaluasi) && $evaluasi->count() >= 1)
                            @method('PUT')
                        @endif
                        <div id="soalContainer">
                            @if (isset($evaluasi) && !empty($evaluasi) && $evaluasi->count() >= 1)
                                @foreach ($evaluasi as $index => $soal)
                                    <div class="soal-item card mb-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <h6 class="card-title mb-0">Soal #{{ $index + 1 }}</h6>
                                                <button type="button" class="btn btn-danger btn-sm"
                                                    onclick="hapusSoal(this)">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Pertanyaan</label>
                                                <input type="hidden" name="soal[]" id="soal{{ $index + 1 ?? 1 }}"
                                                    value="{{ $soal['soal'] ?? '' }}">
                                                <div class="editor" data-target="soal{{ $index + 1 ?? 1 }}"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Contoh Jawaban (Untuk Panduan Penilaian)</label>
                                                <input type="hidden" name="jawaban_contoh[]"
                                                    id="jawaban{{ $index + 1 ?? 1 }}"
                                                    value="{{ $soal['jawaban'] ?? '' }}">
                                                <div class="editor" data-target="jawaban{{ $index + 1 ?? 1 }}"></div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Bobot Nilai</label>
                                                <input type="number" class="form-control" name="bobot[]" min="0"
                                                    max="100" value="{{ $soal['poin'] }}" required>
                                                <small class="text-muted">Nilai maksimal yang bisa diberikan untuk soal
                                                    ini</small>
                                            </div>
                                            <input type="hidden" name="soal_id[]" value="{{ $soal['id'] }}">
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="soal-item card mb-3">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <h6 class="card-title mb-0">Soal #1</h6>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="hapusSoal(this)">
                                                <i class="bx bx-trash"></i>
                                            </button>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Pertanyaan</label>
                                            <input type="hidden" name="soal[]" id="soal1">
                                            <div class="editor" data-target="soal1"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contoh Jawaban (Untuk Panduan Penilaian)</label>
                                            <input type="hidden" name="jawaban_contoh[]" id="jawaban1">
                                            <div class="editor" data-target="jawaban1"></div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Bobot Nilai</label>
                                            <input type="number" class="form-control" name="bobot[]" min="0"
                                                max="100" value="100" required>
                                            <small class="text-muted">Nilai maksimal yang bisa diberikan untuk soal
                                                ini</small>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>

                        <div class="text-center mb-3">
                            <button type="button" class="btn btn-secondary" onclick="tambahSoal()">
                                <i class="bx bx-plus"></i> Tambah Soal
                            </button>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Evaluasi</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Konfirmasi Hapus Evaluasi -->
    <div class="modal fade" id="deleteEvaluasiModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Evaluasi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus seluruh evaluasi pada materi ini? Tindakan ini akan
                        menghapus semua soal dan jawaban siswa. Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('guru.materi.evaluasi.destroy', $materi_id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-danger">Hapus Evaluasi</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
        function initializeEditor(editorElement) {
            const targetId = editorElement.getAttribute('data-target');

            ClassicEditor.create(editorElement, {
                    toolbar: [
                        "undo", "redo", "|",
                        "heading", "|",
                        "bold", "italic", "|",
                        "link", "bulletedList", "numberedList", "|",
                        "indent", "outdent", "|",
                        "blockQuote", "insertTable", "|",
                    ],
                })
                .then((editor) => {
                    editor.editing.view.change((writer) => {
                        writer.setStyle("height", "200px", editor.editing.view.document.getRoot());
                        writer.setStyle("width", "100%", editor.editing.view.document.getRoot());
                    });

                    const targetInput = document.querySelector(`#${targetId}`);
                    if (targetInput.value) {
                        editor.setData(targetInput.value);
                    }

                    editor.model.document.on("change:data", () => {
                        targetInput.value = editor.getData();
                    });
                })
                .catch((error) => {
                    console.error(error);
                });
        }

        // Existing script content...
        let soalCounter = 1;

        function tambahSoal() {
            soalCounter++;
            const template = `
            <div class="soal-item card mb-3">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h6 class="card-title mb-0">Soal #${soalCounter}</h6>
                        <button type="button" class="btn btn-danger btn-sm" onclick="hapusSoal(this)">
                            <i class="bx bx-trash"></i>
                        </button>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pertanyaan</label>
                        <input type="hidden" name="soal[]" id="soal${soalCounter}">
                        <div class="editor" data-target="soal${soalCounter}"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Contoh Jawaban (Untuk Panduan Penilaian)</label>
                        <input type="hidden" name="jawaban_contoh[]" id="jawaban${soalCounter}">
                        <div class="editor" data-target="jawaban${soalCounter}"></div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Bobot Nilai</label>
                        <input type="number" class="form-control" name="bobot[]" min="0" max="100" value="100" required>
                        <small class="text-muted">Nilai maksimal yang bisa diberikan untuk soal ini</small>
                    </div>
                </div>
            </div>
        `;
            document.getElementById('soalContainer').insertAdjacentHTML('beforeend', template);

            // Initialize CKEditor for both question and answer fields
            const newSoalItem = document.querySelector('.soal-item:last-child');
            const editors = newSoalItem.querySelectorAll('.editor');
            editors.forEach(editor => {
                initializeEditor(editor);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Initialize all editors
            document.querySelectorAll('.editor').forEach(initializeEditor);
        });

        function hapusSoal(button) {
            if (document.getElementsByClassName('soal-item').length > 1) {
                // Destroy CKEditor instances before removing the element
                const soalItem = button.closest('.soal-item');
                const editors = soalItem.querySelectorAll('.editor');
                editors.forEach(editor => {
                    if (editor.ckeditorInstance) {
                        editor.ckeditorInstance.destroy();
                    }
                });
                soalItem.remove();
                updateSoalNumbers();
            } else {
                alert('Minimal harus ada 1 soal!');
            }
        }

        function updateSoalNumbers() {
            document.querySelectorAll('.soal-item').forEach((item, index) => {
                item.querySelector('.card-title').textContent = `Soal #${index + 1}`;
            });
            soalCounter = document.getElementsByClassName('soal-item').length;
        }
    </script>
@endpush
