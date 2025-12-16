@extends('layouts.app')

@section('title', 'Mijn Keuzedelen')

@section('content')
<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .page-subtitle {
        color: rgba(255, 255, 255, 0.7);
        font-size: 1.1rem;
    }

    .stats-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        text-align: center;
    }

    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        color: #d4a024;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .keuzedelen-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .keuzedeel-item {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
    }

    .keuzedeel-info {
        flex: 1;
    }

    .keuzedeel-code {
        display: inline-block;
        background: rgba(212, 160, 36, 0.2);
        color: #d4a024;
        padding: 0.2rem 0.6rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .keuzedeel-naam {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0 0 0.5rem 0;
    }

    .keuzedeel-meta {
        display: flex;
        gap: 1.5rem;
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }

    .keuzedeel-meta span {
        display: flex;
        align-items: center;
        gap: 0.4rem;
    }

    .keuzedeel-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-aangemeld {
        background: rgba(52, 152, 219, 0.2);
        color: #3498db;
    }

    .status-goedgekeurd {
        background: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
    }

    .status-afgewezen {
        background: rgba(231, 76, 60, 0.2);
        color: #e74c3c;
    }

    .status-voltooid {
        background: rgba(212, 175, 55, 0.2);
        color: #d4af37;
    }

    .btn {
        padding: 0.6rem 1.25rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.9rem;
        text-align: center;
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
    }

    .btn-danger {
        background: rgba(231, 76, 60, 0.2);
        border: 1px solid rgba(231, 76, 60, 0.3);
        color: #e74c3c;
    }

    .btn-primary {
        background: #d4a024;
        color: #ffffff;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        border: 1px dashed rgba(255, 255, 255, 0.2);
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        color: rgba(255, 255, 255, 0.7);
        margin-bottom: 1.5rem;
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .alert-success {
        background: rgba(46, 204, 113, 0.15);
        border: 1px solid rgba(46, 204, 113, 0.3);
        color: #2ecc71;
    }

    .alert-error {
        background: rgba(231, 76, 60, 0.15);
        border: 1px solid rgba(231, 76, 60, 0.3);
        color: #e74c3c;
    }

    @media (max-width: 768px) {
        .keuzedeel-item {
            flex-direction: column;
            align-items: flex-start;
        }

        .keuzedeel-actions {
            width: 100%;
            justify-content: flex-start;
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Mijn Keuzedelen</h1>
    <p class="page-subtitle">Overzicht van je aangemelde en voltooide keuzedelen</p>
</div>

@if(session('success'))
<div class="alert alert-success">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
        <polyline points="22 4 12 14.01 9 11.01"/>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <line x1="15" y1="9" x2="9" y2="15"/>
        <line x1="9" y1="9" x2="15" y2="15"/>
    </svg>
    {{ session('error') }}
</div>
@endif

<div class="stats-bar">
    <div class="stat-card">
        <div class="stat-value">{{ $keuzedelen->count() }}</div>
        <div class="stat-label">Aangemelde keuzedelen</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $keuzedelen->sum('studiepunten') }}</div>
        <div class="stat-label">Totaal studiepunten</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $keuzedelen->where('pivot.status', 'voltooid')->count() }}</div>
        <div class="stat-label">Voltooid</div>
    </div>
</div>

@if($keuzedelen->count() > 0)
<div class="keuzedelen-list">
    @foreach($keuzedelen as $keuzedeel)
    <div class="keuzedeel-item">
        <div class="keuzedeel-info">
            <span class="keuzedeel-code">{{ $keuzedeel->code }}</span>
            <h3 class="keuzedeel-naam">{{ $keuzedeel->naam }}</h3>
            <div class="keuzedeel-meta">
                <span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    {{ $keuzedeel->studiepunten }} studiepunten
                </span>
                <span>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Aangemeld: {{ $keuzedeel->pivot->created_at->format('d-m-Y') }}
                </span>
            </div>
        </div>
        <div class="keuzedeel-actions">
            <span class="status-badge status-{{ $keuzedeel->pivot->status }}">
                @if($keuzedeel->pivot->status == 'aangemeld')
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <polyline points="12 6 12 12 16 14"/>
                    </svg>
                    In behandeling
                @elseif($keuzedeel->pivot->status == 'goedgekeurd')
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Goedgekeurd
                @elseif($keuzedeel->pivot->status == 'afgewezen')
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"/>
                        <line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                    Afgewezen
                @elseif($keuzedeel->pivot->status == 'voltooid')
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                        <polyline points="22 4 12 14.01 9 11.01"/>
                    </svg>
                    Voltooid
                @endif
            </span>
            <a href="{{ url('/keuzedelen/' . $keuzedeel->id) }}" class="btn btn-outline">Details</a>
            @if($keuzedeel->pivot->status == 'aangemeld')
            <form action="{{ url('/keuzedelen/' . $keuzedeel->id . '/afmelden') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Afmelden</button>
            </form>
            @endif
        </div>
    </div>
    @endforeach
</div>
@else
<div class="empty-state">
    <div class="empty-state-icon">📋</div>
    <h3 class="empty-state-title">Nog geen keuzedelen</h3>
    <p class="empty-state-text">Je bent nog niet aangemeld voor keuzedelen. Bekijk het aanbod en meld je aan!</p>
    <a href="{{ url('/keuzedelen') }}" class="btn btn-primary">Bekijk keuzedelen</a>
</div>
@endif
@endsection
