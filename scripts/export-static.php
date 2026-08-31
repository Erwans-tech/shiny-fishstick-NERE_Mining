<?php

/**
 * Script d'export statique pour Netlify
 * Génère des fichiers HTML à partir des routes publiques
 */

require __DIR__ . '/../bootstrap/app.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(\Illuminate\Contracts\Http\Kernel::class);

// Routes publiques à exporter
$routes = [
    '/' => 'index.html',
    '/en' => 'en/index.html',
    '/qui-sommes-nous' => 'qui-sommes-nous/index.html',
    '/en/company' => 'en/company/index.html',
    '/karma' => 'karma/index.html',
    '/en/karma' => 'en/karma/index.html',
    '/nos-projets' => 'nos-projets/index.html',
    '/en/projects' => 'en/projects/index.html',
    '/developpement-durable' => 'developpement-durable/index.html',
    '/en/sustainability' => 'en/sustainability/index.html',
    '/actualites' => 'actualites/index.html',
    '/en/news' => 'en/news/index.html',
    '/emploi' => 'emploi/index.html',
    '/en/careers' => 'en/careers/index.html',
    '/contact' => 'contact/index.html',
    '/en/contact' => 'en/contact/index.html',
];

$outputDir = __DIR__ . '/../dist';

if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

echo "🚀 Exporting static pages...\n\n";

foreach ($routes as $route => $file) {
    try {
        $request = Illuminate\Http\Request::create($route);
        $response = $kernel->handle($request);
        
        $filePath = $outputDir . '/' . $file;
        $dir = dirname($filePath);
        
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        file_put_contents($filePath, $response->getContent());
        echo "✅ Generated: $file\n";
        
        $kernel->terminate($request, $response);
    } catch (\Throwable $e) {
        echo "❌ Error on $route: " . $e->getMessage() . "\n";
    }
}

echo "\n✨ Export complete! Files ready in /dist\n";
