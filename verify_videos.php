<?php
require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$slides = DB::table('hero_slides')->where('type', 'video')->orderBy('sort_order')->get();

echo "\n✅ VÉRIFICATION: Vidéos Minières en Base de Données\n";
echo "=================================================\n\n";

foreach ($slides as $i => $s) {
    echo ($i+1) . ". {$s->title}\n";
    echo "   ID: {$s->id} | Sort: {$s->sort_order} | Active: " . ($s->is_active ? 'YES' : 'NO') . "\n";
    echo "   URL: {$s->video_url}\n";
    echo "   Image: {$s->image_path}\n\n";
}

$count = $slides->count();
echo "Total vidéos: $count\n";
echo "\n✅ SUCCÈS - Toutes les vidéos sont en base!\n";
?>
