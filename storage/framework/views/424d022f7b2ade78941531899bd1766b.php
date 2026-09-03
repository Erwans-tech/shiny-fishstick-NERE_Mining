
<?php $__env->startSection('title', $member->exists ? 'Modifier le membre' : 'Nouveau membre'); ?>
<?php $__env->startSection('page-title', $member->exists ? 'Modifier le membre' : 'Nouveau membre'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST" action="<?php echo e($member->exists ? route('admin.leadership.update', $member) : route('admin.leadership.store')); ?>" enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($member->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($member->exists ? $member->name : 'Nouveau membre'); ?></h2>
            <a href="<?php echo e(route('admin.leadership.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Nom complet *</label>
                    <input type="text" name="name" value="<?php echo e(old('name', $member->name)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Fonction *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $member->title)); ?>" placeholder="Directeur Général" required>
                </div>
                <div class="form-group">
                    <label>Département</label>
                    <input type="text" name="department" value="<?php echo e(old('department', $member->department)); ?>" placeholder="Direction générale, Opérations...">
                </div>
                <div class="form-group">
                    <label>Niveau hiérarchique *</label>
                    <select name="hierarchy_level" required>
                        <option value="1" <?php echo e(old('hierarchy_level', $member->hierarchy_level ?? 2) == 1 ? 'selected' : ''); ?>>Direction générale</option>
                        <option value="2" <?php echo e(old('hierarchy_level', $member->hierarchy_level ?? 2) == 2 ? 'selected' : ''); ?>>Direction générale adjointe</option>
                        <option value="3" <?php echo e(old('hierarchy_level', $member->hierarchy_level ?? 2) == 3 ? 'selected' : ''); ?>>Direction / responsable</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $member->sort_order ?? 0)); ?>" min="0">
                </div>
                <div class="form-group full">
                    <label>Photo</label>
                    <?php if($member->photo_path): ?>
                    <div style="margin-bottom:10px;"><img src="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($member->photo_path)); ?>" style="width:88px;height:88px;border-radius:50%;object-fit:cover;"></div>
                    <?php endif; ?>
                    <input type="file" name="photo" accept="image/*">
                    <span class="form-hint">JPG, PNG ou WebP — max 4 Mo.</span>
                </div>
                <div class="form-group full">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1" <?php echo e(old('is_published', $member->is_published ?? true) ? 'checked' : ''); ?>>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur le site</label>
                    </div>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary"><?php echo e($member->exists ? 'Enregistrer' : 'Ajouter'); ?></button>
                    <a href="<?php echo e(route('admin.leadership.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\leadership\form.blade.php ENDPATH**/ ?>