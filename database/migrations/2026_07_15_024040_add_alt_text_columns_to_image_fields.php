<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Table => [column => after-column] for every single-image field that
     * needs an accompanying alt-text column.
     */
    private array $columns = [
        'users' => ['avatar_alt' => 'avatar'],
        'authors' => ['profile_image_alt' => 'profile_image', 'cover_image_alt' => 'cover_image'],
        'blogs' => ['featured_image_alt' => 'featured_image', 'og_image_alt' => 'og_image'],
        'blog_categories' => ['image_alt' => 'image'],
        'case_studies' => ['featured_image_alt' => 'featured_image', 'banner_image_alt' => 'banner_image'],
        'case_study_categories' => ['image_alt' => 'image'],
        'portfolios' => ['featured_image_alt' => 'featured_image', 'banner_image_alt' => 'banner_image'],
        'portfolio_categories' => ['image_alt' => 'image'],
        'technologies' => ['image_alt' => 'image'],
        'technology_categories' => ['image_alt' => 'image'],
        'testimonials' => ['photo_alt' => 'photo'],
        'industries' => ['image_alt' => 'image'],
        'partners' => ['logo_alt' => 'logo'],
        'services' => ['featured_image_alt' => 'featured_image', 'banner_image_alt' => 'banner_image'],
        'service_features' => ['image_alt' => 'image'],
        'service_challenges' => ['image_alt' => 'image'],
    ];

    public function up(): void
    {
        foreach ($this->columns as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table, $columns) {
                foreach ($columns as $column => $after) {
                    if (Schema::hasColumn($table, $column)) {
                        continue;
                    }

                    $blueprint->string($column, 255)->nullable()->after($after);
                }
            });
        }
    }

    public function down(): void
    {
        foreach ($this->columns as $table => $columns) {
            if (! Schema::hasTable($table)) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) use ($table, $columns) {
                foreach (array_keys($columns) as $column) {
                    if (Schema::hasColumn($table, $column)) {
                        $blueprint->dropColumn($column);
                    }
                }
            });
        }
    }
};
