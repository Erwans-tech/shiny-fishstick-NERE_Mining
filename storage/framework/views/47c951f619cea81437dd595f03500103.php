<?php $__env->startSection('content'); ?>


<style>
    .project-card {
        background: linear-gradient(180deg, #ffffff 0%, #f4eee6 100%);
        border: 1px solid rgba(75,23,22,0.1);
        border-radius: 16px;
        transition: transform 0.3s cubic-bezier(0.2, 1, 0.36, 1), box-shadow 0.3s, border-color 0.3s;
    }
    .project-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 28px rgba(40,29,24,0.08);
        border-color: rgba(255,194,71,0.5);
    }
</style>
<section class="sand sr" id="cil-project">
    <div class="grid-2" style="align-items:center;">
        <div>
            <div class="card-tag"><?php echo e(__('site.nav_projects_cil', [], $loc)); ?></div>
            <h2><?php echo e(__('site.cil_project_h2', [], $loc)); ?></h2>
            <p class="lead"><?php echo e(__('site.cil_project_lead', [], $loc)); ?></p>
            <a class="btn btn-dark" style="display:inline-block;"
               href="<?php echo e($en ? route('english.projects.cil') : route('projects.cil')); ?>">
                <?php echo e(__('site.cil_project_cta', [], $loc)); ?>

            </a>
        </div>
        <img style="width: 100%; max-width: 100%; height: auto; border-radius: 6px; box-shadow: 0 4px 18px rgba(0,0,0,.08);" src="<?php echo e(asset('images/cil/cil-01.png')); ?>"
             alt="<?php echo e(__('site.cil_project_image_alt', [], $loc)); ?>">
    </div>
</section>


<section id="exploration">
    <h2><?php echo e(__('site.projects_expl_h2', [], $loc)); ?></h2>
    <p class="lead"><?php echo e(__('site.projects_expl_lead', [], $loc)); ?></p>

    <div class="projects-grid">
        <?php $__currentLoopData = range(1, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="card project-card sr">
            <div class="card-tag"><?php echo e(__('site.projects_card'.$i.'_tag', [], $loc)); ?></div>
            <h3><?php echo e(__('site.projects_card'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo __('site.projects_card'.$i.'_p', [], $loc); ?></p>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\projects.blade.php ENDPATH**/ ?>