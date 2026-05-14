<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('portfolio_contents', function (Blueprint $table): void {
            $table->id();
            $table->json('hero_title')->nullable();
            $table->json('hero_cards')->nullable();
            $table->json('clients_kicker')->nullable();
            $table->json('gallery_heading')->nullable();
            $table->json('client_logos')->nullable();
            $table->json('gallery_items')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_contents');
    }
};
