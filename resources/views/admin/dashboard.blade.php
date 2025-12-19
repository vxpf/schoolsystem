@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .admin-header {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .admin-header h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        color: #d4a024;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .stat-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .stat-card h3 {
        font-size: 0.9rem;
        color: #d4a024;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .stat-card .stat-value {
        font-size: 2.5rem;
        font-weight: 700;
        color: #fff;
    }

    .admin-actions {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 1.5rem;
    }

    .action-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 2rem;
        border-radius: 12px;
        border: 1px solid rgba(212, 160, 36, 0.2);
        text-decoration: none;
        color: #fff;
        transition: all 0.3s ease;
    }

    .action-card:hover {
        transform: translateY(-4px);
        border-color: #d4a024;
        background: rgba(255, 255, 255, 0.08);
    }

    .action-card h3 {
        font-size: 1.3rem;
        margin-bottom: 0.5rem;
        color: #d4a024;
    }

    .action-card p {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
    }
</style>
@endsection

@section('content')
<div class="admin-header">
    <h1>🛡️ Admin Dashboard</h1>
    <p style="color: rgba(255, 255, 255, 0.8);">Welkom in het administratiepaneel</p>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Totaal Studenten</h3>
        <div class="stat-value">{{ $totalStudents }}</div>
    </div>
    <div class="stat-card">
        <h3>Totaal Keuzedelen</h3>
        <div class="stat-value">{{ $totalKeuzedelen }}</div>
    </div>
    <div class="stat-card">
        <h3>Totaal Inschrijvingen</h3>
        <div class="stat-value">{{ $totalEnrollments }}</div>
    </div>
    <div class="stat-card">
        <h3>Actieve Keuzedelen</h3>
        <div class="stat-value">{{ $activeKeuzedelen }}</div>
    </div>
</div>

<div class="admin-actions">
    <a href="{{ route('admin.students') }}" class="action-card">
        <h3>👥 Studenten Overzicht</h3>
        <p>Bekijk alle geregistreerde studenten met hun naam, email en inschrijvingen</p>
    </a>
    <a href="{{ route('admin.enrollments') }}" class="action-card">
        <h3>📊 Inschrijvingen Beheren</h3>
        <p>Bekijk alle inschrijvingen per keuzedeel en beheer de status van studenten</p>
    </a>
    <a href="{{ route('admin.keuzedelen.index') }}" class="action-card">
        <h3>📚 Keuzedelen Beheren</h3>
        <p>Voeg nieuwe keuzedelen toe, bewerk bestaande of verwijder keuzedelen</p>
    </a>
</div>
@endsection
