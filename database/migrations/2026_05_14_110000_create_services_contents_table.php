<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services_contents', function (Blueprint $table) {
            $table->id();

            $table->json('hero_title')->nullable();
            $table->json('hero_cards')->nullable();

            $table->json('training_kicker')->nullable();
            $table->json('training_title')->nullable();
            $table->json('training_body')->nullable();
            $table->json('training_overview_items')->nullable();

            $table->json('domain_kicker')->nullable();
            $table->json('domain_title')->nullable();
            $table->json('domain_body')->nullable();

            $table->json('mentored_kicker')->nullable();
            $table->json('mentored_title')->nullable();
            $table->json('mentored_items')->nullable();
            $table->json('support_items')->nullable();

            $table->json('outsourcing_kicker')->nullable();
            $table->json('outsourcing_title')->nullable();
            $table->json('outsourcing_body')->nullable();
            $table->json('outsourcing_overview_items')->nullable();

            $table->json('talent_kicker')->nullable();
            $table->json('talent_title')->nullable();
            $table->json('talent_profiles')->nullable();

            $table->json('selection_kicker')->nullable();
            $table->json('selection_title')->nullable();
            $table->json('selection_items')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services_contents');
    }
};
