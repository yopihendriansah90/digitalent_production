<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('training_contents', function (Blueprint $table): void {
            $table->boolean('show_domain_numbering')->default(true)->after('hero_background_mode');
        });
    }

    public function down(): void
    {
        Schema::table('training_contents', function (Blueprint $table): void {
            $table->dropColumn('show_domain_numbering');
        });
    }
};
