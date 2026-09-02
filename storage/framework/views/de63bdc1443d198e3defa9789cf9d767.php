<?php $__env->startSection('title', 'Certifications'); ?>
<?php $__env->startSection('page-title', 'Certifications'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2>🏆 Certifications (ISO, EITI, ESG)</h2>
        <a href="<?php echo e(route('admin.certifications.create')); ?>" class="btn btn-primary btn-sm">+ Ajouter</a>
    </div>

    <?php if(session('success')): ?>
        <div class="alert alert-success" style="margin:0 20px 16px;"><?php echo e(session('success')); ?></div>
    <?php endif; ?>

    <?php if($certifications->isEmpty()): ?>
        <div style="padding:40px 20px; text-align:center; color:var(--muted); font-size:13px;">
            Aucune certification pour le moment.
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Description</th>
                        <th>Émise le</th>
                        <th>Expire le</th>
                        <th>Statut</th>
                        <th style="width:140px; text-align:right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $certifications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cert): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td style="font-weight:600;"><?php echo e($cert->name); ?></td>
                            <td class="td-muted"><?php echo e(Str::limit($cert->description, 40)); ?></td>
                            <td class="td-muted"><?php echo e($cert->issued_at?->format('d/m/Y') ?? '—'); ?></td>
                            <td class="td-muted">
                                <?php if($cert->expires_at): ?>
                                    <?php echo e($cert->expires_at->format('d/m/Y')); ?>

                                    <?php if($cert->isExpired()): ?>
                                        <span class="badge badge-red" style="font-size:10px;">Expiré</span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    —
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if($cert->is_active): ?>
                                    <span class="badge badge-green">Actif</span>
                                <?php else: ?>
                                    <span class="badge badge-gray">Inactif</span>
                                <?php endif; ?>
                            </td>
                            <td style="text-align:right;">
                                <a href="<?php echo e(route('admin.certifications.edit', $cert)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                                <form method="POST" action="<?php echo e(route('admin.certifications.destroy', $cert)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger btn-sm">✕</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>

        <?php if($certifications->hasPages()): ?>
            <div class="pagination-wrap">
                <?php echo e($certifications->links()); ?>

            </div>
        <?php endif; ?>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\certifications\index.blade.php ENDPATH**/ ?>