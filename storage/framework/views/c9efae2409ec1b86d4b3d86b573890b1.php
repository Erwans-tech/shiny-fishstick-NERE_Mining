<?php $__env->startSection('title','Organigramme Karma'); ?>
<?php $__env->startSection('page-title','Karma → Organigramme'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.karma-departments.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un département..." aria-label="Rechercher un département"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.karma-departments.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Départements (<?php echo e($departments->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.karma-departments.create')); ?>" class="btn btn-primary">+ Ajouter</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Ordre</th><th>Libellé FR</th><th>Tag</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dept): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td class="td-muted"><?php echo e($dept->sort_order); ?></td>
                <td><?php echo e($dept->title_fr); ?></td>
                <td class="td-muted"><?php echo e($dept->tag_fr); ?></td>
                <td><span class="badge <?php echo e($dept->is_published ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($dept->is_published ? 'Visible' : 'Masqué'); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.karma-departments.edit', $dept)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.karma-departments.destroy', $dept)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ce département ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucun département.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($departments->hasPages()): ?><div class="card-body"><?php echo e($departments->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\karma-departments\index.blade.php ENDPATH**/ ?>