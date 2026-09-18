<?php
// Test simple pour vérifier la configuration PHP upload
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Test Upload Configuration</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .info { background: #e3f2fd; padding: 15px; margin: 10px 0; border-left: 4px solid #2196f3; }
        .error { background: #ffebee; padding: 15px; margin: 10px 0; border-left: 4px solid #f44336; }
        .success { background: #e8f5e9; padding: 15px; margin: 10px 0; border-left: 4px solid #4caf50; }
        table { border-collapse: collapse; margin: 20px 0; }
        td { padding: 8px; border: 1px solid #ddd; }
        td:first-child { font-weight: bold; background: #f5f5f5; }
    </style>
</head>
<body>
    <h1>🔍 Test Configuration Upload PHP</h1>
    
    <div class="info">
        <strong>Configuration actuelle :</strong>
        <table>
            <tr>
                <td>upload_max_filesize</td>
                <td><?= ini_get('upload_max_filesize') ?></td>
            </tr>
            <tr>
                <td>post_max_size</td>
                <td><?= ini_get('post_max_size') ?></td>
            </tr>
            <tr>
                <td>max_execution_time</td>
                <td><?= ini_get('max_execution_time') ?> secondes</td>
            </tr>
            <tr>
                <td>max_input_time</td>
                <td><?= ini_get('max_input_time') ?> secondes</td>
            </tr>
            <tr>
                <td>memory_limit</td>
                <td><?= ini_get('memory_limit') ?></td>
            </tr>
            <tr>
                <td>max_file_uploads</td>
                <td><?= ini_get('max_file_uploads') ?> fichiers</td>
            </tr>
            <tr>
                <td>max_input_vars</td>
                <td><?= ini_get('max_input_vars') ?></td>
            </tr>
        </table>
    </div>

    <div class="<?= ini_get('upload_max_filesize') == '512M' ? 'success' : 'error' ?>">
        <?php if (ini_get('upload_max_filesize') == '512M'): ?>
            ✅ La configuration .user.ini ou .htaccess est bien appliquée
        <?php else: ?>
            ❌ La configuration PHP n'est pas encore mise à jour
        <?php endif; ?>
    </div>

    <div class="info">
        <strong>Version PHP :</strong> <?= phpversion() ?><br>
        <strong>SAPI :</strong> <?= php_sapi_name() ?><br>
        <strong>Fichier php.ini :</strong> <?= php_ini_loaded_file() ?>
    </div>

    <div class="info">
        <strong>Recommandations pour IIS :</strong>
        <ol>
            <li>Modifier le php.ini principal (dans C:\Program Files\PHP\ ou similaire)</li>
            <li>Ou configurer dans IIS Manager → PHP Manager → Manage All Settings</li>
            <li>Redémarrer IIS après modifications : <code>iisreset</code></li>
        </ol>
    </div>

    <hr>
    <p><a href="/gestion-nm/media">← Retour à l'admin</a></p>
</body>
</html>
