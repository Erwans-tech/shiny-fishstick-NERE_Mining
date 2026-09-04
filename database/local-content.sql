--
-- PostgreSQL database dump
--

\restrict ZiaEOl0oa7x41iee0tZu7prNydrLakTLEcJsP6JdqFkjdsclCV3FeKhr2ymvyhj

-- Dumped from database version 18.4
-- Dumped by pg_dump version 18.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Data for Name: certifications; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: hero_slides; Type: TABLE DATA; Schema: public; Owner: -
--



--
-- Data for Name: karma_departments; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (1, 'Administration', 'Administration', 'Administration de la mine', 'Mine Administration', 'Planification stratégique, gestion des opérations, supervision financière et conformité réglementaire. L''administration coordonne les départements et les services techniques, HSE et ressources humaines.', 'Strategic planning, operations management, financial oversight and regulatory compliance. Administration coordinates the technical, HSE and human resources departments.', 1, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (2, 'Ressources humaines', 'Human resources', 'Ressources humaines', 'Human Resources', 'Les ressources humaines gèrent le personnel et contribuent à garantir un environnement de travail productif, sûr et épanouissant.', 'Human resources manages personnel and helps ensure a productive, safe and fulfilling working environment.', 2, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (3, 'Sûreté', 'Security', 'Département Sécurité', 'Security Department', 'Le dispositif comprend une CCTV de 44 caméras, une cellule drone, une brigade canine, une permanence des superviseurs 24h/24 et un service de transport entre Ouahigouya, Karma et Ouagadougou.', 'The system includes CCTV with 44 cameras, a drone unit, a canine brigade, supervisors on duty 24/7 and transport between Ouahigouya, Karma and Ouagadougou.', 3, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (4, 'Opérations', 'Operations', 'Département Mining', 'Mining Department', 'Le processus minier regroupe la planification, les études de faisabilité, l''analyse économique et les étapes techniques nécessaires à une extraction efficiente et sécurisée.', 'The mining process includes planning, feasibility studies, economic analysis and the technical steps required for efficient and safe extraction.', 4, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (5, 'HSE', 'HSE', 'Hygiène, Santé, Sécurité et Environnement', 'Health, Safety and Environment', 'Le département HSE vise zéro incident grâce à la formation continue, aux inspections régulières, au suivi environnemental, à la gestion de la santé et au système de management HSE.', 'The HSE department targets zero incidents through continuous training, regular inspections, environmental monitoring, health management and an HSE management system.', 5, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (6, 'Traitement', 'Processing', 'Département Processing', 'Processing Department', 'Le Processing est organisé en quatre sections : opérations, maintenance des équipements fixes, métallurgie et infrastructures. Il veille au traitement du minerai et à l''optimisation de la production d''or.', 'Processing is organised into four sections: operations, fixed equipment maintenance, metallurgy and infrastructure. It manages ore treatment and gold production optimisation.', 6, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (7, 'Approvisionnement', 'Supply', 'Chaîne d’approvisionnement (SCM)', 'Supply Chain Department', 'Le SCM comprend les Achats, la Logistique, les Contrats et le Magasin. Il est dirigé par une équipe entièrement locale et garantit les biens, services et stocks nécessaires à la production.', 'Supply Chain comprises Procurement, Logistics, Contracts and Stores. It is led by an entirely local team and provides the goods, services and stocks required for production.', 7, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (8, 'Technologies', 'Technology', 'Département IT', 'IT Department', 'Le département IT accompagne les équipes et les opérations de Karma grâce aux outils et services numériques nécessaires au fonctionnement du site.', 'The IT department supports Karma teams and operations through the digital tools and services required to run the site.', 8, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');
INSERT INTO public.karma_departments (id, tag_fr, tag_en, title_fr, title_en, body_fr, body_en, sort_order, is_published, created_at, updated_at) VALUES (9, 'Dialogue local', 'Local dialogue', 'Relations communautaires', 'Community Relations', 'Le département gère les impacts sociaux, entretient le dialogue avec les communautés et soutient les autorités locales, coutumières et religieuses dans une approche pragmatique.', 'The department manages social impacts, maintains dialogue with communities and supports local, traditional and religious authorities through a pragmatic approach.', 9, true, '2026-09-02 14:02:39', '2026-09-02 14:02:39');


--
-- Data for Name: leadership_members; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.leadership_members (id, name, title, department, photo_path, is_published, sort_order, created_at, updated_at, hierarchy_level) VALUES (2, 'Justin SAVADOGO', 'Directeur Général Adjoint', 'Administration & Finance', 'images/mining/gold-processing-01.jpg', true, 1, '2026-09-03 10:48:32', '2026-09-03 10:48:32', 2);
INSERT INTO public.leadership_members (id, name, title, department, photo_path, is_published, sort_order, created_at, updated_at, hierarchy_level) VALUES (3, 'Pascal Y. OUEDRAOGO', 'Directeur Général Adjoint', 'Approvisionnements', 'images/mining/mining-equipment-01.jpg', true, 2, '2026-09-03 10:48:32', '2026-09-03 10:48:32', 2);
INSERT INTO public.leadership_members (id, name, title, department, photo_path, is_published, sort_order, created_at, updated_at, hierarchy_level) VALUES (4, 'Laurent Michel DABIRE', 'Directeur Général Adjoint', 'Affaires Corporatives & Juridiques', 'images/mining/mining-site-aerial-01.jpg', true, 3, '2026-09-03 10:48:32', '2026-09-03 10:48:32', 2);
INSERT INTO public.leadership_members (id, name, title, department, photo_path, is_published, sort_order, created_at, updated_at, hierarchy_level) VALUES (5, 'Augustine OBENG-FORI', 'DGA par intérim', 'Opérations', 'images/mining/mining-environment-01.jpg', true, 4, '2026-09-03 10:48:32', '2026-09-03 10:48:32', 2);
INSERT INTO public.leadership_members (id, name, title, department, photo_path, is_published, sort_order, created_at, updated_at, hierarchy_level) VALUES (1, 'Dr. Justin Elie OUEDRAOGO', 'Président Directeur Général', NULL, 'leadership/hZ18GCzrDBmq69woKLtWzSOFFGKEflEuLGKcJhby.jpg', true, 1, '2026-09-03 10:48:32', '2026-09-03 10:53:27', 1);


--
-- Data for Name: media_assets; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (1, 'Vue générale des activités minières', 'image', 'images/gallery/site-activite-2024.jpg', 'Vue d’ensemble des installations et des activités de Néré Mining au Burkina Faso.', true, 1, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (2, 'Équipe de terrain', 'image', 'images/gallery/equipe-terrain-01.jpeg', 'Les équipes techniques organisent les opérations et le suivi des travaux sur le terrain.', true, 2, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (3, 'Travaux d’exploration', 'image', 'images/gallery/equipe-terrain-02.jpeg', 'Une équipe prépare les relevés et les observations nécessaires à l’évaluation des cibles.', true, 3, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (4, 'Suivi technique', 'image', 'images/gallery/equipe-terrain-03.jpeg', 'Le travail de terrain contribue à documenter les conditions géologiques et opérationnelles.', true, 4, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (5, 'Site minier de Karma', 'image', 'images/gallery/karma-site-01.jpg', 'Vue du site de Karma, cœur des opérations aurifères de Néré Mining.', true, 5, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (6, 'Opérations à Karma', 'image', 'images/gallery/karma-site-02.jpg', 'Les installations et les équipes mobilisées pour une exploitation structurée et responsable.', true, 6, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (7, 'Infrastructures minières', 'image', 'images/gallery/karma-site-03.jpg', 'Équipements et infrastructures participant à la continuité des opérations minières.', true, 7, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (8, 'Réhabilitation environnementale', 'image', 'images/gallery/rehabilitation-karma.jpg', 'Action de réhabilitation et de restauration des espaces dans la zone d’intervention de Karma.', true, 8, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (9, 'Activités sur le terrain', 'image', 'images/gallery/terrain-activite-01.jpeg', 'Travaux de terrain menés dans le cadre du développement des activités minières.', true, 9, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (10, 'Présence opérationnelle', 'image', 'images/gallery/terrain-activite-02.jpeg', 'La présence des équipes sur le terrain soutient la coordination et le suivi des opérations.', true, 10, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (11, 'Vie du site', 'image', 'images/gallery/terrain-activite-03.jpeg', 'Une scène de vie du site illustrant l’organisation quotidienne des activités.', true, 11, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (12, 'Installations de production', 'image', 'images/gallery/site-operations-01.jpg', 'Vue d’une zone opérationnelle du site minier de Karma.', true, 12, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (13, 'Équipements et production', 'image', 'images/gallery/site-operations-02.jpg', 'Les équipements de production et de maintenance au service des opérations.', true, 13, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (14, 'Travaux miniers', 'image', 'images/gallery/site-operations-03.jpg', 'Travaux et moyens techniques mobilisés sur le site de Karma.', true, 14, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');
INSERT INTO public.media_assets (id, title, type, file_path, caption, is_published, sort_order, created_at, updated_at, external_url, placement) VALUES (15, 'Impact environnemental positif', 'image', 'images/gallery/impact-environnemental.webp', 'Initiatives de restauration et de protection de l’environnement autour des activités minières.', true, 15, '2026-09-03 13:33:35', '2026-09-03 13:33:35', NULL, 'gallery');


--
-- Data for Name: news; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.news (id, title, category, excerpt, image_path, published_at, created_at, updated_at, content, slug) VALUES (1, 'Annulation du contrat d''achat d''or : Riverstone Karma SA salue une décision judiciaire historique', 'Gouvernance', 'Le Tribunal de commerce de Ouagadougou annule le Gold Purchase Agreement et ouvre une nouvelle dynamique pour Riverstone Karma SA et ses parties prenantes.', 'news/pDTlaknBtZgxngwzxdKOZUyr5LN4sPCnkX3vcaYv.jpg', '2026-07-20 00:00:00', '2026-09-02 14:02:39', '2026-09-03 08:37:01', 'Par jugement en date du 10 juin 2026, le Tribunal de commerce de Ouagadougou a statué en faveur de Riverstone Karma SA dans le différend qui l''opposait à Franco-Nevada et Sandstorm Gold Ltd (aujourd''hui IRC). La juridiction a prononcé l''annulation du Gold Purchase Agreement conclu en 2014 et accordé une réparation de 5 218 224 600 francs CFA.

Cette décision permet à Riverstone Karma SA de retrouver une plus grande autonomie dans la gestion de ses ressources, de renforcer ses investissements productifs et de maximiser les retombées économiques au bénéfice du Burkina Faso. Elle ouvre également des perspectives pour les partenaires nationaux, les communautés locales et la consolidation d''une exploitation minière durable.

Source : https://www.nere-mining.bf/2026/07/20/5677/', 'annulation-du-contrat-dachat-dor-riverstone-karma-sa-salue-une-decision-judiciaire-historique');
INSERT INTO public.news (id, title, category, excerpt, image_path, published_at, created_at, updated_at, content, slug) VALUES (3, 'Semaine des Activités Minières de l''Afrique de l''Ouest', 'Événement', 'Retour sur la 6e édition de la SAMAO, consacrée aux stratégies de développement liées aux minéraux critiques pour les pays africains.', 'news/iP2pjuq2Udoxm4l1Ykjf9GQudgvV9HF3RytKCthO.jpg', '2024-11-29 00:00:00', '2026-09-02 14:02:39', '2026-09-03 08:37:19', 'La 6e édition de la Semaine des Activités Minières de l''Afrique de l''Ouest (SAMAO) a mis en avant le thème « Les minéraux critiques : quelles stratégies de développement pour les pays africains ? ».

Cette rencontre souligne le rôle du secteur minier dans l''industrialisation du continent, la création de chaînes de valeur, le développement des ressources humaines et le soutien aux petites et moyennes entreprises. Elle rappelle également l''importance d''une approche intégrée et d''une coopération durable entre les pouvoirs publics, les acteurs privés, la société civile et les partenaires techniques et financiers.

Source : https://www.nere-mining.bf/2024/11/29/semaine-des-activites-minieres-de-lafrique-de-louest/', 'semaine-des-activites-minieres-de-lafrique-de-louest');
INSERT INTO public.news (id, title, category, excerpt, image_path, published_at, created_at, updated_at, content, slug) VALUES (2, 'Forum Mines 2026 : Néré Mining réaffirme son engagement en faveur des pratiques durables dans l''exploitation minière', 'HSE', 'Présente au Forum Mines 2026 à Ouagadougou, Néré Mining partage son engagement pour la santé, la sécurité et l’environnement dans le secteur minier.', 'news/27V1hxnByTwelX9LjOyZipRBylcrDT6lyALvKrfF.jpg', '2026-07-16 00:00:00', '2026-09-02 14:02:39', '2026-09-03 08:38:10', 'La troisième édition du Forum Mines, organisée par la Chambre des mines du Burkina du 7 au 9 juillet 2026 à Ouagadougou, a porté sur le thème « Santé, sécurité et environnement : libérer le plein potentiel minier ».

À travers la présence de Riverstone Karma SA, détenue par Néré Mining, l''entreprise a participé aux échanges, aux panels et aux présentations consacrés aux enjeux HSE. Cette participation a permis de partager les expériences du secteur, de découvrir les évolutions réglementaires et de renforcer les bonnes pratiques.

Néré Mining réaffirme ainsi sa volonté de promouvoir une culture de prévention et d''amélioration continue, en plaçant la santé et la sécurité au cœur de la performance minière.

Source : https://www.nere-mining.bf/2026/07/16/forum-mines-2026-nere-mining-reaffirme-son-engagement-en-faveur-des-pratiques-durables-dans-lexploitation-miniere/', 'forum-mines-2026-nere-mining-reaffirme-son-engagement-en-faveur-des-pratiques-durables-dans-lexploitation-miniere');


--
-- Data for Name: partners; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.partners (id, name, logo_path, website_url, category, is_published, sort_order, created_at, updated_at) VALUES (1, 'kimetsu', 'partners/oMS7NNadWGNrDmz8yu0zYK36RD2XwA6qfUyOxL4n.jpg', NULL, 'Communautes', true, 4, '2026-09-03 10:11:40', '2026-09-03 10:11:40');


--
-- Data for Name: press_documents; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.press_documents (id, title, document_type, description, file_path, published_at, created_at, updated_at) VALUES (1, 'test', 'Presse', 'test de test', 'press/5E66l8cMoQrOjMmJn2QxwfVX9uJPCByLe5LhMe8m.pdf', '2026-09-01 00:00:00', '2026-09-04 10:02:10', '2026-09-04 10:02:10');


--
-- Data for Name: reports; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.reports (id, title, category, description, file_path, cover_image, published_at, created_at, updated_at) VALUES (1, 'test', 'activite', 'test de test', 'reports/ZbuVwvah0Hh2OHuPVEvuAu2YLZT9S27dSysJqchU.pdf', 'reports/covers/owzNq5duZI6REyI2peT501kd0OJxtTZYK48gd5kw.jpg', '2026-08-13 00:00:00', '2026-09-04 10:00:58', '2026-09-04 10:00:58');


--
-- Data for Name: site_settings; Type: TABLE DATA; Schema: public; Owner: -
--

INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (7, 'press_contact_name', '[Nom du Responsable Communication]', 'text', NULL, NULL);
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (8, 'press_contact_job', 'Responsable Communication & Relations Presse — Néré Mining S.A.', 'text', NULL, NULL);
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (10, 'press_contact_phone', '+226 25 33 35 69', 'text', NULL, NULL);
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (12, 'press_contact_hours', 'Lundi – Vendredi, 8h – 17h (GMT+0)', 'text', NULL, NULL);
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (1, 'carousel_autoplay', 'true', 'text', '2026-09-02 14:02:39', '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (2, 'carousel_interval', '10000', 'text', '2026-09-02 14:02:39', '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (4, 'carousel_pause_on_hover', 'true', 'text', '2026-09-02 14:02:39', '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (6, 'carousel_show_arrows', 'true', 'text', '2026-09-02 14:02:39', '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (5, 'carousel_show_indicators', 'true', 'text', '2026-09-02 14:02:39', '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (3, 'carousel_transition_speed', '1000', 'text', '2026-09-02 14:02:39', '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (11, 'press_contact_email', 'presse@nere-mining.bf', 'text', NULL, '2026-09-03 17:59:50');
INSERT INTO public.site_settings (id, key, value, type, created_at, updated_at) VALUES (9, 'press_contact_photo', NULL, 'text', NULL, '2026-09-03 17:59:50');


--
-- Name: certifications_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.certifications_id_seq', 1, false);


--
-- Name: hero_slides_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.hero_slides_id_seq', 7, true);


--
-- Name: karma_departments_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.karma_departments_id_seq', 9, true);


--
-- Name: leadership_members_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.leadership_members_id_seq', 5, true);


--
-- Name: media_assets_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.media_assets_id_seq', 15, true);


--
-- Name: news_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.news_id_seq', 4, true);


--
-- Name: partners_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.partners_id_seq', 1, true);


--
-- Name: press_documents_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.press_documents_id_seq', 1, true);


--
-- Name: reports_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.reports_id_seq', 1, true);


--
-- Name: site_settings_id_seq; Type: SEQUENCE SET; Schema: public; Owner: -
--

SELECT pg_catalog.setval('public.site_settings_id_seq', 12, true);


--
-- PostgreSQL database dump complete
--

\unrestrict ZiaEOl0oa7x41iee0tZu7prNydrLakTLEcJsP6JdqFkjdsclCV3FeKhr2ymvyhj

