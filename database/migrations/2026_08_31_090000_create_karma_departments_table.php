<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('karma_departments', function (Blueprint $table) {
            $table->id();
            $table->string('tag_fr', 80);
            $table->string('tag_en', 80);
            $table->string('title_fr');
            $table->string('title_en');
            $table->text('body_fr');
            $table->text('body_en');
            $table->unsignedInteger('sort_order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
        });

        $now = now();
        DB::table('karma_departments')->insert([
            [
                'tag_fr' => 'Administration',
                'tag_en' => 'Administration',
                'title_fr' => 'Administration de la mine',
                'title_en' => 'Mine Administration',
                'body_fr' => "Planification stratégique, gestion des opérations, supervision financière et conformité réglementaire. L'administration coordonne les départements et les services techniques, HSE et ressources humaines.",
                'body_en' => 'Strategic planning, operations management, financial oversight and regulatory compliance. Administration coordinates the technical, HSE and human resources departments.',
                'sort_order' => 1,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Ressources humaines',
                'tag_en' => 'Human resources',
                'title_fr' => 'Ressources humaines',
                'title_en' => 'Human Resources',
                'body_fr' => 'Les ressources humaines gèrent le personnel et contribuent à garantir un environnement de travail productif, sûr et épanouissant.',
                'body_en' => 'Human resources manages personnel and helps ensure a productive, safe and fulfilling working environment.',
                'sort_order' => 2,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Sûreté',
                'tag_en' => 'Security',
                'title_fr' => 'Département Sécurité',
                'title_en' => 'Security Department',
                'body_fr' => 'Le dispositif comprend une CCTV de 44 caméras, une cellule drone, une brigade canine, une permanence des superviseurs 24h/24 et un service de transport entre Ouahigouya, Karma et Ouagadougou.',
                'body_en' => 'The system includes CCTV with 44 cameras, a drone unit, a canine brigade, supervisors on duty 24/7 and transport between Ouahigouya, Karma and Ouagadougou.',
                'sort_order' => 3,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Opérations',
                'tag_en' => 'Operations',
                'title_fr' => 'Département Mining',
                'title_en' => 'Mining Department',
                'body_fr' => "Le processus minier regroupe la planification, les études de faisabilité, l'analyse économique et les étapes techniques nécessaires à une extraction efficiente et sécurisée.",
                'body_en' => 'The mining process includes planning, feasibility studies, economic analysis and the technical steps required for efficient and safe extraction.',
                'sort_order' => 4,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'HSE',
                'tag_en' => 'HSE',
                'title_fr' => 'Hygiène, Santé, Sécurité et Environnement',
                'title_en' => 'Health, Safety and Environment',
                'body_fr' => 'Le département HSE vise zéro incident grâce à la formation continue, aux inspections régulières, au suivi environnemental, à la gestion de la santé et au système de management HSE.',
                'body_en' => 'The HSE department targets zero incidents through continuous training, regular inspections, environmental monitoring, health management and an HSE management system.',
                'sort_order' => 5,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Traitement',
                'tag_en' => 'Processing',
                'title_fr' => 'Département Processing',
                'title_en' => 'Processing Department',
                'body_fr' => "Le Processing est organisé en quatre sections : opérations, maintenance des équipements fixes, métallurgie et infrastructures. Il veille au traitement du minerai et à l'optimisation de la production d'or.",
                'body_en' => 'Processing is organised into four sections: operations, fixed equipment maintenance, metallurgy and infrastructure. It manages ore treatment and gold production optimisation.',
                'sort_order' => 6,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Approvisionnement',
                'tag_en' => 'Supply',
                'title_fr' => 'Chaîne d’approvisionnement (SCM)',
                'title_en' => 'Supply Chain Department',
                'body_fr' => 'Le SCM comprend les Achats, la Logistique, les Contrats et le Magasin. Il est dirigé par une équipe entièrement locale et garantit les biens, services et stocks nécessaires à la production.',
                'body_en' => 'Supply Chain comprises Procurement, Logistics, Contracts and Stores. It is led by an entirely local team and provides the goods, services and stocks required for production.',
                'sort_order' => 7,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Technologies',
                'tag_en' => 'Technology',
                'title_fr' => 'Département IT',
                'title_en' => 'IT Department',
                'body_fr' => 'Le département IT accompagne les équipes et les opérations de Karma grâce aux outils et services numériques nécessaires au fonctionnement du site.',
                'body_en' => 'The IT department supports Karma teams and operations through the digital tools and services required to run the site.',
                'sort_order' => 8,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'tag_fr' => 'Dialogue local',
                'tag_en' => 'Local dialogue',
                'title_fr' => 'Relations communautaires',
                'title_en' => 'Community Relations',
                'body_fr' => 'Le département gère les impacts sociaux, entretient le dialogue avec les communautés et soutient les autorités locales, coutumières et religieuses dans une approche pragmatique.',
                'body_en' => 'The department manages social impacts, maintains dialogue with communities and supports local, traditional and religious authorities through a pragmatic approach.',
                'sort_order' => 9,
                'is_published' => true,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('karma_departments');
    }
};
