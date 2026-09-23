NOUVEAU MESSAGE DE CONTACT - NÉRÉ MINING
========================================

Message reçu sur le site web le <?php echo e($contactMessage->created_at->format('d/m/Y à H:i')); ?>


INFORMATIONS DU CONTACT :
-------------------------
Nom : <?php echo e($contactMessage->name); ?>

E-mail : <?php echo e($contactMessage->email); ?>

<?php if($contactMessage->subject): ?>
Sujet : <?php echo e($contactMessage->subject); ?>

<?php endif; ?>
Type de demande : <?php echo e($contactMessage->type); ?>


MESSAGE :
---------
<?php echo e($contactMessage->message); ?>


ACTIONS :
---------
• Répondre : Répondez directement à cet e-mail
• Consulter dans l'admin : <?php echo e(config('app.url')); ?>/admin/messages/<?php echo e($contactMessage->id); ?>


---
Néré Mining - Notification automatique
Généré le <?php echo e(now()->format('d/m/Y à H:i')); ?><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/emails/contact-message-notification-text.blade.php ENDPATH**/ ?>