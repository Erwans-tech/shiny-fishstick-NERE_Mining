<?php $__env->startSection('content'); ?>
<?php
    $companyBase = $en ? route('english.company') : route('company');
    $values = [1, 2, 3, 4];
    $valueLetters = ['I', 'P', 'R', 'E'];
?>

<section class="company-values-section">

    <div class="values-hero" aria-label="IPRE">
        <img src="<?php echo e(asset('images/ipre-banner.jpg')); ?>" alt="IPRE" class="values-hero-image">
        <div class="values-hero-overlay">
            <span class="values-hero-kicker">IPRE</span>
            <h2><?php echo e($en ? 'Integrity, Professionalism, Respect, Team Spirit' : 'Intégrité, Professionnalisme, Respect, Esprit d’équipe'); ?></h2>
            <p><?php echo e($en ? 'These principles guide every decision, every action and every relationship we build.' : 'Ces principes guident chaque décision, chaque action et chaque relation que nous bâtissons.'); ?></p>
        </div>
    </div>

    <div class="grid-2 values-grid">
        <?php $__currentLoopData = $values; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="card values-card values-card--<?php echo e($i); ?>">
            <div class="values-card-top">
                <div class="values-card-icon"><?php echo e($valueLetters[$i - 1]); ?></div>
                <div class="card-tag"><?php echo e(__('site.company_v'.$i.'_tag', [], $loc)); ?></div>
            </div>
            <h3><?php echo e(__('site.company_v'.$i.'_h3', [], $loc)); ?></h3>
            <p><?php echo e(__('site.company_v'.$i.'_p', [], $loc)); ?></p>
            <div class="values-card-footer">
                <span><?php echo e($valueLetters[$i - 1]); ?></span>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\company-values.blade.php ENDPATH**/ ?>