<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductionSeeder extends Seeder
{
    /**
     * Seeder optimisé pour production avec gestion PostgreSQL
     */
    public function run(): void
    {
        $this->command->info('🔄 Starting production database sync...');

        try {
            // Disable constraints
            DB::statement('SET session_replication_role = replica;');

            // Truncate all tables
            $this->command->info('🗑️  Clearing existing data...');
            DB::table('news')->truncate();
            DB::table('partners')->truncate();
            DB::table('hero_slides')->truncate();
            DB::table('karma_departments')->truncate();
            DB::table('site_settings')->truncate();
            DB::table('leadership_members')->truncate();

            // Reset sequences
            DB::statement("SELECT setval('news_id_seq', 1, false);");
            DB::statement("SELECT setval('partners_id_seq', 1, false);");
            DB::statement("SELECT setval('hero_slides_id_seq', 1, false);");
            DB::statement("SELECT setval('karma_departments_id_seq', 1, false);");
            DB::statement("SELECT setval('site_settings_id_seq', 1, false);");
            DB::statement("SELECT setval('leadership_members_id_seq', 1, false);");

            // Insert Hero Slides
            $this->command->info('🎬 Syncing Hero Slides...');
            DB::table('hero_slides')->insert([
                ['title' => '', 'caption' => null, 'image_path' => 'hero/7I0F6l1lmLkgswXMdTDm4ayucFaHUgcMJcnzn0im.jpg', 'is_active' => true, 'sort_order' => 0, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => '', 'caption' => null, 'image_path' => 'hero/H7eEolBtJlKwU8I1VCj8iU4g6G0cNthAfc55kopr.jpg', 'is_active' => true, 'sort_order' => 1, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => '', 'caption' => null, 'image_path' => 'hero/UCrXfKr1OeYXovqWbAyM48WdKySdWoGQgpc99SGs.jpg', 'is_active' => true, 'sort_order' => 2, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => '', 'caption' => null, 'image_path' => 'hero/Aqlk75ywPYBXsQWFa0Z7pRFKAdLsajbcqDPSY3FV.jpg', 'is_active' => true, 'sort_order' => 3, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'Karma, notre mine d\'or', 'caption' => null, 'image_path' => 'images/carousel/Video Project 1.mp4', 'is_active' => true, 'sort_order' => 4, 'type' => 'video', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Hero Slides synced (5 records)');

            // Insert Partners
            $this->command->info('🤝 Syncing Partners...');
            DB::table('partners')->insert([
                'name' => 'NEMMBA',
                'logo_path' => 'partners/sqPw83NAqaqnNgAWob1Dy9viOh4uJAcpjPYFQzgq.jpg',
                'website_url' => null,
                'category' => 'TECHNIQUE',
                'is_published' => true,
                'sort_order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $this->command->info('   ✓ Partners synced (1 record)');

            // Insert Leadership Members
            $this->command->info('👥 Syncing Leadership Members...');
            DB::table('leadership_members')->insert([
                ['name' => 'Dr. Justin Elie OUEDRAOGO', 'title' => 'Président Directeur Général', 'department' => null, 'photo_path' => 'leadership/FHjRCacFin5bQgJNB0dEroOLxBSmSJU3sYb516Kp.jpg', 'is_published' => true, 'sort_order' => 1, 'hierarchy_level' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Justin SAVADOGO', 'title' => 'Directeur Général Adjoint', 'department' => 'Administration & Finance', 'photo_path' => 'leadership/EehYFmt7iBcZxD6IjV3cjsc0zGX7mMgaYjTNWjpO.jpg', 'is_published' => true, 'sort_order' => 2, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Pascal Y. OUEDRAOGO', 'title' => 'Directeur Général Adjoint', 'department' => 'Approvisionnements', 'photo_path' => 'leadership/JLkL1GvIx5nmutVSJOvAbWhQoUoeZh1WezFamDbS.jpg', 'is_published' => true, 'sort_order' => 3, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Laurent Michel DABIRE', 'title' => 'Directeur Général Adjoint', 'department' => 'Affaires Corporatives & Juridiques', 'photo_path' => 'leadership/AqXRPQ0vFviFTGACz2r95XvL4O8qYyEmiD4LJIuS.jpg', 'is_published' => true, 'sort_order' => 4, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Augustine OBENG-FORI', 'title' => 'DGA par intérim', 'department' => 'Opérations', 'photo_path' => 'leadership/zFQPCwKXBz8sG4YTxcumFiogf17CfX1Ed6cjSQhJ.jpg', 'is_published' => true, 'sort_order' => 5, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Leadership members synced (5 records)');

            // Insert Karma Departments
            $this->command->info('🏢 Syncing Karma Departments...');
            DB::table('karma_departments')->insert([
                ['tag_fr' => 'Administration', 'tag_en' => 'Administration', 'title_fr' => 'Administration de la mine', 'title_en' => 'Mine Administration', 'body_fr' => 'Planification stratégique, gestion des opérations, supervision financière et conformité réglementaire.', 'body_en' => 'Strategic planning, operations management, financial supervision and regulatory compliance.', 'sort_order' => 1, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Ressources humaines', 'tag_en' => 'Human Resources', 'title_fr' => 'Ressources humaines', 'title_en' => 'Human Resources', 'body_fr' => 'Les ressources humaines gèrent le personnel et contribuent à garantir un environnement de travail productif, sûr et épanouissant.', 'body_en' => 'Human resources manage personnel and help ensure a productive, safe and fulfilling work environment.', 'sort_order' => 2, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Sûreté', 'tag_en' => 'Security', 'title_fr' => 'Département Sécurité', 'title_en' => 'Security Department', 'body_fr' => 'Le dispositif comprend une CCTV de 44 caméras, une cellule drone, une brigade canine, une permanence des superviseurs 24h/24.', 'body_en' => 'The security system includes 44 CCTV cameras, a drone unit, a canine brigade, and 24/7 supervisor presence.', 'sort_order' => 3, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Opérations', 'tag_en' => 'Operations', 'title_fr' => 'Département Mining', 'title_en' => 'Mining Department', 'body_fr' => 'Le processus minier regroupe la planification, les études de faisabilité, l\'analyse économique et les étapes techniques.', 'body_en' => 'The mining process includes planning, feasibility studies, economic analysis and technical steps.', 'sort_order' => 4, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'HSE', 'tag_en' => 'HSE', 'title_fr' => 'Hygiène, Santé, Sécurité et Environnement', 'title_en' => 'Health, Safety, Security and Environment', 'body_fr' => 'Le département HSE vise zéro incident grâce à la formation continue, aux inspections régulières, au suivi environnemental.', 'body_en' => 'The HSE department aims for zero incidents through continuous training, regular inspections, and environmental monitoring.', 'sort_order' => 5, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Traitement', 'tag_en' => 'Processing', 'title_fr' => 'Département Processing', 'title_en' => 'Processing Department', 'body_fr' => 'Le Processing est organisé en quatre sections : opérations, maintenance des équipements fixes, métallurgie et infrastructures.', 'body_en' => 'Processing is organized into four sections: operations, fixed equipment maintenance, metallurgy and infrastructure.', 'sort_order' => 6, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Approvisionnement', 'tag_en' => 'Supply Chain', 'title_fr' => 'Chaîne d\'approvisionnement (SCM)', 'title_en' => 'Supply Chain Management (SCM)', 'body_fr' => 'Le SCM comprend les Achats, la Logistique, les Contrats et le Magasin. Il est dirigé par une équipe entièrement locale.', 'body_en' => 'SCM includes Purchasing, Logistics, Contracts and Warehouse. It is managed by an entirely local team.', 'sort_order' => 7, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Technologies', 'tag_en' => 'IT', 'title_fr' => 'Département IT', 'title_en' => 'IT Department', 'body_fr' => 'Le département IT accompagne les équipes et les opérations de Karma grâce aux outils et services numériques.', 'body_en' => 'The IT department supports Karma\'s teams and operations through digital tools and services.', 'sort_order' => 8, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
                ['tag_fr' => 'Dialogue local', 'tag_en' => 'Community Relations', 'title_fr' => 'Relations communautaires', 'title_en' => 'Community Relations', 'body_fr' => 'Le département gère les impacts sociaux, entretient le dialogue avec les communautés et soutient les autorités locales.', 'body_en' => 'The department manages social impacts, maintains dialogue with communities and supports local authorities.', 'sort_order' => 9, 'is_published' => true, 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Departments synced (9 records)');

            // Insert Site Settings
            $this->command->info('⚙️  Syncing Site Settings...');
            DB::table('site_settings')->insert([
                ['key' => 'carousel_autoplay', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_interval', 'value' => '5000', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_transition_speed', 'value' => '800', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_pause_on_hover', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_show_indicators', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_show_arrows', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'site_name', 'value' => 'Néré Mining', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'contact_email', 'value' => 'contact@nere-mining.bf', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'contact_phone', 'value' => '+226 XX XX XX XX', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'maintenance_mode', 'value' => 'false', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'analytics_enabled', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'newsletter_enabled', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Settings synced (12 records)');

            // Note: News table has TEXT/LONGTEXT columns, skipping for now to avoid issues
            $this->command->info('📰 Skipping News (handled separately)...');

            // Re-enable constraints
            DB::statement('SET session_replication_role = DEFAULT;');

            $this->command->info('\n✅ Database sync completed successfully!');
            $this->command->info('📊 Synced: 5 hero_slides + 1 partner + 5 leadership + 9 departments + 12 settings');

        } catch (\Exception $e) {
            $this->command->error('❌ Seeder failed: ' . $e->getMessage());
            $this->command->error('File: ' . $e->getFile() . ':' . $e->getLine());
            DB::statement('SET session_replication_role = DEFAULT;');
            throw $e;
        }
    }
}
