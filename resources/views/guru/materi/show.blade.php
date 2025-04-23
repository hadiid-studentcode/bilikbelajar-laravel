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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold">Daftar Materi Kelas {{ $kelas }}</h4>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMateriModal">
                <i class="bx bx-plus"></i> Tambah Materi
            </button>
        </div>
        @include('components.alertComponents')

        {{-- <div class="row mb-4">
            <div class="col-md-6">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Cari materi...">
                    <button class="btn btn-outline-primary" type="button">
                        <i class="bx bx-search"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="row g-4">
            @if ($materi->isEmpty())
                <div class="col-12">
                    <div class="alert alert-info d-flex align-items-center" role="alert">
                        <i class="bx bx-info-circle me-2"></i>
                        <div>
                            Belum ada materi yang ditambahkan untuk kelas ini.
                        </div>
                    </div>
                </div>
            @endif
            @foreach ($materi as $m)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card materi-card h-100">
                        <img src="{{ asset('assets/img/kursus/1.jpg') }}" class="card-img-top" alt="Materi Image">
                        <div class="card-body">
                            <h5 class="card-title">{{ $m->nama }}</h5>
                            <p class="card-text text-muted mb-0">Kelas: {{ $m->kelas }}</p>
                            <p class="card-text"></p>
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-muted">
                                        <i class="bx bx-time"></i> {{ $m->created_at->diffForHumans() }}
                                    </span>
                                    <div>
                                        <button class="btn btn-sm btn-primary me-1" data-bs-toggle="modal"
                                            data-bs-target="#tujuanPembelajaran{{ $m->id }}"
                                            title="Tujuan Pembelajaran">
                                            <i class="bx bx-brain"></i>
                                        </button>
                                        <button class="btn btn-sm btn-info me-1" data-bs-toggle="modal"
                                            data-bs-target="#editMateriModal{{ $m->id }}" title="Edit">
                                            <i class="bx bx-edit"></i>
                                        </button>
                                        <button class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#deleteMateriModal{{ $m->id }}" title="Hapus">
                                            <i class="bx bx-trash"></i>
                                        </button>
                                    </div>
                                </div>

                                <div class="d-flex gap-2 mt-4">
                                    <a href="{{ route('guru.materi.kuis.index', $m->id) }}"
                                        class="btn btn-sm btn-primary w-50">
                                        <i class="bx bx-quiz me-1"></i> Kuis
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success w-50">
                                        <i class="bx bx-notepad me-1"></i> Evaluasi
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createMateriModal" tabindex="-1">
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white">Tambah Materi Baru</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <form id="createMateriForm" action="{{ route('guru.materi.store') }}" enctype="multipart/form-data"
                        method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Nama Materi <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="nama" required>
                                <div class="invalid-feedback">Nama materi harus diisi</div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kelas <span class="text-danger">*</span></label>
                                <select class="form-select" name="kelas" required>
                                    <option selected value="{{ $kelas }}">{{ $kelas }}</option>

                                </select>
                                <div class="invalid-feedback">Pilih kelas</div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <input type="hidden" name="content" id="content" />
                            <div class="editor" data-target="content"></div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">File Materi</label>
                                <input type="file" class="form-control" name="file"
                                    accept=".pdf,.doc,.docx,.ppt,.pptx">
                                <small class="text-muted">Format: PDF</small>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Video Pembelajaran</label>
                                <input type="file" class="form-control" name="video" accept="video/*">
                                <small class="text-muted">Format: MP4</small>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer bg-light">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="bx bx-x me-1"></i> Batal
                    </button>
                    <button type="submit" form="createMateriForm" class="btn btn-primary">
                        <i class="bx bx-save me-1"></i> Simpan Materi
                    </button>
                </div>
            </div>
        </div>
    </div>


    {{-- tujuan pembelajaran --}}
    @foreach ($materi as $m)
        <div class="modal fade" id="tujuanPembelajaran{{ $m->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h5 class="modal-title text-white">
                            <i class="bx bx-brain me-1"></i>
                            Tujuan Pembelajaran
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="tujuanPembelajaranForm{{ $m->id }}" action="{{ route('guru.materi.storeTp') }}"
                            method="POST">
                            @csrf
                            <input type="hidden" name="materi_id" value="{{ $m->id }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold">
                                    Tujuan Pembelajaran untuk Materi "{{ $m->nama }}"
                                </label>

                                @php
                                $tujuanPembelajaran = \App\Models\TujuanPembelajaran::where('materi_id', $m->id)->first();    
                                @endphp
                              
                                <div class="form-text mb-2">
                                    <i class="bx bx-info-circle"></i>
                                    Tuliskan tujuan pembelajaran yang ingin dicapai dalam materi ini
                                </div>
                                <input type="hidden" name="tujuan_pembelajaran" id="tujuan{{ $m->id }}" />
                                <div class="editor" data-target="tujuan{{ $m->id }}">{!! $tujuanPembelajaran?->deskripsi !!}</div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x me-1"></i> Tutup
                        </button>
                        <button type="submit" form="tujuanPembelajaranForm{{ $m->id }}" class="btn btn-primary">
                            <i class="bx bx-check me-1"></i> Simpan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Edit Modal -->
    @foreach ($materi as $m)
        <div class="modal fade" id="editMateriModal{{ $m->id }}" tabindex="-1">
            <div class="modal-dialog modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-info">
                        <h5 class="modal-title text-white">Edit Materi</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <form id="editMateriForm{{ $m->id }}" action="{{ route('guru.materi.update', $m->id) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Nama Materi <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="nama" required
                                        value="{{ $m->nama }}">
                                    <div class="invalid-feedback">Nama materi harus diisi</div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Kelas <span class="text-danger">*</span></label>
                                    <select class="form-select" name="kelas" required>
                                        <option value="{{ $m->kelas }}" selected>{{ $m->kelas }}</option>

                                    </select>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi</label>
                                <input type="hidden" name="editContent" id="editContent{{ $m->id }}"
                                    value="{{ $m->deskripsi }}" />
                                <div class="editor" data-target="editContent{{ $m->id }}"></div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">File Materi</label>
                                        <input type="file" class="form-control" name="file"
                                            accept=".pdf,.doc,.docx,.ppt,.pptx" value="{{ $m->file }}">
                                        <small class="text-muted">Format: PDF, DOC, DOCX, PPT, PPTX (Max. 10MB)</small>
                                        @if ($m->file != null)
                                            <div class="mt-2">
                                                <a target="_blank" href="{{ asset('storage/' . $m->file) }}"
                                                    class="btn btn-info">
                                                    <i class="bx bx-file me-1"></i> Materi
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Video Pembelajaran</label>
                                        <input type="file" class="form-control" name="video" accept="video/*"
                                            value="{{ $m->video }}">
                                        <small class="text-muted">Format: MP4, MKV, AVI (Max. 100MB)</small>
                                        @if ($m->video != null)
                                            <div class="mt-2">
                                                <a target="_blank" href="{{ asset('storage/' . $m->video) }}"
                                                    class="btn btn-info">
                                                    <i class="bx bx-video me-1"></i> Video
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer bg-light">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                            <i class="bx bx-x me-1"></i> Batal
                        </button>
                        <button type="submit" form="editMateriForm{{ $m->id }}" class="btn btn-info">
                            <i class="bx bx-save me-1"></i> Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Modal -->
    @foreach ($materi as $m)
        <div class="modal fade" id="deleteMateriModal{{ $m->id }}" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Konfirmasi Hapus</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus materi "{{ $m->nama }}"?</p>
                        <p class="text-danger"><small>Tindakan ini tidak dapat dibatalkan.</small></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <form action="{{ route('guru.materi.destroy', $m->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('js')
    <script>
        document.querySelectorAll('.editor').forEach(editorElement => {
            const targetId = editorElement.getAttribute('data-target');

            ClassicEditor.create(editorElement, {
                    toolbar: [
                        "undo",
                        "redo",
                        "|",
                        "heading",
                        "|",
                        "bold",
                        "italic",
                        "|",
                        "link",
                        "bulletedList",
                        "numberedList",
                        "|",
                        "indent",
                        "outdent",
                        "|",
                        "blockQuote",
                        "insertTable",
                        "|",
                    ],
                })
                .then((editor) => {
                    // Set editor height using CSS
                    editor.editing.view.change((writer) => {
                        writer.setStyle(
                            "height",
                            "300px",
                            editor.editing.view.document.getRoot()
                        );
                        writer.setStyle(
                            "width",
                            "100%",
                            editor.editing.view.document.getRoot()
                        );
                    });

                    // Set initial content from hidden input
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
        });
    </script>
@endpush
