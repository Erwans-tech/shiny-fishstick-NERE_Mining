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
        $disk = config('filesystems.default');

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
            $rules['video_url'] = ['nullable', 'string', 'max:500'];
            $rules['video_file'] = ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:51200']; // Max 50 Mo
            $rules['cover_image'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'];

            // Validation : soit video_url (YouTube/Vimeo) soit video_file doit être présent
            $rules['video_source'] = ['required', 'in:url,file'];
        }

        $data = $request->validate($rules);

        // Validation supplémentaire pour vidéo : vérifier que video_url OU video_file est présent
        if ($type === 'video') {
            $videoSource = $request->input('video_source');

            if ($videoSource === 'url') {
                $videoUrl = $request->input('video_url', '');
                if (empty($videoUrl)) {
                    return back()->withErrors(['video_url' => 'Veuillez entrer une URL YouTube ou Vimeo'])->withInput();
                }
                // Vérifier que c'est une URL valide YouTube ou Vimeo
                if (!preg_match('/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i', $videoUrl)) {
                    return back()->withErrors(['video_url' => 'Format d\'URL invalide. Utilisez YouTube ou Vimeo.'])->withInput();
                }
                $data['video_url'] = $videoUrl;
            } elseif ($videoSource === 'file') {
                if (!$request->hasFile('video_file')) {
                    return back()->withErrors(['video_file' => 'Veuillez sélectionner un fichier vidéo'])->withInput();
                }
            }
        }

        $data['type']       = $type;
        $data['is_active']  = $request->boolean('is_active') ?? true;
        $data['sort_order'] = $data['sort_order'] ?? $this->nextOrder();

        if ($type === 'image' && $request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('hero', config('filesystems.default'));
        }

        if ($type === 'video') {
            $data['image_path'] = null;

            // Option 1 : Vidéo uploadée (MP4)
            if ($request->hasFile('video_file')) {
                $videoPath = $request->file('video_file')->store('hero/videos', $disk);
                $data['video_url'] = $this->publicStorageUrl($disk, $videoPath);
            }

            // Option 2 : URL YouTube/Vimeo
            // Si pas de fichier mais URL fournie, utiliser l'URL

            // Image de couverture manuelle (optionnelle, override l'auto-générée)
            if ($request->hasFile('cover_image')) {
                $data['image_path'] = $request->file('cover_image')->store('hero', config('filesystems.default'));
            }
        }

        unset($data['image'], $data['cover_image'], $data['video_file'], $data['video_source']);

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
        $disk = config('filesystems.default');

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

        // Vidéo : URL OU fichier optionnel si type = video (peuvent être modifiés séparément)
        if ($type === 'video') {
            $rules['video_url'] = ['nullable', 'string', 'max:500'];
            $rules['video_file'] = ['nullable', 'file', 'mimes:mp4,webm,mov', 'max:51200'];
            $rules['cover_image'] = ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192'];
            $rules['video_source'] = ['nullable', 'in:url,file'];
        }

        $data = $request->validate($rules);

        // Validation supplémentaire pour vidéo
        if ($type === 'video') {
            $videoSource = $request->input('video_source');

            if ($videoSource === 'url') {
                $videoUrl = $request->input('video_url', '');
                if (empty($videoUrl)) {
                    return back()->withErrors(['video_url' => 'Veuillez entrer une URL YouTube ou Vimeo'])->withInput();
                }
                if (!preg_match('/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i', $videoUrl)) {
                    return back()->withErrors(['video_url' => 'Format d\'URL invalide. Utilisez YouTube ou Vimeo.'])->withInput();
                }
                $data['video_url'] = $videoUrl;
            } elseif ($videoSource === 'file') {
                if (!$request->hasFile('video_file')) {
                    return back()->withErrors(['video_file' => 'Veuillez sélectionner un fichier vidéo'])->withInput();
                }
            }
        }

        $data['type']       = $type;
        $data['is_active']  = $request->boolean('is_active') ?? $heroSlide->is_active;
        $data['sort_order'] = $data['sort_order'] ?? $heroSlide->sort_order;

        if ($type === 'image' && $request->hasFile('image')) {
            $this->deleteFile($heroSlide->image_path);
            $data['image_path'] = $request->file('image')->store('hero', config('filesystems.default'));
        }

        if ($type === 'video') {
            if ($request->hasFile('video_file')) {
                $videoPath = $request->file('video_file')->store('hero/videos', $disk);
                $data['video_url'] = $this->publicStorageUrl($disk, $videoPath);
                $data['image_path'] = null;
            }
            if ($request->hasFile('cover_image')) {
                $this->deleteFile($heroSlide->image_path);
                $data['image_path'] = $request->file('cover_image')->store('hero', $disk);
            }
            // Si on passe de image → video sans cover, on garde l'ancienne image comme cover
        }

        // Si on change de vidéo → image, supprimer l'ancienne image
        if ($heroSlide->type === 'video' && $type === 'image' && $request->hasFile('image')) {
            $this->deleteFile($heroSlide->image_path);
        }

        unset($data['image'], $data['cover_image'], $data['video_file'], $data['video_source']);

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
            Storage::disk(config('filesystems.default'))->delete($path);
        }
    }

    private function publicStorageUrl(string $disk, string $path): string
    {
        $diskConfig = config('filesystems.disks');
        $baseUrl = rtrim((string) ($diskConfig[$disk]['url'] ?? ''), '/');

        return $baseUrl . '/' . ltrim($path, '/');
    }
}
