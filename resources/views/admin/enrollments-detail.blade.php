@extends('layouts.app')

@section('title', 'Inschrijvingen - ' . $keuzedeel->naam)

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

    .keuzedeel-info {
        background: rgba(255, 255, 255, 0.05);
        padding: 1.5rem;
        border-radius: 12px;
        margin-bottom: 2rem;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .keuzedeel-info-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1rem;
        margin-top: 1rem;
    }

    .info-item {
        display: flex;
        flex-direction: column;
    }

    .info-label {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
        margin-bottom: 0.25rem;
    }

    .info-value {
        font-weight: 600;
        color: #fff;
    }

    .students-table {
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid rgba(212, 160, 36, 0.2);
    }

    .table-header {
        background: rgba(212, 160, 36, 0.1);
        padding: 1rem 1.5rem;
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr 1fr 1.5fr;
        gap: 1rem;
        font-weight: 600;
        color: #d4a024;
        font-size: 0.9rem;
    }

    .table-row {
        padding: 1.5rem;
        display: grid;
        grid-template-columns: 2fr 1.5fr 1fr 1fr 1.5fr;
        gap: 1rem;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .student-cell {
        display: flex;
        flex-direction: column;
    }

    .student-name {
        font-weight: 500;
        color: #fff;
        margin-bottom: 0.25rem;
    }

    .student-email {
        font-size: 0.85rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .status-select {
        padding: 0.5rem;
        border-radius: 6px;
        border: 1px solid rgba(212, 160, 36, 0.3);
        background: rgba(0, 0, 0, 0.3);
        color: #fff;
        font-size: 0.9rem;
    }

    .status-select:focus {
        outline: none;
        border-color: #d4a024;
    }

    .action-buttons {
        display: flex;
        gap: 0.5rem;
    }

    .btn-small {
        padding: 0.4rem 0.8rem;
        font-size: 0.85rem;
        border-radius: 6px;
        border: none;
        cursor: pointer;
        font-weight: 500;
        transition: all 0.2s;
    }

    .btn-update {
        background: #d4a024;
        color: #fff;
    }

    .btn-update:hover {
        background: #b88a1e;
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.2);
        color: #f87171;
        border: 1px solid rgba(239, 68, 68, 0.3);
    }

    .btn-delete:hover {
        background: rgba(239, 68, 68, 0.3);
    }

    .enrollment-date {
        font-size: 0.9rem;
        color: rgba(255, 255, 255, 0.7);
    }

    .no-students {
        padding: 3rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
        font-style: italic;
    }

    @media (max-width: 1024px) {
        .table-header, .table-row {
            grid-template-columns: 1fr;
        }

        .table-header {
            display: none;
        }

        .table-row {
            gap: 0.5rem;
        }
    }
</style>
@endsection

@section('content')
<a href="{{ route('admin.enrollments') }}" class="back-link">← Terug naar Inschrijvingen</a>

<div class="admin-header">
    <h1>{{ $keuzedeel->naam }}</h1>
    <p style="color: rgba(255, 255, 255, 0.8);">{{ $keuzedeel->code }}</p>
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

<div class="keuzedeel-info">
    <h3 style="color: #d4a024; margin-bottom: 1rem;">Keuzedeel Informatie</h3>
    <div class="keuzedeel-info-grid">
        <div class="info-item">
            <span class="info-label">Niveau</span>
            <span class="info-value">{{ $keuzedeel->niveau }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Studiepunten</span>
            <span class="info-value">{{ $keuzedeel->studiepunten }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Inschrijvingen</span>
            <span class="info-value">{{ $students->count() }} / {{ $keuzedeel->max_studenten }}</span>
        </div>
        <div class="info-item">
            <span class="info-label">Status</span>
            <span class="info-value">{{ $keuzedeel->actief ? 'Actief' : 'Inactief' }}</span>
        </div>
    </div>
</div>

<div class="students-table">
    <div class="table-header">
        <div>Student</div>
        <div>Studentnummer</div>
        <div>Klas</div>
        <div>Status</div>
        <div>Acties</div>
    </div>

    @forelse($students as $student)
        <div class="table-row">
            <div class="student-cell">
                <span class="student-name">{{ $student->name }}</span>
                <span class="student-email">{{ $student->email }}</span>
                <span class="enrollment-date" style="margin-top: 0.25rem;">
                    Ingeschreven: {{ $student->pivot->created_at->format('d-m-Y H:i') }}
                </span>
            </div>
            <div>{{ $student->student_number }}</div>
            <div>{{ $student->class }}</div>
            <div>
                <form action="{{ route('admin.enrollments.update-status', [$keuzedeel, $student]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="status-select" onchange="this.form.submit()">
                        <option value="aangemeld" {{ $student->pivot->status == 'aangemeld' ? 'selected' : '' }}>Aangemeld</option>
                        <option value="goedgekeurd" {{ $student->pivot->status == 'goedgekeurd' ? 'selected' : '' }}>Goedgekeurd</option>
                        <option value="afgewezen" {{ $student->pivot->status == 'afgewezen' ? 'selected' : '' }}>Afgewezen</option>
                        <option value="voltooid" {{ $student->pivot->status == 'voltooid' ? 'selected' : '' }}>Voltooid</option>
                    </select>
                </form>
            </div>
            <div class="action-buttons">
                <form action="{{ route('admin.enrollments.remove', [$keuzedeel, $student]) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je deze inschrijving wilt verwijderen?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-small btn-delete">Verwijderen</button>
                </form>
            </div>
        </div>
    @empty
        <div class="no-students">
            Nog geen studenten ingeschreven voor dit keuzedeel.
        </div>
    @endforelse
</div>
@endsection
