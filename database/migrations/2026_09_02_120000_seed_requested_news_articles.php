<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $articles = [
            [
                'title' => "Annulation du contrat d'achat d'or : Riverstone Karma SA salue une décision judiciaire historique",
                'category' => 'Gouvernance',
                'excerpt' => 'Le Tribunal de commerce de Ouagadougou annule le Gold Purchase Agreement et ouvre une nouvelle dynamique pour Riverstone Karma SA et ses parties prenantes.',
                'content' => "Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l'opposait à Franco-Nevada et Sandstorm Gold Ltd (aujourd'hui IRC). La juridiction a prononcé l'annulation du Gold Purchase Agreement conclu en 2014 et accordé une réparation de 5 218 224 600 francs CFA.\n\nCette décision permet à Riverstone Karma SA de retrouver une plus grande autonomie dans la gestion de ses ressources, de renforcer ses investissements productifs et de maximiser les retombées économiques au bénéfice du Burkina Faso. Elle ouvre également des perspectives pour les partenaires nationaux, les communautés locales et la consolidation d'une exploitation minière durable.\n\nSource : https://www.nere-mining.bf/2026/07/20/5677/",
                'published_at' => '2026-07-20 08:00:00',
            ],
            [
                'title' => "Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l'exploitation minière",
                'category' => 'HSE',
                'excerpt' => 'Présente au Forum Mines 2026 à Ouagadougou, Néré Mining partage son engagement pour la santé, la sécurité et l’environnement dans le secteur minier.',
                'content' => "La troisième édition du Forum Mines, organisée par la Chambre des mines du Burkina du 7 au 9 juillet 2026 à Ouagadougou, a porté sur le thème « Santé, sécurité et environnement : libérer le plein potentiel minier ».\n\nÀ travers la présence de Riverstone Karma SA, détenue par Néré Mining, l'entreprise a participé aux échanges, aux panels et aux présentations consacrés aux enjeux HSE. Cette participation a permis de partager les expériences du secteur, de découvrir les évolutions réglementaires et de renforcer les bonnes pratiques.\n\nNéré Mining réaffirme ainsi sa volonté de promouvoir une culture de prévention et d'amélioration continue, en plaçant la santé et la sécurité au cœur de la performance minière.\n\nSource : https://www.nere-mining.bf/2026/07/16/forum-mines-2026-nere-mining-reaffirme-son-engagement-en-faveur-des-pratiques-durables-dans-lexploitation-miniere/",
                'published_at' => '2026-07-16 08:00:00',
            ],
            [
                'title' => "Semaine des Activités Minières de l'Afrique de l'Ouest",
                'category' => 'Événement',
                'excerpt' => 'Retour sur la 6e édition de la SAMAO, consacrée aux stratégies de développement liées aux minéraux critiques pour les pays africains.',
                'content' => "La 6e édition de la Semaine des Activités Minières de l'Afrique de l'Ouest (SAMAO) a mis en avant le thème « Les minéraux critiques : quelles stratégies de développement pour les pays africains ? ».\n\nCette rencontre souligne le rôle du secteur minier dans l'industrialisation du continent, la création de chaînes de valeur, le développement des ressources humaines et le soutien aux petites et moyennes entreprises. Elle rappelle également l'importance d'une approche intégrée et d'une coopération durable entre les pouvoirs publics, les acteurs privés, la société civile et les partenaires techniques et financiers.\n\nSource : https://www.nere-mining.bf/2024/11/29/semaine-des-activites-minieres-de-lafrique-de-louest/",
                'published_at' => '2024-11-29 08:00:00',
            ],
        ];

        foreach ($articles as $article) {
            $slug = Str::slug($article['title']);
            $exists = DB::table('news')->where('slug', $slug)->exists();

            if (! $exists) {
                DB::table('news')->insert([
                    ...$article,
                    'slug' => $slug,
                    'image_path' => null,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }

    public function down(): void
    {
        $titles = [
            "Annulation du contrat d'achat d'or : Riverstone Karma SA salue une décision judiciaire historique",
            "Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l'exploitation minière",
            "Semaine des Activités Minières de l'Afrique de l'Ouest",
        ];

        DB::table('news')->whereIn('title', $titles)->delete();
    }
};
