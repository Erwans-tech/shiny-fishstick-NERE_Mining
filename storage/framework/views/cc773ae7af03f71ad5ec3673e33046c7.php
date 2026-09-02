<?php $__env->startSection('title','Actualités'); ?>
<?php $__env->startSection('page-title','Actualités'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.news.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher une actualité..." aria-label="Rechercher une actualité"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.news.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Toutes les actualités (<?php echo e($news->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.news.create')); ?>" class="btn btn-primary">+ Nouvelle actualité</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Catégorie</th>
                    <th>Statut</th>
                    <th>Publication</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($item->title); ?></td>
                <td class="td-muted"><?php echo e($item->category); ?></td>
                <td>
                    <?php if($item->published_at && $item->published_at->isPast()): ?>
                        <span class="badge badge-green">Publié</span>
                    <?php elseif($item->published_at): ?>
                        <span class="badge badge-yellow">Planifié</span>
                    <?php else: ?>
                        <span class="badge badge-gray">Brouillon</span>
                    <?php endif; ?>
                </td>
                <td class="td-muted"><?php echo e($item->published_at?->format('d/m/Y') ?? '—'); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.news.edit', $item)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.news.destroy', $item)); ?>"
                          style="display:inline;"
                          onsubmit="return confirm('Supprimer cet article ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="5" style="text-align:center;padding:40px;color:var(--muted);">Aucune actualité.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($news->hasPages()): ?>
    <div class="card-body"><?php echo e($news->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\news\index.blade.php ENDPATH**/ ?>