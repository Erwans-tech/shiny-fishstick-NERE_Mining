<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class SyncUploadedMedia extends Command
{
    protected $signature = 'media:sync {--dry-run : Liste les fichiers sans les transférer}';

    protected $description = 'Synchronise les médias uploadés vers le disque configuré';

    public function handle(): int
    {
        $source = Storage::disk('public');
        $targetDisk = config('filesystems.default');
        $target = Storage::disk($targetDisk);
        $files = $source->allFiles();

        if ($targetDisk === 'public') {
            $this->info('Le disque configuré est déjà le disque local public.');
            return self::SUCCESS;
        }

        foreach ($files as $path) {
            $this->line(($this->option('dry-run') ? '[dry-run] ' : '') . $path);

            if ($this->option('dry-run')) {
                continue;
            }

            $stream = $source->readStream($path);
            if ($stream === false || !$target->writeStream($path, $stream)) {
                if (is_resource($stream)) {
                    fclose($stream);
                }

                $this->error("Échec du transfert : {$path}");
                return self::FAILURE;
            }

            if (is_resource($stream)) {
                fclose($stream);
            }
        }

        $this->info(count($files) . " fichier(s) synchronisé(s) vers {$targetDisk}.");
        return self::SUCCESS;
    }
}
