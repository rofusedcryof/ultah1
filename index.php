<?php
// Pengaturan Data Kakak
$nama_kakak = "Kakak Tersayang"; // Ganti dengan nama kakak sepupumu
$umur = "25"; // Ganti dengan umurnya jika mau
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Happy Birthday <?php echo $nama_kakak; ?>! ✨</title>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Quicksand:wght@400;600&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-pink: #ffafcc;
            --dark-pink: #ff8fab;
            --soft-purple: #cdb4db;
            --white: #ffffff;
        }

        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(135deg, #fefae0, #ffafcc);
            font-family: 'Quicksand', sans-serif;
            color: #4a4a4a;
            overflow-x: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            width: 90%;
            max-width: 450px;
            padding: 30px;
            border-radius: 30px;
            box-shadow: 0 15px 35px rgba(255, 143, 171, 0.3);
            text-align: center;
            border: 4px solid var(--white);
            position: relative;
            z-index: 2;
        }

        h1 {
            font-family: 'Pacifico', cursive;
            color: var(--dark-pink);
            font-size: 2.2rem;
            margin-bottom: 10px;
        }

        /* Slideshow Styling */
        .slideshow-container {
            position: relative;
            width: 220px;
            height: 220px;
            margin: 20px auto;
            border-radius: 50%;
            overflow: hidden;
            border: 6px solid var(--soft-purple);
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .mySlides {
            display: none;
            width: 100%;
            height: 100%;
        }

        .mySlides img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .fade {
            animation: fadeAnim 1.5s;
        }

        @keyframes fadeAnim {
            from {opacity: .4} to {opacity: 1}
        }

        .message {
            font-style: italic;
            line-height: 1.6;
            background: #fff5f8;
            padding: 15px;
            border-radius: 15px;
            margin: 20px 0;
        }

        #magicBtn {
            background: var(--dark-pink);
            color: white;
            border: none;
            padding: 15px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: 0.3s;
            box-shadow: 0 5px 15px rgba(255, 143, 171, 0.4);
        }

        #magicBtn:hover {
            transform: scale(1.05);
            background: #fb6f92;
        }

        canvas {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 1;
        }

        .floating-icons {
            position: absolute;
            font-size: 1.5rem;
            opacity: 0.6;
            animation: float 3s infinite ease-in-out;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-10px); }
        }
    </style>
</head>
<body>

    <canvas id="confetti-canvas"></canvas>

    <div class="card">
        <div class="floating-icons" style="top: 10px; left: 20px;">🎂</div>
        <div class="floating-icons" style="top: 10px; right: 20px;">✨</div>
        
        <h1>Happy Birthday, <?php echo $nama_kakak; ?>!</h1>
        
        <div class="slideshow-container">
            <div class="mySlides fade">
                <img src="foto1.jpg" alt="Foto 1">
            </div>
            <div class="mySlides fade">
                <img src="foto2.jpg" alt="Foto 2">
            </div>
            <div class="mySlides fade">
                <img src="foto3.jpg" alt="Foto 3">
            </div>
        </div>

        <div class="message">
            "To my favorite cousin: May your <?php echo $umur; ?>th year be filled with endless laughter, aesthetic vibes, and all the happiness you deserve!"
        </div>

        <button id="magicBtn">Click for Surprise! 🎁</button>
        
        <p style="font-size: 0.8rem; color: #aaa; margin-top: 15px;">Made with ❤️ for you</p>
    </div>

    <audio id="bdayMusic" loop>
        <source src="musik.mp3" type="audio/mpeg">
    </audio>

    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.5.1/dist/confetti.browser.min.js"></script>

    <script>
        // 1. Logic Slideshow
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let slides = document.getElementsByClassName("mySlides");
            for (let i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";  
            }
            slideIndex++;
            if (slideIndex > slides.length) {slideIndex = 1}    
            slides[slideIndex-1].style.display = "block";  
            setTimeout(showSlides, 3000); // Ganti foto setiap 3 detik
        }

        // 2. Button Magic (Music + Confetti)
        const btn = document.getElementById('magicBtn');
        const music = document.getElementById('bdayMusic');
        let playing = false;

        btn.addEventListener('click', () => {
            // Putar Musik
            if (!playing) {
                music.play();
                playing = true;
                btn.innerText = "Enjoy Your Day! 🌸";
            }

            // Ledakan Confetti
            var duration = 5 * 1000;
            var animationEnd = Date.now() + duration;
            var defaults = { startVelocity: 30, spread: 360, ticks: 60, zIndex: 0 };

            function randomInRange(min, max) {
              return Math.random() * (max - min) + min;
            }

            var interval = setInterval(function() {
              var timeLeft = animationEnd - Date.now();

              if (timeLeft <= 0) {
                return clearInterval(interval);
              }

              var particleCount = 50 * (timeLeft / duration);
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.1, 0.3), y: Math.random() - 0.2 } }));
              confetti(Object.assign({}, defaults, { particleCount, origin: { x: randomInRange(0.7, 0.9), y: Math.random() - 0.2 } }));
            }, 250);
        });
    </script>
</body>
</html>