<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Keuzedelen') - TCR Keuzedelen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-dark: #0f172a;
            --primary: #1e293b;
            --primary-light: #334155;
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
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: var(--bg-light);
            color: var(--text-primary);
            line-height: 1.6;
            min-height: 100vh;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
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

        .header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 50%, var(--accent) 100%);
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
            transition: all 0.2s ease;
        }

        .header-nav a:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
        }

        .header-nav a.active {
            color: var(--accent-light);
            background: rgba(212, 160, 36, 0.15);
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
            transition: transform 0.2s ease;
        }

        .header-user-avatar:hover {
            transform: scale(1.05);
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
            transition: all 0.2s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
            color: var(--primary-dark);
            box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(212, 160, 36, 0.4);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
        }

        .btn-outline:hover {
            background: var(--accent);
            color: var(--primary-dark);
        }

        .main-content {
            max-width: 1280px;
            margin: 0 auto;
            padding: 2.5rem 2rem;
        }

        @yield('styles')
    </style>
</head>
<body>
    <header class="header">
        <a href="/" class="header-logo">
            <div class="header-logo-icon">TCR</div>
            <div class="header-logo-text">Techniek College <span>Keuzedelen</span></div>
        </a>

        @auth
        <div class="header-nav">
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.students') }}" class="{{ request()->routeIs('admin.students') ? 'active' : '' }}">Studenten</a>
                <a href="{{ route('admin.enrollments') }}" class="{{ request()->routeIs('admin.enrollments*') ? 'active' : '' }}">Inschrijvingen</a>
                <a href="{{ route('admin.keuzedelen.index') }}" class="{{ request()->routeIs('admin.keuzedelen*') ? 'active' : '' }}">Keuzedelen</a>
            @else
                <a href="{{ route('keuzedelen.index') }}" class="{{ request()->routeIs('keuzedelen.index') || request()->routeIs('keuzedelen.show') ? 'active' : '' }}">Keuzedelen</a>
                <a href="{{ route('keuzedelen.mijn') }}" class="{{ request()->routeIs('keuzedelen.mijn') ? 'active' : '' }}">Mijn Keuzedelen</a>
                <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
                <a href="{{ route('notifications.index') }}" class="{{ request()->routeIs('notifications.*') ? 'active' : '' }}" style="position: relative;">
                    Notificaties
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
</body>
</html>
