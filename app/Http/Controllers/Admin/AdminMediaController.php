<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMediaController extends Controller
{
    public function index(Request $request)
    {
        $query = MediaAsset::query();
        
        // Charger la relation album seulement si la table existe
        try {
            $query->with('album');
        } catch (\Exception $e) {
            // Table photo_albums pas encore migrée
        }
        
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('type', 'like', "%{$search}%")
                    ->orWhere('caption', 'like', "%{$search}%");
            });
        }
        if (in_array($request->input('placement'), ['gallery', 'homepage_slideshow'], true)) {
            $query->where('placement', $request->input('placement'));
        }
        $assets = $query->orderBy('sort_order')->paginate(20)->withQueryString();
        return view('admin.media.index', compact('assets'));
    }

    public function create(Request $request)
    {
        $asset = new MediaAsset();
        if ($request->input('placement') === 'homepage_slideshow') {
            $asset->placement = 'homepage_slideshow';
        }

        return view('admin.media.form', ['asset' => $asset]);
    }

    /**
     * Formulaire d'upload multiple
     */
    public function createBulk()
    {
        try {
            $albums = \App\Models\PhotoAlbum::orderBy('title')->get();
        } catch (\Exception $e) {
            $albums = collect();
        }
        
        return view('admin.media.bulk-upload', compact('albums'));
    }

    /**
     * Upload multiple d'images
     */
    public function storeBulk(Request $request)
    {
        // Validation de base
        $request->validate([
            'files' => ['required', 'array', 'min:1', 'max:50'],
            'files.*' => ['required', 'image', 'mimes:jpg,jpeg,png,webp', 'max:10240'],
            'placement' => ['required', 'in:gallery,homepage_slideshow'],
        ]);

        // Valider album_id seulement si la table existe
        $albumId = null;
        if ($request->filled('album_id')) {
            try {
                $album = \App\Models\PhotoAlbum::find($request->input('album_id'));
                if ($album) {
                    $albumId = $album->id;
                }
            } catch (\Exception $e) {
                // Table photo_albums pas encore migrée
            }
        }

        $uploaded = 0;
        $errors = [];

        foreach ($request->file('files') as $index => $file) {
            try {
                $filePath = $file->store('media', config('filesystems.default'));
                $fileName = $file->getClientOriginalName();
                
                MediaAsset::create([
                    'title' => pathinfo($fileName, PATHINFO_FILENAME),
                    'type' => 'image',
                    'placement' => $request->input('placement'),
                    'album_id' => $albumId,
                    'file_path' => $filePath,
                    'is_published' => $request->boolean('is_published', true),
                    'sort_order' => 0,
                ]);
                
                $uploaded++;
            } catch (\Exception $e) {
                $errors[] = "Erreur pour {$file->getClientOriginalName()}: " . $e->getMessage();
            }
        }

        if ($uploaded > 0) {
            $message = "{$uploaded} image(s) ajoutée(s) avec succès.";
            if (count($errors) > 0) {
                $message .= " " . count($errors) . " erreur(s).";
            }
            return redirect()->route('admin.media.index')->with('success', $message);
        }

        return redirect()->back()->withErrors($errors)->withInput();
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->mediaRules($request));
        $data['is_published'] = $request->boolean('is_published');
        $data['file_path'] = '';

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('media', config('filesystems.default'));
            $data['external_url'] = null;
        }
        unset($data['file']);
        if (($data['placement'] ?? '') === 'homepage_slideshow') {
            $data['type'] = 'image';
            $data['external_url'] = null;
        }

        MediaAsset::create($data);

        return redirect()->route('admin.media.index')
            ->with('success', 'Média ajouté.');
    }

    public function edit(MediaAsset $media)
    {
        return view('admin.media.form', ['asset' => $media]);
    }

    public function update(Request $request, MediaAsset $media)
    {
        $data = $request->validate($this->mediaRules($request));
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('file')) {
            if ($media->file_path && ! str_starts_with($media->file_path, 'images/')) {
                Storage::disk(config('filesystems.default'))->delete($media->file_path);
            }
            $data['file_path'] = $request->file('file')->store('media', config('filesystems.default'));
            $data['external_url'] = null;
        }
        unset($data['file']);
        if (($data['placement'] ?? '') === 'homepage_slideshow') {
            $data['type'] = 'image';
            $data['external_url'] = null;
        }

        $media->update($data);

        return redirect()->route('admin.media.index')
            ->with('success', 'Média mis à jour.');
    }

    public function destroy(MediaAsset $media)
    {
        if ($media->file_path && ! str_starts_with($media->file_path, 'images/')) {
            Storage::disk(config('filesystems.default'))->delete($media->file_path);
        }
        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Média supprimé.');
    }

    /**
     * Suppression en masse
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => ['required', 'string'],
        ]);

        $ids = array_filter(explode(',', $request->input('ids')));
        
        if (empty($ids)) {
            return redirect()->route('admin.media.index')->with('error', 'Aucun média sélectionné.');
        }

        $deleted = 0;
        $errors = [];

        foreach ($ids as $id) {
            try {
                $media = MediaAsset::find($id);
                if ($media) {
                    // Supprimer le fichier physique
                    if ($media->file_path && ! str_starts_with($media->file_path, 'images/')) {
                        Storage::disk(config('filesystems.default'))->delete($media->file_path);
                    }
                    $media->delete();
                    $deleted++;
                }
            } catch (\Exception $e) {
                $errors[] = "Erreur ID {$id}: " . $e->getMessage();
            }
        }

        $message = "{$deleted} média(s) supprimé(s).";
        if (count($errors) > 0) {
            $message .= " " . count($errors) . " erreur(s).";
        }

        return redirect()->route('admin.media.index')->with('success', $message);
    }

    private function mediaRules(Request $request): array
    {
        $existing = $request->route('media');
        $isSlideshow = $request->input('placement') === 'homepage_slideshow';
        $needsFile = $isSlideshow && ! ($existing instanceof MediaAsset && $existing->file_path);

        return [
            'title'      => ['required', 'string', 'max:255'],
            'type'       => $isSlideshow
                ? ['required', 'in:image']
                : ['required', 'in:image,video,document,youtube,google_drive'],
            'placement'  => ['required', 'in:gallery,homepage_slideshow'],
            'album_id'   => ['nullable', 'exists:photo_albums,id'],
            'caption'    => ['nullable', 'string'],
            'external_url' => [
                $isSlideshow ? 'prohibited' : 'nullable',
                'required_if:type,youtube,google_drive',
                'url',
                'max:2048',
                function ($attribute, $value, $fail) use ($request, $isSlideshow) {
                    if ($isSlideshow || !$value) return;

                    $host = strtolower(parse_url($value, PHP_URL_HOST) ?: '');
                    $allowed = $request->input('type') === 'youtube'
                        ? ['youtube.com', 'www.youtube.com', 'm.youtube.com', 'youtu.be', 'www.youtu.be']
                        : ['drive.google.com', 'docs.google.com'];

                    if (!in_array($host, $allowed, true)) {
                        $fail($request->input('type') === 'youtube'
                            ? 'Le lien doit provenir de YouTube.'
                            : 'Le lien doit provenir de Google Drive.');
                    }
                },
            ],
            'file'       => [
                $needsFile ? 'required' : 'nullable',
                'file',
                $isSlideshow
                    ? 'mimes:jpg,jpeg,png,webp'
                    : 'mimes:jpg,jpeg,png,webp,svg,mp4,mov,webm,pdf,doc,docx',
                'max:20480',
            ],
            'is_published' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
