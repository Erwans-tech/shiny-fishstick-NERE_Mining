<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use Illuminate\Http\Request;

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        $query = JobOffer::query();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('contract_type', 'like', "%{$search}%");
            });
        }
        $jobs = $query->latest()->paginate(15)->withQueryString();
        return view('admin.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('admin.jobs.form', ['job' => new JobOffer()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'department'       => ['required', 'string', 'max:120'],
            'location'         => ['required', 'string', 'max:120'],
            'contract_type'    => ['required', 'string', 'max:80'],
            'experience_level' => ['nullable', 'string', 'max:80'],
            'salary_range'     => ['nullable', 'string', 'max:120'],
            'description'      => ['required', 'string'],
            'requirements'     => ['nullable', 'string'],
            'deadline'         => ['nullable', 'date'],
            'is_published'     => ['boolean'],
            'is_spontaneous'   => ['boolean'],
        ]);
        $data['is_published']   = $request->boolean('is_published');
        $data['is_spontaneous'] = $request->boolean('is_spontaneous');

        JobOffer::create($data);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Offre créée.');
    }

    public function edit(JobOffer $job)
    {
        return view('admin.jobs.form', compact('job'));
    }

    public function update(Request $request, JobOffer $job)
    {
        $data = $request->validate([
            'title'            => ['required', 'string', 'max:255'],
            'department'       => ['required', 'string', 'max:120'],
            'location'         => ['required', 'string', 'max:120'],
            'contract_type'    => ['required', 'string', 'max:80'],
            'experience_level' => ['nullable', 'string', 'max:80'],
            'salary_range'     => ['nullable', 'string', 'max:120'],
            'description'      => ['required', 'string'],
            'requirements'     => ['nullable', 'string'],
            'deadline'         => ['nullable', 'date'],
            'is_published'     => ['boolean'],
            'is_spontaneous'   => ['boolean'],
        ]);
        $data['is_published']   = $request->boolean('is_published');
        $data['is_spontaneous'] = $request->boolean('is_spontaneous');

        $job->update($data);

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Offre mise à jour.');
    }

    public function destroy(JobOffer $job)
    {
        $job->delete();
        return redirect()->route('admin.jobs.index')
            ->with('success', 'Offre supprimée.');
    }
}
