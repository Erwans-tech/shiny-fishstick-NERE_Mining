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

        // Actualités
        $this->call(NewsSeeder::class);

        // Rapports exemple
        Report::query()->delete();
        Report::create([
            'title'        => 'Rapport de développement durable',
            'category'     => 'RSE',
            'description'  => 'Document de référence sur nos engagements environnementaux et sociaux.',
            'file_path'    => '',
            'published_at' => now(),
        ]);

        // Offres d'emploi
        JobOffer::query()->delete();

        // 1. Offre de candidature spontanée — logique séparée, jamais affichée dans la liste
        JobOffer::create([
            'title'          => 'Candidature spontanée',
            'slug'           => 'candidature-spontanee',
            'department'     => 'Talents',
            'location'       => 'Burkina Faso',
            'contract_type'  => 'Selon profil',
            'description'    => "Néré Mining conserve les candidatures spontanées pendant 12 mois et les étudie dès qu'une opportunité correspondante se présente.",
            'requirements'   => "Être ressortissant(e) burkinabè\nDisposer d'un diplôme ou d'une expérience dans les métiers miniers ou connexes\nAvoir la motivation de contribuer au développement burkinabè",
            'is_published'   => true,
            'is_spontaneous' => true,
        ]);

        // 2. Exemples d'offres réelles (visibles dans la liste)
        JobOffer::create([
            'title'            => 'Ingénieur Minier Senior',
            'slug'             => 'ingenieur-minier-senior',
            'department'       => 'Mining',
            'location'         => 'Karma, Burkina Faso',
            'contract_type'    => 'CDI',
            'experience_level' => 'senior',
            'salary_range'     => 'Selon profil',
            'description'      => "Superviser les opérations d'extraction à ciel ouvert sur le site de Karma. Coordonner les équipes de forage, tir à l'explosif et transport du minerai. Garantir l'atteinte des objectifs de production dans le respect des normes HSE.",
            'requirements'     => "Diplôme d'ingénieur en génie minier ou équivalent\nMinimum 5 ans d'expérience en exploitation minière à ciel ouvert\nMaîtrise des logiciels de planification minière\nNationalité burkinabè souhaitée",
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
