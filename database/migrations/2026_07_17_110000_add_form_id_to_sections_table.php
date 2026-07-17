<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            if (! Schema::hasColumn('sections', 'form_id')) {
                $table->foreignId('form_id')->nullable()->after('slug')->constrained('forms')->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('sections', function (Blueprint $table) {
            if (Schema::hasColumn('sections', 'form_id')) {
                $table->dropConstrainedForeignId('form_id');
            }
        });
    }
};
