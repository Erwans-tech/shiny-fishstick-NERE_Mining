<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminHeroSlideController extends Controller
{
    /** Liste des slides avec aperçu. */
    public function index()
    {
        $slides = HeroSlide::orderBy('sort_order')->orderBy('id')->get();
        return view('admin.hero.index', compact('slides'));
    }

    /** Formulaire de création. */
    public function create()
    {
        return view('admin.hero.form', ['slide' => new HeroSlide()]);
    }

    /** Sauvegarder une nouvelle slide. */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['nullable', 'string', 'max:160'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'image'      => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'is_active'  => ['boolean'],
            'sort_order' => ['integer', 'min:0', 'max:99'],
        ]);

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = (int) $request->input('sort_order', $this->nextOrder());
        $data['image_path'] = $request->file('image')->store('hero', 'public');
        unset($data['image']);

        HeroSlide::create($data);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide ajoutée au carrousel.');
    }

    /** Formulaire d'édition. */
    public function edit(HeroSlide $heroSlide)
    {
        return view('admin.hero.form', ['slide' => $heroSlide]);
    }

    /** Mettre à jour une slide. */
    public function update(Request $request, HeroSlide $heroSlide)
    {
        $data = $request->validate([
            'title'      => ['nullable', 'string', 'max:160'],
            'caption'    => ['nullable', 'string', 'max:255'],
            'image'      => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:8192'],
            'is_active'  => ['boolean'],
            'sort_order' => ['integer', 'min:0', 'max:99'],
        ]);

        $data['is_active']  = $request->boolean('is_active', true);
        $data['sort_order'] = (int) $request->input('sort_order', $heroSlide->sort_order);

        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si c'est un upload (pas un asset statique)
            if ($heroSlide->image_path && ! str_starts_with($heroSlide->image_path, 'images/')) {
                Storage::disk('public')->delete($heroSlide->image_path);
            }
            $data['image_path'] = $request->file('image')->store('hero', 'public');
        }
        unset($data['image']);

        $heroSlide->update($data);

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide mise à jour.');
    }

    /** Activer / désactiver en un clic (toggle AJAX-friendly). */
    public function toggle(HeroSlide $heroSlide)
    {
        $heroSlide->update(['is_active' => ! $heroSlide->is_active]);

        return redirect()->route('admin.hero.index')
            ->with('success', $heroSlide->is_active ? 'Slide activée.' : 'Slide masquée.');
    }

    /** Réordonner via drag-and-drop (POST JSON : [{id, order}, …]). */
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

    /** Supprimer une slide et son fichier. */
    public function destroy(HeroSlide $heroSlide)
    {
        if ($heroSlide->image_path && ! str_starts_with($heroSlide->image_path, 'images/')) {
            Storage::disk('public')->delete($heroSlide->image_path);
        }

        $heroSlide->delete();

        return redirect()->route('admin.hero.index')
            ->with('success', 'Slide supprimée du carrousel.');
    }

    /** Prochain sort_order disponible. */
    private function nextOrder(): int
    {
        return (HeroSlide::max('sort_order') ?? -1) + 1;
    }
}
