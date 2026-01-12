@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .welcome-banner {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        border-radius: var(--radius-xl);
        padding: 2.5rem;
        margin-bottom: 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }


    .welcome-banner h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: -0.5px;
    }

    .welcome-banner h2 span {
        color: var(--accent-light);
    }

    .welcome-banner p {
        color: var(--text-muted);
        font-size: 1rem;
    }

    .user-info-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        margin-bottom: 2rem;
    }

    .user-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
    }

    .user-info-item {
        display: flex;
        flex-direction: column;
        padding: 1rem;
        background: var(--bg-light);
        border-radius: var(--radius);
        border: 1px solid var(--border-light);
    }

    .user-info-label {
        font-size: 0.7rem;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        font-weight: 600;
    }

    .user-info-value {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2.5rem;
    }

    .dashboard-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 1.75rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.2s ease;
    }

    .dashboard-card:hover {
        box-shadow: var(--shadow-md);
        transform: translateY(-2px);
    }

    .dashboard-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .dashboard-card-title {
        font-size: 0.875rem;
        font-weight: 600;
        color: var(--text-secondary);
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .dashboard-card-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.2) 100%);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
    }

    .dashboard-stat {
        font-size: 2.5rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
        letter-spacing: -1px;
    }

    .dashboard-stat-label {
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .section-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.5rem;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        letter-spacing: -0.3px;
    }

    .keuzedelen-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .keuzedeel-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 1.5rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s ease;
    }

    .keuzedeel-card:hover {
        border-color: var(--accent);
        box-shadow: var(--shadow-md);
        transform: translateX(4px);
    }

    .keuzedeel-info h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.35rem;
    }

    .keuzedeel-info p {
        font-size: 0.875rem;
        color: var(--text-secondary);
        margin-bottom: 0.75rem;
    }

    .keuzedeel-meta {
        display: flex;
        gap: 1.25rem;
        font-size: 0.8rem;
        color: var(--text-muted);
    }

    .keuzedeel-meta span {
        display: flex;
        align-items: center;
        gap: 6px;
        padding: 4px 10px;
        background: var(--bg-light);
        border-radius: 20px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 16px;
        border-radius: 24px;
        font-size: 0.8rem;
        font-weight: 600;
        text-transform: capitalize;
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

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        border: 2px dashed var(--border);
    }

    .empty-state-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, var(--bg-light) 0%, var(--border-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1.5rem;
        color: var(--text-muted);
    }

    .empty-state h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: var(--text-secondary);
        font-size: 0.95rem;
        margin-bottom: 2rem;
        max-width: 400px;
        margin-left: auto;
        margin-right: auto;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 24px;
        font-size: 0.9rem;
        font-weight: 600;
        border-radius: var(--radius);
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s ease;
    }

    .btn-primary {
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 16px rgba(212, 160, 36, 0.4);
    }

    @media (max-width: 768px) {
        .welcome-banner {
            padding: 1.75rem;
        }
        
        .welcome-banner h2 {
            font-size: 1.5rem;
        }
        
        .keuzedeel-card {
            flex-direction: column;
            align-items: flex-start;
            gap: 1rem;
        }
    }
</style>
@endsection

@section('content')
<div class="welcome-banner">
    <h2>Welkom terug, <span>{{ $user->name }}</span></h2>
    <p>Beheer je keuzedelen en bekijk je voortgang</p>
</div>

<div class="user-info-card">
    <div class="user-info-grid">
        <div class="user-info-item">
            <span class="user-info-label">Leerlingnummer</span>
            <span class="user-info-value">{{ $user->student_number ?? 'Niet ingesteld' }}</span>
        </div>
        <div class="user-info-item">
            <span class="user-info-label">E-mailadres</span>
            <span class="user-info-value">{{ $user->email }}</span>
        </div>
        <div class="user-info-item">
            <span class="user-info-label">Opleiding</span>
            <span class="user-info-value">{{ $user->opleiding ?? 'Niet ingesteld' }}</span>
        </div>
        <div class="user-info-item">
            <span class="user-info-label">Klas</span>
            <span class="user-info-value">{{ $user->class ?? 'Niet ingesteld' }}</span>
        </div>
        <div class="user-info-item" style="grid-column: 1 / -1; background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.05) 100%); border: 2px solid var(--accent); border-radius: var(--radius); padding: 1rem;">
            <span class="user-info-label" style="color: var(--accent); font-weight: 700;">Huidige Periode</span>
            <span class="user-info-value" style="color: var(--accent); font-size: 1.25rem; font-weight: 800;">{{ $user->huidige_periode }}</span>
        </div>
    </div>
</div>

<div class="dashboard-grid">
    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <span class="dashboard-card-title">Mijn keuzedelen</span>
            <div class="dashboard-card-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                </svg>
            </div>
        </div>
        <div class="dashboard-stat">{{ $mijnKeuzedelen->count() }}</div>
        <div class="dashboard-stat-label">Aangemelde keuzedelen</div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <span class="dashboard-card-title">Beschikbaar</span>
            <div class="dashboard-card-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h12zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2H2z"/>
                    <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                </svg>
            </div>
        </div>
        <div class="dashboard-stat">{{ $keuzedelen->count() }}</div>
        <div class="dashboard-stat-label">Beschikbare keuzedelen</div>
    </div>

    <div class="dashboard-card">
        <div class="dashboard-card-header">
            <span class="dashboard-card-title">Status</span>
            <div class="dashboard-card-icon">
                <svg width="20" height="20" fill="currentColor" viewBox="0 0 16 16">
                    <path d="M10.97 4.97a.75.75 0 0 1 1.07 1.05l-3.99 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425a.267.267 0 0 1 .02-.022z"/>
                </svg>
            </div>
        </div>
        <div class="dashboard-stat">{{ $mijnKeuzedelen->where('pivot.status', 'goedgekeurd')->count() }}</div>
        <div class="dashboard-stat-label">Goedgekeurd</div>
    </div>
</div>

<h2 class="section-title">Mijn aangemelde keuzedelen</h2>

@if($mijnKeuzedelen->count() > 0)
<div class="keuzedelen-list">
    @foreach($mijnKeuzedelen as $keuzedeel)
    <div class="keuzedeel-card">
        <div class="keuzedeel-info">
            <h3>{{ $keuzedeel->naam }}</h3>
            <p>{{ Str::limit($keuzedeel->beschrijving, 100) }}</p>
            <div class="keuzedeel-meta">
                <span>{{ $keuzedeel->code }}</span>
                <span>{{ $keuzedeel->studiepunten }} studiepunten</span>
            </div>
        </div>
        <span class="status-badge status-{{ $keuzedeel->pivot->status }}">
            {{ ucfirst($keuzedeel->pivot->status) }}
        </span>
    </div>
    @endforeach
</div>
@else
<div class="empty-state">
    <div class="empty-state-icon">
        <svg width="28" height="28" fill="currentColor" viewBox="0 0 16 16">
            <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
        </svg>
    </div>
    <h3>Nog geen keuzedelen aangemeld</h3>
    <p>Je hebt je nog niet aangemeld voor keuzedelen. Bekijk de beschikbare keuzedelen en meld je aan.</p>
    <a href="http://localhost/schoolsystem/public/keuzedelen" class="btn btn-primary">Bekijk keuzedelen</a>
</div>
@endif
@endsection
