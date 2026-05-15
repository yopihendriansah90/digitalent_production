<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('training_contents', function (Blueprint $table): void {
            $table->id();
            $table->json('hero_title')->nullable();
            $table->json('hero_cards')->nullable();
            $table->json('domains')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('training_contents');
    }
};
