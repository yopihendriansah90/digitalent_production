<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('outsourcing_contents', function (Blueprint $table): void {
            $table->id();
            $table->json('hero_title')->nullable();
            $table->string('hero_background_mode', 20)->default('color');
            $table->json('hero_cards')->nullable();
            $table->json('offer_cards')->nullable();
            $table->json('selection_kicker')->nullable();
            $table->json('selection_title')->nullable();
            $table->json('benefit_items')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('outsourcing_contents');
    }
};
