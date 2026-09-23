<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class UpdateCeoMessageSeeder extends Seeder
{
    /**
     * Met à jour le message du PDG avec le nouveau contenu
     */
    public function run(): void
    {
        $newMessageFr = "Chers partenaires et visiteurs,

Bienvenus sur le site web de NERE MINING. Ce site a été conçu pour être une plateforme numérique de communication interactive, permettant de découvrir nos activités, nos missions et nos projets que nous réalisons dans la région du Nord en particulier et sur le territoire Burkinabè en général.

NERE MINING a pour vocation l'extraction, la production et la commercialisation des ressources minérales. Nous stimulons le développement durable et participons également à la croissance socio-économique du Burkina Faso.

Ce site web se veut être un cadre d'information fécond avec nos partenaires et l'ensemble de nos visiteurs. Nous tenons à vous informer sur nos principales activités et métiers. Vous y trouverez également des informations sur nos projets et programmes visant à renforcer l'impact environnemental et les relations communautaires de nos zones d'exploitations.

Nous vous invitons à visiter régulièrement notre site web et à nous faire un retour sur vos critiques, suggestions et idées d'amélioration.

Au nom de toute l'équipe de NERE MINING, je vous souhaite une excellente visite. Nous sommes à votre écoute et mettrons tout en œuvre pour répondre à vos attentes.

NERE MINING: Intégrité, Professionnalisme, Respect, Esprit d'équipe!";

        $newMessageEn = "Dear partners and visitors,

Welcome to the NERE MINING website. This site has been designed to be an interactive digital communication platform, allowing you to discover our activities, missions and projects that we carry out in the Northern region in particular and on Burkinabè territory in general.

NERE MINING's vocation is the extraction, production and marketing of mineral resources. We stimulate sustainable development and also participate in the socio-economic growth of Burkina Faso.

This website is intended to be a fertile information framework with our partners and all our visitors. We want to inform you about our main activities and trades. You will also find information on our projects and programs aimed at strengthening the environmental impact and community relations of our operating areas.

We invite you to regularly visit our website and give us feedback on your criticisms, suggestions and ideas for improvement.

On behalf of the entire NERE MINING team, I wish you an excellent visit. We are listening and will do everything we can to meet your expectations.

NERE MINING: Integrity, Professionalism, Respect, Team spirit!";

        // Mettre à jour le message français
        $settingFr = SiteSetting::where('key', 'ceo_message_fr')->first();
        if ($settingFr) {
            $settingFr->update(['value' => $newMessageFr]);
            $this->command->info('✓ Message du PDG français mis à jour');
        } else {
            SiteSetting::create([
                'key' => 'ceo_message_fr',
                'value' => $newMessageFr,
                'type' => 'textarea'
            ]);
            $this->command->info('✓ Message du PDG français créé');
        }

        // Mettre à jour le message anglais
        $settingEn = SiteSetting::where('key', 'ceo_message_en')->first();
        if ($settingEn) {
            $settingEn->update(['value' => $newMessageEn]);
            $this->command->info('✓ Message du PDG anglais mis à jour');
        } else {
            SiteSetting::create([
                'key' => 'ceo_message_en',
                'value' => $newMessageEn,
                'type' => 'textarea'
            ]);
            $this->command->info('✓ Message du PDG anglais créé');
        }
    }
}