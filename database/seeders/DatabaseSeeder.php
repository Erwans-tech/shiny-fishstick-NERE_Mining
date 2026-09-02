<?php

namespace Database\Seeders;

use App\Models\JobOffer;
use App\Models\MediaAsset;
use App\Models\Partner;
use App\Models\PressDocument;
use App\Models\Report;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Compte admin
        $this->call(AdminSeeder::class);

        // Actualités enrichies avec vraies données
        $this->call(EnrichedNewsSeeder::class);

        // Rapports exemple avec vraies données
        Report::query()->delete();
        Report::create([
            'title'        => 'Rapport Annuel de Production 2023',
            'category'     => 'Production',
            'description'  => 'Analyse détaillée de la production aurifère de la mine Karma : 89 000 onces d\'or produites, extension de la durée de vie de la mine à 11 ans.',
            'file_path'    => '',
            'published_at' => now()->subMonths(3),
        ]);
        
        Report::create([
            'title'        => 'Étude d\'Impact Environnemental - Karma',
            'category'     => 'Environnement',
            'description'  => 'Évaluation complète de l\'impact environnemental des opérations d\'extraction à ciel ouvert et mesures de mitigation mises en place.',
            'file_path'    => '',
            'published_at' => now()->subMonths(6),
        ]);

        Report::create([
            'title'        => 'Rapport de Développement Communautaire',
            'category'     => 'RSE',
            'description'  => 'Bilan des initiatives sociales : construction d\'écoles, réhabilitation de forages, soutien aux groupes de femmes et formation professionnelle des jeunes.',
            'file_path'    => '',
            'published_at' => now()->subMonth(),
        ]);

        // Offres d'emploi avec vraies données
        JobOffer::query()->delete();

        // 1. Offre de candidature spontanée — logique séparée, jamais affichée dans la liste
        JobOffer::create([
            'title'          => 'Candidature spontanée',
            'slug'           => 'candidature-spontanee',
            'department'     => 'Ressources Humaines',
            'location'       => 'Burkina Faso',
            'contract_type'  => 'Selon profil',
            'description'    => "Néré Mining conserve les candidatures spontanées pendant 12 mois et les étudie dès qu'une opportunité correspondante se présente. Rejoignez une équipe de plus de 470 professionnels engagés dans l'excellence minière.",
            'requirements'   => "Être ressortissant(e) burkinabè\nDisposer d'un diplôme ou d'une expérience dans les métiers miniers ou connexes\nAvoir la motivation de contribuer au développement durable du Burkina Faso",
            'is_published'   => true,
            'is_spontaneous' => true,
        ]);

        // 2. Exemples d'offres réelles basées sur les besoins de Karma
        JobOffer::create([
            'title'            => 'Ingénieur Géologue Senior',
            'slug'             => 'ingenieur-geologue-senior',
            'department'       => 'Exploration',
            'location'         => 'Karma, Yatenga',
            'contract_type'    => 'CDI',
            'experience_level' => 'senior',
            'salary_range'     => 'Selon expérience',
            'description'      => "Rejoignez l'équipe d'exploration de Néré Mining pour développer nos gisements aurifères. Superviser l'évaluation des ressources sur les permis Karma, Kao et Nami (2.6 Moz de ressources M&I). Contribuer à l'extension de la durée de vie de la mine.",
            'requirements'     => "Master en Géologie ou Géologie minière\nMinimum 7 ans d'expérience en exploration aurifère\nMaîtrise des logiciels : Leapfrog, Vulcan, Surpac\nExpérience en classification JORC obligatoire\nNationalité burkinabè souhaitée",
            'deadline'         => now()->addDays(45),
            'is_published'     => true,
            'is_spontaneous'   => false,
        ]);
        
        JobOffer::create([
            'title'            => 'Responsable Sécurité HSE',
            'slug'             => 'responsable-securite-hse',
            'department'       => 'HSE',
            'location'         => 'Karma, Yatenga',
            'contract_type'    => 'CDI',
            'experience_level' => 'senior',
            'salary_range'     => 'Compétitif',
            'description'      => "Assurer la sécurité de nos équipes sur le site de Karma (production de 89 000 oz/an). Objectif zéro accident pour nos 470+ employés. Superviser les protocoles HSE et les formations sécurité.",
            'requirements'     => "Formation supérieure en HSE, Sécurité industrielle\nMinimum 5 ans d'expérience en milieu minier\nCertifications HSE internationales (NEBOSH, IOSH)\nMaîtrise des normes ISO 14001, ISO 45001\nNationalité burkinabè exigée",
            'deadline'         => now()->addDays(30),
            'is_published'     => true,
            'is_spontaneous'   => false,
        ]);

        // Partenaires institutionnels
        Partner::query()->delete();
        Partner::create(['name' => 'État burkinabè',             'category' => 'Institutionnel', 'logo_path' => 'images/partners/burkina-armoiries.svg', 'is_published' => true, 'sort_order' => 1]);
        Partner::create(['name' => 'ITIE Burkina Faso',          'category' => 'Institutionnel', 'logo_path' => 'images/partners/itie-bf.svg',            'is_published' => true, 'sort_order' => 2, 'website_url' => 'https://itie.bf']);
        Partner::create(['name' => 'ONASER',                     'category' => 'Institutionnel', 'logo_path' => 'images/partners/onaser.svg',             'is_published' => true, 'sort_order' => 3]);
        Partner::create(['name' => 'ENAHM',                      'category' => 'Technique',      'logo_path' => 'images/partners/enahm.svg',              'is_published' => true, 'sort_order' => 4]);
        Partner::create(['name' => 'Canada',                     'category' => 'Développement',  'logo_path' => 'images/partners/canada.svg',             'is_published' => true, 'sort_order' => 5, 'website_url' => 'https://www.canada.ca']);
        Partner::create(['name' => 'CNRST',                      'category' => 'Recherche',      'logo_path' => 'images/partners/cnrst.svg',              'is_published' => true, 'sort_order' => 6]);

        // Assets média
        MediaAsset::query()->delete();
        foreach ([
            ['title' => 'Les opérations de Karma',   'file_path' => 'images/mining/karma-01.jpg'],
            ['title' => 'Les installations minières', 'file_path' => 'images/mining/karma-03.jpg'],
            ['title' => 'Une équipe au travail',      'file_path' => 'images/mining/karma-04.jpg'],
        ] as $i => $media) {
            MediaAsset::create($media + ['type' => 'image', 'placement' => 'gallery', 'is_published' => true, 'sort_order' => $i]);
        }

        // Document presse exemple
        PressDocument::query()->delete();
        PressDocument::create([
            'title'         => 'Dossier de présentation Néré Mining',
            'document_type' => 'Presse',
            'description'   => 'Présentation institutionnelle et informations clés sur Néré Mining.',
            'file_path'     => '',
            'published_at'  => now(),
        ]);
    }
}
