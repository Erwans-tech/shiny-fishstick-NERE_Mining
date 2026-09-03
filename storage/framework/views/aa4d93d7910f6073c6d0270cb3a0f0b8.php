<?php $__env->startSection('title', 'Tableau de bord'); ?>
<?php $__env->startSection('page-title', 'Tableau de bord'); ?>

<?php $__env->startSection('content'); ?>

<div style="display:flex; margin-bottom:20px;">
    
    <div class="card" style="width:100%;">
        <div class="card-body" style="padding:20px; display:flex; flex-direction:column; justify-content:center; gap:10px;">
            <a href="/" target="_blank" class="btn btn-primary" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span style="font-size:16px;">🌐</span>
                Voir le site public
            </a>
            <a href="<?php echo e(route('admin.settings.index')); ?>" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span style="font-size:14px;">⚙️</span>
                Paramètres
            </a>
        </div>
    </div>
</div>


<?php if($counts['messages'] > 0 || $counts['applications_new'] > 0 || $expiringJobs->isNotEmpty()): ?>
<div style="display:flex; flex-direction:column; gap:8px; margin-bottom:24px;">
    <?php if($counts['messages'] > 0): ?>
    <a href="<?php echo e(route('admin.messages.index')); ?>"
       style="display:flex; align-items:center; gap:12px; padding:14px 18px; background:#fee2e2; border:1px solid #fecaca; border-radius:10px; color:#991b1b; font:500 14px Inter,sans-serif; text-decoration:none; transition:all .2s;"
       onmouseover="this.style.background='#fecaca'" onmouseout="this.style.background='#fee2e2'">
        <span style="font-size:20px;">✉️</span>
        <div style="flex:1;">
            <strong><?php echo e($counts['messages']); ?> message(s) non lu(s)</strong>
            <div style="font-size:12px; opacity:.8; margin-top:2px;">Répondez rapidement pour maintenir une bonne relation</div>
        </div>
        <span style="font-size:18px;">→</span>
    </a>
    <?php endif; ?>
    
    <?php if($counts['applications_new'] > 0): ?>
    <a href="<?php echo e(route('admin.applications.index')); ?>"
       style="display:flex; align-items:center; gap:12px; padding:14px 18px; background:#fef9c3; border:1px solid #fde68a; border-radius:10px; color:#854d0e; font:500 14px Inter,sans-serif; text-decoration:none; transition:all .2s;"
       onmouseover="this.style.background='#fde68a'" onmouseout="this.style.background='#fef9c3'">
        <span style="font-size:20px;">📋</span>
        <div style="flex:1;">
            <strong><?php echo e($counts['applications_new']); ?> nouvelle(s) candidature(s)</strong>
            <div style="font-size:12px; opacity:.8; margin-top:2px;">À examiner rapidement pour ne pas perdre de talents</div>
        </div>
        <span style="font-size:18px;">→</span>
    </a>
    <?php endif; ?>
    
    <?php $__currentLoopData = $expiringJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <div style="display:flex; align-items:center; gap:12px; padding:14px 18px; background:#ffedd5; border:1px solid #fed7aa; border-radius:10px; color:#9a3412; font:500 14px Inter,sans-serif;">
        <span style="font-size:20px;">⏰</span>
        <div style="flex:1;">
            <strong><?php echo e($job->title); ?></strong> expire le <?php echo e($job->deadline->format('d/m/Y')); ?>

            <div style="font-size:12px; opacity:.8; margin-top:2px;"><?php echo e($job->deadline->diffForHumans()); ?></div>
        </div>
        <a href="<?php echo e(route('admin.jobs.edit', $job)); ?>" class="btn btn-sm" style="background:#fff; color:#9a3412; border:1px solid #fed7aa;">
            Modifier
        </a>
    </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</div>
<?php endif; ?>


<div class="stat-grid" style="margin-bottom:28px;">

    <a href="<?php echo e(route('admin.news.index')); ?>" class="stat-tile" style="text-decoration:none;">
        <div class="stat-tile-icon stat-tile-icon--blue">📰</div>
        <div class="stat-tile-body">
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-tile-num"><?php echo e($counts['news']); ?></div>
                <?php if($trends['news']['direction'] !== 'stable'): ?>
                <span style="font:600 11px Inter,sans-serif; color:<?php echo e($trends['news']['direction'] === 'up' ? '#10b981' : '#ef4444'); ?>;">
                    <?php echo e($trends['news']['direction'] === 'up' ? '↗' : '↘'); ?> <?php echo e(abs($trends['news']['percent'])); ?>%
                </span>
                <?php endif; ?>
            </div>
            <div class="stat-tile-lbl">Actualités</div>
            <div class="stat-tile-sub"><?php echo e($counts['news_published']); ?> publiée(s) · <?php echo e($counts['news_draft']); ?> brouillon(s)</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

    <a href="<?php echo e(route('admin.jobs.index')); ?>" class="stat-tile <?php echo e($counts['jobs'] === 0 ? 'stat-tile--warn' : ''); ?>" style="text-decoration:none;">
        <div class="stat-tile-icon stat-tile-icon--green">💼</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num"><?php echo e($counts['jobs']); ?></div>
            <div class="stat-tile-lbl">Offres publiées</div>
            <?php if($counts['jobs_expiring'] > 0): ?>
            <div class="stat-tile-sub" style="color:#854d0e;">⚠ <?php echo e($counts['jobs_expiring']); ?> expire(nt) bientôt</div>
            <?php else: ?>
            <div class="stat-tile-sub">Aucune expiration prochaine</div>
            <?php endif; ?>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

    <a href="<?php echo e(route('admin.applications.index')); ?>" class="stat-tile <?php echo e($counts['applications_new'] > 0 ? 'stat-tile--alert' : ''); ?>" style="text-decoration:none;">
        <div class="stat-tile-icon <?php echo e($counts['applications_new'] > 0 ? 'stat-tile-icon--red' : ''); ?>">📋</div>
        <div class="stat-tile-body">
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-tile-num"><?php echo e($counts['applications']); ?></div>
                <?php if($trends['applications']['direction'] !== 'stable'): ?>
                <span style="font:600 11px Inter,sans-serif; color:<?php echo e($trends['applications']['direction'] === 'up' ? '#10b981' : '#ef4444'); ?>;">
                    <?php echo e($trends['applications']['direction'] === 'up' ? '↗' : '↘'); ?> <?php echo e(abs($trends['applications']['percent'])); ?>%
                </span>
                <?php endif; ?>
            </div>
            <div class="stat-tile-lbl">Candidatures</div>
            <?php if($counts['applications_new'] > 0): ?>
            <div class="stat-tile-sub" style="color:#991b1b; font-weight:600;">🔴 <?php echo e($counts['applications_new']); ?> nouvelle(s)</div>
            <?php else: ?>
            <div class="stat-tile-sub">Tout examiné ✓</div>
            <?php endif; ?>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

    <a href="<?php echo e(route('admin.messages.index')); ?>" class="stat-tile <?php echo e($counts['messages'] > 0 ? 'stat-tile--alert' : ''); ?>" style="text-decoration:none;">
        <div class="stat-tile-icon <?php echo e($counts['messages'] > 0 ? 'stat-tile-icon--red' : 'stat-tile-icon--green'); ?>">✉️</div>
        <div class="stat-tile-body">
            <div style="display:flex; align-items:baseline; gap:8px;">
                <div class="stat-tile-num"><?php echo e($counts['messages']); ?></div>
                <?php if($trends['messages']['direction'] !== 'stable'): ?>
                <span style="font:600 11px Inter,sans-serif; color:<?php echo e($trends['messages']['direction'] === 'up' ? '#10b981' : '#ef4444'); ?>;">
                    <?php echo e($trends['messages']['direction'] === 'up' ? '↗' : '↘'); ?> <?php echo e(abs($trends['messages']['percent'])); ?>%
                </span>
                <?php endif; ?>
            </div>
            <div class="stat-tile-lbl">Messages non lus</div>
            <div class="stat-tile-sub"><?php echo e($counts['messages_total']); ?> au total</div>
        </div>
        <span class="stat-tile-arrow">→</span>
    </a>

</div>


<div class="card" style="margin-bottom:28px;">
    <div class="card-header">
        <h2>📊 Activité des 7 derniers jours</h2>
        <span class="card-header-sub">Évolution quotidienne du contenu</span>
    </div>
    <div class="card-body" style="padding:24px;">
        <div style="display:grid; grid-template-columns:repeat(7,1fr); gap:12px; margin-bottom:16px;">
            <?php $__currentLoopData = $last7Days; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $day): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div style="display:flex; flex-direction:column; gap:6px; align-items:center;">
                <div style="font:600 11px Inter,sans-serif; color:var(--muted); text-transform:uppercase; letter-spacing:.05em;">
                    <?php echo e($day['day']); ?>

                </div>
                <div style="font:700 13px Inter,sans-serif; color:var(--ink); margin-bottom:4px;">
                    <?php echo e($day['date']); ?>

                </div>
                
                <?php
                    $maxHeight = 80;
                    $maxValue = max(1, $last7Days->max('news'), $last7Days->max('applications'), $last7Days->max('messages'));
                    $newsHeight = $day['news'] > 0 ? max(4, ($day['news'] / $maxValue) * $maxHeight) : 0;
                    $appHeight = $day['applications'] > 0 ? max(4, ($day['applications'] / $maxValue) * $maxHeight) : 0;
                    $msgHeight = $day['messages'] > 0 ? max(4, ($day['messages'] / $maxValue) * $maxHeight) : 0;
                ?>
                
                <div style="display:flex; align-items:flex-end; gap:3px; height:<?php echo e($maxHeight); ?>px;">
                    <div style="width:14px; height:<?php echo e($newsHeight); ?>px; background:#3b82f6; border-radius:3px 3px 0 0;" 
                         title="Actualités: <?php echo e($day['news']); ?>"></div>
                    <div style="width:14px; height:<?php echo e($appHeight); ?>px; background:#10b981; border-radius:3px 3px 0 0;" 
                         title="Candidatures: <?php echo e($day['applications']); ?>"></div>
                    <div style="width:14px; height:<?php echo e($msgHeight); ?>px; background:#f59e0b; border-radius:3px 3px 0 0;" 
                         title="Messages: <?php echo e($day['messages']); ?>"></div>
                </div>
                
                <div style="font:600 10px Inter,sans-serif; color:var(--muted);">
                    <?php echo e($day['news'] + $day['applications'] + $day['messages']); ?>

                </div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        
        <div style="display:flex; justify-content:center; gap:20px; padding-top:12px; border-top:1px solid var(--line);">
            <div style="display:flex; align-items:center; gap:6px; font:12px Inter,sans-serif; color:var(--muted);">
                <div style="width:12px; height:12px; background:#3b82f6; border-radius:2px;"></div>
                Actualités (<?php echo e($trends['news']['current']); ?>)
            </div>
            <div style="display:flex; align-items:center; gap:6px; font:12px Inter,sans-serif; color:var(--muted);">
                <div style="width:12px; height:12px; background:#10b981; border-radius:2px;"></div>
                Candidatures (<?php echo e($trends['applications']['current']); ?>)
            </div>
            <div style="display:flex; align-items:center; gap:6px; font:12px Inter,sans-serif; color:var(--muted);">
                <div style="width:12px; height:12px; background:#f59e0b; border-radius:2px;"></div>
                Messages (<?php echo e($trends['messages']['current']); ?>)
            </div>
        </div>
    </div>
</div>


<?php if(!empty($applicationStats)): ?>
<div class="card" style="margin-bottom:28px;">
    <div class="card-header">
        <h2>📋 Répartition des candidatures</h2>
        <a href="<?php echo e(route('admin.applications.index')); ?>" class="btn btn-ghost btn-sm">Voir tout →</a>
    </div>
    <div class="card-body" style="padding:24px;">
        <?php
            $statusLabels = [
                'new' => ['label' => 'Nouvelles', 'color' => '#f59e0b', 'icon' => '🆕'],
                'reviewing' => ['label' => 'En examen', 'color' => '#3b82f6', 'icon' => '👀'],
                'interview' => ['label' => 'Entretien', 'color' => '#8b5cf6', 'icon' => '💬'],
                'accepted' => ['label' => 'Acceptées', 'color' => '#10b981', 'icon' => '✅'],
                'rejected' => ['label' => 'Refusées', 'color' => '#6b7280', 'icon' => '❌']
            ];
            $totalApps = array_sum($applicationStats);
        ?>
        
        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(140px, 1fr)); gap:16px;">
            <?php $__currentLoopData = $statusLabels; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status => $info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php $count = $applicationStats[$status] ?? 0; ?>
                <div style="text-align:center; padding:16px; border:2px solid <?php echo e($count > 0 ? $info['color'] : '#e5e7eb'); ?>; border-radius:10px; background:<?php echo e($count > 0 ? $info['color'].'15' : '#fafafa'); ?>;">
                    <div style="font-size:24px; margin-bottom:8px;"><?php echo e($info['icon']); ?></div>
                    <div style="font:700 28px Inter,sans-serif; color:<?php echo e($info['color']); ?>; margin-bottom:4px;">
                        <?php echo e($count); ?>

                    </div>
                    <div style="font:600 12px Inter,sans-serif; color:var(--muted); text-transform:uppercase; letter-spacing:.05em;">
                        <?php echo e($info['label']); ?>

                    </div>
                    <?php if($totalApps > 0): ?>
                    <div style="font:11px Inter,sans-serif; color:var(--muted); margin-top:4px;">
                        <?php echo e(round(($count / $totalApps) * 100)); ?>%
                    </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</div>
<?php endif; ?>


<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:12px; margin-bottom:28px;">
    <a href="<?php echo e(route('admin.hero.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🎬</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['hero_slides'] ?? 0); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Carrousel</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.reports.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">📄</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['reports']); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Publications</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.press.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">📢</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['press']); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Communiqués</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.media.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🖼️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['media']); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Médias</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.newsletter.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">📧</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['newsletter'] ?? 0); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Abonnés</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.certifications.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🏆</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['certifications'] ?? 0); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Certifications</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.partners.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">🤝</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;"><?php echo e($counts['partners']); ?></div>
            <div class="stat-tile-lbl" style="font-size:11px;">Partenaires</div>
        </div>
    </a>
    <a href="<?php echo e(route('admin.settings.index')); ?>" class="stat-tile stat-tile--compact" style="text-decoration:none;">
        <div class="stat-tile-icon" style="font-size:20px;">⚙️</div>
        <div class="stat-tile-body">
            <div class="stat-tile-num" style="font-size:20px;">∞</div>
            <div class="stat-tile-lbl" style="font-size:11px;">Paramètres</div>
        </div>
    </a>
</div>


<div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:20px; align-items:start;">

    
    <div class="card">
        <div class="card-header">
            <h2>📰 Dernières actualités</h2>
            <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary btn-sm">+ Ajouter</a>
        </div>
        <div style="divide-y">
            <?php $__empty_1 = true; $__currentLoopData = $recentNews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $news): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <a href="<?php echo e(route('admin.news.edit', $news)); ?>"
               style="display:flex; align-items:center; gap:12px; padding:12px 20px; border-bottom:1px solid #f5f0e8; transition:background .15s; text-decoration:none;"
               onmouseover="this.style.background='#faf8f4'" onmouseout="this.style.background=''">
                <div style="flex:1; min-width:0;">
                    <div style="font:600 13px Inter,sans-serif; color:var(--green); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                        <?php echo e($news->title); ?>

                    </div>
                    <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:2px;">
                        <?php echo e($news->category); ?> · <?php echo e($news->created_at->diffForHumans()); ?>

                    </div>
                </div>
                <?php if($news->published_at && $news->published_at->isPast()): ?>
                    <span class="badge badge-green" style="flex-shrink:0;">Pub.</span>
                <?php elseif($news->published_at): ?>
                    <span class="badge badge-yellow" style="flex-shrink:0;">Plan.</span>
                <?php else: ?>
                    <span class="badge badge-gray" style="flex-shrink:0;">Brouil.</span>
                <?php endif; ?>
            </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div style="padding:20px; text-align:center; color:var(--muted); font-size:13px;">Aucune actualité</div>
            <?php endif; ?>
        </div>
        <div style="padding:12px 20px; border-top:1px solid var(--line); background:#faf8f4;">
            <a href="<?php echo e(route('admin.news.index')); ?>" style="font:600 12px Inter,sans-serif; color:var(--green);">
                Voir toutes les actualités →
            </a>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h2>✉️ Messages récents</h2>
            <?php if($counts['messages'] > 0): ?>
            <span class="badge badge-red"><?php echo e($counts['messages']); ?> non lu(s)</span>
            <?php endif; ?>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $recentMessages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $msg): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <a href="<?php echo e(route('admin.messages.show', $msg)); ?>"
           style="display:flex; align-items:flex-start; gap:12px; padding:12px 20px; border-bottom:1px solid #f5f0e8; transition:background .15s; text-decoration:none; <?php echo e(!$msg->read_at ? 'background:#fffbf0;' : ''); ?>"
           onmouseover="this.style.background='#faf8f4'" onmouseout="this.style.background='<?php echo e(!$msg->read_at ? '#fffbf0' : ''); ?>'">
            
            <div style="width:32px; height:32px; border-radius:50%; background:var(--green); color:#fff; display:flex; align-items:center; justify-content:center; font:700 12px Inter,sans-serif; flex-shrink:0;">
                <?php echo e(strtoupper(substr($msg->name, 0, 1))); ?>

            </div>
            <div style="flex:1; min-width:0;">
                <div style="display:flex; align-items:center; gap:6px;">
                    <span style="font:600 13px Inter,sans-serif; color:var(--green);"><?php echo e($msg->name); ?></span>
                    <?php if(!$msg->read_at): ?><span style="width:6px;height:6px;border-radius:50%;background:var(--red);display:inline-block;"></span><?php endif; ?>
                </div>
                <div style="font:12px Inter,sans-serif; color:var(--muted);">
                    <?php echo e($msg->type); ?> · <?php echo e($msg->created_at->diffForHumans()); ?>

                </div>
            </div>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="padding:20px; text-align:center; color:var(--muted); font-size:13px;">Aucun message</div>
        <?php endif; ?>
        <div style="padding:12px 20px; border-top:1px solid var(--line); background:#faf8f4;">
            <a href="<?php echo e(route('admin.messages.index')); ?>" style="font:600 12px Inter,sans-serif; color:var(--green);">
                Voir tous les messages →
            </a>
        </div>
    </div>

    
    <div class="card">
        <div class="card-header">
            <h2>📋 Candidatures récentes</h2>
            <?php if($counts['applications_new'] > 0): ?>
            <span class="badge badge-orange"><?php echo e($counts['applications_new']); ?> nou.</span>
            <?php endif; ?>
        </div>
        <?php $__empty_1 = true; $__currentLoopData = $recentApplications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php
            $statusColors = ['new'=>'badge-orange','reviewing'=>'badge-blue','interview'=>'badge-blue','accepted'=>'badge-green','rejected'=>'badge-gray'];
            $statusLabels = ['new'=>'Nouveau','reviewing'=>'Examen','interview'=>'Entretien','accepted'=>'Accepté','rejected'=>'Refusé'];
        ?>
        <a href="<?php echo e(route('admin.applications.show', $app)); ?>"
           style="display:flex; align-items:flex-start; gap:12px; padding:12px 20px; border-bottom:1px solid #f5f0e8; transition:background .15s; text-decoration:none;"
           onmouseover="this.style.background='#faf8f4'" onmouseout="this.style.background=''">
            <div style="width:32px; height:32px; border-radius:50%; background:#dbeafe; color:#1e40af; display:flex; align-items:center; justify-content:center; font:700 12px Inter,sans-serif; flex-shrink:0;">
                <?php echo e(strtoupper(substr($app->first_name, 0, 1))); ?>

            </div>
            <div style="flex:1; min-width:0;">
                <div style="font:600 13px Inter,sans-serif; color:var(--green); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    <?php echo e($app->first_name); ?> <?php echo e($app->last_name); ?>

                </div>
                <div style="font:12px Inter,sans-serif; color:var(--muted); white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">
                    <?php echo e($app->jobOffer?->title ?? 'Candidature spontanée'); ?>

                </div>
            </div>
            <span class="badge <?php echo e($statusColors[$app->status] ?? 'badge-gray'); ?>" style="flex-shrink:0; font-size:10px;">
                <?php echo e($statusLabels[$app->status] ?? $app->status); ?>

            </span>
        </a>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="padding:20px; text-align:center; color:var(--muted); font-size:13px;">Aucune candidature</div>
        <?php endif; ?>
        <div style="padding:12px 20px; border-top:1px solid var(--line); background:#faf8f4;">
            <a href="<?php echo e(route('admin.applications.index')); ?>" style="font:600 12px Inter,sans-serif; color:var(--green);">
                Voir toutes les candidatures →
            </a>
        </div>
    </div>

</div>


<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>⚡ Actions rapides</h2>
        <span class="card-header-sub">Créer du contenu en un clic</span>
    </div>
    <div class="card-body">
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:12px;">
            <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>📰</span> Nouvelle actualité
            </a>
            <a href="<?php echo e(route('admin.jobs.create')); ?>" class="btn btn-gold" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>💼</span> Nouvelle offre d'emploi
            </a>
            <a href="<?php echo e(route('admin.reports.create')); ?>" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>📄</span> Nouvelle publication
            </a>
            <a href="<?php echo e(route('admin.press.create')); ?>" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>📢</span> Nouveau communiqué
            </a>
            <a href="<?php echo e(route('admin.media.create')); ?>" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>🖼️</span> Ajouter un média
            </a>
            <a href="<?php echo e(route('admin.partners.create')); ?>" class="btn btn-ghost" style="display:flex; align-items:center; justify-content:center; gap:8px;">
                <span>🤝</span> Ajouter un partenaire
            </a>
        </div>
    </div>
</div>


<script>
document.addEventListener('keydown', function(e) {
    // Alt + N : Nouvelle actualité
    if (e.altKey && e.key === 'n') {
        e.preventDefault();
        window.location.href = '<?php echo e(route("admin.news.create")); ?>';
    }
    // Alt + J : Nouvelle offre d'emploi
    if (e.altKey && e.key === 'j') {
        e.preventDefault();
        window.location.href = '<?php echo e(route("admin.jobs.create")); ?>';
    }
    // Alt + M : Messages
    if (e.altKey && e.key === 'm') {
        e.preventDefault();
        window.location.href = '<?php echo e(route("admin.messages.index")); ?>';
    }
    // Alt + C : Candidatures
    if (e.altKey && e.key === 'c') {
        e.preventDefault();
        window.location.href = '<?php echo e(route("admin.applications.index")); ?>';
    }
});
</script>


<style>
.stat-tile--compact {
    padding: 16px 14px !important;
    min-height: auto !important;
}
.stat-tile--compact .stat-tile-arrow {
    display: none;
}

@media(max-width:1200px){
    div[style*="grid-template-columns:1fr 1fr 1fr"] { grid-template-columns:1fr 1fr !important; }
    div[style*="grid-template-columns:2fr 1fr"] { grid-template-columns:1fr !important; }
}
@media(max-width:800px){
    div[style*="grid-template-columns:1fr 1fr 1fr"] { grid-template-columns:1fr !important; }
    div[style*="grid-template-columns:repeat(4,1fr)"] { grid-template-columns:1fr 1fr !important; }
    div[style*="grid-template-columns:repeat(3,1fr)"] { grid-template-columns:1fr 1fr !important; }
}
</style>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\dashboard.blade.php ENDPATH**/ ?>