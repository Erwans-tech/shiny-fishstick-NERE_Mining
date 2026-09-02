<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

$users = \App\Models\User::where('is_admin', true)->get();
echo "Admin users: " . count($users) . "\n";
foreach($users as $user) {
    echo "Email: " . $user->email . "\n";
    echo "Name: " . $user->name . "\n";
}
?>
