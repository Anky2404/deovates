<?php

namespace App\Console\Commands;

use App\Services\GoogleReviewSyncService;
use Illuminate\Console\Command;

class SyncGoogleReviews extends Command
{
    protected $signature = 'reviews:sync-google';

    protected $description = 'Fetch the latest Google reviews for the configured Place ID and store them locally';

    public function handle(GoogleReviewSyncService $service): int
    {
        $result = $service->sync();

        if ($result['success']) {
            $this->info($result['message']);

            return self::SUCCESS;
        }

        $this->error($result['message']);

        return self::FAILURE;
    }
}
