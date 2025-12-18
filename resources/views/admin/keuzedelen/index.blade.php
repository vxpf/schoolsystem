@extends('layouts.app')

@section('title', 'Keuzedelen Beheren')

@section('styles')
<style>
    .admin-header {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 160, 36, 0.2);
        display: flex;
        justify-content: space-between;
        align-items: center;
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

    .keuzedelen-grid {
        display: grid;
        gap: 1.5rem;
    }

    .keuzedeel-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(212, 160, 36, 0.2);
        transition: all 0.3s ease;
    }

    .keuzedeel-card:hover {
        border-color: #d4a024;
        background: rgba(255, 255, 255, 0.08);
    }

    .keuzedeel-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .keuzedeel-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.3rem;
    }

    .keuzedeel-code {
        color: #d4a024;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .keuzedeel-actions {
        display: flex;
        gap: 0.5rem;
    }

    .keuzedeel-info {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 600;
        color: #fff;
    }

    .keuzedeel-description {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
        line-height: 1.5;
        margin-bottom: 1rem;
    }

    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-active {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
    }

    .status-inactive {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }

    .btn-small {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background: #d4a024;
        color: #fff;
    }

    .btn-edit:hover {
        background: #b88a1e;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.3);
    }

    .btn-create {
        background: #d4a024;
        color: #fff;
        padding: 0.75rem 1.5rem;
        font-size: 0.95rem;
    }

    .btn-create:hover {
        background: #b88a1e;
    }
</style>
@endsection

@section('content')
<a href="{{ route('admin.dashboard') }}" class="back-link">← Terug naar Dashboard</a>

<div class="admin-header">
    <div>
        <h1>📚 Keuzedelen Beheren</h1>
        <p style="color: rgba(255, 255, 255, 0.8); margin-top: 0.5rem;">Beheer alle keuzedelen in het systeem</p>
    </div>
    <a href="{{ route('admin.keuzedelen.create') }}" class="btn-small btn-create">+ Nieuw Keuzedeel</a>
</div>

@if(session('success'))
    <div style="background: rgba(34, 197, 94, 0.2); color: #4ade80; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(34, 197, 94, 0.3);">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div style="background: rgba(239, 68, 68, 0.2); color: #f87171; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border: 1px solid rgba(239, 68, 68, 0.3);">
        {{ session('error') }}
    </div>
@endif

<div class="keuzedelen-grid">
    @forelse($keuzedelen as $keuzedeel)
        <div class="keuzedeel-card">
            <div class="keuzedeel-header">
                <div>
                    <div class="keuzedeel-title">{{ $keuzedeel->naam }}</div>
                    <div class="keuzedeel-code">{{ $keuzedeel->code }}</div>
                </div>
                <div class="keuzedeel-actions">
                    <a href="{{ route('admin.keuzedelen.edit', $keuzedeel) }}" class="btn-small btn-edit">Bewerken</a>
                    <form action="{{ route('admin.keuzedelen.destroy', $keuzedeel) }}" method="POST" style="display: inline;" onsubmit="return confirm('Weet je zeker dat je dit keuzedeel wilt verwijderen?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-small btn-delete">Verwijderen</button>
                    </form>
                </div>
            </div>

            <div class="keuzedeel-description">
                {{ $keuzedeel->beschrijving }}
            </div>

            <div class="keuzedeel-info">
                <div class="info-item">
                    <span class="info-label">Niveau</span>
                    <span class="info-value">{{ $keuzedeel->niveau }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Studiepunten</span>
                    <span class="info-value">{{ $keuzedeel->studiepunten }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Max. Studenten</span>
                    <span class="info-value">{{ $keuzedeel->max_studenten }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Inschrijvingen</span>
                    <span class="info-value">{{ $keuzedeel->users_count }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Status</span>
                    <span class="status-badge {{ $keuzedeel->actief ? 'status-active' : 'status-inactive' }}">
                        {{ $keuzedeel->actief ? 'Actief' : 'Inactief' }}
                    </span>
                </div>
            </div>
        </div>
    @empty
        <div style="background: rgba(255, 255, 255, 0.05); padding: 3rem; border-radius: 12px; text-align: center; color: rgba(255, 255, 255, 0.6);">
            Nog geen keuzedelen aangemaakt. Klik op "Nieuw Keuzedeel" om te beginnen.
        </div>
    @endforelse
</div>
@endsection
