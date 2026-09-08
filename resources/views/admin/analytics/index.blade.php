@extends('admin.partials.layout')

@section('title', 'Statistiques du site')
@section('page-title', 'Statistiques')

@section('content')
<div class="analytics-container">
    <!-- HEADER ========================================================= -->
    <div class="analytics-header">
        <div class="header-content">
            <div class="analytics-kicker">📊 Pilotage du trafic</div>
            <h1 class="analytics-title">Statistiques du site</h1>
            <p class="analytics-subtitle">Analyse complète du trafic et des performances de Néré Mining</p>
        </div>
        
        <div class="header-actions">
            <div class="action-group">
                <form method="GET" class="period-form" id="filterForm">
                    <select name="days" class="period-select" onchange="document.getElementById('filterForm').submit()" aria-label="Période d'analyse">
                        <option value="7" {{ $days == 7 ? 'selected' : '' }}>📅 7 derniers jours</option>
                        <option value="30" {{ $days == 30 ? 'selected' : '' }}>📅 30 derniers jours</option>
                        <option value="90" {{ $days == 90 ? 'selected' : '' }}>📅 3 derniers mois</option>
                        <option value="365" {{ $days == 365 ? 'selected' : '' }}>📅 12 derniers mois</option>
                    </select>
                </form>
            </div>
            
            <div class="action-group">
                <a href="{{ route('admin.analytics.export', ['days' => $days, 'format' => 'csv']) }}" class="btn-action btn-export" title="Exporter en CSV">
                    <span>📥 Export CSV</span>
                </a>
                <a href="{{ route('admin.analytics.export', ['days' => $days, 'format' => 'json']) }}" class="btn-action btn-export" title="Exporter en JSON">
                    <span>📄 Export JSON</span>
                </a>
                <button class="btn-action btn-refresh" onclick="location.reload()" title="Actualiser">
                    <span>🔄 Actualiser</span>
                </button>
            </div>
        </div>
    </div>

    <!-- KPI CARDS (Vue d'ensemble) ===================================== -->
    <section class="kpi-section">
        <h2 class="section-title">Vue d'ensemble</h2>
        
        <div class="kpi-grid">
            <!-- Visites -->
            <div class="kpi-card kpi-primary">
                <div class="kpi-icon">📈</div>
                <div class="kpi-body">
                    <div class="kpi-label">Total visites</div>
                    <div class="kpi-value">{{ number_format($totalVisits) }}</div>
                    @if($visitsChange !== null)
                        <div class="kpi-trend {{ $visitsChange >= 0 ? 'trend-up' : 'trend-down' }}">
                            {{ $visitsChange >= 0 ? '↑' : '↓' }} {{ abs($visitsChange) }}% vs période précédente
                        </div>
                    @else
                        <div class="kpi-trend">Première période mesurée</div>
                    @endif
                </div>
            </div>

            <!-- Visiteurs uniques -->
            <div class="kpi-card kpi-secondary">
                <div class="kpi-icon">👥</div>
                <div class="kpi-body">
                    <div class="kpi-label">Visiteurs uniques</div>
                    <div class="kpi-value">{{ number_format($uniqueVisitors) }}</div>
                    <div class="kpi-meta">{{ $uniqueVisitors > 0 ? round(($uniqueVisitors / $totalVisits) * 100, 1) : 0 }}% du total</div>
                </div>
            </div>

            <!-- Visites aujourd'hui -->
            <div class="kpi-card kpi-tertiary">
                <div class="kpi-icon">🗓️</div>
                <div class="kpi-body">
                    <div class="kpi-label">Visites aujourd'hui</div>
                    <div class="kpi-value">{{ number_format($visitsToday) }}</div>
                    <div class="kpi-meta">{{ now()->locale('fr')->isoFormat('dddd D MMMM') }}</div>
                </div>
            </div>

            <!-- Pages par visite -->
            <div class="kpi-card kpi-quaternary">
                <div class="kpi-icon">📄</div>
                <div class="kpi-body">
                    <div class="kpi-label">Pages/visite</div>
                    <div class="kpi-value">{{ $avgPagesPerVisit }}</div>
                    <div class="kpi-meta">Profondeur moyenne</div>
                </div>
            </div>

            <!-- Taux de rebond -->
            <div class="kpi-card kpi-quinary">
                <div class="kpi-icon">⚡</div>
                <div class="kpi-body">
                    <div class="kpi-label">Taux de rebond</div>
                    <div class="kpi-value">{{ $bounceRate }}%</div>
                    @if($bounceRateChange !== null)
                        <div class="kpi-trend {{ $bounceRateChange <= 0 ? 'trend-up' : 'trend-down' }}">
                            {{ $bounceRateChange < 0 ? '↓' : '↑' }} {{ abs($bounceRateChange) }}% vs période précédente
                        </div>
                    @endif
                </div>
            </div>

            <!-- Visiteurs récurrents -->
            <div class="kpi-card kpi-senary">
                <div class="kpi-icon">🔄</div>
                <div class="kpi-body">
                    <div class="kpi-label">Visiteurs récurrents</div>
                    <div class="kpi-value">{{ number_format($recurringVisitors) }}</div>
                    <div class="kpi-meta">{{ $recurringRate }}% de retour</div>
                </div>
            </div>
        </div>
    </section>

    <!-- GRAPHS SECTION ================================================= -->
    <div class="graphs-section">
        <!-- Evolution visites -->
        <div class="chart-panel">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">📊 Évolution des visites</h3>
                    <p class="chart-subtitle">Tendance sur {{ $days }} jours</p>
                </div>
                <span class="chart-badge">{{ $thisWeekVisits }} cette semaine</span>
            </div>
            <div class="chart-container">
                <canvas id="visitsChart" data-height="300"></canvas>
            </div>
        </div>

        <!-- Device breakdown chart -->
        <div class="chart-panel">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">📱 Répartition des appareils</h3>
                    <p class="chart-subtitle">Distribution par type d'appareil</p>
                </div>
                <span class="chart-badge">{{ array_sum(array_column($devices, 'count')) }} total</span>
            </div>
            <div class="chart-container">
                <canvas id="devicesChart" data-height="250"></canvas>
            </div>
        </div>

        <!-- Referrer breakdown chart -->
        <div class="chart-panel">
            <div class="chart-header">
                <div>
                    <h3 class="chart-title">🌐 Sources de trafic</h3>
                    <p class="chart-subtitle">Top sources d'accès</p>
                </div>
                <span class="chart-badge">{{ $referrers->count() }} sources</span>
            </div>
            <div class="chart-container">
                <canvas id="referrersChart" data-height="250"></canvas>
            </div>
        </div>
    </div>

    <!-- DATA PANELS ==================================================== -->
    <div class="data-panels-grid">
        
        <!-- Pages populaires -->
        <div class="data-panel">
            <div class="panel-header">
                <h3>🔥 Pages les plus visitées</h3>
                <span class="panel-count">Top 10</span>
            </div>
            <div class="panel-content">
                @if($topPages->count())
                    <div class="pages-list">
                        @foreach($topPages as $index => $page)
                        <div class="page-item">
                            <div class="page-rank">{{ $index + 1 }}</div>
                            <div class="page-info">
                                <div class="page-url" title="{{ $page['url'] }}">{{ $page['url'] }}</div>
                                <div class="page-bar">
                                    <div class="page-bar-fill" style="width: {{ $totalVisits > 0 ? round(($page['visits'] / $totalVisits) * 100, 1) : 0 }}%"></div>
                                </div>
                            </div>
                            <div class="page-stats">
                                <div class="page-visits">{{ number_format($page['visits']) }}</div>
                                <div class="page-percent">{{ $totalVisits > 0 ? round(($page['visits'] / $totalVisits) * 100, 1) : 0 }}%</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">Aucune donnée disponible</div>
                @endif
            </div>
        </div>

        <!-- Appareils -->
        <div class="data-panel">
            <div class="panel-header">
                <h3>📱 Types d'appareils</h3>
                <span class="panel-count">Total: {{ number_format($uniqueVisitors) }}</span>
            </div>
            <div class="panel-content">
                <div class="devices-list">
                    @foreach(['desktop' => ['icon' => '🖥️', 'label' => 'Desktop'], 'mobile' => ['icon' => '📱', 'label' => 'Mobile'], 'tablet' => ['icon' => '💻', 'label' => 'Tablette']] as $key => $device)
                    <div class="device-row">
                        <div class="device-header">
                            <span class="device-icon">{{ $device['icon'] }}</span>
                            <div class="device-meta">
                                <span class="device-label">{{ $device['label'] }}</span>
                                <span class="device-count">{{ number_format($devices[$key]['count']) }} visites</span>
                            </div>
                        </div>
                        <div class="device-percent">{{ $devices[$key]['percent'] }}%</div>
                        <div class="device-bar">
                            <div class="device-fill" style="width: {{ $devices[$key]['percent'] }}%"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Sources de trafic -->
        <div class="data-panel">
            <div class="panel-header">
                <h3>🌐 Sources de trafic</h3>
                <span class="panel-count">Top 8</span>
            </div>
            <div class="panel-content">
                @if($referrers->count())
                    <div class="sources-list">
                        @foreach($referrers->take(8) as $ref)
                        <div class="source-item">
                            <div class="source-info">
                                <span class="source-icon">{{ $ref['source'] === 'Direct' ? '🔗' : '🌐' }}</span>
                                <span class="source-name">{{ Str::limit($ref['source'], 28, '…') }}</span>
                            </div>
                            <div class="source-stat">{{ number_format($ref['visits']) }}</div>
                        </div>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">Aucune donnée disponible</div>
                @endif
            </div>
        </div>

        <!-- Heures de pointe -->
        <div class="data-panel">
            <div class="panel-header">
                <h3>⏰ Heures de pointe</h3>
                <span class="panel-count">24h</span>
            </div>
            <div class="panel-content">
                <div class="peak-hours-grid">
                    @foreach($peakHours as $hour)
                    <div class="peak-hour" title="{{ $hour['count'] }} visites à {{ $hour['hour'] }}">
                        <div class="peak-bar">
                            <div class="peak-fill" style="height: {{ $peakHours->max('count') > 0 ? ($hour['count'] / $peakHours->max('count')) * 100 : 0 }}%"></div>
                        </div>
                        <div class="peak-label">{{ $hour['hour'] }}</div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>

@endsection

@push('styles')
<style>
/* ═══════════════════════════════════════════════════════════════════ */
/* STATISTIQUES ADMIN - NOUVEAU DESIGN */
/* ═══════════════════════════════════════════════════════════════════ */

:root {
    --stat-gold: #ffc247;
    --stat-green: #1a8f3e;
    --stat-blue: #5d8fa8;
    --stat-orange: #c27b58;
    --stat-purple: #8874a5;
    --stat-teal: #5fa88e;
}

.analytics-container {
    display: flex;
    flex-direction: column;
    gap: 28px;
    animation: fadeIn 0.5s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(8px); }
    to { opacity: 1; transform: translateY(0); }
}

/* ─────── HEADER ──────────────────────────────────────────────────── */

.analytics-header {
    display: flex;
    flex-direction: row;
    justify-content: space-between;
    align-items: flex-end;
    gap: 24px;
    padding: 28px 24px;
    background: linear-gradient(135deg, #fffef9 0%, #fff9e9 100%);
    border: 1px solid rgba(229, 167, 47, 0.25);
    border-radius: 12px;
    box-shadow: 0 8px 24px rgba(40, 29, 24, 0.06);
    position: relative;
    overflow: hidden;
}

.analytics-header::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    width: 300px;
    height: 300px;
    background: radial-gradient(circle, rgba(255, 194, 71, 0.08) 0%, transparent 70%);
    pointer-events: none;
}

.header-content {
    flex: 1;
    position: relative;
    z-index: 1;
}

.analytics-kicker {
    font-size: 12px;
    font-weight: 700;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: var(--stat-gold);
    margin-bottom: 8px;
}

.analytics-title {
    font-size: clamp(28px, 3vw, 40px);
    font-weight: 700;
    color: var(--green);
    line-height: 1.1;
    margin: 0 0 4px 0;
    letter-spacing: -0.02em;
}

.analytics-subtitle {
    font-size: 15px;
    color: var(--muted);
    margin: 0;
    line-height: 1.4;
}

.header-actions {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    align-items: center;
    position: relative;
    z-index: 1;
}

.action-group {
    display: flex;
    gap: 8px;
}

.period-select {
    padding: 11px 12px;
    border: 1px solid rgba(229, 167, 47, 0.3);
    border-radius: 8px;
    background: white;
    color: var(--ink);
    font-size: 13px;
    font-weight: 500;
    cursor: pointer;
    transition: all 0.2s;
}

.period-select:hover {
    border-color: var(--stat-gold);
    box-shadow: 0 4px 12px rgba(255, 194, 71, 0.15);
}

.period-select:focus {
    outline: none;
    border-color: var(--stat-gold);
}

.btn-action {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 10px 14px;
    border: 1px solid rgba(229, 167, 47, 0.3);
    border-radius: 8px;
    background: white;
    color: var(--green);
    font-size: 13px;
    font-weight: 600;
    text-decoration: none;
    cursor: pointer;
    transition: all 0.2s;
}

.btn-action:hover {
    border-color: var(--stat-gold);
    background: var(--sand);
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(229, 167, 47, 0.2);
}

/* ─────── KPI SECTION ──────────────────────────────────────────────── */

.section-title {
    font-size: 13px;
    font-weight: 700;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--muted);
    margin: 0 0 12px 0;
}

.kpi-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 12px;
}

.kpi-card {
    display: flex;
    gap: 16px;
    padding: 18px;
    border: 1px solid var(--line);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(40, 29, 24, 0.04);
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    overflow: hidden;
}

.kpi-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 3px;
    background: var(--stat-gold);
}

.kpi-card.kpi-secondary::before { background: var(--stat-blue); }
.kpi-card.kpi-tertiary::before { background: var(--stat-teal); }
.kpi-card.kpi-quaternary::before { background: var(--stat-orange); }
.kpi-card.kpi-quinary::before { background: var(--stat-purple); }
.kpi-card.kpi-senary::before { background: var(--stat-green); }

.kpi-card:hover {
    border-color: rgba(229, 167, 47, 0.5);
    box-shadow: 0 8px 24px rgba(40, 29, 24, 0.08);
    transform: translateY(-2px);
}

.kpi-icon {
    font-size: 32px;
    line-height: 1;
    flex-shrink: 0;
}

.kpi-body {
    flex: 1;
    min-width: 0;
}

.kpi-label {
    font-size: 12px;
    font-weight: 600;
    letter-spacing: 0.05em;
    text-transform: uppercase;
    color: var(--muted);
    margin-bottom: 6px;
}

.kpi-value {
    font-size: clamp(22px, 2.5vw, 28px);
    font-weight: 700;
    color: var(--green);
    line-height: 1;
    margin-bottom: 8px;
    letter-spacing: -0.01em;
}

.kpi-trend {
    font-size: 11px;
    color: var(--muted);
    line-height: 1.4;
}

.kpi-trend.trend-up {
    color: #16803c;
    font-weight: 600;
}

.kpi-trend.trend-down {
    color: #c94646;
    font-weight: 600;
}

.kpi-meta {
    font-size: 11px;
    color: var(--muted);
}

/* ─────── GRAPHS SECTION ──────────────────────────────────────────── */

.graphs-section {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    gap: 16px;
}

.chart-panel {
    padding: 20px;
    border: 1px solid var(--line);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(40, 29, 24, 0.04);
    transition: all 0.3s;
    position: relative;
}

.chart-panel::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 20px;
    right: 20px;
    height: 3px;
    border-radius: 3px 3px 0 0;
    background: var(--stat-gold);
    opacity: 0.6;
}

.chart-panel:hover {
    border-color: rgba(229, 167, 47, 0.4);
    box-shadow: 0 8px 24px rgba(40, 29, 24, 0.07);
}

.chart-header {
    display: flex;
    justify-content: space-between;
    align-items: flex-start;
    gap: 12px;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--line);
}

.chart-title {
    font-size: 16px;
    font-weight: 700;
    color: var(--green);
    margin: 0;
}

.chart-subtitle {
    font-size: 12px;
    color: var(--muted);
    margin: 4px 0 0 0;
}

.chart-badge {
    padding: 6px 10px;
    border-radius: 6px;
    background: var(--sand);
    color: var(--green);
    font-size: 11px;
    font-weight: 700;
    white-space: nowrap;
}

.chart-container {
    position: relative;
    height: 300px;
    padding: 8px 0 0 0;
}

/* ─────── DATA PANELS ──────────────────────────────────────────────── */

.data-panels-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 16px;
}

.data-panel {
    padding: 20px;
    border: 1px solid var(--line);
    border-radius: 10px;
    background: rgba(255, 255, 255, 0.95);
    box-shadow: 0 4px 16px rgba(40, 29, 24, 0.04);
    transition: all 0.3s;
    display: flex;
    flex-direction: column;
}

.data-panel:hover {
    border-color: rgba(229, 167, 47, 0.4);
    box-shadow: 0 8px 24px rgba(40, 29, 24, 0.07);
}

.panel-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 12px;
    margin-bottom: 16px;
    padding-bottom: 12px;
    border-bottom: 1px solid var(--line);
}

.panel-header h3 {
    font-size: 15px;
    font-weight: 700;
    color: var(--green);
    margin: 0;
}

.panel-count {
    font-size: 11px;
    font-weight: 700;
    background: var(--sand);
    color: var(--green);
    padding: 4px 8px;
    border-radius: 4px;
}

.panel-content {
    flex: 1;
    min-height: 200px;
    overflow-y: auto;
}

/* Pages List */
.pages-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.page-item {
    display: grid;
    grid-template-columns: 24px 1fr 80px;
    gap: 12px;
    align-items: center;
    padding: 12px;
    border-radius: 6px;
    background: var(--sand);
    transition: all 0.2s;
}

.page-item:hover {
    background: rgba(255, 194, 71, 0.15);
}

.page-rank {
    font-weight: 700;
    color: var(--gold2);
    font-size: 13px;
    text-align: center;
}

.page-info {
    min-width: 0;
}

.page-url {
    font-family: 'Monaco', monospace;
    font-size: 12px;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    margin-bottom: 6px;
    display: block;
}

.page-bar {
    height: 4px;
    background: rgba(255, 194, 71, 0.3);
    border-radius: 2px;
    overflow: hidden;
}

.page-bar-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--stat-gold), var(--stat-orange));
    border-radius: 2px;
    animation: slideIn 0.6s ease-out;
}

@keyframes slideIn {
    from { width: 0 !important; }
}

.page-stats {
    display: flex;
    flex-direction: column;
    gap: 2px;
    text-align: right;
}

.page-visits {
    font-size: 12px;
    font-weight: 700;
    color: var(--green);
}

.page-percent {
    font-size: 11px;
    color: var(--muted);
}

/* Devices List */
.devices-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
}

.device-row {
    display: grid;
    grid-template-columns: 1fr auto auto;
    gap: 12px;
    align-items: center;
    padding: 12px;
    background: var(--sand);
    border-radius: 6px;
    transition: all 0.2s;
}

.device-row:hover {
    background: rgba(255, 194, 71, 0.15);
}

.device-header {
    display: flex;
    align-items: center;
    gap: 10px;
}

.device-icon {
    font-size: 18px;
}

.device-meta {
    display: flex;
    flex-direction: column;
    gap: 2px;
}

.device-label {
    font-size: 12px;
    font-weight: 600;
    color: var(--ink);
}

.device-count {
    font-size: 11px;
    color: var(--muted);
}

.device-percent {
    font-size: 12px;
    font-weight: 700;
    color: var(--green);
    min-width: 35px;
    text-align: right;
}

.device-bar {
    grid-column: 1 / -1;
    height: 6px;
    background: rgba(255, 194, 71, 0.3);
    border-radius: 3px;
    overflow: hidden;
}

.device-fill {
    height: 100%;
    background: linear-gradient(90deg, var(--stat-gold), var(--stat-green));
    border-radius: 3px;
    animation: slideIn 0.8s ease-out;
}

/* Sources List */
.sources-list {
    display: flex;
    flex-direction: column;
    gap: 10px;
}

.source-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px;
    background: var(--sand);
    border-radius: 6px;
    transition: all 0.2s;
}

.source-item:hover {
    background: rgba(255, 194, 71, 0.15);
}

.source-info {
    display: flex;
    align-items: center;
    gap: 8px;
    flex: 1;
    min-width: 0;
}

.source-icon {
    font-size: 16px;
    flex-shrink: 0;
}

.source-name {
    font-size: 12px;
    color: var(--ink);
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
}

.source-stat {
    font-size: 12px;
    font-weight: 700;
    color: var(--green);
    min-width: 50px;
    text-align: right;
}

/* Peak Hours Grid */
.peak-hours-grid {
    display: grid;
    grid-template-columns: repeat(6, 1fr);
    gap: 8px;
}

.peak-hour {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 6px;
    padding: 6px;
}

.peak-bar {
    width: 22px;
    height: 80px;
    background: rgba(255, 194, 71, 0.3);
    border-radius: 2px;
    display: flex;
    align-items: flex-end;
    overflow: hidden;
}

.peak-fill {
    width: 100%;
    background: linear-gradient(to top, var(--stat-green), var(--stat-gold));
    border-radius: 2px;
    animation: slideUp 0.8s ease-out;
}

@keyframes slideUp {
    from { height: 0 !important; }
}

.peak-label {
    font-size: 10px;
    color: var(--muted);
    text-align: center;
    min-width: 28px;
}

/* Empty State */
.empty-state {
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    color: var(--muted);
    font-style: italic;
    text-align: center;
}

/* ─────── RESPONSIVE ──────────────────────────────────────────────── */

@media (max-width: 1200px) {
    .analytics-header {
        flex-direction: column;
        align-items: flex-start;
    }

    .header-actions {
        width: 100%;
        justify-content: flex-end;
    }

    .graphs-section {
        grid-template-columns: 1fr;
    }
}

@media (max-width: 768px) {
    .analytics-header {
        padding: 20px 16px;
    }

    .analytics-title {
        font-size: 24px;
    }

    .header-actions {
        flex-direction: column;
        gap: 8px;
    }

    .action-group {
        width: 100%;
    }

    .period-select,
    .btn-action {
        width: 100%;
        justify-content: center;
    }

    .kpi-grid {
        grid-template-columns: repeat(2, 1fr);
    }

    .data-panels-grid {
        grid-template-columns: 1fr;
    }

    .peak-hours-grid {
        grid-template-columns: repeat(4, 1fr);
    }

    .analytics-container {
        gap: 20px;
    }
}

@media (max-width: 480px) {
    .kpi-grid {
        grid-template-columns: 1fr;
    }

    .peak-hours-grid {
        grid-template-columns: repeat(3, 1fr);
    }

    .page-item {
        grid-template-columns: 20px 1fr;
        gap: 10px;
    }

    .page-stats {
        grid-column: 1 / -1;
        flex-direction: row;
        justify-content: space-between;
        padding-top: 6px;
        border-top: 1px solid rgba(255, 194, 71, 0.3);
    }
}
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique des visites
    const visitCtx = document.getElementById('visitsChart')?.getContext('2d');
    if (visitCtx) {
        const visitData = @json($visitsByDay->pluck('count'));
        const visitLabels = @json($visitsByDay->pluck('date'));
        
        new Chart(visitCtx, {
            type: 'line',
            data: {
                labels: visitLabels,
                datasets: [{
                    label: 'Visites',
                    data: visitData,
                    borderColor: '#ffc247',
                    backgroundColor: 'rgba(255, 194, 71, 0.08)',
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
                    legend: { display: false },
                    tooltip: {
                        backgroundColor: 'rgba(40, 29, 24, 0.9)',
                        borderColor: '#ffc247',
                        borderWidth: 1,
                        titleColor: '#ffc247',
                        bodyColor: '#fff',
                        padding: 12,
                        cornerRadius: 6
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: { color: '#70645c' },
                        grid: { color: 'rgba(234, 220, 197, 0.3)' }
                    },
                    x: {
                        ticks: { color: '#70645c', maxTicksLimit: 12 },
                        grid: { color: 'rgba(234, 220, 197, 0.2)' }
                    }
                }
            }
        });
    }

    // Graphique des appareils
    const devicesCtx = document.getElementById('devicesChart')?.getContext('2d');
    if (devicesCtx) {
        const devices = @json($devices);
        
        new Chart(devicesCtx, {
            type: 'doughnut',
            data: {
                labels: ['Desktop', 'Mobile', 'Tablette'],
                datasets: [{
                    data: [devices.desktop.count, devices.mobile.count, devices.tablet.count],
                    backgroundColor: ['#ffc247', '#5d8fa8', '#7b9d62'],
                    borderColor: ['#e5a72f', '#3d5a74', '#5a7a4a'],
                    borderWidth: 2
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { color: '#70645c', padding: 16, font: { size: 12, weight: 'bold' } }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.label + ': ' + context.parsed + ' (' + 
                                    ((context.parsed / context.dataset.data.reduce((a,b) => a+b, 0)) * 100).toFixed(1) + '%)';
                            }
                        }
                    }
                }
            }
        });
    }

    // Graphique des sources de trafic
    const referrersCtx = document.getElementById('referrersChart')?.getContext('2d');
    if (referrersCtx) {
        const referrers = @json($referrers->take(8));
        
        if (referrers && referrers.length > 0) {
            const labels = referrers.map(r => r.source);
            const data = referrers.map(r => r.visits);
            
            new Chart(referrersCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Visites',
                        data: data,
                        backgroundColor: [
                            '#ffc247', '#5d8fa8', '#7b9d62', '#c27b58',
                            '#8874a5', '#5fa88e', '#d4a574', '#6b8e9e'
                        ].slice(0, data.length),
                        borderColor: [
                            '#e5a72f', '#3d5a74', '#5a7a4a', '#a8623e',
                            '#765e9a', '#4a927f', '#c49560', '#4f6680'
                        ].slice(0, data.length),
                        borderWidth: 1,
                        borderRadius: 4
                    }]
                },
                options: {
                    indexAxis: 'y',
                    responsive: true,
                    maintainAspectRatio: false,
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        x: {
                            beginAtZero: true,
                            ticks: { color: '#70645c' },
                            grid: { color: 'rgba(234, 220, 197, 0.3)' }
                        },
                        y: {
                            ticks: { color: '#70645c', font: { size: 11 } },
                            grid: { display: false }
                        }
                    }
                }
            });
        }
    }
});
</script>
@endpush
