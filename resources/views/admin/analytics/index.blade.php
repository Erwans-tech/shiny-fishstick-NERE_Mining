@extends('admin.partials.layout')

@section('title', 'Statistiques du site')
@section('page-title', 'Statistiques')

@section('content')
<div class="admin-content-header analytics-header">
    <div>
        <div class="analytics-kicker">Pilotage du trafic</div>
        <h1>Statistiques du site</h1>
        <p class="admin-content-subtitle">Analyse du trafic et des performances</p>
    </div>
    <div class="analytics-actions">
        <a class="analytics-action" href="{{ route('admin.analytics.export', ['days' => $days]) }}" title="Télécharger les visites en CSV">↓ Exporter CSV</a>
        <button class="analytics-action analytics-refresh" type="button" title="Actualiser les données">↻ Actualiser</button>
        <div class="admin-filters">
            <form method="GET" class="filter-form">
                <select name="days" onchange="this.form.submit()" class="admin-select" aria-label="Période d'analyse">
                <option value="7" {{ $days == 7 ? 'selected' : '' }}>7 derniers jours</option>
                <option value="30" {{ $days == 30 ? 'selected' : '' }}>30 derniers jours</option>
                <option value="90" {{ $days == 90 ? 'selected' : '' }}>3 derniers mois</option>
                <option value="365" {{ $days == 365 ? 'selected' : '' }}>12 derniers mois</option>
                </select>
            </form>
        </div>
    </div>
</div>

{{-- Métriques principales --}}
<div class="analytics-summary">
<div class="admin-metrics-grid">
    <div class="metric-card admin-stat-tile" data-count="{{ $totalVisits }}">
        <div class="metric-icon">📈</div>
        <div class="metric-content">
            <div class="metric-value stat-value" data-count="{{ $totalVisits }}">{{ number_format($totalVisits) }}</div>
            <div class="metric-label">Total visites</div>
            @if($visitsChange !== null)
                <div class="metric-trend {{ $visitsChange >= 0 ? 'is-up' : 'is-down' }}">{{ $visitsChange >= 0 ? '↑' : '↓' }} {{ abs($visitsChange) }}% vs période précédente</div>
            @else
                <div class="metric-trend">Première période mesurée</div>
            @endif
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile" data-count="{{ $uniqueVisitors }}">
        <div class="metric-icon">👥</div>
        <div class="metric-content">
            <div class="metric-value stat-value" data-count="{{ $uniqueVisitors }}">{{ number_format($uniqueVisitors) }}</div>
            <div class="metric-label">Visiteurs uniques</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile" data-count="{{ $visitsToday }}">
        <div class="metric-icon">🗓️</div>
        <div class="metric-content">
            <div class="metric-value stat-value" data-count="{{ $visitsToday }}">{{ number_format($visitsToday) }}</div>
            <div class="metric-label">Visites aujourd'hui</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile">
        <div class="metric-icon">⚡</div>
        <div class="metric-content">
            <div class="metric-value">{{ $bounceRate }}%</div>
            <div class="metric-label">Taux de rebond</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile">
        <div class="metric-icon">📄</div>
        <div class="metric-content">
            <div class="metric-value">{{ $avgPagesPerVisit }}</div>
            <div class="metric-label">Pages/visite</div>
        </div>
    </div>
</div>
</div>

{{-- Graphique des visites --}}
<div class="admin-chart-section analytics-primary-panel">
    <div class="admin-chart-container">
        <div class="panel-heading">
            <div>
                <div class="panel-eyebrow">Tendance</div>
                <h2>Évolution des visites</h2>
            </div>
            <span class="period-badge">{{ $days }} jours</span>
        </div>
        <div class="chart-wrapper">
            <canvas id="visitsChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>

{{-- Grille de données --}}
<div class="admin-data-grid analytics-data-grid">
    
    {{-- Pages populaires --}}
    <div class="admin-data-panel">
        <h3>🔥 Pages les plus visitées</h3>
        <div class="data-table-container">
            @if($topPages->count())
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Visites</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($topPages as $page)
                        <tr>
                            <td class="page-url">{{ $page['url'] }}</td>
                            <td class="visits-count">{{ number_format($page['visits']) }}</td>
                            <td class="visits-percent">
                                {{ $totalVisits > 0 ? round(($page['visits'] / $totalVisits) * 100, 1) : 0 }}%
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">Aucune donnée disponible</p>
            @endif
        </div>
    </div>

    {{-- Appareils --}}
    <div class="admin-data-panel">
        <h3>📱 Types d'appareils</h3>
        <div class="device-stats">
            <div class="device-item">
                <div class="device-info">
                    <span class="device-icon">🖥️</span>
                    <span class="device-label">Desktop</span>
                </div>
                <div class="device-metrics">
                    <span class="device-count">{{ number_format($devices['desktop']['count']) }}</span>
                    <span class="device-percent">{{ $devices['desktop']['percent'] }}%</span>
                </div>
                <div class="device-bar">
                    <div class="device-progress" style="width: {{ $devices['desktop']['percent'] }}%"></div>
                </div>
            </div>
            
            <div class="device-item">
                <div class="device-info">
                    <span class="device-icon">📱</span>
                    <span class="device-label">Mobile</span>
                </div>
                <div class="device-metrics">
                    <span class="device-count">{{ number_format($devices['mobile']['count']) }}</span>
                    <span class="device-percent">{{ $devices['mobile']['percent'] }}%</span>
                </div>
                <div class="device-bar">
                    <div class="device-progress" style="width: {{ $devices['mobile']['percent'] }}%"></div>
                </div>
            </div>
            
            <div class="device-item">
                <div class="device-info">
                    <span class="device-icon">💻</span>
                    <span class="device-label">Tablette</span>
                </div>
                <div class="device-metrics">
                    <span class="device-count">{{ number_format($devices['tablet']['count']) }}</span>
                    <span class="device-percent">{{ $devices['tablet']['percent'] }}%</span>
                </div>
                <div class="device-bar">
                    <div class="device-progress" style="width: {{ $devices['tablet']['percent'] }}%"></div>
                </div>
            </div>
        </div>
    </div>

    {{-- Sources de trafic --}}
    <div class="admin-data-panel">
        <h3>🌐 Sources de trafic</h3>
        <div class="data-table-container">
            @if($referrers->count())
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Visites</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($referrers->take(10) as $ref)
                        <tr>
                            <td class="referrer-source">
                                @if($ref['source'] === 'Direct')
                                    <span class="source-badge direct">🔗 {{ $ref['source'] }}</span>
                                @else
                                    <span class="source-badge external">🌐 {{ $ref['source'] }}</span>
                                @endif
                            </td>
                            <td class="referrer-visits">{{ number_format($ref['visits']) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p class="no-data">Aucune donnée disponible</p>
            @endif
        </div>
    </div>

    {{-- Heures de pointe --}}
    <div class="admin-data-panel">
        <h3>⏰ Heures de pointe</h3>
        <div class="peak-hours-chart">
            @foreach($peakHours->chunk(6) as $chunk)
                <div class="peak-hours-row">
                    @foreach($chunk as $hour)
                        <div class="peak-hour-item">
                            <div class="peak-hour-bar">
                                <div class="peak-hour-fill" 
                                     style="height: {{ $peakHours->max('count') > 0 ? ($hour['count'] / $peakHours->max('count')) * 100 : 0 }}%"
                                     title="{{ $hour['count'] }} visites à {{ $hour['hour'] }}">
                                </div>
                            </div>
                            <div class="peak-hour-label">{{ $hour['hour'] }}</div>
                            <div class="peak-hour-count">{{ $hour['count'] }}</div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </div>
    
</div>

@endsection

@push('styles')
<style>
/* ═══ STATISTIQUES ADMIN ══════════════════════════════════════════ */

.analytics-header {
    align-items: flex-end;
    flex-direction: row;
    justify-content: space-between;
    gap: 24px;
    padding-bottom: 24px;
    border-bottom: 1px solid var(--line);
}

.analytics-actions {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    gap: 8px;
    flex-wrap: wrap;
}

.analytics-action {
    display: inline-flex;
    align-items: center;
    min-height: 40px;
    padding: 0 13px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background: #fff;
    color: var(--green);
    font-size: 12px;
    font-weight: 700;
    cursor: pointer;
    transition: border-color .2s, background .2s, transform .2s;
}

.analytics-action:hover {
    border-color: var(--gold2);
    background: var(--sand);
    transform: translateY(-1px);
}

.analytics-header h1 {
    color: var(--ink);
    font-size: clamp(26px, 3vw, 36px);
    letter-spacing: -.03em;
    line-height: 1.1;
}

.analytics-kicker,
.panel-eyebrow {
    color: var(--gold2);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .14em;
    text-transform: uppercase;
    margin-bottom: 7px;
}

.admin-content-header {
    margin-bottom: 32px;
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.admin-content-subtitle {
    color: var(--muted);
    font-size: 16px;
    margin: 0;
}

.admin-filters {
    align-self: flex-end;
}

.admin-select {
    min-width: 190px;
    padding: 11px 34px 11px 14px;
    border: 1px solid var(--line);
    border-radius: 8px;
    background: white;
    font-size: 14px;
    color: var(--ink);
    box-shadow: 0 3px 12px rgba(40,29,24,.04);
}

/* Métriques principales */
.analytics-summary {
    margin-bottom: 28px;
}

.admin-metrics-grid {
    display: grid;
    grid-template-columns: repeat(5, minmax(0, 1fr));
    gap: 12px;
    margin-bottom: 0;
}

.metric-card {
    background: rgba(255,255,255,.9);
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 18px;
    display: block;
    min-height: 128px;
    transition: transform .2s ease, box-shadow .2s ease, border-color .2s ease;
    position: relative;
    overflow: hidden;
    box-shadow: 0 4px 18px rgba(40,29,24,.035);
}

.metric-card:hover {
    border-color: rgba(229,167,47,.65);
    box-shadow: 0 8px 24px rgba(40,29,24,.08);
    transform: translateY(-2px);
}

.metric-icon {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    margin-bottom: 17px;
    border-radius: 8px;
    background: var(--sand);
    color: var(--gold2);
    font-size: 17px;
}

.metric-content {
    flex: 1;
}

.metric-value {
    font-size: clamp(24px, 2.4vw, 32px);
    font-weight: 600;
    color: var(--green);
    line-height: 1;
    margin-bottom: 4px;
}

.metric-label {
    font-size: 11px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

.metric-trend {
    margin-top: 10px;
    color: var(--muted);
    font-size: 10px;
}

.metric-trend.is-up { color: #16803c; }
.metric-trend.is-down { color: var(--red); }

/* Graphique */
.admin-chart-section {
    background: rgba(255,255,255,.92);
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 24px;
    margin-bottom: 28px;
    box-shadow: 0 4px 18px rgba(40,29,24,.035);
}

.panel-heading {
    display: flex;
    align-items: flex-start;
    justify-content: space-between;
    gap: 16px;
    margin-bottom: 18px;
}

.admin-chart-container h2 {
    margin: 0;
    font-size: 20px;
    color: var(--green);
}

.period-badge {
    padding: 6px 10px;
    border-radius: 999px;
    background: var(--sand);
    color: var(--green);
    font-size: 11px;
    font-weight: 700;
    letter-spacing: .05em;
    white-space: nowrap;
}

.chart-wrapper {
    position: relative;
    height: 320px;
}

#visitsChart {
    max-height: 100%;
}

/* Grille de données */
.admin-data-grid {
    display: grid;
    grid-template-columns: minmax(0, 1.2fr) minmax(300px, .8fr);
    gap: 16px;
}

.admin-data-panel {
    background: rgba(255,255,255,.92);
    border: 1px solid var(--line);
    border-radius: 10px;
    padding: 20px;
    box-shadow: 0 4px 18px rgba(40,29,24,.035);
}

.admin-data-panel h3 {
    margin-bottom: 16px;
    font-size: 16px;
    color: var(--green);
}

/* Tableaux */
.data-table-container {
    overflow-x: auto;
}

.admin-table {
    width: 100%;
    border-collapse: collapse;
}

.admin-table th {
    text-align: left;
    padding: 12px 8px;
    border-bottom: 2px solid var(--line);
    font-weight: 600;
    color: var(--green);
    font-size: 14px;
}

.admin-table td {
    padding: 11px 8px;
    border-bottom: 1px solid var(--line);
    font-size: 14px;
}

.page-url {
    font-family: 'Monaco', monospace;
    font-size: 13px;
    color: var(--ink);
    overflow: hidden;
    text-overflow: ellipsis;
    white-space: nowrap;
    max-width: 320px;
}

.visits-count, .visits-percent {
    font-weight: 600;
    text-align: right;
}

/* Appareils */
.device-stats {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

.device-item {
    display: grid;
    grid-template-columns: 1fr auto;
    grid-template-rows: auto auto;
    gap: 8px 16px;
    align-items: center;
}

.device-info {
    display: flex;
    align-items: center;
    gap: 8px;
}

.device-icon {
    font-size: 18px;
}

.device-label {
    font-weight: 500;
    color: var(--ink);
}

.device-metrics {
    display: flex;
    align-items: center;
    gap: 8px;
    justify-self: end;
}

.device-count {
    font-weight: 600;
    color: var(--green);
}

.device-percent {
    font-size: 13px;
    color: var(--muted);
}

.device-bar {
    grid-column: 1 / -1;
    height: 6px;
    background: var(--line);
    border-radius: 3px;
    overflow: hidden;
}

.device-progress {
    height: 100%;
    background: linear-gradient(90deg, var(--gold), var(--green));
    border-radius: 3px;
    transition: width 0.8s ease;
}

/* Sources */
.source-badge {
    display: inline-flex;
    align-items: center;
    gap: 4px;
    font-size: 13px;
}

.source-badge.direct {
    color: var(--green);
}

.source-badge.external {
    color: var(--muted);
}

/* Heures de pointe */
.peak-hours-chart {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.peak-hours-row {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 8px;
}

.peak-hour-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
}

.peak-hour-bar {
    width: 24px;
    height: 40px;
    background: var(--line);
    border-radius: 2px;
    display: flex;
    align-items: end;
    overflow: hidden;
}

.peak-hour-fill {
    width: 100%;
    background: linear-gradient(to top, var(--green), var(--gold));
    border-radius: 2px;
    transition: height 0.8s ease;
    min-height: 2px;
}

.peak-hour-label {
    font-size: 11px;
    color: var(--muted);
    text-align: center;
}

.peak-hour-count {
    font-size: 11px;
    font-weight: 600;
    color: var(--ink);
}

.no-data {
    text-align: center;
    color: var(--muted);
    font-style: italic;
    padding: 40px;
}

/* Responsive */
@media (max-width: 768px) {
    .analytics-header {
        align-items: stretch;
        flex-direction: column;
        gap: 18px;
    }

    .analytics-actions {
        justify-content: stretch;
    }

    .analytics-action {
        flex: 1;
        justify-content: center;
    }

    .admin-filters,
    .admin-select {
        width: 100%;
    }

    .admin-metrics-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }
    
    .admin-data-grid {
        grid-template-columns: 1fr;
    }
    
    .peak-hours-row {
        grid-template-columns: repeat(4, 1fr);
    }

    .chart-wrapper {
        height: 240px;
    }

    .admin-chart-section,
    .admin-data-panel {
        padding: 16px;
    }
}

@media (max-width: 440px) {
    .admin-metrics-grid {
        grid-template-columns: 1fr;
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const refreshButton = document.querySelector('.analytics-refresh');
    if (refreshButton) {
        refreshButton.addEventListener('click', function() {
            refreshButton.textContent = '↻ Actualisation…';
            refreshButton.disabled = true;
            window.location.reload();
        });
    }

    // Graphique des visites
    const ctx = document.getElementById('visitsChart').getContext('2d');
    
    const visitData = @json($visitsByDay->pluck('count'));
    const visitLabels = @json($visitsByDay->pluck('date'));
    
    new Chart(ctx, {
        type: 'line',
        data: {
            labels: visitLabels,
            datasets: [{
                label: 'Visites',
                data: visitData,
                borderColor: '#ffc247',
                backgroundColor: 'rgba(255, 194, 71, 0.1)',
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: '#ffc247',
                pointBorderColor: '#e5a72f',
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#70645c'
                    },
                    grid: {
                        color: 'rgba(234, 220, 197, 0.5)'
                    }
                },
                x: {
                    ticks: {
                        color: '#70645c',
                        maxTicksLimit: {{ $days <= 30 ? 10 : 12 }}
                    },
                    grid: {
                        color: 'rgba(234, 220, 197, 0.5)'
                    }
                }
            },
            elements: {
                point: {
                    hoverBackgroundColor: '#ffc247'
                }
            }
        }
    });
    
    // Animation des barres de progression des appareils
    setTimeout(() => {
        document.querySelectorAll('.device-progress').forEach(bar => {
            const width = bar.style.width;
            bar.style.width = '0%';
            setTimeout(() => {
                bar.style.width = width;
            }, 100);
        });
        
        // Animation des heures de pointe
        document.querySelectorAll('.peak-hour-fill').forEach((fill, index) => {
            const height = fill.style.height;
            fill.style.height = '0%';
            setTimeout(() => {
                fill.style.height = height;
            }, 200 + (index * 20));
        });
    }, 500);
});
</script>
@endpush