<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHeroSlideController extends Controller
{
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.hero.index', compact('slides'));
    }

    public function create()
    {
        return view('admin.hero.form', ['slide' => new HeroSlide()]);
    }

    public function store(Request $request)
    {
        $type = $request->input('type', 'image');

        // Construire les règles de validation dynamiquement
        $rules = [
            'type'       => ['required', 'in:image,video'],
            'title'      => ['nullable', 'string', 'max:160'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99'],
            'is_active'  => ['nullable', 'boolean'],
        ];

        // Image : requise si type = image
        if ($type === 'image') {
            $rules['image'] = ['required', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'];
        }

        // Vidéo : URL OU fichier MP4 requis si type = video
        if ($type === 'video') {
            $rules['video_url'] = ['nullable', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i'];
            $rules['video_file'] = ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:51200']; // Max 50 Mo
            $rules['cover_image'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'];
        }

        $data = $request->validate($rules);

        $data['type']       = $type;
        $data['is_active']  = $request->boolean('is_active') ?? true;
        $data['sort_order'] = $data['sort_order'] ?? $this->nextOrder();

        if ($type === 'image' && $request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('hero', 'public');
        }

        if ($type === 'video') {
            $data['image_path'] = null;
            
            // Option 1 : Vidéo uploadée (MP4)
            if ($request->hasFile('video_file')) {
                $videoPath = $request->file('video_file')->store('hero/videos', 'public');
                $data['video_url'] = asset('storage/' . $videoPath);
                
                // Générer automatiquement une image de couverture depuis la vidéo
                $coverPath = $this->generateVideoCover($videoPath);
                if ($coverPath) {
                    $data['image_path'] = $coverPath;
                }
            }
            
            // Option 2 : URL YouTube/Vimeo
            // Si pas de fichier mais URL fournie, utiliser l'URL
            
            // Image de couverture manuelle (optionnelle, override l'auto-générée)
            if ($request->hasFile('cover_image')) {
                $data['image_path'] = $request->file('cover_image')->store('hero', 'public');
            }
        }

        unset($data['image'], $data['cover_image'], $data['video_file']);

        HeroSlide::create($data);

        return redirect()->route('admin.hero.index')
            ->with('success', $type === 'video' ? 'Vidéo ajoutée au carrousel.' : 'Image ajoutée au carrousel.');
    }

    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero.form', ['slide' => $heroSlide]);
    }

    public function update(Request $request, HeroSlide $heroSlide)
    {
        $type = $request->input('type', $heroSlide->type ?? 'image');

        // Construire les règles de validation dynamiquement
        $rules = [
            'type'       => ['required', 'in:image,video'],
            'title'      => ['nullable', 'string', 'max:160'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'sort_order' => ['nullable', 'integer', 'min:0', 'max:99'],
            'is_active'  => ['nullable', 'boolean'],
        ];

        // Image : optionnelle si type = image (can update without changing image)
        if ($type === 'image') {
            $rules['image'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240'];
        }

        // Vidéo : URL requise si type = video
        if ($type === 'video') {
            $rules['video_url'] = ['required', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i'];
            $rules['cover_image'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'];
        }

        $data = $request->validate($rules);

        $data['type']       = $type;
        $data['is_active']  = $request->boolean('is_active') ?? $heroSlide->is_active;
        $data['sort_order'] = $data['sort_order'] ?? $heroSlide->sort_order;

        if ($type === 'image' && $request->hasFile('image')) {
            $this->deleteFile($heroSlide->image_path);
            $data['image_path'] = $request->file('image')->store('hero', 'public');
        }

        if ($type === 'video') {
            if ($request->hasFile('cover_image')) {
                $this->deleteFile($heroSlide->image_path);
                $data['image_path'] = $request->file('cover_image')->store('hero', 'public');
            }
            // Si on passe de image → video sans cover, on garde l'ancienne image comme cover
        }

        // Si on change de vidéo → image, supprimer l'ancienne image
        if ($heroSlide->type === 'video' && $type === 'image' && $request->hasFile('image')) {
            $this->deleteFile($heroSlide->image_path);
        }

        unset($data['image'], $data['cover_image']);

        $heroSlide->update($data);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide mise à jour.');
    }

    public function toggle(HeroSlide $heroSlide)
    {
        $heroSlide->update(['is_active' => ! $heroSlide->is_active]);

        return redirect()->route('admin.hero.index')
            ->with('success', $heroSlide->is_active ? 'Slide activée.' : 'Slide masquée.');
    }

    public function reorder(Request $request)
    {
        $request->validate([
            'order'         => ['required', 'array'],
            'order.*.id'    => ['required', 'integer', 'exists:hero_slides,id'],
            'order.*.order' => ['required', 'integer', 'min:0'],
        ]);

        foreach ($request->input('order') as $item) {
            HeroSlide::where('id', $item['id'])->update(['sort_order' => $item['order']]);
        }

        return response()->json(['success' => true]);
    }

    public function destroy(HeroSlide $heroSlide)
    {
        $this->deleteFile($heroSlide->image_path);
        $heroSlide->delete();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide supprimée du carrousel.');
    }

    private function nextOrder(): int
    {
        return (HeroSlide::max('sort_order') ?? -1) + 1;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && ! str_starts_with($path, 'images/')) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Génère une image de couverture à partir de la première frame d'une vidéo
     * Nécessite FFmpeg installé sur le serveur
     * 
     * @param string $videoPath Chemin relatif de la vidéo dans storage/public
     * @return string|null Chemin de l'image générée, ou null si échec
     */
    private function generateVideoCover(string $videoPath): ?string
    {
        try {
            $fullVideoPath = Storage::disk('public')->path($videoPath);
            
            // Générer un nom unique pour la couverture
            $coverFileName = 'cover_' . pathinfo($videoPath, PATHINFO_FILENAME) . '.jpg';
            $coverPath = 'hero/' . $coverFileName;
            $fullCoverPath = Storage::disk('public')->path($coverPath);
            
            // Créer le dossier si nécessaire
            $coverDir = dirname($fullCoverPath);
            if (!file_exists($coverDir)) {
                mkdir($coverDir, 0755, true);
            }
            
            // Commande FFmpeg pour extraire la première frame (à 0.5 seconde)
            // -ss 0.5 : position à 0.5 seconde
            // -i : fichier d'entrée
            // -vframes 1 : extraire 1 frame seulement
            // -q:v 2 : qualité (2 = haute qualité)
            $command = sprintf(
                'ffmpeg -ss 0.5 -i %s -vframes 1 -q:v 2 %s 2>&1',
                escapeshellarg($fullVideoPath),
                escapeshellarg($fullCoverPath)
            );
            
            exec($command, $output, $returnCode);
            
            // Vérifier si l'image a été créée
            if ($returnCode === 0 && file_exists($fullCoverPath)) {
                return $coverPath;
            }
            
            // Si FFmpeg échoue, utiliser GD pour créer une image placeholder
            return $this->createPlaceholderCover($coverPath);
            
        } catch (\Exception $e) {
            \Log::error('Erreur génération couverture vidéo: ' . $e->getMessage());
            return null;
        }
    }

    /**
     * Crée une image placeholder si FFmpeg n'est pas disponible
     * Utilise Intervention Image pour la compatibilité cross-platform
     */
    private function createPlaceholderCover(string $coverPath): ?string
    {
        try {
            $width = 1920;
            $height = 1080;
            
            // Créer l'image avec Intervention Image
            $image = \Intervention\Image\ImageManager::gd()
                ->create($width, $height)
                ->fill('#1c422c'); // Vert branding
            
            // Ajouter un dégradé en traçant des rectangles
            for ($i = 0; $i < $height / 2; $i += 10) {
                $opacity = 1 - ($i / ($height / 2)) * 0.3;
                $color = sprintf('rgba(197, 153, 70, %.1f)', $opacity * 0.8);
                $image->drawRectangle(0, $i, $width, $i + 10, function($draw) use ($color) {
                    $draw->fill($color)->border(0);
                });
            }
            
            // Dessiner un triangle play au centre
            $centerX = $width / 2;
            $centerY = $height / 2;
            $playSize = 120;
            
            // Triangle play en blanc
            $image->drawPolygon([
                [$centerX - $playSize, $centerY - $playSize],
                [$centerX + $playSize, $centerY],
                [$centerX - $playSize, $centerY + $playSize],
            ], function($draw) {
                $draw->fill('#ffffff')->border(0);
            });
            
            // Sauvegarder
            $fullPath = Storage::disk('public')->path($coverPath);
            $image->toJpeg(90)->save($fullPath);
            
            return $coverPath;
            
        } catch (\Exception $e) {
            \Log::error('Erreur création placeholder: ' . $e->getMessage());
            return null;
        }
    }
}
