@extends('layouts.app')

@section('title', 'Studenten Overzicht')

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
        grid-template-columns: 2fr 2fr 1.5fr 1fr 1fr;
        gap: 1rem;
        font-weight: 600;
        color: #d4a024;
        font-size: 0.9rem;
    }

    .table-row {
        padding: 1.5rem;
        display: grid;
        grid-template-columns: 2fr 2fr 1.5fr 1fr 1fr;
        gap: 1rem;
        align-items: center;
        border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.2s;
    }

    .table-row:hover {
        background: rgba(255, 255, 255, 0.03);
    }

    .table-row:last-child {
        border-bottom: none;
    }

    .student-name {
        font-weight: 500;
        color: #fff;
    }

    .student-email {
        color: rgba(255, 255, 255, 0.8);
        font-size: 0.95rem;
    }

    .student-info {
        color: rgba(255, 255, 255, 0.7);
        font-size: 0.9rem;
    }

    .student-badge {
        display: inline-block;
        background: rgba(212, 160, 36, 0.2);
        padding: 0.4rem 0.8rem;
        border-radius: 6px;
        font-size: 0.85rem;
        color: #d4a024;
        font-weight: 500;
    }

    .no-students {
        padding: 3rem;
        text-align: center;
        color: rgba(255, 255, 255, 0.6);
        font-style: italic;
    }

    .search-box {
        margin-bottom: 1.5rem;
    }

    .search-input {
        width: 100%;
        max-width: 400px;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        border: 1px solid rgba(212, 160, 36, 0.3);
        background: rgba(0, 0, 0, 0.3);
        color: #fff;
        font-size: 0.95rem;
    }

    .search-input:focus {
        outline: none;
        border-color: #d4a024;
        background: rgba(0, 0, 0, 0.4);
    }

    .search-input::placeholder {
        color: rgba(255, 255, 255, 0.5);
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
    <h1>👥 Studenten Overzicht</h1>
    <p style="color: rgba(255, 255, 255, 0.8);">Overzicht van alle geregistreerde studenten</p>
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
