<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_visits', function (Blueprint $table) {
            $table->string('browser', 50)->nullable()->after('user_agent');
            $table->string('platform', 50)->nullable()->after('browser');
            $table->string('device_type', 20)->nullable()->after('platform');
        });
    }

    public function down(): void
    {
        Schema::table('site_visits', function (Blueprint $table) {
            $table->dropColumn(['browser', 'platform', 'device_type']);
        });
    }
};
