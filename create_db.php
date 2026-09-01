<?php
try {
    $conn = new PDO('mysql:host=127.0.0.1;port=3306', 'root', '');
    $conn->exec("CREATE DATABASE IF NOT EXISTS nere_mining CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");
    echo "Database created successfully!\n";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
