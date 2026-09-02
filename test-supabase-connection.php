<?php
/**
 * 🧪 Test de connexion Supabase PostgreSQL
 * Remplace [TON-MOT-DE-PASSE] par ton vrai mot de passe et lance :
 * php test-supabase-connection.php
 */

echo "🧪 Test de connexion Supabase...\n";

// Tes informations Supabase
$host = 'db.plibklblcykfhnoboqum.supabase.co';
$port = '5432';
$database = 'postgres';
$username = 'postgres';
$password = '4kuAbwAFxDb1nD03'; // ✅ TON MOT DE PASSE SUPABASE

echo "🔗 Tentative de connexion à : $host:$port\n";
echo "👤 Utilisateur : $username\n";
echo "🗃️ Base de données : $database\n\n";

try {
    // Tentative de connexion
    $dsn = "pgsql:host=$host;port=$port;dbname=$database;sslmode=require";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✅ CONNEXION RÉUSSIE !\n";
    
    // Test basique
    $stmt = $pdo->query('SELECT version()');
    $version = $stmt->fetch();
    echo "🐘 Version PostgreSQL : " . $version['version'] . "\n";
    
    // Test des tables (si migrations déjà faites)
    $stmt = $pdo->query("SELECT table_name FROM information_schema.tables WHERE table_schema = 'public'");
    $tables = $stmt->fetchAll();
    
    if (count($tables) > 0) {
        echo "📋 Tables trouvées :\n";
        foreach ($tables as $table) {
            echo "  - " . $table['table_name'] . "\n";
        }
    } else {
        echo "📋 Aucune table trouvée (normal si pas encore de migrations)\n";
    }
    
    echo "\n🎉 Test terminé avec succès !\n";
    echo "🚀 Tu peux maintenant déployer sur Render avec ces paramètres.\n";
    
} catch (PDOException $e) {
    echo "❌ ERREUR DE CONNEXION :\n";
    echo "💥 " . $e->getMessage() . "\n\n";
    
    echo "🔧 Vérifications à faire :\n";
    echo "1. Le mot de passe est-il correct ?\n";
    echo "2. L'host est-il accessible depuis ton réseau ?\n";
    echo "3. Le projet Supabase est-il bien actif ?\n";
    echo "4. As-tu bien activé la connexion externe dans Supabase ?\n";
    
    exit(1);
}
?>