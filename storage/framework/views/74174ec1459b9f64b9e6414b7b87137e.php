<?php $__env->startSection('title','Message de '.$message->name); ?>
<?php $__env->startSection('page-title','Détail du message'); ?>

<?php $__env->startSection('content'); ?>
<div class="card">
    <div class="card-header">
        <h2>Message de <?php echo e($message->name); ?></h2>
        <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-ghost btn-sm">← Retour</a>
    </div>
    <div class="card-body">
        
        <form method="POST" action="<?php echo e(route('admin.messages.updateStatus', $message)); ?>" style="margin-bottom:24px; padding:16px; background:#f9f7f4; border-radius:6px;">
            <?php echo csrf_field(); ?> <?php echo method_field('PATCH'); ?>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:16px; margin-bottom:12px;">
                <div class="form-group">
                    <label for="status">Statut du message</label>
                    <select name="status" id="status" style="width:100%; padding:8px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif;">
                        <option value="new" <?php echo e($message->status === 'new' ? 'selected' : ''); ?>>Nouveau</option>
                        <option value="reviewing" <?php echo e($message->status === 'reviewing' ? 'selected' : ''); ?>>En examen</option>
                        <option value="replied" <?php echo e($message->status === 'replied' ? 'selected' : ''); ?>>Répondu</option>
                        <option value="archived" <?php echo e($message->status === 'archived' ? 'selected' : ''); ?>>Archivé</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary" style="align-self:flex-end;">Mettre à jour statut</button>
            </div>
            <div class="form-group">
                <label for="admin_notes">Notes internes (non visible par le client)</label>
                <textarea name="admin_notes" id="admin_notes" placeholder="Ajouter des notes..." 
                          style="width:100%; min-height:80px; padding:10px 12px; border:1px solid var(--line); border-radius:4px; font:13px Inter,sans-serif; resize:vertical;"><?php echo e($message->admin_notes); ?></textarea>
            </div>
        </form>

        <div class="form-grid">
            <div class="form-group">
                <label>Expéditeur</label>
                <div style="padding:10px 0;font-size:15px;"><?php echo e($message->name); ?></div>
            </div>
            <div class="form-group">
                <label>E-mail</label>
                <div style="padding:10px 0;font-size:15px;">
                    <a href="mailto:<?php echo e($message->email); ?>" style="color:var(--green);"><?php echo e($message->email); ?></a>
                </div>
            </div>
            <div class="form-group">
                <label>Type de demande</label>
                <div style="padding:10px 0;"><span class="badge badge-gray"><?php echo e($message->type); ?></span></div>
            </div>
            <div class="form-group">
                <label>Date de réception</label>
                <div style="padding:10px 0;color:var(--muted);font-size:14px;"><?php echo e($message->created_at->format('d/m/Y à H:i')); ?></div>
            </div>
            <?php if($message->subject): ?>
            <div class="form-group full">
                <label>Objet</label>
                <div style="padding:10px 0;font-size:15px;font-weight:600;"><?php echo e($message->subject); ?></div>
            </div>
            <?php endif; ?>
            <div class="form-group full">
                <label>Message</label>
                <div style="background:#f9f7f4;border:1px solid var(--line);border-radius:6px;padding:16px 18px;font-size:15px;line-height:1.7;white-space:pre-wrap;"><?php echo e($message->message); ?></div>
            </div>
        </div>
        <div class="form-actions" style="margin-top:20px;">
            <?php
                $messageType = strtolower((string) $message->type);
                $messageTemplateKey = str_contains($messageType, 'press')
                    ? 'press'
                    : (str_contains($messageType, 'fourn') || str_contains($messageType, 'supplier')
                        ? 'supplier'
                        : (str_contains($messageType, 'commu') || str_contains($messageType, 'community')
                            ? 'community'
                            : 'general'));
                $messageTemplates = [
                    'general' => [
                        'label' => 'Réponse générale',
                        'subject' => 'RE: '.($message->subject ?: 'Votre demande'),
                        'body' => "Bonjour :first_name,\n\nNous vous remercions pour votre message. Nous avons bien pris en compte votre demande et reviendrons vers vous dans les meilleurs délais.\n\nCordialement,\nL'équipe Néré Mining",
                    ],
                    'press' => [
                        'label' => 'Demande presse',
                        'subject' => 'RE: Votre demande presse',
                        'body' => "Bonjour :first_name,\n\nNous vous remercions pour votre intérêt pour Néré Mining. Votre demande presse a bien été transmise à notre équipe communication, qui reviendra vers vous prochainement.\n\nCordialement,\nL'équipe Communication Néré Mining",
                    ],
                    'supplier' => [
                        'label' => 'Demande fournisseur',
                        'subject' => 'RE: Votre demande fournisseur',
                        'body' => "Bonjour :first_name,\n\nNous accusons réception de votre proposition. Elle sera examinée par l'équipe concernée, qui vous recontactera si elle correspond à nos besoins.\n\nCordialement,\nL'équipe Néré Mining",
                    ],
                    'community' => [
                        'label' => 'Demande communauté',
                        'subject' => 'RE: Votre demande',
                        'body' => "Bonjour :first_name,\n\nNous vous remercions pour votre message. Votre demande a été transmise à notre équipe en charge des relations avec les communautés locales. Nous reviendrons vers vous après examen.\n\nCordialement,\nL'équipe Néré Mining",
                    ],
                ];
            ?>
            <div class="form-group full" style="width:100%;margin-bottom:14px;">
                <label for="message-template">Réponse pré-enregistrée</label>
                <select id="message-template" style="width:100%;margin-top:6px;">
                    <?php $__currentLoopData = $messageTemplates; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $template): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($key); ?>" <?php echo e($messageTemplateKey === $key ? 'selected' : ''); ?>><?php echo e($template['label']); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <textarea id="message-reply" style="width:100%;min-height:170px;margin-bottom:14px;border:1px solid var(--line);border-radius:6px;padding:12px;font:14px/1.6 Inter,sans-serif;resize:vertical;"></textarea>
            <a id="message-mail-link" href="#" class="btn btn-primary">
                Préparer l'e-mail
            </a>
            <form method="POST" action="<?php echo e(route('admin.messages.destroy', $message)); ?>" style="display:inline;" onsubmit="return confirm('Supprimer ce message ?')">
                <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
            <a href="<?php echo e(route('admin.messages.index')); ?>" class="btn btn-ghost">← Retour</a>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script>
    (() => {
        const templates = <?php echo json_encode($messageTemplates, 15, 512) ?>;
        const firstName = <?php echo json_encode(strtok(trim($message->name), ' '), 512) ?>;
        const recipient = <?php echo json_encode($message->email, 15, 512) ?>;
        const selector = document.getElementById('message-template');
        const reply = document.getElementById('message-reply');
        const link = document.getElementById('message-mail-link');

        const refreshMailto = () => {
            const template = templates[selector.value];
            const body = reply.value.replaceAll(':first_name', firstName);
            link.href = `mailto:${recipient}?subject=${encodeURIComponent(template.subject)}&body=${encodeURIComponent(body)}`;
        };

        const selectTemplate = () => {
            reply.value = templates[selector.value].body;
            refreshMailto();
        };

        selector.addEventListener('change', selectTemplate);
        reply.addEventListener('input', refreshMailto);
        selectTemplate();
    })();
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('admin.partials.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views\admin\messages\show.blade.php ENDPATH**/ ?>