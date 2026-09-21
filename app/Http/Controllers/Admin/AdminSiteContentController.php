<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SiteContent;
use Illuminate\Http\Request;

class AdminSiteContentController extends Controller
{
    public function index()
    {
        return view('admin.site-content.index', [
            'contents' => SiteContent::orderBy('section')->orderBy('sort_order')->orderBy('id')->get(),
        ]);
    }

    public function store(Request $request)
    {
        SiteContent::create($this->validated($request));
        return back()->with('success', 'Contenu ajouté.');
    }

    public function update(Request $request, SiteContent $siteContent)
    {
        $siteContent->update($this->validated($request));
        return back()->with('success', 'Contenu mis à jour.');
    }

    public function destroy(SiteContent $siteContent)
    {
        $siteContent->delete();
        return back()->with('success', 'Contenu supprimé.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'section' => ['required', 'in:home_stats,karma_stats,sustainability_stats,history,karma_history'],
            'key' => ['required', 'string', 'max:80'],
            'label_fr' => ['required', 'string', 'max:255'],
            'label_en' => ['nullable', 'string', 'max:255'],
            'value_fr' => ['nullable', 'string', 'max:5000'],
            'value_en' => ['nullable', 'string', 'max:5000'],
            'icon' => ['nullable', 'string', 'max:20'],
            'suffix' => ['nullable', 'string', 'max:30'],
            'sort_order' => ['required', 'integer', 'min:0', 'max:9999'],
            'is_published' => ['nullable', 'boolean'],
        ]) + ['is_published' => $request->boolean('is_published')];
    }
}
