<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('website_audit_leads', function (Blueprint $table) {
            $table->id();
            $table->char('uuid', 36)->unique();
            $table->enum('type', ['speed', 'seo'])->default('speed');
            $table->string('name');
            $table->string('email');
            $table->string('phone', 30)->nullable();
            $table->string('url');
            $table->json('mobile_scores')->nullable();
            $table->json('mobile_metrics')->nullable();
            $table->json('desktop_scores')->nullable();
            $table->json('desktop_metrics')->nullable();
            $table->string('status')->default('completed');
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('website_audit_leads');
    }
};
