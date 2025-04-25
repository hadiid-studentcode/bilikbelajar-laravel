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
                                    <tr>
                                        <td>1</td>
                                        <td>John Doe</td>
                                        <td><span class="badge bg-success">Sudah Dinilai</span></td>
                                        <td><span class="badge bg-success">85/100</span></td>
                                        <td>01/03/2024 10:30</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button data-bs-toggle="modal" data-bs-target="#detailJawabanModal_1"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bx bx-detail"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteJawabanModal_1">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>2</td>
                                        <td>Jane Smith</td>
                                        <td><span class="badge bg-warning">Belum Dinilai</span></td>
                                        <td><span class="badge bg-secondary">-</span></td>
                                        <td>01/03/2024 09:15</td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button data-bs-toggle="modal" data-bs-target="#detailJawabanModal_2"
                                                    class="btn btn-sm btn-info">
                                                    <i class="bx bx-detail"></i>
                                                </button>
                                                <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#deleteJawabanModal_2">
                                                    <i class="bx bx-trash"></i>
                                                </button>
                                            </div>
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

    <!-- Modal Detail Jawaban -->
    <div class="modal fade" id="detailJawabanModal_1" tabindex="-1">
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
                                    <td class="fw-bold">John Doe</td>
                                </tr>
                                <tr>
                                    <th>Waktu Pengumpulan</th>
                                    <td>:</td>
                                    <td>01/03/2024 10:30</td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>:</td>
                                    <td><span class="badge bg-success">Sudah Dinilai</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="accordion" id="accordionJawaban">
                        @php
                            $soalEvaluasi = [
                                [
                                    'pertanyaan' =>
                                        'Jelaskan proses fotosintesis pada tumbuhan dan faktor-faktor yang mempengaruhinya!',
                                    'jawaban_siswa' =>
                                        'Fotosintesis adalah proses mengubah air dan CO2 menjadi glukosa dengan bantuan cahaya matahari...',
                                    'contoh_jawaban' =>
                                        'Fotosintesis merupakan proses pembuatan makanan oleh tumbuhan hijau yang memerlukan cahaya matahari, air, dan karbon dioksida...',
                                    'bobot' => 100,
                                    'nilai' => 85,
                                ],
                                [
                                    'pertanyaan' =>
                                        'Bagaimana dampak revolusi industri terhadap perubahan sosial masyarakat?',
                                    'jawaban_siswa' =>
                                        'Revolusi industri membawa perubahan besar dalam cara hidup masyarakat...',
                                    'contoh_jawaban' =>
                                        'Revolusi industri mengakibatkan urbanisasi, perubahan struktur kerja, dan munculnya kelas sosial baru...',
                                    'bobot' => 100,
                                    'nilai' => 90,
                                ],
                                [
                                    'pertanyaan' => 'Jelaskan konsep pembagian kekuasaan trias politika!',
                                    'jawaban_siswa' => 'Trias politika membagi kekuasaan menjadi tiga bagian...',
                                    'contoh_jawaban' =>
                                        'Trias politika adalah konsep pembagian kekuasaan menjadi eksekutif, legislatif, dan yudikatif...',
                                    'bobot' => 100,
                                    'nilai' => 75,
                                ],
                                // Tambah 7 soal lainnya dengan pola yang sama
                            ];

                            for ($i = 0; $i < 7; $i++) {
                                $soalEvaluasi[] = [
                                    'pertanyaan' => 'Soal Evaluasi #' . ($i + 4),
                                    'jawaban_siswa' => 'Jawaban siswa untuk soal #' . ($i + 4),
                                    'contoh_jawaban' => 'Contoh jawaban untuk soal #' . ($i + 4),
                                    'bobot' => 100,
                                    'nilai' => rand(70, 100),
                                ];
                            }
                        @endphp

                        @foreach ($soalEvaluasi as $index => $soal)
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button {{ $index === 0 ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#pertanyaan{{ $index + 1 }}">
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
                                                <p class="mb-3">{{ $soal['pertanyaan'] }}</p>

                                                <h6 class="card-title mb-2">Jawaban Siswa:</h6>
                                                <p class="mb-3">{{ $soal['jawaban_siswa'] }}</p>

                                                <h6 class="card-title mb-2">Contoh Jawaban:</h6>
                                                <p class="mb-3 text-muted">{{ $soal['contoh_jawaban'] }}</p>

                                                <div class="row align-items-center">
                                                    <div class="col-md-6">
                                                        <h6 class="card-title mb-2">Bobot Soal: <span
                                                                class="text-primary">{{ $soal['bobot'] }} poin</span></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <form>
                                            <div class="mb-3">
                                                <label class="form-label">Nilai (0-100)</label>
                                                <input type="number" class="form-control" name="nilai[]" min="0"
                                                    max="100" value="{{ $soal['nilai'] }}">
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label">Catatan Guru (Opsional)</label>
                                                <textarea class="form-control" name="catatan[]" rows="3"></textarea>
                                            </div>
                                            <button type="button" class="btn btn-primary">Simpan Nilai</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Hapus Jawaban Evaluasi -->
    <div class="modal fade" id="deleteJawabanModal_1" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Konfirmasi Hapus Jawaban</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="mb-0">Apakah Anda yakin ingin menghapus jawaban evaluasi dari siswa <strong>John
                            Doe</strong>? Tindakan ini akan menghapus semua jawaban dan nilai siswa. Tindakan ini tidak
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
    </div>

    <!-- Modal Hapus Jawaban Evaluasi -->
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
    </div>

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
