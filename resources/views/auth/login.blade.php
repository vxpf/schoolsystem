<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Inloggen - TCR Keuzedelen</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            min-height: 100vh;
            display: flex;
            background: #1a1a1a;
        }

        .login-container {
            display: flex;
            width: 100%;
            min-height: 100vh;
        }

        .login-left {
            flex: 1;
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 3rem;
            position: relative;
            overflow: hidden;
        }

        .login-left::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle at 30% 70%, rgba(201, 162, 39, 0.08) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-branding {
            text-align: center;
            z-index: 1;
        }

        .login-logo {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #c9a227 0%, #f4d03f 50%, #c9a227 100%);
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
        }

        .login-branding h1 {
            color: #fff;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .login-branding h1 span {
            color: #c9a227;
        }

        .login-branding p {
            color: #888;
            font-size: 1rem;
            max-width: 300px;
        }

        .login-features {
            margin-top: 3rem;
            z-index: 1;
        }

        .login-feature {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #aaa;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }

        .login-feature-icon {
            width: 32px;
            height: 32px;
            background: rgba(201, 162, 39, 0.15);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #c9a227;
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
            color: #c9a227;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
        }

        .form-link:hover {
            text-decoration: underline;
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
            transition: all 0.2s;
            font-family: inherit;
        }

        .btn-primary {
            background: linear-gradient(135deg, #c9a227 0%, #d4af37 100%);
            color: #1a1a1a;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #d4af37 0%, #e6c349 100%);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(201, 162, 39, 0.3);
        }

        .btn-microsoft {
            background: #fff;
            border: 1px solid #ddd;
            color: #333;
            margin-top: 1rem;
            gap: 10px;
        }

        .btn-microsoft:hover {
            background: #f8f8f8;
            border-color: #ccc;
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
            color: #c9a227;
            text-decoration: none;
            font-weight: 500;
        }

        .form-footer a:hover {
            text-decoration: underline;
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
            <div class="login-branding">
                <div class="login-logo">TC</div>
                <h1>Techniek College <span>Rotterdam</span></h1>
                <p>Kies je keuzedelen en bouw aan je toekomst in de techniek</p>
            </div>
            <div class="login-features">
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
