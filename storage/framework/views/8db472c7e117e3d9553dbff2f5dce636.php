<?php $__env->startSection('title', $album->title); ?>
<?php $__env->startSection('page-title', $album->title); ?>

<?php $__env->startSection('content'); ?>
<style>
    .bulk-actions-bar {
        position: fixed;
        bottom: 0;
        left: 0;
        right: 0;
        background: var(--green);
        color: white;
        padding: 16px 24px;
        display: none;
        align-items: center;
        justify-content: space-between;
        box-shadow: 0 -4px 12px rgba(0,0,0,0.15);
        z-index: 1000;
    }
    .bulk-actions-bar.active { display: flex; }
    .bulk-info { font-size: 14px; font-weight: 600; }
    .bulk-btns { display: flex; gap: 12px; }
    .bulk-btns button { 
        padding: 8px 16px;
        border-radius: 6px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    .btn-delete-bulk { background: var(--red); color: white; }
    .btn-delete-bulk:hover { background: #c13030; }
    .btn-cancel-bulk { background: white; color: var(--green); }
    .btn-cancel-bulk:hover { opacity: 0.9; }
    .photo-card {
        border: 1px solid var(--line);
        border-radius: 8px;
        overflow: hidden;
        background: white;
        position: relative;
        transition: all 0.2s;
    }
    .photo-card.selected {
        border-color: var(--gold);
        box-shadow: 0 0 0 2px rgba(255, 194, 71, 0.2);
    }
    .photo-checkbox {
        position: absolute;
        top: 8px;
        left: 8px;
        width: 24px;
        height: 24px;
        cursor: pointer;
        z-index: 10;
        opacity: 0;
        transition: opacity 0.2s;
    }
    .photo-card:hover .photo-checkbox,
    .photo-checkbox:checked {
        opacity: 1;
    }
    .select-all-photos {
        padding: 12px;
        background: white;
        border: 1px solid var(--line);
        border-radius: 6px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 8px;
    }
    .select-all-photos input {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
</style>

<div class="card">
    <div class="card-header">
        <div>
            <h2><?php echo e($album->title); ?></h2>
            <?php if($album->description): ?>
                <p style="margin-top:8px;color:var(--muted);font-size:14px;"><?php echo e($album->description); ?></p>
            <?php endif; ?>
        </div>
        <div style="display:flex;gap:8px;">
            <a href="<?php echo e(route('admin.albums.edit', $album)); ?>" class="btn btn-ghost">Modifier l'album</a>
            <a href="<?php echo e(route('admin.albums.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
        </div>
    </div>
    
    <div class="card-body">
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;padding:16px;background:var(--sand);border-radius:8px;">
            <div>
                <strong style="font-size:15px;"><?php echo e($album->media->count()); ?> photos dans cet album</strong>
                <p style="margin-top:4px;font-size:13px;color:var(--muted);">
                    Ordre d'affichage: <?php echo e($album->sort_order); ?> • 
                    Statut: <span class="badge <?php echo e($album->is_published ? 'badge-green' : 'badge-gray'); ?>">
                        <?php echo e($album->is_published ? 'Publié' : 'Brouillon'); ?>

                    </span>
                </p>
            </div>
            <a href="<?php echo e(route('admin.media.create')); ?>" class="btn btn-primary">+ Ajouter une photo</a>
        </div>

        <?php if($album->media->isEmpty()): ?>
            <div style="text-align:center;padding:60px 20px;color:var(--muted);">
                <div style="font-size:64px;margin-bottom:16px;">📸</div>
                <h3 style="font-size:18px;margin-bottom:8px;">Aucune photo dans cet album</h3>
                <p style="margin-bottom:20px;">Ajoutez des photos depuis la médiathèque</p>
                <a href="<?php echo e(route('admin.media.create')); ?>" class="btn btn-primary">+ Ajouter une photo</a>
            </div>
        <?php else: ?>
            <div class="select-all-photos">
                <input type="checkbox" id="select-all-album" title="Tout sélectionner">
                <label for="select-all-album" style="cursor:pointer;user-select:none;font-weight:500;font-size:13px;">
                    Sélectionner toutes les photos
                </label>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(200px,1fr));gap:16px;">
                <?php $__currentLoopData = $album->media; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $media): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="photo-card" data-id="<?php echo e($media->id); ?>">
                        <input type="checkbox" class="photo-checkbox" value="<?php echo e($media->id); ?>">
                        <div style="aspect-ratio:4/3;overflow:hidden;background:var(--sand);">
                            <?php if($media->type === 'image' && $media->url): ?>
                                <img src="<?php echo e($media->url); ?>" alt="<?php echo e($media->title); ?>" 
                                     style="width:100%;height:100%;object-fit:cover;">
                            <?php else: ?>
                                <div style="width:100%;height:100%;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px;">
                                    📄
                                </div>
                            <?php endif; ?>
                        </div>
                        <div style="padding:12px;">
                            <strong style="font-size:13px;display:block;margin-bottom:4px;"><?php echo e($media->title); ?></strong>
                            <div style="font-size:11px;color:var(--muted);margin-bottom:8px;">
                                Ordre: <?php echo e($media->sort_order); ?> • 
                                <span class="badge <?php echo e($media->is_published ? 'badge-green' : 'badge-gray'); ?>" style="font-size:10px;">
                                    <?php echo e($media->is_published ? 'Publié' : 'Masqué'); ?>

                                </span>
                            </div>
                            <div style="display:flex;gap:4px;">
                                <a href="<?php echo e(route('admin.media.edit', $media)); ?>" class="btn btn-ghost btn-sm" style="font-size:11px;padding:4px 8px;">
                                    Modifier
                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Bulk Actions Bar -->
<div class="bulk-actions-bar" id="bulk-actions-bar">
    <div class="bulk-info">
        <span id="selected-count">0</span> photo(s) sélectionnée(s)
    </div>
    <div class="bulk-btns">
        <button type="button" class="btn-cancel-bulk" id="cancel-selection">Annuler</button>
        <button type="button" class="btn-delete-bulk" id="delete-selected">🗑️ Supprimer la sélection</button>
    </div>
</div>

<form id="bulk-delete-form" method="POST" action="<?php echo e(route('admin.media.bulk.delete')); ?>" style="display:none;">
    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
    <input type="hidden" name="ids" id="bulk-delete-ids">
</form>

<div class="card" style="margin-top:24px;background:var(--sand);">
    <div class="card-body">
        <h3 style="margin-bottom:12px;font-size:16px;">💡 Astuce</h3>
        <p style="line-height:1.6;color:var(--muted);">
            Pour réorganiser l'ordre des photos, modifiez le champ "Ordre d'affichage" de chaque photo. 
            Les photos sont affichées du plus petit au plus grand numéro. Utilisez les cases à cocher pour supprimer plusieurs photos à la fois.
        </p>
    </div>
</div>

<script>
(function() {
    'use strict';

    const selectAll = document.getElementById('select-all-album');
    const checkboxes = document.querySelectorAll('.photo-checkbox');
    const bulkBar = document.getElementById('bulk-actions-bar');
    const selectedCount = document.getElementById('selected-count');
    const cancelBtn = document.getElementById('cancel-selection');
    const deleteBtn = document.getElementById('delete-selected');
    const bulkForm = document.getElementById('bulk-delete-form');
    const bulkIdsInput = document.getElementById('bulk-delete-ids');

    if (checkboxes.length === 0) return; // Pas de photos

    function updateBulkBar() {
        const selected = Array.from(checkboxes).filter(cb => cb.checked);
        const count = selected.length;

        if (count > 0) {
            bulkBar.classList.add('active');
            selectedCount.textContent = count;
        } else {
            bulkBar.classList.remove('active');
        }

        // Update card highlighting
        checkboxes.forEach(cb => {
            const card = cb.closest('.photo-card');
            if (cb.checked) {
                card.classList.add('selected');
            } else {
                card.classList.remove('selected');
            }
        });

        // Update select all checkbox
        if (selectAll) {
            selectAll.checked = count === checkboxes.length && count > 0;
            selectAll.indeterminate = count > 0 && count < checkboxes.length;
        }
    }

    // Select all toggle
    if (selectAll) {
        selectAll.addEventListener('change', function() {
            checkboxes.forEach(cb => cb.checked = this.checked);
            updateBulkBar();
        });
    }

    // Individual checkbox change
    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkBar);
    });

    // Cancel selection
    cancelBtn.addEventListener('click', function() {
        checkboxes.forEach(cb => cb.checked = false);
        if (selectAll) selectAll.checked = false;
        updateBulkBar();
    });

    // Delete selected
    deleteBtn.addEventListener('click', function() {
        const selected = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selected.length === 0) return;

        const confirmed = confirm(
            `Voulez-vous vraiment supprimer ${selected.length} photo(s) de cet album ?\n\n` +
            `⚠️ Cette action est irréversible.`
        );

        if (confirmed) {
            bulkIdsInput.value = selected.join(',');
            bulkForm.submit();
        }
    });

    console.log('✓ Album bulk selection initialized');
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\albums\show.blade.php ENDPATH**/ ?>