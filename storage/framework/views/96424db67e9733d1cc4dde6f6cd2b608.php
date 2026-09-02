<?php $__env->startSection('title', 'Gestion des Administrateurs'); ?>
<?php $__env->startSection('page-title', 'Gestion des Administrateurs'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2>Liste des Administrateurs (<?php echo e($admins->count()); ?>)</h2>
        <a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary">➕ Nouvel Administrateur</a>
    </div>
    
    <?php if($admins->isEmpty()): ?>
        <div style="padding: 40px; text-align: center; color: var(--muted);">
            <p>👤 Aucun administrateur trouvé.</p>
        </div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th>Utilisateur</th>
                        <th>Email</th>
                        <th>Statut</th>
                        <th>Créé le</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $admins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $admin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--green); color: white; display: flex; align-items: center; justify-content: center; font-weight: 600; font-size: 14px;">
                                    <?php echo e(substr($admin->name, 0, 1)); ?>

                                </div>
                                <div>
                                    <strong><?php echo e($admin->name); ?></strong>
                                    <?php if($admin->id === auth()->id()): ?>
                                        <span class="badge badge-yellow" style="margin-left: 6px;">Vous</span>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </td>
                        <td class="td-muted"><?php echo e($admin->email); ?></td>
                        <td>
                            <?php if($admin->is_admin): ?>
                                <span class="badge badge-green">✅ Actif</span>
                            <?php else: ?>
                                <span class="badge badge-gray">⏸️ Inactif</span>
                            <?php endif; ?>
                        </td>
                        <td class="td-muted"><?php echo e($admin->created_at->format('d/m/Y H:i')); ?></td>
                        <td>
                            <div style="display: flex; gap: 6px; align-items: center;">
                                <a href="<?php echo e(route('admin.users.show', $admin)); ?>" 
                                   class="btn btn-ghost btn-sm"
                                   title="Voir les détails">
                                    👁️ Voir
                                </a>
                                
                                <?php if($admin->id !== auth()->id()): ?>
                                    <a href="<?php echo e(route('admin.users.edit', $admin)); ?>" 
                                       class="btn btn-ghost btn-sm"
                                       title="Modifier">
                                        ✏️ Modifier
                                    </a>
                                    
                                    <form method="POST" 
                                          action="<?php echo e(route('admin.users.toggle', $admin)); ?>" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir changer le statut de cet administrateur ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <button type="submit" 
                                                class="btn btn-ghost btn-sm"
                                                title="<?php echo e($admin->is_admin ? 'Désactiver' : 'Activer'); ?>">
                                            <?php echo e($admin->is_admin ? '⏸️' : '▶️'); ?>

                                        </button>
                                    </form>
                                    
                                    <form method="POST" 
                                          action="<?php echo e(route('admin.users.destroy', $admin)); ?>" 
                                          style="display: inline;"
                                          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ? Cette action est irréversible.')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-danger btn-sm" title="Supprimer">
                                            🗑️
                                        </button>
                                    </form>
                                <?php else: ?>
                                    <span style="color: var(--muted); font-size: 12px;" title="Vous ne pouvez pas modifier votre propre compte">🔒 Protégé</span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\users\index.blade.php ENDPATH**/ ?>