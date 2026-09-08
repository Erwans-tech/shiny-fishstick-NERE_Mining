<?php
/**
 * Script pour synchroniser les données locales avec la production
 * Cré une migration dump de la base de données locale
 */

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "╔════════════════════════════════════════╗\n";
echo "║  DATABASE SYNC - LOCAL TO PRODUCTION   ║\n";
echo "╚════════════════════════════════════════╝\n\n";

// Tables à exporter
$tables = [
    'news',
    'reports',
    'job_offers',
    'job_applications',
    'contact_messages',
    'newsletter_subscribers',
    'partners',
    'media_assets',
    'press_documents',
    'certifications',
    'hero_slides',
    'karma_departments',
    'site_settings',
    'leadership_members'
];

echo "📊 Tables à exporter:\n";
foreach ($tables as $table) {
    if (Schema::hasTable($table)) {
        $count = DB::table($table)->count();
        echo "   ✓ $table ($count records)\n";
    }
}

// Créer le dump SQL
echo "\n🔄 Création du dump SQL...\n";

$dumpFile = 'database/dumps/nere_mining_sync_' . date('Y-m-d_H-i-s') . '.sql';
@mkdir(dirname($dumpFile), 0755, true);

$sql = '';

foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        continue;
    }
    
    // Récupérer tous les enregistrements
    $records = DB::table($table)->get()->toArray();
    
    if (count($records) === 0) {
        continue;
    }
    
    // Truncate statement
    $sql .= "TRUNCATE TABLE `$table` CASCADE;\n";
    
    // Insert statements
    foreach ($records as $record) {
        $columns = array_keys((array) $record);
        $values = array_values((array) $record);
        
        // Échapper les valeurs
        $values = array_map(function($v) {
            if ($v === null) return 'NULL';
            if (is_bool($v)) return $v ? '1' : '0';
            if (is_numeric($v) && !preg_match('/^0[0-9]/', $v)) return $v;
            return "'" . addslashes($v) . "'";
        }, $values);
        
        $cols = implode('`, `', $columns);
        $vals = implode(', ', $values);
        
        $sql .= "INSERT INTO `$table` (`$cols`) VALUES ($vals);\n";
    }
    
    $sql .= "\n";
}

// Écrire dans le fichier
file_put_contents($dumpFile, $sql);

echo "✅ Dump créé: $dumpFile\n";
echo "   Taille: " . number_format(strlen($sql) / 1024, 2) . " KB\n";

// Afficher le contenu
echo "\n📋 Contenu du dump (preview):\n";
echo "─────────────────────────────────────\n";
echo substr($sql, 0, 500) . "...\n";
echo "─────────────────────────────────────\n";

echo "\n✅ Migration dump créée avec succès!\n";
echo "\n💡 Prochaines étapes en production:\n";
echo "   1. SSH dans Render\n";
echo "   2. Copier le fichier SQL\n";
echo "   3. Exécuter: psql -h \$DATABASE_URL < nere_mining_sync.sql\n";
echo "   4. Vérifier les données\n";

exit(0);
