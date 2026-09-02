<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<section>
    <div class="sub-nav">
        <a href="<?php echo e($companyBase); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.ceo')        : route('company.ceo')); ?>"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.identity')   : route('company.identity')); ?>"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.history')    : route('company.history')); ?>" class="active"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.values')     : route('company.values')); ?>"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
    </div>

    <p class="lead"><?php echo e(__('site.company_history_lead', [], $loc)); ?></p>

    <div class="grid-2">
        
        <div>
            <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <details <?php echo e($i === 1 ? 'open' : ''); ?>>
                <summary><?php echo e(__('site.company_hist'.$i.'_title', [], $loc)); ?></summary>
                <p><?php echo e(__('site.company_hist'.$i.'_p', [], $loc)); ?></p>
            </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        
        <div class="card" style="background: linear-gradient(135deg, rgba(255,194,71,0.1) 0%, rgba(255,255,255,1) 100%); border: 1px solid rgba(255,194,71,0.3); border-radius: 16px;">
            <h3 style="color:var(--ink);"><?php echo e(__('site.company_kpi_h3', [], $loc)); ?></h3>
            <div class="stat-band" style="grid-template-columns:1fr 1fr; margin:0;">
                <div class="stat-item">
                    <span class="stat-value">100%</span>
                    <span class="stat-label"><?php echo e($en ? 'Burkinabe ownership' : 'Actionnariat burkinabè'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">1 909+</span>
                    <span class="stat-label"><?php echo e($en ? 'Direct & indirect jobs' : 'Emplois directs et indirects'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">99%</span>
                    <span class="stat-label"><?php echo e($en ? 'National workforce' : "Main-d'œuvre nationale"); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">ITIE</span>
                    <span class="stat-label"><?php echo e($en ? 'Transparency member' : 'Membre de la transparence'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-history.blade.php ENDPATH**/ ?>