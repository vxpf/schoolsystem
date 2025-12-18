<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Keuzedelen') - TCR Keuzedelen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            background: linear-gradient(135deg, #2d4a3e 0%, #3a5a4a 100%);
            color: #ffffff;
            line-height: 1.6;
            min-height: 100vh;
        }

        .header {
            background-color: #2d4a3e;
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            border-bottom: 2px solid rgba(212, 160, 36, 0.2);
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .header-logo-icon {
            width: 45px;
            height: 45px;
            background: #d4a024;
            border-radius: 6px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            color: #2d4a3e;
            font-size: 16px;
            letter-spacing: -0.5px;
        }

        .header-logo-text {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .header-logo-text span {
            color: #d4a024;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-nav a {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid transparent;
            position: relative;
        }

        .header-nav a:hover {
            border-bottom-color: #d4a024;
        }

        .header-nav a.active {
            border-bottom-color: #d4a024;
            color: #d4a024;
        }

        .header-user {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .header-user-name {
            color: #fff;
            font-size: 0.9rem;
        }

        .header-user-avatar {
            width: 36px;
            height: 36px;
            background: #d4a024;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #2d4a3e;
            font-size: 14px;
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
            padding: 10px 20px;
            font-size: 0.9rem;
            font-weight: 500;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-primary {
            background: #d4a024;
            color: #ffffff;
        }

        .btn-secondary {
            background: #2a2a2a;
            color: #fff;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #d4a024;
            color: #d4a024;
        }

        .main-content {
            max-width: 1200px;
            margin: 0 auto;
            padding: 2rem;
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
            <a href="{{ route('keuzedelen.index') }}" class="{{ request()->routeIs('keuzedelen.index') || request()->routeIs('keuzedelen.show') ? 'active' : '' }}">Keuzedelen</a>
            <a href="{{ route('keuzedelen.mijn') }}" class="{{ request()->routeIs('keuzedelen.mijn') ? 'active' : '' }}">Mijn Keuzedelen</a>
            <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">Dashboard</a>
            @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">Admin</a>
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
