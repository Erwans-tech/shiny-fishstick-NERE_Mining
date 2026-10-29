<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminJobController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->input('status') === 'archived' ? 'archived' : 'current';
        $query  = $status === 'archived' ? JobOffer::archived() : JobOffer::notArchived();
        if ($search = trim((string) $request->input('q'))) {
            $query->where(function ($query) use ($search) {
                $query->where('title', 'like', "%{$search}%")
                    ->orWhere('department', 'like', "%{$search}%")
                    ->orWhere('location', 'like', "%{$search}%")
                    ->orWhere('contract_type', 'like', "%{$search}%");
            });
        }
        $jobs = $query->latest()->paginate(15)->withQueryString();
        $counts = [
            'current'  => JobOffer::notArchived()->count(),
            'archived' => JobOffer::archived()->count(),
        ];
        return view('admin.jobs.index', compact('jobs', 'status', 'counts'));
    }

    public function create()
    {
        return view('admin.jobs.form', ['job' => new JobOffer()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'      => ['required', 'string', 'max:255'],
            'deadline'   => ['required', 'date', 'after_or_equal:today'],
            'offer_file' => ['required', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ]);

        $filePath = $request->file('offer_file')->store('job-offers', 'public');
        if ($filePath === false) {
            throw new \RuntimeException('Impossible d’enregistrer le document de l’offre d’emploi.');
        }

        JobOffer::create([
            'title'           => $data['title'],
            'offer_file_path' => $filePath,
            'deadline'        => $data['deadline'],
            'is_published'    => true,
        ]);

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
            'title'      => ['required', 'string', 'max:255'],
            // L'offre de candidature spontanée reste permanente, sans date limite
            'deadline'   => [$job->is_spontaneous ? 'nullable' : 'required', 'date'],
            'offer_file' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:10240'],
        ]);

        $oldFilePath = $job->offer_file_path;
        $job->title    = $data['title'];
        $job->deadline = $data['deadline'] ?? null;

        if ($request->hasFile('offer_file')) {
            $filePath = $request->file('offer_file')->store('job-offers', 'public');
            if ($filePath === false) {
                throw new \RuntimeException('Impossible d’enregistrer le document de l’offre d’emploi.');
            }

            $job->offer_file_path = $filePath;
        }

        $job->save();

        if ($job->offer_file_path !== $oldFilePath && $oldFilePath) {
            Storage::disk('public')->delete($oldFilePath);
        }

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Offre mise à jour.');
    }

    public function destroy(JobOffer $job)
    {
        $filePath = $job->offer_file_path;
        $job->delete();

        if ($filePath) {
            Storage::disk('public')->delete($filePath);
        }

        return redirect()->route('admin.jobs.index')
            ->with('success', 'Offre supprimée.');
    }
}
