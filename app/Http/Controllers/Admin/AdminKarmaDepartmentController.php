<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KarmaDepartment;
use Illuminate\Http\Request;

class AdminKarmaDepartmentController extends Controller
{
    public function index(Request $request)
    {
        $query = KarmaDepartment::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title_fr', 'like', "%{$search}%")
                    ->orWhere('title_en', 'like', "%{$search}%")
                    ->orWhere('tag_fr', 'like', "%{$search}%")
                    ->orWhere('tag_en', 'like', "%{$search}%");
            });
        }

        $departments = $query->orderBy('sort_order')->paginate(20)->withQueryString();

        return view('admin.karma-departments.index', compact('departments'));
    }

    public function create()
    {
        return view('admin.karma-departments.form', [
            'department' => new KarmaDepartment([
                'is_published' => true,
                'sort_order'   => (int) KarmaDepartment::max('sort_order') + 1,
            ]),
        ]);
    }

    public function store(Request $request)
    {
        KarmaDepartment::create($this->validated($request));

        return redirect()->route('admin.karma-departments.index')
            ->with('success', 'Département ajouté à l’organigramme.');
    }

    public function edit(KarmaDepartment $karmaDepartment)
    {
        return view('admin.karma-departments.form', [
            'department' => $karmaDepartment,
        ]);
    }

    public function update(Request $request, KarmaDepartment $karmaDepartment)
    {
        $karmaDepartment->update($this->validated($request));

        return redirect()->route('admin.karma-departments.index')
            ->with('success', 'Département mis à jour.');
    }

    public function destroy(KarmaDepartment $karmaDepartment)
    {
        $karmaDepartment->delete();

        return redirect()->route('admin.karma-departments.index')
            ->with('success', 'Département retiré de l’organigramme.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'tag_fr'       => ['required', 'string', 'max:80'],
            'tag_en'       => ['required', 'string', 'max:80'],
            'title_fr'     => ['required', 'string', 'max:255'],
            'title_en'     => ['required', 'string', 'max:255'],
            'body_fr'      => ['required', 'string'],
            'body_en'      => ['required', 'string'],
            'sort_order'   => ['integer', 'min:0'],
            'is_published' => ['boolean'],
        ]);
        $data['is_published'] = $request->boolean('is_published');
        $data['sort_order'] = (int) ($data['sort_order'] ?? 0);

        return $data;
    }
}
