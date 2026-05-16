<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingTopbarSeeder extends Seeder
{
    public function run(): void
    {
        $setting = SiteSetting::query()->firstOrCreate(
            ['company_name' => 'DigiTalent'],
            [
                'email' => 'info@digitalent.co.id',
                'address' => 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia',
            ]
        );

        $setting->update([
            'topbar_working_hours' => $setting->topbar_working_hours ?: [
                'id' => 'Senin - Jumat, 08:00 - 17:00 WIB',
                'en' => 'Monday - Friday, 08:00 - 17:00 WIB',
            ],
            'topbar_address_short' => $setting->topbar_address_short ?: [
                'id' => 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan',
                'en' => 'Wisma Bumiputera 1st Floor, Jl. Jend. Sudirman Kav. 75 South Jakarta',
            ],
            'consultation_label' => $setting->consultation_label ?: [
                'id' => 'Konsultasi Gratis',
                'en' => 'Free Consultation',
            ],
            'nav_labels' => $setting->nav_labels ?: [
                'home' => ['id' => 'Home', 'en' => 'Home'],
                'about' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
                'services' => ['id' => 'Layanan', 'en' => 'Services'],
                'vision_mission' => ['id' => 'Visi & Misi', 'en' => 'Vision & Mission'],
                'portfolio' => ['id' => 'Klien / Portofolio', 'en' => 'Client / Portfolio'],
                'training' => ['id' => 'Training', 'en' => 'Training'],
                'outsourcing' => ['id' => 'Outsourcing', 'en' => 'Outsourcing'],
                'contact' => ['id' => 'Kontak', 'en' => 'Contact'],
            ],
        ]);
    }
}
