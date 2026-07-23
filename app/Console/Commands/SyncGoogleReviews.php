<?php

namespace App\Console\Commands;

use App\Services\GoogleReviewSyncService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Throwable;

class SyncGoogleReviews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reviews:sync-google';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch Google reviews and synchronize them with the local database.';

    /**
     * Execute the console command.
     */
    public function handle(GoogleReviewSyncService $service): int
    {
        try {

            $result = $service->sync();

            if (!is_array($result)) {
                $this->error('Google review sync failed. Invalid response returned.');

                return self::FAILURE;
            }

            if (($result['success'] ?? false) === true) {
                $this->info($result['message'] ?? 'Google reviews synchronized successfully.');

                return self::SUCCESS;
            }

            $this->error($result['message'] ?? 'Google review synchronization failed.');

            return self::FAILURE;

        } catch (Throwable $e) {

            Log::error('Google Review Sync Failed', [
                'message' => $e->getMessage(),
                'file'    => $e->getFile(),
                'line'    => $e->getLine(),
                'trace'   => $e->getTraceAsString(),
            ]);

            $this->error($e->getMessage());

            return self::FAILURE;
        }
    }
}