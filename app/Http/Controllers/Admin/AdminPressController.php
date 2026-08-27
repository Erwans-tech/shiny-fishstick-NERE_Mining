<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PressDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminPressController extends Controller
{
    public function index(Request $request)
    {
        $query = PressDocument::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('document_type', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            });
        }
        $documents = $query->latest('published_at')->paginate(15)->withQueryString();
        return view('admin.press.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.press.form', ['document' => new PressDocument()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:80'],
            'description'   => ['nullable', 'string'],
            'file'          => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:20480'],
            'published_at'  => ['nullable', 'date'],
        ]);

        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('press', 'public');
        } else {
            $data['file_path'] = '';
        }
        unset($data['file']);

        PressDocument::create($data);

        return redirect()->route('admin.press.index')
            ->with('success', 'Communiqué créé.');
    }

    public function edit(PressDocument $pressDocument)
    {
        return view('admin.press.form', ['document' => $pressDocument]);
    }

    public function update(Request $request, PressDocument $pressDocument)
    {
        $data = $request->validate([
            'title'         => ['required', 'string', 'max:255'],
            'document_type' => ['required', 'string', 'max:80'],
            'description'   => ['nullable', 'string'],
            'file'          => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:20480'],
            'published_at'  => ['nullable', 'date'],
        ]);

        if ($request->hasFile('file')) {
            if ($pressDocument->file_path) Storage::disk('public')->delete($pressDocument->file_path);
            $data['file_path'] = $request->file('file')->store('press', 'public');
        }
        unset($data['file']);

        $pressDocument->update($data);

        return redirect()->route('admin.press.index')
            ->with('success', 'Communiqué mis à jour.');
    }

    public function destroy(PressDocument $pressDocument)
    {
        if ($pressDocument->file_path) Storage::disk('public')->delete($pressDocument->file_path);
        $pressDocument->delete();

        return redirect()->route('admin.press.index')
            ->with('success', 'Communiqué supprimé.');
    }
}
