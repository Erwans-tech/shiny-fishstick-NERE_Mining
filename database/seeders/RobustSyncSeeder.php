<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\Partner;
use App\Models\HeroSlide;
use App\Models\KarmaDepartment;
use App\Models\SiteSetting;
use App\Models\LeadershipMember;
use Illuminate\Database\Seeder;

class RobustSyncSeeder extends Seeder
{
    /**
     * Run the database seeds using Eloquent models
     * This avoids SQL injection and database compatibility issues
     */
    public function run(): void
    {
        $this->command->info('🔄 Starting robust database sync...');

        // Truncate all tables
        $this->command->info('🗑️  Clearing existing data...');
        News::truncate();
        Partner::truncate();
        HeroSlide::truncate();
        KarmaDepartment::truncate();
        SiteSetting::truncate();
        LeadershipMember::truncate();

        // Insert News
        $this->command->info('📰 Syncing News articles...');
        News::create([
            'id' => 1,
            'title' => 'Annulation du contrat d\'achat d\'or : Riverstone Karma SA salue une décision judiciaire historique',
            'category' => 'Gouvernance',
            'excerpt' => 'Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l\'opposait aux sociétés Franco-Nevada et Sandstorm Gold Ltd (aujourd\'hui IRC).',
            'image_path' => 'news/FygENNJr36vgw9vcHOKKRXXjCM3R2t5pFsWppYO8.jpg',
            'published_at' => '2026-07-20 00:00:00',
            'created_at' => '2026-09-07 13:52:26',
            'updated_at' => '2026-09-08 07:53:22',
            'content' => 'La juridiction a prononcé l\'annulation du Gold Purchase Agreement (GPA), un contrat d\'achat d\'or conclu en 2014, et a condamné solidairement les deux sociétés à verser à Riverstone Karma SA la somme de 5 218 224 600 francs CFA (environ 9,3 millions de dollars américains) à titre de réparation.

Hérité d\'un montage financier mis en place plusieurs années avant la reprise de la mine de Karma en 2022, le contrat imposait des engagements de long terme particulièrement contraignants sur la commercialisation de la production aurifère. Ces dispositions limitaient la flexibilité financière de l\'exploitation et réduisaient sa capacité à mobiliser les ressources nécessaires pour son développement.

L\'annulation de ce contrat permet aujourd\'hui à Riverstone Karma SA de retrouver une plus grande autonomie dans la gestion de ses ressources et de maximiser les retombées économiques au bénéfice du Burkina Faso. Elle réaffirme également l\'importance du respect du cadre juridique burkinabè et des principes économiques et financiers de l\'Union économique et monétaire ouest-africaine (UEMOA).

Cette nouvelle dynamique favorisera notamment :

Le renforcement des investissements productifs ;
L\'optimisation des recettes fiscales et des dividendes versés à l\'État ;
La création de valeur pour les partenaires nationaux ;
Le développement des opportunités économiques au profit des communautés locales ;
La consolidation d\'une exploitation minière durable.
Riverstone Karma SA réaffirme son engagement à promouvoir une exploitation minière responsable, fondée sur le respect des lois nationales et des meilleures pratiques internationales. La société poursuivra ses investissements afin de créer de la valeur durable pour l\'ensemble de ses parties prenantes.',
            'slug' => 'annulation-du-contrat-dachat-dor-riverstone-karma-sa-salue-une-decision-judiciaire-historique',
            'gallery_images' => null,
        ]);

        News::create([
            'id' => 2,
            'title' => 'Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l\'exploitation minière',
            'category' => 'HSE',
            'excerpt' => 'La troisième édition du Forum Mines a officiellement ouvert ses portes le mardi 7 juillet 2026 à Ouagadougou. Organisée par la Chambre des mines du Burkina, cette rencontre s\'est déroulée du 7 au 9 juillet autour du thème : « Santé, sécurité et environnement : libérer le plein potentiel minier », sous le patronage du président de l\'Assemblée législative du peuple.',
            'image_path' => 'news/nqMGQxXF6WivCvIrGEXI5nCQ1iMBv2DDIZky3vpH.jpg',
            'published_at' => '2026-07-16 00:00:00',
            'created_at' => '2026-09-07 13:52:26',
            'updated_at' => '2026-09-08 07:55:04',
            'content' => 'Parmi les entreprises présentes au Forum Mines 2026 figure Riverstone Karma SA, détenue par la société Néré Mining. Elle est venue réaffirmer son engagement en matière de santé, de sécurité et d\'environnement (HSE). Pour elle, cette participation constitue une occasion privilégiée de partager les expériences du secteur et de renforcer les bonnes pratiques.

Selon Esaie Sawadogo, chargé de santé et sécurité à Riverstone Karma, la présence de l\'entreprise à cette édition s\'inscrit dans une volonté de contribuer activement aux réflexions sur les enjeux du secteur. «La santé et la sécurité constituent un pilier essentiel au bon fonctionnement d\'une industrie, particulièrement dans le secteur minier. Il était de notre devoir de prendre part à cette rencontre afin d\'échanger sur les défis à relever et de contribuer au renforcement de la culture santé-sécurité », a-t-il expliqué.

Après avoir acquis la mine de Karma en 2022, Néré Mining se distingue comme la première société minière de droit burkinabé, détenue par des actionnaires majoritairement nationaux. En participant au forum, l\'entreprise met également en lumière ses projets à travers un stand d\'exposition ouvert aux visiteurs. Les représentants de Néré Mining ont également pris part à plusieurs panels consacrés aux questions de santé, de sécurité et d\'environnement. Ces échanges ont permis de découvrir les expériences d\'autres sociétés minières ainsi que les évolutions des textes réglementaires en vigueur dans le domaine du HSE.

« Nous repartons satisfaits de ces échanges. Les expériences partagées et les conseils reçus nous permettront d\'améliorer davantage nos pratiques afin de garantir un environnement de travail toujours plus sûr », a confié M. Sawadogo.

À l\'endroit des acteurs du secteur et des entreprises burkinabè, il a lancé un appel à faire de la santé et de la sécurité une priorité. « Le capital humain demeure la première richesse de toute entreprise. Il est indispensable de mettre en place un système HSE efficace afin d\'offrir aux travailleurs des conditions de travail sûres et favorables à leur productivité », a-t-il conclu.

À travers cette participation, Néré Mining confirme sa volonté de promouvoir une culture de prévention et d\'amélioration continue, en cohérence avec les objectifs du Forum Mines 2026 pour un secteur minier plus performant, plus responsable et plus sûr.',
            'slug' => 'forum-mines-2026-nere-mining-reaffirme-son-engagement-en-faveur-des-pratiques-durables-dans-lexploitation-miniere',
            'gallery_images' => null,
        ]);

        News::create([
            'id' => 3,
            'title' => 'Semaine des Activités Minières de l\'Afrique de l\'Ouest',
            'category' => 'Événement',
            'excerpt' => 'Retour sur la 6e édition de la SAMAO, consacrée aux stratégies de développement liées aux minéraux critiques pour les pays africains.',
            'image_path' => 'news/ClY1vOlgljZlrcugFSlfM4T6EBT019H7QBRyioKu.png',
            'published_at' => '2024-11-29 00:00:00',
            'created_at' => '2026-09-07 13:52:26',
            'updated_at' => '2026-09-08 07:54:05',
            'content' => 'MOT DU PARRAIN

Je voudrais exprimer mes vifs remerciements à l\'endroit du Gouvernement du Burkina Faso pour le choix porté sur ma modeste personne pour parrainer cette 6ème édition de la SAMAO.

Le thème de cette rencontre « Les minéraux critiques : Quelles stratégies de développement pour les pays africains ? » est d\'un intérêt stratégique pour « réaliser l\'Afrique que nous voulons, c\'est à dire une Afrique qui compte et qui gagne».

Des premières Journées de Promotion des activités minières (PROMIN en 1995) à la SAMAO 2024, que de chemin parcouru !!!! Quel engagement soutenu et quelle belle détermination du Gouvernement, des acteurs privés, de la société civile et des Partenaires techniques et financiers, à faire du secteur minier, un puissant levier de développement économique et social de nos chers pays !!!

Notre vision, notre ambition et notre engagement dans le secteur minier est d\'en faire un véritable accélérateur de l\'industrialisation de notre continent et de créer des chaines de valeurs par une approche intégrée basée sur la diversification et le développement de son incommensurable potentiel géologique, la valeur de ses ressources humaines, la création de richesses et le soutien aux petites et moyennes entreprises, en vue de leur insertion dans l\'économie minière.

Les thématiques abordées durant ces trois jours à l\'ère de la transition énergétique constituent autant de défis qu\'il nous faut relever ensemble, si nous voulons faire de l\'Afrique le Continent de l\'avenir. Certes, beaucoup a été fait mais beaucoup reste encore à parfaire. Et comme une termitière vivante, ajoutons toujours de la terre à la terre.

Je terminerai enfin, en souhaitant plein succès à la SAMAO 2024 et en félicitant toutes les parties prenantes dans l\'Organisation de cet important évènement continental qui démontre une fois de plus le rôle prépondérant de notre cher pays dans le concert des plus grandes nations minières.

NAAABA BAOOGO DE GOURCY
PDG de NERE MINING SA',
            'slug' => 'semaine-des-activites-minieres-de-lafrique-de-louest',
            'gallery_images' => null,
        ]);

        $this->command->info('   ✓ News synced (3 records)');

        // Insert Partners
        $this->command->info('🤝 Syncing Partners...');
        Partner::create([
            'id' => 1,
            'name' => 'NEMMBA',
            'logo_path' => 'partners/pMc5uaRdviLRriZMxGeV9Mg6QzLvxGDv0bnK54tW.jpg',
            'website_url' => null,
            'category' => 'TECHNIQUE',
            'is_published' => true,
            'sort_order' => 4,
            'created_at' => '2026-09-08 07:56:37',
            'updated_at' => '2026-09-08 07:56:37',
        ]);

        $this->command->info('   ✓ Partners synced (1 record)');

        // Insert Hero Slides
        $this->command->info('🎬 Syncing Hero Slides...');
        $heroSlides = [
            ['id' => 6, 'title' => 'Une mine de classe mondiale', 'image_path' => 'images/carousel/gyathursan-mine-5523376_1920.jpg', 'sort' => 0],
            ['id' => 7, 'title' => 'Des opérations responsables', 'image_path' => 'images/carousel/pexels-gunshe-5125104.jpg', 'sort' => 1],
            ['id' => 8, 'title' => 'L\'excellence industrielle', 'image_path' => 'images/carousel/shibang-mechanical-2653706_1920.jpg', 'sort' => 2],
            ['id' => 9, 'title' => 'Des équipes engagées', 'image_path' => 'images/carousel/tyna_janoch-excavator-2781676_1920.jpg', 'sort' => 3],
            ['id' => 10, 'title' => 'Un territoire en mouvement', 'image_path' => 'images/carousel/tyna_janoch-mine-2781686_1920.jpg', 'sort' => 4],
            ['id' => 17, 'title' => 'Karma, notre mine d\'or', 'image_path' => 'images/carousel/Video Project 1.mp4', 'sort' => 5, 'video' => true],
        ];

        foreach ($heroSlides as $slide) {
            HeroSlide::create([
                'id' => $slide['id'],
                'title' => $slide['title'],
                'caption' => null,
                'image_path' => $slide['image_path'],
                'is_active' => true,
                'sort_order' => $slide['sort'],
                'created_at' => '2026-09-07 13:52:26',
                'updated_at' => '2026-09-07 13:52:26',
                'type' => $slide['video'] ?? false ? 'video' : 'image',
                'video_url' => null,
            ]);
        }

        $this->command->info('   ✓ Hero Slides synced (6 records)');

        // Insert Karma Departments
        $this->command->info('🏢 Syncing Karma Departments...');
        $departments = [
            ['id' => 1, 'tag' => 'Administration', 'title' => 'Administration de la mine', 'body' => 'Planification stratégique, gestion des opérations, supervision financière et conformité réglementaire.', 'sort' => 1],
            ['id' => 2, 'tag' => 'Ressources humaines', 'title' => 'Ressources humaines', 'body' => 'Les ressources humaines gèrent le personnel et contribuent à garantir un environnement de travail productif, sûr et épanouissant.', 'sort' => 2],
            ['id' => 3, 'tag' => 'Sûreté', 'title' => 'Département Sécurité', 'body' => 'Le dispositif comprend une CCTV de 44 caméras, une cellule drone, une brigade canine, une permanence des superviseurs 24h/24.', 'sort' => 3],
            ['id' => 4, 'tag' => 'Opérations', 'title' => 'Département Mining', 'body' => 'Le processus minier regroupe la planification, les études de faisabilité, l\'analyse économique et les étapes techniques.', 'sort' => 4],
            ['id' => 5, 'tag' => 'HSE', 'title' => 'Hygiène, Santé, Sécurité et Environnement', 'body' => 'Le département HSE vise zéro incident grâce à la formation continue, aux inspections régulières, au suivi environnemental.', 'sort' => 5],
            ['id' => 6, 'tag' => 'Traitement', 'title' => 'Département Processing', 'body' => 'Le Processing est organisé en quatre sections : opérations, maintenance des équipements fixes, métallurgie et infrastructures.', 'sort' => 6],
            ['id' => 7, 'tag' => 'Approvisionnement', 'title' => 'Chaîne d\'approvisionnement (SCM)', 'body' => 'Le SCM comprend les Achats, la Logistique, les Contrats et le Magasin. Il est dirigé par une équipe entièrement locale.', 'sort' => 7],
            ['id' => 8, 'tag' => 'Technologies', 'title' => 'Département IT', 'body' => 'Le département IT accompagne les équipes et les opérations de Karma grâce aux outils et services numériques.', 'sort' => 8],
            ['id' => 9, 'tag' => 'Dialogue local', 'title' => 'Relations communautaires', 'body' => 'Le département gère les impacts sociaux, entretient le dialogue avec les communautés et soutient les autorités locales.', 'sort' => 9],
        ];

        foreach ($departments as $dept) {
            KarmaDepartment::create([
                'id' => $dept['id'],
                'tag_fr' => $dept['tag'],
                'tag_en' => $dept['tag'],
                'title_fr' => $dept['title'],
                'title_en' => $dept['title'],
                'body_fr' => $dept['body'],
                'body_en' => $dept['body'],
                'sort_order' => $dept['sort'],
                'is_published' => true,
                'created_at' => '2026-09-07 13:52:25',
                'updated_at' => '2026-09-07 13:52:25',
            ]);
        }

        $this->command->info('   ✓ Departments synced (9 records)');

        // Insert Site Settings
        $this->command->info('⚙️  Syncing Site Settings...');
        $settings = [
            ['key' => 'carousel_autoplay', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_interval', 'value' => '5000', 'type' => 'number'],
            ['key' => 'carousel_transition_speed', 'value' => '800', 'type' => 'number'],
            ['key' => 'carousel_pause_on_hover', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_indicators', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'carousel_show_arrows', 'value' => 'true', 'type' => 'boolean'],
            ['key' => 'press_contact_name', 'value' => '[Nom du Responsable Communication]', 'type' => 'text'],
            ['key' => 'press_contact_job', 'value' => 'Responsable Communication & Relations Presse  - Néré Mining S.A.', 'type' => 'text'],
            ['key' => 'press_contact_photo', 'value' => '', 'type' => 'url'],
            ['key' => 'press_contact_phone', 'value' => '+226 25 33 35 69', 'type' => 'text'],
            ['key' => 'press_contact_email', 'value' => 'presse@nere-mining.bf', 'type' => 'email'],
            ['key' => 'press_contact_hours', 'value' => 'Lundi – Vendredi, 8h – 17h (GMT+0)', 'type' => 'text'],
        ];

        foreach ($settings as $setting) {
            SiteSetting::create($setting);
        }

        $this->command->info('   ✓ Settings synced (12 records)');

        // Insert Leadership Members
        $this->command->info('👥 Syncing Leadership Members...');
        $leaders = [
            ['id' => 1, 'name' => 'Dr. Justin Elie OUEDRAOGO', 'title' => 'Président Directeur Général', 'photo' => 'leadership/FHjRCacFin5bQgJNB0dEroOLxBSmSJU3sYb516Kp.jpg', 'level' => 1, 'sort' => 1],
            ['id' => 2, 'name' => 'Justin SAVADOGO', 'title' => 'Directeur Général Adjoint', 'dept' => 'Administration & Finance', 'photo' => 'images/mining/gold-processing-01.jpg', 'level' => 2, 'sort' => 2],
            ['id' => 3, 'name' => 'Pascal Y. OUEDRAOGO', 'title' => 'Directeur Général Adjoint', 'dept' => 'Approvisionnements', 'photo' => 'images/mining/mining-equipment-01.jpg', 'level' => 2, 'sort' => 3],
            ['id' => 4, 'name' => 'Laurent Michel DABIRE', 'title' => 'Directeur Général Adjoint', 'dept' => 'Affaires Corporatives & Juridiques', 'photo' => 'images/mining/mining-site-aerial-01.jpg', 'level' => 2, 'sort' => 4],
            ['id' => 5, 'name' => 'Augustine OBENG-FORI', 'title' => 'DGA par intérim', 'dept' => 'Opérations', 'photo' => 'images/mining/mining-environment-01.jpg', 'level' => 2, 'sort' => 5],
        ];

        foreach ($leaders as $leader) {
            LeadershipMember::create([
                'id' => $leader['id'],
                'name' => $leader['name'],
                'title' => $leader['title'],
                'department' => $leader['dept'] ?? null,
                'photo_path' => $leader['photo'],
                'is_published' => true,
                'sort_order' => $leader['sort'],
                'created_at' => '2026-09-07 13:52:26',
                'updated_at' => '2026-09-08 07:57:07',
                'hierarchy_level' => $leader['level'],
            ]);
        }

        $this->command->info('   ✓ Leadership members synced (5 records)');

        $this->command->info('\n✅ Database sync completed successfully!');
        $this->command->info('📊 Synced: 3 news + 1 partner + 6 hero_slides + 9 departments + 12 settings + 5 leaders');
    }
}
