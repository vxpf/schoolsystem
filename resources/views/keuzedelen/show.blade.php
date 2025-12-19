@extends('layouts.app')

@section('title', $keuzedeel->naam)

@section('content')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        margin-bottom: 2rem;
    }

    .detail-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .detail-main {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
    }

    .detail-header {
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.2) 0%, rgba(212, 160, 36, 0.05) 100%);
        padding: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .detail-code {
        display: inline-block;
        background: rgba(212, 160, 36, 0.2);
        color: #d4a024;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .detail-title {
        font-size: 2rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        line-height: 1.3;
    }

    .detail-body {
        padding: 2rem;
    }

    .detail-section {
        margin-bottom: 2rem;
    }

    .detail-section:last-child {
        margin-bottom: 0;
    }

    .section-title {
        font-size: 1.1rem;
        font-weight: 600;
        color: #d4a024;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .detail-text {
        color: rgba(255, 255, 255, 0.8);
        line-height: 1.8;
        font-size: 1rem;
    }

    .detail-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        padding: 1.5rem;
    }

    .sidebar-title {
        font-size: 1rem;
        font-weight: 600;
        color: #ffffff;
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .info-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .info-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .info-label {
        color: rgba(255, 255, 255, 0.6);
        font-size: 0.9rem;
    }

    .info-value {
        font-weight: 600;
        color: #ffffff;
    }

    .info-value.highlight {
        color: #d4a024;
        font-size: 1.1rem;
    }

    .capacity-section {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
    }

    .capacity-bar {
        margin-top: 0.75rem;
    }

    .capacity-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .capacity-track {
        height: 8px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 4px;
        overflow: hidden;
    }

    .capacity-fill {
        height: 100%;
        background: linear-gradient(90deg, #2ecc71, #27ae60);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .capacity-fill.warning {
        background: linear-gradient(90deg, #f39c12, #e67e22);
    }

    .capacity-fill.full {
        background: linear-gradient(90deg, #e74c3c, #c0392b);
    }

    .action-card {
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.05) 100%);
        border: 1px solid rgba(212, 160, 36, 0.3);
    }

    .btn {
        display: block;
        width: 100%;
        padding: 1rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        text-decoration: none;
                border: none;
        cursor: pointer;
        font-size: 1rem;
        text-align: center;
    }

    .btn-primary {
        background: #d4a024;
        color: #ffffff;
    }

    .btn-danger {
        background: #e74c3c;
        color: #ffffff;
    }

    .btn-disabled {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.5);
        cursor: not-allowed;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        font-size: 0.95rem;
        font-weight: 500;
        width: 100%;
        margin-bottom: 1rem;
    }

    .status-aangemeld {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .status-goedgekeurd {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
        border: 1px solid rgba(34, 197, 94, 0.3);
    }

    .status-afgewezen {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-voltooid {
        background: rgba(168, 85, 247, 0.2);
        color: #c084fc;
        border: 1px solid rgba(168, 85, 247, 0.3);
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

    @media (max-width: 968px) {
        .detail-container {
            grid-template-columns: 1fr;
        }
    }
</style>

<a href="{{ url('/keuzedelen') }}" class="back-link">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <line x1="19" y1="12" x2="5" y2="12"/>
        <polyline points="12 19 5 12 12 5"/>
    </svg>
    Terug naar overzicht
</a>

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

<div class="detail-container">
    <div class="detail-main">
        <div class="detail-header">
            <span class="detail-code">{{ $keuzedeel->code }}</span>
            <h1 class="detail-title">{{ $keuzedeel->naam }}</h1>
        </div>
        <div class="detail-body">
            <div class="detail-section">
                <h2 class="section-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                        <polyline points="14 2 14 8 20 8"/>
                        <line x1="16" y1="13" x2="8" y2="13"/>
                        <line x1="16" y1="17" x2="8" y2="17"/>
                        <polyline points="10 9 9 9 8 9"/>
                    </svg>
                    Beschrijving
                </h2>
                <p class="detail-text">
                    {{ $keuzedeel->beschrijving ?? 'Geen beschrijving beschikbaar voor dit keuzedeel.' }}
                </p>
            </div>

            <div class="detail-section">
                <h2 class="section-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10"/>
                        <line x1="12" y1="16" x2="12" y2="12"/>
                        <line x1="12" y1="8" x2="12.01" y2="8"/>
                    </svg>
                    Wat leer je?
                </h2>
                <p class="detail-text">
                    In dit keuzedeel ontwikkel je kennis en vaardigheden die aansluiten bij je opleiding. 
                    Je werkt aan praktijkgerichte opdrachten en leert theorie die direct toepasbaar is in je toekomstige beroep.
                    Na succesvolle afronding ontvang je {{ $keuzedeel->studiepunten }} studiepunten.
                </p>
            </div>
        </div>
    </div>

    <div class="detail-sidebar">
        <div class="sidebar-card action-card">
            <h3 class="sidebar-title">Aanmelden</h3>
            
            @if($isVoltooid)
            <div class="status-badge status-voltooid">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                Keuzedeel voltooid
            </div>
            <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-top: 1rem;">
                Je hebt dit keuzedeel succesvol afgerond. Je kunt je niet opnieuw inschrijven voor een voltooid keuzedeel.
            </p>
            @elseif($isAangemeld)
            <div class="status-badge status-{{ $enrollmentStatus }}">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Status: {{ ucfirst($enrollmentStatus) }}
            </div>
            @if($enrollmentStatus === 'aangemeld' || $enrollmentStatus === 'goedgekeurd')
            <form action="{{ url('/keuzedelen/' . $keuzedeel->id . '/afmelden') }}" method="POST" style="margin-top: 1rem;">
                @csrf
                <button type="submit" class="btn btn-danger">Afmelden voor dit keuzedeel</button>
            </form>
            @endif
            @if($enrollmentStatus === 'afgewezen')
            <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.9rem; margin-top: 1rem;">
                Je aanmelding is afgewezen. Neem contact op met je docent voor meer informatie.
            </p>
            @endif
            @elseif($aantalAanmeldingen >= $keuzedeel->max_studenten)
            <button class="btn btn-disabled" disabled>Dit keuzedeel is vol</button>
            @else
            <form action="{{ url('/keuzedelen/' . $keuzedeel->id . '/aanmelden') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary">Aanmelden voor dit keuzedeel</button>
            </form>
            @endif
        </div>

        <div class="sidebar-card">
            <h3 class="sidebar-title">Informatie</h3>
            <div class="info-list">
                <div class="info-item">
                    <span class="info-label">Studiepunten</span>
                    <span class="info-value highlight">{{ $keuzedeel->studiepunten }} SP</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Niveau</span>
                    <span class="info-value">{{ $keuzedeel->niveau ?? 'N.v.t.' }}</span>
                </div>
                <div class="info-item">
                    <span class="info-label">Code</span>
                    <span class="info-value">{{ $keuzedeel->code }}</span>
                </div>
            </div>

            @php
                $percentage = $keuzedeel->max_studenten > 0 ? ($aantalAanmeldingen / $keuzedeel->max_studenten) * 100 : 0;
                $capacityClass = $percentage >= 100 ? 'full' : ($percentage >= 75 ? 'warning' : '');
                $plaatsenOver = $keuzedeel->max_studenten - $aantalAanmeldingen;
            @endphp

            <div class="capacity-section">
                <div class="info-item">
                    <span class="info-label">Plaatsen over</span>
                    <span class="info-value">{{ max(0, $plaatsenOver) }}</span>
                </div>
                <div class="capacity-bar">
                    <div class="capacity-label">
                        <span>Bezetting</span>
                        <span>{{ $aantalAanmeldingen }} / {{ $keuzedeel->max_studenten }}</span>
                    </div>
                    <div class="capacity-track">
                        <div class="capacity-fill {{ $capacityClass }}" style="width: {{ min($percentage, 100) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
