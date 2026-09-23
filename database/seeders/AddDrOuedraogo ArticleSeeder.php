<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AddDrOuedragoArticleSeeder extends Seeder
{
    /**
     * Seeder non-destructif - Ajoute l'article du Dr OUEDRAOGO
     * sans supprimer les actualités existantes
     */
    public function run(): void
    {
        $this->command->info('📰 Checking if Dr OUEDRAOGO article exists...');

        // Vérifier si l'article existe déjà
        $exists = DB::table('news')
            ->where('title', 'LIKE', '%Dr Elie Justin OUEDRAOGO%')
            ->orWhere('title', 'LIKE', '%Dr OUEDRAOGO%')
            ->exists();

        if ($exists) {
            $this->command->warn('   ⚠️  Article already exists - skipping');
            return;
        }

        $this->command->info('   ➕ Adding Dr OUEDRAOGO article...');

        try {
            DB::table('news')->insert([
                'title' => 'Zoom sur le Dr Elie Justin OUEDRAOGO, Premier promoteur burkinabè dans les mines',
                'category' => 'Portrait',
                'excerpt' => 'Dr Elie Justin OUEDRAOGO est le dirigeant burkinabè qui possède la plus grande expérience et l\'expertise minière au Burkina Faso et en Afrique de l\'Ouest.',
                'content' => 'Dr Elie Justin OUEDRAOGO, Naaba Baaôgo de Gourcy est le dirigeant burkinabè qui possède la plus grande expérience et l\'expertise minière au Burkina Faso et en Afrique de l\'Ouest. C\'est grâce à cette expérience que la mine de Riverstone Karma SA, dont il est le PDG, fait preuve de résilience et poursuit son exploitation, malgré les crises.

Dr Elie Justin OUEDRAOGO est titulaire d\'un Master en finance et d\'un Doctorat en économie et travaille dans l\'industrie minière au Burkina Faso depuis 32 ans. Entre 1995 et 2000, il a été Ministre des Mines et de l\'énergie au Burkina Faso.

Il a commencé sa carrière en tant que Directeur général d\'une société minière au Burkina Faso (Soremib – mine de Poura) avant d\'être le Directeur National d\'une société minière internationale (SEMAFO). Il est toujours Président du Conseil d\'Administration des sociétés minières au Burkina Faso pour Endeavour Mining (Riverstone Karma et Semafo Mana).

Egalement président d\'honneur de la Chambre des mines du Burkina Faso et du Conseil national du patronat burkinabè, il est co-président de l\'Union des Chambres des Mines de l\'UEMOA.

Dr Elie Justin OUEDRAOGO exploite la mine de Riverstone Karma avec une direction 100% nationale.

Riverstone Karma, la mine résiliente

Riverstone Karma a fait preuve de résilience depuis sa création. En 2015, une partie des installations et des gros engins ont été incendiés par des populations, causant des dommages d\'une valeur d\'environ 3 milliards FCFA.

Depuis sa reprise en mars 2022 auprès de la multinationale Endeavour Mining, la mine a connu des 02 incidents majeurs de sécurité (attaques armées), causant des incendies de véhicules et deux décès. Malgré tout, la mine a maintenu ses activités.

La production d\'or de Karma est passé de 1,353 tonnes d\'or en 2022 à 1,86 tonnes en 2023 pour se situer à 1,419 tonnes en 2024 et à 1,168 tonnes en 2025, selon les données des rapports ITIE-BF.

En 2024, Karma a payé 13,097 milliards FCFA au budget de l\'Etat. En 2024, Karma a créé 409 emplois directs et environ 15 000 chez les sous-traitants.

La somme de 77,809 milliards FCFA a été consacrée aux achats de biens et services auprès d\'entreprises burkinabè en 2024, toujours selon le rapport ITIE-BF 2024. Ce montant représente 98,23% des achats de l\'année de la société.

Source: Mines Actu Burkina',
                'image_path' => 'news/dr-ouedraogo-portrait.jpg',
                'published_at' => Carbon::parse('2026-09-13'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $this->command->info('   ✅ Article added successfully!');
            
        } catch (\Exception $e) {
            $this->command->error('   ❌ Failed to add article: ' . $e->getMessage());
            throw $e;
        }
    }
}
