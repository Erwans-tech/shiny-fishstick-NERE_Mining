<?php $__env->startSection('title','Médiathèque'); ?>
<?php $__env->startSection('page-title','Médiathèque'); ?>

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
    .checkbox-cell {
        width: 40px;
        text-align: center;
    }
    .checkbox-cell input[type="checkbox"] {
        width: 18px;
        height: 18px;
        cursor: pointer;
    }
    tr.selected {
        background: rgba(255, 194, 71, 0.1);
    }
</style>

<form method="GET" action="<?php echo e(route('admin.media.index')); ?>" style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un média..." aria-label="Rechercher un média"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:280px;">
    <select name="placement" aria-label="Filtrer par emplacement" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;">
        <option value="">Tous les emplacements</option>
        <option value="gallery" <?php echo e(request('placement') === 'gallery' ? 'selected' : ''); ?>>Médiathèque</option>
        <option value="homepage_slideshow" <?php echo e(request('placement') === 'homepage_slideshow' ? 'selected' : ''); ?>>Diaporama d'accueil</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request('q') || request('placement')): ?><a href="<?php echo e(route('admin.media.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a><?php endif; ?>
</form>

<div class="card">
    <div class="card-header">
        <h2>Médias (<?php echo e($assets->total()); ?>)</h2>
        <div style="display:flex;gap:8px;flex-wrap:wrap;">
            <a href="<?php echo e(route('admin.media.bulk')); ?>" class="btn btn-primary">📸 Upload Multiple</a>
            <a href="<?php echo e(route('admin.media.create', ['placement' => 'homepage_slideshow'])); ?>" class="btn btn-ghost">+ Image du diaporama</a>
            <a href="<?php echo e(route('admin.media.create')); ?>" class="btn btn-ghost">+ Ajouter un média</a>
        </div>
    </div>
    <div class="table-wrap">
        <table id="media-table">
            <thead>
                <tr>
                    <th class="checkbox-cell">
                        <input type="checkbox" id="select-all" title="Tout sélectionner">
                    </th>
                    <th>Aperçu</th>
                    <th>Titre</th>
                    <th>Type</th>
                    <th>Emplacement</th>
                    <th>Album</th>
                    <th>Ordre</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $assets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $a): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr data-id="<?php echo e($a->id); ?>">
                <td class="checkbox-cell">
                    <input type="checkbox" class="media-checkbox" value="<?php echo e($a->id); ?>">
                </td>
                <td>
                    <?php if($a->type === 'image' && $a->url): ?>
                        <img src="<?php echo e($a->url); ?>" style="height:48px;width:72px;object-fit:cover;border-radius:4px;">
                    <?php elseif($a->external_url): ?>
                        <a href="<?php echo e($a->external_url); ?>" target="_blank" rel="noopener" class="badge badge-green">Lien ↗</a>
                    <?php else: ?>
                        <span class="badge badge-gray"><?php echo e(strtoupper($a->type)); ?></span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($a->title); ?></td>
                <td class="td-muted"><?php echo e($a->type); ?></td>
                <td><span class="badge <?php echo e($a->placement === 'homepage_slideshow' ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($a->placement === 'homepage_slideshow' ? 'Accueil' : 'Médiathèque'); ?></span></td>
                <td>
                    <?php if(method_exists($a, 'album') && $a->album): ?>
                        <a href="<?php echo e(route('admin.albums.show', $a->album)); ?>" class="badge badge-blue" style="text-decoration:none;">
                            📁 <?php echo e(Str::limit($a->album->title, 20)); ?>

                        </a>
                    <?php else: ?>
                        <span class="badge badge-gray">Aucun</span>
                    <?php endif; ?>
                </td>
                <td class="td-muted"><?php echo e($a->sort_order); ?></td>
                <td><span class="badge <?php echo e($a->is_published ? 'badge-green' : 'badge-gray'); ?>"><?php echo e($a->is_published ? 'Visible' : 'Masqué'); ?></span></td>
                <td>
                    <a href="<?php echo e(route('admin.media.edit', $a)); ?>" class="btn btn-ghost btn-sm">Modifier</a>
                    <form method="POST" action="<?php echo e(route('admin.media.destroy', $a)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">Supprimer</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="9" style="text-align:center;padding:40px;color:var(--muted);">Aucun média.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($assets->hasPages()): ?><div class="card-body"><?php echo e($assets->links()); ?></div><?php endif; ?>
</div>

<!-- Bulk Actions Bar -->
<div class="bulk-actions-bar" id="bulk-actions-bar">
    <div class="bulk-info">
        <span id="selected-count">0</span> élément(s) sélectionné(s)
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

<script>
(function() {
    'use strict';

    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.media-checkbox');
    const bulkBar = document.getElementById('bulk-actions-bar');
    const selectedCount = document.getElementById('selected-count');
    const cancelBtn = document.getElementById('cancel-selection');
    const deleteBtn = document.getElementById('delete-selected');
    const bulkForm = document.getElementById('bulk-delete-form');
    const bulkIdsInput = document.getElementById('bulk-delete-ids');

    function updateBulkBar() {
        const selected = Array.from(checkboxes).filter(cb => cb.checked);
        const count = selected.length;

        if (count > 0) {
            bulkBar.classList.add('active');
            selectedCount.textContent = count;
        } else {
            bulkBar.classList.remove('active');
        }

        // Update row highlighting
        checkboxes.forEach(cb => {
            const row = cb.closest('tr');
            if (cb.checked) {
                row.classList.add('selected');
            } else {
                row.classList.remove('selected');
            }
        });

        // Update select all checkbox
        selectAll.checked = count === checkboxes.length && count > 0;
        selectAll.indeterminate = count > 0 && count < checkboxes.length;
    }

    // Select all toggle
    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateBulkBar();
    });

    // Individual checkbox change
    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateBulkBar);
    });

    // Cancel selection
    cancelBtn.addEventListener('click', function() {
        checkboxes.forEach(cb => cb.checked = false);
        selectAll.checked = false;
        updateBulkBar();
    });

    // Delete selected
    deleteBtn.addEventListener('click', function() {
        const selected = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selected.length === 0) return;

        const confirmed = confirm(
            `Voulez-vous vraiment supprimer ${selected.length} média(s) ?\n\n` +
            `⚠️ Cette action est irréversible.`
        );

        if (confirmed) {
            bulkIdsInput.value = selected.join(',');
            bulkForm.submit();
        }
    });

    console.log('✓ Bulk selection initialized');
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\media\index.blade.php ENDPATH**/ ?>