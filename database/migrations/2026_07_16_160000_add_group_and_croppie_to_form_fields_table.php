<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {
            if (! Schema::hasColumn('form_fields', 'group_key')) {
                $table->string('group_key')->nullable()->after('is_multiple');
            }
            if (! Schema::hasColumn('form_fields', 'enable_croppie')) {
                $table->boolean('enable_croppie')->default(true)->after('group_key');
            }
        });
    }

    public function down(): void
    {
        Schema::table('form_fields', function (Blueprint $table) {
            if (Schema::hasColumn('form_fields', 'enable_croppie')) {
                $table->dropColumn('enable_croppie');
            }
            if (Schema::hasColumn('form_fields', 'group_key')) {
                $table->dropColumn('group_key');
            }
        });
    }
};
