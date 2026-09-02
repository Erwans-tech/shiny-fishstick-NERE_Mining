<?php $__env->startSection('title', $news->exists ? 'Modifier l\'article' : 'Nouvel article'); ?>
<?php $__env->startSection('page-title', $news->exists ? 'Modifier l\'article' : 'Nouvel article'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($news->exists ? route('admin.news.update', $news) : route('admin.news.store')); ?>"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($news->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>

    <div class="card">
        <div class="card-header">
            <h2><?php echo e($news->exists ? 'Modifier : '.$news->title : 'Nouvel article'); ?></h2>
            <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label for="title">Titre *</label>
                    <input id="title" type="text" name="title" value="<?php echo e(old('title', $news->title)); ?>" required>
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
                    <label for="category">Catégorie *</label>
                    <input id="category" type="text" name="category" value="<?php echo e(old('category', $news->category)); ?>" placeholder="Ex : Exploitation, RSE, Communiqué…" required>
                    <?php $__errorArgs = ['category'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?><div class="form-error"><?php echo e($message); ?></div><?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                <div class="form-group">
                    <label for="published_at">Date de publication</label>
                    <input id="published_at" type="date" name="published_at"
                           value="<?php echo e(old('published_at', $news->published_at?->format('Y-m-d'))); ?>">
                    <span class="form-hint">Laisser vide pour enregistrer en brouillon.</span>
                </div>
                <div class="form-group full">
                    <label for="excerpt">Extrait</label>
                    <textarea id="excerpt" name="excerpt" style="min-height:80px;"><?php echo e(old('excerpt', $news->excerpt)); ?></textarea>
                </div>
                <div class="form-group full">
                    <label for="content">Contenu</label>
                    <textarea id="content" name="content" style="min-height:220px;"><?php echo e(old('content', $news->content)); ?></textarea>
                </div>
                <div class="form-group full">
                    <label for="image">Image principale</label>
                    <?php if($news->image_path): ?>
                    <div style="margin-bottom:10px;">
                        <img src="<?php echo e(\App\Helpers\StorageHelper::uploadUrl($news->image_path)); ?>" style="height:100px;border-radius:6px;object-fit:cover;">
                    </div>
                    <?php endif; ?>
                    <input id="image" type="file" name="image" accept="image/*">
                    <span class="form-hint">PNG, JPG — max 8 Mo. En local, la limite PHP doit être configurée à 8 Mo minimum.</span>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        <?php echo e($news->exists ? '✓ Enregistrer' : '+ Créer l\'article'); ?>

                    </button>
                    <a href="<?php echo e(route('admin.news.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\news\form.blade.php ENDPATH**/ ?>