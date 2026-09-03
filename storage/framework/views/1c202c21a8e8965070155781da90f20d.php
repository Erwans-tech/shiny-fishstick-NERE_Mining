

<?php $__env->startSection('content'); ?>
<style>
    .future-steps { position:relative; display:grid; grid-template-columns:repeat(4,minmax(0,1fr)); gap:1px; overflow:hidden; background:#5f3a28; border:1px solid rgba(255,194,71,.35); border-radius:18px; box-shadow:0 18px 44px rgba(75,23,22,.2); }
    .future-step { position:relative; min-height:360px; padding:32px 26px 28px; overflow:hidden; background:linear-gradient(145deg,rgba(42,16,16,.98),rgba(75,23,22,.94)); border:0; transition:transform .3s ease,background .3s ease,box-shadow .3s ease; }
    .future-step::before { content:""; position:absolute; inset:0; background:linear-gradient(120deg,transparent 25%,rgba(255,194,71,.1) 50%,transparent 75%); transform:translateX(-120%); transition:transform .7s ease; pointer-events:none; }
    .future-step::after { content:""; position:absolute; top:22px; right:22px; width:46px; height:46px; border:1px solid rgba(255,194,71,.3); border-radius:50%; box-shadow:0 0 0 8px rgba(255,194,71,.04); }
    .future-step:hover { z-index:1; background:linear-gradient(145deg,#4b1716,#8b3424); transform:translateY(-6px); box-shadow:0 18px 32px rgba(28,7,7,.35); }
    .future-step:hover::before { transform:translateX(120%); }
    .future-step + .future-step { border-left:1px solid rgba(255,194,71,.18); }
    .future-step .step-num { position:relative; z-index:1; margin-bottom:52px; color:rgba(255,194,71,.2); font:700 58px/1 Inter,sans-serif; letter-spacing:.08em; }
    .future-step h4 { position:relative; z-index:1; margin-bottom:16px; color:#fff; font:700 15px/1.3 Inter,sans-serif; letter-spacing:.12em; text-transform:uppercase; }
    .future-step p { position:relative; z-index:1; margin:0; color:rgba(255,255,255,.72); font:14px/1.75 Inter,sans-serif; text-align:left; }
    .future-crawler { position:absolute; z-index:3; left:0; bottom:6px; width:110px; height:66px; opacity:0; pointer-events:none; transform:translateX(-120px); transition:transform .55s cubic-bezier(.22,1,.36,1),opacity .25s ease; filter:drop-shadow(0 6px 7px rgba(0,0,0,.42)); }
    .future-crawler img { display:block; width:100%; height:100%; object-fit:contain; object-position:center bottom; }
    .future-steps:hover .future-crawler { opacity:1; }
    @media (prefers-reduced-motion: reduce) { .future-crawler { display:none; } }
    @media(max-width:900px) { .future-steps { grid-template-columns:repeat(2,minmax(0,1fr)); } .future-step { min-height:300px; } }
    @media(max-width:540px) { .future-steps { grid-template-columns:1fr; } .future-step { min-height:0; } .future-step + .future-step { border-left:0; border-top:1px solid rgba(255,194,71,.18); } }
</style>
<div class="karma-page">
<section id="modele-operationnel" class="sand">
    <h2><?php echo e(__('site.karma_model_h2', [], $loc)); ?></h2>
    <p class="lead"><?php echo e(__('site.karma_model_lead', [], $loc)); ?></p>
    <div class="future-steps" role="list">
        <div class="future-crawler" aria-hidden="true" data-machine="excavation"
             data-exploration="<?php echo e(asset('images/equipment/exploration.png')); ?>"
             data-extraction="<?php echo e(asset('images/equipment/extraction.png')); ?>"
             data-treatment="<?php echo e(asset('images/equipment/traitement.png')); ?>"
             data-rehabilitation="<?php echo e(asset('images/equipment/rehabilitation.png')); ?>">
            <img src="<?php echo e(asset('images/equipment/extraction.png')); ?>" alt="">
        </div>
        <?php $__currentLoopData = range(1, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <article class="future-step" role="listitem"><div class="step-num">0<?php echo e($i); ?></div><h4><?php echo e(__('site.karma_step'.$i.'_h4', [], $loc)); ?></h4><p><?php echo e(__('site.karma_step'.$i.'_p', [], $loc)); ?></p></article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</section>
</div>
<script>
    document.querySelectorAll('.future-steps').forEach(function (track) {
        var crawler = track.querySelector('.future-crawler');
        var steps = track.querySelectorAll('.future-step');
        if (!crawler) return;
        steps.forEach(function (step) {
            step.addEventListener('mouseenter', function () {
                var machines = ['exploration', 'extraction', 'treatment', 'rehabilitation'];
                var machine = machines[Array.prototype.indexOf.call(steps, step)] || 'extraction';
                crawler.dataset.machine = machine;
                crawler.querySelector('img').src = crawler.dataset[machine];
                var trackRect = track.getBoundingClientRect();
                var stepRect = step.getBoundingClientRect();
                var position = stepRect.left - trackRect.left + (stepRect.width - crawler.offsetWidth) / 2;
                crawler.style.transform = 'translateX(' + position + 'px)';
            });
        });
        track.addEventListener('mouseleave', function () {
            crawler.style.opacity = '0';
        });
        track.addEventListener('mouseenter', function () {
            crawler.style.opacity = '1';
        });
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/pages/karma-modele.blade.php ENDPATH**/ ?>