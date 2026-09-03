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
