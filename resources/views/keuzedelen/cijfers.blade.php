@extends('layouts.app')

@section('styles')
<style>
    .cijfers-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2.5rem 1.5rem;
    }

    .cijfers-header {
        margin-bottom: 3rem;
        text-align: center;
    }

    .cijfers-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
        letter-spacing: -0.02em;
    }

    .cijfers-subtitle {
        color: var(--text-secondary);
        font-size: 1.125rem;
        font-weight: 400;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 3rem;
    }

    .stat-card {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        padding: 2rem;
        border-radius: 16px;
        color: white;
        box-shadow: 0 10px 30px rgba(212, 160, 36, 0.2);
        transition: transform 0.3s var(--transition-smooth), box-shadow 0.3s var(--transition-smooth);
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 150px;
        height: 150px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        transform: translate(50%, -50%);
    }

    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(212, 160, 36, 0.3);
    }

    .stat-card.purple {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        box-shadow: 0 10px 30px rgba(102, 126, 234, 0.2);
    }

    .stat-card.purple:hover {
        box-shadow: 0 15px 40px rgba(102, 126, 234, 0.3);
    }

    .stat-card.blue {
        background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        box-shadow: 0 10px 30px rgba(79, 172, 254, 0.2);
    }

    .stat-card.blue:hover {
        box-shadow: 0 15px 40px rgba(79, 172, 254, 0.3);
    }

    .stat-label {
        font-size: 0.875rem;
        opacity: 0.95;
        margin-bottom: 0.75rem;
        font-weight: 500;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        position: relative;
        z-index: 1;
    }

    .stat-value {
        font-size: 3rem;
        font-weight: 800;
        position: relative;
        z-index: 1;
        line-height: 1;
    }

    .cijfers-table-container {
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .cijfers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cijfers-table thead {
        background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
        color: white;
    }

    .cijfers-table th {
        padding: 1.25rem 1.5rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .cijfers-table th:nth-child(3),
    .cijfers-table th:nth-child(4),
    .cijfers-table th:nth-child(5) {
        text-align: center;
    }

    .cijfers-table tbody tr {
        border-bottom: 1px solid #f0f0f0;
        transition: background-color 0.2s var(--transition-smooth);
    }

    .cijfers-table tbody tr:hover {
        background-color: #fafafa;
    }

    .cijfers-table tbody tr:last-child {
        border-bottom: none;
    }

    .cijfers-table td {
        padding: 1.5rem;
    }

    .keuzedeel-name {
        font-weight: 600;
        color: var(--text-primary);
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }

    .keuzedeel-desc {
        font-size: 0.875rem;
        color: var(--text-secondary);
        line-height: 1.4;
    }

    .code-badge {
        background: #f7f7f7;
        color: var(--text-primary);
        padding: 0.5rem 1rem;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 600;
        font-family: 'Courier New', monospace;
        display: inline-block;
    }

    .studiepunten-value {
        font-weight: 700;
        color: var(--text-primary);
        font-size: 1.125rem;
    }

    .cijfer-circle {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 70px;
        height: 70px;
        border-radius: 50%;
        font-size: 1.75rem;
        font-weight: 800;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        transition: transform 0.3s var(--transition-smooth);
    }

    .cijfer-circle:hover {
        transform: scale(1.1);
    }

    .cijfer-excellent {
        background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);
        color: white;
    }

    .cijfer-good {
        background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);
        color: white;
    }

    .cijfer-fail {
        background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);
        color: white;
    }

    .status-badge {
        padding: 0.625rem 1.25rem;
        border-radius: 25px;
        font-size: 0.875rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
    }

    .status-passed {
        background: linear-gradient(135deg, #c6f6d5 0%, #9ae6b4 100%);
        color: #22543d;
    }

    .status-failed {
        background: linear-gradient(135deg, #fed7d7 0%, #fc8181 100%);
        color: #742a2a;
    }

    .legend-box {
        margin-top: 2.5rem;
        padding: 2rem;
        background: linear-gradient(135deg, #f7fafc 0%, #edf2f7 100%);
        border-radius: 16px;
        border-left: 5px solid var(--primary);
    }

    .legend-title {
        font-size: 1.125rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .legend-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 1.25rem;
    }

    .legend-item {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .legend-color {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    .legend-text {
        color: var(--text-secondary);
        font-size: 0.875rem;
        line-height: 1.4;
    }

    .legend-text strong {
        color: var(--text-primary);
        font-weight: 600;
    }

    .empty-state {
        text-align: center;
        padding: 5rem 2rem;
        background: white;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    }

    .empty-icon {
        font-size: 5rem;
        margin-bottom: 1.5rem;
        opacity: 0.8;
    }

    .empty-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin-bottom: 0.75rem;
    }

    .empty-text {
        color: var(--text-secondary);
        margin-bottom: 2rem;
        font-size: 1.125rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--text-secondary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s var(--transition-smooth);
        margin-top: 2rem;
    }

    .back-link:hover {
        color: var(--primary);
        gap: 0.75rem;
    }

    @media (max-width: 768px) {
        .cijfers-title {
            font-size: 2rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .cijfers-table-container {
            overflow-x: auto;
        }

        .cijfers-table {
            min-width: 700px;
            font-size: 0.875rem;
        }

        .cijfers-table th, .cijfers-table td {
            padding: 0.75rem 0.5rem;
        }

        .cijfer-circle {
            width: 40px;
            height: 40px;
            font-size: 0.875rem;
        }
    }

    @media (max-width: 480px) {
        .stats-grid {
            gap: 0.75rem;
        }

        .stat-card {
            padding: 1rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }
    }
</style>
@endsection

@section('content')
<div class="cijfers-container">
    <div class="cijfers-header">
        <h1 class="cijfers-title">Mijn Cijfers</h1>
        <p class="cijfers-subtitle">Overzicht van al je behaalde cijfers voor keuzedelen</p>
    </div>

    @if(session('success'))
        <div style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem;">
            {{ session('success') }}
        </div>
    @endif

    @php
        $keuzedelenMetCijfer = Auth::user()->keuzedelen()
            ->wherePivot('cijfer', '!=', null)
            ->orderBy('keuzedeel_user.created_at', 'desc')
            ->get();
        
        $gemiddeldeCijfer = $keuzedelenMetCijfer->avg('pivot.cijfer');
        $totaalStudiepunten = $keuzedelenMetCijfer->sum('studiepunten');
    @endphp

    @if($keuzedelenMetCijfer->count() > 0)
        <!-- Statistieken -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-label">Gemiddeld Cijfer</div>
                <div class="stat-value">{{ number_format($gemiddeldeCijfer, 1) }}</div>
            </div>
            
            <div class="stat-card purple">
                <div class="stat-label">Keuzedelen Afgerond</div>
                <div class="stat-value">{{ $keuzedelenMetCijfer->count() }}</div>
            </div>
            
            <div class="stat-card blue">
                <div class="stat-label">Totaal Studiepunten</div>
                <div class="stat-value">{{ $totaalStudiepunten }}</div>
            </div>
        </div>

        <!-- Cijfers Tabel -->
        <div class="cijfers-table-container">
            <table class="cijfers-table">
                <thead>
                    <tr>
                        <th>Keuzedeel</th>
                        <th>Code</th>
                        <th>Studiepunten</th>
                        <th>Cijfer</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($keuzedelenMetCijfer as $keuzedeel)
                        <tr>
                            <td>
                                <div class="keuzedeel-name">{{ $keuzedeel->naam }}</div>
                                <div class="keuzedeel-desc">{{ Str::limit($keuzedeel->beschrijving, 60) }}</div>
                            </td>
                            <td>
                                <span class="code-badge">{{ $keuzedeel->code }}</span>
                            </td>
                            <td style="text-align: center;">
                                <span class="studiepunten-value">{{ $keuzedeel->studiepunten }}</span>
                            </td>
                            <td style="text-align: center;">
                                @php
                                    $cijfer = $keuzedeel->pivot->cijfer;
                                    $cijferClass = 'cijfer-good';
                                    if ($cijfer < 5.5) {
                                        $cijferClass = 'cijfer-fail';
                                    } elseif ($cijfer >= 8.0) {
                                        $cijferClass = 'cijfer-excellent';
                                    }
                                @endphp
                                <div class="cijfer-circle {{ $cijferClass }}">
                                    {{ number_format($cijfer, 1) }}
                                </div>
                            </td>
                            <td style="text-align: center;">
                                @if($cijfer >= 5.5)
                                    <span class="status-badge status-passed">
                                        ✓ Behaald
                                    </span>
                                @else
                                    <span class="status-badge status-failed">
                                        ✗ Onvoldoende
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Legenda -->
        <div class="legend-box">
            <h3 class="legend-title">📊 Cijfer Betekenis</h3>
            <div class="legend-grid">
                <div class="legend-item">
                    <div class="legend-color" style="background: linear-gradient(135deg, #4299e1 0%, #3182ce 100%);"></div>
                    <div class="legend-text"><strong>8.0 - 10.0:</strong> Uitstekend</div>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: linear-gradient(135deg, #48bb78 0%, #38a169 100%);"></div>
                    <div class="legend-text"><strong>5.5 - 7.9:</strong> Voldoende</div>
                </div>
                <div class="legend-item">
                    <div class="legend-color" style="background: linear-gradient(135deg, #f56565 0%, #e53e3e 100%);"></div>
                    <div class="legend-text"><strong>1.0 - 5.4:</strong> Onvoldoende</div>
                </div>
            </div>
        </div>

    @else
        <!-- Geen cijfers -->
        <div class="empty-state">
            <div class="empty-icon">📝</div>
            <h3 class="empty-title">Nog geen cijfers</h3>
            <p class="empty-text">Je hebt nog geen cijfers ontvangen voor keuzedelen.</p>
            <a href="{{ route('keuzedelen.index') }}" class="btn btn-primary">
                Bekijk Keuzedelen
            </a>
        </div>
    @endif

    <!-- Terug knop -->
    <a href="{{ route('keuzedelen.mijn') }}" class="back-link">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M19 12H5M12 19l-7-7 7-7"/>
        </svg>
        Terug naar Mijn Keuzedelen
    </a>
</div>
@endsection
