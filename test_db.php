<?php
try {
    $conn = new PDO('mysql:host=127.0.0.1;port=3306;dbname=nere_mining', 'root', '');
    echo "MySQL connected successfully!\n";
} catch(Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
