<?php $__env->startSection('content'); ?>
<?php $companyBase = $en ? route('english.company') : route('company'); ?>

<section>

    <p class="lead"><?php echo e(__('site.company_history_lead', [], $loc)); ?></p>

    <div>
        
        <div>
            <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <details <?php echo e($i === 1 ? 'open' : ''); ?>>
                <summary><?php echo e(__('site.company_hist'.$i.'_title', [], $loc)); ?></summary>
                <p><?php echo e(__('site.company_hist'.$i.'_p', [], $loc)); ?></p>
            </details>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-history.blade.php ENDPATH**/ ?>