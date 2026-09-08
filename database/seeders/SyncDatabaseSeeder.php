<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SyncDatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds - imports all local data from the SQL dump
     * Run with: php artisan db:seed --class=SyncDatabaseSeeder
     */
    public function run(): void
    {
        // Read and execute the SQL dump file
        $sqlFile = database_path('dumps/nere_mining_sync_2026-09-08_08-46-29.sql');
        
        if (!file_exists($sqlFile)) {
            $this->command->error("SQL dump file not found: {$sqlFile}");
            return;
        }

        $sql = file_get_contents($sqlFile);
        
        // Split into individual statements and execute
        $statements = array_filter(
            array_map('trim', explode(';', $sql)),
            fn($stmt) => !empty($stmt)
        );

        $count = 0;
        foreach ($statements as $statement) {
            try {
                DB::statement($statement);
                $count++;
            } catch (\Exception $e) {
                $this->command->warn("Failed to execute statement: " . substr($statement, 0, 50) . "...");
                $this->command->warn("Error: " . $e->getMessage());
            }
        }

        $this->command->info("✅ Database sync completed! Executed {$count} SQL statements.");
    }
}
