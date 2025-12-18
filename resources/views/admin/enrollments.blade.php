@extends('layouts.app')

@section('title', 'Inschrijvingen Beheren')

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

    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #d4a024;
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .back-link:hover {
        text-decoration: underline;
    }

    .keuzedeel-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .keuzedeel-card {
        background: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 12px;
        border: 1px solid rgba(212, 160, 36, 0.2);
        transition: all 0.3s ease;
    }

    .keuzedeel-card:hover {
        border-color: #d4a024;
        background: rgba(255, 255, 255, 0.08);
    }

    .keuzedeel-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1rem;
    }

    .keuzedeel-title {
        font-size: 1.3rem;
        font-weight: 600;
        color: #fff;
        margin-bottom: 0.3rem;
    }

    .keuzedeel-code {
        color: #d4a024;
        font-size: 0.9rem;
        font-weight: 500;
    }

    .keuzedeel-stats {
        display: flex;
        gap: 1.5rem;
        align-items: center;
    }

    .stat-badge {
        background: rgba(212, 160, 36, 0.2);
        padding: 0.5rem 1rem;
        border-radius: 6px;
        font-weight: 600;
        color: #d4a024;
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
        padding: 0.75rem;
        background: rgba(0, 0, 0, 0.2);
        border-radius: 6px;
    }

    .student-info {
        display: flex;
        flex-direction: column;
    }

    .student-name {
        font-weight: 500;
        color: #fff;
    }

    .student-details {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .status-badge {
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        font-weight: 500;
    }

    .status-aangemeld {
        background: rgba(59, 130, 246, 0.2);
        color: #60a5fa;
    }

    .status-goedgekeurd {
        background: rgba(34, 197, 94, 0.2);
        color: #4ade80;
    }

    .status-afgewezen {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
    }

    .status-voltooid {
        background: rgba(168, 85, 247, 0.2);
        color: #c084fc;
    }

    .view-all-link {
        display: inline-block;
        margin-top: 1rem;
        color: #d4a024;
        text-decoration: none;
        font-weight: 500;
    }

    .view-all-link:hover {
        text-decoration: underline;
    }

    .no-enrollments {
        color: rgba(255, 255, 255, 0.6);
        font-style: italic;
        padding: 1rem;
        text-align: center;
    }
</style>
@endsection

@section('content')
<a href="{{ route('admin.dashboard') }}" class="back-link">← Terug naar Dashboard</a>

<div class="admin-header">
    <h1>📊 Inschrijvingen per Keuzedeel</h1>
    <p style="color: rgba(255, 255, 255, 0.8);">Overzicht van alle studenten die zich hebben ingeschreven per vak</p>
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
        <div class="keuzedeel-card">
            <div class="keuzedeel-header">
                <div>
                    <div class="keuzedeel-title">{{ $keuzedeel->naam }}</div>
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
                                <span class="student-name">{{ $student->name }}</span>
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
