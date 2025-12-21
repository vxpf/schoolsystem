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
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        border-radius: var(--radius-xl);
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(212, 160, 36, 0.15) 0%, transparent 70%);
        pointer-events: none;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 50%, var(--accent) 100%);
    }

    .profile-avatar {
        width: 110px;
        height: 110px;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 800;
        color: var(--primary-dark);
        font-size: 2.5rem;
        flex-shrink: 0;
        box-shadow: 0 8px 32px rgba(212, 160, 36, 0.35);
        border: 4px solid rgba(255, 255, 255, 0.1);
    }

    .profile-info h1 {
        font-size: 1.85rem;
        margin-bottom: 0.5rem;
        font-weight: 800;
        color: #ffffff;
        letter-spacing: -0.5px;
    }

    .profile-info p {
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        font-size: 1rem;
    }

    .profile-role {
        display: inline-block;
        padding: 6px 16px;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: capitalize;
        margin-top: 0.75rem;
    }

    .profile-section {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        padding: 2rem;
        margin-bottom: 1.5rem;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .profile-section h2 {
        font-size: 1.2rem;
        margin-bottom: 1.5rem;
        color: var(--text-dark);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 700;
    }

    .profile-section h2 .section-icon {
        width: 40px;
        height: 40px;
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        border-radius: var(--radius-lg);
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
        
        .profile-header {
            flex-direction: column;
            text-align: center;
            gap: 1.5rem;
        }
    }

    @media (max-width: 500px) {
        .info-grid {
            grid-template-columns: 1fr;
        }
    }

    .info-item {
        padding: 1.25rem;
        background: var(--bg-light);
        border-radius: var(--radius-lg);
        border: 1px solid var(--border-light);
        transition: all 0.2s ease;
    }

    .info-item:hover {
        border-color: var(--accent);
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .info-item label {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.75px;
        font-weight: 600;
    }

    .info-item label svg {
        width: 14px;
        height: 14px;
        opacity: 0.6;
    }

    .info-item span {
        font-size: 1rem;
        color: var(--text-dark);
        font-weight: 600;
        display: block;
    }

    .info-item span.not-set {
        color: var(--text-muted);
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
        padding: 1.25rem;
        background: var(--bg-light);
        border-radius: var(--radius-lg);
        border-left: 4px solid var(--accent);
        transition: all 0.2s ease;
    }

    .keuzedeel-item:hover {
        transform: translateX(4px);
        box-shadow: var(--shadow);
    }

    .keuzedeel-item-info h3 {
        font-size: 1rem;
        margin-bottom: 0.25rem;
        color: var(--text-dark);
        font-weight: 600;
    }

    .keuzedeel-item-info p {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .keuzedeel-status {
        padding: 6px 14px;
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

    .no-keuzedelen {
        text-align: center;
        padding: 2.5rem;
        color: var(--text-muted);
    }

    .no-keuzedelen p {
        margin-bottom: 1rem;
    }

    .no-keuzedelen a {
        color: var(--accent);
        text-decoration: none;
        font-weight: 600;
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
