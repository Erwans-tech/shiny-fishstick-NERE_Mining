/**
 * Script d'optimisation et conversion d'images
 * - Réduit la taille fichier (< 500KB)
 * - Convertit en WebP avec fallback JPEG/PNG
 * - Maintient la qualité visuelle
 */

const sharp = require('sharp');
const fs = require('fs');
const path = require('path');

const communauteDir = path.join(__dirname, 'public', 'images', 'communaute');

const images = [
    {
        input: 'session-comite-suivi-liaison-ouahigouya-2026.jpg',
        output: 'session-comite-suivi-liaison-ouahigouya-2026',
        alt: 'Vue partielle des participants à une session du comité de suivi et de liaison (CSL) à Ouahigouya en février 2026',
        altEn: 'Partial view of participants at a monitoring and liaison committee (CSL) session in Ouahigouya in February 2026'
    },
    {
        input: 'forage-chateau-eau-solaire-namissiguima.png',
        output: 'forage-chateau-eau-solaire-namissiguima',
        alt: 'Réalisation d\'un forage équipé d\'un château d\'eau solaire à Namissiguima',
        altEn: 'Construction of a borehole equipped with a solar water tower in Namissiguima'
    }
];

async function optimizeImage(imageInfo) {
    const inputPath = path.join(communauteDir, imageInfo.input);
    const ext = path.extname(imageInfo.input);
    const webpPath = path.join(communauteDir, `${imageInfo.output}.webp`);
    const optimizedPath = path.join(communauteDir, `${imageInfo.output}-optimized${ext}`);

    try {
        // Lire métadonnées originales
        const metadata = await sharp(inputPath).metadata();
        console.log(`\n📷 ${imageInfo.input}`);
        console.log(`   Original: ${(metadata.size / 1024).toFixed(2)} KB | ${metadata.width}x${metadata.height}`);

        // 1. Créer version WebP optimisée
        await sharp(inputPath)
            .resize(1920, null, { // Max width 1920px, hauteur proportionnelle
                withoutEnlargement: true,
                fit: 'inside'
            })
            .webp({
                quality: 85,
                effort: 6
            })
            .toFile(webpPath);

        const webpStats = fs.statSync(webpPath);
        console.log(`   WebP: ${(webpStats.size / 1024).toFixed(2)} KB ✅`);

        // 2. Créer fallback optimisé (JPEG ou PNG)
        if (ext === '.jpg' || ext === '.jpeg') {
            await sharp(inputPath)
                .resize(1920, null, {
                    withoutEnlargement: true,
                    fit: 'inside'
                })
                .jpeg({
                    quality: 85,
                    progressive: true,
                    mozjpeg: true
                })
                .toFile(optimizedPath);
        } else if (ext === '.png') {
            await sharp(inputPath)
                .resize(1920, null, {
                    withoutEnlargement: true,
                    fit: 'inside'
                })
                .png({
                    quality: 85,
                    compressionLevel: 9,
                    adaptiveFiltering: true
                })
                .toFile(optimizedPath);
        }

        const optimizedStats = fs.statSync(optimizedPath);
        console.log(`   ${ext.toUpperCase()}: ${(optimizedStats.size / 1024).toFixed(2)} KB ✅`);

        // Remplacer le fichier original par la version optimisée
        fs.unlinkSync(inputPath);
        fs.renameSync(optimizedPath, path.join(communauteDir, `${imageInfo.output}${ext}`));

        // 3. Créer thumbnail (optionnel)
        const thumbPath = path.join(communauteDir, `${imageInfo.output}-thumb.webp`);
        await sharp(inputPath)
            .resize(400, 300, {
                fit: 'cover',
                position: 'center'
            })
            .webp({ quality: 80 })
            .toFile(thumbPath);

        const thumbStats = fs.statSync(thumbPath);
        console.log(`   Thumbnail: ${(thumbStats.size / 1024).toFixed(2)} KB ✅`);

        return {
            success: true,
            webp: webpPath,
            fallback: path.join(communauteDir, `${imageInfo.output}${ext}`),
            thumb: thumbPath,
            alt: imageInfo.alt,
            altEn: imageInfo.altEn
        };

    } catch (error) {
        console.error(`❌ Erreur: ${imageInfo.input}`, error.message);
        return { success: false, error: error.message };
    }
}

async function main() {
    console.log('🚀 Optimisation des images communauté...\n');

    if (!fs.existsSync(communauteDir)) {
        console.error('❌ Le dossier communaute n\'existe pas');
        process.exit(1);
    }

    const results = [];
    for (const imageInfo of images) {
        const result = await optimizeImage(imageInfo);
        results.push(result);
    }

    console.log('\n✅ Optimisation terminée !');
    console.log('\n📊 Résumé:');
    results.forEach((r, i) => {
        if (r.success) {
            console.log(`   ${i + 1}. ✅ ${images[i].input}`);
        } else {
            console.log(`   ${i + 1}. ❌ ${images[i].input} - ${r.error}`);
        }
    });

    // Générer snippet HTML pour intégration
    console.log('\n📝 Code HTML pour intégration:\n');
    results.forEach((r, i) => {
        if (r.success) {
            const img = images[i];
            console.log(`<!-- ${img.alt} -->`);
            console.log(`<picture>`);
            console.log(`    <source srcset="{{ asset('images/communaute/${img.output}.webp') }}" type="image/webp">`);
            console.log(`    <img src="{{ asset('images/communaute/${img.output}${path.extname(img.input)}') }}" `);
            console.log(`         alt="{{ \\$en ? '${img.altEn}' : '${img.alt}' }}" `);
            console.log(`         class="img-responsive" `);
            console.log(`         loading="lazy" />`);
            console.log(`</picture>\n`);
        }
    });
}

main().catch(console.error);
