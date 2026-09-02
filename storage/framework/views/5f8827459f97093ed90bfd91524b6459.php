<?php $__env->startSection('title','Partenaires'); ?>
<?php $__env->startSection('page-title','Partenaires institutionnels'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.partners.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un partenaire..." aria-label="Rechercher un partenaire"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.partners.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Partenaires (<?php echo e($partners->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.partners.create')); ?>" class="btn btn-primary">+ Ajouter</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Logo</th><th>Nom</th><th>Catégorie</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $partners; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($p->logo_path): ?>
                        <?php $logoUrl = str_starts_with($p->logo_path,'images/') ? asset($p->logo_path) : \App\Helpers\StorageHelper::uploadUrl($p->logo_path); ?>
                        <img src="<?php echo e($logoUrl); ?>" style="height:40px;max-width:80px;object-fit:contain;">
                    <?php else: ?>
                        <span class="badge badge-gray">—</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($p->name); ?></td>
                <td class="td-muted"><?php echo e($p->category); ?></td>
                <td class="td-muted"><?php echo e($p->sort_order); ?></td>
                <td><span class="badge <?php echo e($p->is_published ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($p->is_published ? 'Visible' : 'Masqué'); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.partners.edit', $p)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.partners.destroy', $p)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">Aucun partenaire.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($partners->hasPages()): ?><div class="card-body"><?php echo e($partners->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\partners\index.blade.php ENDPATH**/ ?>