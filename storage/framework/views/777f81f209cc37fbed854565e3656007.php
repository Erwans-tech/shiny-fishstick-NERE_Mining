

<?php $__env->startSection('content'); ?>
<style>
    .karma-page > section > .lead {
        width: 100%;
        max-width: none;
    }

    @media (max-width: 600px) {
        .karma-page > section > .lead {
            text-align: left;
        }
    }
</style>
<div class="karma-page">
<section id="organisation">
    <h2><?php echo e(__('site.karma_org_h2', [], $loc)); ?></h2>
    <p class="lead"><?php echo e(__('site.karma_org_lead', [], $loc)); ?></p>
    <div class="grid-3">
        <?php $__empty_1 = true; $__currentLoopData = $karmaDepartments ?? collect(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <?php $deptTag = trim((string) $dept->localizedTag($loc)); $deptTitle = trim((string) $dept->localizedTitle($loc)); $deptBody = trim((string) $dept->localizedBody($loc)); ?>
        <div class="card"><div class="card-tag"><?php echo e($deptTag !== '' ? $deptTag : __('site.karma_dept'.$loop->iteration.'_tag', [], $loc)); ?></div><h3><?php echo e($deptTitle !== '' ? $deptTitle : __('site.karma_dept'.$loop->iteration.'_h3', [], $loc)); ?></h3><p><?php echo e($deptBody !== '' ? $deptBody : __('site.karma_dept'.$loop->iteration.'_p', [], $loc)); ?></p></div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <?php $__currentLoopData = range(1, 9); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><div class="card"><div class="card-tag"><?php echo e(__('site.karma_dept'.$i.'_tag', [], $loc)); ?></div><h3><?php echo e(__('site.karma_dept'.$i.'_h3', [], $loc)); ?></h3><p><?php echo e(__('site.karma_dept'.$i.'_p', [], $loc)); ?></p></div><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\karma-organisation.blade.php ENDPATH**/ ?>