@extends('layouts.app')

@section('title', 'Mijn Profiel')

@section('styles')
<style>
    .profile-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .profile-header {
        display: flex;
        align-items: center;
        gap: 2.5rem;
        margin-bottom: 2rem;
        padding: 2.5rem;
        background: linear-gradient(145deg, #2a2a2a 0%, #1f1f1f 100%);
        border-radius: 16px;
        border: 1px solid #3a3a3a;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #c9a227 0%, #f4d03f 50%, #c9a227 100%);
    }

    .profile-avatar {
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #c9a227 0%, #f4d03f 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
        color: #1a1a1a;
        font-size: 2.8rem;
        flex-shrink: 0;
        box-shadow: 0 8px 32px rgba(201, 162, 39, 0.3);
        border: 4px solid #3a3a3a;
    }

    .profile-info h1 {
        font-size: 2rem;
        margin-bottom: 0.5rem;
        font-weight: 700;
    }

    .profile-info p {
        color: #888;
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .profile-role {
        display: inline-block;
        padding: 6px 16px;
        background: linear-gradient(135deg, #c9a227 0%, #d4af37 100%);
        color: #1a1a1a;
        border-radius: 20px;
        font-size: 0.85rem;
        font-weight: 600;
        text-transform: capitalize;
        margin-top: 0.75rem;
    }

    .profile-section {
        background: linear-gradient(145deg, #2a2a2a 0%, #1f1f1f 100%);
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 1.5rem;
        border: 1px solid #3a3a3a;
    }

    .profile-section h2 {
        font-size: 1.3rem;
        margin-bottom: 1.5rem;
        color: #fff;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 600;
    }

    .profile-section h2 .section-icon {
        width: 36px;
        height: 36px;
        background: linear-gradient(135deg, #c9a227 0%, #d4af37 100%);
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
    }

    .info-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.25rem;
    }

    @media (max-width: 768px) {
        .info-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (max-width: 500px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-item {
        padding: 1.25rem;
        background: linear-gradient(145deg, #1a1a1a 0%, #151515 100%);
        border-radius: 12px;
        border: 1px solid #2a2a2a;
        transition: all 0.3s ease;
    }

    .info-item:hover {
        border-color: #c9a227;
        transform: translateY(-2px);
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    }

    .info-item label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.75rem;
        color: #666;
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 1px;
        font-weight: 500;
    }

    .info-item label svg {
        width: 14px;
        height: 14px;
        opacity: 0.7;
    }

    .info-item span {
        font-size: 1.1rem;
        color: #fff;
        font-weight: 600;
        display: block;
    }

    .info-item span.not-set {
        color: #555;
        font-style: italic;
        font-weight: 400;
    }

    .keuzedeel-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .keuzedeel-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: #1a1a1a;
        border-radius: 8px;
        border-left: 4px solid #c9a227;
    }

    .keuzedeel-item-info h3 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
    }

    .keuzedeel-item-info p {
        font-size: 0.85rem;
        color: #888;
    }

    .keuzedeel-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 500;
    }

    .status-aangemeld {
        background: #3a3a3a;
        color: #f4d03f;
    }

    .status-goedgekeurd {
        background: rgba(34, 197, 94, 0.2);
        color: #22c55e;
    }

    .status-afgewezen {
        background: rgba(239, 68, 68, 0.2);
        color: #ef4444;
    }

    .status-voltooid {
        background: rgba(59, 130, 246, 0.2);
        color: #3b82f6;
    }

    .no-keuzedelen {
        text-align: center;
        padding: 2rem;
        color: #888;
    }

    .no-keuzedelen p {
        margin-bottom: 1rem;
    }

    .no-keuzedelen a {
        color: #c9a227;
        text-decoration: none;
    }

    .no-keuzedelen a:hover {
        text-decoration: underline;
    }
</style>
@endsection

@section('content')
<div class="profile-container">
    <div class="profile-header">
        <div class="profile-avatar">
            {{ strtoupper(substr($user->name, 0, 2)) }}
        </div>
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            <p>{{ $user->email }}</p>
            <span class="profile-role">{{ $user->role }}</span>
        </div>
    </div>

    <div class="profile-section">
        <h2>
            <span class="section-icon">👤</span>
            Persoonlijke Gegevens
        </h2>
        <div class="info-grid">
            <div class="info-item">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    Volledige Naam
                </label>
                <span>{{ $user->name }}</span>
            </div>
            <div class="info-item">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    E-mailadres
                </label>
                <span>{{ $user->email }}</span>
            </div>
            <div class="info-item">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                    Studentnummer
                </label>
                <span class="{{ $user->student_number ? '' : 'not-set' }}">{{ $user->student_number ?? 'Niet ingesteld' }}</span>
            </div>
            <div class="info-item">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                    Klas
                </label>
                <span class="{{ $user->class ? '' : 'not-set' }}">{{ $user->class ?? 'Niet ingesteld' }}</span>
            </div>
            <div class="info-item">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10v6M2 10l10-5 10 5-10 5z"></path><path d="M6 12v5c3 3 9 3 12 0v-5"></path></svg>
                    Opleiding
                </label>
                <span class="{{ $user->opleiding ? '' : 'not-set' }}">{{ $user->opleiding ?? 'Niet ingesteld' }}</span>
            </div>
            <div class="info-item">
                <label>
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"></path></svg>
                    Rol
                </label>
                <span style="text-transform: capitalize;">{{ $user->role }}</span>
            </div>
        </div>
    </div>

    <div class="profile-section">
        <h2>
            <span class="section-icon">📚</span>
            Mijn Keuzedelen
        </h2>
        @if($keuzedelen->count() > 0)
            <div class="keuzedeel-list">
                @foreach($keuzedelen as $keuzedeel)
                    <div class="keuzedeel-item">
                        <div class="keuzedeel-item-info">
                            <h3>{{ $keuzedeel->naam }}</h3>
                            <p>{{ $keuzedeel->code }} • {{ $keuzedeel->studiepunten }} studiepunten</p>
                        </div>
                        <span class="keuzedeel-status status-{{ $keuzedeel->pivot->status }}">
                            {{ ucfirst($keuzedeel->pivot->status) }}
                        </span>
                    </div>
                @endforeach
            </div>
        @else
            <div class="no-keuzedelen">
                <p>Je hebt nog geen keuzedelen gekozen.</p>
                <a href="{{ route('keuzedelen.index') }}">Bekijk beschikbare keuzedelen →</a>
            </div>
        @endif
    </div>
</div>
@endsection
