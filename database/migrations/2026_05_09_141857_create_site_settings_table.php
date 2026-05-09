<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('tagline')->nullable();
            $table->string('email')->nullable();
            $table->string('phone', 50)->nullable();
            $table->string('whatsapp', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('website_url')->nullable();
            $table->string('copyright_text')->nullable();
            $table->text('map_embed')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};
