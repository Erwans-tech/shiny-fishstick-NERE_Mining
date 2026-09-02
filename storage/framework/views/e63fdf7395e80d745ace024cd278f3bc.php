<?php $__env->startSection('title',"Offres d'emploi"); ?>
<?php $__env->startSection('page-title',"Offres d'emploi"); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.jobs.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Poste, service, lieu..." aria-label="Rechercher une offre"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q')): ?><a href="<?php echo e(route('admin.jobs.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>
<div class="card">
    <div class="card-header">
        <h2>Offres (<?php echo e($jobs->total()); ?>)</h2>
        <a href="<?php echo e(route('admin.jobs.create')); ?>" class="btn btn-primary">+ Nouvelle offre</a>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Poste</th><th>Département</th><th>Lieu</th><th>Date limite</th><th>Statut</th><th>Actions</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr>
                <td><?php echo e($j->title); ?></td>
                <td class="td-muted"><?php echo e($j->department); ?></td>
                <td class="td-muted"><?php echo e($j->location); ?></td>
                <td class="td-muted"><?php echo e($j->deadline?->format('d/m/Y') ?? '—'); ?></td>
                <td><span class="badge <?php echo e($j->is_published ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($j->is_published ? 'Publié' : 'Masqué'); ?></span>
                    <?php if($j->is_spontaneous): ?> <span class="badge badge-yellow" style="margin-left:4px;">Spontanée</span> <?php endif; ?>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.jobs.edit', $j)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.jobs.destroy', $j)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">Aucune offre.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($jobs->hasPages()): ?><div class="card-body"><?php echo e($jobs->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\jobs\index.blade.php ENDPATH**/ ?>