<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class HomeFeaturedAlbumSettingSeeder extends Seeder
{
    /**
     * Ajoute le paramètre pour sélectionner l'album mis en avant sur la page d'accueil
     */
    public function run(): void
    {
        // Vérifier si le setting existe déjà
        $exists = SiteSetting::where('key', 'home_featured_album_id')->exists();
        
        if (!$exists) {
            SiteSetting::create([
                'key' => 'home_featured_album_id',
                'value' => '', // Aucun album par défaut
                'type' => 'album_select',
            ]);
            
            $this->command->info('✓ Setting home_featured_album_id créé avec succès');
        } else {
            $this->command->info('⚠ Setting home_featured_album_id existe déjà');
        }
    }
}
