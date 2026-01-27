@extends('layouts.app')

@section('title', 'Nieuw Keuzedeel')

@section('styles')
<style>
    .admin-header {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .admin-header h1 {
        font-size: 2rem;
        color: #d4a024;
    }

    .back-link,
    .back-link:visited,
    .back-link:link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        color: #ffffff !important;
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.7rem 1.4rem;
        background: linear-gradient(135deg, #2d4a3e 0%, #3d5a4d 100%);
        border: none;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(45, 74, 62, 0.3);
        letter-spacing: 0.3px;
    }

    .back-link:hover {
        color: #ffffff !important;
        background: linear-gradient(135deg, #3d5a4d 0%, #4a6b5c 100%);
        transform: translateX(-4px);
        box-shadow: 0 4px 12px rgba(45, 74, 62, 0.4);
    }

    .back-link svg {
        transition: transform 0.3s ease;
        opacity: 0.9;
    }

    .back-link:hover svg {
        transform: translateX(-3px);
        opacity: 1;
    }

    .form-container {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        display: block;
        color: #d4a024;
        font-weight: 500;
        margin-bottom: 0.5rem;
        font-size: 0.95rem;
    }

    .form-input,
    .form-textarea,
    .form-select {
        width: 100%;
        padding: 0.75rem;
        border-radius: 8px;
        border: 1px solid rgba(212, 160, 36, 0.3);
        background: rgba(0, 0, 0, 0.3);
        color: #fff;
        font-size: 0.95rem;
        font-family: inherit;
    }

    .form-input:focus,
    .form-textarea:focus,
    .form-select:focus {
        outline: none;
        border-color: #d4a024;
        background: rgba(0, 0, 0, 0.4);
    }

    .form-textarea {
        min-height: 120px;
        resize: vertical;
    }

    .form-checkbox-group {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .form-checkbox {
        width: 20px;
        height: 20px;
        cursor: pointer;
    }

    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
    }

    .form-actions {
        display: flex;
        gap: 1rem;
        margin-top: 2rem;
    }

    .btn-submit {
        background: #d4a024;
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        border: none;
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s;
    }

    .btn-submit:hover {
        background: #b88a1e;
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.1);
        color: #fff;
        padding: 0.75rem 2rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 0.95rem;
        font-weight: 500;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
        transition: all 0.2s;
    }

    .btn-cancel:hover {
        background: rgba(255, 255, 255, 0.15);
    }

    .error-message {
        color: #f87171;
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }

    .form-help {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.85rem;
        margin-top: 0.25rem;
    }
</style>
@endsection

@section('content')
<a href="{{ route('admin.keuzedelen.index') }}" class="back-link">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"/>
        <polyline points="12 19 5 12 12 5"/>
    </svg>
    Terug naar Keuzedelen
</a>

<div class="admin-header">
    <h1>➕ Nieuw Keuzedeel Aanmaken</h1>
    <p style="color: rgba(255, 255, 255, 0.8); margin-top: 0.5rem;">Vul de onderstaande gegevens in om een nieuw keuzedeel toe te voegen</p>
</div>

<div class="form-container">
    <form action="{{ route('admin.keuzedelen.store') }}" method="POST">
        @csrf

        <div class="form-group">
            <label for="naam" class="form-label">Naam *</label>
            <input type="text" id="naam" name="naam" class="form-input" value="{{ old('naam') }}" required>
            @error('naam')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="code" class="form-label">Code *</label>
            <input type="text" id="code" name="code" class="form-input" value="{{ old('code') }}" required>
            <div class="form-help">Unieke code voor het keuzedeel (bijv. K0877)</div>
            @error('code')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="beschrijving" class="form-label">Beschrijving</label>
            <textarea id="beschrijving" name="beschrijving" class="form-textarea">{{ old('beschrijving') }}</textarea>
            @error('beschrijving')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="wat_leer_je" class="form-label">Wat leer je?</label>
            <textarea id="wat_leer_je" name="wat_leer_je" class="form-textarea">{{ old('wat_leer_je') }}</textarea>
            <div class="form-help">Beschrijf wat studenten leren in dit keuzedeel</div>
            @error('wat_leer_je')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="studiepunten" class="form-label">Studiepunten *</label>
                <input type="number" id="studiepunten" name="studiepunten" class="form-input" value="{{ old('studiepunten', 240) }}" min="0" required>
                @error('studiepunten')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="niveau" class="form-label">Niveau</label>
                <input type="text" id="niveau" name="niveau" class="form-input" value="{{ old('niveau') }}" placeholder="bijv. MBO 4">
                @error('niveau')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="opleiding" class="form-label">Opleiding</label>
                <input type="text" id="opleiding" name="opleiding" class="form-input" value="{{ old('opleiding') }}" placeholder="bijv. Elektrotechniek">
                <div class="form-help">Laat leeg voor alle opleidingen, of vul de specifieke opleiding in</div>
                @error('opleiding')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="max_studenten" class="form-label">Max. Studenten *</label>
                <input type="number" id="max_studenten" name="max_studenten" class="form-input" value="{{ old('max_studenten', 30) }}" min="1" required>
                @error('max_studenten')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="min_studenten" class="form-label">Min. Studenten *</label>
                <input type="number" id="min_studenten" name="min_studenten" class="form-input" value="{{ old('min_studenten', 15) }}" min="1" required>
                @error('min_studenten')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-checkbox-group">
                <input type="checkbox" id="actief" name="actief" class="form-checkbox" {{ old('actief', true) ? 'checked' : '' }}>
                <label for="actief" class="form-label" style="margin-bottom: 0;">Keuzedeel is actief</label>
            </div>
            <div class="form-help">Alleen actieve keuzedelen zijn zichtbaar voor studenten</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Keuzedeel Aanmaken</button>
            <a href="{{ route('admin.keuzedelen.index') }}" class="btn-cancel">Annuleren</a>
        </div>
    </form>
</div>
@endsection
