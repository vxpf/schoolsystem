<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Registreren - TCR Keuzedelen</title>
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

        .login-right {
            flex: 1;
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 3rem;
            overflow-y: auto;
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

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1rem;
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
            margin-top: 0.5rem;
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

        .form-hint {
            font-size: 0.8rem;
            color: #888;
            margin-top: 0.25rem;
        }

        @media (max-width: 900px) {
            .login-left {
                display: none;
            }
            .login-right {
                flex: none;
                width: 100%;
            }
            .form-row {
                grid-template-columns: 1fr;
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
                <p>Maak een account aan om je keuzedelen te beheren</p>
            </div>
        </div>

        <div class="login-right">
            <div class="login-form-container">
                <div class="login-form-header">
                    <h2>Account aanmaken</h2>
                    <p>Vul je gegevens in om te registreren</p>
                </div>

                @if ($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 1rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
                @endif

                <form method="POST" action="{{ url('/register') }}">
                    @csrf
                    <div class="form-group">
                        <label class="form-label" for="name">Volledige naam</label>
                        <input type="text" id="name" name="name" class="form-input @error('name') error @enderror" value="{{ old('name') }}" placeholder="Jan de Vries" required autofocus>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="student_number">Leerlingnummer</label>
                        <input type="text" id="student_number" name="student_number" class="form-input @error('student_number') error @enderror" value="{{ old('student_number') }}" placeholder="1234567" required>
                        <p class="form-hint">Je leerlingnummer vind je op je studentenpas</p>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="email">E-mailadres</label>
                        <input type="email" id="email" name="email" class="form-input @error('email') error @enderror" value="{{ old('email') }}" placeholder="naam@leerling.tcr.nl" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password">Wachtwoord</label>
                        <input type="password" id="password" name="password" class="form-input @error('password') error @enderror" placeholder="Minimaal 8 karakters" required>
                    </div>

                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Wachtwoord bevestigen</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-input" placeholder="Herhaal je wachtwoord" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Account aanmaken</button>
                </form>

                <div class="form-footer">
                    Heb je al een account? <a href="/login">Inloggen</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
