-- ============================================================================
-- QUICK FIX: Insert minimal data to make the site work
-- Execute this on Supabase SQL Editor if the seeder fails
-- ============================================================================

-- Disable constraints
SET session_replication_role = replica;

-- Clean tables
TRUNCATE TABLE hero_slides CASCADE;
TRUNCATE TABLE leadership_members CASCADE;
TRUNCATE TABLE partners CASCADE;
TRUNCATE TABLE karma_departments CASCADE;
TRUNCATE TABLE site_settings CASCADE;

-- Insert Hero Slides (5 slides)
INSERT INTO hero_slides (title, caption, image_path, is_active, sort_order, type, video_url, created_at, updated_at) VALUES
('', NULL, 'hero/7I0F6l1lmLkgswXMdTDm4ayucFaHUgcMJcnzn0im.jpg', true, 0, 'image', NULL, NOW(), NOW()),
('', NULL, 'hero/H7eEolBtJlKwU8I1VCj8iU4g6G0cNthAfc55kopr.jpg', true, 1, 'image', NULL, NOW(), NOW()),
('', NULL, 'hero/UCrXfKr1OeYXovqWbAyM48WdKySdWoGQgpc99SGs.jpg', true, 2, 'image', NULL, NOW(), NOW()),
('', NULL, 'hero/Aqlk75ywPYBXsQWFa0Z7pRFKAdLsajbcqDPSY3FV.jpg', true, 3, 'image', NULL, NOW(), NOW()),
('Karma, notre mine d''or', NULL, 'images/carousel/Video Project 1.mp4', true, 4, 'video', NULL, NOW(), NOW());

-- Insert Partners (1 partner)
INSERT INTO partners (name, logo_path, website_url, category, is_published, sort_order, created_at, updated_at) VALUES
('NEMMBA', 'partners/sqPw83NAqaqnNgAWob1Dy9viOh4uJAcpjPYFQzgq.jpg', NULL, 'TECHNIQUE', true, 1, NOW(), NOW());

-- Insert Leadership Members (5 members)
INSERT INTO leadership_members (name, title, department, photo_path, is_published, sort_order, hierarchy_level, created_at, updated_at) VALUES
('Dr. Justin Elie OUEDRAOGO', 'Président Directeur Général', NULL, 'leadership/FHjRCacFin5bQgJNB0dEroOLxBSmSJU3sYb516Kp.jpg', true, 1, 1, NOW(), NOW()),
('Justin SAVADOGO', 'Directeur Général Adjoint', 'Administration & Finance', 'leadership/EehYFmt7iBcZxD6IjV3cjsc0zGX7mMgaYjTNWjpO.jpg', true, 2, 2, NOW(), NOW()),
('Pascal Y. OUEDRAOGO', 'Directeur Général Adjoint', 'Approvisionnements', 'leadership/JLkL1GvIx5nmutVSJOvAbWhQoUoeZh1WezFamDbS.jpg', true, 3, 2, NOW(), NOW()),
('Laurent Michel DABIRE', 'Directeur Général Adjoint', 'Affaires Corporatives & Juridiques', 'leadership/AqXRPQ0vFviFTGACz2r95XvL4O8qYyEmiD4LJIuS.jpg', true, 4, 2, NOW(), NOW()),
('Augustine OBENG-FORI', 'DGA par intérim', 'Opérations', 'leadership/zFQPCwKXBz8sG4YTxcumFiogf17CfX1Ed6cjSQhJ.jpg', true, 5, 2, NOW(), NOW());

-- Insert Karma Departments (9 departments)
INSERT INTO karma_departments (tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES
('Administration', 'Administration', 'Administration de la mine', 'Mine Administration', 'Planification stratégique, gestion des opérations, supervision financière et conformité réglementaire.', 'Strategic planning, operations management, financial supervision and regulatory compliance.', 1, true, NOW(), NOW()),
('Ressources humaines', 'Human Resources', 'Ressources humaines', 'Human Resources', 'Les ressources humaines gèrent le personnel et contribuent à garantir un environnement de travail productif, sûr et épanouissant.', 'Human resources manage personnel and help ensure a productive, safe and fulfilling work environment.', 2, true, NOW(), NOW()),
('Sûreté', 'Security', 'Département Sécurité', 'Security Department', 'Le dispositif comprend une CCTV de 44 caméras, une cellule drone, une brigade canine, une permanence des superviseurs 24h/24.', 'The security system includes 44 CCTV cameras, a drone unit, a canine brigade, and 24/7 supervisor presence.', 3, true, NOW(), NOW()),
('Opérations', 'Operations', 'Département Mining', 'Mining Department', 'Le processus minier regroupe la planification, les études de faisabilité, l''analyse économique et les étapes techniques.', 'The mining process includes planning, feasibility studies, economic analysis and technical steps.', 4, true, NOW(), NOW()),
('HSE', 'HSE', 'Hygiène, Santé, Sécurité et Environnement', 'Health, Safety, Security and Environment', 'Le département HSE vise zéro incident grâce à la formation continue, aux inspections régulières, au suivi environnemental.', 'The HSE department aims for zero incidents through continuous training, regular inspections, and environmental monitoring.', 5, true, NOW(), NOW()),
('Traitement', 'Processing', 'Département Processing', 'Processing Department', 'Le Processing est organisé en quatre sections : opérations, maintenance des équipements fixes, métallurgie et infrastructures.', 'Processing is organized into four sections: operations, fixed equipment maintenance, metallurgy and infrastructure.', 6, true, NOW(), NOW()),
('Approvisionnement', 'Supply Chain', 'Chaîne d''approvisionnement (SCM)', 'Supply Chain Management (SCM)', 'Le SCM comprend les Achats, la Logistique, les Contrats et le Magasin. Il est dirigé par une équipe entièrement locale.', 'SCM includes Purchasing, Logistics, Contracts and Warehouse. It is managed by an entirely local team.', 7, true, NOW(), NOW()),
('Technologies', 'IT', 'Département IT', 'IT Department', 'Le département IT accompagne les équipes et les opérations de Karma grâce aux outils et services numériques.', 'The IT department supports Karma''s teams and operations through digital tools and services.', 8, true, NOW(), NOW()),
('Dialogue local', 'Community Relations', 'Relations communautaires', 'Community Relations', 'Le département gère les impacts sociaux, entretient le dialogue avec les communautés et soutient les autorités locales.', 'The department manages social impacts, maintains dialogue with communities and supports local authorities.', 9, true, NOW(), NOW());

-- Insert Site Settings (12 settings)
INSERT INTO site_settings (key, value, type, created_at, updated_at) VALUES
('carousel_autoplay', 'true', 'boolean', NOW(), NOW()),
('carousel_interval', '5000', 'number', NOW(), NOW()),
('carousel_transition_speed', '800', 'number', NOW(), NOW()),
('carousel_pause_on_hover', 'true', 'boolean', NOW(), NOW()),
('carousel_show_indicators', 'true', 'boolean', NOW(), NOW()),
('carousel_show_arrows', 'true', 'boolean', NOW(), NOW()),
('site_name', 'Néré Mining', 'string', NOW(), NOW()),
('contact_email', 'contact@nere-mining.bf', 'string', NOW(), NOW()),
('contact_phone', '+226 XX XX XX XX', 'string', NOW(), NOW()),
('maintenance_mode', 'false', 'boolean', NOW(), NOW()),
('analytics_enabled', 'true', 'boolean', NOW(), NOW()),
('newsletter_enabled', 'true', 'boolean', NOW(), NOW());

-- Re-enable constraints
SET session_replication_role = DEFAULT;

-- Verify
SELECT 'hero_slides' as table_name, COUNT(*) as count FROM hero_slides
UNION ALL SELECT 'leadership_members', COUNT(*) FROM leadership_members
UNION ALL SELECT 'partners', COUNT(*) FROM partners
UNION ALL SELECT 'karma_departments', COUNT(*) FROM karma_departments
UNION ALL SELECT 'site_settings', COUNT(*) FROM site_settings;
