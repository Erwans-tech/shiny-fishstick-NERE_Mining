<?php $__env->startSection('title', 'Détails Administrateur'); ?>
<?php $__env->startSection('page-title', 'Détails Administrateur'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>👁️ Détails Administrateur</h1>
    <div class="admin-actions">
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">
            ← Retour à la liste
        </a>
        <?php if($user->id !== auth()->id()): ?>
            <a href="<?php echo e(route('admin.users.edit', $user)); ?>" class="btn btn-primary">
                ✏️ Modifier
            </a>
        <?php endif; ?>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <div class="user-header">
            <div class="user-avatar-large">
                <?php echo e(substr($user->name, 0, 1)); ?>

            </div>
            <div class="user-title">
                <h2><?php echo e($user->name); ?></h2>
                <p class="user-email"><?php echo e($user->email); ?></p>
                <?php if($user->id === auth()->id()): ?>
                    <span class="badge badge-current">Votre compte</span>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="user-details">
        <div class="detail-section">
            <h3>Informations générales</h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <label>Nom complet</label>
                    <value><?php echo e($user->name); ?></value>
                </div>
                <div class="detail-item">
                    <label>Adresse email</label>
                    <value><?php echo e($user->email); ?></value>
                </div>
                <div class="detail-item">
                    <label>Statut</label>
                    <value>
                        <?php if($user->is_admin): ?>
                            <span class="badge badge-success">✅ Administrateur actif</span>
                        <?php else: ?>
                            <span class="badge badge-warning">⏸️ Accès administrateur désactivé</span>
                        <?php endif; ?>
                    </value>
                </div>
                <div class="detail-item">
                    <label>ID utilisateur</label>
                    <value><code>#<?php echo e($user->id); ?></code></value>
                </div>
            </div>
        </div>
        
        <div class="detail-section">
            <h3>Informations de compte</h3>
            <div class="detail-grid">
                <div class="detail-item">
                    <label>Compte créé le</label>
                    <value>
                        <?php echo e($user->created_at->format('d/m/Y à H:i')); ?>

                        <span class="text-muted">(<?php echo e($user->created_at->diffForHumans()); ?>)</span>
                    </value>
                </div>
                <div class="detail-item">
                    <label>Dernière modification</label>
                    <value>
                        <?php echo e($user->updated_at->format('d/m/Y à H:i')); ?>

                        <span class="text-muted">(<?php echo e($user->updated_at->diffForHumans()); ?>)</span>
                    </value>
                </div>
                <div class="detail-item">
                    <label>Email vérifié</label>
                    <value>
                        <?php if($user->email_verified_at): ?>
                            <span class="badge badge-success">✅ Vérifié le <?php echo e($user->email_verified_at->format('d/m/Y')); ?></span>
                        <?php else: ?>
                            <span class="badge badge-warning">⏳ Non vérifié</span>
                        <?php endif; ?>
                    </value>
                </div>
            </div>
        </div>
        
        <?php if($user->id !== auth()->id()): ?>
        <div class="detail-section">
            <h3>Actions administrateur</h3>
            <div class="admin-actions-grid">
                <form method="POST" 
                      action="<?php echo e(route('admin.users.toggle', $user)); ?>" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir changer le statut de cet administrateur ?')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PATCH'); ?>
                    <button type="submit" class="btn btn-warning">
                        <?php echo e($user->is_admin ? '⏸️ Désactiver' : '▶️ Activer'); ?> l'accès admin
                    </button>
                </form>
                
                <form method="POST" 
                      action="<?php echo e(route('admin.users.destroy', $user)); ?>" 
                      onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet administrateur ? Cette action est irréversible.')">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('DELETE'); ?>
                    <button type="submit" class="btn btn-danger">
                        🗑️ Supprimer définitivement
                    </button>
                </form>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<style>
.user-header {
    display: flex;
    align-items: center;
    gap: 20px;
}

.user-avatar-large {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: var(--green);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    font-size: 24px;
}

.user-title h2 {
    margin: 0 0 4px 0;
    color: var(--ink);
}

.user-email {
    color: var(--muted);
    margin: 0 0 8px 0;
    font-size: 14px;
}

.badge {
    padding: 4px 8px;
    border-radius: 4px;
    font-size: 12px;
    font-weight: 500;
}

.badge-current {
    background: var(--gold);
    color: var(--ink);
}

.badge-success {
    background: #d1fae5;
    color: #065f46;
}

.badge-warning {
    background: #fef3c7;
    color: #92400e;
}

.user-details {
    padding: 0;
}

.detail-section {
    margin-bottom: 30px;
    padding-bottom: 20px;
    border-bottom: 1px solid var(--line);
}

.detail-section:last-child {
    border-bottom: none;
    margin-bottom: 0;
}

.detail-section h3 {
    color: var(--green);
    font-size: 16px;
    margin-bottom: 16px;
    font-weight: 600;
}

.detail-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 20px;
}

.detail-item label {
    display: block;
    font-size: 12px;
    color: var(--muted);
    text-transform: uppercase;
    letter-spacing: 0.05em;
    margin-bottom: 4px;
    font-weight: 500;
}

.detail-item value {
    display: block;
    color: var(--ink);
    font-size: 14px;
}

.detail-item code {
    background: var(--sand);
    padding: 2px 6px;
    border-radius: 3px;
    font-family: 'Monaco', 'Menlo', monospace;
    font-size: 12px;
}

.text-muted {
    color: var(--muted);
    font-size: 13px;
}

.admin-actions-grid {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
}

.admin-actions-grid form {
    display: inline-block;
}

@media (max-width: 768px) {
    .user-header {
        flex-direction: column;
        text-align: center;
        gap: 12px;
    }
    
    .detail-grid {
        grid-template-columns: 1fr;
    }
    
    .admin-actions-grid {
        flex-direction: column;
    }
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\users\show.blade.php ENDPATH**/ ?>