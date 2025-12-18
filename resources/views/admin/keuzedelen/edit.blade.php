@extends('layouts.app')

@section('title', 'Keuzedeel Bewerken')

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

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #d4a024;
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
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
<a href="{{ route('admin.keuzedelen.index') }}" class="back-link">← Terug naar Keuzedelen</a>

<div class="admin-header">
    <h1>✏️ Keuzedeel Bewerken</h1>
    <p style="color: rgba(255, 255, 255, 0.8); margin-top: 0.5rem;">{{ $keuzedeel->naam }}</p>
</div>

<div class="form-container">
    <form action="{{ route('admin.keuzedelen.update', $keuzedeel) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="naam" class="form-label">Naam *</label>
            <input type="text" id="naam" name="naam" class="form-input" value="{{ old('naam', $keuzedeel->naam) }}" required>
            @error('naam')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="code" class="form-label">Code *</label>
            <input type="text" id="code" name="code" class="form-input" value="{{ old('code', $keuzedeel->code) }}" required>
            <div class="form-help">Unieke code voor het keuzedeel (bijv. K0877)</div>
            @error('code')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="beschrijving" class="form-label">Beschrijving</label>
            <textarea id="beschrijving" name="beschrijving" class="form-textarea">{{ old('beschrijving', $keuzedeel->beschrijving) }}</textarea>
            @error('beschrijving')
                <div class="error-message">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-grid">
            <div class="form-group">
                <label for="studiepunten" class="form-label">Studiepunten *</label>
                <input type="number" id="studiepunten" name="studiepunten" class="form-input" value="{{ old('studiepunten', $keuzedeel->studiepunten) }}" min="0" required>
                @error('studiepunten')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="niveau" class="form-label">Niveau</label>
                <input type="text" id="niveau" name="niveau" class="form-input" value="{{ old('niveau', $keuzedeel->niveau) }}" placeholder="bijv. MBO 4">
                @error('niveau')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="max_studenten" class="form-label">Max. Studenten *</label>
                <input type="number" id="max_studenten" name="max_studenten" class="form-input" value="{{ old('max_studenten', $keuzedeel->max_studenten) }}" min="1" required>
                @error('max_studenten')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="form-group">
            <div class="form-checkbox-group">
                <input type="checkbox" id="actief" name="actief" class="form-checkbox" {{ old('actief', $keuzedeel->actief) ? 'checked' : '' }}>
                <label for="actief" class="form-label" style="margin-bottom: 0;">Keuzedeel is actief</label>
            </div>
            <div class="form-help">Alleen actieve keuzedelen zijn zichtbaar voor studenten</div>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-submit">Wijzigingen Opslaan</button>
            <a href="{{ route('admin.keuzedelen.index') }}" class="btn-cancel">Annuleren</a>
        </div>
    </form>
</div>
@endsection
