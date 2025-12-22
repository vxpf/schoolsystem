<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuzedelen Presentatie - TCR</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #1a3d2e;
            --primary: #2d5a45;
            --primary-light: #3d7a5c;
            --accent: #d4a024;
            --accent-light: #f4d03f;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            min-height: 100vh;
            color: #ffffff;
            overflow: hidden;
        }

        .presentation-container {
            width: 100vw;
            height: 100vh;
            position: relative;
        }

        .slide {
            display: none;
            width: 100%;
            height: 100%;
            padding: 4rem;
            animation: fadeIn 0.5s ease-out;
        }

        .slide.active {
            display: flex;
            flex-direction: column;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Title Slide */
        .title-slide {
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .title-slide h1 {
            font-size: 4rem;
            font-weight: 800;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #ffffff 0%, var(--accent-light) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .title-slide .subtitle {
            font-size: 1.5rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 3rem;
        }

        .title-slide .logo {
            width: 120px;
            height: 120px;
            background: var(--accent);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 800;
            color: var(--primary-dark);
            margin-bottom: 2rem;
            box-shadow: 0 20px 60px rgba(212, 160, 36, 0.3);
        }

        .title-slide .start-hint {
            position: absolute;
            bottom: 4rem;
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.6);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 0.6; }
            50% { opacity: 1; }
        }

        /* Keuzedeel Slide */
        .keuzedeel-slide {
            justify-content: flex-start;
        }

        .keuzedeel-slide .slide-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 3rem;
        }

        .keuzedeel-slide .keuzedeel-title {
            font-size: 3rem;
            font-weight: 800;
            max-width: 70%;
            line-height: 1.2;
        }

        .keuzedeel-slide .keuzedeel-code {
            background: var(--accent);
            color: var(--primary-dark);
            padding: 0.75rem 1.5rem;
            border-radius: 12px;
            font-weight: 700;
            font-size: 1.25rem;
        }

        .keuzedeel-slide .content-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            flex: 1;
        }

        .keuzedeel-slide .info-section {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            padding: 2rem;
            backdrop-filter: blur(10px);
        }

        .keuzedeel-slide .info-section h3 {
            font-size: 1.25rem;
            color: var(--accent-light);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .keuzedeel-slide .info-item {
            display: flex;
            justify-content: space-between;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .keuzedeel-slide .info-item:last-child {
            border-bottom: none;
        }

        .keuzedeel-slide .info-label {
            color: rgba(255, 255, 255, 0.7);
        }

        .keuzedeel-slide .info-value {
            font-weight: 700;
            color: #ffffff;
        }

        .keuzedeel-slide .beschrijving {
            font-size: 1.1rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.9);
        }

        .keuzedeel-slide .stats-bar {
            display: flex;
            gap: 2rem;
            margin-top: auto;
            padding-top: 2rem;
        }

        .keuzedeel-slide .stat-item {
            background: rgba(255, 255, 255, 0.1);
            padding: 1.5rem 2rem;
            border-radius: 16px;
            text-align: center;
            flex: 1;
        }

        .keuzedeel-slide .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent-light);
        }

        .keuzedeel-slide .stat-label {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
            margin-top: 0.5rem;
        }

        /* Navigation */
        .nav-controls {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 1rem;
            z-index: 100;
        }

        .nav-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 2px solid rgba(255, 255, 255, 0.2);
            color: #ffffff;
            padding: 1rem 2rem;
            border-radius: 12px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-btn:hover {
            background: var(--accent);
            border-color: var(--accent);
            color: var(--primary-dark);
            transform: translateY(-2px);
        }

        .nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
            transform: none;
        }

        .slide-counter {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .exit-btn {
            position: fixed;
            top: 2rem;
            left: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: #ffffff;
            padding: 0.75rem 1.5rem;
            border-radius: 30px;
            font-size: 0.9rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .exit-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }

        /* Progress bar */
        .progress-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 4px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        /* Fullscreen hint */
        .fullscreen-hint {
            position: fixed;
            bottom: 6rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.5);
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.7);
        }
    </style>
</head>
<body>
    <div class="presentation-container">
        <!-- Title Slide -->
        <div class="slide title-slide active" data-slide="0">
            <div class="logo">TCR</div>
            <h1>Keuzedelen Overzicht</h1>
            <p class="subtitle">Techniek College Rotterdam - {{ date('Y') }}</p>
            <p class="start-hint">Druk op → of klik op "Volgende" om te beginnen</p>
        </div>

        <!-- Keuzedeel Slides -->
        @foreach($keuzedelen as $index => $keuzedeel)
        <div class="slide keuzedeel-slide" data-slide="{{ $index + 1 }}">
            <div class="slide-header">
                <h1 class="keuzedeel-title">{{ $keuzedeel->naam }}</h1>
                <span class="keuzedeel-code">{{ $keuzedeel->code }}</span>
            </div>
            
            <div class="content-grid">
                <div class="info-section">
                    <h3>📋 Keuzedeel Informatie</h3>
                    <div class="info-item">
                        <span class="info-label">Studiepunten</span>
                        <span class="info-value">{{ $keuzedeel->studiepunten }} SP</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Niveau</span>
                        <span class="info-value">{{ $keuzedeel->niveau ?? 'Niet gespecificeerd' }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Max. Studenten</span>
                        <span class="info-value">{{ $keuzedeel->max_studenten }}</span>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Huidige Inschrijvingen</span>
                        <span class="info-value">{{ $keuzedeel->users_count }}</span>
                    </div>
                </div>
                
                <div class="info-section">
                    <h3>📝 Beschrijving</h3>
                    <p class="beschrijving">
                        {{ $keuzedeel->beschrijving ?? 'Geen beschrijving beschikbaar voor dit keuzedeel.' }}
                    </p>
                </div>
            </div>

            <div class="stats-bar">
                <div class="stat-item">
                    <div class="stat-number">{{ $keuzedeel->studiepunten }}</div>
                    <div class="stat-label">Studiepunten</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $keuzedeel->users_count }}/{{ $keuzedeel->max_studenten }}</div>
                    <div class="stat-label">Bezetting</div>
                </div>
                <div class="stat-item">
                    <div class="stat-number">{{ $keuzedeel->max_studenten - $keuzedeel->users_count }}</div>
                    <div class="stat-label">Plaatsen Vrij</div>
                </div>
            </div>
        </div>
        @endforeach

        <!-- End Slide -->
        <div class="slide title-slide" data-slide="{{ count($keuzedelen) + 1 }}">
            <div class="logo">✓</div>
            <h1>Vragen?</h1>
            <p class="subtitle">Bedankt voor jullie aandacht!</p>
        </div>
    </div>

    <a href="{{ route('slb.dashboard') }}" class="exit-btn">
        ← Terug naar Dashboard
    </a>

    <div class="slide-counter">
        <span id="currentSlide">1</span> / <span id="totalSlides">{{ count($keuzedelen) + 2 }}</span>
    </div>

    <div class="nav-controls">
        <button class="nav-btn" id="prevBtn" disabled>
            ← Vorige
        </button>
        <button class="nav-btn" id="nextBtn">
            Volgende →
        </button>
    </div>

    <div class="progress-bar" id="progressBar"></div>

    <div class="fullscreen-hint">Druk F11 voor volledig scherm</div>

    <script>
        const slides = document.querySelectorAll('.slide');
        const totalSlides = slides.length;
        let currentSlide = 0;

        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const currentSlideEl = document.getElementById('currentSlide');
        const progressBar = document.getElementById('progressBar');

        function updateSlide() {
            slides.forEach((slide, index) => {
                slide.classList.remove('active');
                if (index === currentSlide) {
                    slide.classList.add('active');
                }
            });

            currentSlideEl.textContent = currentSlide + 1;
            prevBtn.disabled = currentSlide === 0;
            nextBtn.disabled = currentSlide === totalSlides - 1;

            const progress = ((currentSlide + 1) / totalSlides) * 100;
            progressBar.style.width = progress + '%';
        }

        function nextSlide() {
            if (currentSlide < totalSlides - 1) {
                currentSlide++;
                updateSlide();
            }
        }

        function prevSlide() {
            if (currentSlide > 0) {
                currentSlide--;
                updateSlide();
            }
        }

        nextBtn.addEventListener('click', nextSlide);
        prevBtn.addEventListener('click', prevSlide);

        // Keyboard navigation
        document.addEventListener('keydown', (e) => {
            if (e.key === 'ArrowRight' || e.key === ' ' || e.key === 'Enter') {
                nextSlide();
            } else if (e.key === 'ArrowLeft' || e.key === 'Backspace') {
                prevSlide();
            } else if (e.key === 'Escape') {
                window.location.href = '{{ route("slb.dashboard") }}';
            }
        });

        // Click to advance
        document.querySelector('.presentation-container').addEventListener('click', (e) => {
            if (!e.target.closest('.nav-controls') && !e.target.closest('.exit-btn')) {
                nextSlide();
            }
        });

        // Initial update
        updateSlide();
    </script>
</body>
</html>
