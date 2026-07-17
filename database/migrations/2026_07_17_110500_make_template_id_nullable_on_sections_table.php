<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            if (Schema::hasColumn('sections', 'template_id')) {
                $table->unsignedBigInteger('template_id')->nullable()->default(null)->change();
            }
        });
    }

    public function down(): void
    {
        // Intentionally not reverted: the NOT NULL constraint had no default
        // and blocked every Section insert since the model never sets this
        // legacy column — reversing would restore that broken state.
    }
};
