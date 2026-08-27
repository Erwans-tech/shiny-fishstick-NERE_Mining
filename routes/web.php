<?php

use App\Models\News;
use App\Models\ContactMessage;
use App\Models\JobOffer;
use App\Models\MediaAsset;
use App\Models\NewsletterSubscriber;
use App\Models\Partner;
use App\Models\PressDocument;
use App\Models\Report;
use App\Http\Controllers\JobOfferController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\ReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Helpers
|--------------------------------------------------------------------------
*/

/**
 * Set locale then render the home view with fresh data.
 */
$homeHandler = function (string $locale) {
    App::setLocale($locale);

    $news = News::published()
        ->latest('published_at')
        ->take(3)
        ->get()
        ->map(fn(News $item) => [
            'date'     => $item->published_at->translatedFormat('d M Y'),
            'category' => $item->category,
            'title'    => $item->title,
            'image'    => $item->image_path
                            ? asset('uploads/' . $item->image_path)
                            : null,
        ]);

    $partners = Partner::where('is_published', true)->orderBy('sort_order')->get();

    // Slides du carrousel hero — fallback sur les images statiques si table vide
    $slides = HeroSlide::active()->get();

    $statsLabels = $locale === 'en'
        ? ['Annual gold production', 'Direct and indirect jobs', 'National workforce', 'Fiscal & social contributions']
        : ["Production annuelle d'or", 'Emplois directs et indirects', "Main-d'œuvre nationale", 'Retombées fiscales & contributions'];

    return view('home', [
        'locale'   => $locale,
        'stats'    => [
            ['value' => '80000', 'suffix' => ' oz',      'label' => $statsLabels[0]],
            ['value' => '1200',  'suffix' => '+',         'label' => $statsLabels[1]],
            ['value' => '80',    'suffix' => '%',         'label' => $statsLabels[2]],
            ['value' => '18',    'suffix' => ' Mrd CFA',  'label' => $statsLabels[3]],
        ],
        'news'     => $news,
        'partners' => $partners,
        'slides'   => $slides,
    ]);
};

/**
 * Set locale then render the generic page view.
 */
$page = function (string $locale, string $section, array $extra = []) {
    App::setLocale($locale);
    return view('page', array_merge([
        'locale'  => $locale,
        'section' => $section,
        'reports' => $section === 'reports' ? Report::published()->latest('published_at')->get() : collect(),
        'jobs'    => $section === 'careers'  ? JobOffer::open()->latest()->get()                : collect(),
    ], $extra));
};

/*
|--------------------------------------------------------------------------
| French routes
|--------------------------------------------------------------------------
*/
Route::get('/', fn() => $homeHandler('fr'))->name('home');

Route::get('/qui-sommes-nous',              fn() => $page('fr', 'company'))->name('company');
Route::get('/qui-sommes-nous/mot-du-pdg',  fn() => $page('fr', 'company-ceo'))->name('company.ceo');
Route::get('/qui-sommes-nous/identite',    fn() => $page('fr', 'company-identity'))->name('company.identity');
Route::get('/qui-sommes-nous/histoire',    fn() => $page('fr', 'company-history'))->name('company.history');
Route::get('/qui-sommes-nous/valeurs',     fn() => $page('fr', 'company-values'))->name('company.values');
Route::get('/qui-sommes-nous/gouvernance', fn() => $page('fr', 'company-governance'))->name('company.governance');
Route::get('/karma',                        fn() => $page('fr', 'karma'))->name('karma');
Route::get('/ressources',                   fn() => $page('fr', 'resources'))->name('resources');
Route::get('/reserves',                     fn() => $page('fr', 'reserves'))->name('reserves');
Route::get('/projets',                      fn() => $page('fr', 'projects'))->name('projects');
Route::get('/projets/projet-cil',           fn() => $page('fr', 'cil-project'))->name('projects.cil');
Route::get('/developpement-durable',        fn() => $page('fr', 'sustainability'))->name('sustainability');
Route::get('/developpement-durable/communautes',   fn() => $page('fr', 'communities'))->name('sustainability.communities');
Route::get('/developpement-durable/environnement', fn() => $page('fr', 'environment'))->name('sustainability.environment');
Route::get('/developpement-durable/sante-securite',fn() => $page('fr', 'hse'))->name('sustainability.hse');
Route::get('/developpement-durable/contenu-local', fn() => $page('fr', 'local-content'))->name('sustainability.local-content');

Route::get('/actualites',         [NewsController::class, 'index'])->name('news.index');
Route::get('/actualites/{news}',  [NewsController::class, 'show'])->name('news.show');

Route::get('/mediatheque', function () {
    App::setLocale('fr');
    return view('resources', [
        'locale'    => 'fr',
        'section'   => 'gallery',
        'partners'  => collect(),
        'media'     => MediaAsset::gallery()->get(),
        'documents' => collect(),
    ]);
})->name('gallery');

Route::get('/communiques', function () {
    App::setLocale('fr');
    return view('resources', [
        'locale'    => 'fr',
        'section'   => 'press',
        'partners'  => collect(),
        'media'     => collect(),
        'documents' => PressDocument::whereNotNull('published_at')->latest('published_at')->get(),
    ]);
})->name('press');

Route::get('/contact-presse', fn() => $page('fr', 'press-contact'))->name('press.contact');
Route::get('/publications',   [ReportController::class, 'index'])->name('reports.public');
Route::get('/rapports',       fn() => $page('fr', 'reports'))->name('reports');

Route::get('/partenaires', function () {
    App::setLocale('fr');
    return view('resources', [
        'locale'    => 'fr',
        'section'   => 'partners',
        'partners'  => Partner::where('is_published', true)->orderBy('sort_order')->get(),
        'media'     => collect(),
        'documents' => collect(),
    ]);
})->name('partners');

Route::get('/carrieres',                  [JobOfferController::class, 'index'])->name('careers');
Route::get('/offres-emploi',              [JobOfferController::class, 'index'])->name('jobs.index');
Route::get('/offres-emploi/{job:slug}',   [JobOfferController::class, 'show'])->name('jobs.show');
Route::post('/offres-emploi/{job:slug}/postuler', [JobOfferController::class, 'apply'])->name('jobs.apply');
Route::get('/candidature-spontanee',     [JobOfferController::class, 'spontaneous'])->name('spontaneous');
Route::post('/candidature-spontanee',    [JobOfferController::class, 'applySpontaneous'])->name('spontaneous.apply');
Route::get('/contact',       fn() => $page('fr', 'contact'))->name('contact');

/* Legacy FR redirects */
Route::get('/entreprise',     fn() => redirect()->route('company', status: 301));
Route::get('/rapports-publics', fn() => redirect()->route('reports.public', status: 301));
Route::get('/presse',         fn() => redirect()->route('press', status: 301));
Route::get('/galerie',        fn() => redirect()->route('gallery', status: 301));

/*
|--------------------------------------------------------------------------
| English routes  /en/...
|--------------------------------------------------------------------------
*/
Route::get('/en', fn() => $homeHandler('en'))->name('english');

Route::get('/en/about',              fn() => $page('en', 'company'))->name('english.company');
Route::get('/en/about/ceo-message', fn() => $page('en', 'company-ceo'))->name('english.company.ceo');
Route::get('/en/about/identity',    fn() => $page('en', 'company-identity'))->name('english.company.identity');
Route::get('/en/about/history',     fn() => $page('en', 'company-history'))->name('english.company.history');
Route::get('/en/about/values',      fn() => $page('en', 'company-values'))->name('english.company.values');
Route::get('/en/about/governance',  fn() => $page('en', 'company-governance'))->name('english.company.governance');
Route::get('/en/karma',              fn() => $page('en', 'karma'))->name('english.karma');
Route::get('/en/resources',           fn() => $page('en', 'resources'))->name('english.resources');
Route::get('/en/reserves',             fn() => $page('en', 'reserves'))->name('english.reserves');
Route::get('/en/projects',           fn() => $page('en', 'projects'))->name('english.projects');
Route::get('/en/projects/cil-project', fn() => $page('en', 'cil-project'))->name('english.projects.cil');
Route::get('/en/sustainability',                       fn() => $page('en', 'sustainability'))->name('english.sustainability');
Route::get('/en/sustainability/communities',    fn() => $page('en', 'communities'))->name('english.communities');
Route::get('/en/sustainability/environment',    fn() => $page('en', 'environment'))->name('english.environment');
Route::get('/en/sustainability/health-safety',  fn() => $page('en', 'hse'))->name('english.hse');
Route::get('/en/sustainability/local-content',  fn() => $page('en', 'local-content'))->name('english.local-content');

Route::get('/en/news',       [NewsController::class, 'indexEn'])->name('english.news');
Route::get('/en/news/{news}', [NewsController::class, 'showEn'])->name('english.news.show');

Route::get('/en/media', function () {
    App::setLocale('en');
    return view('resources', [
        'locale'    => 'en',
        'section'   => 'gallery',
        'partners'  => collect(),
        'media'     => MediaAsset::gallery()->get(),
        'documents' => collect(),
    ]);
})->name('english.gallery');

Route::get('/en/press-releases', function () {
    App::setLocale('en');
    return view('resources', [
        'locale'    => 'en',
        'section'   => 'press',
        'partners'  => collect(),
        'media'     => collect(),
        'documents' => PressDocument::whereNotNull('published_at')->latest('published_at')->get(),
    ]);
})->name('english.press');

Route::get('/en/press-contact', fn() => $page('en', 'press-contact'))->name('english.press.contact');
Route::get('/en/publications',  [ReportController::class, 'indexEn'])->name('english.reports');

Route::get('/en/careers',                 [JobOfferController::class, 'indexEn'])->name('english.careers');
Route::get('/en/jobs/{job:slug}',         [JobOfferController::class, 'showEn'])->name('english.jobs.show');
Route::post('/en/jobs/{job:slug}/apply',  [JobOfferController::class, 'apply'])->name('english.jobs.apply');
Route::get('/en/spontaneous-application',  [JobOfferController::class, 'spontaneousEn'])->name('english.spontaneous');
Route::post('/en/spontaneous-application', [JobOfferController::class, 'applySpontaneous'])->name('english.spontaneous.apply');
Route::get('/en/contact',    fn() => $page('en', 'contact'))->name('english.contact');

/* Legacy EN redirects */
Route::get('/en/company',  fn() => redirect()->route('english.company', status: 301));
Route::get('/en/reports',  fn() => redirect()->route('english.reports', status: 301));

/*
|--------------------------------------------------------------------------
| Forms (POST) — locale-aware responses
|--------------------------------------------------------------------------
*/
Route::post('/newsletter', function (Request $request) {
    $request->validate(['email' => ['required', 'email', 'max:180']]);
    NewsletterSubscriber::firstOrCreate(
        ['email' => strtolower(trim($request->string('email')->toString()))],
        ['subscribed_at' => now()],
    );
    $msg = App::getLocale() === 'en'
        ? 'Thank you. Your newsletter subscription is confirmed.'
        : 'Merci. Votre inscription à la newsletter est confirmée.';
    return back()->with('success', $msg);
})->name('newsletter.store');

Route::post('/en/newsletter', function (Request $request) {
    App::setLocale('en');
    $request->validate(['email' => ['required', 'email', 'max:180']]);
    NewsletterSubscriber::firstOrCreate(
        ['email' => strtolower(trim($request->string('email')->toString()))],
        ['subscribed_at' => now()],
    );
    return back()->with('success', 'Thank you. Your newsletter subscription is confirmed.');
})->name('english.newsletter.store');

Route::post('/contact', function (Request $request) {
    $data = $request->validate([
        'name'    => ['required', 'string', 'max:120'],
        'email'   => ['required', 'email', 'max:180'],
        'subject' => ['nullable', 'string', 'max:180'],
        'message' => ['required', 'string', 'max:5000'],
        'type'    => ['required', 'string', 'max:60'],
    ]);
    ContactMessage::create($data);
    $msg = App::getLocale() === 'en'
        ? 'Your message has been received. Our team will reply shortly.'
        : 'Votre message a bien été enregistré. Notre équipe vous répondra prochainement.';
    return redirect()->back()->with('success', $msg);
})->name('contact.store');

Route::post('/en/contact', function (Request $request) {
    App::setLocale('en');
    $data = $request->validate([
        'name'    => ['required', 'string', 'max:120'],
        'email'   => ['required', 'email', 'max:180'],
        'subject' => ['nullable', 'string', 'max:180'],
        'message' => ['required', 'string', 'max:5000'],
        'type'    => ['required', 'string', 'max:60'],
    ]);
    ContactMessage::create($data);
    return redirect()->route('english.contact')->with('success', 'Your message has been received. Our team will reply shortly.');
})->name('english.contact.store');

/*
|--------------------------------------------------------------------------
| Administration — URL masquée
| Accès : /gestion-nm
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminNewsController;
use App\Http\Controllers\Admin\AdminReportController;
use App\Http\Controllers\Admin\AdminJobController;
use App\Http\Controllers\Admin\AdminPartnerController;
use App\Http\Controllers\Admin\AdminPressController;
use App\Http\Controllers\Admin\AdminMediaController;
use App\Http\Controllers\Admin\AdminMessageController;
use App\Models\HeroSlide;

// Login / logout (public, pas de middleware)
Route::prefix('gestion-nm')->name('admin.')->group(function () {

    Route::get('/',         [AdminLoginController::class, 'showLogin'])->name('login');
    Route::post('/connexion', [AdminLoginController::class, 'login'])->name('login.post');
    Route::post('/deconnexion', [AdminLoginController::class, 'logout'])->name('logout');

    // Routes protégées par le middleware admin.auth
    Route::middleware('admin.auth')->group(function () {

        Route::get('/tableau-de-bord', [AdminDashboardController::class, 'index'])->name('dashboard');

        // Actualités
        Route::get('/actualites',               [AdminNewsController::class, 'index'])->name('news.index');
        Route::get('/actualites/creer',         [AdminNewsController::class, 'create'])->name('news.create');
        Route::post('/actualites',              [AdminNewsController::class, 'store'])->name('news.store');
        Route::get('/actualites/{news}/modifier',[AdminNewsController::class, 'edit'])->name('news.edit');
        Route::put('/actualites/{news}',        [AdminNewsController::class, 'update'])->name('news.update');
        Route::delete('/actualites/{news}',     [AdminNewsController::class, 'destroy'])->name('news.destroy');

        // Publications
        Route::get('/publications',                    [AdminReportController::class, 'index'])->name('reports.index');
        Route::get('/publications/creer',              [AdminReportController::class, 'create'])->name('reports.create');
        Route::post('/publications',                   [AdminReportController::class, 'store'])->name('reports.store');
        Route::get('/publications/{report}/modifier',  [AdminReportController::class, 'edit'])->name('reports.edit');
        Route::put('/publications/{report}',           [AdminReportController::class, 'update'])->name('reports.update');
        Route::delete('/publications/{report}',        [AdminReportController::class, 'destroy'])->name('reports.destroy');

        // Offres d'emploi
        Route::get('/emploi',                  [AdminJobController::class, 'index'])->name('jobs.index');
        Route::get('/emploi/creer',            [AdminJobController::class, 'create'])->name('jobs.create');
        Route::post('/emploi',                 [AdminJobController::class, 'store'])->name('jobs.store');
        Route::get('/emploi/{job}/modifier',   [AdminJobController::class, 'edit'])->name('jobs.edit');
        Route::put('/emploi/{job}',            [AdminJobController::class, 'update'])->name('jobs.update');
        Route::delete('/emploi/{job}',         [AdminJobController::class, 'destroy'])->name('jobs.destroy');

        // Partenaires
        Route::get('/partenaires',                     [AdminPartnerController::class, 'index'])->name('partners.index');
        Route::get('/partenaires/creer',               [AdminPartnerController::class, 'create'])->name('partners.create');
        Route::post('/partenaires',                    [AdminPartnerController::class, 'store'])->name('partners.store');
        Route::get('/partenaires/{partner}/modifier',  [AdminPartnerController::class, 'edit'])->name('partners.edit');
        Route::put('/partenaires/{partner}',           [AdminPartnerController::class, 'update'])->name('partners.update');
        Route::delete('/partenaires/{partner}',        [AdminPartnerController::class, 'destroy'])->name('partners.destroy');

        // Communiqués de presse
        Route::get('/communiques',                           [AdminPressController::class, 'index'])->name('press.index');
        Route::get('/communiques/creer',                     [AdminPressController::class, 'create'])->name('press.create');
        Route::post('/communiques',                          [AdminPressController::class, 'store'])->name('press.store');
        Route::get('/communiques/{pressDocument}/modifier',  [AdminPressController::class, 'edit'])->name('press.edit');
        Route::put('/communiques/{pressDocument}',           [AdminPressController::class, 'update'])->name('press.update');
        Route::delete('/communiques/{pressDocument}',        [AdminPressController::class, 'destroy'])->name('press.destroy');

        // Médiathèque
        Route::get('/media',                  [AdminMediaController::class, 'index'])->name('media.index');
        Route::get('/media/creer',            [AdminMediaController::class, 'create'])->name('media.create');
        Route::post('/media',                 [AdminMediaController::class, 'store'])->name('media.store');
        Route::get('/media/{media}/modifier', [AdminMediaController::class, 'edit'])->name('media.edit');
        Route::put('/media/{media}',          [AdminMediaController::class, 'update'])->name('media.update');
        Route::delete('/media/{media}',       [AdminMediaController::class, 'destroy'])->name('media.destroy');

        // Messages de contact
        Route::get('/messages',                   [AdminMessageController::class, 'index'])->name('messages.index');
        Route::get('/messages/{message}',         [AdminMessageController::class, 'show'])->name('messages.show');
        Route::delete('/messages/{message}',      [AdminMessageController::class, 'destroy'])->name('messages.destroy');

        // Candidatures
        Route::get('/candidatures',                              [\App\Http\Controllers\Admin\AdminJobApplicationController::class, 'index'])->name('applications.index');
        Route::get('/candidatures/{application}',                [\App\Http\Controllers\Admin\AdminJobApplicationController::class, 'show'])->name('applications.show');
        Route::get('/candidatures/{application}/cv',             [\App\Http\Controllers\Admin\AdminJobApplicationController::class, 'downloadCv'])->name('applications.cv');
        Route::get('/candidatures/{application}/lettre',         [\App\Http\Controllers\Admin\AdminJobApplicationController::class, 'downloadCoverLetter'])->name('applications.cover-letter');
        Route::patch('/candidatures/{application}/statut',       [\App\Http\Controllers\Admin\AdminJobApplicationController::class, 'updateStatus'])->name('applications.status');
        Route::delete('/candidatures/{application}',             [\App\Http\Controllers\Admin\AdminJobApplicationController::class, 'destroy'])->name('applications.destroy');

        // Hero Slideshow (carrousel page d'accueil)
        Route::get('/hero-slideshow',                     [\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'index'])->name('hero.index');
        Route::get('/hero-slideshow/ajouter',             [\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'create'])->name('hero.create');
        Route::post('/hero-slideshow',                    [\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'store'])->name('hero.store');
        Route::get('/hero-slideshow/{heroSlide}/modifier',[\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'edit'])->name('hero.edit');
        Route::put('/hero-slideshow/{heroSlide}',         [\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'update'])->name('hero.update');
        Route::patch('/hero-slideshow/{heroSlide}/toggle',[\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'toggle'])->name('hero.toggle');
        Route::post('/hero-slideshow/reorder',            [\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'reorder'])->name('hero.reorder');
        Route::delete('/hero-slideshow/{heroSlide}',      [\App\Http\Controllers\Admin\AdminHeroSlideController::class, 'destroy'])->name('hero.destroy');

    });
});
