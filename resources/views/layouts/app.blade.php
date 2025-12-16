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
            background-color: #f5f5f5;
            color: #1a1a1a;
            line-height: 1.6;
        }

        .header {
            background-color: #1a1a1a;
            padding: 0 2rem;
            height: 70px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .header-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .header-logo-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #c9a227 0%, #f4d03f 50%, #c9a227 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            color: #1a1a1a;
            font-size: 18px;
        }

        .header-logo-text {
            color: #fff;
            font-size: 1.1rem;
            font-weight: 600;
        }

        .header-logo-text span {
            color: #c9a227;
        }

        .header-nav {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .header-nav a {
            color: #ccc;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.2s;
        }

        .header-nav a:hover {
            color: #c9a227;
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
            background: linear-gradient(135deg, #c9a227 0%, #f4d03f 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: #1a1a1a;
            font-size: 14px;
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
            transition: all 0.2s;
        }

        .btn-primary {
            background: linear-gradient(135deg, #c9a227 0%, #d4af37 100%);
            color: #1a1a1a;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d4af37 0%, #e6c349 100%);
            transform: translateY(-1px);
        }

        .btn-secondary {
            background: #2a2a2a;
            color: #fff;
        }

        .btn-secondary:hover {
            background: #3a3a3a;
        }

        .btn-outline {
            background: transparent;
            border: 1px solid #c9a227;
            color: #c9a227;
        }

        .btn-outline:hover {
            background: #c9a227;
            color: #1a1a1a;
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
            <div class="header-logo-icon">TC</div>
            <div class="header-logo-text">Techniek College <span>Keuzedelen</span></div>
        </a>

        @auth
        <div class="header-nav">
            <a href="/dashboard">Dashboard</a>
            <a href="/keuzedelen">Keuzedelen</a>
        </div>
        <div class="header-user">
            <span class="header-user-name">{{ Auth::user()->name }}</span>
            <div class="header-user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 2)) }}</div>
            <form action="/logout" method="POST" style="display: inline;">
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
