<?php

namespace Database\Seeders;

use App\Models\OutsourcingContent;
use Illuminate\Database\Seeder;

class OutsourcingContentSeeder extends Seeder
{
    public function run(): void
    {
        OutsourcingContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Talenta IT terbaik untuk engagement bisnis jangka pendek maupun jangka panjang.',
                    'en' => 'Top-tier IT experts for short-term and long-term business engagements.',
                ],
                'hero_background_mode' => 'color',
                'hero_cards' => [
                    [
                        'title' => ['id' => 'Cakupan Talenta', 'en' => 'Talent Scope'],
                        'body' => ['id' => 'Dedicated staff, managed services, dan project-based IT teams.', 'en' => 'Dedicated staff, managed services, and project-based IT teams.'],
                    ],
                    [
                        'title' => ['id' => 'Model Engagement', 'en' => 'Engagement Model'],
                        'body' => ['id' => 'Dukungan fleksibel untuk kontinuitas operasional dan kebutuhan delivery bisnis.', 'en' => 'Flexible support for operational continuity and business delivery needs.'],
                    ],
                ],
                'offer_cards' => [
                    [
                        'title' => ['id' => 'Dedicated IT Staff', 'en' => 'Dedicated IT Staff'],
                        'body' => ['id' => 'Programmer, Network Engineer, Data Analyst, dan profesional siap deploy lainnya.', 'en' => 'Programmers, Network Engineers, Data Analysts, and other deployment-ready professionals.'],
                        'icon' => 'template/Logo/assets/Talent Profiles/Dedicated IT Staff.png',
                    ],
                    [
                        'title' => ['id' => 'Managed IT Services', 'en' => 'Managed IT Services'],
                        'body' => ['id' => 'Dukungan layanan fleksibel untuk kontinuitas operasional dan eksekusi terkelola.', 'en' => 'Flexible service support for operational continuity and managed execution.'],
                        'icon' => 'template/Logo/assets/Talent Profiles/Managed IT Services.png',
                    ],
                    [
                        'title' => ['id' => 'Technical Support & Maintenance', 'en' => 'Technical Support & Maintenance'],
                        'body' => ['id' => 'Support berkelanjutan, troubleshooting, dan maintenance untuk sistem bisnis kritikal.', 'en' => 'Ongoing support, troubleshooting, and maintenance for business-critical systems.'],
                        'icon' => 'template/Logo/assets/Talent Profiles/Technical Support & Maintenance.png',
                    ],
                    [
                        'title' => ['id' => 'Project-Based IT Teams', 'en' => 'Project-Based IT Teams'],
                        'body' => ['id' => 'Tim lintas fungsi untuk target delivery spesifik sesuai scope dan timeline.', 'en' => 'Cross-functional teams for specific delivery objectives, scope, and timeline.'],
                        'icon' => 'template/Logo/assets/Talent Profiles/Project-Based IT Team.png',
                    ],
                ],
                'selection_kicker' => [
                    'id' => 'Proses Seleksi Profesional',
                    'en' => 'Professional Selection Process',
                ],
                'selection_title' => [
                    'id' => 'Turunkan risiko hiring melalui validasi terstruktur dan talenta yang siap deploy.',
                    'en' => 'Lower hiring risk with structured validation and deployment-ready talent.',
                ],
                'benefit_items' => [
                    [
                        'body' => [
                            'id' => 'Talenta terseleksi dengan pengalaman dan sertifikasi terverifikasi.',
                            'en' => 'Pre-qualified talent with verified experience and certifications.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Onboarding lebih cepat dengan profesional siap deploy.',
                            'en' => 'Faster onboarding with deployment-ready professionals.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Risiko hiring lebih rendah melalui screening dan validasi terstruktur.',
                            'en' => 'Lower hiring risk through structured screening and validation.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Produktivitas lebih cepat dari tim yang siap kerja di real-world environment.',
                            'en' => 'Immediate productivity from teams prepared for real-world environments.',
                        ],
                    ],
                ],
            ]
        );
    }
}
