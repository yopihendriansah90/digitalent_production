<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('home_contents', function (Blueprint $table) {
            $table->id();

            // Hero section
            $table->string('hero_title');
            $table->text('hero_subtitle')->nullable();
            $table->string('hero_primary_cta_label')->nullable();
            $table->string('hero_primary_cta_url')->nullable();
            $table->string('hero_secondary_cta_label')->nullable();
            $table->string('hero_secondary_cta_url')->nullable();
            $table->json('hero_proof_items')->nullable();

            // Core values section
            $table->string('core_values_kicker')->nullable();
            $table->string('core_values_title')->nullable();
            $table->json('core_values_items')->nullable();

            // Progress counter section
            $table->string('progress_kicker')->nullable();
            $table->json('progress_items')->nullable();

            // Why choose us section
            $table->string('why_choose_kicker')->nullable();
            $table->string('why_choose_title')->nullable();
            $table->json('why_choose_items')->nullable();

            // FAQ section
            $table->string('faq_kicker')->nullable();
            $table->string('faq_title')->nullable();
            $table->json('faq_items')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('home_contents');
    }
};
