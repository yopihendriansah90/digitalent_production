<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('vision_mission_contents', function (Blueprint $table): void {
            $table->id();
            $table->json('hero_title')->nullable();
            $table->json('vision_kicker')->nullable();
            $table->json('vision_text')->nullable();
            $table->json('mission_kicker')->nullable();
            $table->json('mission_items')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vision_mission_contents');
    }
};
