<?php $__env->startSection('title','Publications'); ?>
<?php $__env->startSection('page-title','Publications & Documents'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.reports.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher une publication..." aria-label="Rechercher une publication"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.reports.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Publications (<?php echo e($reports->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.reports.create')); ?>" class="btn btn-primary">+ Nouvelle publication</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Titre</th><th>Catégorie</th><th>Fichier</th><th>Publication</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $reports; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($r->title); ?></td>
                <td class="td-muted"><?php echo e($r->category); ?></td>
                <td>
                    <?php if($r->file_path): ?>
                        <a href="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($r->file_path)); ?>" target="_blank" class="badge badge-green">PDF ↗</a>
                    <?php else: ?>
                        <span class="badge badge-gray">—</span>
                    <?php endif; ?>
                </td>
                <td class="td-muted"><?php echo e($r->published_at?->format('d/m/Y') ?? '—'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.reports.edit', $r)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.reports.destroy', $r)); ?>" style="display:inline;"
                          onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucune publication.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($reports->hasPages()): ?><div class="card-body"><?php echo e($reports->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\reports\index.blade.php ENDPATH**/ ?>