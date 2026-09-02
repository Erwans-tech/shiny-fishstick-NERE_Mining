<?php $__env->startSection('title', 'Modifier Administrateur'); ?>
<?php $__env->startSection('page-title', 'Modifier Administrateur'); ?>

<?php $__env->startSection('content'); ?>
<div class="admin-header">
    <h1>✏️ Modifier Administrateur</h1>
    <div class="admin-actions">
        <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">
            ← Retour à la liste
        </a>
        <a href="<?php echo e(route('admin.users.show', $user)); ?>" class="btn btn-secondary">
            👁️ Voir les détails
        </a>
    </div>
</div>

<div class="admin-card">
    <div class="card-header">
        <h2>Modifier : <?php echo e($user->name); ?></h2>
        <p class="text-muted">Modifiez les informations de cet administrateur.</p>
    </div>
    
    <form method="POST" action="<?php echo e(route('admin.users.update', $user)); ?>">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>
        
        <div class="form-row">
            <div class="form-group">
                <label for="name">Nom complet <span class="required">*</span></label>
                <input type="text" 
                       id="name" 
                       name="name" 
                       value="<?php echo e(old('name', $user->name)); ?>" 
                       class="form-control <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       required
                       placeholder="Ex: Jean Dupont">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            
            <div class="form-group">
                <label for="email">Adresse email <span class="required">*</span></label>
                <input type="email" 
                       id="email" 
                       name="email" 
                       value="<?php echo e(old('email', $user->email)); ?>" 
                       class="form-control <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       required
                       placeholder="Ex: jean.dupont@nere-mining.com">
                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="password">Nouveau mot de passe</label>
                <input type="password" 
                       id="password" 
                       name="password" 
                       class="form-control <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> error <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                       minlength="8"
                       placeholder="Laissez vide pour conserver l'actuel">
                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="error-message"><?php echo e($message); ?></div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                <small class="form-help">Laissez vide pour conserver le mot de passe actuel</small>
            </div>
            
            <div class="form-group">
                <label for="password_confirmation">Confirmer le nouveau mot de passe</label>
                <input type="password" 
                       id="password_confirmation" 
                       name="password_confirmation" 
                       class="form-control"
                       minlength="8"
                       placeholder="Retapez le nouveau mot de passe">
            </div>
        </div>
        
        <div class="form-group">
            <label class="checkbox-label">
                <input type="hidden" name="is_admin" value="0">
                <input type="checkbox" 
                       name="is_admin" 
                       value="1" 
                       <?php echo e(old('is_admin', $user->is_admin) ? 'checked' : ''); ?>>
                <span class="checkbox-custom"></span>
                Accès administrateur
            </label>
            <small class="form-help">Décochez pour retirer les privilèges administrateur</small>
            <?php $__errorArgs = ['is_admin'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <div class="error-message"><?php echo e($message); ?></div>
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>
        
        <div class="user-meta">
            <div class="meta-item">
                <strong>Créé le :</strong> <?php echo e($user->created_at->format('d/m/Y à H:i')); ?>

            </div>
            <div class="meta-item">
                <strong>Dernière modification :</strong> <?php echo e($user->updated_at->format('d/m/Y à H:i')); ?>

            </div>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn btn-primary">
                💾 Sauvegarder les modifications
            </button>
            <a href="<?php echo e(route('admin.users.index')); ?>" class="btn btn-secondary">
                Annuler
            </a>
        </div>
    </form>
</div>

<style>
.form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 20px;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

.form-group label {
    display: block;
    margin-bottom: 6px;
    font-weight: 500;
    color: var(--ink);
}

.required {
    color: var(--red);
}

.form-control {
    width: 100%;
    padding: 10px 12px;
    border: 1px solid var(--line);
    border-radius: 6px;
    font-size: 14px;
    transition: border-color 0.15s;
}

.form-control:focus {
    outline: none;
    border-color: var(--green);
    box-shadow: 0 0 0 3px rgba(75, 23, 22, 0.1);
}

.form-control.error {
    border-color: var(--red);
}

.error-message {
    color: var(--red);
    font-size: 13px;
    margin-top: 4px;
}

.form-help {
    color: var(--muted);
    font-size: 12px;
    margin-top: 4px;
    display: block;
}

.checkbox-label {
    display: flex;
    align-items: center;
    cursor: pointer;
    font-weight: normal;
}

.checkbox-label input[type="checkbox"] {
    margin-right: 8px;
}

.user-meta {
    background: var(--sand);
    padding: 16px;
    border-radius: 6px;
    margin: 20px 0;
    border: 1px solid var(--line);
}

.meta-item {
    margin-bottom: 8px;
    font-size: 13px;
    color: var(--muted);
}

.meta-item:last-child {
    margin-bottom: 0;
}

.form-actions {
    display: flex;
    gap: 12px;
    padding-top: 20px;
    border-top: 1px solid var(--line);
    margin-top: 30px;
}

@media (max-width: 768px) {
    .form-row {
        grid-template-columns: 1fr;
        gap: 0;
    }
    
    .form-actions {
        flex-direction: column;
    }
}
</style>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\users\edit.blade.php ENDPATH**/ ?>