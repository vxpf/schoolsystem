<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inloggen - Techniek College Rotterdam</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            min-height: 100vh;
            display: flex;
            background: #ffffff;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(rgba(45, 74, 62, 0.92), rgba(45, 74, 62, 0.92)),
                        url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1920 1080"><defs><pattern id="circuit" x="0" y="0" width="200" height="200" patternUnits="userSpaceOnUse"><rect width="200" height="200" fill="%232d4a3e"/><circle cx="100" cy="100" r="3" fill="%23d4a024" opacity="0.3"/><path d="M100 100 L150 100 M100 100 L100 150 M100 100 L50 100 M100 100 L100 50" stroke="%23d4a024" stroke-width="0.5" opacity="0.2"/><circle cx="50" cy="50" r="2" fill="%23d4a024" opacity="0.2"/><circle cx="150" cy="150" r="2" fill="%23d4a024" opacity="0.2"/><path d="M50 50 L150 150 M150 50 L50 150" stroke="%23d4a024" stroke-width="0.3" opacity="0.1"/></pattern></defs><rect width="100%" height="100%" fill="url(%23circuit)"/></svg>');
            background-size: cover;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 4rem;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(45, 74, 62, 0.95) 0%, rgba(58, 90, 74, 0.95) 100%);
            opacity: 1;
            animation: pulse 20s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.95; }
        }

        .tech-decoration {
            position: absolute;
            width: 100%;
            height: 100%;
            top: 0;
            left: 0;
            overflow: hidden;
            z-index: 0;
        }

        .tech-decoration::before {
            content: '';
            position: absolute;
            width: 200%;
            height: 200%;
            top: -50%;
            left: -50%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(212, 160, 36, 0.03) 10px,
                rgba(212, 160, 36, 0.03) 20px
            );
            animation: slide 20s linear infinite;
        }

        @keyframes slide {
            0% { transform: translate(0, 0); }
            100% { transform: translate(50px, 50px); }
        }

        .login-branding {
            text-align: center;
            z-index: 1;
            max-width: 500px;
        }

        .login-logo {
            width: 120px;
            height: 120px;
            background: #d4a024;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2.5rem;
            font-size: 36px;
            font-weight: 800;
            color: #2d4a3e;
            letter-spacing: -1px;
            box-shadow: 0 8px 24px rgba(212, 160, 36, 0.3);
        }

        .login-branding h1 {
            color: #ffffff;
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1rem;
            line-height: 1.2;
            text-transform: uppercase;
            letter-spacing: -1px;
        }

        .login-branding h1 span {
            color: #d4a024;
            display: block;
            font-size: 2rem;
        }

        .login-branding p {
            color: rgba(255, 255, 255, 0.85);
            font-size: 1.1rem;
            line-height: 1.6;
            font-weight: 500;
        }

        .login-tagline {
            margin-top: 3rem;
            padding: 1.5rem 2rem;
            background: rgba(212, 160, 36, 0.1);
            border-left: 4px solid #d4a024;
            z-index: 1;
        }

        .login-tagline p {
            color: #d4a024;
            font-size: 1.25rem;
            font-weight: 700;
            text-align: left;
        }

        .login-right {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
        }

        .login-form-container {
            width: 100%;
            max-width: 400px;
        }

        .login-form-header {
            margin-bottom: 2rem;
        }

        .login-form-header h2 {
            font-size: 1.75rem;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 0.5rem;
        }

        .login-form-header p {
            color: #666;
            font-size: 0.95rem;
        }

        .form-group {
            margin-bottom: 1.25rem;
        }

        .form-label {
            display: block;
            font-size: 0.875rem;
            font-weight: 500;
            color: #333;
            margin-bottom: 0.5rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            font-size: 1rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            transition: all 0.2s;
            font-family: inherit;
        }

        .form-input:focus {
            outline: none;
            border-color: #c9a227;
            box-shadow: 0 0 0 3px rgba(201, 162, 39, 0.1);
        }

        .form-input.error {
            border-color: #dc3545;
        }

        .form-error {
            color: #dc3545;
            font-size: 0.85rem;
            margin-top: 0.5rem;
        }

        .form-options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .form-checkbox {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.9rem;
            color: #666;
        }

        .form-checkbox input {
            width: 16px;
            height: 16px;
            accent-color: #c9a227;
        }

        .form-link {
            color: #d4af37;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px 24px;
            font-size: 1rem;
            font-weight: 600;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            text-decoration: none;
            font-family: inherit;
        }

        .btn-primary {
            background: #d4a024;
            color: #ffffff;
        }

        .btn-microsoft {
            background: #fff;
            border: 1px solid #ddd;
            color: #333;
            margin-top: 1rem;
            gap: 10px;
        }

        .btn-microsoft img {
            width: 20px;
            height: 20px;
        }

        .divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
            color: #999;
            font-size: 0.85rem;
        }

        .divider::before,
        .divider::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #e5e5e5;
        }

        .divider span {
            padding: 0 1rem;
        }

        .form-footer {
            text-align: center;
            margin-top: 2rem;
            color: #666;
            font-size: 0.9rem;
        }

        .form-footer a {
            color: #d4af37;
            text-decoration: none;
            font-weight: 500;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        .alert-error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626;
        }

        @media (max-width: 900px) {
            .login-left {
                display: none;
            }
            .login-right {
                flex: none;
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="tech-decoration"></div>
            <div class="login-branding">
                <div class="login-logo" style="position: relative; overflow: hidden;">
                    <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(45deg, #d4a024 25%, transparent 25%, transparent 75%, #d4a024 75%, #d4a024), linear-gradient(45deg, #d4a024 25%, transparent 25%, transparent 75%, #d4a024 75%, #d4a024); background-size: 20px 20px; background-position: 0 0, 10px 10px; opacity: 0.1; animation: slide 10s linear infinite;"></div>
                    TCR
                </div>
                <h1>Techniek College <span>Rotterdam</span></h1>
                <p>Kies je keuzedelen en bouw aan je toekomst in de techniek</p>
            </div>
            <div class="login-tagline" style="position: relative;">
                <div style="position: absolute; top: -20px; right: -20px; width: 60px; height: 60px; opacity: 0.1;">
                    <svg viewBox="0 0 24 24" fill="#d4a024">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                        <path fill="#2d4a3e" d="M12 4.5L4 8.5v7.5c0 4.1 2.9 7.9 6.8 8.9l1.2.3 1.2-.3c3.9-1 6.8-4.8 6.8-8.9V8.5l-8-4zm-2 11.5l-3-3 1.4-1.4L10 13.2l3.6-3.6L15 11l-5 5z"/>
                    </svg>
                </div>
                <p style="display: flex; align-items: center; gap: 10px;">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="opacity: 0.7;">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                    </svg>
                    Je toekomst is goud waard
                </p>
            </div>
            <div class="login-features" style="display: none;">
                <div class="login-feature">
                    <div class="login-feature-icon">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M8 0a8 8 0 1 0 0 16A8 8 0 0 0 8 0zm3.5 7.5a.5.5 0 0 1 0 1H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5z"/>
                        </svg>
                    </div>
                    <span>Bekijk beschikbare keuzedelen</span>
                </div>
                <div class="login-feature">
                    <div class="login-feature-icon">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                            <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.235.235 0 0 1 .02-.022z"/>
                        </svg>
                    </div>
                    <span>Meld je aan voor keuzedelen</span>
                </div>
                <div class="login-feature">
                    <div class="login-feature-icon">
                        <svg width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.708 2.825L15 11.105V5.383zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741zM1 11.105l4.708-2.897L1 5.383v5.722z"/>
                        </svg>
                    </div>
                    <span>Ontvang updates over je aanmeldingen</span>
                </div>
            </div>
        </div>

        <div class="login-right">
            <div class="login-form-container">
                <div class="login-form-header">
                    <h2>Welkom terug</h2>
                    <p>Log in met je schoolaccount om verder te gaan</p>
                </div>

                @if ($errors->any())
                <div class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        {{ $error }}
                    @endforeach
                </div>
                @endif

                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="email">E-mailadres</label>
                        <input type="email" id="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" placeholder="naam@leerling.tcr.nl" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Wachtwoord</label>
                        <input type="password" id="password" name="password" class="form-input @error('password') error @enderror" placeholder="••••••••" required>
                    </div>

                    <div class="form-options">
                        <label class="form-checkbox">
                            <input type="checkbox" name="remember">
                            <span>Onthoud mij</span>
                        </label>
                        <a href="#" class="form-link">Wachtwoord vergeten?</a>
                    </div>

                    <button type="submit" class="btn btn-primary">Inloggen</button>
                </form>

                <div class="divider">
                    <span>of</span>
                </div>

                <button type="button" class="btn btn-microsoft" disabled title="Microsoft login wordt later toegevoegd">
                    <svg width="20" height="20" viewBox="0 0 21 21">
                        <rect x="1" y="1" width="9" height="9" fill="#f25022"/>
                        <rect x="11" y="1" width="9" height="9" fill="#7fba00"/>
                        <rect x="1" y="11" width="9" height="9" fill="#00a4ef"/>
                        <rect x="11" y="11" width="9" height="9" fill="#ffb900"/>
                    </svg>
                    Inloggen met Microsoft (binnenkort)
                </button>

                <div class="form-footer">
                    Nog geen account? <a href="/register">Registreren</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
