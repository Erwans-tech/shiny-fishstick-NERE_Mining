<?php $__env->startSection('content'); ?>

<section style="padding-bottom:0;">
</section>

<style>
    .report-category-badge { display:inline-block; padding:6px 12px; border-radius:4px; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:.06em; margin-bottom:12px; }
    .report-cat-sustainability { background:rgba(75,23,22,.1); color:var(--green); }
    .report-cat-financial { background:rgba(255,194,71,.15); color:var(--gold2); }
    .report-cat-technical { background:rgba(128,90,78,.1); color:#674c41; }
    .report-cat-governance { background:rgba(75,23,22,.08); color:var(--ink); }
</style>

<section>
    <h2 style="color:var(--green); margin:0 0 18px; font-size:28px; font-weight:600;"><?php echo e($en ? 'All Reports & Documents' : 'Tous les Rapports & Documents'); ?></h2>
    <p class="lead"><?php echo e(__('site.reports_lead', [], $loc)); ?></p>

    <div class="grid-3">
        <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $report): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <article class="card">
            <span class="report-category-badge" style="
                <?php if(strtolower($report->category) === 'sustainability' || strtolower($report->category) === 'durabilité'): ?>
                    background:rgba(75,23,22,.1); color:var(--green);
                <?php elseif(strtolower($report->category) === 'financial' || strtolower($report->category) === 'financier'): ?>
                    background:rgba(255,194,71,.15); color:var(--gold2);
                <?php elseif(strtolower($report->category) === 'technical' || strtolower($report->category) === 'technique'): ?>
                    background:rgba(128,90,78,.1); color:#674c41;
                <?php else: ?>
                    background:rgba(75,23,22,.08); color:var(--ink);
                <?php endif; ?>
            ">
                <?php echo e($report->category); ?>

            </span>
            <h3 style="margin-top:12px;"><?php echo e($report->title); ?></h3>
            <p><?php echo e($report->description); ?></p>
            <div style="display:flex; gap:8px; margin-top:16px; font-size:12px; color:var(--muted);">
                <?php if($report->published_at): ?>
                <span>📅 <?php echo e($report->published_at->translatedFormat('d M Y')); ?></span>
                <?php endif; ?>
            </div>
            <a class="btn <?php echo e($report->file_path ? 'btn-gold' : 'disabled'); ?>"
               style="margin-top:16px; display:inline-block;"
               href="<?php echo e($report->file_path ? \App\Helpers\StorageHelper::uploadUrl($report->file_path) : '#'); ?>">
                <?php echo e($report->file_path
                    ? __('site.download_pdf', [], $loc)
                    : __('site.coming_soon', [], $loc)); ?>

            </a>
        </article>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="grid-column:span 3; text-align:center; padding:40px 20px;">
            <p class="lead"><?php echo e(__('site.reports_empty', [], $loc)); ?></p>
            <p style="color:var(--muted); font-size:14px;"><?php echo e($en ? 'New reports will be published regularly.' : 'Les nouveaux rapports seront publiés régulièrement.'); ?></p>
        </div>
        <?php endif; ?>
    </div>
</section>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\pages\reports.blade.php ENDPATH**/ ?>