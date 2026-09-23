<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PhotoAlbum;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPhotoAlbumController extends Controller
{
    /**
     * Liste des albums
     */
    public function index(Request $request)
    {
        $query = PhotoAlbum::withCount('media');

        // Recherche
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
            });
        }

        $albums = $query->orderBy('sort_order')->orderBy('created_at', 'desc')->paginate(20)->withQueryString();

        return view('admin.albums.index', compact('albums'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $album = new PhotoAlbum();
        return view('admin.albums.form', compact('album'));
    }

    /**
     * Enregistrer un nouvel album
     */
    public function store(Request $request)
    {
        $data = $request->validate($this->rules());
        $data['is_published'] = $request->boolean('is_published');

        // Upload de l'image de couverture
        if ($request->hasFile('cover_image_file')) {
            $data['cover_image'] = $request->file('cover_image_file')->store('albums', config('filesystems.default'));
        }
        unset($data['cover_image_file']);

        PhotoAlbum::create($data);

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album créé avec succès.');
    }

    /**
     * Formulaire d'édition
     */
    public function edit(PhotoAlbum $album)
    {
        $album->loadCount('media');
        return view('admin.albums.form', compact('album'));
    }

    /**
     * Mettre à jour un album
     */
    public function update(Request $request, PhotoAlbum $album)
    {
        $data = $request->validate($this->rules());
        $data['is_published'] = $request->boolean('is_published');

        // Upload de la nouvelle image de couverture
        if ($request->hasFile('cover_image_file')) {
            // Supprimer l'ancienne image
            if ($album->cover_image && !str_starts_with($album->cover_image, 'images/')) {
                Storage::disk(config('filesystems.default'))->delete($album->cover_image);
            }
            $data['cover_image'] = $request->file('cover_image_file')->store('albums', config('filesystems.default'));
        }
        unset($data['cover_image_file']);

        $album->update($data);

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album mis à jour avec succès.');
    }

    /**
     * Supprimer un album
     */
    public function destroy(PhotoAlbum $album)
    {
        // Détacher les médias (on met album_id à null au lieu de supprimer les médias)
        $album->media()->update(['album_id' => null]);

        // Supprimer l'image de couverture
        if ($album->cover_image && !str_starts_with($album->cover_image, 'images/')) {
            Storage::disk(config('filesystems.default'))->delete($album->cover_image);
        }

        $album->delete();

        return redirect()->route('admin.albums.index')
            ->with('success', 'Album supprimé avec succès.');
    }

    /**
     * Voir les médias d'un album
     */
    public function show(PhotoAlbum $album)
    {
        $album->load(['media' => function ($query) {
            $query->orderBy('sort_order')->orderBy('created_at', 'desc');
        }]);

        return view('admin.albums.show', compact('album'));
    }

    /**
     * Règles de validation
     */
    private function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:1000'],
            'cover_image_file' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:5120'],
            'is_published' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
