@extends('layouts.app')

@section('title', 'Keuzedelen Beheren')

@section('styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--accent);
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        color: var(--accent-light);
        transform: translateX(-4px);
    }

    .admin-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .admin-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
    }

    .admin-header h1 {
        font-size: 1.75rem;
        color: #ffffff;
        font-weight: 800;
    }

    .admin-header p {
        color: var(--text-muted);
        margin-top: 0.5rem;
        font-size: 0.95rem;
    }

    .keuzedelen-grid {
        display: grid;
        gap: 1.5rem;
    }

    .keuzedeel-card {
        background: var(--bg-card);
        padding: 1.5rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        transition: all 0.2s ease;
        box-shadow: var(--shadow);
    }

    .keuzedeel-card:hover {
        border-color: var(--accent);
        box-shadow: var(--shadow-md);
    }

    .keuzedeel-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .keuzedeel-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.3rem;
    }

    .keuzedeel-code {
        color: var(--accent);
        font-size: 0.85rem;
        font-weight: 600;
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
        padding: 0.75rem;
        background: var(--bg-light);
        border-radius: var(--radius);
    }

    .info-label {
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-bottom: 0.25rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .info-value {
        font-weight: 700;
        color: var(--text-dark);
    }

    .keuzedeel-description {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.6;
        margin-bottom: 1rem;
    }

    .status-badge {
        display: inline-block;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-active {
        background: var(--success-bg);
        color: #047857;
    }

    .status-inactive {
        background: var(--danger-bg);
        color: #b91c1c;
    }

    .btn-small {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        font-weight: 600;
        transition: all 0.2s ease;
        text-decoration: none;
        display: inline-block;
    }

    .btn-edit {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
    }

    .btn-edit:hover {
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
    }

    .btn-delete {
        background: var(--danger-bg);
        color: var(--danger);
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: var(--danger);
        color: #ffffff;
    }

    .btn-create {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        padding: 0.75rem 1.5rem;
        font-size: 0.9rem;
        box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
    }

    .btn-create:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(212, 160, 36, 0.4);
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .alert-success {
        background: var(--success-bg);
        border: 1px solid rgba(16, 185, 129, 0.3);
        color: #047857;
    }

    .alert-error {
        background: var(--danger-bg);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #b91c1c;
    }

    .empty-state {
        background: var(--bg-card);
        padding: 3rem;
        border-radius: var(--radius-xl);
        text-align: center;
        color: var(--text-muted);
        border: 2px dashed var(--border);
    }
</style>
@endsection

@section('content')
<a href="{{ route('admin.dashboard') }}" class="back-link">← Terug naar Dashboard</a>

<div class="admin-header">
    <div>
        <h1>Keuzedelen Beheren</h1>
        <p>Beheer alle keuzedelen in het systeem</p>
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
