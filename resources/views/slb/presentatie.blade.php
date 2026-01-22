<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keuzedelen Presentatie - TCR</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-dark: #1e3a2f;
            --primary: #2d4a3e;
            --text-light: #ffffff;
            --text-muted: rgba(255, 255, 255, 0.7);
            --accent: #d4a024;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: var(--primary-dark);
            min-height: 100vh;
            color: var(--text-light);
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
            padding: 3rem 4rem;
            animation: fadeIn 0.3s ease-out;
        }

        .slide.active {
            display: flex;
            flex-direction: column;
        }

        @keyframes fadeIn {
            from { opacity: 0; }
            to { opacity: 1; }
        }

        /* Title Slide */
        .title-slide {
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .title-slide .logo {
            width: 80px;
            height: 80px;
            background: var(--accent);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--primary-dark);
            margin-bottom: 2rem;
        }

        .title-slide h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--text-light);
        }

        .title-slide .subtitle {
            font-size: 1.25rem;
            color: var(--text-muted);
            margin-bottom: 3rem;
        }

        .title-slide .start-hint {
            position: absolute;
            bottom: 4rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        /* Keuzedeel Slide */
        .keuzedeel-slide {
            justify-content: flex-start;
        }

        .keuzedeel-slide .slide-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 2.5rem;
            padding-bottom: 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .keuzedeel-slide .keuzedeel-title {
            font-size: 2.25rem;
            font-weight: 700;
            max-width: 70%;
            line-height: 1.3;
        }

        .keuzedeel-slide .keuzedeel-code {
            background: var(--accent);
            color: var(--primary-dark);
            padding: 0.5rem 1rem;
            border-radius: 6px;
            font-weight: 600;
            font-size: 1rem;
        }

        .keuzedeel-slide .content-grid {
            display: grid;
            grid-template-columns: 1fr 1.5fr;
            gap: 2.5rem;
            flex: 1;
        }

        .keuzedeel-slide .info-section {
            background: rgba(255, 255, 255, 0.05);
            border-radius: 8px;
            padding: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .keuzedeel-slide .info-section h3 {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 1.25rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }

        .keuzedeel-slide .info-item {
            display: flex;
            justify-content: space-between;
            padding: 0.75rem 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .keuzedeel-slide .info-item:last-child {
            border-bottom: none;
        }

        .keuzedeel-slide .info-label {
            color: var(--text-muted);
            font-size: 0.9375rem;
        }

        .keuzedeel-slide .info-value {
            font-weight: 600;
            color: var(--text-light);
            font-size: 0.9375rem;
        }

        .keuzedeel-slide .beschrijving {
            font-size: 1.0625rem;
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.85);
        }

        .keuzedeel-slide .stats-bar {
            display: flex;
            gap: 1rem;
            margin-top: auto;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .keuzedeel-slide .stat-item {
            background: rgba(255, 255, 255, 0.05);
            padding: 1.25rem 1.5rem;
            border-radius: 8px;
            text-align: center;
            flex: 1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }

        .keuzedeel-slide .stat-number {
            font-size: 2rem;
            font-weight: 700;
            color: var(--text-light);
        }

        .keuzedeel-slide .stat-label {
            font-size: 0.8125rem;
            color: var(--text-muted);
            margin-top: 0.25rem;
        }

        /* Navigation */
        .nav-controls {
            position: fixed;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 0.5rem;
            z-index: 100;
        }

        .nav-btn {
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: var(--text-light);
            padding: 0.75rem 1.5rem;
            border-radius: 6px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .nav-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .nav-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .slide-counter {
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: rgba(255, 255, 255, 0.1);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .exit-btn {
            position: fixed;
            top: 2rem;
            left: 2rem;
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--text-light);
            padding: 0.5rem 1rem;
            border-radius: 4px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.15s ease;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .exit-btn:hover {
            background: rgba(255, 255, 255, 0.15);
            color: var(--text-light);
        }

        /* Progress bar */
        .progress-bar {
            position: fixed;
            bottom: 0;
            left: 0;
            height: 3px;
            background: var(--accent);
            transition: width 0.3s ease;
        }

        /* Fullscreen hint */
        .fullscreen-hint {
            position: fixed;
            bottom: 5.5rem;
            left: 50%;
            transform: translateX(-50%);
            background: rgba(0, 0, 0, 0.4);
            padding: 0.375rem 0.75rem;
            border-radius: 4px;
            font-size: 0.75rem;
            color: var(--text-muted);
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
            <p class="start-hint">Druk op de pijltoets of klik op Volgende om te beginnen</p>
        </div>

        <!-- End Slide -->
        <div class="slide title-slide" data-slide="1">
            <div class="logo">TCR</div>
            <h1>Vragen?</h1>
            <p class="subtitle">Bedankt voor jullie aandacht</p>
        </div>
    </div>

    <a href="{{ route('slb.dashboard') }}" class="exit-btn">
        ← Terug naar Dashboard
    </a>

    <div class="slide-counter">
        <span id="currentSlide">1</span> / <span id="totalSlides">2</span>
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
