@extends('layouts.app')

@section('title', 'SLB Dashboard')

@section('styles')
<style>
    .page-header {
        margin-bottom: 2rem;
        padding-bottom: 1rem;
        border-bottom: 1px solid var(--border);
    }

    .page-header h1 {
        font-size: 1.5rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .page-header p {
        color: var(--text-muted);
        font-size: 0.875rem;
    }

    .stats-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-bottom: 2rem;
    }

    .stat-box {
        background: var(--bg-card);
        padding: 1.25rem;
        border-radius: 8px;
        border: 1px solid var(--border);
    }

    .stat-box-label {
        font-size: 0.75rem;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .stat-box-value {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .section {
        margin-bottom: 2rem;
    }

    .section-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-dark);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
        flex-wrap: wrap;
    }

    .action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        border-radius: 6px;
        text-decoration: none;
        font-weight: 500;
        font-size: 0.875rem;
        transition: all 0.15s ease;
    }

    .action-btn-primary {
        background: var(--primary);
        color: #fff;
    }

    .action-btn-primary:hover {
        background: var(--primary-dark);
        color: #fff;
    }

    .action-btn-secondary {
        background: var(--bg-card);
        color: var(--text-dark);
        border: 1px solid var(--border);
    }

    .action-btn-secondary:hover {
        background: var(--bg-light);
        border-color: var(--text-muted);
    }

    .action-btn svg {
        width: 16px;
        height: 16px;
    }

    .keuzedelen-table {
        width: 100%;
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }

    .keuzedelen-table thead {
        background: var(--bg-light);
    }

    .keuzedelen-table th {
        padding: 0.75rem 1rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid var(--border);
    }

    .keuzedelen-table td {
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-light);
    }

    .keuzedelen-table tbody tr:last-child td {
        border-bottom: none;
    }

    .keuzedelen-table tbody tr:hover {
        background: var(--bg-light);
    }

    .keuzedeel-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .keuzedeel-code {
        color: var(--text-muted);
        font-size: 0.8125rem;
    }

    .badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .badge-available {
        background: #dcfce7;
        color: #166534;
    }

    .badge-full {
        background: #fee2e2;
        color: #991b1b;
    }

    .progress-bar-container {
        width: 100px;
        height: 6px;
        background: var(--border);
        border-radius: 3px;
        overflow: hidden;
    }

    .progress-bar-fill {
        height: 100%;
        background: var(--primary);
        border-radius: 3px;
        transition: width 0.3s ease;
    }

    .progress-bar-fill.high {
        background: #dc2626;
    }

    .progress-bar-fill.medium {
        background: #d97706;
    }

    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: 1fr;
        }

        .keuzedelen-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>SLB Dashboard</h1>
    <p>Overzicht van keuzedelen en inschrijvingen</p>
</div>

<div class="stats-row">
    <div class="stat-box">
        <div class="stat-box-label">Actieve keuzedelen</div>
        <div class="stat-box-value">{{ $totalKeuzedelen }}</div>
    </div>
    <div class="stat-box">
        <div class="stat-box-label">Studenten</div>
        <div class="stat-box-value">{{ $totalStudents }}</div>
    </div>
    <div class="stat-box">
        <div class="stat-box-label">Inschrijvingen</div>
        <div class="stat-box-value">{{ $totalEnrollments }}</div>
    </div>
</div>

<div class="section">
    <div class="section-title">Acties</div>
    <div class="action-buttons">
        <a href="{{ route('slb.presentatie') }}" class="action-btn action-btn-primary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <rect x="2" y="3" width="20" height="14" rx="2"/>
                <line x1="8" y1="21" x2="16" y2="21"/>
                <line x1="12" y1="17" x2="12" y2="21"/>
            </svg>
            Presentatie starten
        </a>
        <a href="{{ route('slb.cijfers') }}" class="action-btn action-btn-secondary">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                <polyline points="14 2 14 8 20 8"/>
                <line x1="16" y1="13" x2="8" y2="13"/>
                <line x1="16" y1="17" x2="8" y2="17"/>
            </svg>
            Cijfers beheren
        </a>
    </div>
</div>

<div class="section">
    <div class="section-title">Keuzedelen overzicht</div>
    <table class="keuzedelen-table">
        <thead>
            <tr>
                <th>Keuzedeel</th>
                <th>Code</th>
                <th>Niveau</th>
                <th>SP</th>
                <th>Bezetting</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($keuzedelen as $keuzedeel)
            @php
                $percentage = $keuzedeel->max_studenten > 0 ? ($keuzedeel->users_count / $keuzedeel->max_studenten) * 100 : 0;
                $isFull = $keuzedeel->users_count >= $keuzedeel->max_studenten;
            @endphp
            <tr>
                <td class="keuzedeel-name">{{ $keuzedeel->naam }}</td>
                <td class="keuzedeel-code">{{ $keuzedeel->code }}</td>
                <td>{{ $keuzedeel->niveau ?? '-' }}</td>
                <td>{{ $keuzedeel->studiepunten }}</td>
                <td>
                    <div style="display: flex; align-items: center; gap: 0.75rem;">
                        <div class="progress-bar-container">
                            <div class="progress-bar-fill {{ $percentage >= 90 ? 'high' : ($percentage >= 70 ? 'medium' : '') }}" style="width: {{ min($percentage, 100) }}%"></div>
                        </div>
                        <span style="font-size: 0.8125rem; color: var(--text-muted);">{{ $keuzedeel->users_count }}/{{ $keuzedeel->max_studenten }}</span>
                    </div>
                </td>
                <td>
                    @if($isFull)
                        <span class="badge badge-full">Vol</span>
                    @else
                        <span class="badge badge-available">Beschikbaar</span>
                    @endif
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
