<?php
/**
 * Script pour créer 5 images minières HD (1920x1080)
 * Pour le diaporama hero de Néré Mining
 */

$images = [
    'mining-equipment-01.jpg' => [
        'color' => [230, 140, 30], // Gold/orange
        'text' => 'MINING EQUIPMENT',
        'subtitle' => 'Modern Machinery'
    ],
    'mining-site-aerial-01.jpg' => [
        'color' => [139, 69, 19], // Brown/earth
        'text' => 'OPEN PIT MINING',
        'subtitle' => 'Aerial View'
    ],
    'gold-processing-01.jpg' => [
        'color' => [184, 134, 11], // Dark gold
        'text' => 'GOLD PROCESSING',
        'subtitle' => 'CIL Technology'
    ],
    'mining-workers-01.jpg' => [
        'color' => [70, 130, 180], // Steel blue
        'text' => 'SAFETY & TEAM',
        'subtitle' => 'Excellence'
    ],
    'mining-environment-01.jpg' => [
        'color' => [34, 139, 34], // Forest green
        'text' => 'ENVIRONMENTAL',
        'subtitle' => 'Sustainable Mining'
    ]
];

foreach ($images as $filename => $config) {
    // Créer image 1920x1080
    $img = imagecreatetruecolor(1920, 1080);
    
    $color = imagecolorallocate($img, $config['color'][0], $config['color'][1], $config['color'][2]);
    $darkColor = imagecolorallocate(
        $img, 
        max(0, $config['color'][0]-50), 
        max(0, $config['color'][1]-50), 
        max(0, $config['color'][2]-50)
    );
    $white = imagecolorallocate($img, 255, 255, 255);
    $darkOverlay = imagecolorallocate($img, 0, 0, 0);
    
    // Remplir fond avec dégradé
    for ($y = 0; $y < 1080; $y++) {
        $ratio = $y / 1080;
        $r = (int)(($config['color'][0]) * (1 - $ratio * 0.4));
        $g = (int)(($config['color'][1]) * (1 - $ratio * 0.4));
        $b = (int)(($config['color'][2]) * (1 - $ratio * 0.4));
        $lineColor = imagecolorallocate($img, max(0, $r), max(0, $g), max(0, $b));
        imageline($img, 0, $y, 1920, $y, $lineColor);
    }
    
    // Ajouter pattern géométrique
    for ($x = 0; $x < 1920; $x += 120) {
        for ($y = 0; $y < 1080; $y += 120) {
            imagerectangle($img, $x, $y, $x+60, $y+60, $darkColor);
        }
    }
    
    // Ajouter texture aléatoire (points)
    for ($i = 0; $i < 800; $i++) {
        $x = rand(0, 1920);
        $y = rand(0, 1080);
        $size = rand(1, 4);
        imagefilledellipse($img, $x, $y, $size, $size, $darkColor);
    }
    
    // Overlay semi-transparent noir
    $overlayImg = imagecreatetruecolor(1920, 1080);
    $overlay = imagecolorallocatealpha($overlayImg, 0, 0, 0, 50);
    imagefilledrectangle($overlayImg, 0, 0, 1920, 1080, $overlay);
    imagecopy($img, $overlayImg, 0, 0, 0, 0, 1920, 1080);
    imagedestroy($overlayImg);
    
    // Ajouter texte
    $textColor = $white;
    $mainTextSize = 90;
    $subTextSize = 45;
    
    // Texte principal (centré)
    $mainText = $config['text'];
    $subText = $config['subtitle'];
    
    // Ombre du texte principal
    imagestring($img, 5, 920, 485, $mainText, $darkOverlay);
    // Texte principal blanc
    imagestring($img, 5, 918, 483, $mainText, $textColor);
    
    // Ombre du sous-texte
    imagestring($img, 3, 920, 605, $subText, $darkOverlay);
    // Sous-texte blanc
    imagestring($img, 3, 918, 603, $subText, $textColor);
    
    // Watermark Néré Mining
    imagestring($img, 2, 50, 1050, 'Néré Mining | Karma Mine Site | www.nere-mining.bf', $textColor);
    
    // Sauvegarder avec qualité 85
    imagejpeg($img, __DIR__.'/public/images/mining/'.$filename, 85);
    imagedestroy($img);
    
    echo "✓ Créé: $filename (1920x1080)\n";
}

echo "\n✅ 5 images minières créées avec succès!\n";
?>
