<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminJobApplicationController extends Controller
{
    public function index(Request $request)
    {
        $query = JobApplication::with('jobOffer')->latest();

        if ($jobId = $request->get('job')) {
            $query->where('job_offer_id', $jobId);
        }
        if ($status = $request->get('status')) {
            $query->where('status', $status);
        }

        $applications = $query->paginate(20);
        $jobs         = JobOffer::orderBy('title')->get();
        $statuses     = JobApplication::statusLabels();

        return view('admin.applications.index', compact('applications', 'jobs', 'statuses'));
    }

    public function show(JobApplication $application)
    {
        if (! $application->read_at) {
            $application->update(['read_at' => now()]);
        }

        return view('admin.applications.show', [
            'application' => $application->load('jobOffer'),
            'statuses'    => JobApplication::statusLabels(),
        ]);
    }

    public function downloadCv(JobApplication $application)
    {
        abort_unless($application->cv_path, 404);

        return response()->download(Storage::disk('private')->path($application->cv_path));
    }

    public function downloadCoverLetter(JobApplication $application)
    {
        abort_unless($application->cover_letter_path, 404);

        return response()->download(Storage::disk('private')->path($application->cover_letter_path));
    }

    public function updateStatus(Request $request, JobApplication $application)
    {
        $request->validate([
            'status'      => ['required', 'in:new,reviewing,interview,accepted,rejected'],
            'admin_notes' => ['nullable', 'string', 'max:2000'],
        ]);

        $application->update([
            'status'      => $request->status,
            'admin_notes' => $request->admin_notes,
        ]);

        return back()->with('success', 'Statut mis à jour.');
    }

    public function destroy(JobApplication $application)
    {
        // Supprimer les fichiers liés
        if ($application->cv_path) {
            Storage::disk('private')->delete($application->cv_path);
        }
        if ($application->cover_letter_path) {
            Storage::disk('private')->delete($application->cover_letter_path);
        }

        $application->delete();

        return redirect()->route('admin.applications.index')
            ->with('success', 'Candidature supprimée.');
    }
}
