<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class AdminNewsImageController extends Controller
{
    /**
     * Upload multiple images for a news article
     */
    public function upload(Request $request, News $news)
    {
        $request->validate([
            'images.*' => ['required', 'image', 'max:4096'],
        ], [
            'images.*.required' => 'Une image est requise.',
            'images.*.image' => 'Le fichier doit être une image valide.',
            'images.*.max' => 'L\'image ne doit pas dépasser 4 MB.',
        ]);

        $position = $news->images()->max('position') ?? 0;

        foreach ($request->file('images') ?? [] as $image) {
            try {
                $path = $image->store('news', 'public');
                
                NewsImage::create([
                    'news_id'    => $news->id,
                    'image_path' => $path,
                    'position'   => ++$position,
                ]);
            } catch (\Throwable $e) {
                Log::error('Upload news image failed: ' . $e->getMessage());
                return back()->withInput()
                    ->withErrors(['images' => 'L\'image n\'a pas pu être sauvegardée : ' . $e->getMessage()]);
            }
        }

        return back()->with('success', 'Images uploadées avec succès.');
    }

    /**
     * Get image data (JSON response for editing modal)
     */
    public function show(NewsImage $newsImage)
    {
        return response()->json([
            'id'       => $newsImage->id,
            'alt_text' => $newsImage->alt_text,
            'caption'  => $newsImage->caption,
        ]);
    }

    /**
    public function update(Request $request, NewsImage $newsImage)
    {
        $request->validate([
            'alt_text' => ['nullable', 'string', 'max:255'],
            'caption'  => ['nullable', 'string', 'max:500'],
        ]);

        $newsImage->update([
            'alt_text' => $request->input('alt_text'),
            'caption'  => $request->input('caption'),
        ]);

        return back()->with('success', 'Image mise à jour.');
    }

    /**
     * Update image position (reorder)
     */
    public function reorder(Request $request, News $news)
    {
        $request->validate([
            'images' => ['required', 'array'],
            'images.*' => ['integer'],
        ]);

        $positions = $request->input('images');
        
        foreach ($positions as $position => $imageId) {
            NewsImage::where('id', $imageId)
                ->where('news_id', $news->id)
                ->update(['position' => $position]);
        }

        return response()->json(['success' => true, 'message' => 'Ordre mis à jour.']);
    }

    /**
     * Delete an image
     */
    public function destroy(NewsImage $newsImage)
    {
        $newsId = $newsImage->news_id;
        
        $newsImage->deleteFile();
        $newsImage->delete();

        return back()->with('success', 'Image supprimée.');
    }
}
