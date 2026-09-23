<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductionSeeder extends Seeder
{
    /**
     * Seeder optimisé pour production avec gestion PostgreSQL
     * Restaure toutes les données gérables depuis le panel admin
     */
    public function run(): void
    {
        $this->command->info('🔄 Starting production database sync...');

        try {
            // Disable constraints
            DB::statement('SET session_replication_role = replica;');

            // Truncate all manageable tables
            $this->command->info('🗑️  Clearing existing data...');
            DB::table('news')->truncate();
            DB::table('partners')->truncate();
            DB::table('hero_slides')->truncate();
            DB::table('karma_departments')->truncate();
            DB::table('site_settings')->truncate();
            DB::table('leadership_members')->truncate();
            DB::table('certifications')->truncate();
            DB::table('job_offers')->truncate();
            DB::table('press_documents')->truncate();
            DB::table('reports')->truncate();

            // Reset sequences
            $this->command->info('🔄 Resetting sequences...');
            DB::statement("SELECT setval('news_id_seq', 1, false);");
            DB::statement("SELECT setval('partners_id_seq', 1, false);");
            DB::statement("SELECT setval('hero_slides_id_seq', 1, false);");
            DB::statement("SELECT setval('karma_departments_id_seq', 1, false);");
            DB::statement("SELECT setval('site_settings_id_seq', 1, false);");
            DB::statement("SELECT setval('leadership_members_id_seq', 1, false);");
            DB::statement("SELECT setval('certifications_id_seq', 1, false);");
            DB::statement("SELECT setval('job_offers_id_seq', 1, false);");
            DB::statement("SELECT setval('press_documents_id_seq', 1, false);");
            DB::statement("SELECT setval('reports_id_seq', 1, false);");

            // ============================================
            // 1. HERO SLIDES (Carousel accueil)
            // ============================================
            $this->command->info('🎬 Syncing Hero Slides...');
            DB::table('hero_slides')->insert([
                ['title' => '', 'caption' => null, 'image_path' => 'hero/7I0F6l1lmLkgswXMdTDm4ayucFaHUgcMJcnzn0im.jpg', 'is_active' => true, 'sort_order' => 0, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => '', 'caption' => null, 'image_path' => 'hero/H7eEolBtJlKwU8I1VCj8iU4g6G0cNthAfc55kopr.jpg', 'is_active' => true, 'sort_order' => 1, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => '', 'caption' => null, 'image_path' => 'hero/UCrXfKr1OeYXovqWbAyM48WdKySdWoGQgpc99SGs.jpg', 'is_active' => true, 'sort_order' => 2, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => '', 'caption' => null, 'image_path' => 'hero/Aqlk75ywPYBXsQWFa0Z7pRFKAdLsajbcqDPSY3FV.jpg', 'is_active' => true, 'sort_order' => 3, 'type' => 'image', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
                ['title' => 'Karma, notre mine d\'or', 'caption' => null, 'image_path' => 'images/carousel/Video Project 1.mp4', 'is_active' => true, 'sort_order' => 4, 'type' => 'video', 'video_url' => null, 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Hero Slides synced (5 records)');

            // ============================================
            // 2. PARTNERS (Partenaires)
            // ============================================
            $this->command->info('🤝 Syncing Partners...');
            DB::table('partners')->insert([
                [
                    'name' => 'NEMMBA',
                    'logo_path' => 'partners/sqPw83NAqaqnNgAWob1Dy9viOh4uJAcpjPYFQzgq.jpg',
                    'website_url' => null,
                    'category' => 'TECHNIQUE',
                    'is_published' => true,
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            ]);
            $this->command->info('   ✓ Partners synced (1 record)');

            // ============================================
            // 3. LEADERSHIP MEMBERS (Direction)
            // ============================================
            $this->command->info('👥 Syncing Leadership Members...');
            DB::table('leadership_members')->insert([
                ['name' => 'Dr. Justin Elie OUEDRAOGO', 'title' => 'Président Directeur Général', 'department' => null, 'photo_path' => 'leadership/FHjRCacFin5bQgJNB0dEroOLxBSmSJU3sYb516Kp.jpg', 'is_published' => true, 'sort_order' => 1, 'hierarchy_level' => 1, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Justin SAVADOGO', 'title' => 'Directeur Général Adjoint', 'department' => 'Administration & Finance', 'photo_path' => 'leadership/EehYFmt7iBcZxD6IjV3cjsc0zGX7mMgaYjTNWjpO.jpg', 'is_published' => true, 'sort_order' => 2, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Pascal Y. OUEDRAOGO', 'title' => 'Directeur Général Adjoint', 'department' => 'Approvisionnements', 'photo_path' => 'leadership/JLkL1GvIx5nmutVSJOvAbWhQoUoeZh1WezFamDbS.jpg', 'is_published' => true, 'sort_order' => 3, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Laurent Michel DABIRE', 'title' => 'Directeur Général Adjoint', 'department' => 'Affaires Corporatives & Juridiques', 'photo_path' => 'leadership/AqXRPQ0vFviFTGACz2r95XvL4O8qYyEmiD4LJIuS.jpg', 'is_published' => true, 'sort_order' => 4, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
                ['name' => 'Augustine OBENG-FORI', 'title' => 'DGA par intérim', 'department' => 'Opérations', 'photo_path' => 'leadership/zFQPCwKXBz8sG4YTxcumFiogf17CfX1Ed6cjSQhJ.jpg', 'is_published' => true, 'sort_order' => 5, 'hierarchy_level' => 2, 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Leadership members synced (5 records)');

            // ============================================
            // 4. KARMA DEPARTMENTS (Départements)
            // ============================================
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

            // ============================================
            // 5. SITE SETTINGS (Paramètres)
            // ============================================
            $this->command->info('⚙️  Syncing Site Settings...');
            DB::table('site_settings')->insert([
                ['key' => 'carousel_autoplay', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_interval', 'value' => '5000', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_transition_speed', 'value' => '800', 'type' => 'number', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_pause_on_hover', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_show_indicators', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'carousel_show_arrows', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'site_name', 'value' => 'Néré Mining', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'company_email', 'value' => 'info@nere-mining.bf', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'company_phone', 'value' => '+226 25 33 35 69', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'maintenance_mode', 'value' => 'false', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'analytics_enabled', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'newsletter_enabled', 'value' => 'true', 'type' => 'boolean', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'social_facebook', 'value' => 'https://facebook.com/nere-mining', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'social_linkedin', 'value' => 'https://linkedin.com/company/nere-mining', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'social_instagram', 'value' => 'https://instagram.com/nere_mining', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'social_youtube', 'value' => 'https://youtube.com/@neremining', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'footer_copyright', 'value' => '© '.date('Y').' Néré Mining. Tous droits réservés.', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
                ['key' => 'footer_description', 'value' => 'Groupe aurifère burkinabè exploitant la mine de Karma dans le nord du Burkina Faso.', 'type' => 'string', 'created_at' => now(), 'updated_at' => now()],
            ]);
            $this->command->info('   ✓ Settings synced (18 records)');

            // ============================================
            // 6. NEWS (Actualités)
            // ============================================
            $this->command->info('📰 Syncing News...');
            DB::table('news')->insert([
                [
                    'title' => 'Annulation du contrat d\'achat d\'or: Riverstone Karma SA salue une décision judiciaire historique du Tribunal de commerce de Ouagadougou',
                    'category' => 'Actualités',
                    'excerpt' => 'Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l\'opposait aux sociétés Franco-Nevada et Sandstorm Gold Ltd.',
                    'content' => 'Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l\'opposait aux sociétés Franco-Nevada et Sandstorm Gold Ltd.',
                    'image_path' => 'news/ZJ58L6cbb9z6C4qPwArMnxzy0A4RQW4doJDfc7SV.jpg',
                    'published_at' => Carbon::parse('2026-08-12'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => 'Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l\'exploitation minière',
                    'category' => 'Événement',
                    'excerpt' => 'La troisième édition du Forum Mines a officiellement ouvert ses portes le mardi 7 juillet 2026 à Ouagadougou.',
                    'content' => 'La troisième édition du Forum Mines a officiellement ouvert ses portes le mardi 7 juillet 2026 à Ouagadougou.',
                    'image_path' => 'news/g4XciRGY5t48TKSsjdneCu5APzh3g673Q30YMnpr.jpg',
                    'published_at' => Carbon::parse('2026-08-22'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'title' => '6ème édition de la SAMAO.',
                    'category' => 'Partenariats',
                    'excerpt' => 'Nous renforçons nos partenariats avec les entreprises et organisations locales pour créer de la valeur partagée.',
                    'content' => 'Nous renforçons nos partenariats avec les entreprises et organisations locales pour créer de la valeur partagée.',
                    'image_path' => 'news/F6nUuFafpUqWZu1MKDcY5PzQbQsDXsFMXmEOVNuX.png',
                    'published_at' => Carbon::parse('2024-11-29'),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
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
                ],
            ]);
            $this->command->info('   ✓ News synced (4 records)');

            // ============================================
            // 7. CERTIFICATIONS
            // ============================================
            $this->command->info('📜 Syncing Certifications...');
            DB::table('certifications')->insert([
                [
                    'name' => 'ISO 14001:2015',
                    'description' => 'Système de management environnemental',
                    'logo_path' => 'certifications/iso-14001.png',
                    'issued_at' => Carbon::parse('2020-01-15'),
                    'expires_at' => null,
                    'is_active' => true,
                    'sort_order' => 1,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'name' => 'ISO 45001:2018',
                    'description' => 'Système de management de la santé et sécurité au travail',
                    'logo_path' => 'certifications/iso-45001.png',
                    'issued_at' => Carbon::parse('2021-06-20'),
                    'expires_at' => null,
                    'is_active' => true,
                    'sort_order' => 2,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            $this->command->info('   ✓ Certifications synced (2 records)');

            // ============================================
            // 8. JOB OFFERS (Offres d'emploi)
            // ============================================
            $this->command->info('💼 Syncing Job Offers...');
            DB::table('job_offers')->insert([
                [
                    'title' => 'Ingénieur Minier Senior',
                    'department' => 'Opérations',
                    'location' => 'Karma, Burkina Faso',
                    'contract_type' => 'CDI',
                    'description' => 'Nous recrutons un ingénieur minier expérimenté pour rejoindre notre équipe.',
                    'requirements' => 'Bac+5 en génie minier, 5+ ans d\'expérience',
                    'deadline' => Carbon::parse('2026-10-31'),
                    'is_published' => true,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            $this->command->info('   ✓ Job Offers synced (1 record)');

            // ============================================
            // 9. PRESS DOCUMENTS (Documents de presse)
            // ============================================
            $this->command->info('📄 Syncing Press Documents...');
            DB::table('press_documents')->insert([
                [
                    'title' => 'Communiqué de presse - 2026',
                    'document_type' => 'communique',
                    'description' => 'Communiqué officiel de Néré Mining',
                    'file_path' => 'press/communique-2026.pdf',
                    'published_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            $this->command->info('   ✓ Press Documents synced (1 record)');

            // ============================================
            // 10. REPORTS (Rapports)
            // ============================================
            $this->command->info('📊 Syncing Reports...');
            DB::table('reports')->insert([
                [
                    'title' => 'Rapport de durabilité 2025',
                    'category' => 'Durabilité',
                    'description' => 'Rapport annuel sur les performances de durabilité de Néré Mining',
                    'file_path' => 'reports/sustainability-2025.pdf',
                    'cover_image' => 'reports/cover-2025.jpg',
                    'published_at' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
            $this->command->info('   ✓ Reports synced (1 record)');

            // ============================================
            // 11. SITE CONTENTS (Contenus statiques)
            // ============================================
            // NOTE: site_contents est géré par la migration 2026_09_21_120000_create_site_contents_table.php
            $this->command->info('📝 Site contents already populated by migration');

            // Re-enable constraints
            DB::statement('SET session_replication_role = DEFAULT;');

            $this->command->info('\n✅ Database sync completed successfully!');
            $this->command->info('📊 Synced:');
            $this->command->info('   - 5 hero slides');
            $this->command->info('   - 1 partner');
            $this->command->info('   - 5 leadership members');
            $this->command->info('   - 9 departments');
            $this->command->info('   - 18 settings');
            $this->command->info('   - 4 news articles');
            $this->command->info('   - 2 certifications');
            $this->command->info('   - 1 job offer');
            $this->command->info('   - 1 press document');
            $this->command->info('   - 1 report');
            $this->command->info('   - Site contents populated by migration');

        } catch (\Exception $e) {
            $this->command->error('❌ Seeder failed: ' . $e->getMessage());
            $this->command->error('File: ' . $e->getFile() . ':' . $e->getLine());
            DB::statement('SET session_replication_role = DEFAULT;');
            throw $e;
        }
    }
}

