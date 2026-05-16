<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->json('footer_description')->nullable()->after('nav_labels');
            $table->json('footer_pages_title')->nullable()->after('footer_description');
            $table->json('footer_services_title')->nullable()->after('footer_pages_title');
            $table->json('footer_contact_title')->nullable()->after('footer_services_title');
            $table->json('footer_service_links')->nullable()->after('footer_contact_title');
            $table->json('footer_bottom_right_text')->nullable()->after('footer_service_links');
        });
    }

    public function down(): void
    {
        Schema::table('site_settings', function (Blueprint $table): void {
            $table->dropColumn([
                'footer_description',
                'footer_pages_title',
                'footer_services_title',
                'footer_contact_title',
                'footer_service_links',
                'footer_bottom_right_text',
            ]);
        });
    }
};

