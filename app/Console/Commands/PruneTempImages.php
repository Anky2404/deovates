<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Deletes files under the "temp/" upload location (see MediaUploader::storeTemp)
 * that were never promoted to permanent storage — e.g. a crop was uploaded but
 * the admin navigated away without saving the form.
 */
class PruneTempImages extends Command
{
    protected $signature = 'temp-images:prune {--hours=6 : Delete temp files older than this many hours}';

    protected $description = 'Delete abandoned temp image uploads older than the given age';

    public function handle(): int
    {
        $hours = (int) $this->option('hours');
        $cutoff = now()->subHours($hours)->getTimestamp();
        $disk = Storage::disk('public');

        $deleted = 0;

        foreach ($disk->files('temp') as $file) {
            if ($disk->lastModified($file) < $cutoff) {
                $disk->delete($file);
                $deleted++;
            }
        }

        $this->info("Pruned {$deleted} abandoned temp image(s) older than {$hours}h.");

        return self::SUCCESS;
    }
}
