<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('about_contents', function (Blueprint $table) {
            $table->id();

            $table->json('hero_title')->nullable();
            $table->json('who_we_are_title')->nullable();
            $table->json('who_we_are_body')->nullable();
            $table->json('where_we_come_from_title')->nullable();
            $table->json('where_we_come_from_body')->nullable();
            $table->json('commitment_title')->nullable();
            $table->json('commitment_body')->nullable();

            $table->json('founded_label')->nullable();
            $table->json('founded_value')->nullable();
            $table->json('group_label')->nullable();
            $table->json('group_value')->nullable();

            $table->json('business_focus_title')->nullable();
            $table->json('focus_1_title')->nullable();
            $table->json('focus_1_body')->nullable();
            $table->json('focus_2_title')->nullable();
            $table->json('focus_2_body')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('about_contents');
    }
};
