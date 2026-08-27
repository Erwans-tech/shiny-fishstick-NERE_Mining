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
        $assets = $query->orderBy('sort_order')->paginate(20)->withQueryString();
        return view('admin.media.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.media.form', ['asset' => new MediaAsset()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate($this->mediaRules($request));
        $data['is_published'] = $request->boolean('is_published');
        $data['file_path'] = '';

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('media', 'public');
            $data['external_url'] = null;
        }
        unset($data['file']);

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
            if ($media->file_path) Storage::disk('public')->delete($media->file_path);
            $data['file_path'] = $request->file('file')->store('media', 'public');
            $data['external_url'] = null;
        }
        unset($data['file']);

        $media->update($data);

        return redirect()->route('admin.media.index')
            ->with('success', 'Média mis à jour.');
    }

    public function destroy(MediaAsset $media)
    {
        if ($media->file_path) Storage::disk('public')->delete($media->file_path);
        $media->delete();

        return redirect()->route('admin.media.index')
            ->with('success', 'Média supprimé.');
    }

    private function mediaRules(Request $request): array
    {
        return [
            'title'      => ['required', 'string', 'max:255'],
            'type'       => ['required', 'in:image,video,document,youtube,google_drive'],
            'caption'    => ['nullable', 'string'],
            'external_url' => [
                'nullable', 'required_if:type,youtube,google_drive', 'url', 'max:2048',
                function ($attribute, $value, $fail) use ($request) {
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
            'file'       => ['nullable', 'file', 'mimes:jpg,jpeg,png,webp,svg,mp4,mov,webm,pdf,doc,docx', 'max:20480'],
            'is_published' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ];
    }
}
