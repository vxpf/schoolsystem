@extends('layouts.app')

@section('title', $keuzedeel->naam)

@section('content')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--accent);
        text-decoration: none;
        margin-bottom: 2rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        color: var(--accent-light);
        transform: translateX(-4px);
    }

    .detail-container {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
    }

    .detail-main {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow);
    }

    .detail-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 2rem;
        position: relative;
    }

    .detail-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
    }

    .detail-code {
        display: inline-block;
        background: rgba(212, 160, 36, 0.2);
        color: var(--accent-light);
        padding: 0.3rem 0.85rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        margin-bottom: 1rem;
        letter-spacing: 0.5px;
    }

    .detail-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #ffffff;
        margin: 0;
        line-height: 1.3;
        letter-spacing: -0.5px;
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
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .section-title svg {
        color: var(--accent);
    }

    .detail-text {
        color: var(--text-secondary);
        line-height: 1.8;
        font-size: 0.95rem;
    }

    .detail-sidebar {
        display: flex;
        flex-direction: column;
        gap: 1.5rem;
    }

    .sidebar-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow);
    }

    .sidebar-title {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        padding-bottom: 0.75rem;
        border-bottom: 1px solid var(--border-light);
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
        padding: 0.5rem 0;
    }

    .info-label {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .info-value {
        font-weight: 700;
        color: var(--text-dark);
    }

    .info-value.highlight {
        color: var(--accent);
        font-size: 1.15rem;
    }

    .capacity-section {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid var(--border-light);
    }

    .capacity-bar {
        margin-top: 0.75rem;
    }

    .capacity-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
        color: var(--text-secondary);
    }

    .capacity-track {
        height: 8px;
        background: var(--bg-light);
        border-radius: 4px;
        overflow: hidden;
    }

    .capacity-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--success), #059669);
        border-radius: 4px;
        transition: width 0.3s ease;
    }

    .capacity-fill.warning {
        background: linear-gradient(90deg, var(--warning), #d97706);
    }

    .capacity-fill.full {
        background: linear-gradient(90deg, var(--danger), #dc2626);
    }

    .action-card {
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.05) 0%, var(--bg-card) 100%);
        border: 2px solid rgba(212, 160, 36, 0.2);
    }

    .btn {
        display: block;
        width: 100%;
        padding: 1rem 1.5rem;
        border-radius: var(--radius);
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        text-align: center;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.25), transparent);
        transition: left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
    }

    .btn-primary:hover {
        box-shadow: 0 8px 25px rgba(212, 160, 36, 0.45);
        transform: translateY(-2px) scale(1.02);
    }

    .btn-primary:active {
        transform: translateY(0) scale(0.98);
    }

    .btn-danger {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        color: #ffffff;
        box-shadow: 0 2px 8px rgba(239, 68, 68, 0.3);
    }

    .btn-danger:hover {
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px) scale(1.02);
    }

    .btn-danger:active {
        transform: translateY(0) scale(0.98);
    }

    .btn-disabled {
        background: var(--bg-light);
        color: var(--text-muted);
        cursor: not-allowed;
        border: 1px solid var(--border);
    }

    .btn-disabled::before {
        display: none;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
        padding: 0.75rem 1rem;
        border-radius: var(--radius);
        font-size: 0.9rem;
        font-weight: 600;
        width: 100%;
        margin-bottom: 1rem;
    }

    .status-aangemeld {
        background: var(--warning-bg);
        color: #b45309;
        border: 1px solid rgba(245, 158, 11, 0.3);
    }

    .status-goedgekeurd {
        background: var(--success-bg);
        color: #047857;
        border: 1px solid rgba(16, 185, 129, 0.3);
    }

    .status-afgewezen {
        background: var(--danger-bg);
        color: #b91c1c;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .status-voltooid {
        background: var(--info-bg);
        color: #1d4ed8;
        border: 1px solid rgba(59, 130, 246, 0.3);
    }

    .alert {
        padding: 1.25rem 1.75rem;
        border-radius: var(--radius-lg);
        margin-bottom: 2rem;
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        font-weight: 500;
        font-size: 1.05rem;
        line-height: 1.6;
        box-shadow: var(--shadow-md);
        animation: slideDown 0.3s ease-out;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeOut {
        from {
            opacity: 1;
            transform: translateY(0);
        }
        to {
            opacity: 0;
            transform: translateY(-10px);
        }
    }

    .alert.fade-out {
        animation: fadeOut 0.4s ease-out forwards;
    }

    .alert svg {
        flex-shrink: 0;
        margin-top: 2px;
    }

    .alert-success {
        background: linear-gradient(135deg, #d1fae5 0%, #a7f3d0 100%);
        border: 2px solid #10b981;
        color: #065f46;
    }

    .alert-error {
        background: var(--danger-bg);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: #b91c1c;
    }

    .status-info-text {
        color: var(--text-secondary);
        font-size: 0.9rem;
        margin-top: 1rem;
        line-height: 1.6;
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
                    {{ $keuzedeel->wat_leer_je ?? 'In dit keuzedeel ontwikkel je kennis en vaardigheden die aansluiten bij je opleiding. Je werkt aan praktijkgerichte opdrachten en leert theorie die direct toepasbaar is in je toekomstige beroep.' }}
                    Na succesvolle afronding ontvang je {{ $keuzedeel->studiepunten }} studiepunten.
                </p>
            </div>
        </div>
    </div>

    <div class="detail-sidebar">
        @if(Auth::user()->role === 'student')
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
        @endif

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
                    <span class="info-label">Minimum studenten</span>
                    <span class="info-value">{{ $keuzedeel->min_studenten }}</span>
                </div>
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

<script>
// Auto-dismiss alerts
document.addEventListener('DOMContentLoaded', function() {
    const alerts = document.querySelectorAll('.alert');
    
    alerts.forEach(alert => {
        setTimeout(() => {
            alert.classList.add('fade-out');
            setTimeout(() => {
                alert.remove();
            }, 400);
        }, 5000);
    });
});
</script>
@endsection
