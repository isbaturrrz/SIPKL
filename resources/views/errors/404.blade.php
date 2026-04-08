<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>404 - Halaman Tidak Ditemukan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            width: 100%;
            height: 100%;
            overflow: hidden;
            position: fixed;
            top: 0;
            left: 0;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #182151 0%, #3F7FB6 50%, #010B40 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        /* Animated background particles */
        .particle {
            position: absolute;
            width: 3px;
            height: 3px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 8s infinite;
            pointer-events: none;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(100px);
                opacity: 0;
            }
        }

        .container {
            text-align: center;
            color: white;
            z-index: 10;
            padding: 20px;
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            position: relative;
        }

        .error-code {
            font-size: clamp(80px, 15vw, 150px);
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 0 0 20px rgba(63, 127, 182, 0.5);
            animation: pulse 2s ease-in-out infinite;
            position: relative;
            line-height: 1;
        }

        @keyframes pulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .detective {
            width: min(200px, 35vw);
            height: min(200px, 35vw);
            max-width: 200px;
            max-height: 200px;
            margin: 0 auto 20px;
            position: relative;
            animation: float-detective 3s ease-in-out infinite;
        }

        @keyframes float-detective {
            0%, 100% {
                transform: translateY(0px) rotate(-3deg);
            }
            50% {
                transform: translateY(-10px) rotate(3deg);
            }
        }

        .detective-svg {
            width: 100%;
            height: 100%;
            filter: drop-shadow(0 10px 30px rgba(0, 0, 0, 0.3));
        }

        h1 {
            font-size: clamp(18px, 5vw, 28px);
            margin-bottom: 12px;
            font-weight: 600;
            padding: 0 10px;
            line-height: 1.3;
        }

        p {
            font-size: clamp(13px, 3.5vw, 16px);
            margin-bottom: 25px;
            opacity: 0.9;
            line-height: 1.5;
            padding: 0 15px;
        }

        .btn-home {
            display: inline-block;
            padding: 12px 28px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-size: 14px;
            font-weight: 600;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-home:before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transition: left 0.3s ease;
        }

        .btn-home:hover:before {
            left: 100%;
        }

        .btn-home:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(63, 127, 182, 0.4);
            border-color: rgba(255, 255, 255, 0.6);
        }

        .btn-home:active {
            transform: translateY(-1px);
        }

        /* Stars */
        .stars {
            position: fixed;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            pointer-events: none;
            z-index: 1;
        }

        .star {
            position: absolute;
            width: 2px;
            height: 2px;
            background: white;
            border-radius: 50%;
            animation: twinkle 3s infinite;
        }

        @keyframes twinkle {
            0%, 100% {
                opacity: 0.2;
            }
            50% {
                opacity: 0.8;
            }
        }

        /* Extra small devices */
        @media (max-width: 480px) {
            .container {
                padding: 15px;
            }

            .error-code {
                margin-bottom: 10px;
            }

            .detective {
                margin-bottom: 15px;
            }

            h1 {
                margin-bottom: 8px;
            }

            p {
                margin-bottom: 20px;
            }

            .btn-home {
                padding: 10px 22px;
                font-size: 13px;
            }
        }

        /* Very small devices */
        @media (max-width: 360px) {
            .container {
                padding: 10px;
            }

            .error-code {
                font-size: 65px;
            }

            h1 {
                font-size: 17px;
            }

            p {
                font-size: 12px;
                padding: 0 10px;
            }

            .detective {
                width: min(120px, 35vw);
                height: min(120px, 35vw);
            }

            .btn-home {
                padding: 8px 18px;
                font-size: 12px;
            }
        }

        /* Small height devices (landscape on mobile) */
        @media (max-height: 600px) and (orientation: landscape) {
            .container {
                padding: 10px;
            }
            
            .detective {
                width: 90px;
                height: 90px;
                margin-bottom: 8px;
            }
            
            .error-code {
                font-size: 55px;
                margin-bottom: 5px;
            }
            
            h1 {
                font-size: 16px;
                margin-bottom: 5px;
            }
            
            p {
                font-size: 11px;
                margin-bottom: 10px;
            }
            
            .btn-home {
                padding: 6px 16px;
                font-size: 11px;
            }
        }

        /* Tablet devices */
        @media (min-width: 768px) and (max-width: 1024px) {
            .container {
                max-width: 500px;
            }
            
            .detective {
                width: 180px;
                height: 180px;
            }
        }

        /* Large screens */
        @media (min-width: 1440px) {
            .container {
                max-width: 700px;
            }
            
            .detective {
                width: 200px;
                height: 200px;
            }
            
            h1 {
                font-size: 32px;
            }
            
            p {
                font-size: 18px;
            }
            
            .btn-home {
                padding: 15px 40px;
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
    <!-- Stars background -->
    <div class="stars" id="stars"></div>

    <!-- Floating particles -->
    <div id="particles"></div>

    <div class="container">
        <div class="detective">
            <svg class="detective-svg" viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
                <!-- Mystery Man Character - Missing Page -->
                
                <!-- Badan/Coat (Biru tua) -->
                <path d="M 60 110 L 60 200 L 140 200 L 140 110 Q 140 105 135 105 L 65 105 Q 60 105 60 110 Z" 
                      fill="#5b6e99" stroke="#4a5a7d" stroke-width="1"/>
                
                <!-- Kemeja bagian dalam (Biru muda) -->
                <path d="M 85 105 L 85 200 L 115 200 L 115 105 Z" 
                      fill="#8ba3c7" stroke="#7089b0" stroke-width="0.5"/>
                
                <!-- Kerah coat kiri -->
                <path d="M 60 105 L 60 135 L 75 125 L 85 105 Z" 
                      fill="#6b7fa8" stroke="#4a5a7d" stroke-width="1"/>
                
                <!-- Kerah coat kanan -->
                <path d="M 140 105 L 140 135 L 125 125 L 115 105 Z" 
                      fill="#6b7fa8" stroke="#4a5a7d" stroke-width="1"/>
                
                <!-- Garis tengah kemeja -->
                <rect x="98" y="105" width="4" height="95" fill="#7089b0" opacity="0.5"/>
                
                <!-- Kancing kemeja -->
                <circle cx="100" cy="120" r="2" fill="#5b6e99"/>
                <circle cx="100" cy="135" r="2" fill="#5b6e99"/>
                <circle cx="100" cy="150" r="2" fill="#5b6e99"/>
                
                <!-- Leher -->
                <rect x="85" y="85" width="30" height="22" fill="#f4c4a0" rx="2"/>
                
                <!-- Kepala -->
                <ellipse cx="100" cy="75" rx="30" ry="35" fill="#f4c4a0"/>
                
                <!-- Telinga kiri -->
                <ellipse cx="72" cy="75" rx="5" ry="8" fill="#f4c4a0"/>
                
                <!-- Telinga kanan -->
                <ellipse cx="128" cy="75" rx="5" ry="8" fill="#f4c4a0"/>
                
                <!-- Kacamata - frame kiri -->
                <rect x="75" y="70" width="18" height="12" rx="6" 
                      fill="#2c3e50" stroke="#1a252f" stroke-width="1"/>
                
                <!-- Kacamata - frame kanan -->
                <rect x="107" y="70" width="18" height="12" rx="6" 
                      fill="#2c3e50" stroke="#1a252f" stroke-width="1"/>
                
                <!-- Kacamata - bridge/jembatan -->
                <rect x="93" y="74" width="14" height="3" rx="1.5" 
                      fill="#2c3e50" stroke="#1a252f" stroke-width="0.5"/>
                
                <!-- Kacamata - gagang kiri -->
                <line x1="75" y1="76" x2="72" y2="76" 
                      stroke="#2c3e50" stroke-width="2" stroke-linecap="round"/>
                
                <!-- Kacamata - gagang kanan -->
                <line x1="125" y1="76" x2="128" y2="76" 
                      stroke="#2c3e50" stroke-width="2" stroke-linecap="round"/>
                
                <!-- Highlight kacamata kiri -->
                <ellipse cx="80" cy="73" rx="2" ry="1.5" fill="#4a5a7d" opacity="0.3"/>
                
                <!-- Highlight kacamata kanan -->
                <ellipse cx="112" cy="73" rx="2" ry="1.5" fill="#4a5a7d" opacity="0.3"/>
                
                <!-- Topi - bagian atas (crown) -->
                <rect x="70" y="35" width="60" height="20" rx="3" 
                      fill="#6b7fa8" stroke="#5b6e99" stroke-width="1"/>
                
                <!-- Topi - pita/band -->
                <rect x="70" y="50" width="60" height="6" 
                      fill="#4a5a7d" stroke="#3a4a6d" stroke-width="0.5"/>
                
                <!-- Topi - bagian brim (pinggiran) -->
                <ellipse cx="100" cy="56" rx="45" ry="8" 
                         fill="#6b7fa8" stroke="#5b6e99" stroke-width="1"/>
                
                <!-- Shadow topi di brim -->
                <ellipse cx="100" cy="56" rx="43" ry="6" 
                         fill="#5b6e99" opacity="0.3"/>
                
                <!-- Detil lengkungan topi atas -->
                <path d="M 70 35 Q 100 30 130 35" 
                      fill="none" stroke="#7a8eb8" stroke-width="1" opacity="0.5"/>
                
                <!-- Highlight topi -->
                <ellipse cx="85" cy="42" rx="8" ry="4" 
                         fill="#8ba3c7" opacity="0.4"/>
                
                <!-- Kaca pembesar di tangan kiri -->
                <line x1="46" y1="122" x2="30" y2="100" stroke="#8B6914" stroke-width="3"/>
                <circle cx="25" cy="94" r="12" fill="none" stroke="#D4A017" stroke-width="4"/>
                <circle cx="25" cy="94" r="10" fill="rgba(255,255,255,0.12)"/>
                <path d="M 19 89 Q 22 86 25 87" stroke="rgba(255,255,255,0.4)" stroke-width="1.5" fill="none" stroke-linecap="round"/>
                
                
                <!-- Plang "MISSING" (mirip dengan 403 tapi warna berbeda) -->
                <rect x="140" y="95" width="52" height="32" rx="4" fill="#8b1414ff" stroke="#6b0a0aff" stroke-width="2" transform="rotate(10 166 111)"/>
                <text x="166" y="115" font-size="9" fill="white" text-anchor="middle" font-weight="bold" font-family="monospace" transform="rotate(10 166 111)">MISSING</text>
                
            </svg>
        </div>

        <div class="error-code">404</div>
        
        <h1>🔍 Kami Kehilangan Jejak Halaman Ini</h1>
        
        <p>
            Kami kehilangan jejak halaman ini. Mungkin URL-nya sedang bersembunyi, atau sudah dipindahkan ke tempat rahasia.<br><br>
            Tim detektif kami sudah mencari tapi belum ketemu juga! 🕵️‍♂️
        </p>

    </div>

    <script>
        // Create stars
        const starsContainer = document.getElementById('stars');
        const starCount = window.innerWidth < 768 ? 50 : 100;
        for (let i = 0; i < starCount; i++) {
            const star = document.createElement('div');
            star.className = 'star';
            star.style.left = Math.random() * 100 + '%';
            star.style.top = Math.random() * 100 + '%';
            star.style.animationDelay = Math.random() * 3 + 's';
            starsContainer.appendChild(star);
        }

        // Create floating particles
        const particlesContainer = document.getElementById('particles');
        const particleCount = window.innerWidth < 768 ? 15 : 30;
        for (let i = 0; i < particleCount; i++) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            particle.style.left = Math.random() * 100 + '%';
            particle.style.animationDelay = Math.random() * 8 + 's';
            particle.style.animationDuration = (Math.random() * 5 + 5) + 's';
            particlesContainer.appendChild(particle);
        }
    </script>
</body>
</html>