<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminMediaController extends Controller
{
    public function index()
    {
        $assets = MediaAsset::orderBy('sort_order')->paginate(20);
        return view('admin.media.index', compact('assets'));
    }

    public function create()
    {
        return view('admin.media.form', ['asset' => new MediaAsset()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'type'         => ['required', 'in:image,video,document'],
            'caption'      => ['nullable', 'string'],
            'file'         => ['nullable', 'file', 'max:20480'],
            'is_published' => ['boolean'],
            'sort_order'   => ['integer', 'min:0'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('media', 'public');
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
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'type'         => ['required', 'in:image,video,document'],
            'caption'      => ['nullable', 'string'],
            'file'         => ['nullable', 'file', 'max:20480'],
            'is_published' => ['boolean'],
            'sort_order'   => ['integer', 'min:0'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('file')) {
            if ($media->file_path) Storage::disk('public')->delete($media->file_path);
            $data['file_path'] = $request->file('file')->store('media', 'public');
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
}
