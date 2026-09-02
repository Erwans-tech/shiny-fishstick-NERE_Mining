<?php $__env->startSection('title', $document->exists ? 'Modifier le communiqué' : 'Nouveau communiqué'); ?>
<?php $__env->startSection('page-title', $document->exists ? 'Modifier le communiqué' : 'Nouveau communiqué'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($document->exists ? route('admin.press.update', $document) : route('admin.press.store')); ?>"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($document->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($document->exists ? $document->title : 'Nouveau communiqué'); ?></h2>
            <a href="<?php echo e(route('admin.press.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $document->title)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Type de document *</label>
                    <input type="text" name="document_type" value="<?php echo e(old('document_type', $document->document_type)); ?>" placeholder="Communiqué, Rapport, Presse…" required>
                </div>
                <div class="form-group">
                    <label>Date de publication</label>
                    <input type="date" name="published_at" value="<?php echo e(old('published_at', $document->published_at?->format('Y-m-d'))); ?>">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description"><?php echo e(old('description', $document->description)); ?></textarea>
                </div>
                <div class="form-group full">
                    <label>Fichier (PDF, DOC)</label>
                    <?php if($document->file_path): ?><div style="margin-bottom:8px;"><a href="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($document->file_path)); ?>" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div><?php endif; ?>
                    <input type="file" name="file" accept=".pdf,.doc,.docx">
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary"><?php echo e($document->exists ? '✓ Enregistrer' : '+ Créer'); ?></button>
                    <a href="<?php echo e(route('admin.press.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\press\form.blade.php ENDPATH**/ ?>