@extends('layouts.app')

@section('title', 'Dashboard')

@section('styles')
<style>
    .dashboard-header {
        margin-bottom: 2rem;
    }

    .dashboard-header h1 {
        font-size: 1.75rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.5rem;
    }

    .dashboard-header p {
        color: #666;
        font-size: 1rem;
    }

    .dashboard-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .dashboard-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #e5e5e5;
    }

    .dashboard-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1rem;
    }

    .dashboard-card-title {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
    }

    .dashboard-card-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, rgba(201, 162, 39, 0.1) 0%, rgba(201, 162, 39, 0.2) 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #c9a227;
    }

    .dashboard-stat {
        font-size: 2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 0.25rem;
    }

    .dashboard-stat-label {
        font-size: 0.875rem;
        color: #888;
    }

    .section-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 1rem;
    }

    .keuzedelen-list {
        display: grid;
        gap: 1rem;
    }

    .keuzedeel-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #e5e5e5;
        display: flex;
        justify-content: space-between;
        align-items: center;
        transition: all 0.2s;
    }

    .keuzedeel-card:hover {
        border-color: #c9a227;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    }

    .keuzedeel-info h3 {
        font-size: 1rem;
        font-weight: 600;
        color: #1a1a1a;
        margin-bottom: 0.25rem;
    }

    .keuzedeel-info p {
        font-size: 0.875rem;
        color: #666;
        margin-bottom: 0.5rem;
    }

    .keuzedeel-meta {
        display: flex;
        gap: 1rem;
        font-size: 0.8rem;
        color: #888;
    }

    .keuzedeel-meta span {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-aangemeld {
        background: #fef3c7;
        color: #92400e;
    }

    .status-goedgekeurd {
        background: #d1fae5;
        color: #065f46;
    }

    .status-afgewezen {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-voltooid {
        background: #e0e7ff;
        color: #3730a3;
    }

    .empty-state {
        text-align: center;
        padding: 3rem;
        background: #fff;
        border-radius: 12px;
        border: 1px dashed #ddd;
    }

    .empty-state-icon {
        width: 64px;
        height: 64px;
        background: #f5f5f5;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        color: #888;
    }

    .empty-state h3 {
        font-size: 1.1rem;
        font-weight: 600;
        color: #333;
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        color: #666;
        font-size: 0.9rem;
        margin-bottom: 1.5rem;
    }

    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 10px 20px;
        font-size: 0.9rem;
        font-weight: 500;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        text-decoration: none;
        transition: all 0.2s;
    }

    .btn-primary {
        background: linear-gradient(135deg, #c9a227 0%, #d4af37 100%);
        color: #1a1a1a;
    }

    .btn-primary:hover {
        background: linear-gradient(135deg, #d4af37 0%, #e6c349 100%);
        transform: translateY(-1px);
    }

    .welcome-banner {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        color: #fff;
        position: relative;
        overflow: hidden;
    }

    .welcome-banner::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(201, 162, 39, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .welcome-banner h2 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .welcome-banner h2 span {
        color: #c9a227;
    }

    .welcome-banner p {
        color: #aaa;
        font-size: 0.95rem;
    }

    .user-info-card {
        background: #fff;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.08);
        border: 1px solid #e5e5e5;
        margin-bottom: 2rem;
    }

    .user-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
    }

    .user-info-item {
        display: flex;
        flex-direction: column;
    }

    .user-info-label {
        font-size: 0.75rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        color: #888;
        margin-bottom: 0.25rem;
    }

    .user-info-value {
        font-size: 0.95rem;
        font-weight: 500;
        color: #1a1a1a;
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
