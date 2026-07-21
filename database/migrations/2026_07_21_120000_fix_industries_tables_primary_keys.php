<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // These two tables were created without a primary key / auto-increment on `id`,
        // which blocks any insert (admin panel and seeders alike).
        if (Schema::hasTable('industry_categories')) {
            DB::statement('ALTER TABLE `industry_categories` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `industry_categories` ADD UNIQUE `industry_categories_uuid_unique` (`uuid`)');
            DB::statement('ALTER TABLE `industry_categories` ADD UNIQUE `industry_categories_slug_unique` (`slug`)');
        }

        if (Schema::hasTable('industries')) {
            DB::statement('ALTER TABLE `industries` MODIFY `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT, ADD PRIMARY KEY (`id`)');
            DB::statement('ALTER TABLE `industries` ADD UNIQUE `industries_uuid_unique` (`uuid`)');
            DB::statement('ALTER TABLE `industries` ADD UNIQUE `industries_slug_unique` (`slug`)');
            DB::statement('ALTER TABLE `industries` ADD INDEX `industries_category_id_index` (`category_id`)');
            DB::statement('ALTER TABLE `industries` ADD CONSTRAINT `industries_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `industry_categories` (`id`) ON DELETE SET NULL');
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('industries')) {
            DB::statement('ALTER TABLE `industries` DROP FOREIGN KEY `industries_category_id_foreign`');
            DB::statement('ALTER TABLE `industries` DROP INDEX `industries_category_id_index`');
            DB::statement('ALTER TABLE `industries` DROP INDEX `industries_slug_unique`');
            DB::statement('ALTER TABLE `industries` DROP INDEX `industries_uuid_unique`');
            DB::statement('ALTER TABLE `industries` MODIFY `id` BIGINT UNSIGNED NOT NULL, DROP PRIMARY KEY');
        }

        if (Schema::hasTable('industry_categories')) {
            DB::statement('ALTER TABLE `industry_categories` DROP INDEX `industry_categories_slug_unique`');
            DB::statement('ALTER TABLE `industry_categories` DROP INDEX `industry_categories_uuid_unique`');
            DB::statement('ALTER TABLE `industry_categories` MODIFY `id` BIGINT UNSIGNED NOT NULL, DROP PRIMARY KEY');
        }
    }
};
