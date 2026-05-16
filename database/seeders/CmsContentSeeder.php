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
                'topbar_working_hours' => [
                    'id' => 'Senin - Jumat, 08:00 - 17:00 WIB',
                    'en' => 'Monday - Friday, 08:00 - 17:00 WIB',
                ],
                'topbar_address_short' => [
                    'id' => 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan',
                    'en' => 'Wisma Bumiputera 1st Floor, Jl. Jend. Sudirman Kav. 75 South Jakarta',
                ],
                'consultation_label' => [
                    'id' => 'Konsultasi Gratis',
                    'en' => 'Free Consultation',
                ],
                'nav_labels' => [
                    'home' => ['id' => 'Home', 'en' => 'Home'],
                    'about' => ['id' => 'Tentang Kami', 'en' => 'About Us'],
                    'services' => ['id' => 'Layanan', 'en' => 'Services'],
                    'vision_mission' => ['id' => 'Visi & Misi', 'en' => 'Vision & Mission'],
                    'portfolio' => ['id' => 'Klien / Portofolio', 'en' => 'Client / Portfolio'],
                    'training' => ['id' => 'Training', 'en' => 'Training'],
                    'outsourcing' => ['id' => 'Outsourcing', 'en' => 'Outsourcing'],
                    'contact' => ['id' => 'Kontak', 'en' => 'Contact'],
                ],
                'footer_description' => [
                    'id' => 'DigiTalent mendukung transformasi digital melalui talenta yang kompeten dan siap industri dengan fokus pada IT Training dan IT Outsourcing.',
                    'en' => 'DigiTalent supports digital transformation through capable, industry-ready talent with a focus on IT Training and IT Outsourcing.',
                ],
                'footer_pages_title' => [
                    'id' => 'Halaman',
                    'en' => 'Pages',
                ],
                'footer_services_title' => [
                    'id' => 'Layanan',
                    'en' => 'Services',
                ],
                'footer_contact_title' => [
                    'id' => 'Kontak',
                    'en' => 'Contact',
                ],
                'footer_service_links' => [
                    ['id' => 'IT Training', 'en' => 'IT Training', 'route' => 'training'],
                    ['id' => 'Persiapan Sertifikasi', 'en' => 'Certification Preparation', 'route' => 'training'],
                    ['id' => 'Corporate In-House Training', 'en' => 'Corporate In-House Training', 'route' => 'training'],
                    ['id' => 'IT Outsourcing', 'en' => 'IT Outsourcing', 'route' => 'outsourcing'],
                    ['id' => 'Dedicated IT Staff', 'en' => 'Dedicated IT Staff', 'route' => 'outsourcing'],
                    ['id' => 'Project-Based IT Teams', 'en' => 'Project-Based IT Teams', 'route' => 'outsourcing'],
                ],
                'footer_bottom_right_text' => [
                    'id' => 'Empowering Digital Talent, Enabling Global Success.',
                    'en' => 'Empowering Digital Talent, Enabling Global Success.',
                ],
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
                        'section_subtitle' => $this->defaultSectionSubtitle($key),
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

                $itemsTemplate = $sectionItems[$key] ?? [];

                if (in_array($key, ['training_blocks', 'outsourcing_blocks', 'services_intro_cards', 'training_domain', 'mentored_learning', 'training_support_cards', 'services_talent_profiles', 'selection_process'], true)) {
                    $sectionBlock->items()->delete();

                    foreach ($itemsTemplate as $itemIndex => $item) {
                        SectionItem::query()->create([
                            'section_block_id' => $sectionBlock->id,
                            'title' => $item['title'],
                            'description' => $item['description'],
                            'badge' => $item['badge'] ?? null,
                            'order_index' => $itemIndex,
                            'extra' => $item['extra'] ?? null,
                        ]);
                    }

                    continue;
                }

                foreach ($itemsTemplate as $itemIndex => $item) {
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
                ['title' => 'Fundamental to Advanced Training', 'description' => 'We offer a specialized Mentored Learning system where professionals can learn with flexible schedules and affordable pricing, without compromising on the quality of the learning experience.'],
                ['title' => 'Experienced Instructors', 'description' => 'Our learning process is guided by senior practitioners who are not only globally certified but also possess an average of over 5 years of teaching experience.'],
            ],
            'outsourcing_blocks' => [
                ['title' => 'Overview', 'description' => 'We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements.'],
                ['title' => 'Flexible Outsourcing Model', 'description' => 'Through our flexible outsourcing model, we ensure cost efficiency, high-quality performance, and data security.'],
            ],
            'services_intro_cards' => [
                ['title' => 'Core Services', 'description' => 'Capability development and deployment-ready IT talent.'],
                ['title' => 'Delivery Standard', 'description' => 'Quality, efficiency, high performance, and data security.'],
            ],
            'training_domain' => [
                ['title' => 'IT Training Domain', 'description' => 'DigiTalent accommodates a broad range of industry-relevant training domains to support both foundational capability building and specialized professional development.', 'extra' => ['image_path' => 'template/Logo/assets/trainging.png']],
            ],
            'mentored_learning' => [
                ['title' => 'Main Photo', 'description' => 'Main illustration for mentored learning section.', 'extra' => ['image_path' => 'https://www.sgi-asia.co.id/Activities/CSAS.jpg']],
                ['title' => 'Direct Online Access', 'description' => 'Interactive discussions with Trainers.', 'extra' => ['image_path' => 'template/Logo/assets/Mentored Learning/Direct Online Access.png']],
                ['title' => 'Active Learning', 'description' => 'Supported by virtual technology.', 'extra' => ['image_path' => 'template/Logo/assets/Mentored Learning/Active Learning.png']],
                ['title' => 'Hands-on Labs', 'description' => 'Practical training environments.', 'extra' => ['image_path' => 'template/Logo/assets/Mentored Learning/Hands-on Labs.png']],
                ['title' => 'Project-Based Assessments', 'description' => 'Evaluation through real-work projects.', 'extra' => ['image_path' => 'template/Logo/assets/Mentored Learning/Project-Based Assessment.png']],
                ['title' => 'Real-World Scenarios', 'description' => 'Equipped with case studies and industry examples.', 'extra' => ['image_path' => 'template/Logo/assets/Mentored Learning/Real-World Scenariost.png']],
            ],
            'training_support_cards' => [
                ['title' => 'Flexible Delivery Methods', 'description' => 'We accommodate your needs through Public Classes (Online or Offline), Hybrid learning, as well as Corporate In-House Training and ODP (Office Development Program) tailored for your team.'],
                ['title' => 'Learning Outcome Focus', 'description' => 'We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.'],
            ],
            'services_talent_profiles' => [
                ['title' => 'Dedicated IT Staff', 'description' => 'Programmers, Network Engineers, and Data Analysts ready for direct business deployment.', 'extra' => ['image_path' => 'template/Logo/assets/Talent Profiles/Dedicated IT Staff.png']],
                ['title' => 'Managed IT Services', 'description' => 'Managed operational support for stable and flexible IT service execution.', 'extra' => ['image_path' => 'template/Logo/assets/Talent Profiles/Managed IT Services.png']],
                ['title' => 'Technical Support & Maintenance', 'description' => 'Technical support and maintenance to sustain reliable day-to-day operations.', 'extra' => ['image_path' => 'template/Logo/assets/Talent Profiles/Technical Support & Maintenance.png']],
                ['title' => 'Project-Based IT Teams', 'description' => 'Focused IT teams aligned to defined scope, delivery target, and project timeline.', 'extra' => ['image_path' => 'template/Logo/assets/Talent Profiles/Project-Based IT Team.png']],
            ],
            'selection_process' => [
                ['title' => 'Pre-qualified Talent', 'description' => 'Pre-qualified talent with verified experience and certifications.'],
                ['title' => 'Faster Onboarding', 'description' => 'Faster onboarding with deployment-ready professionals.'],
                ['title' => 'Lower Hiring Risk', 'description' => 'Lower hiring risk through structured screening and validation.'],
                ['title' => 'Immediate Productivity', 'description' => 'Immediate productivity from teams prepared for real-world environments.'],
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
            'training_blocks' => 'IT Training',
            'outsourcing_blocks' => 'IT Outsourcing',
            'training_domain' => 'Domain Training',
            'mentored_learning' => 'Mentored Learning',
            'services_talent_profiles' => 'Talent Profiles',
            'selection_process' => 'Professional Selection Process',
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
            'training_blocks' => 'We accommodate a wide range of industry-relevant IT training and certification needs. We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.',
            'outsourcing_blocks' => 'We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements. Through our flexible outsourcing model, we ensure cost efficiency, high-quality performance, and data security.',
            'training_domain' => 'DigiTalent accommodates a broad range of industry-relevant training domains to support both foundational capability building and specialized professional development.',
            'mentored_learning' => 'A structured learning model for practical capability development.',
            'services_talent_profiles' => 'Deployment-ready roles for operational and project needs.',
            'training_support_cards' => null,
            'selection_process' => 'Structured validation to reduce hiring risk and speed deployment.',
            'snapshot' => null,
            default => 'Demo content section for ' . str($sectionKey)->replace('_', ' ')->lower(),
        };
    }

    private function defaultSectionSubtitle(string $sectionKey): ?string
    {
        return match ($sectionKey) {
            'training_blocks' => 'Industry-relevant IT training and certification preparation.',
            'outsourcing_blocks' => 'Top-tier IT experts for short-term and long-term engagements.',
            default => null,
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
