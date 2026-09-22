<?php $__env->startSection('title', $album->exists ? 'Modifier l\'album' : 'Nouvel album'); ?>
<?php $__env->startSection('page-title', $album->exists ? 'Modifier l\'album' : 'Nouvel album'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($album->exists ? route('admin.albums.update', $album) : route('admin.albums.store')); ?>"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($album->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($album->exists ? $album->title : 'Nouvel album'); ?></h2>
            <a href="<?php echo e(route('admin.albums.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre de l'album *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $album->title)); ?>" required 
                           placeholder="Ex: Visite du Ministre - Février 2026">
                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small style="color:var(--red);display:block;margin-top:6px;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group full">
                    <label>Description</label>
                    <textarea name="description" rows="4" 
                              placeholder="Décrivez le contexte de cet album photo..."><?php echo e(old('description', $album->description)); ?></textarea>
                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small style="color:var(--red);display:block;margin-top:6px;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group full">
                    <label>Image de couverture</label>
                    <?php if($album->exists && $album->cover_image): ?>
                        <div style="margin-bottom:12px;">
                            <img src="<?php echo e($album->cover_url); ?>" alt="Couverture" 
                                 style="height:120px;border-radius:8px;object-fit:cover;border:2px solid var(--line);">
                            <small style="display:block;margin-top:6px;color:var(--muted);">Image actuelle</small>
                        </div>
                    <?php endif; ?>
                    <input type="file" name="cover_image_file" accept="image/jpeg,image/png,image/webp">
                    <small style="display:block;margin-top:6px;color:var(--muted);">
                        Si non fournie, la première photo de l'album sera utilisée. Formats: JPG, PNG, WebP (max 5MB)
                    </small>
                    <?php $__errorArgs = ['cover_image_file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small style="color:var(--red);display:block;margin-top:6px;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $album->sort_order ?? 0)); ?>" min="0">
                    <small style="display:block;margin-top:6px;color:var(--muted);">
                        Les albums sont affichés du plus petit au plus grand numéro
                    </small>
                    <?php $__errorArgs = ['sort_order'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <small style="color:var(--red);display:block;margin-top:6px;"><?php echo e($message); ?></small>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>

                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               <?php echo e(old('is_published', $album->is_published ?? true) ? 'checked' : ''); ?>>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">
                            Publier sur le site
                        </label>
                    </div>
                    <small style="display:block;margin-top:6px;color:var(--muted);">
                        Décochez pour garder l'album en brouillon
                    </small>
                </div>

                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary">
                        <?php echo e($album->exists ? '✓ Enregistrer' : '+ Créer l\'album'); ?>

                    </button>
                    <a href="<?php echo e(route('admin.albums.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>

    <?php if($album->exists): ?>
    <div class="card" style="margin-top:24px;background:var(--sand);">
        <div class="card-body">
            <h3 style="margin-bottom:12px;font-size:16px;">📸 Ajouter des photos à cet album</h3>
            <p style="margin-bottom:12px;color:var(--muted);">
                Pour ajouter des photos à cet album, allez dans <strong>Médiathèque</strong> et sélectionnez l'album 
                lors de l'ajout ou modification d'un média.
            </p>
            <a href="<?php echo e(route('admin.media.create')); ?>" class="btn btn-primary">+ Ajouter une photo</a>
            <?php if($album->media_count > 0): ?>
                <a href="<?php echo e(route('admin.albums.show', $album)); ?>" class="btn btn-ghost">
                    👁️ Voir les <?php echo e($album->media_count); ?> photos
                </a>
            <?php endif; ?>
        </div>
    </div>
    <?php endif; ?>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\albums\form.blade.php ENDPATH**/ ?>