<?php

namespace Database\Seeders;

use App\Models\AboutContent;
use Illuminate\Database\Seeder;

class AboutContentSeeder extends Seeder
{
    public function run(): void
    {
        AboutContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Mitra strategis transformasi digital melalui IT Training dan IT Outsourcing.',
                    'en' => 'Strategic partner for digital transformation through IT Training and IT Outsourcing.',
                ],
                'who_we_are_title' => ['id' => 'Siapa Kami', 'en' => 'Who We Are'],
                'who_we_are_body' => [
                    'id' => 'PT. Systech Talenta Digital (DigiTalent) adalah perusahaan teknologi dan mitra strategis transformasi digital. Kami berfokus pada dua layanan utama: IT Training dan IT Outsourcing. Kami percaya kemajuan digital bergantung pada talenta terampil yang mampu beradaptasi dan berkinerja di lingkungan nyata.',
                    'en' => 'PT. Systech Talenta Digital (DigiTalent) is a technology company and strategic partner for digital transformation. We focus on two core services: IT Training and IT Outsourcing. We believe digital progress depends on skilled people who can adapt and perform in real environments.',
                ],
                'where_we_come_from_title' => ['id' => 'Asal Kami', 'en' => 'Where We Come From'],
                'where_we_come_from_body' => [
                    'id' => 'DigiTalent adalah bagian dari SGI Asia Group, grup IT yang didirikan pada tahun 2013. Kami berawal dari divisi pelatihan PT. Systech Global Informasi dan kemudian berkembang menjadi perusahaan independen. Dengan pengalaman industri dan jaringan yang kuat, kami menjawab dua kebutuhan utama: mengembangkan profesional yang kompeten dan menyediakan talenta siap industri. Tujuan kami adalah menghubungkan kebutuhan industri dengan ketersediaan keterampilan melalui pelatihan terstruktur dan layanan outsourcing yang andal.',
                    'en' => 'DigiTalent is part of SGI Asia Group, an IT group established in 2013. We originated from the training division of PT. Systech Global Informasi and later became an independent company. With strong industry experience and networks, we address two key needs: developing competent professionals and providing industry-ready talent. Our goal is to connect industry demands with available skills through structured training and reliable outsourcing services.',
                ],
                'commitment_title' => ['id' => 'Komitmen Kami', 'en' => 'Our Commitment'],
                'commitment_body' => [
                    'id' => 'Komitmen kami adalah menjembatani kesenjangan antara kebutuhan industri dan ketersediaan talenta. Melalui program pelatihan terstruktur serta layanan outsourcing yang fleksibel dan terpercaya, kami memberdayakan individu dan organisasi untuk unggul dalam masa depan digital yang kompetitif.',
                    'en' => 'Our commitment is to bridge the gap between industry demands and talent availability. Through structured training programs and flexible, trusted outsourcing services, we empower individuals and organizations to excel in a competitive digital future.',
                ],
                'founded_label' => ['id' => 'Didirikan', 'en' => 'Founded'],
                'founded_value' => ['id' => 'Aug 2025', 'en' => 'Aug 2025'],
                'group_label' => ['id' => 'Grup', 'en' => 'Group'],
                'group_value' => ['id' => 'SGI Asia', 'en' => 'SGI Asia'],
                'business_focus_title' => ['id' => 'Fokus Bisnis', 'en' => 'Business Focus'],
                'focus_1_title' => ['id' => 'IT Training', 'en' => 'IT Training'],
                'focus_1_body' => [
                    'id' => 'Pembelajaran terstruktur, mentoring, persiapan sertifikasi, dan pengembangan kapabilitas terapan.',
                    'en' => 'Structured learning, mentoring, certification preparation, and applied capability development.',
                ],
                'focus_2_title' => ['id' => 'IT Outsourcing', 'en' => 'IT Outsourcing'],
                'focus_2_body' => [
                    'id' => 'Penyediaan talenta IT terpercaya untuk kebutuhan proyek, operasional, dan jangka panjang.',
                    'en' => 'Trusted IT talent supply for project, operational, and long-term business needs.',
                ],
            ]
        );
    }
}
