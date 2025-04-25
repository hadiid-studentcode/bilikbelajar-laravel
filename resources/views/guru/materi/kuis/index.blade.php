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
                    <div class="card-header">
                        <div class="d-flex flex-wrap justify-content-between align-items-center gap-3">
                            <h5 class="mb-0">Daftar Kuis</h5>
                            <div class="d-flex flex-wrap gap-2">
                                <a href="{{ route('guru.materi.kelas', $materi->kelas) }}" class="btn btn-secondary d-flex align-items-center gap-1">
                                    <i class="bx bx-arrow-back"></i>
                                    <span>Kembali</span>
                                </a>

                                <button type="button" class="btn btn-primary d-flex align-items-center gap-1"
                                    data-bs-toggle="modal" data-bs-target="#createQuizModal">
                                    <i class="bx bx-plus"></i>
                                    <span>
                                        @if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1)
                                            Edit
                                        @else
                                            Tambah
                                        @endif ({{ $materi->judul }}) Kuis
                                    </span>
                                </button>

                                @if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1)
                                    <form action="{{ route('guru.materi.kuis.destroy', $materi_id) }}" method="POST"
                                        id="deleteQuizForm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-danger d-flex align-items-center gap-1"
                                            data-bs-toggle="modal" data-bs-target="#deleteQuizModal">
                                            <i class="bx bx-trash"></i>
                                            <span>Hapus Kuis</span>
                                        </button>
                                    </form>

                                    <!-- Modal Konfirmasi Hapus -->
                                    <div class="modal fade" id="deleteQuizModal" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Konfirmasi Hapus</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p class="mb-0">Apakah Anda yakin ingin menghapus kuis ini? Tindakan
                                                        ini tidak dapat dibatalkan.</p>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Batal</button>
                                                    <button type="button" class="btn btn-danger"
                                                        onclick="document.getElementById('deleteQuizForm').submit()">Hapus</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="card-body">

                        {{-- <div class="card">
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
                        </div> --}}
                           @include('components.alertComponents')

                       
                        <div class="table-responsive mt-3">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Siswa</th>
                                        <th>Total Nilai</th>
                                        <th>Jumlah Benar</th>
                                        <th>Jumlah Salah</th>
                                        <th>Jumlah Tidak Dijawab</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($nilaiKuis as $nk)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $nk->siswa->nama }}</td>
                                            <td><span class="badge bg-success">{{ $nk->total_nilai }}/100</span></td>
                                            <td><span class="badge bg-success">{{ $nk->jumlah_benar }}</span></td>
                                            <td><span class="badge bg-danger">{{ $nk->jumlah_salah }}</span></td>
                                            <td><span class="badge bg-warning">{{ $nk->jumlah_tidak_dijawab }}</span></td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button data-bs-toggle="modal"
                                                        data-bs-target="#detailJawabanModal_{{ $nk->siswa_id }}"
                                                        class="btn btn-sm btn-info">
                                                        <i class="bx bx-detail"></i>
                                                    </button>

                                                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                        data-bs-target="#deleteJawabanModal_{{ $nk->id }}">
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

    <!-- Modal Detail Jawaban per Siswa -->
    @foreach ($nilaiKuis as $nk)
        <div class="modal fade" id="detailJawabanModal_{{ $nk->siswa_id }}" tabindex="-1">
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
                                        <td class="fw-bold">{{ $nk->siswa->nama }}</td>
                                    </tr>
                                    <tr>
                                        <th>Waktu Selesai</th>
                                        <td>:</td>
                                        <td>{{ $nk->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>:</td>
                                        <td><span class="badge bg-success">Selesai</span></td>
                                    </tr>
                                    <tr>
                                        <th>Nilai Total</th>
                                        <td>:</td>
                                        <td><span class="fw-bold">{{ $nk->total_nilai }}</span>/100</td>
                                    </tr>
                                </table>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">Rincian Jawaban</h6>
                            </div>
                            <div class="card-body">
                                <div class="accordion" id="accordionJawaban_{{ $nk->siswa_id }}">
                                    @foreach ($jawabanKuis->where('siswa_id', $nk->siswa_id) as $jawaban)
                                        <div class="accordion-item">
                                            <h2 class="accordion-header">
                                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}"
                                                    type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#soal{{ $jawaban->kuis_id }}_{{ $nk->siswa_id }}">
                                                    <div
                                                        class="d-flex justify-content-between align-items-center w-100 me-3">
                                                        <span>Soal #{{ $loop->iteration }}</span>
                                                        <span
                                                            class="badge {{ $jawaban->poin > 0 ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $jawaban->poin > 0 ? 'Benar' : 'Salah' }}
                                                            ({{ $jawaban->poin > 0 ? '+' : '' }}{{ $jawaban->poin }})
                                                        </span>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="soal{{ $jawaban->kuis_id }}_{{ $nk->siswa_id }}"
                                                class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}">
                                                <div class="accordion-body">
                                                    <p class="fw-medium mb-3">{!! $jawaban->kuis->pertanyaan !!}</p>
                                                    <div class="mb-3">
                                                        <div class="fw-medium mb-1">Pilihan Jawaban:</div>
                                                        @foreach (['a', 'b', 'c', 'd', 'e'] as $opsi)
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    {{ $jawaban->jawaban == $opsi ? 'checked' : '' }}
                                                                    disabled>
                                                                <label
                                                                    class="form-check-label {{ $jawaban->kuis->jawaban_benar == $opsi ? 'text-success' : '' }}
                                                        {{ $jawaban->jawaban == $opsi && $jawaban->jawaban != $jawaban->kuis->jawaban_benar ? 'text-danger' : '' }}">
                                                                    @if ($jawaban->kuis->jawaban_benar == $opsi)
                                                                        <i class="bx bx-check"></i>
                                                                    @endif
                                                                    @if ($jawaban->jawaban == $opsi && $jawaban->jawaban != $jawaban->kuis->jawaban_benar)
                                                                        <i class="bx bx-x"></i>
                                                                    @endif
                                                                    {{ $jawaban->kuis->{'jawaban_' . $opsi} }}
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
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

        <!-- Modal Hapus Jawaban -->
        <div class="modal fade" id="deleteJawabanModal_{{ $nk->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus Jawaban</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p class="mb-0">Apakah Anda yakin ingin menghapus jawaban kuis dari siswa <strong>{{ $nk->siswa->nama }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('guru.materi.kuis.destroy.nilaiKuis', $nk->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    <!-- Modal Tambah Kuis -->
    <div class="modal fade" id="createQuizModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        @if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1)
                            Edit
                        @else
                            Tambah
                        @endif Kuis Baru
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="@if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1) {{ route('guru.materi.kuis.update', $materi_id) }}@else {{ route('guru.materi.kuis.store', $materi_id) }} @endif"
                        method="POST" id="createQuizForm">
                        @csrf
                        @if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1)
                            @method('PUT')
                        @endif

                        <div class="card mb-3">
                            <div class="card-body">
                                <h6 class="card-subtitle mb-3">Daftar Soal</h6>
                                <div id="questionContainer">
                                    @if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1)
                                        @foreach ($kuis as $k)
                                            <div class="card mb-3 question-card">
                                                <div class="card-body">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <h6 class="soal-number mb-0">Soal {{ $loop->iteration }}</h6>
                                                        <button type="button" class="btn btn-danger btn-sm remove-question" @if($loop->iteration == 1) style="display:none" @endif>
                                                            <i class="bx bx-trash"></i>
                                                        </button>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Pertanyaan</label>
                                                        <input type="hidden" name="soal[{{ $loop->iteration }}][pertanyaan]" id="pertanyaan{{ $loop->iteration }}" value="{{ $k->pertanyaan ?? '' }}" />
                                                        <div class="editor" data-target="pertanyaan{{ $loop->iteration }}"></div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-6">
                                                            <label class="form-label">Bobot Nilai</label>
                                                            <input type="number" class="form-control"
                                                                name="soal[{{ $loop->iteration }}][bobot]" required
                                                                min="1" max="100" value="{{ $k->poin_benar }}">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label d-block">Pilihan Jawaban</label>
                                                        @foreach (['a', 'b', 'c', 'd', 'e'] as $opsi)
                                                            <div class="form-check mb-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="soal[{{ $loop->parent->iteration }}][jawaban_benar]"
                                                                    value="{{ $opsi }}"
                                                                    id="soal{{ $loop->parent->iteration }}Opsi{{ $opsi }}"
                                                                    {{ $opsi == $k->jawaban_benar ? 'checked' : '' }}
                                                                    {{ $opsi == 'a' ? 'required' : '' }}>
                                                                <label class="form-check-label w-100"
                                                                    for="soal{{ $loop->parent->iteration }}Opsi{{ $opsi }}">
                                                                    <div class="input-group">
                                                                        <span
                                                                            class="input-group-text">{{ strtoupper($opsi) }}</span>
                                                                        <input type="text" class="form-control"
                                                                            name="soal[{{ $loop->parent->iteration }}][opsi][{{ $opsi }}]"
                                                                            value="{{ $k->{'jawaban_' . $opsi} }}" required>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="card mb-3 question-card">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h6 class="soal-number mb-0">Soal 1</h6>
                                                    <button type="button" class="btn btn-danger btn-sm remove-question" style="display:none">
                                                        <i class="bx bx-trash"></i>
                                                    </button>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Pertanyaan</label>
                                                    <textarea class="form-control" name="soal[1][pertanyaan]" rows="2" required></textarea>
                                                </div>
                                                <div class="row mb-3">
                                                    <div class="col-md-6">
                                                        <label class="form-label">Bobot Nilai</label>
                                                        <input type="number" class="form-control"
                                                            name="soal[1][bobot]" required
                                                            min="1" max="100" value="10">
                                                    </div>
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label d-block">Pilihan Jawaban</label>
                                                    @foreach (['a', 'b', 'c', 'd', 'e'] as $opsi)
                                                        <div class="form-check mb-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="soal[1][jawaban_benar]"
                                                                value="{{ $opsi }}"
                                                                id="soal1Opsi{{ $opsi }}"
                                                                {{ $opsi == 'a' ? 'required' : '' }}>
                                                            <label class="form-check-label w-100"
                                                                for="soal1Opsi{{ $opsi }}">
                                                                <div class="input-group">
                                                                    <span
                                                                        class="input-group-text">{{ strtoupper($opsi) }}</span>
                                                                    <input type="text" class="form-control"
                                                                        name="soal[1][opsi][{{ $opsi }}]"
                                                                        required>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <div class="text-center mt-3">
                                    <button type="button" class="btn btn-primary" id="addQuestion">
                                        <i class="bx bx-plus"></i> Tambah Soal
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                @if (isset($kuis) && !empty($kuis) && $kuis->count() >= 1)
                                    Edit
                                @else
                                    Tambah
                                @endif
                                Kuis
                            </button>

                        </div>
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

    document.addEventListener('DOMContentLoaded', function() {
        // Initialize editors for existing questions
        document.querySelectorAll('.editor').forEach(initializeEditor);

        // Add event listener for new question button
        document.getElementById('addQuestion').addEventListener('click', function() {
            // Wait for the new question to be added to DOM
            setTimeout(() => {
                const newEditor = document.querySelector('.question-card:last-child .editor');
                if (newEditor) {
                    initializeEditor(newEditor);
                }
            }, 100);
        });
    });

    // ...existing code... (keep the existing quiz form handling code)
</script>
@endpush
