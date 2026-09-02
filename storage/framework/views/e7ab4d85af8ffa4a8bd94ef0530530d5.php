<?php $__env->startSection('title', $department->exists ? 'Modifier le département' : 'Nouveau département'); ?>
<?php $__env->startSection('page-title', $department->exists ? 'Modifier le département' : 'Nouveau département'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($department->exists ? route('admin.karma-departments.update', $department) : route('admin.karma-departments.store')); ?>">
    <?php echo csrf_field(); ?>
    <?php if($department->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($department->exists ? $department->title_fr : 'Nouveau département'); ?></h2>
            <a href="<?php echo e(route('admin.karma-departments.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group">
                    <label>Titre FR *</label>
                    <input type="text" name="title_fr" value="<?php echo e(old('title_fr', $department->title_fr)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Titre EN *</label>
                    <input type="text" name="title_en" value="<?php echo e(old('title_en', $department->title_en)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Tag FR *</label>
                    <input type="text" name="tag_fr" value="<?php echo e(old('tag_fr', $department->tag_fr)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Tag EN *</label>
                    <input type="text" name="tag_en" value="<?php echo e(old('tag_en', $department->tag_en)); ?>" required>
                </div>
                <div class="form-group full">
                    <label>Description FR *</label>
                    <textarea name="body_fr" rows="5" required><?php echo e(old('body_fr', $department->body_fr)); ?></textarea>
                </div>
                <div class="form-group full">
                    <label>Description EN *</label>
                    <textarea name="body_en" rows="5" required><?php echo e(old('body_en', $department->body_en)); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $department->sort_order ?? 0)); ?>" min="0">
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               <?php echo e(old('is_published', $department->is_published ?? true) ? 'checked' : ''); ?>>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur la page Karma</label>
                    </div>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary"><?php echo e($department->exists ? '✓ Enregistrer' : '+ Ajouter'); ?></button>
                    <a href="<?php echo e(route('admin.karma-departments.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\karma-departments\form.blade.php ENDPATH**/ ?>