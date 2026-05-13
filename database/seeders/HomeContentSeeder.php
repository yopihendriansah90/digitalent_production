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
                'hero_title' => 'Empowering Digital Talent, Enabling Global Success',
                'hero_subtitle' => null,
                'hero_primary_cta_label' => 'Explore Services',
                'hero_primary_cta_url' => '/services',
                'hero_secondary_cta_label' => 'Free Consultation',
                'hero_secondary_cta_url' => '/contact',
                'hero_proof_items' => [
                    [
                        'label' => 'Core Services',
                        'value' => 'IT Training & IT Outsourcing',
                    ],
                    [
                        'label' => 'Operating Standard',
                        'value' => 'Integrity, Professionalism, Quality',
                    ],
                ],
                'core_values_kicker' => 'Core Values',
                'core_values_title' => 'The values shaping how DigiTalent works.',
                'core_values_items' => [
                    [
                        'title' => 'Integrity',
                        'description' => 'Upholding honesty, responsibility, and professional ethics.',
                    ],
                    [
                        'title' => 'Adaptive',
                        'description' => 'Continuously adapting to the latest technological advancements.',
                    ],
                    [
                        'title' => 'Excellence',
                        'description' => 'Committed to delivering the best results and services.',
                    ],
                    [
                        'title' => 'Collaboration',
                        'description' => 'Building a strong ecosystem bridging academia, professionals, communities, and industry.',
                    ],
                    [
                        'title' => 'Empowerment',
                        'description' => 'Providing opportunities for individuals to grow and create a positive impact in the digital world.',
                    ],
                ],
                'progress_kicker' => 'Progress Counter',
                'progress_items' => [
                    [
                        'label' => 'Training',
                        'value' => 'Completed Training Participants',
                        'counter' => 500,
                        'suffix' => '+',
                    ],
                    [
                        'label' => 'Certification',
                        'value' => 'Completed Certifications',
                        'counter' => 50,
                        'suffix' => '+',
                    ],
                    [
                        'label' => 'Clients',
                        'value' => 'Company Client Participants',
                        'counter' => 500,
                        'suffix' => '+',
                    ],
                    [
                        'label' => 'Programs',
                        'value' => 'Total Training Programs',
                        'counter' => 100,
                        'suffix' => '+',
                    ],
                ],
                'why_choose_kicker' => 'Why Choose Us',
                'why_choose_title' => 'A practical partner for talent development and digital execution.',
                'why_choose_items' => [
                    [
                        'title' => 'Affiliate with SGI Asia as an Authorized CompTIA Partner',
                        'description' => 'Our curriculum and services align with global standards and remain relevant through current case studies, evolving cyber risks, and real industry needs.',
                    ],
                    [
                        'title' => 'Experienced Professionals',
                        'description' => 'DigiTalent is supported by certified experts and practitioners with proven hands-on project experience across real working environments.',
                    ],
                    [
                        'title' => 'Backed by a Robust Ecosystem',
                        'description' => "Through the SGI Asia ecosystem, we gain access to wider client networks and stronger insights into Indonesia's specific IT landscape and requirements.",
                    ],
                    [
                        'title' => 'Solution-Oriented Approach & Career Support',
                        'description' => 'We combine practical training, recruitment support, and career development so participants are ready to solve actual IT challenges effectively.',
                    ],
                    [
                        'title' => 'Unwavering Commitment to Quality',
                        'description' => 'Every service is delivered with a strong focus on excellence, professionalism, and measurable satisfaction for our partners and clients.',
                    ],
                ],
                'faq_kicker' => 'FAQ',
                'faq_title' => 'Pertanyaan yang sering ditanyakan',
                'faq_items' => [
                    [
                        'question' => 'Mengapa training di DigiTalent?',
                        'answer' => 'Program kami disusun praktis, relevan dengan kebutuhan industri, dan didukung trainer berpengalaman serta studi kasus nyata.',
                    ],
                    [
                        'question' => 'Bagaimana memilih training yang paling sesuai?',
                        'answer' => 'Tim kami membantu memetakan kebutuhan personal, tim, atau perusahaan agar program yang dipilih tepat sasaran.',
                    ],
                    [
                        'question' => 'Apakah tersedia corporate in-house training?',
                        'answer' => 'Ya, tersedia opsi corporate in-house training dengan kurikulum yang dapat disesuaikan dengan kebutuhan organisasi.',
                    ],
                    [
                        'question' => 'Layanan outsourcing mencakup apa saja?',
                        'answer' => 'Kami menyediakan dedicated IT staff, managed IT services, technical support, maintenance, dan project-based IT teams.',
                    ],
                ],
            ]
        );
    }
}
