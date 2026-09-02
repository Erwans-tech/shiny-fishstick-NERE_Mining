<?php $__env->startSection('title','Communiqués'); ?>
<?php $__env->startSection('page-title','Communiqués de presse'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.press.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un communiqué..." aria-label="Rechercher un communiqué"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.press.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Communiqués (<?php echo e($documents->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.press.create')); ?>" class="btn btn-primary">+ Nouveau communiqué</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Titre</th><th>Type</th><th>Fichier</th><th>Publication</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $documents; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($d->title); ?></td>
                <td class="td-muted"><?php echo e($d->document_type); ?></td>
                <td>
                    <?php if($d->file_path): ?>
                        <a href="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($d->file_path)); ?>" target="_blank" class="badge badge-green">Fichier ↗</a>
                    <?php else: ?>
                        <span class="badge badge-gray">—</span>
                    <?php endif; ?>
                </td>
                <td class="td-muted"><?php echo e($d->published_at?->format('d/m/Y') ?? '—'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.press.edit', $d)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.press.destroy', $d)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucun communiqué.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($documents->hasPages()): ?><div class="card-body"><?php echo e($documents->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\press\index.blade.php ENDPATH**/ ?>