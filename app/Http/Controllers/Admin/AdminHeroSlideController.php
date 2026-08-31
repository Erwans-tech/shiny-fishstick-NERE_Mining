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

        $data = $request->validate([
            'type'       => ['required', 'in:image,video'],
            'title'      => ['nullable', 'string', 'max:160'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0', 'max:99'],
            'is_active'  => ['boolean'],

            // Image : requise si type = image
            'image'     => $type === 'image'
                ? ['required', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240']
                : [],

            // Vidéo : URL requise si type = video
            'video_url' => $type === 'video'
                ? ['required', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i']
                : [],

            // Image de couverture optionnelle pour les vidéos
            'cover_image' => $type === 'video'
                ? ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192']
                : [],
        ]);

        $data['type']       = $type;
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = (int) $request->input('sort_order', $this->nextOrder());

        if ($type === 'image' && $request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('hero', 'public');
        }

        if ($type === 'video') {
            $data['image_path'] = null;
            // Image de couverture optionnelle (affiché si la vidéo ne charge pas)
            if ($request->hasFile('cover_image')) {
                $data['image_path'] = $request->file('cover_image')->store('hero', 'public');
            }
        }

        unset($data['image'], $data['cover_image']);

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

        $data = $request->validate([
            'type'       => ['required', 'in:image,video'],
            'title'      => ['nullable', 'string', 'max:160'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'sort_order' => ['integer', 'min:0', 'max:99'],
            'is_active'  => ['boolean'],

            'image' => $type === 'image'
                ? ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,gif', 'max:10240']
                : [],

            'video_url' => $type === 'video'
                ? ['required', 'string', 'max:500', 'regex:/^https?:\/\/(www\.)?(youtube\.com|youtu\.be|vimeo\.com)/i']
                : [],

            'cover_image' => $type === 'video'
                ? ['nullable', 'file', 'mimes:jpg,jpeg,png,webp', 'max:8192']
                : [],
        ]);

        $data['type']       = $type;
        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = (int) $request->input('sort_order', $heroSlide->sort_order);

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
}
