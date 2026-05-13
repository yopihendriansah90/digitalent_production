<?php

namespace Database\Seeders;

use App\Models\HomeContent;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        HomeContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Memberdayakan Talenta Digital, Mendorong Sukses Global',
                    'en' => 'Empowering Digital Talent, Enabling Global Success',
                ],
                'hero_subtitle' => [
                    'id' => null,
                    'en' => null,
                ],
                'hero_primary_cta_label' => [
                    'id' => 'Lihat Layanan',
                    'en' => 'Explore Services',
                ],
                'hero_primary_cta_url' => [
                    'id' => '/services',
                    'en' => '/services',
                ],
                'hero_secondary_cta_label' => [
                    'id' => 'Konsultasi Gratis',
                    'en' => 'Free Consultation',
                ],
                'hero_secondary_cta_url' => [
                    'id' => '/contact',
                    'en' => '/contact',
                ],
                'hero_proof_items' => [
                    [
                        'label' => [
                            'id' => 'Layanan Utama',
                            'en' => 'Core Services',
                        ],
                        'value' => [
                            'id' => 'IT Training & IT Outsourcing',
                            'en' => 'IT Training & IT Outsourcing',
                        ],
                    ],
                    [
                        'label' => [
                            'id' => 'Standar Operasional',
                            'en' => 'Operating Standard',
                        ],
                        'value' => [
                            'id' => 'Integrity, Professionalism, Quality',
                            'en' => 'Integrity, Professionalism, Quality',
                        ],
                    ],
                ],
                'core_values_kicker' => [
                    'id' => 'Nilai Inti',
                    'en' => 'Core Values',
                ],
                'core_values_title' => [
                    'id' => 'Nilai yang membentuk cara kerja DigiTalent.',
                    'en' => 'The values shaping how DigiTalent works.',
                ],
                'core_values_items' => [
                    [
                        'title' => ['id' => 'Integrity', 'en' => 'Integrity'],
                        'description' => [
                            'id' => 'Menjunjung kejujuran, tanggung jawab, dan etika profesional.',
                            'en' => 'Upholding honesty, responsibility, and professional ethics.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Adaptive', 'en' => 'Adaptive'],
                        'description' => [
                            'id' => 'Terus beradaptasi dengan perkembangan teknologi terbaru.',
                            'en' => 'Continuously adapting to the latest technological advancements.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Excellence', 'en' => 'Excellence'],
                        'description' => [
                            'id' => 'Berkomitmen memberikan hasil dan layanan terbaik.',
                            'en' => 'Committed to delivering the best results and services.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Collaboration', 'en' => 'Collaboration'],
                        'description' => [
                            'id' => 'Membangun ekosistem kuat yang menghubungkan akademisi, profesional, komunitas, dan industri.',
                            'en' => 'Building a strong ecosystem bridging academia, professionals, communities, and industry.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Empowerment', 'en' => 'Empowerment'],
                        'description' => [
                            'id' => 'Memberikan kesempatan bagi individu untuk berkembang dan memberi dampak positif di dunia digital.',
                            'en' => 'Providing opportunities for individuals to grow and create a positive impact in the digital world.',
                        ],
                    ],
                ],
                'progress_kicker' => [
                    'id' => 'Pencapaian',
                    'en' => 'Progress Counter',
                ],
                'progress_items' => [
                    [
                        'label' => ['id' => 'Pelatihan', 'en' => 'Training'],
                        'value' => [
                            'id' => 'Peserta Pelatihan Selesai',
                            'en' => 'Completed Training Participants',
                        ],
                        'counter' => 500,
                        'suffix' => '+',
                    ],
                    [
                        'label' => ['id' => 'Sertifikasi', 'en' => 'Certification'],
                        'value' => ['id' => 'Sertifikasi Selesai', 'en' => 'Completed Certifications'],
                        'counter' => 50,
                        'suffix' => '+',
                    ],
                    [
                        'label' => ['id' => 'Klien', 'en' => 'Clients'],
                        'value' => ['id' => 'Peserta Klien Perusahaan', 'en' => 'Company Client Participants'],
                        'counter' => 500,
                        'suffix' => '+',
                    ],
                    [
                        'label' => ['id' => 'Program', 'en' => 'Programs'],
                        'value' => ['id' => 'Total Program Pelatihan', 'en' => 'Total Training Programs'],
                        'counter' => 100,
                        'suffix' => '+',
                    ],
                ],
                'why_choose_kicker' => [
                    'id' => 'Alasan Memilih Kami',
                    'en' => 'Why Choose Us',
                ],
                'why_choose_title' => [
                    'id' => 'Mitra praktis untuk pengembangan talenta dan eksekusi digital.',
                    'en' => 'A practical partner for talent development and digital execution.',
                ],
                'why_choose_items' => [
                    [
                        'title' => [
                            'id' => 'Afiliasi SGI Asia sebagai Authorized CompTIA Partner',
                            'en' => 'Affiliate with SGI Asia as an Authorized CompTIA Partner',
                        ],
                        'description' => [
                            'id' => 'Kurikulum dan layanan kami selaras dengan standar global dan relevan dengan studi kasus terkini, risiko siber, serta kebutuhan industri nyata.',
                            'en' => 'Our curriculum and services align with global standards and remain relevant through current case studies, evolving cyber risks, and real industry needs.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Profesional Berpengalaman', 'en' => 'Experienced Professionals'],
                        'description' => [
                            'id' => 'DigiTalent didukung para ahli dan praktisi bersertifikat dengan pengalaman proyek nyata yang terbukti.',
                            'en' => 'DigiTalent is supported by certified experts and practitioners with proven hands-on project experience across real working environments.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Didukung Ekosistem yang Kuat', 'en' => 'Backed by a Robust Ecosystem'],
                        'description' => "Through the SGI Asia ecosystem, we gain access to wider client networks and stronger insights into Indonesia's specific IT landscape and requirements.",
                    ],
                    [
                        'title' => ['id' => 'Pendekatan Solutif & Dukungan Karier', 'en' => 'Solution-Oriented Approach & Career Support'],
                        'description' => [
                            'id' => 'Kami menggabungkan pelatihan praktis, dukungan rekrutmen, dan pengembangan karier agar peserta siap menyelesaikan tantangan IT nyata.',
                            'en' => 'We combine practical training, recruitment support, and career development so participants are ready to solve actual IT challenges effectively.',
                        ],
                    ],
                    [
                        'title' => ['id' => 'Komitmen Kuat pada Kualitas', 'en' => 'Unwavering Commitment to Quality'],
                        'description' => [
                            'id' => 'Setiap layanan diberikan dengan fokus pada kualitas, profesionalisme, dan kepuasan terukur bagi mitra serta klien.',
                            'en' => 'Every service is delivered with a strong focus on excellence, professionalism, and measurable satisfaction for our partners and clients.',
                        ],
                    ],
                ],
                'faq_kicker' => [
                    'id' => 'FAQ',
                    'en' => 'FAQ',
                ],
                'faq_title' => [
                    'id' => 'Pertanyaan yang sering ditanyakan',
                    'en' => 'Frequently Asked Questions',
                ],
                'faq_items' => [
                    [
                        'question' => [
                            'id' => 'Mengapa training di DigiTalent?',
                            'en' => 'Why train with DigiTalent?',
                        ],
                        'answer' => [
                            'id' => 'Program kami disusun praktis, relevan dengan kebutuhan industri, dan didukung trainer berpengalaman serta studi kasus nyata.',
                            'en' => 'Our programs are practical, industry-relevant, and delivered by experienced trainers with real case studies.',
                        ],
                    ],
                    [
                        'question' => [
                            'id' => 'Bagaimana memilih training yang paling sesuai?',
                            'en' => 'How do I choose the most suitable training?',
                        ],
                        'answer' => [
                            'id' => 'Tim kami membantu memetakan kebutuhan personal, tim, atau perusahaan agar program yang dipilih tepat sasaran.',
                            'en' => 'Our team helps map personal, team, or company needs so the selected program is right on target.',
                        ],
                    ],
                    [
                        'question' => [
                            'id' => 'Apakah tersedia corporate in-house training?',
                            'en' => 'Is corporate in-house training available?',
                        ],
                        'answer' => [
                            'id' => 'Ya, tersedia opsi corporate in-house training dengan kurikulum yang dapat disesuaikan dengan kebutuhan organisasi.',
                            'en' => 'Yes, corporate in-house training is available with a curriculum tailored to organizational needs.',
                        ],
                    ],
                    [
                        'question' => [
                            'id' => 'Layanan outsourcing mencakup apa saja?',
                            'en' => 'What does the outsourcing service include?',
                        ],
                        'answer' => [
                            'id' => 'Kami menyediakan dedicated IT staff, managed IT services, technical support, maintenance, dan project-based IT teams.',
                            'en' => 'We provide dedicated IT staff, managed IT services, technical support, maintenance, and project-based IT teams.',
                        ],
                    ],
                ],
            ]
        );
    }
}
