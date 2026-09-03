<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<section>

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
                    <span class="stat-value">409</span>
                    <span class="stat-label"><?php echo e($en ? 'Direct employees' : 'Emplois directs'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">1 500</span>
                    <span class="stat-label"><?php echo e($en ? 'Subcontracted workers' : 'Travailleurs sous-traitants'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">60%</span>
                    <span class="stat-label"><?php echo e($en ? 'Local & regional employment' : 'Emploi local et régional'); ?></span>
                </div>
                <div class="stat-item">
                    <span class="stat-value">99%</span>
                    <span class="stat-label"><?php echo e($en ? 'Burkinabe workers' : 'Travailleurs burkinabè'); ?></span>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-history.blade.php ENDPATH**/ ?>