<?php $__env->startSection('title','Messages'); ?>
<?php $__env->startSection('page-title','Messages de contact'); ?>

<?php $__env->startSection('content'); ?>
<form method="GET" action="<?php echo e(route('admin.messages.index')); ?>"
      style="display:flex;gap:12px;flex-wrap:wrap;margin-bottom:20px;align-items:center;">
    <input type="search" name="q" value="<?php echo e(request('q')); ?>" placeholder="Rechercher un message..." aria-label="Rechercher un message"
           style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;min-width:240px;">
    <select name="read" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Tous les messages</option>
        <option value="unread" <?php echo e(request('read') === 'unread' ? 'selected' : ''); ?>>Non lus</option>
        <option value="read" <?php echo e(request('read') === 'read' ? 'selected' : ''); ?>>Lus</option>
    </select>
    <select name="status" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="">Tous les statuts</option>
        <option value="new" <?php echo e(request('status') === 'new' ? 'selected' : ''); ?>>Nouveau</option>
        <option value="reviewing" <?php echo e(request('status') === 'reviewing' ? 'selected' : ''); ?>>En examen</option>
        <option value="replied" <?php echo e(request('status') === 'replied' ? 'selected' : ''); ?>>Répondu</option>
        <option value="archived" <?php echo e(request('status') === 'archived' ? 'selected' : ''); ?>>Archivé</option>
    </select>
    <select name="sort" style="padding:9px 14px;border:1px solid var(--line);border-radius:6px;font:500 13px Inter,sans-serif;" onchange="this.form.submit()">
        <option value="recent" <?php echo e(request('sort', 'recent') === 'recent' ? 'selected' : ''); ?>>Plus récents</option>
        <option value="oldest" <?php echo e(request('sort') === 'oldest' ? 'selected' : ''); ?>>Plus anciens</option>
    </select>
    <button type="submit" class="btn btn-primary btn-sm">Rechercher</button>
    <?php if(request()->hasAny(['q', 'read', 'sort', 'status'])): ?>
    <a href="<?php echo e(route('admin.messages.index')); ?>" style="font:500 12px Inter,sans-serif;color:var(--red);">✕ Réinitialiser</a>
    <?php endif; ?>
    <span style="margin-left:auto;font:600 13px Inter,sans-serif;color:var(--muted);"><?php echo e($messages->total()); ?> message(s)</span>
</form>
<div class="card">
    <div class="card-header">
        <h2>Messages (<?php echo e($messages->total()); ?>)</h2>
        <?php $unread = $messages->getCollection()->whereNull('read_at')->count(); ?>
        <?php if($unread > 0): ?><span class="badge badge-red"><?php echo e($unread); ?> non lu(s)</span><?php endif; ?>
    </div>
    <div class="table-wrap">
        <table>
            <thead><tr><th>Nom</th><th>E-mail</th><th>Type</th><th>Objet</th><th>Date</th><th>Statut</th><th>Action</th></tr></thead>
            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <tr style="<?php echo e($m->read_at ? '' : 'font-weight:600;'); ?>">
                <td><?php echo e($m->name); ?></td>
                <td class="td-muted"><?php echo e($m->email); ?></td>
                <td><span class="badge badge-gray"><?php echo e($m->type); ?></span></td>
                <td class="td-muted"><?php echo e(Str::limit($m->subject, 35)); ?></td>
                <td class="td-muted"><?php echo e($m->created_at->format('d/m/Y H:i')); ?></td>
                <td>
                    <?php
                        $statusLabels = ['new' => 'Nouveau', 'reviewing' => 'Examen', 'replied' => 'Répondu', 'archived' => 'Archivé'];
                        $statusColors = ['new' => 'badge-orange', 'reviewing' => 'badge-blue', 'replied' => 'badge-green', 'archived' => 'badge-gray'];
                    ?>
                    <span class="badge <?php echo e($statusColors[$m->status] ?? 'badge-gray'); ?>"><?php echo e($statusLabels[$m->status] ?? $m->status); ?></span>
                </td>
                <td>
                    <a href="<?php echo e(route('admin.messages.show', $m)); ?>" class="btn btn-ghost btn-sm">Voir</a>
                    <form method="POST" action="<?php echo e(route('admin.messages.destroy', $m)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ?')">
                        <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-danger btn-sm">✕</button>
                    </form>
                </td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <tr><td colspan="7" style="text-align:center;padding:40px;color:var(--muted);">Aucun message.</td></tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>
    <?php if($messages->hasPages()): ?><div class="card-body"><?php echo e($messages->links()); ?></div><?php endif; ?>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\messages\index.blade.php ENDPATH**/ ?>