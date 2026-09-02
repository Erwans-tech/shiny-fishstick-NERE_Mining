<?php $__env->startSection('title', 'Carrousel Hero'); ?>
<?php $__env->startSection('page-title', 'Carrousel — Page d\'accueil'); ?>

<?php $__env->startSection('content'); ?>


<div class="card" style="margin-bottom:20px;">
    <div class="card-header">
        <div>
            <h2>🖼️ Diaporama de la page d'accueil</h2>
            <span class="card-header-sub">
                <?php echo e($slides->count()); ?> slide(s) · <?php echo e($slides->where('is_active', true)->count()); ?> active(s)
            </span>
        </div>
        <a href="<?php echo e(route('admin.hero.create')); ?>" class="btn btn-primary">
            + Ajouter une image
        </a>
    </div>

    
    <div style="height:3px; background:linear-gradient(to right,
        <?php echo e($slides->where('is_active',true)->count() > 0 ? '#ffc247' : '#eadcc5'); ?>,
        <?php echo e($slides->where('is_active',true)->count() > 0 ? '#e5a72f' : '#eadcc5'); ?>

    );"></div>

    
    <div style="padding:14px 20px; background:#faf8f4; border-bottom:1px solid var(--line); font:13px Inter,sans-serif; color:var(--muted); display:flex; align-items:center; gap:10px;">
        <span style="font-size:16px;">💡</span>
        <span>
            Faites glisser les lignes pour réordonner. Cliquez sur <strong>Activer/Masquer</strong> pour contrôler l'affichage sur le site en temps réel.
            <?php if($slides->isEmpty()): ?>
                <strong style="color:#854d0e;"> — Aucune slide configurée : les 5 images par défaut (karma-01 à karma-05) sont utilisées.</strong>
            <?php endif; ?>
        </span>
    </div>
</div>


<?php if($slides->isEmpty()): ?>
<div class="card" style="padding:48px; text-align:center; color:var(--muted);">
    <div style="font-size:40px; margin-bottom:14px;">🏔️</div>
    <h3 style="font:500 18px Inter,sans-serif; color:var(--green); margin-bottom:8px;">Aucune slide configurée</h3>
    <p style="font-size:14px; margin-bottom:20px;">Le carrousel utilise actuellement les 5 images par défaut.<br>Ajoutez vos propres images pour personnaliser le diaporama.</p>
    <a href="<?php echo e(route('admin.hero.create')); ?>" class="btn btn-primary">+ Ajouter la première slide</a>
</div>


<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2 style="color:var(--muted);">Images par défaut (actuellement affichées)</h2>
    </div>
    <div style="display:grid; grid-template-columns:repeat(5,1fr); gap:12px; padding:20px;">
        <?php $__currentLoopData = range(1,5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div style="border-radius:8px; overflow:hidden; border:1px solid var(--line);">
            <img src="<?php echo e(asset('images/mining/karma-0'.$i.'.jpg')); ?>"
                 style="width:100%; height:120px; object-fit:cover; display:block;"
                 alt="Karma 0<?php echo e($i); ?>">
            <div style="padding:8px 10px; font:500 11px Inter,sans-serif; color:var(--muted); background:#faf8f4;">
                karma-0<?php echo e($i); ?>.jpg
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
</div>

<?php else: ?>

<div id="slides-list" class="card">
    <div class="card-header">
        <h2>Slides configurées</h2>
        <span style="font:500 12px Inter,sans-serif; color:var(--muted);">⠿ Glisser pour réordonner</span>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th style="width:44px;">⠿</th>
                    <th style="width:120px;">Aperçu</th>
                    <th>Titre / Légende</th>
                    <th style="width:80px;">Ordre</th>
                    <th style="width:100px;">Statut</th>
                    <th style="width:160px;">Actions</th>
                </tr>
            </thead>
            <tbody id="sortable-slides">
                <?php $__currentLoopData = $slides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr data-id="<?php echo e($slide->id); ?>" style="cursor:grab; <?php echo e(!$slide->is_active ? 'opacity:.55;' : ''); ?>">
                    
                    <td style="text-align:center; font-size:18px; color:var(--muted); cursor:grab;">⠿</td>

                    
                    <td>
                        <div style="width:110px; height:65px; border-radius:6px; overflow:hidden; border:1px solid var(--line);">
                            <img src="<?php echo e($slide->url); ?>"
                                 style="width:100%; height:100%; object-fit:cover;"
                                 alt="<?php echo e($slide->title ?? 'Slide'); ?>"
                                 loading="lazy">
                        </div>
                    </td>

                    
                    <td>
                        <div style="font:600 13px Inter,sans-serif; color:var(--green);">
                            <?php echo e($slide->title ?? '—'); ?>

                        </div>
                        <?php if($slide->caption): ?>
                        <div style="font:12px Inter,sans-serif; color:var(--muted); margin-top:3px; font-style:italic;">
                            "<?php echo e(Str::limit($slide->caption, 60)); ?>"
                        </div>
                        <?php endif; ?>
                        <div style="font:11px Inter,sans-serif; color:var(--muted); margin-top:4px;">
                            <?php echo e(basename($slide->image_path)); ?>

                        </div>
                    </td>

                    
                    <td style="text-align:center;">
                        <span style="display:inline-flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:50%; background:var(--sand); font:600 13px Inter,sans-serif; color:var(--green);">
                            <?php echo e($slide->sort_order + 1); ?>

                        </span>
                    </td>

                    
                    <td>
                        <form method="POST" action="<?php echo e(route('admin.hero.toggle', $slide)); ?>">
                            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
                            <button type="submit"
                                class="badge <?php echo e($slide->is_active ? 'badge-green' : 'badge-gray'); ?>"
                                style="border:none; cursor:pointer; padding:5px 12px;">
                                <?php echo e($slide->is_active ? '● Visible' : '○ Masquée'); ?>

                            </button>
                        </form>
                    </td>

                    
                    <td>
                        <div style="display:flex; gap:6px;">
                            <a href="<?php echo e(route('admin.hero.edit', $slide)); ?>" class="btn btn-ghost btn-sm">
                                Modifier
                            </a>
                            <form method="POST" action="<?php echo e(route('admin.hero.destroy', $slide)); ?>"
                                  onsubmit="return confirm('Supprimer cette slide ?')">
                                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">✕</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</div>


<div class="card" style="margin-top:20px;">
    <div class="card-header">
        <h2>👁 Prévisualisation du carrousel</h2>
        <span class="card-header-sub">Rendu approximatif — <?php echo e($slides->where('is_active', true)->count()); ?> slide(s) active(s)</span>
    </div>
    <div style="position:relative; height:220px; overflow:hidden; background:#1a0505;">
        <?php $activeSlides = $slides->where('is_active', true)->values(); ?>
        <?php $__empty_1 = true; $__currentLoopData = $activeSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div style="
            position:absolute; inset:0;
            background:url('<?php echo e($slide->url); ?>') center/cover;
            opacity:<?php echo e($idx === 0 ? '1' : '0'); ?>;
            transition:opacity 1s;
        " id="preview-slide-<?php echo e($idx); ?>">
            <div style="position:absolute; inset:0; background:linear-gradient(to right, rgba(20,4,4,.75), rgba(20,4,4,.2));"></div>
            <?php if($slide->caption): ?>
            <div style="position:absolute; bottom:20px; left:24px; color:#fff; font:500 16px Inter,sans-serif; text-shadow:0 1px 4px rgba(0,0,0,.5);">
                <?php echo e($slide->caption); ?>

            </div>
            <?php endif; ?>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div style="display:flex; align-items:center; justify-content:center; height:100%; color:rgba(255,255,255,.4); font:14px Inter,sans-serif;">
            Aucune slide active
        </div>
        <?php endif; ?>

        
        <?php if($activeSlides->count() > 1): ?>
        <div style="position:absolute; bottom:10px; left:50%; transform:translateX(-50%); display:flex; gap:6px;">
            <?php $__currentLoopData = $activeSlides; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $idx => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="preview-dot" data-idx="<?php echo e($idx); ?>"
                 style="width:8px; height:8px; border-radius:50%; background:<?php echo e($idx === 0 ? '#ffc247' : 'rgba(255,255,255,.4)'); ?>; cursor:pointer; transition:background .2s;"></div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
        <?php endif; ?>
    </div>
</div>


<script>
(function(){
    var count = <?php echo e($activeSlides->count()); ?>;
    var current = 0;
    var timer;

    function showSlide(idx){
        document.querySelectorAll('[id^="preview-slide-"]').forEach(function(el, i){
            el.style.opacity = i === idx ? '1' : '0';
        });
        document.querySelectorAll('.preview-dot').forEach(function(dot, i){
            dot.style.background = i === idx ? '#ffc247' : 'rgba(255,255,255,.4)';
        });
        current = idx;
    }

    function autoAdvance(){
        timer = setInterval(function(){
            showSlide((current + 1) % Math.max(count, 1));
        }, 3000);
    }

    document.querySelectorAll('.preview-dot').forEach(function(dot){
        dot.addEventListener('click', function(){
            clearInterval(timer);
            showSlide(parseInt(this.dataset.idx));
            autoAdvance();
        });
    });

    if(count > 1) autoAdvance();

    // ── Drag-and-drop pour réordonner ──
    var tbody = document.getElementById('sortable-slides');
    if(!tbody) return;

    var dragged = null;

    tbody.addEventListener('dragstart', function(e){
        dragged = e.target.closest('tr');
        dragged.style.opacity = '.5';
    });
    tbody.addEventListener('dragend', function(){
        if(dragged) dragged.style.opacity = '';
        dragged = null;
        saveOrder();
    });
    tbody.addEventListener('dragover', function(e){
        e.preventDefault();
        var target = e.target.closest('tr');
        if(target && target !== dragged && target.parentNode === tbody){
            var rect = target.getBoundingClientRect();
            var mid  = rect.top + rect.height / 2;
            tbody.insertBefore(dragged, e.clientY < mid ? target : target.nextSibling);
        }
    });

    // Rendre les lignes draggables
    tbody.querySelectorAll('tr').forEach(function(tr){ tr.draggable = true; });

    function saveOrder(){
        var rows = tbody.querySelectorAll('tr');
        var order = [];
        rows.forEach(function(tr, i){ order.push({id: parseInt(tr.dataset.id), order: i}); });

        fetch('<?php echo e(route('admin.hero.reorder')); ?>', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name=csrf-token]')?.content
                    || '<?php echo e(csrf_token()); ?>'
            },
            body: JSON.stringify({order: order})
        }).then(function(r){ return r.json(); })
          .then(function(d){ if(d.success) showToast('Ordre sauvegardé ✓'); })
          .catch(function(){ showToast('Erreur lors de la sauvegarde', true); });
    }

    function showToast(msg, error){
        var t = document.createElement('div');
        t.textContent = msg;
        t.style.cssText = 'position:fixed;bottom:24px;right:24px;padding:12px 20px;border-radius:8px;font:600 13px Inter,sans-serif;z-index:9999;animation:fadeIn .3s;' +
            (error ? 'background:#fee2e2;color:#991b1b;' : 'background:#dcfce7;color:#166534;');
        document.body.appendChild(t);
        setTimeout(function(){ t.remove(); }, 3000);
    }
})();
</script>
<?php endif; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\hero\index.blade.php ENDPATH**/ ?>