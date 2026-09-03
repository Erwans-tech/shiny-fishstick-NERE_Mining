<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LeadershipMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminLeadershipController extends Controller
{
    public function index(Request $request)
    {
        $query = LeadershipMember::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('name', 'like', "%{$search}%")
                    ->orWhere('title', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%");
            });
        }

        $members = $query->orderBy('hierarchy_level')->orderBy('sort_order')->paginate(20)->withQueryString();
        return view('admin.leadership.index', compact('members'));
    }

    public function create()
    {
        return view('admin.leadership.form', ['member' => new LeadershipMember()]);
    }

    public function store(Request $request)
    {
        LeadershipMember::create($this->validated($request));
        return redirect()->route('admin.leadership.index')->with('success', 'Membre ajouté.');
    }

    public function edit(LeadershipMember $leadership)
    {
        return view('admin.leadership.form', ['member' => $leadership]);
    }

    public function update(Request $request, LeadershipMember $leadership)
    {
        $data = $this->validated($request, $leadership);
        $leadership->update($data);
        return redirect()->route('admin.leadership.index')->with('success', 'Membre mis à jour.');
    }

    public function destroy(LeadershipMember $leadership)
    {
        if ($leadership->photo_path) {
            Storage::disk(config('filesystems.default'))->delete($leadership->photo_path);
        }
        $leadership->delete();
        return redirect()->route('admin.leadership.index')->with('success', 'Membre supprimé.');
    }

    private function validated(Request $request, ?LeadershipMember $member = null): array
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'title' => ['required', 'string', 'max:255'],
            'department' => ['nullable', 'string', 'max:120'],
            'hierarchy_level' => ['required', 'integer', 'between:1,3'],
            'photo' => ['nullable', 'image', 'max:4096'],
            'is_published' => ['boolean'],
            'sort_order' => ['integer', 'min:0'],
        ]);
        $data['is_published'] = $request->boolean('is_published');

        if ($request->hasFile('photo')) {
            if ($member?->photo_path) {
                Storage::disk(config('filesystems.default'))->delete($member->photo_path);
            }
            $data['photo_path'] = $request->file('photo')->store('leadership', config('filesystems.default'));
        }
        unset($data['photo']);

        return $data;
    }
}
