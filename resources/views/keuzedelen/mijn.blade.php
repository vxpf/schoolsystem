@extends('layouts.app')

@section('title', 'Mijn Keuzedelen')

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

    .info-box {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.1) 0%, var(--bg-card) 100%);
        border: 2px solid rgba(59, 130, 246, 0.3);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        margin-bottom: 2rem;
        display: flex;
        align-items: start;
        gap: 1rem;
    }

    .info-icon {
        width: 40px;
        height: 40px;
        background: var(--info-bg);
        border-radius: var(--radius);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--info);
        font-size: 1.25rem;
        flex-shrink: 0;
    }

    .info-content h3 {
        font-size: 1rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .info-content p {
        font-size: 0.9rem;
        color: var(--text-secondary);
        line-height: 1.6;
    }

    .prioriteit-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 28px;
        height: 28px;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        border-radius: 50%;
        font-weight: 800;
        font-size: 0.85rem;
        margin-right: 0.5rem;
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
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-value {
        font-size: 2.25rem;
        font-weight: 800;
        color: var(--accent);
        margin-bottom: 0.25rem;
        letter-spacing: -1px;
    }

    .stat-label {
        font-size: 0.875rem;
        color: var(--text-secondary);
        font-weight: 500;
    }

    .keuzedelen-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .keuzedeel-item {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 1.5rem;
        box-shadow: var(--shadow);
        transition: all 0.2s ease;
    }

    .keuzedeel-item:hover {
        border-color: var(--accent);
        box-shadow: var(--shadow-md);
        transform: translateX(4px);
    }

    .keuzedeel-info {
        flex: 1;
    }

    .keuzedeel-code {
        display: inline-block;
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.2) 100%);
        color: var(--accent);
        padding: 0.3rem 0.75rem;
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: 0.5px;
    }

    .keuzedeel-naam {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
        margin: 0 0 0.5rem 0;
    }

    .keuzedeel-meta {
        display: flex;
        gap: 1.25rem;
        color: var(--text-muted);
        font-size: 0.875rem;
    }

    .keuzedeel-meta span {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        padding: 4px 10px;
        background: var(--bg-light);
        border-radius: 20px;
    }

    .keuzedeel-actions {
        display: flex;
        gap: 0.75rem;
        align-items: center;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 600;
    }

    .status-aangemeld {
        background: var(--warning-bg);
        color: #b45309;
    }

    .status-goedgekeurd {
        background: var(--success-bg);
        color: #047857;
    }

    .status-afgewezen {
        background: var(--danger-bg);
        color: #b91c1c;
    }

    .status-voltooid {
        background: var(--info-bg);
        color: #1d4ed8;
    }

    .btn {
        padding: 0.65rem 1.25rem;
        border-radius: var(--radius);
        font-weight: 600;
        text-decoration: none;
        transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        border: none;
        cursor: pointer;
        font-size: 0.875rem;
        text-align: center;
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

    .btn-danger {
        background: var(--danger-bg);
        border: 1px solid rgba(239, 68, 68, 0.3);
        color: var(--danger);
    }

    .btn-danger:hover {
        background: linear-gradient(135deg, var(--danger) 0%, #dc2626 100%);
        color: #ffffff;
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.3);
        transform: translateY(-2px) scale(1.02);
    }

    .btn-danger:active {
        transform: translateY(0) scale(0.98);
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
        margin-bottom: 1.5rem;
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

<div class="info-box">
    <div class="info-icon">ℹ️</div>
    <div class="info-content">
        <h3>Eén keuzedeel per periode</h3>
        <p>Je kunt maar 1 keuzedeel per periode volgen. Je huidige periode is <strong>{{ $user->huidige_periode }}</strong>. Keuzedelen van andere periodes worden apart weergegeven.</p>
    </div>
</div>

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
                @if($keuzedeel->periode)
                <span style="background: rgba(212, 160, 36, 0.1); padding: 4px 10px; border-radius: 20px;">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    Periode: {{ $keuzedeel->periode }}
                </span>
                @endif
            </div>
            @if($keuzedeel->pivot->second_choice_keuzedeel_id)
            @php
                $secondChoice = \App\Models\Keuzedeel::find($keuzedeel->pivot->second_choice_keuzedeel_id);
            @endphp
            @if($secondChoice)
            <div style="margin-top: 0.75rem; padding: 0.75rem; background: rgba(59, 130, 246, 0.1); border-left: 3px solid var(--primary); border-radius: 4px;">
                <p style="color: var(--text-secondary); font-size: 0.85rem; margin: 0;">
                    <strong style="color: var(--primary);">2e keuze:</strong> {{ $secondChoice->naam }}
                </p>
            </div>
            @endif
            @endif
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
