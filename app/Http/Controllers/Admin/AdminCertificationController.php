<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certification;
use Illuminate\Http\Request;

class AdminCertificationController extends Controller
{
    public function index()
    {
        $certifications = Certification::orderBy('sort_order')->paginate(20);
        return view('admin.certifications.index', compact('certifications'));
    }

    public function create()
    {
        return view('admin.certifications.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:issued_at',
            'is_active' => 'boolean',
        ]);

        // Gérer le upload du logo
        $logoPath = null;
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('certifications', config('filesystems.default'));
        }

        // Retirer 'logo' du tableau validated car c'est un fichier, pas un champ DB
        unset($validated['logo']);
        $validated['is_active'] = $request->boolean('is_active');

        $certification = Certification::create([
            ...$validated,
            'logo_path' => $logoPath,
            'sort_order' => Certification::max('sort_order') + 1,
        ]);

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification créée.');
    }

    public function edit(Certification $certification)
    {
        return view('admin.certifications.edit', compact('certification'));
    }

    public function update(Request $request, Certification $certification)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'description' => 'nullable|string|max:500',
            'logo' => 'nullable|image|mimes:png,jpg,jpeg|max:2048',
            'issued_at' => 'nullable|date',
            'expires_at' => 'nullable|date|after_or_equal:issued_at',
            'is_active' => 'boolean',
        ]);

        // Gérer le upload du logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('certifications', config('filesystems.default'));
            $validated['logo_path'] = $logoPath;
        }

        // Retirer 'logo' du tableau validated car c'est un fichier, pas un champ DB
        unset($validated['logo']);
        $validated['is_active'] = $request->boolean('is_active');

        $certification->update($validated);

        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification mise à jour.');
    }

    public function destroy(Certification $certification)
    {
        $certification->delete();
        return redirect()->route('admin.certifications.index')
            ->with('success', 'Certification supprimée.');
    }

    /**
     * Réordonner les certifications (AJAX)
     */
    public function reorder(Request $request)
    {
        $order = $request->input('order', []);

        foreach ($order as $index => $id) {
            Certification::find($id)?->update(['sort_order' => $index]);
        }

        return response()->json(['success' => true]);
    }
}
