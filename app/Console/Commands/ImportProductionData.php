<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class ImportProductionData extends Command
{
    protected $signature = 'data:import-production';
    protected $description = 'Import production data from SQL file';

    public function handle()
    {
        $sqlFile = base_path('supabase_import_with_schema.sql');
        
        if (!File::exists($sqlFile)) {
            $this->error('Fichier SQL non trouvé: ' . $sqlFile);
            return 1;
        }

        try {
            $this->info('Import des données de production...');
            
            $sql = File::get($sqlFile);
            
            // Extract only INSERT statements, skip CREATE TABLE and DROP statements
            $dataOnly = $this->extractInsertStatements($sql);
            
            if (empty($dataOnly)) {
                $this->error('Aucune instruction INSERT trouvée dans le fichier SQL');
                return 1;
            }

            // Execute each INSERT statement separately
            foreach ($dataOnly as $statement) {
                if (!empty(trim($statement))) {
                    try {
                        DB::unprepared($statement);
                    } catch (\Exception $e) {
                        $this->warn('Avertissement lors de l\'import: ' . $e->getMessage());
                        // Continue with other statements
                    }
                }
            }
            
            $this->info('✅ Import des données terminé avec succès !');
            return 0;
        } catch (\Exception $e) {
            $this->error('Erreur lors de l\'import: ' . $e->getMessage());
            return 1;
        }
    }

    private function extractInsertStatements($sql)
    {
        $lines = explode("\n", $sql);
        $insertStatements = [];
        $currentStatement = '';
        $inInsert = false;
        
        foreach ($lines as $line) {
            $line = trim($line);
            
            // Skip comments and empty lines
            if (empty($line) || str_starts_with($line, '--') || str_starts_with($line, 'DROP') || str_starts_with($line, 'CREATE')) {
                continue;
            }
            
            // Start of INSERT statement
            if (str_starts_with($line, 'INSERT INTO')) {
                if (!empty($currentStatement)) {
                    $insertStatements[] = $currentStatement;
                }
                $currentStatement = $line;
                $inInsert = true;
                continue;
            }
            
            // Continue building current statement
            if ($inInsert) {
                $currentStatement .= ' ' . $line;
                
                // End of statement (semicolon)
                if (str_ends_with($line, ';')) {
                    $insertStatements[] = $currentStatement;
                    $currentStatement = '';
                    $inInsert = false;
                }
            }
        }
        
        // Add last statement if not empty
        if (!empty($currentStatement)) {
            $insertStatements[] = $currentStatement;
        }
        
        return $insertStatements;
    }
}