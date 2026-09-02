<?php $__env->startSection('title', 'Statistiques du site'); ?>
<?php $__env->startSection('page-title', 'Statistiques'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-content-header">
    <h1>📊 Statistiques du site</h1>
    <p class="admin-content-subtitle">Analyse du trafic et des performances</p>
    
    
    <div class="admin-filters">
        <form method="GET" class="filter-form">
            <select name="days" onchange="this.form.submit()" class="admin-select">
                <option value="7" <?php echo e($days == 7 ? 'selected' : ''); ?>>7 derniers jours</option>
                <option value="30" <?php echo e($days == 30 ? 'selected' : ''); ?>>30 derniers jours</option>
                <option value="90" <?php echo e($days == 90 ? 'selected' : ''); ?>>3 derniers mois</option>
                <option value="365" <?php echo e($days == 365 ? 'selected' : ''); ?>>12 derniers mois</option>
            </select>
        </form>
    </div>
</div>


<div class="admin-metrics-grid">
    <div class="metric-card admin-stat-tile" data-count="<?php echo e($totalVisits); ?>">
        <div class="metric-icon">📈</div>
        <div class="metric-content">
            <div class="metric-value stat-value" data-count="<?php echo e($totalVisits); ?>"><?php echo e(number_format($totalVisits)); ?></div>
            <div class="metric-label">Total visites</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile" data-count="<?php echo e($uniqueVisitors); ?>">
        <div class="metric-icon">👥</div>
        <div class="metric-content">
            <div class="metric-value stat-value" data-count="<?php echo e($uniqueVisitors); ?>"><?php echo e(number_format($uniqueVisitors)); ?></div>
            <div class="metric-label">Visiteurs uniques</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile" data-count="<?php echo e($visitsToday); ?>">
        <div class="metric-icon">🗓️</div>
        <div class="metric-content">
            <div class="metric-value stat-value" data-count="<?php echo e($visitsToday); ?>"><?php echo e(number_format($visitsToday)); ?></div>
            <div class="metric-label">Visites aujourd'hui</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile">
        <div class="metric-icon">⚡</div>
        <div class="metric-content">
            <div class="metric-value"><?php echo e($bounceRate); ?>%</div>
            <div class="metric-label">Taux de rebond</div>
        </div>
    </div>
    
    <div class="metric-card admin-stat-tile">
        <div class="metric-icon">📄</div>
        <div class="metric-content">
            <div class="metric-value"><?php echo e($avgPagesPerVisit); ?></div>
            <div class="metric-label">Pages/visite</div>
        </div>
    </div>
</div>


<div class="admin-chart-section">
    <div class="admin-chart-container">
        <h2>📊 Évolution des visites (<?php echo e($days); ?> derniers jours)</h2>
        <div class="chart-wrapper">
            <canvas id="visitsChart" width="400" height="200"></canvas>
        </div>
    </div>
</div>


<div class="admin-data-grid">
    
    
    <div class="admin-data-panel">
        <h3>🔥 Pages les plus visitées</h3>
        <div class="data-table-container">
            <?php if($topPages->count()): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Page</th>
                            <th>Visites</th>
                            <th>%</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $topPages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="page-url"><?php echo e($page['url']); ?></td>
                            <td class="visits-count"><?php echo e(number_format($page['visits'])); ?></td>
                            <td class="visits-percent">
                                <?php echo e($totalVisits > 0 ? round(($page['visits'] / $totalVisits) * 100, 1) : 0); ?>%
                            </td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Aucune donnée disponible</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="admin-data-panel">
        <h3>📱 Types d'appareils</h3>
        <div class="device-stats">
            <div class="device-item">
                <div class="device-info">
                    <span class="device-icon">🖥️</span>
                    <span class="device-label">Desktop</span>
                </div>
                <div class="device-metrics">
                    <span class="device-count"><?php echo e(number_format($devices['desktop']['count'])); ?></span>
                    <span class="device-percent"><?php echo e($devices['desktop']['percent']); ?>%</span>
                </div>
                <div class="device-bar">
                    <div class="device-progress" style="width: <?php echo e($devices['desktop']['percent']); ?>%"></div>
                </div>
            </div>
            
            <div class="device-item">
                <div class="device-info">
                    <span class="device-icon">📱</span>
                    <span class="device-label">Mobile</span>
                </div>
                <div class="device-metrics">
                    <span class="device-count"><?php echo e(number_format($devices['mobile']['count'])); ?></span>
                    <span class="device-percent"><?php echo e($devices['mobile']['percent']); ?>%</span>
                </div>
                <div class="device-bar">
                    <div class="device-progress" style="width: <?php echo e($devices['mobile']['percent']); ?>%"></div>
                </div>
            </div>
            
            <div class="device-item">
                <div class="device-info">
                    <span class="device-icon">💻</span>
                    <span class="device-label">Tablette</span>
                </div>
                <div class="device-metrics">
                    <span class="device-count"><?php echo e(number_format($devices['tablet']['count'])); ?></span>
                    <span class="device-percent"><?php echo e($devices['tablet']['percent']); ?>%</span>
                </div>
                <div class="device-bar">
                    <div class="device-progress" style="width: <?php echo e($devices['tablet']['percent']); ?>%"></div>
                </div>
            </div>
        </div>
    </div>

    
    <div class="admin-data-panel">
        <h3>🌐 Sources de trafic</h3>
        <div class="data-table-container">
            <?php if($referrers->count()): ?>
                <table class="admin-table">
                    <thead>
                        <tr>
                            <th>Source</th>
                            <th>Visites</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $referrers->take(10); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $ref): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="referrer-source">
                                <?php if($ref['source'] === 'Direct'): ?>
                                    <span class="source-badge direct">🔗 <?php echo e($ref['source']); ?></span>
                                <?php else: ?>
                                    <span class="source-badge external">🌐 <?php echo e($ref['source']); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="referrer-visits"><?php echo e(number_format($ref['visits'])); ?></td>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="no-data">Aucune donnée disponible</p>
            <?php endif; ?>
        </div>
    </div>

    
    <div class="admin-data-panel">
        <h3>⏰ Heures de pointe</h3>
        <div class="peak-hours-chart">
            <?php $__currentLoopData = $peakHours->chunk(6); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chunk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="peak-hours-row">
                    <?php $__currentLoopData = $chunk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hour): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="peak-hour-item">
                            <div class="peak-hour-bar">
                                <div class="peak-hour-fill" 
                                     style="height: <?php echo e($peakHours->max('count') > 0 ? ($hour['count'] / $peakHours->max('count')) * 100 : 0); ?>%"
                                     title="<?php echo e($hour['count']); ?> visites à <?php echo e($hour['hour']); ?>">
                                </div>
                            </div>
                            <div class="peak-hour-label"><?php echo e($hour['hour']); ?></div>
                            <div class="peak-hour-count"><?php echo e($hour['count']); ?></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    
</div>

<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
/* ═══ STATISTIQUES ADMIN ══════════════════════════════════════════ */

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
    align-self: flex-start;
}

.admin-select {
    padding: 8px 12px;
    border: 1px solid var(--line);
    border-radius: 6px;
    background: white;
    font-size: 14px;
    color: var(--ink);
}

/* Métriques principales */
.admin-metrics-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 20px;
    margin-bottom: 40px;
}

.metric-card {
    background: white;
    border: 1px solid var(--line);
    border-radius: 12px;
    padding: 24px;
    display: flex;
    align-items: center;
    gap: 16px;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
}

.metric-icon {
    font-size: 28px;
    flex-shrink: 0;
}

.metric-content {
    flex: 1;
}

.metric-value {
    font-size: 28px;
    font-weight: 600;
    color: var(--green);
    line-height: 1;
    margin-bottom: 4px;
}

.metric-label {
    font-size: 14px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
}

/* Graphique */
.admin-chart-section {
    background: white;
    border: 1px solid var(--line);
    border-radius: 12px;
    padding: 32px;
    margin-bottom: 40px;
}

.admin-chart-container h2 {
    margin-bottom: 24px;
    font-size: 20px;
    color: var(--green);
}

.chart-wrapper {
    position: relative;
    height: 300px;
}

#visitsChart {
    max-height: 100%;
}

/* Grille de données */
.admin-data-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 24px;
}

.admin-data-panel {
    background: white;
    border: 1px solid var(--line);
    border-radius: 12px;
    padding: 24px;
}

.admin-data-panel h3 {
    margin-bottom: 20px;
    font-size: 18px;
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
    padding: 12px 8px;
    border-bottom: 1px solid var(--line);
    font-size: 14px;
}

.page-url {
    font-family: 'Monaco', monospace;
    font-size: 13px;
    color: var(--ink);
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
    .admin-metrics-grid {
        grid-template-columns: 1fr;
    }
    
    .admin-data-grid {
        grid-template-columns: 1fr;
    }
    
    .peak-hours-row {
        grid-template-columns: repeat(4, 1fr);
    }
}
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Graphique des visites
    const ctx = document.getElementById('visitsChart').getContext('2d');
    
    const visitData = <?php echo json_encode($visitsByDay->pluck('count'), 15, 512) ?>;
    const visitLabels = <?php echo json_encode($visitsByDay->pluck('date'), 15, 512) ?>;
    
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
                        color: '#70645c'
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
<?php $__env->stopPush(); ?>
<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\analytics\index.blade.php ENDPATH**/ ?>