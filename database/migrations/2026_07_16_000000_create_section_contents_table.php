<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('section_contents', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();

            $table->string('title');
            $table->string('slug')->unique();

            // Which front-end page/section this content belongs to, e.g.
            // page_name = "home", section_name = "about".
            $table->string('page_name');
            $table->string('section_name');

            $table->string('section_label')->nullable();
            $table->string('section_title')->nullable();
            $table->string('section_subtitle')->nullable();

            // Two rich-text blocks (CKEditor) — a left-hand description and a
            // right-hand list/feature block, matching the two-column layout
            // most sections use (e.g. About's paragraph + checklist).
            $table->longText('left_description')->nullable();
            $table->longText('right_list')->nullable();

            $table->unsignedInteger('display_order')->default(0);
            $table->boolean('is_active')->default(true);

            $table->timestamps();
            $table->softDeletes();

            $table->index(['page_name', 'section_name']);
            $table->index('display_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('section_contents');
    }
};
