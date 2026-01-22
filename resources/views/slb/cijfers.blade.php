@extends('layouts.app')

@section('title', 'Studenten Cijfers')

@section('styles')
<style>
    .cijfers-header {
        background: linear-gradient(135deg, rgba(45, 74, 62, 0.95) 0%, rgba(58, 90, 74, 0.95) 100%),
                    url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1200 400"><defs><pattern id="tech-grid" x="0" y="0" width="100" height="100" patternUnits="userSpaceOnUse"><rect width="100" height="100" fill="transparent"/><circle cx="50" cy="50" r="1" fill="%23d4a024" opacity="0.3"/><path d="M0 50 L100 50 M50 0 L50 100" stroke="%23d4a024" stroke-width="0.2" opacity="0.2"/></pattern></defs><rect width="100%" height="100%" fill="url(%23tech-grid)"/></svg>');
        background-size: cover;
        padding: 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 2rem;
        box-shadow: var(--shadow-lg);
        color: #fff;
    }

    .cijfers-header h1 {
        font-size: 2rem;
        font-weight: 800;
        margin-bottom: 0.5rem;
    }

    .cijfers-header h1 span {
        color: var(--accent-light);
    }

    .cijfers-header p {
        color: rgba(255, 255, 255, 0.85);
        font-size: 1rem;
    }

    .cijfers-container {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        padding: 2rem;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .cijfers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cijfers-table thead tr {
        border-bottom: 2px solid var(--border);
    }

    .cijfers-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 700;
        color: var(--text-dark);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .cijfers-table tbody tr {
        border-bottom: 1px solid var(--border-light);
        transition: background 0.2s ease;
    }

    .cijfers-table tbody tr:hover {
        background: var(--bg-light);
    }

    .cijfers-table td {
        padding: 1rem;
        color: var(--text-primary);
    }

    .student-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .keuzedeel-name {
        font-weight: 600;
        color: var(--primary);
    }

    .cijfer-form {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }

    .cijfer-input {
        width: 80px;
        padding: 0.6rem;
        border: 2px solid var(--border);
        border-radius: 8px;
        text-align: center;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.2s ease;
    }

    .cijfer-input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(212, 160, 36, 0.1);
    }

    .cijfer-badge {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        border-radius: 8px;
        font-weight: 700;
        font-size: 1.1rem;
        box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
    }

    .btn-save {
        padding: 0.6rem 1.2rem;
        background: linear-gradient(135deg, var(--accent) 0%, var(--accent-light) 100%);
        color: var(--primary-dark);
        border: none;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
        box-shadow: 0 2px 8px rgba(212, 160, 36, 0.3);
    }

    .btn-save:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(212, 160, 36, 0.4);
    }

    .alert {
        padding: 1rem 1.5rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-weight: 500;
    }

    .alert-success {
        background: var(--success-bg);
        border: 1px solid var(--success);
        color: #047857;
    }

    .alert-error {
        background: var(--danger-bg);
        border: 1px solid var(--danger);
        color: #b91c1c;
    }

    .no-data {
        text-align: center;
        padding: 3rem;
        color: var(--text-muted);
    }

    @media (max-width: 768px) {
        .cijfers-table {
            display: block;
            overflow-x: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="cijfers-header">
    <h1>📊 Studenten <span>Cijfers</span></h1>
    <p>Bekijk alle studenten en geef cijfers aan voltooide keuzedelen</p>
</div>

@if(session('success'))
<div class="alert alert-success">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
        <polyline points="22 4 12 14.01 9 11.01"/>
    </svg>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-error">
    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <circle cx="12" cy="12" r="10"/>
        <line x1="15" y1="9" x2="9" y2="15"/>
        <line x1="9" y1="9" x2="15" y2="15"/>
    </svg>
    {{ session('error') }}
</div>
@endif

<div class="cijfers-container">
    @if($studenten->count() > 0)
    <table class="cijfers-table">
        <thead>
            <tr>
                <th>Student</th>
                <th>Studentnummer</th>
                <th>Klas</th>
                <th>Keuzedeel</th>
                <th style="text-align: center;">Status</th>
                <th style="text-align: center;">Cijfer</th>
            </tr>
        </thead>
        <tbody>
            @foreach($studenten as $student)
                @foreach($student->keuzedelen as $keuzedeel)
                <tr style="{{ $keuzedeel->pivot->status === 'voltooid' ? 'background: rgba(212, 160, 36, 0.05);' : '' }}">
                    <td class="student-name">{{ $student->name }}</td>
                    <td>{{ $student->student_number }}</td>
                    <td>{{ $student->class }}</td>
                    <td class="keuzedeel-name">{{ $keuzedeel->naam }}</td>
                    <td style="text-align: center;">
                        <span style="display: inline-block; padding: 0.4rem 0.8rem; border-radius: 20px; font-size: 0.85rem; font-weight: 600; 
                            @if($keuzedeel->pivot->status == 'voltooid') background: var(--info-bg); color: #1d4ed8;
                            @elseif($keuzedeel->pivot->status == 'goedgekeurd') background: var(--success-bg); color: #047857;
                            @elseif($keuzedeel->pivot->status == 'afgewezen') background: var(--danger-bg); color: #b91c1c;
                            @else background: var(--warning-bg); color: #b45309;
                            @endif">
                            {{ ucfirst($keuzedeel->pivot->status) }}
                        </span>
                    </td>
                    <td style="text-align: center;">
                        @if($keuzedeel->pivot->status === 'voltooid')
                            @if($keuzedeel->pivot->cijfer)
                                <div style="display: flex; align-items: center; justify-content: center; gap: 0.5rem;">
                                    <span class="cijfer-badge">{{ number_format($keuzedeel->pivot->cijfer, 1) }}</span>
                                    <form action="{{ route('slb.update-cijfer', [$keuzedeel, $student]) }}" method="POST" class="cijfer-form">
                                        @csrf
                                        @method('PATCH')
                                        <input type="number" name="cijfer" class="cijfer-input" min="1" max="10" step="0.1" value="{{ $keuzedeel->pivot->cijfer }}" required>
                                        <button type="submit" class="btn-save">Wijzigen</button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('slb.update-cijfer', [$keuzedeel, $student]) }}" method="POST" class="cijfer-form" style="justify-content: center;">
                                    @csrf
                                    @method('PATCH')
                                    <input type="number" name="cijfer" class="cijfer-input" min="1" max="10" step="0.1" placeholder="Cijfer" required>
                                    <button type="submit" class="btn-save">Opslaan</button>
                                </form>
                            @endif
                        @else
                            <span style="color: var(--text-muted); font-size: 0.9rem;">Nog niet voltooid</span>
                        @endif
                    </td>
                </tr>
                @endforeach
            @endforeach
        </tbody>
    </table>
    @else
    <div class="no-data">
        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="margin: 0 auto 1rem; opacity: 0.3;">
            <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z"/>
        </svg>
        <h3 style="color: var(--text-dark); margin-bottom: 0.5rem;">Geen voltooide keuzedelen</h3>
        <p>Er zijn nog geen studenten met voltooide keuzedelen om cijfers aan te geven.</p>
    </div>
    @endif
</div>
@endsection
