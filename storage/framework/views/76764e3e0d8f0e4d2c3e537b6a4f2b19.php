<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouveau message de contact - Néré Mining</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f8f9fa;
        }
        .email-container {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            overflow: hidden;
        }
        .header {
            background: linear-gradient(135deg, #4b1716 0%, #d72f2f 100%);
            color: white;
            padding: 30px 20px;
            text-align: center;
        }
        .header h1 {
            margin: 0;
            font-size: 24px;
            font-weight: 600;
        }
        .header .subtitle {
            margin: 8px 0 0 0;
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 30px 20px;
        }
        .field-group {
            margin-bottom: 20px;
            padding: 15px;
            background-color: #f8f9fa;
            border-radius: 6px;
            border-left: 4px solid #ffc247;
        }
        .field-label {
            font-weight: 600;
            color: #4b1716;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 5px;
        }
        .field-value {
            font-size: 16px;
            color: #333;
        }
        .message-content {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 20px;
            margin-top: 10px;
            white-space: pre-wrap;
            line-height: 1.7;
        }
        .footer {
            background-color: #f1f3f4;
            padding: 20px;
            text-align: center;
            border-top: 1px solid #e9ecef;
        }
        .footer p {
            margin: 0;
            font-size: 12px;
            color: #6c757d;
        }
        .reply-info {
            background-color: #e8f4fd;
            border: 1px solid #b8e0ff;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        .reply-info strong {
            color: #0056b3;
        }
        .admin-link {
            display: inline-block;
            background-color: #4b1716;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: 500;
            margin-top: 15px;
        }
        .admin-link:hover {
            background-color: #3a100f;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>📧 Nouveau message de contact</h1>
            <p class="subtitle">Message reçu sur le site Néré Mining</p>
        </div>
        
        <div class="content">
            <div class="field-group">
                <div class="field-label">Nom du contact</div>
                <div class="field-value"><?php echo e($contactMessage->name); ?></div>
            </div>
            
            <div class="field-group">
                <div class="field-label">Adresse e-mail</div>
                <div class="field-value">
                    <a href="mailto:<?php echo e($contactMessage->email); ?>" style="color: #d72f2f; text-decoration: none;">
                        <?php echo e($contactMessage->email); ?>

                    </a>
                </div>
            </div>
            
            <?php if($contactMessage->subject): ?>
            <div class="field-group">
                <div class="field-label">Sujet</div>
                <div class="field-value"><?php echo e($contactMessage->subject); ?></div>
            </div>
            <?php endif; ?>
            
            <div class="field-group">
                <div class="field-label">Type de demande</div>
                <div class="field-value"><?php echo e($contactMessage->type); ?></div>
            </div>
            
            <div class="field-group">
                <div class="field-label">Date de réception</div>
                <div class="field-value"><?php echo e($contactMessage->created_at->format('d/m/Y à H:i')); ?></div>
            </div>
            
            <div class="field-group">
                <div class="field-label">Message</div>
                <div class="message-content"><?php echo e($contactMessage->message); ?></div>
            </div>
            
            <div class="reply-info">
                <strong>💡 Pour répondre :</strong> Répondez directement à cet e-mail, votre réponse sera envoyée à <?php echo e($contactMessage->name); ?> (<?php echo e($contactMessage->email); ?>).
            </div>
            
            <div style="text-align: center;">
                <a href="<?php echo e(config('app.url')); ?>/admin/messages/<?php echo e($contactMessage->id); ?>" class="admin-link">
                    👁️ Voir dans l'admin
                </a>
            </div>
        </div>
        
        <div class="footer">
            <p>
                <strong>Néré Mining</strong><br>
                Notification automatique - Ne pas répondre à cette adresse<br>
                Généré le <?php echo e(now()->format('d/m/Y à H:i')); ?>

            </p>
        </div>
    </div>
</body>
</html><?php /**PATH C:\Users\erwan\OneDrive\Bureau\REFONTESITE\resources\views/emails/contact-message-notification.blade.php ENDPATH**/ ?>