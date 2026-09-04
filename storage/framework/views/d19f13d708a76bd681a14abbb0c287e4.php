<?php $__env->startSection('content'); ?>

<style>
    .career-hero { display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center; margin-bottom:60px; }
    .career-stat { display:flex; flex-direction:column; align-items:center; text-align:center; gap:8px; }
    .career-stat-num { font-size:36px; font-weight:700; color:var(--green); }
    .career-stat-label { font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; }
    .job-badge { display:inline-block; background:var(--gold); color:var(--ink); padding:4px 8px; border-radius:4px; font-size:11px; font-weight:600; margin-right:6px; }
</style>

<section class="sa-animated-section" style="padding-top:40px;">
    
    <div class="career-hero">
        <div class="sa-reveal sa-delay-1">
            <h1 style="font-size:42px; font-weight:600; color:var(--green); line-height:1.2; margin-bottom:16px;"><?php echo e($en ? 'Join Our Team' : 'Rejoignez Notre Équipe'); ?></h1>
            <div class="sa-divider" style="margin-left:0;"></div>
            <p class="lead" style="margin-top:20px;"><?php echo e(__('site.careers_why_lead', [], $loc)); ?></p>
        </div>
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="career-stat sa-reveal sa-delay-1">
                <div class="career-stat-num">409</div>
                <div class="career-stat-label"><?php echo e($en ? 'Direct employees' : 'Emplois directs'); ?></div>
            </div>
            <div class="career-stat sa-reveal sa-delay-2">
                <div class="career-stat-num">99%</div>
                <div class="career-stat-label"><?php echo e($en ? 'Burkinabè Staff' : 'Personnel Burkinabè'); ?></div>
            </div>
            <div class="career-stat sa-reveal sa-delay-3">
                <div class="career-stat-num">1 500</div>
                <div class="career-stat-label"><?php echo e($en ? 'Subcontracted workers' : 'Travailleurs sous-traitants'); ?></div>
            </div>
            <div class="career-stat sa-reveal sa-delay-4">
                <div class="career-stat-num">∞</div>
                <div class="career-stat-label"><?php echo e($en ? 'Growth Potential' : 'Potentiel Croissance'); ?></div>
            </div>
        </div>
    </div>

    
    <div class="grid-3" style="margin-bottom:60px;">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card sa-reveal sa-delay-<?php echo e($i); ?>">
            <div class="card-tag"><?php echo e(__('site.careers_why'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.careers_why'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.careers_why'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>

    
    <section class="sa-animated-section" style="margin-bottom:60px;">
        <div class="sa-particles-container" data-count="3"></div>
        <div class="sa-section-heading sa-reveal">
            <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:32px; font-weight:600;"><?php echo e(__('site.careers_jobs_lead', [], $loc)); ?></h2>
            <div class="sa-divider"></div>
            <p style="text-align:center; color:var(--muted); font-size:14px; margin-bottom:32px; line-height:1.7;"><?php echo e($en ? 'We are continuously looking for talented professionals to join our growing team at Karma mine.' : 'Nous recherchons continuellement des professionnels talentueux pour rejoindre notre équipe croissante.'); ?></p>
        </div>

        <div class="grid-3">
            <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <article class="card sa-reveal sa-delay-<?php echo e($index % 3 + 1); ?>">
                <div class="card-tag"><?php echo e($job->department); ?></div>
                <h3><?php echo e($job->title); ?></h3>
                <p><?php echo e($job->location); ?> · <?php echo e($job->contract_type); ?></p>
                <p><?php echo e($job->description); ?></p>
                <?php if($job->deadline): ?>
                <p style="font:500 12px Inter,sans-serif; color:var(--muted);">
                    <?php echo e(__('site.careers_deadline', [], $loc)); ?> <?php echo e($job->deadline->format('d/m/Y')); ?>

                </p>
                <?php endif; ?>
                <a class="sa-btn-animated"
                   style="margin-top:16px; display:inline-block;"
                   href="<?php echo e(($en ? route('english.contact') : route('contact'))); ?>?type=emploi&subject=<?php echo e(urlencode($job->title)); ?>">
                    <span><?php echo e(__('site.careers_apply', [], $loc)); ?></span>
                </a>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            
            <?php
            $sampleJobs = [
                ['title' => $en ? 'Mining Operations Manager' : 'Manager Opérations Minières', 'dept' => $en ? 'Operations' : 'Opérations', 'loc' => 'Karma', 'desc' => $en ? 'Lead mining operations team, oversee production targets and safety protocols.' : 'Diriger équipe opérations minières, superviser objectifs production et protocoles sécurité.'],
                ['title' => $en ? 'Environmental Officer' : 'Officier Environnemental', 'dept' => $en ? 'Environment' : 'Environnement', 'loc' => 'Karma', 'desc' => $en ? 'Monitor environmental compliance, conduct assessments, manage mitigation programs.' : 'Surveiller conformité environnementale, effectuer évaluations, gérer programmes mitigation.'],
                ['title' => $en ? 'Safety Supervisor' : 'Superviseur Sécurité', 'dept' => $en ? 'HSE' : 'HSE', 'loc' => 'Karma', 'desc' => $en ? 'Ensure workplace safety, conduct trainings, investigate incidents.' : 'Assurer sécurité travail, conduire formations, enquêter incidents.'],
                ['title' => $en ? 'Process Engineer' : 'Ingénieur Procédé', 'dept' => $en ? 'Processing' : 'Traitement', 'loc' => 'Karma', 'desc' => $en ? 'Optimize processing plant efficiency, maintain equipment, troubleshoot issues.' : 'Optimiser efficacité usine traitement, maintenir équipements, résoudre problèmes.'],
                ['title' => $en ? 'Geologist' : 'Géologue', 'dept' => $en ? 'Exploration' : 'Exploration', 'loc' => 'Karma', 'desc' => $en ? 'Conduct geological surveys, analyze drilling data, assess ore grades.' : 'Effectuer levés géologiques, analyser données forage, évaluer teneurs.'],
                ['title' => $en ? 'Community Relations Officer' : 'Officier Relations Communautaires', 'dept' => $en ? 'Communities' : 'Communautés', 'loc' => 'Ouagadougou', 'desc' => $en ? 'Manage stakeholder relations, coordinate community programs, handle grievances.' : 'Gérer relations parties prenantes, coordonner programmes communautaires, traiter griefs.'],
                ['title' => $en ? 'Equipment Technician' : 'Technicien Équipements', 'dept' => $en ? 'Maintenance' : 'Maintenance', 'loc' => 'Karma', 'desc' => $en ? 'Maintain mining and processing equipment, perform repairs, conduct diagnostics.' : 'Maintenir équipements miniers et traitement, effectuer réparations, diagnostiquer.'],
                ['title' => $en ? 'HR Specialist' : 'Spécialiste RH', 'dept' => $en ? 'Human Resources' : 'Ressources Humaines', 'loc' => 'Ouagadougou', 'desc' => $en ? 'Recruitment, employee development, payroll administration, training programs.' : 'Recrutement, développement employés, paie, programmes formation.'],
            ];
            ?>
            <?php $__currentLoopData = $sampleJobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $job): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <article class="card sa-reveal sa-delay-<?php echo e($index % 3 + 1); ?>">
                <div class="card-tag"><?php echo e($job['dept']); ?></div>
                <h3><?php echo e($job['title']); ?></h3>
                <p><span class="job-badge"><?php echo e($job['loc']); ?></span></p>
                <p style="color:var(--muted); font-size:14px; line-height:1.7;"><?php echo e($job['desc']); ?></p>
                <a class="sa-btn-animated"
                   style="margin-top:16px; display:inline-block;"
                   href="<?php echo e(($en ? route('english.contact') : route('contact'))); ?>?type=emploi&subject=<?php echo e(urlencode($job['title'])); ?>">
                    <span><?php echo e(__('site.careers_apply', [], $loc)); ?></span>
                </a>
            </article>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </section>

    
    <section class="sa-sand-animated" style="position:relative; margin-bottom:60px; border-radius:12px; padding:60px 40px; overflow:hidden;">
        <div class="sa-wave-top"></div>
        <div style="position:relative; z-index:1;">
            <div class="sa-section-heading sa-reveal">
                <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:32px; font-weight:600;"><?php echo e($en ? 'Life at Néré Mining' : 'La Vie chez Néré Mining'); ?></h2>
                <div class="sa-divider"></div>
            </div>
            
            <div class="grid-2" style="margin-top:40px;">
                <div class="sa-reveal sa-delay-1">
                    <h3 style="color:var(--green); margin-bottom:16px; font-size:18px; font-weight:600;"><?php echo e($en ? 'Our Culture' : 'Notre Culture'); ?></h3>
                    <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Teamwork and collaboration in all we do' : 'Travail d\'équipe et collaboration dans tout ce que nous faisons'); ?></li>
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Results-oriented mindset with shared goals' : 'Mentalité orientée résultats avec objectifs partagés'); ?></li>
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Clear behavioral standards and ethics' : 'Standards de comportement clairs et éthique'); ?></li>
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Safety as our top priority' : 'Sécurité notre priorité absolue'); ?></li>
                        <li>✓ <?php echo e($en ? 'Respect for all community members' : 'Respect pour tous les membres communautaires'); ?></li>
                    </ul>
                </div>
                <div class="sa-reveal sa-delay-2">
                    <h3 style="color:var(--green); margin-bottom:16px; font-size:18px; font-weight:600;"><?php echo e($en ? 'Benefits & Development' : 'Avantages & Développement'); ?></h3>
                    <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Competitive salary and benefits package' : 'Salaire compétitif et package avantages'); ?></li>
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Training and professional development' : 'Formation et développement professionnel'); ?></li>
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Career advancement opportunities' : 'Opportunités d\'avancement carrière'); ?></li>
                        <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Health & safety insurance coverage' : 'Couverture assurance santé & sécurité'); ?></li>
                        <li>✓ <?php echo e($en ? 'Work-life balance and flexibility' : 'Équilibre vie-travail et flexibilité'); ?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="sa-wave-bottom"></div>
    </section>

    
    <section class="sa-animated-section sa-reveal" style="text-align:center;">
        <h2 style="color:var(--green); margin-bottom:16px; font-size:28px; font-weight:600;"><?php echo e($en ? 'Ready to Join Néré Mining?' : 'Prêt à Rejoindre Néré Mining ?'); ?></h2>
        <p style="color:var(--muted); font-size:14px; margin-bottom:24px; line-height:1.7;"><?php echo e($en ? 'Explore our open positions, apply directly, or send us your CV for future opportunities.' : 'Explorez nos postes ouverts, postulez directement, ou envoyez-nous votre CV pour opportunités futures.'); ?></p>
        <div style="display:flex; gap:16px; justify-content:center; flex-wrap:wrap;">
            <a class="sa-btn-animated"
               href="<?php echo e($en ? route('english.contact') : route('contact')); ?>">
                <span><?php echo e(__('site.careers_apply', [], $loc)); ?></span>
            </a>
            <a class="btn btn-outline"
               href="<?php echo e($en ? route('english.spontaneous') : route('spontaneous')); ?>">
                <?php echo e(__('site.spontaneous', [], $loc)); ?>

            </a>
        </div>
    </section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\careers.blade.php ENDPATH**/ ?>