<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('page_section_contents')) {
            return;
        }

        Schema::create('page_section_contents', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->json('data')->nullable();
            $table->timestamps();

            $table->unique(['page_id', 'section_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_contents');
    }
};
