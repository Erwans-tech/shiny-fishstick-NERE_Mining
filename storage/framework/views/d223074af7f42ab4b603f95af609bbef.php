<?php $__env->startSection('content'); ?>


<section>

    <p class="lead"><?php echo e(__('site.hse_policy_lead', [], $loc)); ?></p>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.hse_policy'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.hse_policy'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.hse_policy'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Safety Performance' : 'Performance Sécurité'); ?></h2>
        <p style="text-align:center; color:var(--muted); font-size:15px; margin-bottom:40px;"><?php echo e($en ? 'Our commitment to zero harm drives continuous improvement.' : 'Notre engagement zéro accident guide amélioration continue.'); ?></p>

        <div style="display:grid; grid-template-columns:repeat(auto-fit, minmax(180px, 1fr)); gap:24px; margin-bottom:40px;">
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">0.8</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Lost Time Injury (LTI)' : 'Blessures avec Arrêt (LTI)'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;"><?php echo e($en ? 'per 1M hours worked' : 'par 1M heures travaillées'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">2.1</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Total Recordable Injury (TRIFR)' : 'Blessures Signalables (TRIFR)'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;"><?php echo e($en ? 'per 1M hours worked' : 'par 1M heures travaillées'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">14.2M</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Safety-Free Hours' : 'Heures sans Incident'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;"><?php echo e($en ? 'cumulative 2024' : 'cumulatif 2024'); ?></div>
            </div>
            <div style="background:#fff; padding:24px; border-radius:8px; text-align:center; border:1px solid var(--line);">
                <div style="font-size:36px; font-weight:700; color:var(--green); margin-bottom:8px;">98%</div>
                <div style="font-size:13px; color:var(--muted); text-transform:uppercase; letter-spacing:.06em;"><?php echo e($en ? 'Safety Training Compliance' : 'Conformité Formation Sécurité'); ?></div>
                <div style="font-size:12px; color:var(--muted); margin-top:12px;"><?php echo e($en ? 'among all staff' : 'parmi tout le personnel'); ?></div>
            </div>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:40px; align-items:center;">
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Safety Culture' : 'Culture Sécurité'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Daily pre-work briefings (DPBs)' : 'Briefings pré-travail quotidiens'); ?></li>
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Behavior-based safety programs' : 'Programmes sécurité comportementale'); ?></li>
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Near-miss reporting system' : 'Système signalement presque-accidents'); ?></li>
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Hazard identification & control' : 'Identification & contrôle dangers'); ?></li>
                    <li>✓ <?php echo e($en ? 'Regular safety audits & inspections' : 'Audits & inspections sécurité réguliers'); ?></li>
                </ul>
            </div>
            <div>
                <h3 style="color:var(--green); margin-bottom:16px; font-size:20px; font-weight:600;"><?php echo e($en ? 'Occupational Health' : 'Santé Professionnelle'); ?></h3>
                <ul style="list-style:none; padding:0; margin:0; font-size:14px; line-height:1.8; color:var(--muted);">
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Medical surveillance programs' : 'Programmes surveillance médicale'); ?></li>
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Occupational hygiene monitoring' : 'Suivi hygiène professionnelle'); ?></li>
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Mental health & wellbeing support' : 'Soutien santé mentale & bien-être'); ?></li>
                    <li style="margin-bottom:12px;">✓ <?php echo e($en ? 'Emergency medical response' : 'Réponse médicale d\'urgence'); ?></li>
                    <li>✓ <?php echo e($en ? 'Employee health clinics' : 'Cliniques santé employés'); ?></li>
                </ul>
            </div>
        </div>
    </div>
</section>


<section>

    <div class="stat-band">
        <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="stat-item">
            <span class="stat-value"><?php echo e(__('site.hse_stat'.$i.'_val', [], $loc)); ?></span>
            <span class="stat-label"><?php echo e(__('site.hse_stat'.$i.'_label', [], $loc)); ?></span>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="grid-3">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card">
            <div class="card-tag"><?php echo e(__('site.hse_card'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.hse_card'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.hse_card'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>


<section class="sand" style="padding:60px 5vw;">
    <div style="max-width:1180px; margin:0 auto; text-align:center;">
        <h2 style="text-align:center; color:var(--green); margin-bottom:12px; font-size:36px; font-weight:600;"><?php echo e($en ? 'Compliance & Continuous Improvement' : 'Conformité & amélioration continue'); ?></h2>
        <p style="max-width:760px; margin:0 auto; color:var(--muted); font-size:15px; line-height:1.8;">
            <?php echo e($en
                ? 'Néré Mining relies on internal controls, inspections and independent reviews to strengthen operational discipline and accountability.'
                : 'Néré Mining s’appuie sur des contrôles internes, des inspections et des revues indépendantes pour renforcer la discipline opérationnelle et la responsabilité.'); ?>

        </p>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\hse.blade.php ENDPATH**/ ?>