<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ProductionDataSeeder extends Seeder
{
    /**
     * Seed the application's database with production data.
     */
    public function run(): void
    {
        $this->command->info('🔄 Starting production database seeding...');

        $sqlFile = database_path('seeders/production_data.sql');
        
        if (!File::exists($sqlFile)) {
            $this->command->error('❌ Production data SQL file not found: ' . $sqlFile);
            return;
        }

        try {
            $sql = File::get($sqlFile);
            
            // Split SQL into individual statements
            $statements = $this->parseSQL($sql);
            
            $this->command->info('📥 Found ' . count($statements) . ' SQL statements to execute');
            
            // Disable foreign key checks temporarily
            DB::statement('SET FOREIGN_KEY_CHECKS = 0');
            
            $executed = 0;
            $skipped = 0;
            
            foreach ($statements as $statement) {
                $trimmed = trim($statement);
                if (empty($trimmed) || str_starts_with($trimmed, '--')) {
                    continue;
                }
                
                try {
                    // Skip DROP and CREATE statements if using existing schema
                    if (str_starts_with($trimmed, 'DROP ') || str_starts_with($trimmed, 'CREATE ')) {
                        $skipped++;
                        continue;
                    }
                    
                    // Execute INSERT statements
                    if (str_starts_with($trimmed, 'INSERT ')) {
                        DB::unprepared($trimmed);
                        $executed++;
                    }
                    
                } catch (\Exception $e) {
                    // Handle duplicate entries gracefully
                    if (str_contains($e->getMessage(), 'duplicate key') || 
                        str_contains($e->getMessage(), 'Duplicate entry')) {
                        $this->command->warn('⚠️  Skipped duplicate: ' . substr($trimmed, 0, 100) . '...');
                        $skipped++;
                    } else {
                        $this->command->error('❌ Failed to execute: ' . $e->getMessage());
                        $this->command->error('Statement: ' . substr($trimmed, 0, 200) . '...');
                    }
                }
            }
            
            // Re-enable foreign key checks
            DB::statement('SET FOREIGN_KEY_CHECKS = 1');
            
            $this->command->info("✅ Production seeding completed:");
            $this->command->info("   - Executed: {$executed} statements");
            $this->command->info("   - Skipped: {$skipped} statements");
            
        } catch (\Exception $e) {
            $this->command->error('❌ Seeding failed: ' . $e->getMessage());
            throw $e;
        }
    }
    
    /**
     * Parse SQL file into individual statements
     */
    private function parseSQL(string $sql): array
    {
        // Remove comments and empty lines
        $lines = explode("\n", $sql);
        $cleanLines = [];
        
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line) && !str_starts_with($line, '--')) {
                $cleanLines[] = $line;
            }
        }
        
        $cleanSQL = implode("\n", $cleanLines);
        
        // Split on semicolons, but be careful with quoted strings
        $statements = [];
        $current = '';
        $inQuotes = false;
        $quoteChar = null;
        
        for ($i = 0; $i < strlen($cleanSQL); $i++) {
            $char = $cleanSQL[$i];
            
            if (!$inQuotes && ($char === '"' || $char === "'")) {
                $inQuotes = true;
                $quoteChar = $char;
            } elseif ($inQuotes && $char === $quoteChar) {
                // Check for escaped quote
                if ($i + 1 < strlen($cleanSQL) && $cleanSQL[$i + 1] === $quoteChar) {
                    $current .= $char . $char;
                    $i++; // Skip next quote
                    continue;
                }
                $inQuotes = false;
                $quoteChar = null;
            } elseif (!$inQuotes && $char === ';') {
                $statements[] = trim($current);
                $current = '';
                continue;
            }
            
            $current .= $char;
        }
        
        // Add last statement if not empty
        if (!empty(trim($current))) {
            $statements[] = trim($current);
        }
        
        return array_filter($statements, fn($stmt) => !empty(trim($stmt)));
    }
}