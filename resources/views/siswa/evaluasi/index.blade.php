@extends('layouts.main')

@push('css')
    <style>
        .evaluasi-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1.5rem;
            height: calc(100vh - 100px);
            display: flex;
            flex-direction: column;
        }

        .evaluasi-header {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .evaluasi-content {
            flex: 1;
            background: #ffffff;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            margin-bottom: 1rem;
        }

        .evaluasi-navigation {
            margin-top: auto;
            padding: 0.5rem;
        }

        .results-card {
            max-width: 600px;
            margin: 2rem auto;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
        }

        .results-header {
            padding: 2rem 1rem;
            text-align: center;
            border-bottom: 1px solid #eee;
        }

        .results-body {
            padding: 2rem 1rem;
        }

        .score-display {
            font-size: 3rem;
            font-weight: bold;
            color: #4361ee;
            margin: 1rem 0;
        }

        .answer-textarea {
            width: 100%;
            min-height: 200px;
            padding: 1rem;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            margin-bottom: 1rem;
            resize: vertical;
        }

        @media (max-width: 768px) {
            .evaluasi-container {
                padding: 1rem;
            }

            .evaluasi-content {
                padding: 1rem;
            }
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y p-2">

        @if ($nilaiEvaluasi)
            <div class="container py-4">
            <div class="results-card">
                <div class="results-header">
                <div class="result-circle mx-auto d-flex align-items-center justify-content-center" 
                     style="width: 200px; height: 200px; border: 8px solid #4361ee; border-radius: 50%;">
                    @if($nilaiEvaluasi->total_nilai > 0)
                    <div class="text-center">
                        <div class="score-display mb-2">
                        {{ $nilaiEvaluasi->total_nilai }}
                        </div>
                        <div class="text-muted">dari 100</div>
                    </div>
                    @else
                    <div class="text-center">
                        <div class="spinner-border text-primary mb-2" role="status">
                        <span class="visually-hidden">Loading...</span>
                        </div>
                        <div class="text-muted">Sedang dinilai...</div>
                    </div>
                    @endif
                </div>
                <h3 class="results-title mt-4">
                    @if($nilaiEvaluasi->total_nilai > 0)
                    Selamat! 
                    @else
                    Mohon Tunggu
                    @endif
                </h3>
                <p class="text-muted">
                    @if($nilaiEvaluasi->total_nilai > 0)
                    Kamu telah menyelesaikan kuis
                    @else
                    Evaluasi Anda sedang dalam proses penilaian
                    @endif
                </p>
                </div>

                <div class="results-body">
                @if($nilaiEvaluasi->total_nilai > 0)
                    <div class="stats-grid d-flex justify-content-center gap-4 mb-4">
                    <div class="stat-card text-center p-3 bg-light rounded">
                        <div class="stat-value text-success fs-4">
                        <i class="fas fa-check-circle"></i>
                        <span>{{ $nilaiEvaluasi->jumlah_benar }}</span>
                        </div>
                        <div class="stat-label mt-2">Jawaban Benar</div>
                    </div>
                    <div class="stat-card text-center p-3 bg-light rounded">
                        <div class="stat-value text-danger fs-4">
                        <i class="fas fa-times-circle"></i>
                        <span>{{ $nilaiEvaluasi->jumlah_salah }}</span>
                        </div>
                        <div class="stat-label mt-2">Jawaban Salah</div>
                    </div>
                    </div>

                    @if ($nilaiEvaluasi->catatan)
                    <div class="mt-4 p-3 bg-light rounded">
                        <h5 class="mb-3">
                        <i class="fas fa-sticky-note me-2"></i>Catatan:
                        </h5>
                        <p class="text-muted mb-0">
                        {{ $nilaiEvaluasi->catatan }}
                        </p>
                    </div>
                    @endif
                @endif

                <div class="d-grid gap-2 mt-4">
                    <a href="{{ route('siswa.dashboard.index') }}" 
                       class="btn btn-primary btn-lg rounded-pill">
                    <i class="fas fa-home me-2"></i>
                    Kembali ke Dashboard
                    </a>
                </div>
                </div>
            </div>
            </div>
        @else
            <div class="evaluasi-container" x-data="evaluasi">
                <!-- Evaluasi Header -->
                <div class="evaluasi-header text-center mb-4" :class="{ 'hidden': evaluasiSubmitted }">
                    <h2 class="mb-3">Evaluasi</h2>
                    <div class="progress mb-3">
                        <div class="progress-bar" role="progressbar" :style="`width: ${progress}%`"></div>
                    </div>
                    <p class="text-muted">
                        Pertanyaan <span x-text="currentQuestion + 1"></span> dari <span
                            x-text="evaluasiData.length"></span>
                    </p>
                </div>

                <!-- Evaluasi Content -->
                <div class="evaluasi-content">
                    <template x-if="!evaluasiSubmitted">
                        <div>
                            <h4 class="mb-4">Pertanyaan Evaluasi:</h4>
                            <div class="mb-4 question-text" id="question" x-html="currentQuestionData.soal"></div>
                            <div class="mb-3">
                                <label for="answer" class="form-label">Jawaban Anda:</label>
                                <textarea class="answer-textarea" id="answer" x-model="answers[currentQuestion].answer"
                                    placeholder="Tulis jawaban Anda di sini..."></textarea>
                            </div>
                        </div>
                    </template>

                    <template x-if="evaluasiSubmitted">
                        <div class="results-card">
                            <div class="results-header">
                                <h3 class="mb-3">Evaluasi Terkirim!</h3>
                                <p class="text-muted">Jawaban Anda telah berhasil disimpan dan akan dinilai oleh guru.</p>
                            </div>
                            <div class="results-body text-center">
                                <i class="fas fa-check-circle text-success fs-1 mb-3"></i>
                                <div class="d-grid gap-2 mt-4">
                                    <a href="{{ route('siswa.dashboard.index') }}"
                                        class="btn btn-primary btn-lg rounded-pill">
                                        <i class="fas fa-home me-2"></i>
                                        Kembali ke Dashboard
                                    </a>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>

                <!-- Evaluasi Navigation -->
                <div class="evaluasi-navigation" x-show="!evaluasiSubmitted">
                    <div class="d-flex justify-content-between">
                        <button class="btn btn-outline-secondary" @click="previousQuestion"
                            :disabled="currentQuestion === 0">
                            Previous
                        </button>
                        <button class="btn btn-primary" @click="nextQuestion"
                            x-text="currentQuestion === evaluasiData.length - 1 ? 'Submit' : 'Next'">
                        </button>
                    </div>
                </div>
            </div>
        @endif



    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('evaluasi', () => ({
                evaluasiData: @json($evaluasi),
                currentQuestion: 0,
                answers: [],
                evaluasiSubmitted: false,
                materiId: @json($materi_id),
                csrfToken: @json(session()->token()),

                init() {
                    this.answers = this.evaluasiData.map(q => ({
                        question_id: q.id,
                        answer: ''
                    }));
                },

                get progress() {
                    return ((this.currentQuestion + 1) / this.evaluasiData.length) * 100;
                },

                get currentQuestionData() {
                    return this.evaluasiData[this.currentQuestion];
                },

                nextQuestion() {
                    if (this.currentQuestion === this.evaluasiData.length - 1) {
                        this.submitEvaluasi();
                    } else {
                        this.currentQuestion++;
                    }
                },

                previousQuestion() {
                    if (this.currentQuestion > 0) {
                        this.currentQuestion--;
                    }
                },

                async submitEvaluasi() {
                    try {
                        const formData = new FormData();
                        formData.append('materi_id', this.materiId);
                        formData.append('answers', JSON.stringify(this.answers));
                        formData.append('question_ids', JSON.stringify(this.evaluasiData.map(q => q
                            .id)));
                        formData.append('_token', this.csrfToken);

                        await axios.post('{{ route('siswa.evaluasi.store') }}', formData);
                        this.evaluasiSubmitted = true;
                    } catch (error) {
                        console.error('Error submitting evaluation:', error);
                        alert('Terjadi kesalahan saat mengirim evaluasi');
                    }
                }
            }));
        });
    </script>
@endpush
