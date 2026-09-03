

<?php $__env->startSection('content'); ?>
<div class="karma-page">
<section id="impact">
    <h2><?php echo e(__('site.karma_impact_h2', [], $loc)); ?></h2>
    <p class="lead"><?php echo e(__('site.karma_impact_lead', [], $loc)); ?></p>
    <div class="grid-2">
        <div>
            <h3><?php echo e(__('site.karma_imp_jobs_h3', [], $loc)); ?></h3>
            <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card karma-impact-card" style="margin-bottom:18px;"><div class="card-tag"><?php echo e(__('site.karma_imp_job'.$i.'_tag', [], $loc)); ?></div><p><?php echo e(__('site.karma_imp_job'.$i.'_p', [], $loc)); ?></p></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <div>
            <h3><?php echo e(__('site.karma_imp_eco_h3', [], $loc)); ?></h3>
            <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="card karma-impact-card" style="margin-bottom:18px;"><div class="card-tag"><?php echo e(__('site.karma_imp_eco'.$i.'_tag', [], $loc)); ?></div><p><?php echo e(__('site.karma_imp_eco'.$i.'_p', [], $loc)); ?></p></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\karma-impact.blade.php ENDPATH**/ ?>