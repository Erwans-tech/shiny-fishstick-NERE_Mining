<?php $__env->startSection('title', 'Abonnés newsletter'); ?>
<?php $__env->startSection('page-title', 'Abonnés newsletter'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2>📧 Liste des abonnés</h2>
        <div style="display:flex; align-items:center; gap:12px;">
            <span class="badge badge-blue"><?php echo e($count); ?> inscrit(s)</span>
            <a href="<?php echo e(route('admin.newsletter.export')); ?>" class="btn btn-ghost btn-sm" style="margin-left:auto;">📥 Exporter CSV</a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success" style="margin:0 20px 16px;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    
    <div style="padding:16px 20px; border-bottom:1px solid var(--line); background:#faf8f4;">
        <form method="GET" style="display:flex; gap:12px; align-items:center;">
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher par email..." 
                   style="flex:1; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
            <button type="submit" class="btn btn-primary btn-sm">Chercher</button>
            <?php if(request('q')): ?>
                <a href="<?php echo e(route('admin.newsletter.index')); ?>" class="btn btn-ghost btn-sm">Réinitialiser</a>
            <?php endif; ?>
        </form>
    </div>

    <?php if($subscribers->isEmpty()): ?>
        <div style="padding: 28px 20px; text-align:center; color:var(--muted); font-size:13px;">
            Aucun abonné pour le moment<?php echo e(request('q') ? ' (aucun résultat pour votre recherche)' : ''); ?>.
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Abonné le
                            <?php if(request('sort') !== 'oldest'): ?>
                                <a href="<?php echo e(route('admin.newsletter.index', [...request()->query(), 'sort' => 'oldest'])); ?>" style="margin-left:6px; color:var(--muted); font-size:11px;">↑</a>
                            <?php else: ?>
                                <a href="<?php echo e(route('admin.newsletter.index', array_merge(request()->query(), ['sort' => 'newest']))); ?>" style="margin-left:6px; color:var(--muted); font-size:11px;">↓</a>
                            <?php endif; ?>
                        </th>
                        <th style="width:120px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $subscribers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscriber): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($subscriber->email); ?></td>
                            <td><?php echo e($subscriber->subscribed_at ? $subscriber->subscribed_at->format('d/m/Y H:i') : '—'); ?></td>
                            <td style="text-align:right;">
                                <form action="<?php echo e(route('admin.newsletter.destroy', $subscriber)); ?>" method="POST" onsubmit="return confirm('Supprimer cet abonné ?');" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <div class="pagination-wrap">
            <?php echo e($subscribers->links()); ?>

        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\newsletter\index.blade.php ENDPATH**/ ?>