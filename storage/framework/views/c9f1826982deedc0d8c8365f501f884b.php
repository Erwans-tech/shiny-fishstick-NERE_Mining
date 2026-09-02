<?php $__env->startSection('title', $report->exists ? 'Modifier la publication' : 'Nouvelle publication'); ?>
<?php $__env->startSection('page-title', $report->exists ? 'Modifier' : 'Nouvelle publication'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($report->exists ? route('admin.reports.update', $report) : route('admin.reports.store')); ?>"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($report->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($report->exists ? $report->title : 'Nouvelle publication'); ?></h2>
            <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $report->title)); ?>" required>
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label>Catégorie *</label>
                    <input type="text" name="category" value="<?php echo e(old('category', $report->category)); ?>" placeholder="RSE, Activité, Technique…" required>
                </div>
                <div class="form-group">
                    <label>Date de publication</label>
                    <input type="date" name="published_at" value="<?php echo e(old('published_at', $report->published_at?->format('Y-m-d'))); ?>">
                </div>
                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description"><?php echo e(old('description', $report->description)); ?></textarea>
                </div>
                <div class="form-group">
                    <label>Fichier PDF</label>
                    <?php if($report->file_path): ?><div style="margin-bottom:8px;"><a href="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($report->file_path)); ?>" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div><?php endif; ?>
                    <input type="file" name="file" accept=".pdf">
                </div>
                <div class="form-group">
                    <label>Image de couverture</label>
                    <?php if($report->cover_image): ?><div style="margin-bottom:8px;"><img src="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($report->cover_image)); ?>" style="height:80px;border-radius:4px;object-fit:cover;"></div><?php endif; ?>
                    <input type="file" name="cover" accept="image/*">
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary"><?php echo e($report->exists ? '✓ Enregistrer' : '+ Créer'); ?></button>
                    <a href="<?php echo e(route('admin.reports.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\reports\form.blade.php ENDPATH**/ ?>