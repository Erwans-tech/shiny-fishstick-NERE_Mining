<?php
/**
 * 🧪 Test de connexion MySQL local
 * Lance : php test-mysql-local.php
 */

echo "🧪 Test de connexion MySQL local...\n";

// Configuration depuis .env
$host = '127.0.0.1';
$port = '3306';
$database = 'nere_mining';
$username = 'root';
$password = ''; // Modifie si tu as un mot de passe

echo "🔗 Tentative de connexion à : $host:$port\n";
echo "👤 Utilisateur : $username\n";
echo "🗃️ Base de données : $database\n\n";

try {
    // Test de connexion sans spécifier la base (pour la créer si besoin)
    $dsn_server = "mysql:host=$host;port=$port;charset=utf8mb4";
    $pdo_server = new PDO($dsn_server, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ]);
    
    echo "✅ Connexion serveur MySQL OK !\n";
    
    // Vérifier si la base existe
    $stmt = $pdo_server->query("SHOW DATABASES LIKE '$database'");
    if ($stmt->rowCount() == 0) {
        echo "📦 Création de la base de données '$database'...\n";
        $pdo_server->exec("CREATE DATABASE `$database` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
        echo "✅ Base de données créée !\n";
    } else {
        echo "✅ Base de données '$database' existe déjà.\n";
    }
    
    // Connexion à la base spécifique
    $dsn = "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4";
    $pdo = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
    
    echo "✅ CONNEXION À LA BASE '$database' RÉUSSIE !\n";
    
    // Test version MySQL
    $stmt = $pdo->query('SELECT VERSION() as version');
    $version = $stmt->fetch();
    echo "🐬 Version MySQL : " . $version['version'] . "\n";
    
    // Test des tables Laravel (si migrations déjà faites)
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll();
    
    if (count($tables) > 0) {
        echo "📋 Tables trouvées :\n";
        foreach ($tables as $table) {
            $table_name = array_values($table)[0];
            echo "  - $table_name\n";
        }
    } else {
        echo "📋 Aucune table trouvée (lance 'php artisan migrate' pour créer les tables)\n";
    }
    
    echo "\n🎉 Configuration MySQL locale OK !\n";
    echo "🚀 Tu peux maintenant lancer 'php artisan migrate' si pas encore fait.\n";
    
} catch (PDOException $e) {
    echo "❌ ERREUR DE CONNEXION :\n";
    echo "💥 " . $e->getMessage() . "\n\n";
    
    echo "🔧 Solutions possibles :\n";
    echo "1. Vérifier que MySQL/XAMPP/WAMP est démarré\n";
    echo "2. Vérifier le mot de passe dans .env (actuellement vide)\n";
    echo "3. Vérifier que le port 3306 est libre\n";
    echo "4. Créer manuellement la base 'nere_mining' dans phpMyAdmin\n";
    
    exit(1);
}
?>