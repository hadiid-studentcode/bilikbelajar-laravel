@extends('layouts.main')

@push('css')
    <style>
        .quiz-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 1.5rem;
            height: calc(100vh - 100px);
            /* Adjust based on your navbar height */
            display: flex;
            flex-direction: column;
        }

        .quiz-header {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .quiz-header h2 {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .progress {
            height: 8px;
            border-radius: 4px;
            background-color: #e9ecef;
        }

        .progress-bar {
            background-color: #4361ee;
            transition: width 0.3s ease;
        }

        .question-container {
            flex: 1;
            background: #ffffff;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            overflow-y: auto;
            margin-bottom: 1rem;
        }

        .question-container h4 {
            font-size: 1.2rem;
            margin-bottom: 1rem;
        }

        .option {
            background: #f8f9fa;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .option:hover {
            background: #e9ecef;
            border-color: #4361ee;
        }

        .option input[type="radio"] {
            display: none;
        }

        .option label {
            display: block;
            width: 100%;
            cursor: pointer;
            margin: 0;
            padding-left: 2rem;
            position: relative;
        }

        .option label:before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 20px;
            height: 20px;
            border: 2px solid #4361ee;
            border-radius: 50%;
        }

        .option input[type="radio"]:checked+label:after {
            content: '';
            position: absolute;
            left: 5px;
            top: 50%;
            transform: translateY(-50%);
            width: 10px;
            height: 10px;
            background: #4361ee;
            border-radius: 50%;
        }

        .quiz-navigation {
            margin-top: auto;
            padding: 0.5rem;
        }

        .btn {
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        #quiz-results {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            padding: 1.5rem;
        }

        .result-circle {
            width: min(120px, 25vw);
            height: min(120px, 25vw);
            border-radius: 50%;
            background: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto;
            font-size: clamp(1.5rem, 4vw, 2.5rem);
            font-weight: bold;
            color: #4361ee;
            border: min(8px, 2vw) solid #4361ee;
        }

        .result-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(100px, 1fr));
            gap: 1rem;
            width: 100%;
            max-width: 400px;
        }

        .stat-item {
            text-align: center;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }

        .stat-value {
            font-size: clamp(1.2rem, 3vw, 1.5rem);
            font-weight: bold;
            margin-bottom: 0.25rem;
        }

        @media (max-height: 700px) {
            .quiz-container {
                padding: 1rem;
            }

            .quiz-header {
                padding: 0.75rem;
                margin-bottom: 0.5rem;
            }

            .question-container {
                padding: 1rem;
            }

            .option {
                padding: 0.5rem;
                margin-bottom: 0.25rem;
            }

            .result-circle {
                width: 100px;
                height: 100px;
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .quiz-container {
                padding: 1rem;
            }

            .question-container {
                padding: 1.5rem;
            }

            .btn {
                padding: 0.5rem 1.5rem;
            }
        }

        @media (max-height: 600px) {
            #quiz-results {
                padding: 1rem;
                gap: 0.5rem;
            }

            .result-circle {
                width: 80px;
                height: 80px;
                border-width: 4px;
            }

            h3 {
                font-size: 1.25rem;
                margin: 0;
            }

            p {
                font-size: 0.9rem;
                margin: 0;
            }

            .stat-item {
                padding: 0.5rem;
            }
        }

        /* Quiz Results Styling */
        .quiz-results-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            background: rgba(255, 255, 255, 0.98);
            z-index: 1000;
        }

        .quiz-results-content {
            max-width: 500px;
            width: 90%;
            text-align: center;
            padding: 2rem;
        }

        .quiz-header.hidden,
        .quiz-navigation.hidden {
            display: none !important;
        }

        .result-circle {
            animation: scaleIn 0.5s ease-out;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }

            to {
                transform: scale(1);
            }
        }

        .results-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #4361ee;
        }
    </style>
@endpush

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y p-2>
        <div class="quiz-container" x-data="quiz">
        <!-- Quiz Header -->
        <div class="quiz-header text-center mb-5" :class="{ 'hidden': quizFinished }">
            <h2 class="mb-3">Kuis</h2>
            <div class="progress mb-3">
                <div class="progress-bar" id="quiz-progress" role="progressbar" :style="`width: ${progress}%`">
                </div>
            </div>
            <p class="text-muted">
                Question <span x-text="currentQuestion + 1"></span> of
                <span x-text="kuis.length"></span>
            </p>
        </div>

        <!-- Quiz Content -->
        <div id="quiz-content" x-show="!quizFinished">
            <div class="question-container">
                <h4 class="mb-4" x-text="currentQuestionData.question"></h4>
                <div class="options-container">
                    <template x-for="(option, index) in currentQuestionData.options" :key="index">
                        <div class="option mb-3">
                            <input type="radio" :id="'option' + index" name="quiz" :value="getAnswerLetter(index)"
                                x-model="answers[currentQuestion]">
                            <label :for="'option' + index" class="ms-2" x-text="option"></label>
                        </div>
                    </template>
                </div>
            </div>
        </div>

        <!-- Quiz Navigation -->
        <div class="quiz-navigation d-flex justify-content-between mt-1" :class="{ 'hidden': quizFinished }">
            <button class="btn btn-outline-secondary" @click="previousQuestion" :disabled="currentQuestion === 0">
                Previous
            </button>
            <button class="btn btn-primary" @click="nextQuestion"
                x-text="currentQuestion === kuis.length - 1 ? 'Finish' : 'Next'">
            </button>
        </div>

        <!-- Results -->
        <template x-if="quizFinished == true">
            <div class="quiz-results-container" x-show="quizFinished" x-cloak>
                <div class="quiz-results-content">
                    <div class="result-circle mb-4">
                        <div>
                            <span x-text="Math.round(finalScore)" class="score"></span>
                            <span class="small">/ 100</span>
                        </div>
                    </div>
                    <h3 class="results-title">Selamat!</h3>
                    <p class="text-muted mb-4">Kamu telah menyelesaikan kuis dengan hasil:</p>
                    <div class="result-stats mb-4">
                        <div class="stat-item">
                            <div class="stat-value text-success">
                                <i class="fas fa-check-circle me-1"></i>
                                <span x-text="correctAnswers"></span>
                            </div>
                            <div class="stat-label">Benar</div>
                        </div>
                        <div class="stat-item">
                            <div class="stat-value text-danger">
                                <i class="fas fa-times-circle me-1"></i>
                                <span x-text="wrongAnswers"></span>
                            </div>
                            <div class="stat-label">Salah</div>
                        </div>
                    </div>

                    <form id="quizForm" method="POST" action="/siswa/kuis/submit" @submit.prevent="submitQuiz">
                        @csrf
                        <input type="hidden" name="quiz_id" :value="quizId">
                        <input type="hidden" name="answers" :value="JSON.stringify(answers)">
                        <input type="hidden" name="score" :value="finalScore">
                        <input type="hidden" name="correct_answers" :value="correctAnswers">
                        <button type="submit" class="btn btn-success btn-lg mb-3">
                            <i class="fas fa-save me-2"></i>Simpan Hasil
                        </button>
                    </form>

                    <a href="/materi" class="btn btn-primary btn-lg">
                        <i class="fas fa-book-open me-2"></i>Lanjut ke Materi
                    </a>
                </div>
            </div>
        </template>
    </div>
    </div>
@endsection

@push('js')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('quiz', () => ({
                kuis: @json($kuis),
                quizId: @json($kuis[0]->id_kuis ?? null),
                currentQuestion: 0,
                answers: new Array(@json($kuis->count())).fill(
                ''), // Changed from -1 to empty string
                quizFinished: false,
                finalScore: 0,
                correctAnswers: 0,

                init() {
                    this.startTimer(600);

                },

                get progress() {
                    return ((this.currentQuestion + 1) / this.kuis.length) * 100;
                },

                get currentQuestionData() {

                    const question = this.kuis[this.currentQuestion];
                    return {
                        question: question.pertanyaan,
                        options: [
                            question.jawaban_a,
                            question.jawaban_b,
                            question.jawaban_c,
                            question.jawaban_d,
                            question.jawaban_e
                        ],
                        correct: this.getCorrectAnswerIndex(question.jawaban_benar)
                    };
                },

                getAnswerLetter(index) {
                    return ['a', 'b', 'c', 'd', 'e'][index];
                },

                getCorrectAnswerIndex(jawaban_benar) {
                    const map = {
                        'a': 0,
                        'b': 1,
                        'c': 2,
                        'd': 3,
                        'e': 4
                    };
                    return map[jawaban_benar.toLowerCase()];
                },

                get wrongAnswers() {
                    return this.kuis.length - this.correctAnswers;
                },

                nextQuestion() {
                    if (this.currentQuestion === this.kuis.length - 1) {
                        this.finishQuiz();
                    } else {
                        this.currentQuestion++;
                    }
                },

                previousQuestion() {
                    if (this.currentQuestion > 0) {
                        this.currentQuestion--;
                    }
                },

                finishQuiz() {
                    this.correctAnswers = this.answers.reduce((acc, answer, index) => {
                        return acc + (answer.toLowerCase() === this.kuis[index].jawaban_benar
                            .toLowerCase() ? 1 : 0);
                    }, 0);

                    const totalPossiblePoints = this.kuis.reduce((acc, question) => acc + question
                        .poin_benar, 0);
                    const earnedPoints = this.kuis.reduce((acc, question, index) => {
                        return acc + (this.answers[index].toLowerCase() === this.kuis[index]
                            .jawaban_benar.toLowerCase() ? this.kuis[index].poin_benar : 0);
                    }, 0);

                    this.finalScore = (earnedPoints / totalPossiblePoints) * 100;
                    this.quizFinished = true;


                    console.log(this.quizId)
                    console.log(this.answers)
                    console.log(this.finalScore)
                    console.log(this.correctAnswers)

                    // Send data to controller
                    fetch('/siswa/kuis/submit', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content,
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                quiz_id: this.quizId,
                                answers: this.answers,
                                score: this.finalScore,
                                correct_answers: this.correctAnswers
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Quiz submitted successfully');
                            }
                        })
                        .catch(error => console.error('Error:', error));
                },

                startTimer(duration) {
                    let timer = duration;
                    const countdown = setInterval(() => {
                        if (this.quizFinished || timer < 0) {
                            clearInterval(countdown);
                            if (!this.quizFinished) {
                                this.finishQuiz();
                            }
                        }
                        timer--;
                    }, 1000);
                },

                async submitQuiz() {
                    try {
                        const form = document.getElementById('quizForm');
                        const response = await fetch(form.action, {
                            method: 'POST',
                            body: new FormData(form),
                            headers: {
                                'Accept': 'application/json'
                            }
                        });

                        if (response.ok) {
                            const result = await response.json();
                            if (result.success) {
                                window.location.href = '/siswa/kuis/hasil/' + this.quizId;
                            }
                        }
                    } catch (error) {
                        console.error('Error submitting quiz:', error);
                    }
                }
            }));
        });
    </script>
@endpush
