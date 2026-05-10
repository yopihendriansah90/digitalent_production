<?php

namespace Database\Seeders;

use App\Models\Page;
use App\Models\SectionBlock;
use App\Models\SectionItem;
use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class CmsContentSeeder extends Seeder
{
    public function run(): void
    {
        $siteSetting = SiteSetting::query()->updateOrCreate(
            ['company_name' => 'DigiTalent'],
            [
                'tagline' => 'Strategic Partner for Digital Transformation',
                'email' => 'info@digitalent.co.id',
                'phone' => '(+62) 21 522 4520',
                'whatsapp' => '+62 813 1337 687',
                'address' => 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia',
                'instagram_url' => 'https://www.instagram.com/digitalent.systech',
                'linkedin_url' => 'https://www.linkedin.com/company/pt-systech-talenta-digital-digitalent',
                'website_url' => 'https://digitalent.co.id',
                'copyright_text' => '© ' . date('Y') . ' DigiTalent. All rights reserved.',
            ]
        );

        $this->seedSiteSettingMedia($siteSetting);

        $pages = [
            'home' => [
                'title' => 'Home',
                'hero' => 'Empowering Digital Talent, Enabling Global Success',
                'meta' => 'DigiTalent | Home',
                'description' => 'DigiTalent company profile for IT Training and IT Outsourcing services.',
            ],
            'about' => [
                'title' => 'About Us',
                'hero' => 'Strategic partner for digital transformation through IT Training and IT Outsourcing.',
                'meta' => 'DigiTalent | About',
                'description' => 'About DigiTalent, background, commitment, and business focus.',
            ],
            'services' => [
                'title' => 'Services',
                'hero' => 'IT Training and IT Outsourcing',
                'meta' => 'DigiTalent | Services',
                'description' => 'Service portfolio of DigiTalent including training and outsourcing.',
            ],
            'vision-mission' => [
                'title' => 'Vision & Mission',
                'hero' => 'Vision & Mission',
                'meta' => 'DigiTalent | Vision & Mission',
                'description' => 'Vision and mission of DigiTalent as a digital talent partner.',
            ],
            'portfolio' => [
                'title' => 'Client / Portfolio',
                'hero' => 'Client showcase and training gallery aligned with the website draft structure.',
                'meta' => 'DigiTalent | Portfolio',
                'description' => 'Client logos and documentation of training delivery by DigiTalent.',
            ],
            'training' => [
                'title' => 'Training',
                'hero' => 'Training catalog structured by domain, learning format, and industry relevance.',
                'meta' => 'DigiTalent | Training',
                'description' => 'Training domains and mentored learning approach from DigiTalent.',
            ],
            'outsourcing' => [
                'title' => 'Outsourcing',
                'hero' => 'Top-tier IT experts for short-term and long-term business engagements.',
                'meta' => 'DigiTalent | Outsourcing',
                'description' => 'Outsourcing service offerings and talent profiles from DigiTalent.',
            ],
            'contact' => [
                'title' => 'Contact',
                'hero' => 'Contact DigiTalent for training plans, talent needs, and partnership discussion.',
                'meta' => 'DigiTalent | Contact',
                'description' => 'Contact DigiTalent for consultation and collaboration.',
            ],
        ];

        foreach ($pages as $slug => $content) {
            $page = Page::query()->updateOrCreate(
                ['slug' => $slug],
                [
                    'title' => $content['title'],
                    'hero_title' => $content['hero'],
                    'is_published' => true,
                    'meta_title' => $content['meta'],
                    'meta_description' => $content['description'],
                ]
            );

            $this->seedPageMedia($page, $slug);
        }

        $sectionMap = config('company_profile.section_keys', []);
        $sectionItems = $this->sectionItemTemplates();

        foreach ($sectionMap as $slug => $keys) {
            $page = Page::query()->where('slug', $slug)->first();

            if (! $page) {
                continue;
            }

            foreach ($keys as $index => $key) {
                SectionBlock::query()->updateOrCreate(
                    ['page_id' => $page->id, 'section_key' => $key],
                    [
                        'section_title' => $this->defaultSectionTitle($key),
                        'section_description' => $this->defaultSectionDescription($slug, $key),
                        'order_index' => $index,
                        'is_active' => true,
                    ]
                );

                $sectionBlock = SectionBlock::query()->where('page_id', $page->id)->where('section_key', $key)->first();

                if (! $sectionBlock) {
                    continue;
                }

                $this->seedSectionBlockMedia($sectionBlock, $slug, $key);

                foreach ($sectionItems[$key] ?? [] as $itemIndex => $item) {
                    SectionItem::query()->updateOrCreate(
                        [
                            'section_block_id' => $sectionBlock->id,
                            'title' => $item['title'],
                        ],
                        [
                            'description' => $item['description'],
                            'badge' => $item['badge'] ?? null,
                            'order_index' => $itemIndex,
                            'extra' => $item['extra'] ?? null,
                        ]
                    );
                }
            }
        }
    }

    /**
     * @return array<string, array<int, array<string, mixed>>>
     */
    private function sectionItemTemplates(): array
    {
        return [
            'snapshot' => [
                ['title' => 'Founded', 'description' => 'Aug 2025', 'badge' => 'founded'],
                ['title' => 'Group', 'description' => 'SGI Asia', 'badge' => 'group'],
                ['title' => 'IT Training', 'description' => 'Structured learning, mentoring, certification preparation, and applied capability development.', 'badge' => 'focus_1'],
                ['title' => 'IT Outsourcing', 'description' => 'Trusted IT talent supply for project, operational, and long-term business needs.', 'badge' => 'focus_2'],
            ],
            'core_values' => [
                ['title' => 'Integrity', 'description' => 'Upholding honesty, responsibility, and professional ethics.'],
                ['title' => 'Adaptive', 'description' => 'Continuously adapting to the latest technological advancements.'],
                ['title' => 'Excellence', 'description' => 'Committed to delivering the best results and services.'],
                ['title' => 'Collaboration', 'description' => 'Building a strong ecosystem bridging academia, professionals, communities, and industry.'],
                ['title' => 'Empowerment', 'description' => 'Providing opportunities for individuals to grow and create a positive impact in the digital world.'],
            ],
            'progress_counter' => [
                [
                    'title' => 'Completed Training Participants',
                    'description' => 'Training',
                    'extra' => ['counter' => 500, 'suffix' => '+'],
                ],
                [
                    'title' => 'Completed Certifications',
                    'description' => 'Certification',
                    'extra' => ['counter' => 50, 'suffix' => '+'],
                ],
                [
                    'title' => 'Company Client Participants',
                    'description' => 'Clients',
                    'extra' => ['counter' => 500, 'suffix' => '+'],
                ],
                [
                    'title' => 'Total Training Programs',
                    'description' => 'Programs',
                    'extra' => ['counter' => 100, 'suffix' => '+'],
                ],
            ],
            'why_choose_us' => [
                ['title' => 'Affiliate with SGI Asia as an Authorized CompTIA Partner', 'description' => 'Our curriculum and services align with global standards and remain relevant through current case studies, evolving cyber risks, and real industry needs.'],
                ['title' => 'Experienced Professionals', 'description' => 'DigiTalent is supported by certified experts and practitioners with proven hands-on project experience across real working environments.'],
                ['title' => 'Backed by a Robust Ecosystem', 'description' => "Through the SGI Asia ecosystem, we gain access to wider client networks and stronger insights into Indonesia's specific IT landscape and requirements."],
                ['title' => 'Solution-Oriented Approach & Career Support', 'description' => 'We combine practical training, recruitment support, and career development so participants are ready to solve actual IT challenges effectively.'],
                ['title' => 'Unwavering Commitment to Quality', 'description' => 'Every service is delivered with a strong focus on excellence, professionalism, and measurable satisfaction for our partners and clients.'],
            ],
            'cta' => [
                ['title' => 'Mengapa training di DigiTalent?', 'description' => 'Program kami disusun praktis, relevan dengan kebutuhan industri, dan didukung trainer berpengalaman serta studi kasus nyata.'],
                ['title' => 'Bagaimana memilih training yang paling sesuai?', 'description' => 'Tim kami membantu memetakan kebutuhan personal, tim, atau perusahaan agar program yang dipilih tepat sasaran.'],
                ['title' => 'Apakah tersedia corporate in-house training?', 'description' => 'Ya, tersedia opsi corporate in-house training dengan kurikulum yang dapat disesuaikan dengan kebutuhan organisasi.'],
                ['title' => 'Layanan outsourcing mencakup apa saja?', 'description' => 'Kami menyediakan dedicated IT staff, managed IT services, technical support, maintenance, dan project-based IT teams.'],
            ],
            'training_blocks' => [
                ['title' => 'Corporate In-house Training', 'description' => 'Program training terstruktur untuk kebutuhan organisasi.'],
            ],
            'outsourcing_blocks' => [
                ['title' => 'Dedicated IT Staff', 'description' => 'Talenta IT siap deploy sesuai kebutuhan project.'],
            ],
            'mission_list' => [
                ['title' => 'Develop world-class talent', 'description' => 'Membangun talenta digital yang relevan secara global.'],
                ['title' => 'Build strategic partnerships', 'description' => 'Kolaborasi aktif dengan industri dan institusi.'],
            ],
            'client_logos' => [
                ['title' => 'Enterprise Client Portfolio', 'description' => 'Representasi klien enterprise yang telah bekerja sama.'],
            ],
            'training_gallery' => [
                ['title' => 'Training Documentation', 'description' => 'Dokumentasi delivery training lintas domain dan sektor.'],
            ],
            'training_domains' => [
                ['title' => 'Cybersecurity', 'description' => 'Pelatihan untuk pertahanan keamanan siber organisasi.'],
                ['title' => 'Project Management', 'description' => 'Program penguatan delivery dan governance proyek IT.'],
            ],
            'mentored_learning' => [
                ['title' => 'Hands-on Labs', 'description' => 'Belajar melalui praktik langsung berbasis skenario.'],
            ],
            'talent_profiles' => [
                ['title' => 'Managed IT Services', 'description' => 'Tim IT fleksibel untuk dukungan operasional bisnis.'],
            ],
            'benefit_cards' => [
                ['title' => 'Faster onboarding', 'description' => 'Talenta siap kerja dengan proses adaptasi cepat.'],
            ],
            'contact_info' => [
                ['title' => 'Office Contact', 'description' => 'Kontak utama untuk pertanyaan layanan dan kemitraan.'],
            ],
            'contact_cta' => [
                ['title' => 'Book a Discussion', 'description' => 'Jadwalkan diskusi kebutuhan training atau outsourcing.'],
            ],
        ];
    }

    private function defaultSectionTitle(string $sectionKey): string
    {
        return match ($sectionKey) {
            'who_we_are' => 'Who We Are',
            'where_we_come_from' => 'Where We Come From',
            'commitment' => 'Our Commitment',
            'snapshot' => 'Company Snapshot',
            default => str($sectionKey)->replace('_', ' ')->title()->toString(),
        };
    }

    private function defaultSectionDescription(string $slug, string $sectionKey): ?string
    {
        if ($slug !== 'about') {
            return 'Demo content section for ' . str($sectionKey)->replace('_', ' ')->lower();
        }

        return match ($sectionKey) {
            'who_we_are' => 'PT. Systech Talenta Digital (DigiTalent) is a technology company and strategic partner for digital transformation. We focus on two core services: IT Training and IT Outsourcing. We believe digital progress depends on skilled people who can adapt and perform in real environments.',
            'where_we_come_from' => 'DigiTalent is part of SGI Asia Group, an IT group established in 2013. We originated from the training division of PT. Systech Global Informasi and later became an independent company. With strong industry experience and networks, we address two key needs: developing competent professionals and providing industry-ready talent. Our goal is to connect industry demands with available skills through structured training and reliable outsourcing services.',
            'commitment' => 'Our commitment is to bridge the gap between industry demands and talent availability. Through structured training programs and flexible, trusted outsourcing services, we empower individuals and organizations to excel in a competitive digital future.',
            'snapshot' => null,
            default => 'Demo content section for ' . str($sectionKey)->replace('_', ' ')->lower(),
        };
    }

    private function seedSiteSettingMedia(SiteSetting $siteSetting): void
    {
        $logoLight = base_path('template/Logo/PNG/Horizontal_Background Terang.png');
        $logoDark = base_path('template/Logo/PNG/Horizontal_Background Gelap.png');

        $this->attachSingleMedia($siteSetting, 'logo_light', $logoLight);
        $this->attachSingleMedia($siteSetting, 'logo_dark', $logoDark);
        $this->attachSingleMedia($siteSetting, 'favicon', $logoLight);
    }

    private function seedPageMedia(Page $page, string $slug): void
    {
        $heroImage = match ($slug) {
            'about' => base_path('template/Logo/about.jpeg'),
            'training' => base_path('template/Logo/assets/trainging.png'),
            default => base_path('template/Logo/PNG/Vertikal_Background Terang.png'),
        };

        $this->attachSingleMedia($page, 'hero_background', $heroImage);
        if ($slug === 'about') {
            $this->attachSingleMedia($page, 'about_photo', $heroImage);
        }
        $this->attachMultiMediaIfMissing($page, 'hero_images', $heroImage);
    }

    private function seedSectionBlockMedia(SectionBlock $sectionBlock, string $slug, string $sectionKey): void
    {
        $image = match ($sectionKey) {
            'core_values' => base_path('template/Logo/assets/Core Values/Integrity.png'),
            'training_gallery' => base_path('template/Logo/assets/Dokumentasi Training/07.jpeg'),
            'client_logos' => base_path('template/Logo/assets/Logo Client/8.png'),
            'mentored_learning' => base_path('template/Logo/assets/Mentored Learning/Hands-on Labs.png'),
            'talent_profiles' => base_path('template/Logo/assets/Talent Profiles/Managed IT Services.png'),
            default => base_path('template/Logo/PNG/Horizontal_Background Terang.png'),
        };

        $icon = match ($sectionKey) {
            'core_values' => base_path('template/Logo/assets/check.png'),
            'benefit_cards' => base_path('template/Logo/assets/check.png'),
            default => base_path('template/Logo/assets/check.png'),
        };

        $this->attachMultiMediaIfMissing($sectionBlock, 'section_images', $image);
        $this->attachMultiMediaIfMissing($sectionBlock, 'section_icons', $icon);
    }

    private function attachSingleMedia(object $model, string $collection, string $path): void
    {
        if (! file_exists($path)) {
            return;
        }

        $model->clearMediaCollection($collection);
        $model->addMedia($path)->preservingOriginal()->toMediaCollection($collection);
    }

    private function attachMultiMediaIfMissing(object $model, string $collection, string $path): void
    {
        if (! file_exists($path) || $model->getMedia($collection)->isNotEmpty()) {
            return;
        }

        $model->addMedia($path)->preservingOriginal()->toMediaCollection($collection);
    }
}
