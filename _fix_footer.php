<?php
/**
 * Remplace les footers inline par @include('partials._footer')
 * dans toutes les vues publiques (hors admin et _footer.blade.php).
 */

$files = [
    __DIR__ . '/resources/views/home.blade.php',
    __DIR__ . '/resources/views/resources.blade.php',
    __DIR__ . '/resources/views/careers/index.blade.php',
    __DIR__ . '/resources/views/careers/show.blade.php',
    __DIR__ . '/resources/views/careers/spontaneous.blade.php',
    __DIR__ . '/resources/views/news/index.blade.php',
    __DIR__ . '/resources/views/news/show.blade.php',
    __DIR__ . '/resources/views/reports/index.blade.php',
];

$partial = "\n    @include('partials._footer', ['loc' => \$loc ?? app()->getLocale(), 'en' => \$en ?? false])";

$fixed = 0;

foreach ($files as $path) {
    if (!file_exists($path)) {
        echo "SKIP (not found): $path\n";
        continue;
    }

    $content = file_get_contents($path);
    $original = $content;

    // Supprimer le bloc <footer>...</footer> et le remplacer par le partial
    // Le footer peut avoir des attributs style= inline
    $content = preg_replace(
        '/<footer[\s\S]*?<\/footer>\s*/s',
        '',
        $content
    );

    // Supprimer les balises <style> uniquement si elles ne concernent que le footer
    // (footer responsive media queries)
    $content = preg_replace(
        '/\s*<style>\s*@media\(max-width:[0-9]+px\)\s*\{[\s\S]*?footer[\s\S]*?\}\s*<\/style>/s',
        '',
        $content
    );

    // Insérer le partial juste avant </body>
    if (strpos($content, "partials._footer") === false) {
        $content = str_replace('</body>', $partial . "\n</body>", $content);
    }

    if ($content !== $original) {
        file_put_contents($path, $content);
        echo "Fixed: " . basename($path) . "\n";
        $fixed++;
    } else {
        echo "No change: " . basename($path) . "\n";
    }
}

echo "\n$fixed file(s) updated.\n";
