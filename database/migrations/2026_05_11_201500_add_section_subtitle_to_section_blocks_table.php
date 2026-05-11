<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('section_blocks', function (Blueprint $table) {
            $table->string('section_subtitle')->nullable()->after('section_title');
        });
    }

    public function down(): void
    {
        Schema::table('section_blocks', function (Blueprint $table) {
            $table->dropColumn('section_subtitle');
        });
    }
};
