<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminVideoController extends Controller
{
    public function index()
    {
        $videos = Video::latest('video_date')->latest('id')->paginate(20);

        return view('admin.videos.index', compact('videos'));
    }

    public function create()
    {
        return view('admin.videos.form', ['video' => new Video(['video_date' => today(), 'is_published' => true])]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request, true);

        $data['video_path'] = $request->file('video')->store('site-videos', config('filesystems.default'));
        if ($request->hasFile('poster')) {
            $data['poster_path'] = $request->file('poster')->store('site-videos/posters', config('filesystems.default'));
        }
        unset($data['video'], $data['poster']);

        Video::create($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Vidéo ajoutée.');
    }

    public function edit(Video $video)
    {
        return view('admin.videos.form', compact('video'));
    }

    public function update(Request $request, Video $video)
    {
        $data = $this->validated($request, false);

        if ($request->hasFile('video')) {
            $this->deleteUpload($video, $video->video_path);
            $data['video_path'] = $request->file('video')->store('site-videos', config('filesystems.default'));
        }
        if ($request->hasFile('poster')) {
            $this->deleteUpload($video, $video->poster_path);
            $data['poster_path'] = $request->file('poster')->store('site-videos/posters', config('filesystems.default'));
        }
        unset($data['video'], $data['poster']);

        $video->update($data);

        return redirect()->route('admin.videos.index')
            ->with('success', 'Vidéo mise à jour.');
    }

    public function destroy(Video $video)
    {
        $this->deleteUpload($video, $video->video_path);
        $this->deleteUpload($video, $video->poster_path);
        $video->delete();

        return redirect()->route('admin.videos.index')
            ->with('success', 'Vidéo supprimée.');
    }

    private function validated(Request $request, bool $creating): array
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'title_en'     => ['nullable', 'string', 'max:255'],
            'video_date'   => ['required', 'date'],
            'is_published' => ['nullable', 'boolean'],
            'video'        => [$creating ? 'required' : 'nullable', 'file', 'mimetypes:video/mp4,video/webm', 'max:524288'],
            'poster'       => ['nullable', 'image', 'max:4096'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        return $data;
    }

    /** Files shipped in public/ (videos/…, images/…) are never deleted from here. */
    private function deleteUpload(Video $video, ?string $path): void
    {
        if ($path && $video->isUploaded($path)) {
            Storage::disk(config('filesystems.default'))->delete($path);
        }
    }
}
