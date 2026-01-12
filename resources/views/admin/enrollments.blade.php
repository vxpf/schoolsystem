@extends('layouts.app')

@section('title', 'Inschrijvingen Beheren')

@section('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 2rem;
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

    .admin-header-top {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 0.75rem;
    }

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: rgba(255, 255, 255, 0.7);
        text-decoration: none;
        font-weight: 500;
        font-size: 0.85rem;
        padding: 0.5rem 0.75rem;
        border-radius: 6px;
        transition: all 0.2s ease;
        background: rgba(255, 255, 255, 0.1);
    }

    .back-link:hover {
        color: #ffffff;
        background: rgba(255, 255, 255, 0.15);
        transform: translateX(-2px);
    }

    .back-link svg {
        width: 16px;
        height: 16px;
        transition: transform 0.2s ease;
    }

    .back-link:hover svg {
        transform: translateX(-2px);
    }

    .admin-header h1 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
        color: #ffffff;
        font-weight: 800;
    }

    .admin-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .keuzedeel-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
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

    .keuzedeel-stats {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .stat-badge {
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.2) 100%);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 700;
        color: var(--accent);
        font-size: 0.85rem;
    }

    .students-preview {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
        margin-top: 1rem;
    }

    .student-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: var(--radius);
        border: 1px solid var(--border-light);
    }

    .student-info {
        display: flex;
        flex-direction: column;
    }

    .student-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .student-details {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .status-badge {
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
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

    .view-all-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        margin-top: 1rem;
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .view-all-link:hover {
        color: var(--accent-hover);
        transform: translateX(4px);
    }

    .no-enrollments {
        color: var(--text-muted);
        font-style: italic;
        padding: 1.5rem;
        text-align: center;
        background: var(--bg-light);
        border-radius: var(--radius);
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

    .low-enrollment-warning {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.4rem 0.9rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: var(--warning-bg);
        color: #b45309;
        margin-left: 0.5rem;
    }

    .keuzedeel-card.low-enrollment {
        border-left: 4px solid var(--warning);
    }

    .eerder-badge-inline {
        display: inline-block;
        margin-left: 0.5rem;
        padding: 2px 8px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
    }

</style>
@endsection

@section('content')
<div class="admin-header">
    <div class="admin-header-top">
        <a href="{{ route('admin.dashboard') }}" class="back-link">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"/>
                <polyline points="12 19 5 12 12 5"/>
            </svg>
            Terug naar Dashboard
        </a>
    </div>
    <h1>Inschrijvingen per Keuzedeel</h1>
    <p>Overzicht van alle studenten die zich hebben ingeschreven per vak</p>
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

<div class="keuzedeel-list">
    @forelse($keuzedelen as $keuzedeel)
        @php
            $percentage = $keuzedeel->max_studenten > 0 ? ($keuzedeel->users_count / $keuzedeel->max_studenten) * 100 : 0;
            $isLowEnrollment = $percentage < 30 && $percentage > 0;
        @endphp
        <div class="keuzedeel-card {{ $isLowEnrollment ? 'low-enrollment' : '' }}">
            <div class="keuzedeel-header">
                <div>
                    <div class="keuzedeel-title">
                        {{ $keuzedeel->naam }}
                        @if($isLowEnrollment)
                        <span class="low-enrollment-warning">
                            ⚠️ Weinig inschrijvingen ({{ round($percentage) }}%)
                        </span>
                        @endif
                    </div>
                    <div class="keuzedeel-code">{{ $keuzedeel->code }}</div>
                </div>
                <div class="keuzedeel-stats">
                    <div class="stat-badge">
                        {{ $keuzedeel->users_count }} / {{ $keuzedeel->max_studenten }} studenten
                    </div>
                </div>
            </div>

            @if($keuzedeel->users->count() > 0)
                <div class="students-preview">
                    @foreach($keuzedeel->users->take(3) as $student)
                        <div class="student-item">
                            <div class="student-info">
                                <span class="student-name">
                                    {{ $student->name }}
                                    @if($student->pivot->eerder_gedaan)
                                        <span class="eerder-badge-inline">
                                            @if($student->pivot->eerder_markering === 'x')
                                                ✓ Gekoppeld
                                            @elseif($student->pivot->eerder_markering === 'pv')
                                                ⚠ Poging Vergeven
                                            @else
                                                ✓ Eerder gedaan
                                            @endif
                                        </span>
                                    @endif
                                </span>
                                <span class="student-details">
                                    {{ $student->student_number }} • {{ $student->class }} • {{ $student->opleiding }}
                                </span>
                            </div>
                            <span class="status-badge status-{{ $student->pivot->status }}">
                                {{ ucfirst($student->pivot->status) }}
                            </span>
                        </div>
                    @endforeach
                </div>

                @if($keuzedeel->users->count() > 3)
                    <a href="{{ route('admin.enrollments.detail', $keuzedeel) }}" class="view-all-link">
                        Bekijk alle {{ $keuzedeel->users_count }} inschrijvingen →
                    </a>
                @elseif($keuzedeel->users->count() > 0)
                    <a href="{{ route('admin.enrollments.detail', $keuzedeel) }}" class="view-all-link">
                        Beheer inschrijvingen →
                    </a>
                @endif
            @else
                <div class="no-enrollments">Nog geen inschrijvingen</div>
            @endif
        </div>
    @empty
        <div style="background: rgba(255, 255, 255, 0.05); padding: 2rem; border-radius: 12px; text-align: center; color: rgba(255, 255, 255, 0.6);">
            Geen keuzedelen gevonden.
        </div>
    @endforelse
</div>
@endsection
