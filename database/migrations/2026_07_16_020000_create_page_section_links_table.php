<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Page <-> Section pivot, with its own display_order per page — the
     * "sections" model already had a pages() relation expecting exactly
     * this shape, but it was pointed at the unrelated page_sections table
     * (the Page <-> Form pivot). This is the correct, dedicated table.
     */
    public function up(): void
    {
        Schema::create('page_section_links', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->foreignId('section_id')->constrained('sections')->cascadeOnDelete();
            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();

            $table->unique(['page_id', 'section_id']);
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_section_links');
    }
};
