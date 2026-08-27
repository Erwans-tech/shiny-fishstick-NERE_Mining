<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminNewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
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
            'published_at' => ['nullable', 'date'],
        ], [
            'image.uploaded' => 'L’image n’a pas pu être envoyée. Vérifiez la taille du fichier et la limite PHP autorisée.',
        ]);

        if ($request->hasFile('image')) {
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }
        unset($data['image']);

        News::create($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Article créé avec succès.');
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
            'published_at' => ['nullable', 'date'],
        ], [
            'image.uploaded' => 'L’image n’a pas pu être envoyée. Vérifiez la taille du fichier et la limite PHP autorisée.',
        ]);

        if ($request->hasFile('image')) {
            if ($news->image_path) {
                Storage::disk('public')->delete($news->image_path);
            }
            $data['image_path'] = $request->file('image')->store('news', 'public');
        }
        unset($data['image']);

        $news->update($data);

        return redirect()->route('admin.news.index')
            ->with('success', 'Article mis à jour.');
    }

    public function destroy(News $news)
    {
        if ($news->image_path) {
            Storage::disk('public')->delete($news->image_path);
        }
        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Article supprimé.');
    }
}
