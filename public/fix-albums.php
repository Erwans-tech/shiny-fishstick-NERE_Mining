<?php
// Script de correction - À supprimer après utilisation
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/html; charset=utf-8');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    
    if ($_POST['action'] === 'publish_all_media') {
        // Publier tous les médias dans des albums
        $updated = \DB::table('media_assets')
            ->whereNotNull('album_id')
            ->update(['is_published' => true]);
        
        echo "<div style='background:#e8f5e9;color:#2e7d32;padding:15px;margin:15px 0;border-radius:5px;'>";
        echo "✅ {$updated} média(s) publié(s) !";
        echo "</div>";
    }
    
    if ($_POST['action'] === 'publish_all_albums') {
        // Publier tous les albums
        $updated = \DB::table('photo_albums')->update(['is_published' => true]);
        
        echo "<div style='background:#e8f5e9;color:#2e7d32;padding:15px;margin:15px 0;border-radius:5px;'>";
        echo "✅ {$updated} album(s) publié(s) !";
        echo "</div>";
    }
    
    if ($_POST['action'] === 'fix_image_type') {
        // S'assurer que tous les médias dans des albums sont de type "image"
        $updated = \DB::table('media_assets')
            ->whereNotNull('album_id')
            ->where('type', '!=', 'image')
            ->update(['type' => 'image']);
        
        echo "<div style='background:#e8f5e9;color:#2e7d32;padding:15px;margin:15px 0;border-radius:5px;'>";
        echo "✅ {$updated} média(s) corrigé(s) en type 'image' !";
        echo "</div>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Corriger Albums</title>
    <style>
        body { font-family: Arial; padding: 20px; max-width: 1200px; margin: 0 auto; }
        .section { background: #f5f5f5; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .error { background: #ffebee; color: #c62828; }
        .success { background: #e8f5e9; color: #2e7d32; }
        .warning { background: #fff3e0; color: #ef6c00; }
        .info { background: #e3f2fd; color: #1565c0; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #333; color: white; }
        .btn { 
            background: #4caf50; 
            color: white; 
            padding: 12px 24px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
        }
        .btn:hover { background: #45a049; }
        .btn-danger { background: #f44336; }
        .btn-danger:hover { background: #da190b; }
        form { display: inline-block; margin: 5px; }
    </style>
</head>
<body>
    <h1>🛠️ Correction des Albums</h1>

    <?php
    // Diagnostic rapide
    $albums = \DB::table('photo_albums')->get();
    $mediaInAlbums = \DB::table('media_assets')->whereNotNull('album_id')->get();
    $publishedMedia = \DB::table('media_assets')->whereNotNull('album_id')->where('is_published', true)->count();
    $unpublishedMedia = $mediaInAlbums->count() - $publishedMedia;
    $publishedAlbums = \DB::table('photo_albums')->where('is_published', true)->count();
    $unpublishedAlbums = $albums->count() - $publishedAlbums;
    $wrongType = \DB::table('media_assets')->whereNotNull('album_id')->where('type', '!=', 'image')->count();
    ?>

    <div class="section info">
        <h2>📊 État actuel</h2>
        <table>
            <tr>
                <td><strong>Albums totaux</strong></td>
                <td><?= $albums->count() ?></td>
            </tr>
            <tr>
                <td><strong>Albums publiés</strong></td>
                <td><?= $publishedAlbums ?> / <?= $albums->count() ?></td>
            </tr>
            <tr>
                <td><strong>Albums non publiés</strong></td>
                <td class="<?= $unpublishedAlbums > 0 ? 'warning' : '' ?>"><?= $unpublishedAlbums ?></td>
            </tr>
            <tr>
                <td><strong>Médias dans albums</strong></td>
                <td><?= $mediaInAlbums->count() ?></td>
            </tr>
            <tr>
                <td><strong>Médias publiés</strong></td>
                <td><?= $publishedMedia ?> / <?= $mediaInAlbums->count() ?></td>
            </tr>
            <tr>
                <td><strong>Médias non publiés</strong></td>
                <td class="<?= $unpublishedMedia > 0 ? 'error' : '' ?>"><?= $unpublishedMedia ?></td>
            </tr>
            <tr>
                <td><strong>Médias de type incorrect</strong></td>
                <td class="<?= $wrongType > 0 ? 'error' : '' ?>"><?= $wrongType ?></td>
            </tr>
        </table>
    </div>

    <?php if ($unpublishedMedia > 0 || $unpublishedAlbums > 0 || $wrongType > 0): ?>
    <div class="section error">
        <h2>⚠️ Problèmes détectés</h2>
        <ul>
            <?php if ($unpublishedAlbums > 0): ?>
            <li><strong><?= $unpublishedAlbums ?> album(s) non publié(s)</strong> - Ils n'apparaîtront pas sur le site</li>
            <?php endif; ?>
            
            <?php if ($unpublishedMedia > 0): ?>
            <li><strong><?= $unpublishedMedia ?> média(s) non publié(s)</strong> - Ils n'apparaîtront pas dans les albums</li>
            <?php endif; ?>
            
            <?php if ($wrongType > 0): ?>
            <li><strong><?= $wrongType ?> média(s) avec type incorrect</strong> - Ne seront pas chargés (doivent être type 'image')</li>
            <?php endif; ?>
        </ul>

        <h3>🔧 Actions de correction :</h3>
        
        <?php if ($unpublishedMedia > 0): ?>
        <form method="POST">
            <input type="hidden" name="action" value="publish_all_media">
            <button type="submit" class="btn" onclick="return confirm('Publier tous les <?= $unpublishedMedia ?> média(s) dans des albums ?')">
                ✅ Publier tous les médias (<?= $unpublishedMedia ?>)
            </button>
        </form>
        <?php endif; ?>
        
        <?php if ($unpublishedAlbums > 0): ?>
        <form method="POST">
            <input type="hidden" name="action" value="publish_all_albums">
            <button type="submit" class="btn" onclick="return confirm('Publier tous les <?= $unpublishedAlbums ?> album(s) ?')">
                ✅ Publier tous les albums (<?= $unpublishedAlbums ?>)
            </button>
        </form>
        <?php endif; ?>
        
        <?php if ($wrongType > 0): ?>
        <form method="POST">
            <input type="hidden" name="action" value="fix_image_type">
            <button type="submit" class="btn" onclick="return confirm('Corriger le type de <?= $wrongType ?> média(s) en \'image\' ?')">
                🔧 Corriger le type (<?= $wrongType ?>)
            </button>
        </form>
        <?php endif; ?>
    </div>
    <?php else: ?>
    <div class="section success">
        <h2>✅ Tout est correct !</h2>
        <p>Tous les albums et médias sont publiés et correctement configurés.</p>
    </div>
    <?php endif; ?>

    <div class="section">
        <h2>📋 Détail des albums</h2>
        <?php foreach ($albums as $album): ?>
            <?php 
            $albumMedia = \DB::table('media_assets')
                ->where('album_id', $album->id)
                ->get();
            $albumPublishedMedia = $albumMedia->where('is_published', true)->count();
            ?>
            <div style="border:1px solid #ddd;padding:10px;margin:10px 0;background:white;">
                <h3>
                    <?= $album->is_published ? '✅' : '❌' ?>
                    <?= $album->title ?>
                </h3>
                <p>
                    <strong>ID:</strong> <?= $album->id ?> | 
                    <strong>Publié:</strong> <?= $album->is_published ? 'Oui' : 'Non' ?> | 
                    <strong>Médias:</strong> <?= $albumMedia->count() ?> (<?= $albumPublishedMedia ?> publiés)
                </p>
                
                <?php if ($albumMedia->isEmpty()): ?>
                <p class="warning">⚠️ Aucune image dans cet album</p>
                <?php else: ?>
                <table>
                    <tr><th>ID</th><th>Titre</th><th>Type</th><th>Publié</th><th>Fichier</th></tr>
                    <?php foreach ($albumMedia as $media): ?>
                    <tr style="<?= !$media->is_published ? 'background:#ffebee;' : '' ?>">
                        <td><?= $media->id ?></td>
                        <td><?= $media->title ?></td>
                        <td><?= $media->type ?></td>
                        <td><?= $media->is_published ? '✅' : '❌' ?></td>
                        <td><small><?= $media->file_path ?></small></td>
                    </tr>
                    <?php endforeach; ?>
                </table>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <hr>
    <p><a href="/debug-albums.php">🔍 Voir le diagnostic complet</a></p>
    <p><a href="/mediatheque">🏠 Retour à la médiathèque</a></p>
    <p style="color:#999;font-size:12px;">⚠️ Supprimer ce fichier après utilisation pour des raisons de sécurité</p>
</body>
</html>
