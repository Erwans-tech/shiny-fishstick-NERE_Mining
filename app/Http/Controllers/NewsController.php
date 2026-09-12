<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Support\Facades\App;
use Illuminate\Pagination\LengthAwarePaginator;

class NewsController extends Controller
{
    /**
     * Get hardcoded default news (no database dependency)
     */
    private function getDefaultNews($locale = 'fr')
    {
        $en = $locale === 'en';
        
        return collect([
            (object) [
                'id' => 1,
                'title' => 'Annulation du contrat d\'achat d\'or: Riverstone Karma SA salue une décision judiciaire historique du Tribunal de commerce de Ouagadougou',
                'excerpt' => 'Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l\'opposait aux sociétés Franco-Nevada et Sandstorm Gold Ltd.',
                'content' => 'Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l\'opposait aux sociétés Franco-Nevada et Sandstorm Gold Ltd (aujourd\'hui IRC). La juridiction a prononcé l\'annulation du Gold Purchase Agreement (GPA), un contrat d\'achat d\'or conclu en 2014, et a condamné solidairement les deux sociétés à verser à Riverstone Karma SA la somme de 5 218 224 600 francs CFA (environ 9,3 millions de dollars américains) à titre de réparation.

Hérité d\'un montage financier mis en place plusieurs années avant la reprise de la mine de Karma en 2022, le contrat imposait des engagements de long terme particulièrement contraignants sur la commercialisation de la production aurifère. Ces dispositions limitaient la flexibilité financière de l\'exploitation et réduisaient sa capacité à mobiliser les ressources nécessaires pour son développement.

L\'annulation de ce contrat permet aujourd\'hui à Riverstone Karma SA de retrouver une plus grande autonomie dans la gestion de ses ressources et de maximiser les retombées économiques au bénéfice du Burkina Faso. Elle réaffirme également l\'importance du respect du cadre juridique burkinabè et des principes économiques et financiers de l\'Union économique et monétaire ouest-africaine (UEMOA).

Cette nouvelle dynamique favorisera notamment :
- Le renforcement des investissements productifs ;
- L\'optimisation des recettes fiscales et des dividendes versés à l\'État ;
- La création de valeur pour les partenaires nationaux ;
- Le développement des opportunités économiques au profit des communautés locales ;
- La consolidation d\'une exploitation minière durable.

Riverstone Karma SA réaffirme son engagement à promouvoir une exploitation minière responsable, fondée sur le respect des lois nationales et des meilleures pratiques internationales. La société poursuivra ses investissements afin de créer de la valeur durable pour l\'ensemble de ses parties prenantes.',
                'category' => 'Juridique',
                'image_path' => 'images/news/actualite1.jpeg',
                'published_at' => now()->setDate(2026, 7, 20),
                'slug' => 'annulation-contrat-achat-or-riverstone-karma',
            ],
            (object) [
                'id' => 2,
                'title' => 'Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l\'exploitation minière',
                'excerpt' => 'La troisième édition du Forum Mines a officiellement ouvert ses portes le mardi 7 juillet 2026 à Ouagadougou. Riverstone Karma SA est venue réaffirmer son engagement en matière de santé, de sécurité et d\'environnement.',
                'content' => 'La troisième édition du Forum Mines a officiellement ouvert ses portes le mardi 7 juillet 2026 à Ouagadougou. Organisée par la Chambre des mines du Burkina, cette rencontre s\'est déroulée du 7 au 9 juillet autour du thème : « Santé, sécurité et environnement : libérer le plein potentiel minier », sous le patronage du président de l\'Assemblée législative du peuple.

Parmi les entreprises présentes au Forum Mines 2026 figure Riverstone Karma SA, détenue par la société Néré Mining. Elle est venue réaffirmer son engagement en matière de santé, de sécurité et d\'environnement (HSE). Pour elle, cette participation constitue une occasion privilégiée de partager les expériences du secteur et de renforcer les bonnes pratiques.

Selon Esaie Sawadogo, chargé de santé et sécurité à Riverstone Karma, la présence de l\'entreprise à cette édition s\'inscrit dans une volonté de contribuer activement aux réflexions sur les enjeux du secteur. «La santé et la sécurité constituent un pilier essentiel au bon fonctionnement d\'une industrie, particulièrement dans le secteur minier. Il était de notre devoir de prendre part à cette rencontre afin d\'échanger sur les défis à relever et de contribuer au renforcement de la culture santé-sécurité », a-t-il expliqué.

Après avoir acquis la mine de Karma en 2022, Néré Mining se distingue comme la première société minière de droit burkinabé, détenue par des actionnaires majoritairement nationaux. En participant au forum, l\'entreprise met également en lumière ses projets à travers un stand d\'exposition ouvert aux visiteurs. Les représentants de Néré Mining ont également pris part à plusieurs panels consacrés aux questions de santé, de sécurité et d\'environnement. Ces échanges ont permis de découvrir les expériences d\'autres sociétés minières ainsi que les évolutions des textes réglementaires en vigueur dans le domaine du HSE.

« Nous repartons satisfaits de ces échanges. Les expériences partagées et les conseils reçus nous permettront d\'améliorer davantage nos pratiques afin de garantir un environnement de travail toujours plus sûr », a confié M. Sawadogo.

À l\'endroit des acteurs du secteur et des entreprises burkinabè, il a lancé un appel à faire de la santé et de la sécurité une priorité. « Le capital humain demeure la première richesse de toute entreprise. Il est indispensable de mettre en place un système HSE efficace afin d\'offrir aux travailleurs des conditions de travail sûres et favorables à leur productivité », a-t-il conclu.

À travers cette participation, Néré Mining confirme sa volonté de promouvoir une culture de prévention et d\'amélioration continue, en cohérence avec les objectifs du Forum Mines 2026 pour un secteur minier plus performant, plus responsable et plus sûr.',
                'category' => 'Événement',
                'image_path' => 'images/news/actualite2.jpg',
                'published_at' => now()->setDate(2026, 7, 16),
                'slug' => 'forum-mines-2026-nere-mining-pratiques-durables',
            ],
            (object) [
                'id' => 3,
                'title' => 'Semaine des Activités Minières de l\'Afrique de l\'Ouest – Mot du Parrain',
                'excerpt' => 'Le PDG de Néré Mining, Dr. Justin Elie OUEDRAOGO, parrain de la 6ème édition de la SAMAO 2024, partage sa vision pour faire du secteur minier un véritable accélérateur de l\'industrialisation du continent.',
                'content' => 'MOT DU PARRAIN

Je voudrais exprimer mes vifs remerciements à l\'endroit du Gouvernement du Burkina Faso pour le choix porté sur ma modeste personne pour parrainer cette 6ème édition de la SAMAO.

Le thème de cette rencontre « Les minéraux critiques : Quelles stratégies de développement pour les pays africains ? » est d\'un intérêt stratégique pour « réaliser l\'Afrique que nous voulons, c\'est à dire une Afrique qui compte et qui gagne».

Des premières Journées de Promotion des activités minières (PROMIN en 1995) à la SAMAO 2024, que de chemin parcouru !!!! Quel engagement soutenu et quelle belle détermination du Gouvernement, des acteurs privés, de la société civile et des Partenaires techniques et financiers, à faire du secteur minier, un puissant levier de développement économique et social de nos chers pays !!!

Notre vision, notre ambition et notre engagement dans le secteur minier est d\'en faire un véritable accélérateur de l\'industrialisation de notre continent et de créer des chaines de valeurs par une approche intégrée basée sur la diversification et le développement de son incommensurable potentiel géologique, la valeur de ses ressources humaines, la création de richesses et le soutien aux petites et moyennes entreprises, en vue de leur insertion dans l\'économie minière.

Les thématiques abordées durant ces trois jours à l\'ère de la transition énergétique constituent autant de défis qu\'il nous faut relever ensemble, si nous voulons faire de l\'Afrique le Continent de l\'avenir. Certes, beaucoup a été fait mais beaucoup reste encore à parfaire. Et comme une termitière vivante, ajoutons toujours de la terre à la terre. Je terminerai enfin, en souhaitant plein succès à la SAMAO 2024 et en félicitant toutes les parties prenantes dans l\'Organisation de cet important évènement continental qui démontre une fois de plus le rôle prépondérant de notre cher pays dans le concert des plus grandes nations minières.

NAAABA BAOOGO DE GOURCY
PDG de NERE MINING SA',
                'category' => 'Événement',
                'image_path' => 'images/news/actualite3.png',
                'published_at' => now()->setDate(2024, 11, 29),
                'slug' => 'samao-2024-mot-du-parrain',
            ],
        ]);
    }

    public function index()
    {
        App::setLocale('fr');
        
        // Try to get news from database, otherwise use hardcoded defaults
        $dbNews = News::published()->latest('published_at')->get();
        $newsItems = $dbNews->isEmpty() ? $this->getDefaultNews('fr') : $dbNews;
        
        // Manual pagination
        $perPage = 9;
        $currentPage = request()->get('page', 1);
        $paginator = new LengthAwarePaginator(
            $newsItems->forPage($currentPage, $perPage),
            $newsItems->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        return view('news.index', [
            'locale' => 'fr',
            'news'   => $paginator,
        ]);
    }

    public function show(News $news)
    {
        abort_unless($news->published_at && $news->published_at->isPast(), 404);
        App::setLocale('fr');
        return view('news.show', ['locale' => 'fr', 'news' => $news]);
    }

    public function indexEn()
    {
        App::setLocale('en');
        
        // Try to get news from database, otherwise use hardcoded defaults
        $dbNews = News::published()->latest('published_at')->get();
        $newsItems = $dbNews->isEmpty() ? $this->getDefaultNews('en') : $dbNews;
        
        // Manual pagination
        $perPage = 9;
        $currentPage = request()->get('page', 1);
        $paginator = new LengthAwarePaginator(
            $newsItems->forPage($currentPage, $perPage),
            $newsItems->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );
        
        return view('news.index', [
            'locale' => 'en',
            'news'   => $paginator,
        ]);
    }

    public function showEn(News $news)
    {
        abort_unless($news->published_at && $news->published_at->isPast(), 404);
        App::setLocale('en');
        return view('news.show', ['locale' => 'en', 'news' => $news]);
    }
}
