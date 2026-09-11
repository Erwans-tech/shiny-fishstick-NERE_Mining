-- ============================================================================
-- SCRIPT D'IMPORT COMPLET - BASE DE DONNÉES LOCALE VERS PRODUCTION
-- Ce script va remplacer toutes les données de production par celles de local
-- ============================================================================

-- Désactiver temporairement les contraintes de clés étrangères
SET session_replication_role = replica;

-- ============================================================================
-- 1. NETTOYAGE DES TABLES
-- ============================================================================

TRUNCATE TABLE hero_slides RESTART IDENTITY CASCADE;
TRUNCATE TABLE leadership_members RESTART IDENTITY CASCADE;
TRUNCATE TABLE partners RESTART IDENTITY CASCADE;
TRUNCATE TABLE news RESTART IDENTITY CASCADE;
TRUNCATE TABLE karma_departments RESTART IDENTITY CASCADE;
TRUNCATE TABLE site_settings RESTART IDENTITY CASCADE;

-- ============================================================================
-- 2. INSERTION DES HERO SLIDES (5 slides : 4 images + 1 vidéo)
-- ============================================================================

INSERT INTO hero_slides (id, title, caption, image_path, is_active, sort_order, created_at, updated_at, type, video_url) VALUES
(6, '', NULL, 'hero/7I0F6l1lmLkgswXMdTDm4ayucFaHUgcMJcnzn0im.jpg', true, 0, '2026-09-07 13:52:26', '2026-09-07 13:52:26', 'image', NULL),
(7, '', NULL, 'hero/H7eEolBtJlKwU8I1VCj8iU4g6G0cNthAfc55kopr.jpg', true, 1, '2026-09-07 13:52:26', '2026-09-07 13:52:26', 'image', NULL),
(8, '', NULL, 'hero/UCrXfKr1OeYXovqWbAyM48WdKySdWoGQgpc99SGs.jpg', true, 2, '2026-09-07 13:52:26', '2026-09-07 13:52:26', 'image', NULL),
(10, '', NULL, 'hero/Aqlk75ywPYBXsQWFa0Z7pRFKAdLsajbcqDPSY3FV.jpg', true, 3, '2026-09-07 13:52:26', '2026-09-07 13:52:26', 'image', NULL),
(17, 'Karma, notre mine d''or', NULL, 'images/carousel/Video Project 1.mp4', true, 4, '2026-09-07 13:52:26', '2026-09-07 13:52:26', 'video', NULL);

-- Réinitialiser la séquence des IDs
SELECT setval('hero_slides_id_seq', (SELECT MAX(id) FROM hero_slides));

-- ============================================================================
-- 3. INSERTION DES MEMBRES DU LEADERSHIP (5 membres)
-- ============================================================================

INSERT INTO leadership_members (id, name, title, department, photo_path, is_published, sort_order, created_at, updated_at, hierarchy_level) VALUES
(1, 'Dr. Justin Elie OUEDRAOGO', 'Président Directeur Général', NULL, 'leadership/FHjRCacFin5bQgJNB0dEroOLxBSmSJU3sYb516Kp.jpg', true, 1, '2026-09-07 13:52:26', '2026-09-08 07:57:07', 1),
(2, 'Justin SAVADOGO', 'Directeur Général Adjoint', 'Administration & Finance', 'leadership/EehYFmt7iBcZxD6IjV3cjsc0zGX7mMgaYjTNWjpO.jpg', true, 2, '2026-09-07 13:52:26', '2026-09-08 07:57:07', 2),
(3, 'Pascal Y. OUEDRAOGO', 'Directeur Général Adjoint', 'Approvisionnements', 'leadership/JLkL1GvIx5nmutVSJOvAbWhQoUoeZh1WezFamDbS.jpg', true, 3, '2026-09-07 13:52:26', '2026-09-08 07:57:07', 2),
(4, 'Laurent Michel DABIRE', 'Directeur Général Adjoint', 'Affaires Corporatives & Juridiques', 'leadership/AqXRPQ0vFviFTGACz2r95XvL4O8qYyEmiD4LJIuS.jpg', true, 4, '2026-09-07 13:52:26', '2026-09-08 07:57:07', 2),
(5, 'Augustine OBENG-FORI', 'DGA par intérim', 'Opérations', 'leadership/zFQPCwKXBz8sG4YTxcumFiogf17CfX1Ed6cjSQhJ.jpg', true, 5, '2026-09-07 13:52:26', '2026-09-08 07:57:07', 2);

SELECT setval('leadership_members_id_seq', (SELECT MAX(id) FROM leadership_members));

-- ============================================================================
-- 4. INSERTION DU PARTENAIRE (1 partenaire : NEMMBA)
-- ============================================================================

INSERT INTO partners (id, name, logo_path, website_url, category, is_published, sort_order, created_at, updated_at) VALUES
(1, 'NEMMBA', 'partners/sqPw83NAqaqnNgAWob1Dy9viOh4uJAcpjPYFQzgq.jpg', NULL, 'TECHNIQUE', true, 4, '2026-09-08 07:56:37', '2026-09-08 07:56:37');

SELECT setval('partners_id_seq', (SELECT MAX(id) FROM partners));

-- ============================================================================
-- 5. INSERTION DES ACTUALITÉS (3 news)
-- ============================================================================

INSERT INTO news (id, title, category, excerpt, image_path, published_at, created_at, updated_at, content, slug, gallery_images) VALUES
(1, 'Démarrage de production officielle à Karma', 'Production', 'Néré Mining annonce le démarrage de la production commerciale de sa mine d''or Karma, marquant une étape historique pour le secteur minier burkinabè.', 'news/A1cOlD00GIoHIqBKWuiWdKtMUPxRoQ3HEPbJqNGh.jpg', '2026-08-10 00:00:00', '2026-09-07 13:52:26', '2026-09-08 07:58:30', 'Néré Mining SA est fière d''annoncer le démarrage officiel de la production commerciale de sa mine d''or Karma, située dans la province du Yatenga, région Nord du Burkina Faso. Cette étape marque un tournant majeur pour l''entreprise et le secteur minier national.

La mine de Karma, acquise en 2022, représente un projet d''envergure nationale. Avec une capacité de traitement de 3,8 millions de tonnes de minerai par an, elle s''inscrit parmi les sites miniers les plus performants du pays. Les premières coulées d''or commercial ont été réalisées avec succès, confirmant la qualité exceptionnelle du gisement et la maîtrise technique des équipes opérationnelles.

« Ce démarrage couronne plusieurs années de préparation intensive et d''investissements structurants. Néré Mining devient ainsi la première société minière de droit burkinabè détenue majoritairement par des actionnaires nationaux à produire de l''or à l''échelle industrielle », a déclaré Dr. Justin Elie Ouedraogo, Président Directeur Général de Néré Mining.

Le projet Karma génère déjà plus de 1 200 emplois directs et plusieurs milliers d''emplois indirects, contribuant ainsi au développement économique et social de la région. L''entreprise s''engage également à respecter les plus hauts standards environnementaux et à maintenir un dialogue permanent avec les communautés locales.', 'demarrage-de-production-officielle-a-karma', NULL),
(2, 'Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l''exploitation minière', 'HSE', 'La troisième édition du Forum Mines a officiellement ouvert ses portes le mardi 7 juillet 2026 à Ouagadougou. Organisée par la Chambre des mines du Burkina, cette rencontre s''est déroulée du 7 au 9 juillet autour du thème : « Santé, sécurité et environnement : libérer le plein potentiel minier », sous le patronage du président de l''Assemblée législative du peuple.', 'news/nqMGQxXF6WivCvIrGEXI5nCQ1iMBv2DDIZky3vpH.jpg', '2026-07-16 00:00:00', '2026-09-07 13:52:26', '2026-09-08 07:55:04', 'Parmi les entreprises présentes au Forum Mines 2026 figure Riverstone Karma SA, détenue par la société Néré Mining. Elle est venue réaffirmer son engagement en matière de santé, de sécurité et d''environnement (HSE). Pour elle, cette participation constitue une occasion privilégiée de partager les expériences du secteur et de renforcer les bonnes pratiques.

Selon Esaie Sawadogo, chargé de santé et sécurité à Riverstone Karma, la présence de l''entreprise à cette édition s''inscrit dans une volonté de contribuer activement aux réflexions sur les enjeux du secteur. «La santé et la sécurité constituent un pilier essentiel au bon fonctionnement d''une industrie, particulièrement dans le secteur minier. Il était de notre devoir de prendre part à cette rencontre afin d''échanger sur les défis à relever et de contribuer au renforcement de la culture santé-sécurité », a-t-il expliqué.

Après avoir acquis la mine de Karma en 2022, Néré Mining se distingue comme la première société minière de droit burkinabé, détenue par des actionnaires majoritairement nationaux. En participant au forum, l''entreprise met également en lumière ses projets à travers un stand d''exposition ouvert aux visiteurs. Les représentants de Néré Mining ont également pris part à plusieurs panels consacrés aux questions de santé, de sécurité et d''environnement. Ces échanges ont permis de découvrir les expériences d''autres sociétés minières ainsi que les évolutions des textes réglementaires en vigueur dans le domaine du HSE.

« Nous repartons satisfaits de ces échanges. Les expériences partagées et les conseils reçus nous permettront d''améliorer davantage nos pratiques afin de garantir un environnement de travail toujours plus sûr », a confié M. Sawadogo.

À l''endroit des acteurs du secteur et des entreprises burkinabè, il a lancé un appel à faire de la santé et de la sécurité une priorité. « Le capital humain demeure la première richesse de toute entreprise. Il est indispensable de mettre en place un système HSE efficace afin d''offrir aux travailleurs des conditions de travail sûres et favorables à leur productivité », a-t-il conclu.

À travers cette participation, Néré Mining confirme sa volonté de promouvoir une culture de prévention et d''amélioration continue, en cohérence avec les objectifs du Forum Mines 2026 pour un secteur minier plus performant, plus responsable et plus sûr.', 'forum-mines-2026-nere-mining-reaffirme-son-engagement-en-faveur-des-pratiques-durables-dans-lexploitation-miniere', NULL),
(3, 'Semaine des Activités Minières de l''Afrique de l''Ouest', 'Événement', 'Retour sur la 6e édition de la SAMAO, consacrée aux stratégies de développement liées aux minéraux critiques pour les pays africains.', 'news/ClY1vOlgljZlrcugFSlfM4T6EBT019H7QBRyioKu.png', '2024-11-29 00:00:00', '2026-09-07 13:52:26', '2026-09-08 07:54:05', 'MOT DU PARRAIN

Je voudrais exprimer mes vifs remerciements à l''endroit du Gouvernement du Burkina Faso pour le choix porté sur ma modeste personne pour parrainer cette 6ème édition de la SAMAO.

Le thème de cette rencontre « Les minéraux critiques : Quelles stratégies de développement pour les pays africains ? » est d''un intérêt stratégique pour « réaliser l''Afrique que nous voulons, c''est à dire une Afrique qui compte et qui gagne».

Des premières Journées de Promotion des activités minières (PROMIN en 1995) à la SAMAO 2024, que de chemin parcouru !!!! Quel engagement soutenu et quelle belle détermination du Gouvernement, des acteurs privés, de la société civile et des Partenaires techniques et financiers, à faire du secteur minier, un puissant levier de développement économique et social de nos chers pays !!!

Notre vision, notre ambition et notre engagement dans le secteur minier est d''en faire un véritable accélérateur de l''industrialisation de notre continent et de créer des chaines de valeurs par une approche intégrée basée sur la diversification et le développement de son incommensurable potentiel géologique, la valeur de ses ressources humaines, la création de richesses et le soutien aux petites et moyennes entreprises, en vue de leur insertion dans l''économie minière.

Les thématiques abordées durant ces trois jours à l''ère de la transition énergétique constituent autant de défis qu''il nous faut relever ensemble, si nous voulons faire de l''Afrique le Continent de l''avenir. Certes, beaucoup a été fait mais beaucoup reste encore à parfaire. Et comme une termitière vivante, ajoutons toujours de la terre à la terre.

Je terminerai enfin, en souhaitant plein succès à la SAMAO 2024 et en félicitant toutes les parties prenantes dans l''Organisation de cet important évènement continental qui démontre une fois de plus le rôle prépondérant de notre cher pays dans le concert des plus grandes nations minières.

NAAABA BAOOGO DE GOURCY
PDG de NERE MINING SA', 'semaine-des-activites-minieres-de-lafrique-de-louest', NULL);

SELECT setval('news_id_seq', (SELECT MAX(id) FROM news));

-- ============================================================================
-- 6. INSERTION DES DÉPARTEMENTS KARMA (9 départements)
-- ============================================================================

INSERT INTO karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES
(1, 'Administration', 'Administration', 'Administration de la mine', 'Mine Administration', 'Planification stratégique, gestion des opérations, supervision financière et conformité réglementaire.', 'Strategic planning, operations management, financial supervision and regulatory compliance.', 1, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(2, 'Ressources humaines', 'Human Resources', 'Ressources humaines', 'Human Resources', 'Les ressources humaines gèrent le personnel et contribuent à garantir un environnement de travail productif, sûr et épanouissant.', 'Human resources manage personnel and help ensure a productive, safe and fulfilling work environment.', 2, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(3, 'Sûreté', 'Security', 'Département Sécurité', 'Security Department', 'Le dispositif comprend une CCTV de 44 caméras, une cellule drone, une brigade canine, une permanence des superviseurs 24h/24.', 'The security system includes 44 CCTV cameras, a drone unit, a canine brigade, and 24/7 supervisor presence.', 3, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(4, 'Opérations', 'Operations', 'Département Mining', 'Mining Department', 'Le processus minier regroupe la planification, les études de faisabilité, l''analyse économique et les étapes techniques.', 'The mining process includes planning, feasibility studies, economic analysis and technical steps.', 4, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(5, 'HSE', 'HSE', 'Hygiène, Santé, Sécurité et Environnement', 'Health, Safety, Security and Environment', 'Le département HSE vise zéro incident grâce à la formation continue, aux inspections régulières, au suivi environnemental.', 'The HSE department aims for zero incidents through continuous training, regular inspections, and environmental monitoring.', 5, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(6, 'Traitement', 'Processing', 'Département Processing', 'Processing Department', 'Le Processing est organisé en quatre sections : opérations, maintenance des équipements fixes, métallurgie et infrastructures.', 'Processing is organized into four sections: operations, fixed equipment maintenance, metallurgy and infrastructure.', 6, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(7, 'Approvisionnement', 'Supply Chain', 'Chaîne d''approvisionnement (SCM)', 'Supply Chain Management (SCM)', 'Le SCM comprend les Achats, la Logistique, les Contrats et le Magasin. Il est dirigé par une équipe entièrement locale.', 'SCM includes Purchasing, Logistics, Contracts and Warehouse. It is managed by an entirely local team.', 7, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(8, 'Technologies', 'IT', 'Département IT', 'IT Department', 'Le département IT accompagne les équipes et les opérations de Karma grâce aux outils et services numériques.', 'The IT department supports Karma''s teams and operations through digital tools and services.', 8, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25'),
(9, 'Dialogue local', 'Community Relations', 'Relations communautaires', 'Community Relations', 'Le département gère les impacts sociaux, entretient le dialogue avec les communautés et soutient les autorités locales.', 'The department manages social impacts, maintains dialogue with communities and supports local authorities.', 9, true, '2026-09-07 13:52:25', '2026-09-07 13:52:25');

SELECT setval('karma_departments_id_seq', (SELECT MAX(id) FROM karma_departments));

-- ============================================================================
-- 7. INSERTION DES PARAMÈTRES DU SITE (12 settings)
-- ============================================================================

INSERT INTO site_settings (id, "key", value, type, description, created_at, updated_at) VALUES
(1, 'carousel_autoplay', 'true', 'boolean', 'Activer le défilement automatique du carousel', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(2, 'carousel_interval', '5000', 'number', 'Intervalle de défilement automatique (ms)', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(3, 'carousel_transition_speed', '800', 'number', 'Vitesse de transition entre slides (ms)', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(4, 'carousel_pause_on_hover', 'true', 'boolean', 'Mettre en pause au survol', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(5, 'carousel_show_indicators', 'true', 'boolean', 'Afficher les indicateurs de position', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(6, 'carousel_show_arrows', 'true', 'boolean', 'Afficher les flèches de navigation', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(7, 'site_name', 'Néré Mining', 'string', 'Nom du site', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(8, 'contact_email', 'contact@nere-mining.bf', 'string', 'Email de contact principal', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(9, 'contact_phone', '+226 XX XX XX XX', 'string', 'Téléphone de contact', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(10, 'maintenance_mode', 'false', 'boolean', 'Activer le mode maintenance', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(11, 'analytics_enabled', 'true', 'boolean', 'Activer le tracking analytics', '2026-09-07 13:52:26', '2026-09-07 13:52:26'),
(12, 'newsletter_enabled', 'true', 'boolean', 'Activer l''inscription newsletter', '2026-09-07 13:52:26', '2026-09-07 13:52:26');

SELECT setval('site_settings_id_seq', (SELECT MAX(id) FROM site_settings));

-- ============================================================================
-- RÉACTIVATION DES CONTRAINTES
-- ============================================================================

SET session_replication_role = DEFAULT;

-- ============================================================================
-- VERIFICATION FINALE
-- ============================================================================

SELECT 'hero_slides' as table_name, COUNT(*) as count FROM hero_slides
UNION ALL
SELECT 'leadership_members', COUNT(*) FROM leadership_members
UNION ALL
SELECT 'partners', COUNT(*) FROM partners
UNION ALL
SELECT 'news', COUNT(*) FROM news
UNION ALL
SELECT 'karma_departments', COUNT(*) FROM karma_departments
UNION ALL
SELECT 'site_settings', COUNT(*) FROM site_settings;

-- ============================================================================
-- FIN DU SCRIPT
-- ============================================================================
