<?php
// Debug albums - À supprimer après diagnostic
require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Debug Albums</title>
    <style>
        body { font-family: Arial; padding: 20px; }
        .section { background: #f5f5f5; padding: 15px; margin: 15px 0; border-radius: 5px; }
        .error { background: #ffebee; color: #c62828; }
        .success { background: #e8f5e9; color: #2e7d32; }
        .warning { background: #fff3e0; color: #ef6c00; }
        table { border-collapse: collapse; width: 100%; margin: 10px 0; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background: #333; color: white; }
        img { max-width: 100px; max-height: 100px; }
        pre { background: #263238; color: #aed581; padding: 10px; overflow-x: auto; }
    </style>
</head>
<body>
    <h1>🔍 Diagnostic Albums Photo</h1>

    <?php
    try {
        // 1. Vérifier si la table existe
        echo '<div class="section">';
        echo '<h2>1. Table photo_albums</h2>';
        try {
            $tableExists = \DB::select("SELECT EXISTS (
                SELECT FROM information_schema.tables 
                WHERE table_schema = 'public' 
                AND table_name = 'photo_albums'
            )");
            
            if ($tableExists[0]->exists) {
                echo '<p class="success">✅ Table photo_albums existe</p>';
                
                // Compter les albums
                $albumCount = \DB::table('photo_albums')->count();
                echo "<p>Nombre d'albums: <strong>{$albumCount}</strong></p>";
                
            } else {
                echo '<p class="error">❌ Table photo_albums n\'existe pas</p>';
                echo '<p>Exécuter: <code>php artisan migrate</code></p>';
                exit;
            }
        } catch (\Exception $e) {
            echo '<p class="error">❌ Erreur: ' . $e->getMessage() . '</p>';
            exit;
        }
        echo '</div>';

        // 2. Liste des albums
        echo '<div class="section">';
        echo '<h2>2. Albums dans la base</h2>';
        $albums = \DB::table('photo_albums')->get();
        
        if ($albums->isEmpty()) {
            echo '<p class="warning">⚠️ Aucun album dans la base de données</p>';
        } else {
            echo '<table>';
            echo '<tr><th>ID</th><th>Titre</th><th>Publié</th><th>Sort Order</th><th>Créé le</th></tr>';
            foreach ($albums as $album) {
                $published = $album->is_published ? '✅' : '❌';
                echo "<tr>";
                echo "<td>{$album->id}</td>";
                echo "<td>{$album->title}</td>";
                echo "<td>{$published}</td>";
                echo "<td>{$album->sort_order}</td>";
                echo "<td>{$album->created_at}</td>";
                echo "</tr>";
            }
            echo '</table>';
        }
        echo '</div>';

        // 3. Médias dans les albums
        echo '<div class="section">';
        echo '<h2>3. Médias assignés aux albums</h2>';
        $mediaInAlbums = \DB::table('media_assets')
            ->whereNotNull('album_id')
            ->select('id', 'title', 'album_id', 'type', 'file_path', 'is_published')
            ->get();
        
        if ($mediaInAlbums->isEmpty()) {
            echo '<p class="error">❌ Aucune image assignée aux albums !</p>';
            echo '<p>➡️ Pour assigner des images :</p>';
            echo '<ol>';
            echo '<li>Aller dans <a href="/gestion-nm/media">/gestion-nm/media</a></li>';
            echo '<li>Cliquer sur "Modifier" une image</li>';
            echo '<li>Sélectionner un album dans le dropdown</li>';
            echo '<li>Sauvegarder</li>';
            echo '</ol>';
        } else {
            echo "<p class='success'>✅ {$mediaInAlbums->count()} média(s) dans des albums</p>";
            echo '<table>';
            echo '<tr><th>ID</th><th>Titre</th><th>Album ID</th><th>Type</th><th>Publié</th><th>Fichier</th><th>Aperçu</th></tr>';
            foreach ($mediaInAlbums as $media) {
                $published = $media->is_published ? '✅' : '❌';
                
                // Construire l'URL de l'image
                $url = '';
                if ($media->file_path) {
                    if (str_starts_with($media->file_path, 'images/')) {
                        $url = '/' . $media->file_path;
                    } else {
                        // Storage URL
                        $url = \Storage::disk(config('filesystems.default'))->url($media->file_path);
                    }
                }
                
                echo "<tr>";
                echo "<td>{$media->id}</td>";
                echo "<td>{$media->title}</td>";
                echo "<td>{$media->album_id}</td>";
                echo "<td>{$media->type}</td>";
                echo "<td>{$published}</td>";
                echo "<td><small>{$media->file_path}</small></td>";
                echo "<td>";
                if ($url) {
                    echo "<a href='{$url}' target='_blank'>";
                    echo "<img src='{$url}' alt='Preview' style='max-width:60px;max-height:60px;'>";
                    echo "</a>";
                } else {
                    echo "-";
                }
                echo "</td>";
                echo "</tr>";
            }
            echo '</table>';
        }
        echo '</div>';

        // 4. Test avec Eloquent
        echo '<div class="section">';
        echo '<h2>4. Test avec Eloquent (comme dans le code)</h2>';
        try {
            $eloquentAlbums = \App\Models\PhotoAlbum::published()
                ->with(['media' => function ($query) {
                    $query->where('is_published', true)
                        ->where('type', 'image')
                        ->orderBy('sort_order')
                        ->limit(4);
                }])
                ->orderBy('sort_order')
                ->orderBy('created_at', 'desc')
                ->get();
            
            echo "<p class='success'>✅ Requête Eloquent réussie: {$eloquentAlbums->count()} album(s) publié(s)</p>";
            
            foreach ($eloquentAlbums as $album) {
                echo "<div style='border:1px solid #ddd;padding:10px;margin:10px 0;'>";
                echo "<h3>📁 {$album->title}</h3>";
                echo "<p>Publié: " . ($album->is_published ? 'Oui' : 'Non') . "</p>";
                echo "<p>Médias chargés: <strong>{$album->media->count()}</strong></p>";
                
                if ($album->media->isEmpty()) {
                    echo "<p class='warning'>⚠️ Aucun média publié de type image dans cet album</p>";
                } else {
                    echo "<div style='display:flex;gap:10px;'>";
                    foreach ($album->media as $media) {
                        echo "<div style='border:1px solid #eee;padding:5px;'>";
                        echo "<p><strong>{$media->title}</strong></p>";
                        echo "<p>URL: " . ($media->url ?? 'NULL') . "</p>";
                        if ($media->url) {
                            echo "<img src='{$media->url}' style='max-width:100px;max-height:100px;'>";
                        }
                        echo "</div>";
                    }
                    echo "</div>";
                }
                echo "</div>";
            }
        } catch (\Exception $e) {
            echo '<p class="error">❌ Erreur Eloquent: ' . $e->getMessage() . '</p>';
            echo '<pre>' . $e->getTraceAsString() . '</pre>';
        }
        echo '</div>';

        // 5. Configuration filesystem
        echo '<div class="section">';
        echo '<h2>5. Configuration Storage</h2>';
        echo '<table>';
        echo '<tr><th>Config</th><th>Valeur</th></tr>';
        echo '<tr><td>FILESYSTEM_DISK</td><td>' . config('filesystems.default') . '</td></tr>';
        echo '<tr><td>Storage disk URL</td><td>' . (config('filesystems.disks.' . config('filesystems.default') . '.url') ?? 'Non configuré') . '</td></tr>';
        echo '<tr><td>APP_URL</td><td>' . config('app.url') . '</td></tr>';
        echo '<tr><td>FORCE_HTTPS</td><td>' . (env('FORCE_HTTPS') ? 'true' : 'false') . '</td></tr>';
        echo '</table>';
        echo '</div>';

    } catch (\Exception $e) {
        echo '<div class="section error">';
        echo '<h2>❌ Erreur fatale</h2>';
        echo '<p>' . $e->getMessage() . '</p>';
        echo '<pre>' . $e->getTraceAsString() . '</pre>';
        echo '</div>';
    }
    ?>

    <hr>
    <p><a href="/mediatheque">← Retour à la médiathèque</a></p>
    <p><a href="/gestion-nm/media">← Admin médias</a></p>
    <p><a href="/gestion-nm/albums">← Admin albums</a></p>
</body>
</html>
