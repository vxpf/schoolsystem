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

    .back-link,
    .back-link:visited,
    .back-link:link {
        display: inline-flex;
        align-items: center;
        gap: 0.6rem;
        color: #ffffff !important;
        text-decoration: none;
        margin-bottom: 1.5rem;
        font-weight: 600;
        font-size: 0.9rem;
        padding: 0.7rem 1.4rem;
        background: linear-gradient(135deg, #2d4a3e 0%, #3d5a4d 100%);
        border: none;
        border-radius: 10px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        box-shadow: 0 2px 8px rgba(45, 74, 62, 0.3);
        letter-spacing: 0.3px;
    }

    .back-link:hover {
        color: #ffffff !important;
        background: linear-gradient(135deg, #3d5a4d 0%, #4a6b5c 100%);
        transform: translateX(-4px);
        box-shadow: 0 4px 12px rgba(45, 74, 62, 0.4);
    }

    .back-link svg {
        transition: transform 0.3s ease;
        opacity: 0.9;
    }

    .back-link:hover svg {
        transform: translateX(-3px);
        opacity: 1;
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
        background: #1a1a1a;
        color: #fff;
        font-size: 0.9rem;
    }

    .status-select:focus {
        outline: none;
        border-color: #d4a024;
        background: #222222;
    }

    .status-select option {
        background: #1a1a1a;
        color: #fff;
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

    /* Custom Delete Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.75);
        backdrop-filter: blur(4px);
        z-index: 1000;
        animation: fadeIn 0.2s ease-out;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px) scale(0.95);
        }
        to {
            opacity: 1;
            transform: translateY(0) scale(1);
        }
    }

    .modal-content {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        border-radius: 16px;
        padding: 0;
        max-width: 480px;
        width: 90%;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
        border: 1px solid rgba(212, 160, 36, 0.2);
        animation: slideUp 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        overflow: hidden;
    }

    .modal-header {
        padding: 2rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
    }

    .modal-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 2px;
        background: linear-gradient(90deg, var(--accent), var(--accent-light));
    }

    .modal-icon {
        width: 64px;
        height: 64px;
        background: rgba(239, 68, 68, 0.15);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 1rem;
        border: 2px solid rgba(239, 68, 68, 0.3);
    }

    .modal-icon svg {
        width: 32px;
        height: 32px;
        color: #ef4444;
    }

    .modal-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #ffffff;
        text-align: center;
        margin-bottom: 0.5rem;
    }

    .modal-body {
        padding: 2rem;
        text-align: center;
    }

    .modal-text {
        color: rgba(255, 255, 255, 0.8);
        font-size: 1rem;
        line-height: 1.6;
        margin-bottom: 0.5rem;
    }

    .modal-student-name {
        color: var(--accent-light);
        font-weight: 600;
        font-size: 1.1rem;
    }

    .modal-footer {
        padding: 1.5rem 2rem;
        background: rgba(0, 0, 0, 0.2);
        display: flex;
        gap: 1rem;
        justify-content: center;
    }

    .modal-btn {
        padding: 0.75rem 2rem;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .modal-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .modal-btn:hover::before {
        left: 100%;
    }

    .modal-btn-cancel {
        background: rgba(255, 255, 255, 0.1);
        color: #ffffff;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .modal-btn-cancel:hover {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(255, 255, 255, 0.3);
    }

    .modal-btn-delete {
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%);
        color: #ffffff;
        box-shadow: 0 4px 15px rgba(239, 68, 68, 0.3);
    }

    .modal-btn-delete:hover {
        box-shadow: 0 8px 25px rgba(239, 68, 68, 0.4);
        transform: translateY(-2px);
    }

    .modal-btn-delete:active {
        transform: translateY(0);
    }

    .eerder-badge-inline {
        display: inline-block;
        margin-left: 0.5rem;
        padding: 2px 8px;
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
        color: white;
        border-radius: 12px;
        font-size: 0.7rem;
        font-weight: 600;
        white-space: nowrap;
    }
</style>
@endsection

@section('content')
<a href="{{ route('admin.enrollments') }}" class="back-link">
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <line x1="19" y1="12" x2="5" y2="12"/>
        <polyline points="12 19 5 12 12 5"/>
    </svg>
    Terug naar Inschrijvingen
</a>

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
        <div>Cijfer</div>
        <div>Acties</div>
    </div>

    @forelse($students as $student)
        <div class="table-row">
            <div class="student-cell">
                <span class="student-name">
                    {{ $student->name }}
                    @if($student->pivot->eerder_gedaan)
                        <span class="eerder-badge-inline">
                            @if($student->pivot->eerder_markering === 'x')
                                ✓ Gekoppeld
                            @elseif($student->pivot->eerder_markering === 'pv')
                                ⚠ Poging Vergeven
                            @else
                                ✓ Eerder gedaan
                            @endif
                        </span>
                    @endif
                </span>
                <span class="student-email">{{ $student->email }}</span>
                <span class="enrollment-date" style="margin-top: 0.25rem;">
                    Ingeschreven: {{ $student->pivot->created_at->format('d-m-Y H:i') }}
                </span>
            </div>
            <div>{{ $student->student_number }}</div>
            <div>{{ $student->class }}</div>
            <div>
                <form action="{{ route('admin.enrollments.update-status', [$keuzedeel, $student]) }}" method="POST" style="display: inline;" id="status-form-{{ $student->id }}">
                    @csrf
                    @method('PATCH')
                    <select name="status" class="status-select" onchange="document.getElementById('status-form-{{ $student->id }}').submit()">
                        <option value="aangemeld" {{ $student->pivot->status == 'aangemeld' ? 'selected' : '' }}>Aangemeld</option>
                        <option value="goedgekeurd" {{ $student->pivot->status == 'goedgekeurd' ? 'selected' : '' }}>Goedgekeurd</option>
                        <option value="afgewezen" {{ $student->pivot->status == 'afgewezen' ? 'selected' : '' }}>Afgewezen</option>
                        <option value="voltooid" {{ $student->pivot->status == 'voltooid' ? 'selected' : '' }}>Voltooid</option>
                    </select>
                </form>
            </div>
            <div>
                <form action="{{ route('admin.enrollments.update-status', [$keuzedeel, $student]) }}" method="POST" style="display: flex; gap: 0.5rem; align-items: center;" id="cijfer-form-{{ $student->id }}">
                    @csrf
                    @method('PATCH')
                    <input type="hidden" name="status" value="{{ $student->pivot->status }}">
                    <input type="number" name="cijfer" class="status-select" style="width: 80px;" min="1" max="10" step="0.1" value="{{ $student->pivot->cijfer ?? '' }}" placeholder="-">
                    <button type="submit" class="btn-small" style="padding: 0.4rem 0.8rem; background: var(--accent); color: var(--primary-dark); border: none; border-radius: 6px; cursor: pointer; font-weight: 600;">Opslaan</button>
                </form>
            </div>
            <div class="action-buttons">
                <form action="{{ route('admin.enrollments.remove', [$keuzedeel, $student]) }}" method="POST" class="delete-form" data-student-name="{{ $student->name }}">
                    @csrf
                    @method('DELETE')
                    <button type="button" class="btn-small btn-delete delete-btn">Verwijderen</button>
                </form>
            </div>
        </div>
    @empty
        <div class="no-students">
            Nog geen studenten ingeschreven voor dit keuzedeel.
        </div>
    @endforelse
</div>

<!-- Delete Confirmation Modal -->
<div class="modal-overlay" id="deleteModal">
    <div class="modal-content">
        <div class="modal-header">
            <div class="modal-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h2 class="modal-title">Inschrijving Verwijderen</h2>
        </div>
        <div class="modal-body">
            <p class="modal-text">Weet je zeker dat je de inschrijving van</p>
            <p class="modal-student-name" id="modalStudentName"></p>
            <p class="modal-text">wilt verwijderen? Deze actie kan niet ongedaan worden gemaakt.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="modal-btn modal-btn-cancel" onclick="closeDeleteModal()">Annuleren</button>
            <button type="button" class="modal-btn modal-btn-delete" id="confirmDeleteBtn">Verwijderen</button>
        </div>
    </div>
</div>

<script>
let currentForm = null;

document.addEventListener('DOMContentLoaded', function() {
    const deleteButtons = document.querySelectorAll('.delete-btn');
    
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            currentForm = this.closest('.delete-form');
            const studentName = currentForm.dataset.studentName;
            
            document.getElementById('modalStudentName').textContent = studentName;
            document.getElementById('deleteModal').classList.add('active');
        });
    });
    
    document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
        if (currentForm) {
            currentForm.submit();
        }
    });
    
    // Close modal when clicking outside
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeDeleteModal();
        }
    });
});

function closeDeleteModal() {
    document.getElementById('deleteModal').classList.remove('active');
    currentForm = null;
}
</script>
@endsection
