<?php $__env->startSection('title', 'Candidatures'); ?>
<?php $__env->startSection('page-title', 'Candidatures reçues'); ?>

<?php $__env->startSection('content'); ?>

<form method="GET" action="<?php echo e(route('admin.applications.index')); ?>"
      style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Nom, e-mail, téléphone..." aria-label="Rechercher une candidature"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:240px;">
    <select name="job" class="filter-select" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:200px;" onchange="this.form.submit()">
        <option value="">Toutes les offres</option>
        <?php $__currentLoopData = $jobs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $j): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($j->id); ?>" <?php echo e(request('job') == $j->id ? 'selected' : ''); ?>><?php echo e($j->title); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <select name="status" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <?php $__currentLoopData = $statuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <option value="<?php echo e($key); ?>" <?php echo e(request('status') === $key ? 'selected' : ''); ?>><?php echo e($s['label']); ?></option>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </select>
    <select name="read" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Lues et non lues</option>
        <option value="unread" <?php echo e(request('read') === 'unread' ? 'selected' : ''); ?>>Non lues</option>
        <option value="read" <?php echo e(request('read') === 'read' ? 'selected' : ''); ?>>Lues</option>
    </select>
    <select name="sort" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="recent" <?php echo e(request('sort', 'recent') === 'recent' ? 'selected' : ''); ?>>Plus récentes</option>
        <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>Plus anciennes</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request()->hasAny(['q','job','status','read','sort'])): ?>
    <a href="<?php echo e(route('admin.applications.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>
    <?php endif; ?>
    <span style="margin-left:auto;font:600 13px Inter,sans-serif;color:var(--muted);">
        <?php echo e($applications->total()); ?> candidature(s)
    </span>
</form>

<div class="card">
    <div class="card-header">
        <h2>Candidatures (<?php echo e($applications->total()); ?>)</h2>
    </div>
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th>Candidat</th>
                    <th>Poste</th>
                    <th>Expérience</th>
                    <th>Statut</th>
                    <th>Reçue le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $applications; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $app): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr style="<?php echo e(!$app->read_at ? 'font-weight:600;' : ''); ?>">
                <td>
                    <div style="font-weight:600;"><?php echo e($app->full_name); ?></div>
                    <div style="font:12px Inter,sans-serif;color:var(--muted);"><?php echo e($app->email); ?></div>
                </td>
                <td class="td-muted"><?php echo e($app->jobOffer?->title ?? '—'); ?></td>
                <td class="td-muted"><?php echo e($app->experience_years ?? '—'); ?></td>
                <td>
                    <?php $s = $statuses[$app->status] ?? ['label'=>$app->status,'badge'=>'badge-gray']; ?>
                    <span class="badge <?php echo e($s['badge']); ?>"><?php echo e($s['label']); ?></span>
                    <?php if(!$app->read_at): ?><span class="badge badge-yellow" style="margin-left:4px;font-size:9px;">Nouveau</span><?php endif; ?>
                </td>
                <td class="td-muted"><?php echo e($app->created_at->format('d/m/Y H:i')); ?></td>
                <td>
                    <a href="<?php echo e(route('admin.applications.show', $app)); ?>" class="btn btn-ghost btn-sm">Voir</a>
                    <form method="POST" action="<?php echo e(route('admin.applications.destroy', $app)); ?>"
                          style="display:inline;" onsubmit="return confirm('Supprimer cette candidature ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">✕</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="6" style="text-align:center;padding:40px;color:var(--muted);">Aucune candidature.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($applications->hasPages()): ?>
    <div class="card-body"><?php echo e($applications->links()); ?></div>
    <?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\applications\index.blade.php ENDPATH**/ ?>