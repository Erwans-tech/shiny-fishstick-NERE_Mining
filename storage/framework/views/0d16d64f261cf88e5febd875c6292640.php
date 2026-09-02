<?php $__env->startSection('title', $asset->exists ? 'Modifier le média' : 'Nouveau média'); ?>
<?php $__env->startSection('page-title', $asset->exists ? 'Modifier' : 'Nouveau média'); ?>

<?php $__env->startSection('content'); ?>
<form method="POST"
      action="<?php echo e($asset->exists ? route('admin.media.update', $asset) : route('admin.media.store')); ?>"
      enctype="multipart/form-data">
    <?php echo csrf_field(); ?>
    <?php if($asset->exists): ?> <?php echo method_field('PUT'); ?> <?php endif; ?>
    <div class="card">
        <div class="card-header">
            <h2><?php echo e($asset->exists ? $asset->title : 'Nouveau média'); ?></h2>
            <a href="<?php echo e(route('admin.media.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
        <div class="card-body">
            <div class="form-grid">
                <div class="form-group full">
                    <label>Titre *</label>
                    <input type="text" name="title" value="<?php echo e(old('title', $asset->title)); ?>" required>
                </div>
                <div class="form-group">
                    <label>Type *</label>
                    <select name="type">
                        <?php $__currentLoopData = ['image' => 'Image', 'video' => 'Vidéo', 'document' => 'Document', 'youtube' => 'YouTube', 'google_drive' => 'Google Drive']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value => $label): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($value); ?>" <?php echo e(old('type', $asset->type ?? 'image') === $value ? 'selected' : ''); ?>><?php echo e($label); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Emplacement *</label>
                    <select name="placement">
                        <option value="gallery" <?php echo e(old('placement', $asset->placement ?? 'gallery') === 'gallery' ? 'selected' : ''); ?>>Médiathèque</option>
                        <option value="homepage_slideshow" <?php echo e(old('placement', $asset->placement ?? 'gallery') === 'homepage_slideshow' ? 'selected' : ''); ?>>Diaporama de l’accueil</option>
                    </select>
                    <small style="display:block;margin-top:6px;color:var(--muted);">« Diaporama de l’accueil » affiche l’image en fond de la page d’accueil. Utilisez l’ordre pour définir la séquence (jusqu’à 12 images).</small>
                </div>
                <div class="form-group">
                    <label>Ordre d'affichage</label>
                    <input type="number" name="sort_order" value="<?php echo e(old('sort_order', $asset->sort_order ?? 0)); ?>" min="0">
                </div>
                <div class="form-group full">
                    <label>Légende</label>
                    <textarea name="caption" style="min-height:80px;"><?php echo e(old('caption', $asset->caption)); ?></textarea>
                </div>
                <div class="form-group full">
                    <label>Lien YouTube ou Google Drive</label>
                    <?php if($asset->external_url): ?>
                        <div style="margin-bottom:10px;"><a href="<?php echo e($asset->external_url); ?>" target="_blank" rel="noopener" class="badge badge-green">Lien actuel ↗</a></div>
                    <?php endif; ?>
                    <input type="url" name="external_url" value="<?php echo e(old('external_url', $asset->external_url)); ?>" placeholder="https://www.youtube.com/watch?v=... ou https://drive.google.com/file/d/...">
                    <small style="display:block;margin-top:6px;color:var(--muted);">Obligatoire pour les types YouTube et Google Drive.</small>
                </div>
                <div class="form-group full">
                    <label>Fichier</label>
                    <?php if($asset->file_path): ?>
                        <?php if($asset->type === 'image' && $asset->file_path): ?>
                        <img src="<?php echo e($asset->url); ?>" style="height:100px;border-radius:6px;object-fit:cover;">
                    <?php else: ?>
                        <div style="margin-bottom:10px;"><a href="<?php echo e($asset->url); ?>" target="_blank" class="badge badge-green">Fichier actuel ↗</a></div>
                    <?php endif; ?>
                    <?php endif; ?>
                    <input type="file" name="file" accept="image/jpeg,image/png,image/webp,image/svg+xml,video/mp4,video/webm,video/quicktime,application/pdf,.doc,.docx">
                    <small style="display:block;margin-top:6px;color:var(--muted);">Obligatoire pour le diaporama d’accueil (JPG, PNG ou WebP).</small>
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <input type="hidden" name="is_published" value="0">
                        <input type="checkbox" id="is_published" name="is_published" value="1"
                               <?php echo e(old('is_published', $asset->is_published ?? true) ? 'checked' : ''); ?>>
                        <label for="is_published" style="text-transform:none;font-size:14px;font-weight:500;color:var(--ink);">Visible sur le site</label>
                    </div>
                </div>
                <div class="form-actions full">
                    <button type="submit" class="btn btn-primary"><?php echo e($asset->exists ? '✓ Enregistrer' : '+ Ajouter'); ?></button>
                    <a href="<?php echo e(route('admin.media.index')); ?>" class="btn btn-ghost">Annuler</a>
                </div>
            </div>
        </div>
    </div>
</form>
<script>
    (function () {
        var placement = document.querySelector('select[name="placement"]');
        var type = document.querySelector('select[name="type"]');
        if (!placement || !type) return;
        function syncType() {
            if (placement.value === 'homepage_slideshow') type.value = 'image';
        }
        placement.addEventListener('change', syncType);
        syncType();
    })();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\media\form.blade.php ENDPATH**/ ?>