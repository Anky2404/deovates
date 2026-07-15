<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table => column to add the JSON gallery after, matching the
     * "gallery" column already present on case_studies/portfolios.
     */
    private array $tables = [
        'services' => 'banner_image_alt',
        'blogs' => 'og_image_alt',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table => $after) {
            if (! Schema::hasTable($table) || Schema::hasColumn($table, 'gallery')) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($after) {
                $blueprint->longText('gallery')->nullable()->after($after);
            });
        }
    }

    public function down(): void
    {
        foreach (array_keys($this->tables) as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'gallery')) {
                Schema::table($table, fn (Blueprint $blueprint) => $blueprint->dropColumn('gallery'));
            }
        }
    }
};
