<?php $__env->startSection('title','Albums Photo'); ?>
<?php $__env->startSection('page-title','Albums Photo'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.albums.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un album..." aria-label="Rechercher un album"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.albums.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>

<div class="card">
    <div class="card-header">
        <h2>Albums Photo (<?php echo e($albums->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.albums.create')); ?>" class="btn btn-primary">+ Créer un album</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Couverture</th>
                    <th>Titre</th>
                    <th>Description</th>
                    <th>Photos</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td>
                    <?php if($album->cover_url): ?>
                        <img src="<?php echo e($album->cover_url); ?>" alt="<?php echo e($album->title); ?>" 
                             style="height:48px;width:72px;object-fit:cover;border-radius:4px;">
                    <?php else: ?>
                        <div style="height:48px;width:72px;background:var(--sand);border-radius:4px;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:20px;">📷</div>
                    <?php endif; ?>
                </td>
                <td><strong><?php echo e($album->title); ?></strong></td>
                <td class="td-muted" style="max-width:300px;"><?php echo e(Str::limit($album->description, 80)); ?></td>
                <td>
                    <span class="badge badge-blue"><?php echo e($album->media_count); ?> <?php echo e($album->media_count > 1 ? 'photos' : 'photo'); ?></span>
                </td>
                <td class="td-muted"><?php echo e($album->sort_order); ?></td>
                <td>
                    <span class="badge <?php echo e($album->is_published ? 'badge-green' : 'badge-gray'); ?>">
                        <?php echo e($album->is_published ? 'Publié' : 'Brouillon'); ?>

                    </span>
                </td>
                <td>
                    <div style="display:flex;gap:6px;flex-wrap:wrap;">
                        <a href="<?php echo e(route('admin.albums.show', $album)); ?>" class="btn btn-ghost btn-sm" title="Voir les photos">👁️ Voir</a>
                        <a href="<?php echo e(route('admin.albums.edit', $album)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                        <form method="POST" action="<?php echo e(route('admin.albums.destroy', $album)); ?>" style="display:inline;" 
                              onsubmit="return confirm('Supprimer cet album ? Les photos ne seront pas supprimées.')">
                            <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                        </form>
                    </div>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr>
                <td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">
                    <div style="font-size:48px;margin-bottom:16px;">📸</div>
                    <p>Aucun album créé.</p>
                    <a href="<?php echo e(route('admin.albums.create')); ?>" class="btn btn-primary" style="margin-top:12px;">Créer le premier album</a>
                </td>
            </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($albums->hasPages()): ?>
        <div class="card-body"><?php echo e($albums->links()); ?></div>
    <?php endif; ?>
</div>

<div class="card" style="margin-top:24px;background:var(--sand);">
    <div class="card-body">
        <h3 style="margin-bottom:12px;font-size:16px;">💡 Comment ça marche ?</h3>
        <ol style="padding-left:20px;line-height:1.8;">
            <li>Créez un album avec un titre et une description</li>
            <li>Ajoutez une image de couverture (optionnelle)</li>
            <li>Allez dans <strong>Médiathèque</strong> pour ajouter des photos à cet album</li>
            <li>Les albums s'affichent sur la page Médiathèque avec un carousel des photos</li>
        </ol>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\albums\index.blade.php ENDPATH**/ ?>