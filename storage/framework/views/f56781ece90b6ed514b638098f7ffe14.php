

<?php $__env->startSection('content'); ?>
<style>
    .karma-page h2,.karma-page h3 { text-align:center; }
    .karma-page .card p { text-align:justify; }
    .karma-page .grid-2 { align-items:stretch; }
    .karma-production-card { border-left:4px solid var(--gold); min-height:420px; display:flex; flex-direction:column; }
    .karma-production-card .card-img { width:calc(100% + 60px); max-width:none; height:220px; object-fit:cover; object-position:center; }
    .karma-production-card--open-pit .card-img { object-position:52% center; }
    .karma-production-card--processing .card-img { object-position:center 58%; }
    .karma-production-card--team .card-img { object-position:center 32%; }
    .karma-production-card h3 { margin-top:14px; }
    .karma-production-card p { flex:1; margin-bottom:0; }
    @media(max-width:540px) { .karma-production-card .card-img { height:190px; } }
</style>
<div class="karma-page">
<section id="exploitation" class="sand">
    
    <div class="stat-band">
        <div class="stat-item"><span class="stat-value" data-count="97" data-suffix=" koz">97 koz</span><span class="stat-label"><?php echo e($en ? 'Annual average (2019-2021)' : 'Production annuelle moyenne (2019-2021)'); ?></span></div>
        <div class="stat-item"><span class="stat-value" data-count="949" data-suffix=" koz">949 koz</span><span class="stat-label"><?php echo e($en ? 'Total gold reserves' : 'Réserves or totales'); ?></span></div>
        <div class="stat-item"><span class="stat-value" data-count="33.2" data-suffix=" Mt">33.2 Mt</span><span class="stat-label"><?php echo e($en ? 'Ore reserves' : 'Réserves minerai'); ?></span></div>
        <div class="stat-item"><span class="stat-value" data-count="11" data-suffix=" <?php echo e($en ? 'yrs' : 'ans'); ?>">11 <?php echo e($en ? 'yrs' : 'ans'); ?></span><span class="stat-label"><?php echo e($en ? 'Extended mine life' : 'Durée mine étendue'); ?></span></div>
    </div>
    <div class="grid-2">
        <div class="card karma-production-card karma-production-card--open-pit"><img class="card-img" src="<?php echo e(asset('images/mining/mining-site-aerial-01.jpg')); ?>" alt="<?php echo e($en ? 'Open-pit mining' : 'Extraction à ciel ouvert'); ?>"><h3><?php echo e(__('site.karma_card1_h3', [], $loc)); ?></h3><p><?php echo e(__('site.karma_card1_p', [], $loc)); ?></p></div>
        <div class="card karma-production-card karma-production-card--processing"><img class="card-img" src="<?php echo e(asset('images/mining/karma-04.jpg')); ?>" alt="<?php echo e($en ? 'Gold processing plant' : 'Usine de traitement de l’or'); ?>"><h3><?php echo e(__('site.karma_card2_h3', [], $loc)); ?></h3><p><?php echo e(__('site.karma_card2_p', [], $loc)); ?></p></div>
    </div>
</section>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/pages/karma-exploitation.blade.php ENDPATH**/ ?>