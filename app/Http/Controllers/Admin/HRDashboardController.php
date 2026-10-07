<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobApplication;
use App\Models\ContactMessage;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class HRDashboardController extends Controller
{
    /**
     * Tableau de bord RH avec les candidatures et messages
     */
    public function index()
    {
        $stats = [
            'new_applications' => JobApplication::where('status', 'new')->count(),
            'total_applications' => JobApplication::count(),
            'new_messages' => ContactMessage::where('read_at', null)->count(),
            'total_messages' => ContactMessage::count(),
            'newsletter_subscribers' => NewsletterSubscriber::count(),
            'pending_reviews' => JobApplication::where('status', 'in_review')->count(),
        ];

        // Dernières candidatures
        $recent_applications = JobApplication::latest()->take(10)->get();

        // Derniers messages
        $recent_messages = ContactMessage::latest()->take(10)->get();

        return view('admin.hr.dashboard', compact('stats', 'recent_applications', 'recent_messages'));
    }

    /**
     * Affiche la liste des candidatures
     */
    public function applications()
    {
        $applications = JobApplication::with('jobOffer')
            ->latest()
            ->paginate(15);

        return view('admin.hr.applications', compact('applications'));
    }

    /**
     * Affiche les détails d'une candidature
     */
    public function applicationShow(JobApplication $application)
    {
        return view('admin.hr.application-show', compact('application'));
    }

    /**
     * Met à jour le statut d'une candidature
     */
    public function updateApplicationStatus(Request $request, JobApplication $application)
    {
        $validated = $request->validate([
            'status' => 'required|in:new,in_review,accepted,rejected',
        ]);

        $application->update($validated);

        return redirect()
            ->back()
            ->with('success', 'Statut de la candidature mis à jour.');
    }

    /**
     * Télécharge le CV d'une candidature
     */
    public function downloadCV(JobApplication $application)
    {
        if (!$application->cv_path || !file_exists(storage_path('app/' . $application->cv_path))) {
            return redirect()->back()->with('error', 'CV non disponible.');
        }

        return response()->download(storage_path('app/' . $application->cv_path));
    }

    /**
     * Affiche la liste des messages de contact
     */
    public function messages()
    {
        $messages = ContactMessage::latest()->paginate(15);

        return view('admin.hr.messages', compact('messages'));
    }

    /**
     * Affiche les détails d'un message
     */
    public function messageShow(ContactMessage $message)
    {
        // Marquer comme lu
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return view('admin.hr.message-show', compact('message'));
    }

    /**
     * Marque un message comme lu
     */
    public function markMessageAsRead(ContactMessage $message)
    {
        if (!$message->read_at) {
            $message->update(['read_at' => now()]);
        }

        return redirect()->back()->with('success', 'Message marqué comme lu.');
    }

    /**
     * Affiche la liste des abonnés newsletter
     */
    public function subscribers()
    {
        $subscribers = NewsletterSubscriber::latest()->paginate(15);

        return view('admin.hr.subscribers', compact('subscribers'));
    }

    /**
     * Exporte les candidatures en CSV
     */
    public function exportApplications()
    {
        $applications = JobApplication::with('jobOffer')->get();

        $csv = "Prénom,Nom,Email,Téléphone,Poste,Date de candidature,Statut\n";

        foreach ($applications as $app) {
            $csv .= "\"{$app->first_name}\",\"{$app->last_name}\",\"{$app->email}\",\"{$app->phone}\",\"{$app->jobOffer?->title}\",\"{$app->created_at->format('Y-m-d')}\",\"{$app->status}\"\n";
        }

        return response($csv)
            ->header('Content-Type', 'text/csv; charset=utf-8')
            ->header('Content-Disposition', 'attachment; filename="candidatures-' . now()->format('Y-m-d') . '.csv"');
    }
}
