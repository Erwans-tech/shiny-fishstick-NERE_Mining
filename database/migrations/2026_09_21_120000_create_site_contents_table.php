<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_contents', function (Blueprint $table) {
            $table->id();
            $table->string('section', 40);
            $table->string('key', 80);
            $table->string('label_fr');
            $table->string('label_en')->nullable();
            $table->text('value_fr')->nullable();
            $table->text('value_en')->nullable();
            $table->string('icon', 20)->nullable();
            $table->string('suffix', 30)->nullable();
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->index(['section', 'sort_order']);
        });

        $now = now();
        $rows = [
            ['section' => 'home_stats', 'key' => 'direct-employees', 'label_fr' => 'Emplois directs', 'label_en' => 'Direct employees', 'value_fr' => '409', 'value_en' => '409', 'icon' => '👥', 'suffix' => ''],
            ['section' => 'home_stats', 'key' => 'subcontracted-workers', 'label_fr' => 'Travailleurs sous-traitants', 'label_en' => 'Subcontracted workers', 'value_fr' => '1500', 'value_en' => '1500', 'icon' => '🧰', 'suffix' => ''],
            ['section' => 'home_stats', 'key' => 'local-employment', 'label_fr' => 'Emploi local et régional', 'label_en' => 'Local & regional employment', 'value_fr' => '60', 'value_en' => '60', 'icon' => '📍', 'suffix' => '%'],
            ['section' => 'home_stats', 'key' => 'burkinabe-workers', 'label_fr' => 'Travailleurs burkinabè', 'label_en' => 'Burkinabe workers', 'value_fr' => '99', 'value_en' => '99', 'icon' => '🇧🇫', 'suffix' => '%'],
            ['section' => 'karma_stats', 'key' => 'annual-production', 'label_fr' => 'Production annuelle moyenne (2019-2021)', 'label_en' => 'Annual average (2019-2021)', 'value_fr' => '97', 'value_en' => '97', 'suffix' => ' koz'],
            ['section' => 'karma_stats', 'key' => 'gold-reserves', 'label_fr' => 'Réserves or totales', 'label_en' => 'Total gold reserves', 'value_fr' => '949', 'value_en' => '949', 'suffix' => ' koz'],
            ['section' => 'karma_stats', 'key' => 'ore-reserves', 'label_fr' => 'Réserves minerai', 'label_en' => 'Ore reserves', 'value_fr' => '33.2', 'value_en' => '33.2', 'suffix' => ' Mt'],
            ['section' => 'karma_stats', 'key' => 'mine-life', 'label_fr' => 'Durée mine étendue', 'label_en' => 'Extended mine life', 'value_fr' => '11', 'value_en' => '11', 'suffix' => ' yrs'],
            ['section' => 'sustainability_stats', 'key' => 'direct-villages', 'label_fr' => 'Villages impactés directement', 'label_en' => 'Villages directly impacted', 'value_fr' => '11', 'value_en' => '11', 'icon' => '🏘️'],
            ['section' => 'sustainability_stats', 'key' => 'indirect-villages', 'label_fr' => 'Villages impactés indirectement', 'label_en' => 'Villages indirectly impacted', 'value_fr' => '23', 'value_en' => '23', 'icon' => '🗺️'],
            ['section' => 'sustainability_stats', 'key' => 'influence-area', 'label_fr' => 'Localités dans le rayon d’influence', 'label_en' => 'Localities in the area of influence', 'value_fr' => '44', 'value_en' => '44', 'icon' => '📍'],
            ['section' => 'sustainability_stats', 'key' => 'community-investment', 'label_fr' => 'Investissement communautaire (FCFA)', 'label_en' => 'Community investment (FCFA)', 'value_fr' => '1.419', 'value_en' => '1.419', 'suffix' => ' Md', 'icon' => '🤝'],
            ['section' => 'sustainability_stats', 'key' => 'rd149', 'label_fr' => 'RD149 bitumée', 'label_en' => 'RD149 paved', 'value_fr' => '7.5', 'value_en' => '7.5', 'suffix' => ' km', 'icon' => '🛣️'],
            ['section' => 'karma_history', 'key' => 'karma-2007', 'label_fr' => '2007', 'label_en' => '2007', 'value_fr' => 'Acquisition par True Gold Mining', 'value_en' => 'Acquisition by True Gold Mining'],
            ['section' => 'karma_history', 'key' => 'karma-2012-2016', 'label_fr' => '2012-2016', 'label_en' => '2012-2016', 'value_fr' => 'Exploration et développement', 'value_en' => 'Exploration & development'],
            ['section' => 'karma_history', 'key' => 'karma-2017-2018', 'label_fr' => '2017-2018', 'label_en' => '2017-2018', 'value_fr' => 'Phase de construction', 'value_en' => 'Construction phase'],
            ['section' => 'karma_history', 'key' => 'karma-2019', 'label_fr' => '2019', 'label_en' => '2019', 'value_fr' => 'Première production', 'value_en' => 'First production'],
            ['section' => 'karma_history', 'key' => 'karma-2024', 'label_fr' => '2024', 'label_en' => '2024', 'value_fr' => 'Transition Néré Mining', 'value_en' => 'Néré Mining transition'],
            ['section' => 'karma_history', 'key' => 'karma-2026', 'label_fr' => '2026+', 'label_en' => '2026+', 'value_fr' => 'Usine CIL et expansion', 'value_en' => 'CIL plant & expansion'],
        ];
        foreach ($rows as $order => $row) {
            DB::table('site_contents')->insert(array_merge($row, ['sort_order' => $order + 1, 'is_published' => true, 'created_at' => $now, 'updated_at' => $now]));
        }

        DB::table('site_settings')->insertOrIgnore([
            ['key' => 'home_description', 'value' => 'Néré Mining SA est une entreprise minière aurifère majoritairement détenue par des capitaux burkinabè. À travers l’exploitation de sa mine de Karma et ses activités d’exploration, Néré Mining ambitionne de contribuer au développement d’un secteur minier national performant, responsable et créateur de valeur pour le Burkina Faso.', 'type' => 'textarea', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'ceo_message_fr', 'value' => 'Bienvenue sur le site officiel de Néré Mining.\n\nÀ travers ces pages, vous découvrirez nos activités de prospection, d’extraction, de production et de commercialisation de l’or, menées depuis notre site de Karma, situé dans la région du Nord du Burkina Faso.\n\nNotre mission s’inscrit pleinement dans la dynamique de développement économique du pays. Nous œuvrons à créer de la valeur durable, au bénéfice de la région, du Burkina Faso dans son ensemble, et des communautés locales qui nous entourent.', 'type' => 'textarea', 'created_at' => $now, 'updated_at' => $now],
            ['key' => 'ceo_message_en', 'value' => 'Welcome to the official website of Néré Mining.\n\nThrough these pages, you will discover our gold exploration, extraction, production and marketing activities, carried out from our Karma site in the Northern Region of Burkina Faso.\n\nOur mission fully supports the country\'s economic development. We work to create lasting value for the region, Burkina Faso as a whole and the local communities around us.', 'type' => 'textarea', 'created_at' => $now, 'updated_at' => $now],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('site_contents');
    }
};
