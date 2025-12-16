@extends('layouts.app')

@section('title', 'Keuzedelen')

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

    .filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 0.5rem 1.25rem;
        border-radius: 50px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.05);
        color: rgba(255, 255, 255, 0.8);
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .filter-btn:hover,
    .filter-btn.active {
        background: rgba(212, 175, 55, 0.2);
        border-color: #d4af37;
        color: #d4af37;
    }

    .search-box {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .search-input {
        flex: 1;
        padding: 0.875rem 1.25rem;
        border-radius: 8px;
        border: 1px solid rgba(255, 255, 255, 0.2);
        background: rgba(255, 255, 255, 0.05);
        color: #ffffff;
        font-size: 1rem;
        transition: all 0.3s ease;
    }

    .search-input:focus {
        outline: none;
        border-color: #d4af37;
        background: rgba(255, 255, 255, 0.08);
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
    }

    .keuzedelen-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }

    .keuzedeel-card {
        background: rgba(255, 255, 255, 0.05);
        border: 1px solid rgba(255, 255, 255, 0.1);
        border-radius: 12px;
        overflow: hidden;
        transition: all 0.3s ease;
    }

    .keuzedeel-card:hover {
        transform: translateY(-5px);
        border-color: rgba(212, 175, 55, 0.5);
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
    }

    .keuzedeel-card.aangemeld {
        border-color: rgba(46, 204, 113, 0.5);
    }

    .keuzedeel-header {
        background: linear-gradient(135deg, rgba(212, 175, 55, 0.2) 0%, rgba(212, 175, 55, 0.05) 100%);
        padding: 1.5rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    .keuzedeel-code {
        display: inline-block;
        background: rgba(212, 175, 55, 0.2);
        color: #d4af37;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 0.75rem;
    }

    .keuzedeel-naam {
        font-size: 1.25rem;
        font-weight: 600;
        color: #ffffff;
        margin: 0;
        line-height: 1.3;
    }

    .keuzedeel-body {
        padding: 1.5rem;
    }

    .keuzedeel-beschrijving {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 1.5rem;
        min-height: 4rem;
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
        gap: 0.25rem;
    }

    .meta-label {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.5);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .meta-value {
        font-size: 1rem;
        font-weight: 600;
        color: #ffffff;
    }

    .meta-value.punten {
        color: #d4af37;
    }

    .capacity-bar {
        margin-bottom: 1.5rem;
    }

    .capacity-label {
        display: flex;
        justify-content: space-between;
        font-size: 0.85rem;
        margin-bottom: 0.5rem;
    }

    .capacity-label span:first-child {
        color: rgba(255, 255, 255, 0.7);
    }

    .capacity-label span:last-child {
        color: #ffffff;
        font-weight: 500;
    }

    .capacity-track {
        height: 6px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
        overflow: hidden;
    }

    .capacity-fill {
        height: 100%;
        background: linear-gradient(90deg, #2ecc71, #27ae60);
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .capacity-fill.warning {
        background: linear-gradient(90deg, #f39c12, #e67e22);
    }

    .capacity-fill.full {
        background: linear-gradient(90deg, #e74c3c, #c0392b);
    }

    .keuzedeel-actions {
        display: flex;
        gap: 0.75rem;
    }

    .btn {
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        font-size: 0.95rem;
        text-align: center;
        flex: 1;
    }

    .btn-primary {
        background: linear-gradient(135deg, #d4af37 0%, #f4d03f 100%);
        color: #1a1a1a;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(212, 175, 55, 0.3);
    }

    .btn-success {
        background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%);
        color: #ffffff;
    }

    .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(46, 204, 113, 0.3);
    }

    .btn-danger {
        background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%);
        color: #ffffff;
    }

    .btn-danger:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(231, 76, 60, 0.3);
    }

    .btn-outline {
        background: transparent;
        border: 1px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
    }

    .btn-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        border-color: rgba(255, 255, 255, 0.5);
    }

    .btn-disabled {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 0.5);
        cursor: not-allowed;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-aangemeld {
        background: rgba(46, 204, 113, 0.2);
        color: #2ecc71;
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
        color: #d4af37;
        margin-bottom: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
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
        $percentage = $keuzedeel->max_studenten > 0 ? ($keuzedeel->aanmeldingen_count / $keuzedeel->max_studenten) * 100 : 0;
        $capacityClass = $percentage >= 100 ? 'full' : ($percentage >= 75 ? 'warning' : '');
    @endphp
    <div class="keuzedeel-card {{ $isAangemeld ? 'aangemeld' : '' }}" data-naam="{{ strtolower($keuzedeel->naam) }}" data-code="{{ strtolower($keuzedeel->code) }}">
        <div class="keuzedeel-header">
            <span class="keuzedeel-code">{{ $keuzedeel->code }}</span>
            @if($isAangemeld)
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
                @if($isAangemeld)
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
</script>
@endsection
