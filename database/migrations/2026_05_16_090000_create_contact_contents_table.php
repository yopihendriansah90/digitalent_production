<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contact_contents', function (Blueprint $table): void {
            $table->id();
            $table->json('hero_title')->nullable();
            $table->json('contact_info_title')->nullable();
            $table->json('contact_items')->nullable();
            $table->json('form_title')->nullable();
            $table->json('form_labels')->nullable();
            $table->json('service_options')->nullable();
            $table->json('button_labels')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contact_contents');
    }
};
