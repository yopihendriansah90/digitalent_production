<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->json('topbar_working_hours')->nullable()->after('map_embed');
            $table->json('topbar_address_short')->nullable()->after('topbar_working_hours');
            $table->json('consultation_label')->nullable()->after('topbar_address_short');
            $table->json('nav_labels')->nullable()->after('consultation_label');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->dropColumn([
                'topbar_working_hours',
                'topbar_address_short',
                'consultation_label',
                'nav_labels',
            ]);
        });
    }
};

