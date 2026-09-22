


<?php $__env->startPush('styles'); ?>
<link rel="stylesheet" href="<?php echo e(asset('css/sustainability-animations.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>


<section class="sa-animated-section" style="padding-top:40px;">
    <div class="sa-particles-container" data-count="5"></div>

    <p class="lead sa-reveal"><?php echo e(__('site.hse_policy_lead', [], $loc)); ?></p>

    <div class="grid-3" style="margin-top:24px;">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="sa-program-card sa-reveal sa-delay-<?php echo e($i); ?>">
            <div class="card-tag"><?php echo e(__('site.hse_policy'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.hse_policy'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.hse_policy'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sa-sand-animated hse-commitment" style="padding:70px 5vw; position:relative;">
    <div style="max-width:980px; margin:0 auto; position:relative; z-index:1;">
        <div class="sa-section-heading sa-reveal">
            
            <div class="sa-divider"></div>
        </div>

        <div class="hse-commitment__body sa-reveal sa-delay-1">
            <p>Chez Riverstone Karma, la santé et la sécurité des personnes constituent une priorité fondamentale. Notre ambition est de mener nos activités « sans préjudice », en mettant en place et en maintenant un système efficace de gestion de la santé et de la sécurité au travail. Nous nous engageons à respecter les lois, réglementations, normes applicables et bonnes pratiques en matière de santé et de sécurité, et à offrir à nos employés, sous-traitants et autres parties prenantes un environnement de travail sûr et sain.</p>

            <p>La prévention des risques repose sur la responsabilité de tous, à tous les niveaux de l'organisation. Riverstone Karma veille à mettre à disposition les ressources, équipements de protection et formations nécessaires, tout en favorisant la participation et la consultation des travailleurs. Chaque collaborateur est encouragé à contribuer à sa propre sécurité et à celle de ses collègues, à signaler les situations dangereuses et bénéficie du droit de refuser un travail présentant un danger. La prévention, l'évaluation et la réduction continue des risques professionnels constituent ainsi des principes essentiels de nos opérations.</p>

            <p>Nous nous inscrivons également dans une démarche d'amélioration continue, fondée sur des systèmes de gestion conformes à des normes reconnues internationalement, des audits périodiques, le suivi de nos performances et une communication ouverte avec nos employés et parties prenantes. Nous ne tolérons aucune violation délibérée des règles de santé et de sécurité. Toute situation ou condition de travail susceptible de présenter un risque peut être signalée en toute confidentialité par téléphone, par courriel ou au moyen des boîtes à idées disponibles sur le site.</p>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">

        
        <div class="hse-progression-scale sa-reveal" style="margin-top:0; margin-bottom:40px; background:linear-gradient(135deg,#4b1716,#2d0d10); border-radius:20px; padding:48px 32px; position:relative; overflow:hidden; box-shadow:0 20px 60px rgba(40,29,24,0.3);">
            
            <!-- Subtle static gradient background -->
            <div style="position:absolute; inset:0; background:radial-gradient(circle at 20% 50%, rgba(255,194,71,0.03), transparent 50%); pointer-events:none;"></div>
            
            <!-- Connecting line with animated glow -->
            <svg style="position:absolute; inset:0; width:100%; height:100%; pointer-events:none;" preserveAspectRatio="none">
                <defs>
                    <linearGradient id="lineGrad" x1="0%" y1="0%" x2="100%" y2="100%">
                        <stop offset="0%" style="stop-color:rgba(255,194,71,0);stop-opacity:0" />
                        <stop offset="50%" style="stop-color:rgba(255,194,71,0.6);stop-opacity:1" />
                        <stop offset="100%" style="stop-color:rgba(255,194,71,0);stop-opacity:0" />
                    </linearGradient>
                </defs>
                <polyline points="12%,80% 37%,60% 62%,40% 87%,20%" fill="none" stroke="url(#lineGrad)" stroke-width="3" stroke-linecap="round" style="filter:drop-shadow(0 0 8px rgba(255,194,71,0.4)); animation:drawLine 2s ease-out forwards;"/>
            </svg>
            
            <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; position:relative; z-index:1;">
                <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="hse-step-item sa-reveal sa-delay-<?php echo e($i); ?>" style="text-align:center; padding:<?php echo e(32 + ($i-1)*8); ?>px 24px; background:linear-gradient(135deg,rgba(255,255,255,<?php echo e(0.05 + ($i-1)*0.03); ?>),rgba(255,194,71,<?php echo e(0.01 + ($i-1)*0.02); ?>)); border:1px solid rgba(255,194,71,<?php echo e(0.3 + ($i-1)*0.15); ?>); border-radius:16px; transition:all .4s cubic-bezier(0.34,1.56,0.64,1); position:relative; top:<?php echo e(($i-1)*10); ?>px; cursor:pointer; overflow:hidden;"
                     onmouseover="this.style.background='linear-gradient(135deg,rgba(255,194,71,0.15),rgba(255,194,71,0.08))'; this.style.transform='translateY(-8px) scale(1.02)'; this.style.boxShadow='0 12px 40px rgba(255,194,71,0.2)';"
                     onmouseout="this.style.background='linear-gradient(135deg,rgba(255,255,255,<?php echo e(0.05 + ($i-1)*0.03); ?>),rgba(255,194,71,<?php echo e(0.01 + ($i-1)*0.02); ?>))'; this.style.transform=''; this.style.boxShadow='none';">
                    
                    <!-- Shine effect background -->
                    <div style="position:absolute; inset:0; background:linear-gradient(90deg,transparent,rgba(255,255,255,0.1),transparent); animation:shine 3s ease-in-out infinite; pointer-events:none;"></div>
                    
                    <!-- Stat value -->
                    <div class="hse-step-value" style="color:rgba(255,194,71,<?php echo e(0.8 + ($i-1)*0.15); ?>); font-size:<?php echo e(28 + ($i-1)*2); ?>px; font-weight:700; margin-bottom:12px; letter-spacing:.02em; position:relative; z-index:1; animation:fadeInUp 0.8s ease-out <?php echo e($i * 0.15); ?>s both;"><?php echo e(__('site.hse_stat'.$i.'_val', [], $loc)); ?></div>
                    
                    <!-- Description with larger font -->
                    <div style="color:rgba(255,255,255,<?php echo e(0.75 + ($i-1)*0.1); ?>); font-size:<?php echo e(14 + ($i-1)*1); ?>px; line-height:1.6; text-align:center; font-weight:500; position:relative; z-index:1; animation:fadeInUp 0.8s ease-out <?php echo e($i * 0.15 + 0.1); ?>s both;"><?php echo e(__('site.hse_stat'.$i.'_label', [], $loc)); ?></div>
                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
        
        <style>
            @keyframes shine {
                0% { transform: translateX(-100%); }
                50% { transform: translateX(100%); }
                100% { transform: translateX(100%); }
            }
            @keyframes drawLine {
                from { stroke-dasharray: 300; stroke-dashoffset: 300; }
                to { stroke-dasharray: 300; stroke-dashoffset: 0; }
            }
            @keyframes fadeInUp {
                from { opacity: 0; transform: translateY(10px); }
                to { opacity: 1; transform: translateY(0); }
            }
            .hse-step-item:hover {
                box-shadow: 0 16px 48px rgba(255,194,71,0.25) !important;
            }
        </style>

        <div class="grid-3">
            <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-step-card sa-reveal sa-delay-<?php echo e($i); ?>" data-step="<?php echo e($i); ?>">
                <div class="card-tag"><?php echo e(__('site.hse_card'.$i.'_tag', [], $loc)); ?></div>
                <h3><?php echo e(__('site.hse_card'.$i.'_h3', [], $loc)); ?></h3>
                <p><?php echo e(__('site.hse_card'.$i.'_p', [], $loc)); ?></p>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>


<section class="sa-dark-section" style="padding:70px 5vw; color:#fff;">
    <div style="max-width:960px; margin:0 auto; text-align:center; position:relative; z-index:1;">

        <div class="sa-reveal">
            <div style="font-size:48px; margin-bottom:20px;">⚖️</div>
            
            <div style="width:60px; height:3px; background:linear-gradient(90deg,var(--gold),var(--gold2)); border-radius:2px; margin:0 auto 24px;"></div>
            <p style="color:rgba(255,255,255,0.8); font-size:16px; line-height:1.8; max-width:700px; margin:0 auto 32px; text-align:center;">
                <?php echo e($en
                    ? 'Néré Mining relies on internal controls, inspections and independent reviews to strengthen operational discipline and accountability.'
                    : 'Néré Mining s\'appuie sur des contrôles internes, des inspections et des revues indépendantes pour renforcer la discipline opérationnelle et la responsabilité.'); ?>

            </p>
        </div>

        
        <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:16px; margin-top:16px;">
            <?php $__currentLoopData = [
                ['icon'=>'📋','label'=>$en?'Internal Controls':'Contrôles Internes'],
                ['icon'=>'🔍','label'=>$en?'Independent Audits':'Audits Indépendants'],
                ['icon'=>'📈','label'=>$en?'Continuous Improvement':'Amélioration Continue'],
            ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $pilier): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-reveal sa-delay-<?php echo e($k+1); ?>" style="background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.12); border-radius:14px; padding:24px 16px; text-align:center; transition:background .3s, transform .3s; cursor:default;"
                 onmouseover="this.style.background='rgba(255,194,71,0.12)'; this.style.transform='translateY(-4px)'"
                 onmouseout="this.style.background='rgba(255,255,255,0.07)'; this.style.transform=''">
                <div style="font-size:32px; margin-bottom:10px;"><?php echo e($pilier['icon']); ?></div>
                <div style="font-size:13px; color:rgba(255,255,255,0.8); font-weight:500; letter-spacing:.04em; text-transform:uppercase;"><?php echo e($pilier['label']); ?></div>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>

<?php $__env->startPush('scripts'); ?>
<script src="<?php echo e(asset('js/sustainability-animations.js')); ?>"></script>
<?php $__env->stopPush(); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\hse.blade.php ENDPATH**/ ?>