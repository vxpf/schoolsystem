@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('styles')
<style>
    .admin-header {
        background: linear-gradient(135deg, var(--primary-dark) 0%, var(--primary) 100%);
        padding: 1.25rem 1.75rem;
        border-radius: var(--radius-lg);
        margin-bottom: 1.25rem;
        box-shadow: var(--shadow);
    }

    .admin-header h1 {
        font-size: 1.5rem;
        margin-bottom: 0.25rem;
        color: #ffffff;
        font-weight: 800;
        letter-spacing: -0.5px;
    }

    .admin-header h1 span {
        color: var(--accent-light);
    }

    .admin-header p {
        color: var(--text-muted);
        font-size: 0.9rem;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .stat-card {
        background: var(--bg-card);
        padding: 1.25rem;
        border-radius: var(--radius);
        border: 1px solid var(--border);
        box-shadow: var(--shadow);
        transition: all 0.2s ease;
    }

    .stat-card:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .stat-card h3 {
        font-size: 0.7rem;
        color: var(--text-muted);
        margin-bottom: 0.5rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }

    .stat-card .stat-value {
        font-size: 2rem;
        font-weight: 800;
        color: var(--text-dark);
        letter-spacing: -1px;
    }

    .stat-card .stat-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, rgba(212, 160, 36, 0.1) 0%, rgba(212, 160, 36, 0.2) 100%);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent);
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .admin-actions {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1rem;
        margin-top: 1.5rem;
    }

    .action-card {
        background: var(--bg-card);
        padding: 1.5rem;
        border-radius: var(--radius-lg);
        border: 1px solid var(--border);
        text-decoration: none;
        color: var(--text-primary);
        transition: all 0.2s ease;
        box-shadow: var(--shadow);
    }

    .action-card:hover {
        transform: translateY(-2px);
        border-color: var(--accent);
        box-shadow: var(--shadow-md);
    }

    .action-card h3 {
        font-size: 1rem;
        margin-bottom: 0.35rem;
        color: var(--text-dark);
        font-weight: 700;
    }

    .action-card p {
        color: var(--text-secondary);
        font-size: 0.85rem;
        line-height: 1.5;
    }

    .warning-section {
        margin-bottom: 1.25rem;
    }

    .warning-card {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1) 0%, var(--bg-card) 100%);
        border: 2px solid var(--warning);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        box-shadow: var(--shadow);
    }

    .warning-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .warning-icon {
        width: 48px;
        height: 48px;
        background: var(--warning-bg);
        border-radius: var(--radius-lg);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--warning);
        font-size: 1.5rem;
    }

    .warning-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: var(--text-dark);
    }

    .warning-subtitle {
        font-size: 0.9rem;
        color: var(--text-secondary);
    }

    .warning-list {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .warning-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1rem;
        background: var(--bg-card);
        border-radius: var(--radius);
        border: 1px solid var(--border);
    }

    .warning-item-info h4 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.25rem;
    }

    .warning-item-info p {
        font-size: 0.85rem;
        color: var(--text-muted);
    }

    .warning-badge {
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.8rem;
        font-weight: 600;
        background: var(--warning-bg);
        color: #b45309;
    }

    .charts-section {
        margin-top: 1.5rem;
    }

    .section-title-charts {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 1rem;
    }

    .charts-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1.25rem;
        margin-bottom: 1.5rem;
    }

    .chart-card {
        background: var(--bg-card);
        border-radius: var(--radius-lg);
        padding: 1.25rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
    }

    .chart-card h3 {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-dark);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid var(--border-light);
    }

    .chart-container {
        position: relative;
        height: 220px;
    }

    .chart-container.small {
        height: 180px;
    }

    @media (max-width: 1024px) {
        .charts-grid {
            grid-template-columns: 1fr;
        }
        
        .chart-container {
            height: 250px;
        }
    }
</style>
@endsection

@section('content')
<div class="admin-header">
    <h1>Admin <span>Dashboard</span></h1>
    <p>Welkom in het administratiepaneel</p>
</div>

@if($keuzedelenMetWeinigInschrijvingen->count() > 0)
<div class="warning-section">
    <div class="warning-card">
        <div class="warning-header">
            <div class="warning-icon">⚠️</div>
            <div>
                <div class="warning-title">Keuzedelen met te weinig inschrijvingen</div>
                <div class="warning-subtitle">{{ $keuzedelenMetWeinigInschrijvingen->count() }} keuzedeel(en) hebben minder dan 30% inschrijvingen</div>
            </div>
        </div>
        <div class="warning-list">
            @foreach($keuzedelenMetWeinigInschrijvingen as $keuzedeel)
            @php
                $percentage = $keuzedeel->max_studenten > 0 ? round(($keuzedeel->users_count / $keuzedeel->max_studenten) * 100) : 0;
            @endphp
            <div class="warning-item">
                <div class="warning-item-info">
                    <h4>{{ $keuzedeel->naam }}</h4>
                    <p>{{ $keuzedeel->code }} • {{ $keuzedeel->users_count }} / {{ $keuzedeel->max_studenten }} studenten ({{ $percentage }}%)</p>
                </div>
                <div style="display: flex; gap: 0.5rem; align-items: center;">
                    <span class="warning-badge">{{ $percentage }}% bezet</span>
                    <form action="{{ route('admin.keuzedelen.annuleer', $keuzedeel) }}" method="POST" onsubmit="return confirm('Weet je zeker dat je dit keuzedeel wilt annuleren? Studenten worden automatisch verplaatst naar hun volgende keuze indien beschikbaar.');">
                        @csrf
                        <button type="submit" style="padding: 0.5rem 1rem; border-radius: 8px; background: var(--danger); color: white; border: none; cursor: pointer; font-weight: 600; font-size: 0.8rem; transition: all 0.2s ease;">
                            Annuleer keuzedeel
                        </button>
                    </form>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endif

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

<div class="charts-section">
    <h2 class="section-title-charts">📊 Statistieken & Analyses</h2>
    
    <div class="charts-grid">
        <div class="chart-card">
            <h3>Inschrijvingen per Keuzedeel</h3>
            <div class="chart-container">
                <canvas id="inschrijvingenChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h3>Status Verdeling</h3>
            <div class="chart-container small">
                <canvas id="statusChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h3>Bezettingsgraad</h3>
            <div class="chart-container">
                <canvas id="bezettingChart"></canvas>
            </div>
        </div>

        <div class="chart-card">
            <h3>Inschrijvingen per Periode</h3>
            <div class="chart-container small">
                <canvas id="periodeChart"></canvas>
            </div>
        </div>
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

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Kleurenschema
    const colors = {
        primary: '#1e293b',
        accent: '#d4a024',
        success: '#10b981',
        warning: '#f59e0b',
        danger: '#ef4444',
        info: '#3b82f6'
    };

    // 1. Inschrijvingen per Keuzedeel
    const inschrijvingenData = @json($inschrijvingenPerKeuzedeel);
    if (inschrijvingenData && inschrijvingenData.length > 0) {
        new Chart(document.getElementById('inschrijvingenChart'), {
            type: 'bar',
            data: {
                labels: inschrijvingenData.map(k => k.code),
                datasets: [{
                    label: 'Inschrijvingen',
                    data: inschrijvingenData.map(k => k.count),
                    backgroundColor: colors.accent,
                    borderColor: colors.primary,
                    borderWidth: 1
                }, {
                    label: 'Maximum',
                    data: inschrijvingenData.map(k => k.max),
                    backgroundColor: 'rgba(30, 41, 59, 0.2)',
                    borderColor: colors.primary,
                    borderWidth: 1,
                    borderDash: [5, 5]
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top'
                    },
                    tooltip: {
                        callbacks: {
                            title: function(context) {
                                const index = context[0].dataIndex;
                                return inschrijvingenData[index].naam;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    }

    // 2. Status Verdeling
    const statusData = @json($statusVerdeling);
    const statusLabels = {
        'aangemeld': 'Aangemeld',
        'goedgekeurd': 'Goedgekeurd',
        'afgewezen': 'Afgewezen',
        'voltooid': 'Voltooid'
    };
    const statusColors = {
        'aangemeld': colors.warning,
        'goedgekeurd': colors.success,
        'afgewezen': colors.danger,
        'voltooid': colors.info
    };

    if (statusData && Object.keys(statusData).length > 0) {
        new Chart(document.getElementById('statusChart'), {
            type: 'doughnut',
            data: {
                labels: Object.keys(statusData).map(s => statusLabels[s] || s),
                datasets: [{
                    data: Object.values(statusData),
                    backgroundColor: Object.keys(statusData).map(s => statusColors[s] || colors.primary),
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }

    // 3. Bezettingsgraad
    const bezettingData = @json($bezettingsgraad);
    if (bezettingData && bezettingData.length > 0) {
        new Chart(document.getElementById('bezettingChart'), {
            type: 'bar',
            data: {
                labels: bezettingData.map(k => k.naam.length > 30 ? k.naam.substring(0, 30) + '...' : k.naam),
                datasets: [{
                    label: 'Bezetting %',
                    data: bezettingData.map(k => k.percentage),
                    backgroundColor: bezettingData.map(k => {
                        if (k.percentage >= 100) return colors.danger;
                        if (k.percentage >= 75) return colors.warning;
                        if (k.percentage >= 30) return colors.success;
                        return colors.info;
                    }),
                    borderWidth: 1
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const index = context.dataIndex;
                                const item = bezettingData[index];
                                return `${item.percentage}% (${item.count}/${item.max} studenten)`;
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        beginAtZero: true,
                        max: 100,
                        ticks: {
                            callback: function(value) {
                                return value + '%';
                            }
                        }
                    }
                }
            }
        });
    }

    // 4. Inschrijvingen per Periode
    const periodeData = @json($inschrijvingenPerPeriode);
    if (periodeData && Object.keys(periodeData).length > 0) {
        new Chart(document.getElementById('periodeChart'), {
            type: 'pie',
            data: {
                labels: Object.keys(periodeData).map(p => p || 'Geen periode'),
                datasets: [{
                    data: Object.values(periodeData),
                    backgroundColor: [
                        colors.accent,
                        colors.primary,
                        colors.success,
                        colors.info,
                        colors.warning,
                        colors.danger
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
</script>
@endsection
