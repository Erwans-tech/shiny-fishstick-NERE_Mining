<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Database\Seeders\ProductionDataSeeder;

class ImportProductionData extends Command
{
    protected $signature = 'data:import-production';
    protected $description = 'Import production data from SQL seeder';

    public function handle()
    {
        try {
            $this->info('📥 Starting production data import...');
            
            $seeder = new ProductionDataSeeder();
            $seeder->setCommand($this);
            $seeder->run();
            
            $this->info('✅ Production data import completed successfully!');
            return 0;
            
        } catch (\Exception $e) {
            $this->error('❌ Import failed: ' . $e->getMessage());
            return 1;
        }
    }
}