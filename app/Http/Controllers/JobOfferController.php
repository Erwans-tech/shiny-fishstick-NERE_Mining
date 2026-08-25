<?php

namespace App\Http\Controllers;

use App\Models\JobApplication;
use App\Models\JobOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class JobOfferController extends Controller
{
    /* ── Liste des offres (FR) ── */
    public function index(Request $request)
    {
        App::setLocale('fr');
        return $this->renderIndex('fr', $request);
    }

    /* ── Liste des offres (EN) ── */
    public function indexEn(Request $request)
    {
        App::setLocale('en');
        return $this->renderIndex('en', $request);
    }

    /* ── Détail d'une offre normale (FR) ── */
    public function show(JobOffer $job)
    {
        // Bloquer l'accès direct à la page détail d'une offre spontanée
        abort_if($job->is_spontaneous || ! $job->is_published, 404);
        App::setLocale('fr');
        return view('careers.show', ['locale' => 'fr', 'job' => $job]);
    }

    /* ── Détail d'une offre normale (EN) ── */
    public function showEn(JobOffer $job)
    {
        abort_if($job->is_spontaneous || ! $job->is_published, 404);
        App::setLocale('en');
        return view('careers.show', ['locale' => 'en', 'job' => $job]);
    }

    /* ── Page candidature spontanée (FR) ── */
    public function spontaneous()
    {
        App::setLocale('fr');
        $offer = JobOffer::spontaneous()->first();
        return view('careers.spontaneous', ['locale' => 'fr', 'offer' => $offer]);
    }

    /* ── Page candidature spontanée (EN) ── */
    public function spontaneousEn()
    {
        App::setLocale('en');
        $offer = JobOffer::spontaneous()->first();
        return view('careers.spontaneous', ['locale' => 'en', 'offer' => $offer]);
    }

    /* ── Soumettre une candidature pour une offre normale ── */
    public function apply(Request $request, JobOffer $job)
    {
        abort_if($job->is_spontaneous || ! $job->is_published, 404);
        $locale = $request->input('locale', 'fr');
        App::setLocale($locale);
        return $this->storeApplication($request, $job, $locale);
    }

    /* ── Soumettre une candidature spontanée ── */
    public function applySpontaneous(Request $request)
    {
        $locale = $request->input('locale', 'fr');
        App::setLocale($locale);

        // Récupérer ou créer l'offre spontanée de référence
        $offer = JobOffer::spontaneous()->first();

        if (! $offer) {
            // Créer une offre spontanée par défaut si elle n'existe pas
            $offer = JobOffer::create([
                'title'          => 'Candidature spontanée',
                'slug'           => 'candidature-spontanee',
                'department'     => 'Talents',
                'location'       => 'Burkina Faso',
                'contract_type'  => 'Selon profil',
                'description'    => 'Candidature spontanée',
                'is_published'   => true,
                'is_spontaneous' => true,
            ]);
        }

        return $this->storeApplication($request, $offer, $locale);
    }

    /* ── Logique commune de sauvegarde ── */
    private function storeApplication(Request $request, JobOffer $job, string $locale): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'first_name'        => ['required', 'string', 'max:80'],
            'last_name'         => ['required', 'string', 'max:80'],
            'email'             => ['required', 'email', 'max:180'],
            'phone'             => ['nullable', 'string', 'max:40'],
            'nationality'       => ['nullable', 'string', 'max:80'],
            'current_position'  => ['nullable', 'string', 'max:160'],
            'experience_years'  => ['nullable', 'string', 'max:40'],
            'motivation'        => ['required', 'string', 'max:5000'],
            'cv'                => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
            'cover_letter_file' => ['nullable', 'file', 'mimes:pdf,doc,docx', 'max:5120'],
        ]);

        $data['job_offer_id'] = $job->id;

        if ($request->hasFile('cv')) {
            $data['cv_path'] = $request->file('cv')->store('applications/cv', 'public');
        }
        if ($request->hasFile('cover_letter_file')) {
            $data['cover_letter_path'] = $request->file('cover_letter_file')
                ->store('applications/cover', 'public');
        }

        unset($data['cv'], $data['cover_letter_file'], $data['locale']);

        JobApplication::create($data);

        // Redirection après candidature spontanée → retour sur la page dédiée
        if ($job->is_spontaneous) {
            $route = $locale === 'en'
                ? route('english.spontaneous')
                : route('spontaneous');
        } else {
            $route = $locale === 'en'
                ? route('english.jobs.show', $job)
                : route('jobs.show', $job);
        }

        return redirect($route)->with('apply_success', __('site.careers_apply_success'));
    }

    /* ── Helper rendu liste ── */
    private function renderIndex(string $locale, Request $request)
    {
        $query = JobOffer::open()->latest();

        if ($dept = $request->get('dept')) {
            $query->where('department', $dept);
        }
        if ($type = $request->get('type')) {
            $query->where('contract_type', $type);
        }
        if ($level = $request->get('level')) {
            $query->where('experience_level', $level);
        }

        $jobs          = $query->get();
        $departments   = JobOffer::open()->distinct()->orderBy('department')->pluck('department')->filter()->values();
        $contractTypes = JobOffer::open()->distinct()->orderBy('contract_type')->pluck('contract_type')->filter()->values();

        return view('careers.index', compact('jobs', 'departments', 'contractTypes'))
            ->with('locale', $locale);
    }
}
