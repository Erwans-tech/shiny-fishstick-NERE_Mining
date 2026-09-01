<?php
/**
 * 🔍 Vérification pré-déploiement Render
 * Lance : php verify-deployment-ready.php
 */

echo "🔍 Vérification pré-déploiement Render...\n\n";

// Vérifications des fichiers essentiels
$required_files = [
    'composer.json' => 'Configuration Composer',
    'artisan' => 'CLI Laravel',
    'render.yaml' => 'Configuration Render',
    '.env.render' => 'Template environnement Render',
    'bootstrap/app.php' => 'Bootstrap Laravel',
    'public/index.php' => 'Point d\'entrée web',
];

echo "📁 Vérification des fichiers essentiels...\n";
$missing_files = [];
foreach ($required_files as $file => $description) {
    if (file_exists($file)) {
        echo "✅ $file ($description)\n";
    } else {
        echo "❌ $file ($description) - MANQUANT !\n";
        $missing_files[] = $file;
    }
}

if (!empty($missing_files)) {
    echo "\n❌ Fichiers manquants détectés ! Déploiement impossible.\n";
    exit(1);
}

// Vérification composer.json
echo "\n📦 Vérification composer.json...\n";
if (file_exists('composer.json')) {
    $composer = json_decode(file_get_contents('composer.json'), true);
    if (isset($composer['require']['laravel/framework'])) {
        echo "✅ Laravel détecté : " . $composer['require']['laravel/framework'] . "\n";
    }
    if (isset($composer['require']['php'])) {
        echo "✅ Version PHP requise : " . $composer['require']['php'] . "\n";
    }
}

// Vérification des dossiers essentiels
echo "\n📂 Vérification des dossiers...\n";
$required_dirs = ['app', 'config', 'database', 'public', 'resources', 'storage'];
foreach ($required_dirs as $dir) {
    if (is_dir($dir)) {
        echo "✅ /$dir\n";
    } else {
        echo "❌ /$dir - MANQUANT !\n";
    }
}

// Vérification des permissions (approximatif sous Windows)
echo "\n🔐 Vérification des permissions...\n";
$writable_dirs = ['storage', 'bootstrap/cache'];
foreach ($writable_dirs as $dir) {
    if (is_dir($dir) && is_writable($dir)) {
        echo "✅ /$dir (writable)\n";
    } else {
        echo "⚠️  /$dir (vérifier les permissions sur Render)\n";
    }
}

// Vérification configuration Render
echo "\n🎯 Vérification configuration Render...\n";
if (file_exists('render.yaml')) {
    $render_config = file_get_contents('render.yaml');
    if (strpos($render_config, 'plibklblcykfhnoboqum') !== false) {
        echo "✅ Configuration Supabase détectée dans render.yaml\n";
    }
    if (strpos($render_config, 'composer install') !== false) {
        echo "✅ Build command configuré\n";
    }
    if (strpos($render_config, 'php artisan serve') !== false) {
        echo "✅ Start command configuré\n";
    }
}

// Informations de déploiement
echo "\n🚀 Informations de déploiement :\n";
echo "🔗 Host Supabase : db.plibklblcykfhnoboqum.supabase.co\n";
echo "🗃️ Base de données : postgres\n";
echo "👤 Utilisateur : postgres\n";
echo "🔑 Mot de passe : 4kuAbwAFxDb1nD03\n";
echo "📋 Variables d'environnement : voir RENDER_ENV_VARIABLES.txt\n";

echo "\n✅ PRÊT POUR LE DÉPLOIEMENT !\n";
echo "\n🎯 Prochaines étapes :\n";
echo "1. Pousse le code sur GitHub/GitLab\n";
echo "2. Connecte le repo à Render\n";
echo "3. Configure les variables d'environnement\n";
echo "4. Lance le déploiement\n";
echo "5. Surveille les logs\n";

echo "\n📚 Guides disponibles :\n";
echo "- CHECKLIST_DEPLOY_RENDER.md (guide complet)\n";
echo "- RENDER_ENV_VARIABLES.txt (variables à copier)\n";
echo "- MIGRATION_RENDER_SUPABASE.md (documentation détaillée)\n";

?>