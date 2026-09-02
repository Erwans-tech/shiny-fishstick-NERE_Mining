<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPartnerController extends Controller
{
    public function index(Request $request)
    {
        $query = Partner::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('category', 'like', "%{$search}%")
                    ->orWhere('website_url', 'like', "%{$search}%");
            });
        }
        $partners = $query->orderBy('sort_order')->paginate(20)->withQueryString();
        return view('admin.partners.index', compact('partners'));
    }

    public function create()
    {
        return view('admin.partners.form', ['partner' => new Partner()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['nullable', 'string', 'max:80'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo'        => ['nullable', 'image', 'max:2048'],
            'is_published'=> ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('logo')) {
            $data['logo_path'] = $request->file('logo')->store('partners', config('filesystems.default'));
        }
        unset($data['logo']);

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire ajouté.');
    }

    public function edit(Partner $partner)
    {
        return view('admin.partners.form', compact('partner'));
    }

    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'        => ['required', 'string', 'max:255'],
            'category'    => ['nullable', 'string', 'max:80'],
            'website_url' => ['nullable', 'url', 'max:255'],
            'logo'        => ['nullable', 'image', 'max:2048'],
            'is_published'=> ['boolean'],
            'sort_order'  => ['integer', 'min:0'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('logo')) {
            if ($partner->logo_path && !str_starts_with($partner->logo_path, 'images/')) {
                Storage::disk(config('filesystems.default'))->delete($partner->logo_path);
            }
            $data['logo_path'] = $request->file('logo')->store('partners', config('filesystems.default'));
        }
        unset($data['logo']);

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire mis à jour.');
    }

    public function destroy(Partner $partner)
    {
        if ($partner->logo_path && !str_starts_with($partner->logo_path, 'images/')) {
                Storage::disk(config('filesystems.default'))->delete($partner->logo_path);
        }
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partenaire supprimé.');
    }
}
