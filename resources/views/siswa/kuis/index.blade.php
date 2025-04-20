@extends('layouts.main')

@push('css')
@endpush
@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
 <main class="py-5">
      <div class="container">
        <div class="quiz-container bg-white rounded-4 p-4 shadow-sm">
          <!-- Quiz Header -->
          <div class="quiz-header text-center mb-5">
            <h2 class="mb-3">Pre Test: Pengenalan Aljabar</h2>
            <div class="progress mb-3" style="height: 10px">
              <div
                class="progress-bar"
                id="quiz-progress"
                role="progressbar"
                style="width: 0%"
              ></div>
            </div>
            <p class="text-muted">
              Question <span id="current-question">1</span> of
              <span id="total-questions">5</span>
            </p>
          </div>

          <!-- Quiz Content -->
          <div id="quiz-content">
            <!-- Questions will be injected here by JavaScript -->
          </div>

          <!-- Quiz Navigation -->
          <div class="quiz-navigation d-flex justify-content-between mt-4">
            <button class="btn btn-outline-secondary" id="prev-btn" disabled>
              Previous
            </button>
            <button class="btn btn-primary" id="next-btn">Next</button>
          </div>

          <!-- Results (initially hidden) -->
          <div id="quiz-results" class="text-center py-5" style="display: none">
            <div class="result-circle mb-4">
              <span id="score">0</span>
              <span class="small">/ 100</span>
            </div>
            <h3 class="mb-3">Quiz Completed!</h3>
            <p class="text-muted mb-4">
              You've completed the pre-test. Here's how you did:
            </p>
            <div class="result-stats d-flex justify-content-center gap-4 mb-4">
              <div class="stat-item">
                <div class="stat-value text-success">
                  ✓ <span id="correct-answers">0</span>
                </div>
                <div class="stat-label">Correct</div>
              </div>
              <div class="stat-item">
                <div class="stat-value text-danger">
                  ✗ <span id="wrong-answers">0</span>
                </div>
                <div class="stat-label">Wrong</div>
              </div>
            </div>
            <a href="materi.html" class="btn btn-primary"
              >Continue to Material</a
            >
          </div>
        </div>
      </div>
    </main>
    </div>
@endsection


@push('js')
 <script>
      // Quiz questions data
      const quizData = [
        {
          question: "What is the value of x in the equation: x + 5 = 12?",
          options: ["5", "7", "12", "17"],
          correct: 1,
        },
        {
          question: "Which of these is an algebraic expression?",
          options: ["2 + 2 = 4", "x + 3", "Hello World", "12345"],
          correct: 1,
        },
        {
          question: "What is the coefficient of x in the term 3x?",
          options: ["x", "3", "0", "None of these"],
          correct: 1,
        },
        {
          question: "Simplify: 2x + 3x",
          options: ["5x", "6", "5", "2x3x"],
          correct: 0,
        },
        {
          question: "What is a variable in algebra?",
          options: [
            "A number that never changes",
            "A symbol that represents a value",
            "A mathematical operation",
            "The answer to an equation",
          ],
          correct: 1,
        },
      ];

      // Quiz functionality will be implemented here
      let currentQuestion = 0;
      let score = 0;
      let answers = new Array(quizData.length).fill(-1);

      // Initialize quiz
      function initQuiz() {
        showQuestion(currentQuestion);
        startTimer(600); // 10 minutes
        updateProgress();
      }

      // Show question
      function showQuestion(index) {
        const quizContent = document.getElementById("quiz-content");
        const question = quizData[index];

        let html = `
                <div class="question-container">
                    <h4 class="mb-4">${question.question}</h4>
                    <div class="options-container">
            `;

        question.options.forEach((option, i) => {
          html += `
                    <div class="option mb-3">
                        <input type="radio" name="quiz" id="option${i}" value="${i}" 
                            ${answers[index] === i ? "checked" : ""}>
                        <label for="option${i}" class="ms-2">${option}</label>
                    </div>
                `;
        });

        html += `</div></div>`;
        quizContent.innerHTML = html;

        // Update navigation buttons
        document.getElementById("prev-btn").disabled = index === 0;
        document.getElementById("next-btn").textContent =
          index === quizData.length - 1 ? "Finish" : "Next";
      }

      // Navigation handlers
      document.getElementById("next-btn").addEventListener("click", () => {
        // Save answer
        const selected = document.querySelector('input[name="quiz"]:checked');
        if (selected) {
          answers[currentQuestion] = parseInt(selected.value);
        }

        if (currentQuestion === quizData.length - 1) {
          finishQuiz();
        } else {
          currentQuestion++;
          showQuestion(currentQuestion);
          updateProgress();
        }
      });

      document.getElementById("prev-btn").addEventListener("click", () => {
        currentQuestion--;
        showQuestion(currentQuestion);
        updateProgress();
      });

      // Update progress
      function updateProgress() {
        const progress = ((currentQuestion + 1) / quizData.length) * 100;
        document.getElementById("quiz-progress").style.width = `${progress}%`;
        document.getElementById("current-question").textContent =
          currentQuestion + 1;
        document.getElementById("total-questions").textContent =
          quizData.length;
      }

      // Timer functionality
      function startTimer(duration) {
        let timer = duration;
        const timerElement = document.getElementById("timer");

        const countdown = setInterval(() => {
          const minutes = Math.floor(timer / 60);
          const seconds = timer % 60;

          timerElement.textContent = `${minutes}:${seconds
            .toString()
            .padStart(2, "0")}`;

          if (--timer < 0) {
            clearInterval(countdown);
            finishQuiz();
          }
        }, 1000);
      }

      // Finish quiz
      function finishQuiz() {
        // Calculate score
        score = answers.reduce((acc, answer, index) => {
          return acc + (answer === quizData[index].correct ? 1 : 0);
        }, 0);

        const finalScore = (score / quizData.length) * 100;

        // Show results
        document.getElementById("quiz-content").style.display = "none";
        document.getElementById("quiz-results").style.display = "block";
        document.querySelector(".quiz-navigation").style.display = "none";
        document.getElementById("score").textContent = Math.round(finalScore);
        document.getElementById("correct-answers").textContent = score;
        document.getElementById("wrong-answers").textContent =
          quizData.length - score;
      }

      // Initialize quiz when page loads
      initQuiz();
    </script>
@endpush
