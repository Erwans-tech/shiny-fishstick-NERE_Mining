<?php $__env->startSection('title', 'Modifier certification'); ?>
<?php $__env->startSection('page-title', 'Modifier certification'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2>🏆 Modifier <?php echo e($certification->name); ?></h2>
        <a href="<?php echo e(route('admin.certifications.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
    </div>

    <form method="POST" action="<?php echo e(route('admin.certifications.update', $certification)); ?>" enctype="multipart/form-data" class="card-body">
        <?php echo csrf_field(); ?> <?php echo method_field('PUT'); ?>

        <div class="form-group">
            <label for="name">Nom de la certification *</label>
            <input type="text" name="name" id="name" value="<?php echo e(old('name', $certification->name)); ?>" required
                   placeholder="Ex: ISO 9001, EITI, ESG"
                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
            <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:var(--red); font-size:12px;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" id="description" placeholder="Décrire cette certification..."
                      style="width:100%; min-height:100px; padding:10px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif; resize:vertical;"><?php echo e(old('description', $certification->description)); ?></textarea>
            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:var(--red); font-size:12px;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px;">
            <div class="form-group">
                <label for="issued_at">Date d'émission</label>
                <input type="date" name="issued_at" id="issued_at" value="<?php echo e(old('issued_at', $certification->issued_at?->format('Y-m-d'))); ?>"
                       style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                <?php $__errorArgs = ['issued_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:var(--red); font-size:12px;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>

            <div class="form-group">
                <label for="expires_at">Date d'expiration</label>
                <input type="date" name="expires_at" id="expires_at" value="<?php echo e(old('expires_at', $certification->expires_at?->format('Y-m-d'))); ?>"
                       style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                <small style="color:var(--muted);">Laissez vide si pas d'expiration</small>
                <?php $__errorArgs = ['expires_at'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:var(--red); font-size:12px;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
        </div>

        <div class="form-group">
            <label for="logo">Logo / Image</label>
            <?php if($certification->logo_path): ?>
                <div style="margin-bottom:12px; display:flex; align-items:center; gap:12px;">
                    <img src="<?php echo e(asset('storage/'.$certification->logo_path)); ?>" alt="<?php echo e($certification->name); ?>" style="max-height:60px; border-radius:4px;">
                    <span style="font-size:12px; color:var(--muted);">Logo actuel</span>
                </div>
            <?php endif; ?>
            <input type="file" name="logo" id="logo" accept="image/*"
                   style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
            <small style="color:var(--muted);">PNG, JPG, JPEG (max 2 MB) — Laissez vide pour garder l'image actuelle</small>
            <?php $__errorArgs = ['logo'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><span style="color:var(--red); font-size:12px;"><?php echo e($message); ?></span><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div class="form-group">
            <label>
                <input type="checkbox" name="is_active" value="1" <?php echo e(old('is_active', $certification->is_active) ? 'checked' : ''); ?>>
                Actif
            </label>
        </div>

        <div style="display:flex; gap:12px; margin-top:20px;">
            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="<?php echo e(route('admin.certifications.index')); ?>" class="btn btn-ghost">Annuler</a>
        </div>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\certifications\edit.blade.php ENDPATH**/ ?>