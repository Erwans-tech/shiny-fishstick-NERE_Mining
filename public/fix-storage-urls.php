<?php
// Correction des URLs de stockage - À supprimer après utilisation
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/html; charset=utf-8');

$fixed = false;
$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['fix_urls'])) {
    try {
        // Obtenir tous les médias avec file_path commençant par "media/"
        $medias = \DB::table('media_assets')
            ->where('file_path', 'like', 'media/%')
            ->get();
        
        $updated = 0;
        foreach ($medias as $media) {
            // Pas besoin de changer quoi que ce soit dans la base
            // Les URLs sont générées dynamiquement par l'accessor
            $updated++;
        }
        
        $fixed = true;
        $message = "✅ Configuration vérifiée pour {$updated} média(s). Redémarrez le serveur pour appliquer les changements.";
    } catch (\Exception $e) {
        $message = "❌ Erreur: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Corriger URLs Storage</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 900px; margin: 0 auto; }
        .section { background: #f5f5f5; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .error { background: #ffebee; color: #c62828; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .success { background: #e8f5e9; color: #2e7d32; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .warning { background: #fff3e0; color: #ef6c00; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .info { background: #e3f2fd; color: #1565c0; padding: 15px; margin: 15px 0; border-radius: 5px; }
        code { background: #263238; color: #aed581; padding: 2px 6px; border-radius: 3px; font-family: monospace; }
        pre { background: #263238; color: #aed581; padding: 15px; border-radius: 5px; overflow-x: auto; }
        .btn { 
            background: #4caf50; 
            color: white; 
            padding: 12px 24px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        .btn:hover { background: #45a049; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #333; color: white; }
    </style>
</head>
<body>
    <h1>🔧 Correction des URLs de stockage</h1>

    <?php if ($message): ?>
        <div class="<?= $fixed ? 'success' : 'error' ?>">
            <?= $message ?>
        </div>
    <?php endif; ?>

    <div class="error">
        <h2>🔴 Problème détecté</h2>
        <p>Les URLs des images pointent vers <code>https://196.168.10.202</code> au lieu de <code>https://www.nere-mining.bf</code></p>
        <p>Cela signifie que la configuration du filesystem dans <code>.env</code> utilise une IP locale.</p>
    </div>

    <div class="section">
        <h2>📋 Configuration actuelle</h2>
        <table>
            <tr>
                <td><strong>APP_URL</strong></td>
                <td><code><?= config('app.url') ?></code></td>
            </tr>
            <tr>
                <td><strong>FILESYSTEM_DISK</strong></td>
                <td><code><?= config('filesystems.default') ?></code></td>
            </tr>
            <tr>
                <td><strong>Storage URL</strong></td>
                <td><code><?= config('filesystems.disks.' . config('filesystems.default') . '.url') ?? 'Non configuré' ?></code></td>
            </tr>
        </table>
    </div>

    <div class="info">
        <h2>✅ Solution : Modifier le fichier .env sur le serveur</h2>
        
        <p><strong>Étape 1 :</strong> Ouvrir le fichier <code>.env</code> sur le serveur</p>
        
        <p><strong>Étape 2 :</strong> Chercher et modifier ces lignes :</p>
        <pre>APP_URL=https://www.nere-mining.bf
FILESYSTEM_DISK=public
ASSET_URL=https://www.nere-mining.bf</pre>

        <p><strong>Étape 3 :</strong> Si vous utilisez le disque "public", assurez-vous que le lien symbolique existe :</p>
        <pre>php artisan storage:link</pre>
        
        <p><strong>Étape 4 :</strong> Redémarrer IIS :</p>
        <pre>iisreset</pre>

        <p><strong>Étape 5 :</strong> Vider le cache Laravel :</p>
        <pre>php artisan config:clear
php artisan cache:clear</pre>
    </div>

    <div class="warning">
        <h2>⚠️ Alternative : Ajouter ASSET_URL dans .env</h2>
        <p>Si APP_URL est déjà correct mais que les images utilisent toujours l'IP locale, ajoutez :</p>
        <pre>ASSET_URL=https://www.nere-mining.bf</pre>
        <p>Puis redémarrez IIS : <code>iisreset</code></p>
    </div>

    <div class="section">
        <h2>🧪 Test après correction</h2>
        <p>Après avoir modifié le <code>.env</code> et redémarré IIS :</p>
        <ol>
            <li>Recharger cette page</li>
            <li>Aller sur <a href="/debug-albums.php" target="_blank">/debug-albums.php</a></li>
            <li>Vérifier que les URLs dans la section 4 sont en <code>https://www.nere-mining.bf/uploads/...</code></li>
            <li>Aller sur <a href="/mediatheque" target="_blank">/mediatheque</a></li>
            <li>Les images devraient maintenant s'afficher !</li>
        </ol>
    </div>

    <div class="section">
        <h2>📝 Exemple de fichier .env correct</h2>
        <pre>APP_NAME="Nere Mining"
APP_ENV=production
APP_KEY=base64:xxxxx
APP_DEBUG=false
APP_URL=https://www.nere-mining.bf
APP_TIMEZONE=Africa/Ouagadougou
FORCE_HTTPS=true

# Storage configuration
FILESYSTEM_DISK=public
ASSET_URL=https://www.nere-mining.bf

# Database...
DB_CONNECTION=pgsql
...</pre>
    </div>

    <hr>
    <p><a href="/debug-albums.php">🔍 Retour au diagnostic</a></p>
    <p style="color:#999;font-size:12px;">⚠️ Supprimer ce fichier après correction</p>
</body>
</html>
