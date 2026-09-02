<?php $__env->startSection('title','Médiathèque'); ?>
<?php $__env->startSection('page-title','Médiathèque'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.media.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un média..." aria-label="Rechercher un média"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <select name="placement" aria-label="Filtrer par emplacement" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;">
        <option value="">Tous les emplacements</option>
        <option value="gallery" <?php echo e(request('placement') === 'gallery' ? 'selected' : ''); ?>>Médiathèque</option>
        <option value="homepage_slideshow" <?php echo e(request('placement') === 'homepage_slideshow' ? 'selected' : ''); ?>>Diaporama d’accueil</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q') || request('placement')): ?><a href="<?php echo e(route('admin.media.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Médias (<?php echo e($assets->total()); ?>)</h2>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="<?php echo e(route('admin.media.create', ['placement' => 'homepage_slideshow'])); ?>" class="btn btn-ghost">+ Image du diaporama</a>
            <a href="<?php echo e(route('admin.media.create')); ?>" class="btn btn-primary">+ Ajouter un média</a>
        </div>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Aperçu</th><th>Titre</th><th>Type</th><th>Emplacement</th><th>Ordre</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($a->type === 'image' && $a->url): ?>
                        <img src="<?php echo e($a->url); ?>" style="height:48px;width:72px;object-fit:cover;border-radius:4px;">
                    <?php elseif($a->external_url): ?>
                        <a href="<?php echo e($a->external_url); ?>" target="_blank" rel="noopener" class="badge badge-green">Lien ↗</a>
                    <?php else: ?>
                        <span class="badge badge-gray"><?php echo e(strtoupper($a->type)); ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($a->title); ?></td>
                <td class="td-muted"><?php echo e($a->type); ?></td>
                <td><span class="badge <?php echo e($a->placement === 'homepage_slideshow' ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($a->placement === 'homepage_slideshow' ? 'Accueil' : 'Médiathèque'); ?></span></td>
                <td class="td-muted"><?php echo e($a->sort_order); ?></td>
                <td><span class="badge <?php echo e($a->is_published ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($a->is_published ? 'Visible' : 'Masqué'); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.media.edit', $a)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.media.destroy', $a)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">Aucun média.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($assets->hasPages()): ?><div class="card-body"><?php echo e($assets->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\media\index.blade.php ENDPATH**/ ?>