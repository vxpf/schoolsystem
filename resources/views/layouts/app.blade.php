<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', 'TCR Keuzedelen - Kies en beheer je keuzedelen voor je opleiding')">
    <meta name="keywords" content="keuzedelen, TCR, opleiding, MBO, studiepunten">
    <meta name="author" content="Techniek College Rotterdam">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:title" content="@yield('title', 'Keuzedelen') - TCR Keuzedelen">
    <meta property="og:description" content="@yield('meta_description', 'TCR Keuzedelen - Kies en beheer je keuzedelen voor je opleiding')">
    
    <!-- Accessibility -->
    <meta name="theme-color" content="#2d4a3e">
    
    <title>@yield('title', 'Keuzedelen') - TCR Keuzedelen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #1a2e26;
            --primary: #2d4a3e;
            --primary-light: #3d5a4d;
            --accent: #d4a024;
            --accent-light: #f4d03f;
            --accent-hover: #b8891f;
            --bg-light: #f8fafc;
            --bg-card: #ffffff;
            --text-dark: #0f172a;
            --text-primary: #1e293b;
            --text-secondary: #64748b;
            --text-muted: #94a3b8;
            --border: #e2e8f0;
            --border-light: #f1f5f9;
            --success: #10b981;
            --success-bg: #d1fae5;
            --warning: #f59e0b;
            --warning-bg: #fef3c7;
            --danger: #ef4444;
            --danger-bg: #fee2e2;
            --info: #3b82f6;
            --info-bg: #dbeafe;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 1px 3px 0 rgb(0 0 0 / 0.1), 0 1px 2px -1px rgb(0 0 0 / 0.1);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --radius: 8px;
            --radius-lg: 12px;
            --radius-xl: 16px;
            --transition-smooth: cubic-bezier(0.4, 0, 0.2, 1);
            --transition-bounce: cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: #ffffff;
            color: #1a1a1a;
            line-height: 1.6;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            overflow-x: hidden;
        }

        html {
            overflow-x: hidden;
        }

        body::-webkit-scrollbar {
            width: 8px;
        }

        body::-webkit-scrollbar-track {
            background: transparent;
        }

        body::-webkit-scrollbar-thumb {
            background: var(--border);
            border-radius: 4px;
        }

        body::-webkit-scrollbar-thumb:hover {
            background: var(--text-muted);
        }

        .header {
            background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
            padding: 0 2rem;
            height: 72px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: var(--shadow-md);
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 14px;
            text-decoration: none;
        }

        .header-logo-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: var(--radius);
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: var(--primary-dark);
            font-size: 15px;
            letter-spacing: -0.5px;
            box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
        }

        .header-logo-text {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
            letter-spacing: -0.3px;
        }

        .header-logo-text span {
            color: var(--accent-light);
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .header-nav a {
            color: rgba(255, 255, 255, 0.85);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: var(--radius);
            position: relative;
            transition: color 0.3s var(--transition-smooth);
            overflow: hidden;
        }

        .header-nav a::before {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 0;
            height: 2px;
            background: var(--accent-light);
            transition: all 0.3s var(--transition-smooth);
            transform: translateX(-50%);
        }

        .header-nav a::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at center, rgba(212, 160, 36, 0.15) 0%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s var(--transition-smooth);
        }

        .header-nav a:hover {
            color: #fff;
        }

        .header-nav a:hover::before {
            width: 80%;
        }

        .header-nav a:hover::after {
            opacity: 1;
        }

        .header-nav a.active {
            color: var(--accent-light);
        }

        .header-nav a.active::before {
            width: 80%;
            background: var(--accent);
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .header-user-name {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.875rem;
            font-weight: 500;
        }

        .header-user-avatar {
            width: 38px;
            height: 38px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: var(--primary-dark);
            font-size: 13px;
            box-shadow: 0 2px 8px rgba(212, 160, 36, 0.25);
            transition: all 0.4s var(--transition-smooth);
            position: relative;
        }

        .header-user-avatar::before {
            content: '';
            position: absolute;
            inset: -3px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--accent), var(--accent-light), var(--accent));
            opacity: 0;
            z-index: -1;
            transition: all 0.4s var(--transition-smooth);
            filter: blur(6px);
        }

        .header-user-avatar:hover {
            transform: scale(1.08);
            box-shadow: 0 4px 20px rgba(212, 160, 36, 0.5);
        }

        .header-user-avatar:hover::before {
            opacity: 0.6;
            inset: -6px;
        }

        .header-user-link {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 10px 20px;
            font-size: 0.875rem;
            font-weight: 600;
            border-radius: var(--radius);
            border: none;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.35s var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s var(--transition-smooth);
        }

        .btn:hover::before {
            left: 100%;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary-dark);
            box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
        }

        .btn-primary:hover {
            box-shadow: 0 8px 25px rgba(212, 160, 36, 0.45);
            transform: translateY(-2px) scale(1.02);
        }

        .btn-primary:active {
            transform: translateY(0) scale(0.98);
            box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.08);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(4px);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: var(--primary-dark);
            box-shadow: 0 4px 20px rgba(212, 160, 36, 0.4);
        }

        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
            background: #ffffff;
        }

        .card {
            background: #ffffff;
            border: 1px solid #e5e7eb;
            border-radius: var(--radius-lg);
            padding: 1.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        }

        .card:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1, h2, h3, h4, h5, h6 {
            color: #1a1a1a;
            font-weight: 700;
        }

        p, span, label {
            color: #333333;
        }

        a {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s var(--transition-smooth);
        }

        a:hover {
            color: var(--primary-light);
        }

        /* Mobile Menu Styles */
        .mobile-menu-toggle {
            display: none;
            background: none;
            border: none;
            color: white;
            cursor: pointer;
            padding: 0.5rem;
            z-index: 101;
        }
        .mobile-menu-toggle svg {
            width: 28px;
            height: 28px;
        }
        .mobile-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0,0,0,0.5);
            z-index: 99;
            opacity: 0;
            transition: opacity 0.3s;
        }
        .mobile-overlay.active {
            display: block;
            opacity: 1;
        }

        /* Mobile Responsive Styles */
        @media (max-width: 768px) {
            .header {
                padding: 0 1rem;
                height: 64px;
            }
            .header-logo-text {
                font-size: 0.95rem;
            }
            .header-logo-icon {
                width: 36px;
                height: 36px;
                font-size: 13px;
            }
            .mobile-menu-toggle {
                display: block;
            }
            .header-nav {
                position: fixed;
                top: 0;
                right: -100%;
                width: 280px;
                height: 100vh;
                background: linear-gradient(135deg, #2d4a3e, #3a5a4a);
                flex-direction: column;
                align-items: flex-start;
                padding: 5rem 1.5rem 2rem;
                gap: 0;
                z-index: 100;
                transition: right 0.3s ease;
                box-shadow: -4px 0 20px rgba(0,0,0,0.3);
                overflow-y: auto;
            }
            .header-nav.active {
                right: 0;
            }
            .header-nav a {
                width: 100%;
                padding: 1rem;
                border-bottom: 1px solid rgba(255,255,255,0.1);
                font-size: 1rem;
            }
            .header-nav a::before {
                display: none;
            }
            .header-user {
                gap: 8px;
            }
            .header-user-name {
                display: none;
            }
            .header-user-avatar {
                width: 36px;
                height: 36px;
                font-size: 12px;
            }
            .btn-secondary {
                padding: 6px 12px !important;
                font-size: 0.75rem !important;
            }
            .main-content {
                padding: 1.5rem 1rem;
            }
            .detail-container {
                grid-template-columns: 1fr !important;
            }
            .keuzedeel-actions {
                flex-direction: column;
                width: 100%;
            }
            .keuzedeel-actions .btn,
            .keuzedeel-actions form {
                width: 100%;
            }
            .keuzedeel-actions .btn {
                width: 100% !important;
            }
        }

        @media (max-width: 480px) {
            .header {
                padding: 0 0.75rem;
            }
            .header-logo-text span {
                display: none;
            }
            .main-content {
                padding: 1rem 0.75rem;
            }
            .stats-bar,
            .dashboard-grid {
                grid-template-columns: 1fr !important;
            }
        }

        @yield('styles')
    </style>
</head>
<body>
    <div class="mobile-overlay" id="mobileOverlay"></div>
    <header class="header">
        <a href="{{ Auth::check() ? route('keuzedelen.index') : route('login') }}" class="header-logo">
            <div class="header-logo-icon">TCR</div>
            <div class="header-logo-text">Techniek College <span>Keuzedelen</span></div>
        </a>

        @auth
        <button class="mobile-menu-toggle" id="mobileMenuToggle" aria-label="Menu">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>
        <div class="header-nav" id="mobileMenu">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.students') }}" class="{{ request()->routeIs('admin.students') ? 'active' : '' }}">Studenten</a>
                <a href="{{ route('admin.enrollments') }}" class="{{ request()->routeIs('admin.enrollments*') ? 'active' : '' }}">Inschrijvingen</a>
                <a href="{{ route('admin.keuzedelen.index') }}" class="{{ request()->routeIs('admin.keuzedelen*') ? 'active' : '' }}">Keuzedelen</a>
            @elseif(Auth::user()->role === 'slb')
                <a href="{{ route('slb.dashboard') }}" class="{{ request()->routeIs('slb.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('slb.cijfers') }}" class="{{ request()->routeIs('slb.cijfers') ? 'active' : '' }}">Cijfers</a>
                <a href="{{ route('slb.presentatie') }}" class="{{ request()->routeIs('slb.presentatie') ? 'active' : '' }}">Presentatie</a>
                <a href="{{ route('keuzedelen.index') }}" class="{{ request()->routeIs('keuzedelen.index') || request()->routeIs('keuzedelen.show') ? 'active' : '' }}">Alle Keuzedelen</a>
            @else
                <a href="{{ route('keuzedelen.index') }}" class="{{ request()->routeIs('keuzedelen.index') || request()->routeIs('keuzedelen.show') ? 'active' : '' }}">Keuzedelen</a>
                <a href="{{ route('keuzedelen.mijn') }}" class="{{ request()->routeIs('keuzedelen.mijn') ? 'active' : '' }}">Mijn Keuzedelen</a>
                <a href="{{ route('keuzedelen.cijfers') }}" class="{{ request()->routeIs('keuzedelen.cijfers') ? 'active' : '' }}">Mijn Cijfers</a>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('inbox.index') }}" class="{{ request()->routeIs('inbox.*') ? 'active' : '' }}" style="position: relative;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="display: inline-block; vertical-align: middle; margin-right: 6px;">
                        <polyline points="22 12 16 12 14 15 10 15 8 12 2 12"></polyline>
                        <path d="M5.45 5.11 2 12v6a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-6l-3.45-6.89A2 2 0 0 0 16.76 4H7.24a2 2 0 0 0-1.79 1.11z"></path>
                    </svg>
                    Inbox
                    @if(Auth::user()->unreadNotifications()->count() > 0)
                        <span style="position: absolute; top: -8px; right: -8px; background: #ef4444; color: white; border-radius: 50%; width: 20px; height: 20px; display: flex; align-items: center; justify-content: center; font-size: 0.7rem; font-weight: 700;">
                            {{ Auth::user()->unreadNotifications()->count() }}
                        </span>
                    @endif
                </a>
            @endif
        </div>
        <div class="header-user">
            <a href="{{ route('profile.show') }}" class="header-user-link">
                <span class="header-user-name">{{ Auth::user()->name }}</span>
                <div class="header-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
            </a>
            <form action="{{ url('/logout') }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn btn-secondary" style="padding: 8px 16px; font-size: 0.85rem;">Uitloggen</button>
            </form>
        </div>
        @else
        <div class="header-nav">
            <a href="/login" class="btn btn-outline">Inloggen</a>
        </div>
        @endauth
    </header>

    <main class="main-content">
        @yield('content')
    </main>

    <!-- Mobile Menu Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuToggle = document.getElementById('mobileMenuToggle');
            const mobileMenu = document.getElementById('mobileMenu');
            const mobileOverlay = document.getElementById('mobileOverlay');
            
            if (menuToggle && mobileMenu) {
                menuToggle.addEventListener('click', function() {
                    mobileMenu.classList.toggle('active');
                    mobileOverlay.classList.toggle('active');
                    document.body.style.overflow = mobileMenu.classList.contains('active') ? 'hidden' : '';
                });
                
                mobileOverlay.addEventListener('click', function() {
                    mobileMenu.classList.remove('active');
                    mobileOverlay.classList.remove('active');
                    document.body.style.overflow = '';
                });
                
                // Close menu when clicking a link
                const menuLinks = mobileMenu.querySelectorAll('a');
                menuLinks.forEach(link => {
                    link.addEventListener('click', function() {
                        mobileMenu.classList.remove('active');
                        mobileOverlay.classList.remove('active');
                        document.body.style.overflow = '';
                    });
                });
            }
        });
    </script>

    <!-- Cookie Consent Script -->
    <script src="{{ asset('js/cookie-consent.js') }}"></script>
</body>
</html>
