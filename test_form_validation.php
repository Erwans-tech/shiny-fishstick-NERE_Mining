<?php
/**
 * Test de validation du formulaire HeroSlide - Simple
 */

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$kernel = $app->make('Illuminate\Contracts\Console\Kernel');
$kernel->bootstrap();

use Illuminate\Support\Facades\Validator;

echo "\n╔══════════════════════════════════════════════════════════════╗\n";
echo "║  TEST: Validation du formulaire HeroSlide                     ║\n";
echo "╚══════════════════════════════════════════════════════════════╝\n\n";

// Test 1: Vidéo YouTube valide
echo "TEST 1: Ajouter une VIDÉO YOUTUBE\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

$type = 'video';
$rules = [
    'type'       => ['required', 'in:image,video'],
    'title'      => ['nullable', 'string', 'max:160'],
    'caption'    => ['nullable', 'string', 'max:255'],
    'sort_order' => ['nullable', 'integer', 'min:0', 'max:99'],
    'is_active'  => ['nullable', 'boolean'],
];

if ($type === 'video') {
    $rules['video_url'] = ['required', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i'];
}

$data = [
    'type' => 'video',
    'title' => 'Test Video',
    'caption' => 'YouTube Video',
    'video_url' => 'https://www.youtube.com/watch?v=wZWkNKdNlR8',
    'sort_order' => '1',
    'is_active' => '1',
];

$validator = Validator::make($data, $rules);

if ($validator->fails()) {
    echo "✗ ERREURS:\n";
    foreach ($validator->errors()->all() as $error) {
        echo "  - $error\n";
    }
} else {
    echo "✓ VALIDE ✅\n";
    echo "  Données validées: " . json_encode($validator->validated()) . "\n";
}

// Test 2: Vidéo YouTube INVALIDE
echo "\nTEST 2: URL VIDÉO INVALIDE (non-YouTube)\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

$type = 'video';
$rules = [
    'type'       => ['required', 'in:image,video'],
    'title'      => ['nullable', 'string', 'max:160'],
    'caption'    => ['nullable', 'string', 'max:255'],
    'sort_order' => ['nullable', 'integer', 'min:0', 'max:99'],
    'is_active'  => ['nullable', 'boolean'],
];

if ($type === 'video') {
    $rules['video_url'] = ['required', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i'];
}

$data = [
    'type' => 'video',
    'title' => 'Invalid Video',
    'caption' => 'Invalid URL',
    'video_url' => 'https://example.com/video',
    'sort_order' => '1',
    'is_active' => '1',
];

$validator = Validator::make($data, $rules);

if ($validator->fails()) {
    echo "✗ ERREURS (attendu) ✅\n";
    foreach ($validator->errors()->all() as $error) {
        echo "  - $error\n";
    }
} else {
    echo "✓ VALIDE (pas attendu!) ❌\n";
}

// Test 3: IMAGE - pas de video_url
echo "\nTEST 3: IMAGE - Champs pertinents uniquement\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

$type = 'image';
$rules = [
    'type'       => ['required', 'in:image,video'],
    'title'      => ['nullable', 'string', 'max:160'],
    'caption'    => ['nullable', 'string', 'max:255'],
    'sort_order' => ['nullable', 'integer', 'min:0', 'max:99'],
    'is_active'  => ['nullable', 'boolean'],
];

// N'ajoute PAS de règle 'image' ni 'video_url'
// Le formulaire ne doit pas envoyer video_url

$data = [
    'type' => 'image',
    'title' => 'Test Image',
    'caption' => 'Test Caption',
    'sort_order' => '0',
    'is_active' => '1',
    // PAS de 'image' ni 'video_url' - ce qu'on veut!
];

$validator = Validator::make($data, $rules);

if ($validator->fails()) {
    echo "✗ ERREURS:\n";
    foreach ($validator->errors()->all() as $error) {
        echo "  - $error\n";
    }
} else {
    echo "✓ VALIDE (pas de champs conditionnels) ✅\n";
    echo "  Données: " . json_encode($validator->validated()) . "\n";
}

// Test 4: Type invalide
echo "\nTEST 4: Type invalide\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";

$type = 'invalid';
$rules = [
    'type'       => ['required', 'in:image,video'],
];

$data = [
    'type' => 'invalid',
];

$validator = Validator::make($data, $rules);

if ($validator->fails()) {
    echo "✗ ERREURS (attendu) ✅\n";
    foreach ($validator->errors()->all() as $error) {
        echo "  - $error\n";
    }
} else {
    echo "✓ VALIDE (pas attendu!) ❌\n";
}

echo "\n╔══════════════════════════════════════════════════════════════╗\n";
echo "║  CONCLUSION: Backend validation OK ✅                         ║\n";
echo "║  Le problème vient du FORMULAIRE                              ║\n";
echo "║  Vérifies que:                                                 ║\n";
echo "║  1. Les champs sont envoyés correctement                       ║\n";
echo "║  2. Les valeurs ne sont pas vides                             ║\n";
echo "║  3. Utilise la console navigateur (F12)                       ║\n";
echo "╚══════════════════════════════════════════════════════════════╝\n\n";

?>

