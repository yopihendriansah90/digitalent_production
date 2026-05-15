<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('training_contents', function (Blueprint $table): void {
            $table->string('hero_background_mode', 20)->default('color')->after('hero_title');
        });
    }

    public function down(): void
    {
        Schema::table('training_contents', function (Blueprint $table): void {
            $table->dropColumn('hero_background_mode');
        });
    }
};
