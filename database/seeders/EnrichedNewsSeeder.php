<?php

namespace Database\Seeders;

use App\Models\News;
use Illuminate\Database\Seeder;

class EnrichedNewsSeeder extends Seeder
{
    /**
     * Seeder enrichi avec vraies données Néré Mining
     */
    public function run(): void
    {
        News::query()->delete();

        News::create([
            'title' => 'Néré Mining produit 89 000 onces d\'or en 2023',
            'category' => 'Production',
            'excerpt' => 'La mine Karma atteint ses objectifs de production annuelle avec 89 000 onces d\'or extraites, confirmant l\'extension de sa durée de vie à 11 ans.',
            'content' => 'Néré Mining annonce une production de 89 000 onces d\'or pour l\'année 2023 sur son site de Karma. Cette performance consolide les projections de durée de vie de la mine, désormais étendue à 11 ans grâce aux développements des gisements Nord Kao et Nami.

La mine Karma, située dans la province du Yatenga, traite actuellement 4,0 millions de tonnes de minerai par an grâce à son procédé de lixiviation en tas. Les réserves prouvées et probables atteignent 949 000 onces d\'or, réparties sur cinq gisements principaux : Goulagou 1 (GG1), Goulagou 2 (GG2), Rambo, Kao et Nami.

"Ces résultats témoignent de l\'engagement de nos équipes et de l\'efficacité de nos méthodes d\'extraction", déclare la direction de Néré Mining. "Nous continuons d\'investir dans la formation de nos 470+ employés pour maintenir cette excellence opérationnelle."',
            'image_path' => 'images/mining/karma-01.jpg',
            'published_at' => now()->subDays(8),
        ]);

        News::create([
            'title' => 'Extension de la durée de vie de Karma à 11 ans',
            'category' => 'Developpement',
            'excerpt' => 'L\'expansion Nord Kao et l\'optimisation des gisements Nami permettent d\'étendre significativement la durée d\'exploitation de la mine.',
            'content' => 'Néré Mining confirme l\'extension de la durée de vie de sa mine Karma de 8,5 à 11 ans, suite aux développements réussis des gisements Nord Kao et Nami. Cette extension représente 262 000 onces d\'or supplémentaires intégrées aux réserves.

Le projet d\'expansion inclut l\'optimisation du circuit de traitement CIL (Carbon-in-Leach) et l\'extension des fosses d\'extraction. Les ressources mesurées et indiquées totalisent désormais 2,6 millions d\'onces d\'or sur l\'ensemble des permis.

Cette expansion consolide la position de Néré Mining comme acteur majeur de l\'industrie aurifère burkinabè, avec des retombées économiques durables pour la région du Nord et la province du Yatenga.',
            'image_path' => 'images/mining/karma-02.jpg',
            'published_at' => now()->subDays(15),
        ]);

        News::create([
            'title' => 'Plus de 470 employés engagés pour l\'excellence minière',
            'category' => 'Talents',
            'excerpt' => 'Plus de 80% de nos 470+ employés sont burkinabè. Néré Mining renforce ses programmes de formation professionnelle pour développer les compétences minières locales.',
            'content' => 'Néré Mining poursuit son engagement en faveur du contenu local avec plus de 80% d\'employés burkinabè parmi ses 470+ collaborateurs. L\'entreprise a lancé un programme renforcé de formation professionnelle ciblant les jeunes des villages environnants.

Les initiatives incluent :
• Formation technique en mécanique et électricité
• Programmes d\'apprentissage en géologie et topographie  
• Soutien aux groupes de femmes pour des activités génératrices de revenus
• Construction et réhabilitation d\'écoles dans les communautés impactées

"Notre succès dépend du développement des talents burkinabè", explique le département des Ressources Humaines. "Nous investissons dans la formation car nous croyons au potentiel de nos équipes locales."

Les programmes bénéficient aux villages de Karma, Sirgadji, Goinré, Rambo et aux localités environnantes des provinces de Zondoma et Yatenga.',
            'image_path' => 'images/mining/karma-04.jpg',
            'published_at' => now()->subDays(22),
        ]);

        News::create([
            'title' => 'Investissement de 132 millions USD dans l\'infrastructure',
            'category' => 'Investissement',
            'excerpt' => 'Néré Mining finalise les investissements majeurs en équipements lourds : excavateurs 200T, camions 90T, et modernisation de l\'usine de traitement.',
            'content' => 'Néré Mining annonce la finalisation de son programme d\'investissement de 132 millions USD pour moderniser l\'infrastructure de la mine Karma. Ces investissements incluent l\'acquisition d\'équipements miniers de dernière génération.

La flotte comprend désormais :
• 2 excavateurs hydrauliques de 200 tonnes
• 14 camions de transport de 90 tonnes
• 4 bulldozers de 50 tonnes
• 1 chargeuse frontale haute performance
• 2 niveleuses de 300 chevaux

Ces équipements permettent d\'optimiser l\'extraction de 113,8 millions de tonnes de matériau total, dont 33,2 millions de tonnes destinées au traitement.

L\'usine de traitement par lixiviation en tas a également bénéficié d\'améliorations technologiques pour porter sa capacité à 4,0 millions de tonnes par an, avec un taux de récupération optimisé.',
            'image_path' => 'images/mining/karma-05.jpg',
            'published_at' => now()->subDays(35),
        ]);

        News::create([
            'title' => 'Partenariat avec l\'ITIE pour la transparence minière',
            'category' => 'Gouvernance',
            'excerpt' => 'Néré Mining renforce son engagement en faveur de la transparence avec l\'Initiative pour la Transparence dans les Industries Extractives du Burkina Faso.',
            'content' => 'Néré Mining réaffirme son engagement en faveur de la transparence dans le secteur minier burkinabè à travers son partenariat renforcé avec l\'Initiative pour la Transparence dans les Industries Extractives (ITIE) du Burkina Faso.

Cette collaboration se traduit par :
• Publication annuelle des revenus versés à l\'État
• Transparence sur les retombées économiques locales
• Rapports détaillés sur l\'impact social et environnemental
• Participation active aux forums de dialogue multi-parties prenantes

"La transparence est au cœur de notre modèle d\'exploitation", souligne la direction. "Nous publions régulièrement nos données financières et opérationnelles pour assurer une gouvernance exemplaire."

Cette démarche s\'inscrit dans les engagements internationaux du Burkina Faso pour une gestion transparente des ressources minières, conformément aux standards ITIE et aux meilleures pratiques internationales.',
            'image_path' => 'images/partners/itie-bf.svg',
            'published_at' => now()->subDays(48),
        ]);
    }
}