
<?php $__env->startSection('title', 'Equipe de direction'); ?>
<?php $__env->startSection('page-title', 'Equipe de direction'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.leadership.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un membre..." aria-label="Rechercher un membre" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
</form>
<div class="card">
    <div class="card-header">
        <h2>Membres (<?php echo e($members->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.leadership.create')); ?>" class="btn btn-primary">+ Ajouter</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Photo</th><th>Nom</th><th>Fonction</th><th>Niveau</th><th>Département</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $members; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $member): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($member->photo_path): ?>
                        <img src="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($member->photo_path)); ?>" style="width:48px;height:48px;border-radius:50%;object-fit:cover;">
                    <?php else: ?> <span class="badge badge-gray">—</span> <?php endif; ?>
                </td>
                <td><?php echo e($member->name); ?></td>
                <td class="td-muted"><?php echo e($member->title); ?></td>
                <td class="td-muted"><?php echo e([1 => 'DG', 2 => 'DGA', 3 => 'Direction'][$member->hierarchy_level] ?? 'Direction'); ?></td>
                <td class="td-muted"><?php echo e($member->department); ?></td>
                <td class="td-muted"><?php echo e($member->sort_order); ?></td>
                <td><span class="badge <?php echo e($member->is_published ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($member->is_published ? 'Visible' : 'Masqué'); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.leadership.edit', $member)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.leadership.destroy', $member)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="8" style="text-align:center;padding:40px;color:var(--muted);">Aucun membre configuré.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($members->hasPages()): ?><div class="card-body"><?php echo e($members->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\leadership\index.blade.php ENDPATH**/ ?>