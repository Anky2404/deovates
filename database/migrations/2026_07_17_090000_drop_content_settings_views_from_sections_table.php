<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            $drop = array_filter(
                ['content', 'settings', 'views'],
                fn ($column) => Schema::hasColumn('sections', $column)
            );

            if (! empty($drop)) {
                $table->dropColumn($drop);
            }
        });
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            if (! Schema::hasColumn('sections', 'content')) {
                $table->longText('content')->nullable()->after('form_id');
            }
            if (! Schema::hasColumn('sections', 'settings')) {
                $table->longText('settings')->nullable()->after('content');
            }
            if (! Schema::hasColumn('sections', 'views')) {
                $table->unsignedInteger('views')->default(0)->after('display_order');
            }
        });
    }
};
