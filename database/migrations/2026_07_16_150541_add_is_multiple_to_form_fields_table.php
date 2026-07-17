<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {
            if (! Schema::hasColumn('form_fields', 'is_multiple')) {
                $table->boolean('is_multiple')->default(false)->after('type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {
            if (Schema::hasColumn('form_fields', 'is_multiple')) {
                $table->dropColumn('is_multiple');
            }
        });
    }
};
