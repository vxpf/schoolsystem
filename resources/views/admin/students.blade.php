@extends('layouts.app')

@section('title', 'Studenten Overzicht')

@section('styles')
<style>
    .back-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: var(--accent);
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.2s ease;
    }

    .back-link:hover {
        color: var(--accent-light);
        transform: translateX(-4px);
    }

    .admin-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 2rem;
        border-radius: var(--radius-xl);
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: var(--shadow-lg);
    }

    .admin-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, var(--accent) 0%, var(--accent-light) 100%);
    }

    .admin-header h1 {
        font-size: 1.75rem;
        margin-bottom: 0.5rem;
        color: #ffffff;
        font-weight: 800;
    }

    .admin-header p {
        color: var(--text-muted);
        font-size: 0.95rem;
    }

    .search-box {
        margin-bottom: 1.5rem;
    }

    .search-input {
        width: 100%;
        max-width: 450px;
        padding: 1rem 1.25rem;
        border-radius: var(--radius-lg);
        border: 2px solid var(--border);
        background: var(--bg-card);
        color: var(--text-primary);
        font-size: 0.95rem;
        transition: all 0.2s ease;
        box-shadow: var(--shadow-sm);
    }

    .search-input:focus {
        outline: none;
        border-color: var(--accent);
        box-shadow: 0 0 0 3px rgba(212, 160, 36, 0.1);
    }

    .search-input::placeholder {
        color: var(--text-muted);
    }

    .students-table {
        background: var(--bg-card);
        border-radius: var(--radius-xl);
        overflow: hidden;
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
    }

    .table-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 1rem 1.5rem;
        display: grid;
        grid-template-columns: 2fr 2fr 1.5fr 1fr 1fr;
        gap: 1rem;
        font-weight: 600;
        color: var(--accent-light);
        font-size: 0.8rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table-row {
        padding: 1.25rem 1.5rem;
        display: grid;
        grid-template-columns: 2fr 2fr 1.5fr 1fr 1fr;
        gap: 1rem;
        align-items: center;
        border-bottom: 1px solid var(--border-light);
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: var(--bg-light);
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .student-name {
        font-weight: 600;
        color: var(--text-dark);
    }

    .student-email {
        color: var(--text-secondary);
        font-size: 0.9rem;
    }

    .student-info {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .student-badge {
        display: inline-block;
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.2) 100%);
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        color: var(--accent);
        font-weight: 600;
    }

    .no-students {
        padding: 3rem;
        text-align: center;
        color: var(--text-muted);
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
<a href="{{ route('admin.dashboard') }}" class="back-link">← Terug naar Dashboard</a>

<div class="admin-header">
    <h1>Studenten Overzicht</h1>
    <p>Overzicht van alle geregistreerde studenten</p>
</div>

<div class="search-box">
    <input type="text" id="searchInput" class="search-input" placeholder="Zoek op naam, email of studentnummer...">
</div>

<div class="students-table">
    <div class="table-header">
        <div>Naam</div>
        <div>Email</div>
        <div>Studentnummer</div>
        <div>Klas</div>
        <div>Keuzedelen</div>
    </div>

    <div id="studentsList">
        @forelse($students as $student)
            <div class="table-row" data-search="{{ strtolower($student->name . ' ' . $student->email . ' ' . $student->student_number) }}">
                <div class="student-name">{{ $student->name }}</div>
                <div class="student-email">{{ $student->email }}</div>
                <div class="student-info">{{ $student->student_number }}</div>
                <div class="student-info">{{ $student->class ?? 'N/A' }}</div>
                <div>
                    <span class="student-badge">{{ $student->keuzedelen_count }} keuzedelen</span>
                </div>
            </div>
        @empty
            <div class="no-students">
                Geen studenten gevonden.
            </div>
        @endforelse
    </div>
</div>

<script>
    document.getElementById('searchInput').addEventListener('input', function(e) {
        const searchTerm = e.target.value.toLowerCase();
        const rows = document.querySelectorAll('.table-row');
        
        rows.forEach(row => {
            const searchData = row.getAttribute('data-search');
            if (searchData && searchData.includes(searchTerm)) {
                row.style.display = 'grid';
            } else {
                row.style.display = 'none';
            }
        });
    });
</script>
@endsection
