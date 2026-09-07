<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%");
            });
        }
        $news = $query->latest()->paginate(15)->withQueryString();
        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        return view('admin.news.form', ['news' => new News()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'max:80'],
            'excerpt'      => ['nullable', 'string', 'max:500'],
            'content'      => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'max:4096'],
            'gallery_images' => ['nullable', 'array', 'max:12'],
            'gallery_images.*' => ['image', 'max:4096'],
            'gallery' => ['nullable', 'array', 'max:12'],
            'gallery.*' => ['image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('image')) {
            try {
                $data['image_path'] = $request->file('image')->store('news', config('filesystems.default'));
            } catch (\Throwable $e) {
                Log::error('Upload image news echoue : ' . $e->getMessage());
                return back()->withInput()
                    ->withErrors(['image' => 'L\'image n\'a pas pu etre sauvegardee : ' . $e->getMessage()]);
            }
        }
        $data['gallery_images'] = $this->storeGalleryImages($request);
        unset($data['image']);

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Article cree avec succes.');
    }

    public function edit(News $news)
    {
        return view('admin.news.form', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $data = $request->validate([
            'title'        => ['required', 'string', 'max:255'],
            'category'     => ['required', 'string', 'max:80'],
            'excerpt'      => ['nullable', 'string', 'max:500'],
            'content'      => ['nullable', 'string'],
            'image'        => ['nullable', 'image', 'max:4096'],
            'gallery_images' => ['nullable', 'array', 'max:12'],
            'gallery_images.*' => ['image', 'max:4096'],
            'gallery' => ['nullable', 'array', 'max:12'],
            'gallery.*' => ['image', 'max:4096'],
            'published_at' => ['nullable', 'date'],
        ]);

        if ($request->hasFile('image')) {
            try {
                if ($news->image_path) {
                    Storage::disk(config('filesystems.default'))->delete($news->image_path);
                }
                $data['image_path'] = $request->file('image')->store('news', config('filesystems.default'));
            } catch (\Throwable $e) {
                Log::error('Upload image news update echoue : ' . $e->getMessage());
                return back()->withInput()
                    ->withErrors(['image' => 'L\'image n\'a pas pu etre sauvegardee : ' . $e->getMessage()]);
            }
        }
        $newGalleryImages = $this->storeGalleryImages($request);
        if ($newGalleryImages !== []) {
            $this->deleteGalleryImages($news->gallery_images ?? []);
            $data['gallery_images'] = $newGalleryImages;
        }
        unset($data['image']);

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Article mis a jour.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk(config('filesystems.default'))->delete($news->image_path);
        }
        $this->deleteGalleryImages($news->gallery_images ?? []);
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Article supprime.');
    }

    private function storeGalleryImages(Request $request): array
    {
        $paths = [];

        $images = array_merge(
            $request->file('gallery_images', []),
            $request->file('gallery', []),
        );

        foreach ($images as $image) {
            $paths[] = $image->store('news/gallery', config('filesystems.default'));
        }

        return $paths;
    }

    private function deleteGalleryImages(array $paths): void
    {
        foreach ($paths as $path) {
            if (is_string($path) && $path !== '') {
                Storage::disk(config('filesystems.default'))->delete($path);
            }
        }
    }
}
