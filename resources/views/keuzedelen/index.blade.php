@extends('layouts.app')

@section('title', 'Keuzedelen')

@section('content')
<style>
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .page-subtitle {
        color: var(--text-secondary);
        font-size: 1.05rem;
    }

    .search-box {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .search-input {
        flex: 1;
        padding: 1rem 1.5rem;
        border-radius: var(--radius-lg);
        border: 2px solid var(--border);
        background: var(--bg-card);
        color: var(--text-primary);
        font-size: 1rem;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(212, 160, 36, 0.1);
    }

    .search-input::placeholder {
        color: var(--text-muted);
    }

    .stats-bar {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.25rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        text-align: center;
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

    .stat-card:hover .stat-value {
        transform: scale(1.05);
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--accent);
        margin-bottom: 0.25rem;
        letter-spacing: -1px;
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .keuzedelen-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(380px, 1fr));
        gap: 1.5rem;
    }

    .keuzedeel-card {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-xl);
        overflow: hidden;
        box-shadow: var(--shadow);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
    }

    .keuzedeel-card::after {
        content: '';
        position: absolute;
        inset: 0;
        border-radius: var(--radius-xl);
        opacity: 0;
        transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        pointer-events: none;
        box-shadow: inset 0 0 0 2px var(--accent), 0 20px 40px -10px rgba(212, 160, 36, 0.25);
    }

    .keuzedeel-card:hover {
        transform: scale(1.02) translateY(-4px);
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.15);
    }

    .keuzedeel-card:hover::after {
        opacity: 1;
    }

    .keuzedeel-card:hover .keuzedeel-header::after {
        transform: scaleX(1.1);
    }

    .keuzedeel-card.aangemeld {
        border-color: var(--success);
        border-width: 2px;
    }

    .keuzedeel-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 1.5rem;
        position: relative;
    }

    .keuzedeel-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
        transition: transform 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .keuzedeel-code {
        display: inline-block;
        background: rgba(212, 160, 36, 0.2);
        color: var(--accent-light);
        padding: 0.3rem 0.85rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 0.75rem;
        letter-spacing: 0.5px;
    }

    .keuzedeel-naam {
        font-size: 1.15rem;
        font-weight: 700;
        color: #ffffff;
        margin: 0;
        line-height: 1.4;
    }

    .keuzedeel-body {
        padding: 1.5rem;
    }

    .keuzedeel-beschrijving {
        color: var(--text-secondary);
        font-size: 0.9rem;
        line-height: 1.7;
        margin-bottom: 1.5rem;
        min-height: 3.5rem;
    }

    .keuzedeel-meta {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .meta-item {
        display: flex;
        flex-direction: column;
        gap: 0.35rem;
        padding: 0.75rem;
        background: var(--bg-light);
        border-radius: var(--radius);
    }

    .meta-label {
        font-size: 0.7rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.75px;
        font-weight: 600;
    }

    .meta-value {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .meta-value.punten {
        color: var(--accent);
    }

    .capacity-bar {
        margin-bottom: 1.5rem;
    }

    .capacity-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.8rem;
        margin-bottom: 0.5rem;
    }

    .capacity-label span:first-child {
        color: var(--text-secondary);
    }

    .capacity-label span:last-child {
        color: var(--text-dark);
        font-weight: 600;
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

    .keuzedeel-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.75rem 1.25rem;
        border-radius: var(--radius);
        font-weight: 600;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
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

    .btn-outline {
        background: transparent;
        border: 2px solid var(--border);
        color: var(--text-primary);
    }

    .btn-outline:hover {
        border-color: var(--accent);
        color: var(--accent);
        background: rgba(212, 160, 36, 0.08);
        box-shadow: 0 4px 15px rgba(212, 160, 36, 0.15);
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
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-aangemeld {
        background: var(--success-bg);
        color: #047857;
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

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        border: 2px dashed var(--border);
    }

    .empty-state-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }

    .empty-state-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .empty-state-text {
        color: var(--text-secondary);
    }

    @media (max-width: 768px) {
        .keuzedelen-grid {
            grid-template-columns: 1fr;
        }

        .stats-bar {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>

<div class="page-header">
    <h1 class="page-title">Keuzedelen</h1>
    <p class="page-subtitle">Kies de keuzedelen die bij jouw opleiding en interesses passen</p>
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
        <div class="stat-label">Beschikbare keuzedelen</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ count($mijnKeuzedelen) }}</div>
        <div class="stat-label">Mijn aanmeldingen</div>
    </div>
    <div class="stat-card">
        <div class="stat-value">{{ $keuzedelen->sum('studiepunten') }}</div>
        <div class="stat-label">Totaal studiepunten</div>
    </div>
</div>

<div class="search-box">
    <input type="text" class="search-input" id="searchInput" placeholder="Zoek keuzedelen op naam of code...">
</div>

@if($keuzedelen->count() > 0)
<div class="keuzedelen-grid" id="keuzedeelGrid">
    @foreach($keuzedelen as $keuzedeel)
    @php
        $isAangemeld = in_array($keuzedeel->id, $mijnKeuzedelen);
        $status = $isAangemeld && isset($keuzedeelStatussen[$keuzedeel->id]) ? $keuzedeelStatussen[$keuzedeel->id] : null;
        $isVoltooid = $status === 'voltooid';
        $percentage = $keuzedeel->max_studenten > 0 ? ($keuzedeel->aanmeldingen_count / $keuzedeel->max_studenten) * 100 : 0;
        $capacityClass = $percentage >= 100 ? 'full' : ($percentage >= 75 ? 'warning' : '');
    @endphp
    <div class="keuzedeel-card {{ $isAangemeld ? 'aangemeld' : '' }}" data-naam="{{ strtolower($keuzedeel->naam) }}" data-code="{{ strtolower($keuzedeel->code) }}">
        <div class="keuzedeel-header">
            <span class="keuzedeel-code">{{ $keuzedeel->code }}</span>
            @if($isVoltooid)
            <span class="status-badge status-voltooid" style="float: right;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                Voltooid
            </span>
            @elseif($isAangemeld)
            <span class="status-badge status-aangemeld" style="float: right;">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="20 6 9 17 4 12"/>
                </svg>
                Aangemeld
            </span>
            @endif
            <h3 class="keuzedeel-naam">{{ $keuzedeel->naam }}</h3>
        </div>
        <div class="keuzedeel-body">
            <p class="keuzedeel-beschrijving">
                {{ Str::limit($keuzedeel->beschrijving, 150) ?? 'Geen beschrijving beschikbaar.' }}
            </p>

            <div class="keuzedeel-meta">
                <div class="meta-item">
                    <span class="meta-label">Studiepunten</span>
                    <span class="meta-value punten">{{ $keuzedeel->studiepunten }} SP</span>
                </div>
                <div class="meta-item">
                    <span class="meta-label">Niveau</span>
                    <span class="meta-value">{{ $keuzedeel->niveau ?? 'N.v.t.' }}</span>
                </div>
                @if($keuzedeel->periode)
                <div class="meta-item">
                    <span class="meta-label">Periode</span>
                    <span class="meta-value" style="color: var(--accent); font-weight: 700;">{{ $keuzedeel->periode }}</span>
                </div>
                @endif
            </div>

            <div class="capacity-bar">
                <div class="capacity-label">
                    <span>Beschikbaarheid</span>
                    <span>{{ $keuzedeel->aanmeldingen_count }} / {{ $keuzedeel->max_studenten }} plaatsen</span>
                </div>
                <div class="capacity-track">
                    <div class="capacity-fill {{ $capacityClass }}" style="width: {{ min($percentage, 100) }}%"></div>
                </div>
            </div>

            <div class="keuzedeel-actions">
                @if($isVoltooid)
                <button class="btn btn-disabled" disabled style="flex: 1;">Voltooid</button>
                @elseif($isAangemeld)
                <form action="{{ url('/keuzedelen/' . $keuzedeel->id . '/afmelden') }}" method="POST" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn btn-danger" style="width: 100%;">Afmelden</button>
                </form>
                @elseif($percentage >= 100)
                <button class="btn btn-disabled" disabled style="flex: 1;">Vol</button>
                @else
                <form action="{{ url('/keuzedelen/' . $keuzedeel->id . '/aanmelden') }}" method="POST" style="flex: 1;">
                    @csrf
                    <button type="submit" class="btn btn-primary" style="width: 100%;">Aanmelden</button>
                </form>
                @endif
                <a href="{{ url('/keuzedelen/' . $keuzedeel->id) }}" class="btn btn-outline">Details</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@else
<div class="empty-state">
    <div class="empty-state-icon">📚</div>
    <h3 class="empty-state-title">Geen keuzedelen beschikbaar</h3>
    <p class="empty-state-text">Er zijn momenteel geen keuzedelen beschikbaar. Kom later terug.</p>
</div>
@endif

<script>
document.getElementById('searchInput').addEventListener('input', function() {
    const query = this.value.toLowerCase();
    const cards = document.querySelectorAll('.keuzedeel-card');
    
    cards.forEach(card => {
        const naam = card.dataset.naam;
        const code = card.dataset.code;
        
        if (naam.includes(query) || code.includes(query)) {
            card.style.display = 'block';
        } else {
            card.style.display = 'none';
        }
    });
});

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
