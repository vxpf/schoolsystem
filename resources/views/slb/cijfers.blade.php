@extends('layouts.app')

@section('title', 'Studenten Cijfers')

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

    .alert {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1rem;
        border-radius: 6px;
        margin-bottom: 1rem;
        font-size: 0.875rem;
    }

    .alert-success {
        background: #f0fdf4;
        border: 1px solid #bbf7d0;
        color: #166534;
    }

    .alert-error {
        background: #fef2f2;
        border: 1px solid #fecaca;
        color: #991b1b;
    }

    .alert svg {
        width: 16px;
        height: 16px;
        flex-shrink: 0;
    }

    .cijfers-table-container {
        background: var(--bg-card);
        border: 1px solid var(--border);
        border-radius: 8px;
        overflow: hidden;
    }

    .cijfers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cijfers-table thead {
        background: var(--bg-light);
    }

    .cijfers-table th {
        padding: 0.75rem 1rem;
        text-align: left;
        font-size: 0.75rem;
        font-weight: 600;
        color: var(--text-muted);
        text-transform: uppercase;
        letter-spacing: 0.5px;
        border-bottom: 1px solid var(--border);
    }

    .cijfers-table td {
        padding: 0.875rem 1rem;
        font-size: 0.875rem;
        color: var(--text-primary);
        border-bottom: 1px solid var(--border-light);
    }

    .cijfers-table tbody tr:last-child td {
        border-bottom: none;
    }

    .cijfers-table tbody tr:hover {
        background: var(--bg-light);
    }

    .student-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .keuzedeel-name {
        font-weight: 500;
        color: var(--text-dark);
    }

    .status-badge {
        display: inline-block;
        padding: 0.25rem 0.5rem;
        border-radius: 4px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-voltooid {
        background: #dbeafe;
        color: #1e40af;
    }

    .status-goedgekeurd {
        background: #dcfce7;
        color: #166534;
    }

    .status-afgewezen {
        background: #fee2e2;
        color: #991b1b;
    }

    .status-aangemeld {
        background: #fef3c7;
        color: #92400e;
    }

    .cijfer-form {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .cijfer-input {
        width: 70px;
        padding: 0.5rem;
        border: 1px solid var(--border);
        border-radius: 4px;
        text-align: center;
        font-weight: 600;
        font-size: 0.875rem;
    }

    .cijfer-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(45, 74, 62, 0.1);
    }

    .cijfer-display {
        display: inline-block;
        padding: 0.375rem 0.75rem;
        background: var(--bg-light);
        border-radius: 4px;
        font-weight: 700;
        font-size: 0.9375rem;
        color: var(--text-dark);
        min-width: 50px;
        text-align: center;
    }

    .btn-save {
        padding: 0.5rem 0.875rem;
        background: var(--primary);
        color: #fff;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-weight: 500;
        font-size: 0.8125rem;
        transition: background 0.15s ease;
    }

    .btn-save:hover {
        background: var(--primary-dark);
    }

    .empty-state {
        padding: 4rem 2rem;
        text-align: center;
    }

    .empty-state svg {
        width: 48px;
        height: 48px;
        color: var(--text-muted);
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        font-size: 1rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.5rem;
    }

    .empty-state p {
        font-size: 0.875rem;
        color: var(--text-muted);
    }

    .text-muted {
        color: var(--text-muted);
        font-size: 0.8125rem;
    }

    @media (max-width: 768px) {
        .cijfers-table-container {
            overflow-x: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="page-header">
    <h1>Cijfers beheren</h1>
    <p>Geef cijfers aan studenten met voltooide keuzedelen</p>
</div>

@if(session('success'))
<div class="alert alert-success">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <polyline points="20 6 9 17 4 12"/>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <line x1="15" y1="9" x2="9" y2="15"/>
        <line x1="9" y1="9" x2="15" y2="15"/>
    </svg>
    {{ session('error') }}
</div>
@endif

<div class="cijfers-table-container">
    @if($studenten->count() > 0)
    <table class="cijfers-table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Nummer</th>
                <th>Klas</th>
                <th>Keuzedeel</th>
                <th>Status</th>
                <th>Cijfer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studenten as $student)
                @foreach($student->keuzedelen as $keuzedeel)
                <tr>
                    <td class="student-name">{{ $student->name }}</td>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->class }}</td>
                    <td class="keuzedeel-name">{{ $keuzedeel->naam }}</td>
                    <td>
                        <span class="status-badge status-{{ $keuzedeel->pivot->status }}">
                            {{ ucfirst($keuzedeel->pivot->status) }}
                        </span>
                    </td>
                    <td>
                        @if($keuzedeel->pivot->status === 'voltooid')
                            @if($keuzedeel->pivot->cijfer)
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <span class="cijfer-display">{{ number_format($keuzedeel->pivot->cijfer, 1) }}</span>
                                    <form action="{{ route('slb.update-cijfer', [$keuzedeel, $student]) }}" method="POST" class="cijfer-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="cijfer" class="cijfer-input" min="1" max="10" step="0.1" value="{{ $keuzedeel->pivot->cijfer }}" required>
                                        <button type="submit" class="btn-save">Wijzig</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('slb.update-cijfer', [$keuzedeel, $student]) }}" method="POST" class="cijfer-form">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cijfer" class="cijfer-input" min="1" max="10" step="0.1" placeholder="-" required>
                                    <button type="submit" class="btn-save">Opslaan</button>
                                </form>
                            @endif
                        @else
                            <span class="text-muted">-</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    @else
    <div class="empty-state">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
            <polyline points="14 2 14 8 20 8"/>
            <line x1="16" y1="13" x2="8" y2="13"/>
            <line x1="16" y1="17" x2="8" y2="17"/>
        </svg>
        <h3>Geen gegevens</h3>
        <p>Er zijn nog geen studenten met keuzedelen om cijfers aan te geven.</p>
    </div>
    @endif
</div>
@endsection
