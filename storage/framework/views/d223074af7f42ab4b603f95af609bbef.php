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


<section class="sa-sand-animated" style="padding:70px 5vw; position:relative;">
    <div class="sa-wave-top"></div>
    <div style="max-width:1180px; margin:0 auto; position:relative; z-index:1;">

        <div class="sa-section-heading sa-reveal">
            <h2><?php echo e($en ? 'Safety Performance' : 'Performance Sécurité'); ?></h2>
            <div class="sa-divider"></div>
            <p style="color:var(--muted); font-size:15px; line-height:1.8; margin:0;">
                <?php echo e($en ? 'Our commitment to zero harm drives continuous improvement.' : 'Notre engagement zéro accident guide amélioration continue.'); ?>

            </p>
        </div>

        
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:20px; margin-top:48px;">
            <?php
                $safetyKpis = [
                    ['icon'=>'📊','val'=>'0.8','count'=>'0.8','suffix'=>'','label'=>$en?'Lost Time Injury (LTI)':'Blessures avec Arrêt (LTI)','sub'=>$en?'per 1M hours worked':'par 1M heures travaillées','bar'=>'92%','green'=>true],
                    ['icon'=>'📋','val'=>'2.1','count'=>'2.1','suffix'=>'','label'=>$en?'Total Recordable Injury (TRIFR)':'Blessures Signalables (TRIFR)','sub'=>$en?'per 1M hours worked':'par 1M heures travaillées','bar'=>'78%','green'=>true],
                    ['icon'=>'⏱️','val'=>'14.2M','count'=>'14.2','suffix'=>'M','label'=>$en?'Safety-Free Hours':'Heures sans Incident','sub'=>$en?'cumulative 2024':'cumulatif 2024','bar'=>'100%','green'=>false],
                    ['icon'=>'🎓','val'=>'98%','count'=>98,'suffix'=>'%','label'=>$en?'Safety Training Compliance':'Conformité Formation Sécurité','sub'=>$en?'among all staff':'parmi tout le personnel','bar'=>'98%','green'=>false],
                ];
            ?>
            <?php $__currentLoopData = $safetyKpis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $kpi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="sa-metric-card sa-reveal sa-delay-<?php echo e($k+1); ?>">
                <div style="font-size:28px; margin-bottom:8px;"><?php echo e($kpi['icon']); ?></div>
                <div class="sa-metric-value sustain-metric__value"
                     style="font-size:clamp(30px,4vw,44px);"
                     data-count="<?php echo e($kpi['count']); ?>"
                     data-suffix="<?php echo e($kpi['suffix']); ?>"
                     data-original="<?php echo e($kpi['val']); ?>"><?php echo e($kpi['val']); ?></div>
                <div style="font-size:12px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em; margin-top:8px; line-height:1.4;"><?php echo e($kpi['label']); ?></div>
                <div style="font-size:11px; color:var(--muted); margin-top:4px; opacity:0.8;"><?php echo e($kpi['sub']); ?></div>
                <?php if(isset($kpi['bar'])): ?>
                <div class="sa-progress-bar" style="margin-top:12px;">
                    <div class="sa-progress-fill" data-width="<?php echo e($kpi['bar']); ?>"></div>
                </div>
                <?php endif; ?>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:start; margin-top:48px;">
            <div class="sa-program-card sa-reveal sa-delay-1">
                <div style="font-size:32px; margin-bottom:14px;">🛡️</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px;"><?php echo e($en ? 'Safety Culture' : 'Culture Sécurité'); ?></h3>
                <ul class="sa-animated-list">
                    <?php $__currentLoopData = [
                        $en?'Daily pre-work briefings (DPBs)':'Briefings pré-travail quotidiens',
                        $en?'Behavior-based safety programs':'Programmes sécurité comportementale',
                        $en?'Near-miss reporting system':'Système signalement presque-accidents',
                        $en?'Hazard identification & control':'Identification & contrôle dangers',
                        $en?'Regular safety audits & inspections':'Audits & inspections sécurité réguliers',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">✓</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;"><?php echo e($item); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>

            <div class="sa-program-card sa-reveal sa-delay-2">
                <div style="font-size:32px; margin-bottom:14px;">🏥</div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px;"><?php echo e($en ? 'Occupational Health' : 'Santé Professionnelle'); ?></h3>
                <ul class="sa-animated-list">
                    <?php $__currentLoopData = [
                        $en?'Medical surveillance programs':'Programmes surveillance médicale',
                        $en?'Occupational hygiene monitoring':'Suivi hygiène professionnelle',
                        $en?'Mental health & wellbeing support':'Soutien santé mentale & bien-être',
                        $en?'Emergency medical response':'Réponse médicale d\'urgence',
                        $en?'Employee health clinics':'Cliniques santé employés',
                    ]; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li>
                        <span class="sa-list-bullet" style="font-size:11px;">✓</span>
                        <span style="font-size:14px; color:var(--muted); line-height:1.6;"><?php echo e($item); ?></span>
                    </li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        </div>
    </div>
    <div class="sa-wave-bottom"></div>
</section>


<section class="sa-animated-section" style="padding:70px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">

        
        <div class="stat-band sa-reveal" style="margin-top:0; margin-bottom:40px;">
            <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="stat-item sa-stat-item-enhanced">
                <span class="stat-value" data-count="<?php echo e($i); ?>" data-original="<?php echo e(__('site.hse_stat'.$i.'_val', [], $loc)); ?>"><?php echo e(__('site.hse_stat'.$i.'_val', [], $loc)); ?></span>
                <span class="stat-label"><?php echo e(__('site.hse_stat'.$i.'_label', [], $loc)); ?></span>
            </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

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
            <h2 style="color:#fff; font-size:clamp(26px,4vw,40px); margin-bottom:16px; letter-spacing:-.02em;">
                <?php echo e($en ? 'Compliance & Continuous Improvement' : 'Conformité & Amélioration Continue'); ?>

            </h2>
            <div style="width:60px; height:3px; background:linear-gradient(90deg,var(--gold),var(--gold2)); border-radius:2px; margin:0 auto 24px;"></div>
            <p style="color:rgba(255,255,255,0.8); font-size:16px; line-height:1.8; max-width:700px; margin:0 auto 32px; text-align:center;">
                <?php echo e($en
                    ? 'Néré Mining relies on internal controls, inspections and independent reviews to strengthen operational discipline and accountability.'
                    : 'Néré Mining s\'appuie sur des contrôles internes, des inspections et des revues indépendantes pour renforcer la discipline opérationnelle et la responsabilité.'); ?>

            </p>
        </div>

        
        <div style="display:grid; grid-template-columns:repeat(auto-fit,minmax(180px,1fr)); gap:16px; margin-top:16px;">
            <?php $__currentLoopData = [
                ['icon'=>'📋','label'=>$en?'Internal Controls':'Contrôles Internes'],
                ['icon'=>'🔍','label'=>$en?'Independent Audits':'Audits Indépendants'],
                ['icon'=>'📈','label'=>$en?'Continuous Improvement':'Amélioration Continue'],
                ['icon'=>'🏆','label'=>$en?'ISO Certifications':'Certifications ISO'],
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