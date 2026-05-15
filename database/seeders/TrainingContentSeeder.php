<?php

namespace Database\Seeders;

use App\Models\TrainingContent;
use Illuminate\Database\Seeder;

class TrainingContentSeeder extends Seeder
{
    public function run(): void
    {
        TrainingContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Katalog training terstruktur berdasarkan domain, format belajar, dan relevansi industri.',
                    'en' => 'Training catalog structured by domain, learning format, and industry relevance.',
                ],
                'hero_background_mode' => 'color',
                'hero_cards' => [
                    [
                        'title' => ['id' => 'Cakupan', 'en' => 'Coverage'],
                        'body' => ['id' => 'Delapan kategori domain dari GRC hingga manajemen proyek.', 'en' => 'Eight domain categories from GRC to project management.'],
                    ],
                    [
                        'title' => ['id' => 'Format Pembelajaran', 'en' => 'Learning Format'],
                        'body' => ['id' => 'Program siap katalog untuk jalur pembelajaran terstruktur dan relevan industri.', 'en' => 'Catalog-ready programs for structured and industry-relevant learning paths.'],
                    ],
                ],
                'domains' => [
                    [
                        'title' => ['id' => 'Cybersecurity', 'en' => 'Cybersecurity'],
                        'body' => ['id' => 'Pelatihan pertahanan siber, awareness ancaman, dan implementasi keamanan.', 'en' => 'Training for cyber defense, threat awareness, and security implementation.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'GRC', 'en' => 'GRC'],
                        'body' => ['id' => 'Program Governance, Risk, & Compliance untuk kesiapan keamanan dan regulasi.', 'en' => 'Governance, Risk, & Compliance programs for security and regulatory readiness.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'IT Operations', 'en' => 'IT Operations'],
                        'body' => ['id' => 'Jalur pembelajaran infrastruktur, operasi sistem, dan keandalan operasional.', 'en' => 'Infrastructure, system operations, and operational reliability learning paths.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'IT Architecture', 'en' => 'IT Architecture'],
                        'body' => ['id' => 'Program desain arsitektur untuk sistem yang scalable dan selaras bisnis.', 'en' => 'Architecture design programs for scalable and business-aligned systems.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'Software Development', 'en' => 'Software Development'],
                        'body' => ['id' => 'Program software engineering praktis dari fondasi hingga delivery tingkat lanjut.', 'en' => 'Practical software engineering programs from foundations to advanced delivery.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'Management & IT BA', 'en' => 'Management & IT BA'],
                        'body' => ['id' => 'Program untuk business analysis, governance, dan kapabilitas manajerial IT.', 'en' => 'Programs for business analysis, governance, and managerial IT capability.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'Project Management', 'en' => 'Project Management'],
                        'body' => ['id' => 'Perencanaan proyek, kontrol delivery, dan manajemen eksekusi untuk tim IT.', 'en' => 'Project planning, delivery control, and execution management for IT teams.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                    [
                        'title' => ['id' => 'Data & Artificial Intelligence', 'en' => 'Data & Artificial Intelligence'],
                        'body' => ['id' => 'Program analisis data, literasi AI, dan applied intelligence untuk tim modern.', 'en' => 'Data analysis, AI literacy, and applied intelligence programs for modern teams.'],
                        'badge' => ['id' => 'Placeholder Link Katalog', 'en' => 'Catalog Link Placeholder'],
                    ],
                ],
            ]
        );
    }
}
