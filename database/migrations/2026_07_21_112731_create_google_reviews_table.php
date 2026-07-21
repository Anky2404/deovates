<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('google_reviews', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->string('google_review_id')->unique();
            $table->string('author_name');
            $table->string('author_photo_url')->nullable();
            $table->string('author_url')->nullable();
            $table->unsignedTinyInteger('rating');
            $table->text('review_text')->nullable();
            $table->string('relative_time_description')->nullable();
            $table->string('language', 10)->nullable();
            $table->timestamp('review_time')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('fetched_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('google_reviews');
    }
};
