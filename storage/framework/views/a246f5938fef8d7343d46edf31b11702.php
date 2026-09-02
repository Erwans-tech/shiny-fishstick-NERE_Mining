<?php $__env->startSection('content'); ?>
<?php
    $companyBase = $en ? route('english.company') : route('company');
    $values = [1, 2, 3, 4];
?>

<section class="company-values-section">
    <div class="sub-nav">
        <a href="<?php echo e($companyBase); ?>"><?php echo e(__('site.subnav_overview', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.ceo')        : route('company.ceo')); ?>"><?php echo e(__('site.subnav_company_ceo', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.identity')   : route('company.identity')); ?>"><?php echo e(__('site.subnav_company_identity', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.history')    : route('company.history')); ?>"><?php echo e(__('site.subnav_company_history', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.values')     : route('company.values')); ?>" class="active"><?php echo e(__('site.subnav_company_values', [], $loc)); ?></a>
        <a href="<?php echo e($en ? route('english.company.governance') : route('company.governance')); ?>"><?php echo e(__('site.subnav_company_governance', [], $loc)); ?></a>
    </div>

    <div class="values-hero" aria-label="IPRE">
        <img src="<?php echo e(asset('images/ipre-banner.jpg')); ?>" alt="IPRE" class="values-hero-image">
    </div>

    <div class="grid-2 values-grid">
        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card values-card">
            <div class="card-tag"><?php echo e(__('site.company_v'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.company_v'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_v'.$i.'_p', [], $loc)); ?></p>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-values.blade.php ENDPATH**/ ?>