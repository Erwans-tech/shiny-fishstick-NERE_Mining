<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $this->repairTable('news', ['title', 'category', 'excerpt', 'content']);
        $this->repairTable('hero_slides', ['title', 'caption']);
        $this->repairTable('media_assets', ['title', 'caption']);
    }

    public function down(): void
    {
        // Mojibake repair is intentionally irreversible.
    }

    private function repairTable(string $table, array $columns): void
    {
        DB::table($table)
            ->where(function ($query) use ($columns): void {
                foreach ($columns as $column) {
                    $query->orWhere($column, 'like', '%Ã%')
                        ->orWhere($column, 'like', '%â%');
                }
            })
            ->orderBy('id')
            ->chunkById(100, function ($rows) use ($table, $columns): void {
                foreach ($rows as $row) {
                    $updates = [];

                    foreach ($columns as $column) {
                        $value = $row->{$column};

                        if (! is_string($value) || ! preg_match('/Ã|â/', $value)) {
                            continue;
                        }

                        $repaired = $value;

                        for ($attempt = 0; $attempt < 3 && preg_match('/Ã|â/', $repaired); $attempt++) {
                            $next = iconv('UTF-8', 'Windows-1252//IGNORE', $repaired);

                            if ($next === false || $next === $repaired) {
                                break;
                            }

                            $repaired = $next;
                        }

                        if ($repaired !== $value) {
                            $updates[$column] = $repaired;
                        }
                    }

                    if ($updates !== []) {
                        DB::table($table)->where('id', $row->id)->update($updates);
                    }
                }
            });
    }
};
