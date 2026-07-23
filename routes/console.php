<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Schedule::command('temp-images:prune')->hourly();

// Google Reviews are now served entirely via the Elfsight widget (see
// GoogleReviewSyncService), so this sync always skips itself — not worth
// scheduling. Re-add `Schedule::command('reviews:sync-google')->hourly();`
// if Places API billing is ever enabled and DB-backed reviews come back.
