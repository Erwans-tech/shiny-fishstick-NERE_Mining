<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsletterSubscriber;
use Illuminate\Http\Request;

class AdminNewsletterSubscriberController extends Controller
{
    /**
     * Afficher la liste des abonnés newsletter avec pagination et recherche
     */
    public function index(Request $request)
    {
        $query = NewsletterSubscriber::query();

        // Filtrage par email (recherche)
        if ($search = trim((string) $request->input('q'))) {
            $query->where('email', 'like', "%{$search}%");
        }

        // Tri par date (récents d'abord)
        $query->orderBy('subscribed_at', $request->input('sort') === 'oldest' ? 'asc' : 'desc');

        // Pagination : 50 abonnés par page
        $subscribers = $query->paginate(50)->withQueryString();
        $count = NewsletterSubscriber::count();

        return view('admin.newsletter.index', compact('subscribers', 'count'));
    }

    /**
     * Supprimer un abonné newsletter
     */
    public function destroy(NewsletterSubscriber $subscriber)
    {
        $email = $subscriber->email;
        $subscriber->delete();

        return redirect()->route('admin.newsletter.index')
            ->with('success', "L'abonné {$email} a été supprimé.");
    }

    /**
     * Exporter les abonnés newsletter en CSV (bonus)
     */
    public function export()
    {
        $subscribers = NewsletterSubscriber::select('email', 'subscribed_at')
            ->orderBy('subscribed_at', 'desc')
            ->get();

        $filename = 'newsletter-subscribers-' . date('Y-m-d-His') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv; charset=utf-8',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($subscribers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Email', 'Abonné le']);

            foreach ($subscribers as $sub) {
                fputcsv($file, [
                    $sub->email,
                    $sub->subscribed_at ? $sub->subscribed_at->format('d/m/Y H:i') : '—',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
