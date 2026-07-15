<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Content/listing tables that are manageable from the admin panel and
     * benefit from an admin-controlled display order, matching the pattern
     * already used on services, portfolios, testimonials, etc. Session,
     * log, cache, job, token, and other system/transactional tables are
     * intentionally excluded — they're never manually reordered.
     */
    private array $tables = [
        'authors',
        'blog_categories',
        'blogs',
        'careers',
        'departments',
        'email_templates',
        'faq_categories',
        'industry_categories',
        'page_sections',
        'tags',
        'templates',
    ];

    public function up(): void
    {
        foreach ($this->tables as $table) {
            if (! Schema::hasTable($table) || Schema::hasColumn($table, 'display_order')) {
                continue;
            }

            Schema::table($table, function (Blueprint $blueprint) {
                $blueprint->unsignedInteger('display_order')->default(0)->after('is_active');
                $blueprint->index('display_order');
            });
        }
    }

    public function down(): void
    {
        foreach ($this->tables as $table) {
            if (Schema::hasTable($table) && Schema::hasColumn($table, 'display_order')) {
                Schema::table($table, function (Blueprint $blueprint) {
                    $blueprint->dropIndex([$blueprint->getTable() . '_display_order_index']);
                    $blueprint->dropColumn('display_order');
                });
            }
        }
    }
};
