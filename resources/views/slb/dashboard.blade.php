@extends('layouts.app')

@section('title', 'SLB Dashboard')

@section('styles')
<style>
    .slb-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        position: relative;
        overflow: hidden;
    }

    .slb-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212, 160, 36, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .slb-header h1 {
        font-size: 2rem;
        color: #ffffff;
        margin-bottom: 0.5rem;
        font-weight: 800;
    }

    .slb-header h1 span {
        color: var(--accent-light);
    }

    .slb-header p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--bg-card);
        padding: 1.5rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent-light));
        transform: scaleX(0);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: left;
    }

    .stat-card:hover {
        border-color: var(--accent);
        box-shadow: 0 8px 30px rgba(212, 160, 36, 0.15);
    }

    .stat-card:hover::before {
        transform: scaleX(1);
    }

    .stat-card h3 {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-card .stat-value {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        transition: color 0.4s ease;
    }

    .stat-card:hover .stat-value {
        color: var(--accent);
    }

    .action-section {
        margin-bottom: 2rem;
    }

    .action-section h2 {
        font-size: 1.25rem;
        color: var(--text-dark);
        margin-bottom: 1rem;
        font-weight: 700;
    }

    .presentatie-btn {
        display: inline-flex;
        align-items: center;
        gap: 1rem;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        padding: 1.25rem 2.5rem;
        border-radius: var(--radius-lg);
        text-decoration: none;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 4px 15px rgba(212, 160, 36, 0.3);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .presentatie-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .presentatie-btn:hover::before {
        left: 100%;
    }

    .presentatie-btn:hover {
        transform: translateY(-3px) scale(1.02);
        box-shadow: 0 8px 30px rgba(212, 160, 36, 0.4);
    }

    .presentatie-btn svg {
        width: 28px;
        height: 28px;
    }

    .keuzedelen-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .keuzedeel-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        padding: 1.5rem;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .keuzedeel-card::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent), var(--accent-light));
        transform: scaleX(0);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        transform-origin: left;
    }

    .keuzedeel-card:hover {
        border-color: var(--accent);
        box-shadow: 0 8px 30px rgba(212, 160, 36, 0.15);
        transform: translateY(-2px);
    }

    .keuzedeel-card:hover::after {
        transform: scaleX(1);
    }

    .keuzedeel-card h3 {
        font-size: 1.1rem;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .keuzedeel-card .code {
        font-size: 0.85rem;
        color: var(--accent);
        font-weight: 600;
        margin-bottom: 1rem;
    }

    .keuzedeel-card .stats {
        display: flex;
        justify-content: space-between;
        padding-top: 1rem;
        border-top: 1px solid var(--border);
    }

    .keuzedeel-card .stat {
        text-align: center;
    }

    .keuzedeel-card .stat-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
    }

    .keuzedeel-card .stat-num {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    @media (max-width: 768px) {
        .stats-grid {
            grid-template-columns: 1fr;
        }

        .keuzedelen-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="slb-header">
    <h1>👋 Welkom, <span>SLB'er</span></h1>
    <p>Bekijk en presenteer keuzedeelinformatie aan je studenten</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Actieve Keuzedelen</h3>
        <div class="stat-value">{{ $totalKeuzedelen }}</div>
    </div>
    <div class="stat-card">
        <h3>Totaal Studenten</h3>
        <div class="stat-value">{{ $totalStudents }}</div>
    </div>
    <div class="stat-card">
        <h3>Totaal Inschrijvingen</h3>
        <div class="stat-value">{{ $totalEnrollments }}</div>
    </div>
</div>

<div class="action-section">
    <h2>🎯 Snelle Acties</h2>
    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 1rem;">
        <a href="{{ route('slb.presentatie') }}" class="presentatie-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="3" width="20" height="14" rx="2" ry="2"/>
                <line x1="8" y1="21" x2="16" y2="21"/>
                <line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
            Start Presentatie Modus
        </a>
        <a href="{{ route('slb.cijfers') }}" class="presentatie-btn" style="background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%); color: var(--primary-dark);">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
                <path d="M9 12l2 2 4-4"/>
            </svg>
            Studenten Cijfers
        </a>
    </div>
</div>

<div class="action-section">
    <h2>📚 Alle Keuzedelen</h2>
    <div class="keuzedelen-grid">
        @foreach($keuzedelen as $keuzedeel)
        <div class="keuzedeel-card">
            <h3>{{ $keuzedeel->naam }}</h3>
            <div class="code">{{ $keuzedeel->code }}</div>
            <div class="stats">
                <div class="stat">
                    <div class="stat-num">{{ $keuzedeel->studiepunten }}</div>
                    <div class="stat-label">Studiepunten</div>
                </div>
                <div class="stat">
                    <div class="stat-num">{{ $keuzedeel->users_count }}/{{ $keuzedeel->max_studenten }}</div>
                    <div class="stat-label">Inschrijvingen</div>
                </div>
                <div class="stat">
                    <div class="stat-num">{{ $keuzedeel->niveau ?? '-' }}</div>
                    <div class="stat-label">Niveau</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

@endsection
