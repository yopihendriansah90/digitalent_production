<?php

namespace Database\Seeders;

use App\Models\PortfolioContent;
use Illuminate\Database\Seeder;

class PortfolioContentSeeder extends Seeder
{
    public function run(): void
    {
        PortfolioContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Client showcase dan galeri training sesuai struktur draft website.',
                    'en' => 'Client showcase and training gallery aligned with the website draft structure.',
                ],
                'hero_cards' => [
                    [
                        'title' => ['id' => 'Kegunaan Presentasi', 'en' => 'Presentation Use'],
                        'body' => ['id' => 'Logo klien dan dokumentasi terkurasi untuk memperkuat kepercayaan saat presentasi.', 'en' => 'Client logos and curated documentation for trust-building presentation.'],
                    ],
                    [
                        'title' => ['id' => 'Struktur Konten', 'en' => 'Content Structure'],
                        'body' => ['id' => 'Dipisahkan menjadi showcase klien dan galeri aktivitas training berbasis tahun.', 'en' => 'Separated into client showcase and year-based training activity gallery.'],
                    ],
                ],
                'clients_kicker' => [
                    'id' => 'Klien Kami',
                    'en' => 'Our Clients',
                ],
                'gallery_heading' => [
                    'id' => 'Showcase dokumentasi training per tahun',
                    'en' => 'Per year training documentation showcases',
                ],
                'client_logos' => [
                    ['name' => 'Client 1', 'image' => 'template/Logo/assets/Logo Client/5.png'],
                    ['name' => 'Client 2', 'image' => 'template/Logo/assets/Logo Client/6.png'],
                    ['name' => 'Client 3', 'image' => 'template/Logo/assets/Logo Client/7.png'],
                    ['name' => 'Client 4', 'image' => 'template/Logo/assets/Logo Client/8.png'],
                    ['name' => 'Client 5', 'image' => 'template/Logo/assets/Logo Client/9.png'],
                    ['name' => 'Client 6', 'image' => 'template/Logo/assets/Logo Client/10.png'],
                    ['name' => 'Client 7', 'image' => 'template/Logo/assets/Logo Client/11.png'],
                    ['name' => 'Client 8', 'image' => 'template/Logo/assets/Logo Client/12.png'],
                ],
                'gallery_items' => [
                    [
                        'year' => '2026',
                        'title' => ['id' => 'Security Awareness Bootcamp', 'en' => 'Security Awareness Bootcamp'],
                        'body' => ['id' => 'Training intensif awareness dan praktik mitigasi risiko keamanan.', 'en' => 'Intensive awareness training and security risk mitigation practices.'],
                        'image' => 'template/Logo/assets/Dokumentasi Training/01 Training Refreshment Cyber Bootcamp_Otoritas Jasa Keuangan_tgl 14 April 2026.jpeg',
                    ],
                    [
                        'year' => '2026',
                        'title' => ['id' => 'Cyber Connect Workshop', 'en' => 'Cyber Connect Workshop'],
                        'body' => ['id' => 'Kolaborasi lintas divisi untuk latihan incident response.', 'en' => 'Cross-division collaboration for incident response drills.'],
                        'image' => 'template/Logo/assets/Dokumentasi Training/02 CISSP tgl 10 April 2026_PT.Kereta Api Indonesia_PT. Bussan Auto Finance_PT. Pegadaian.jpeg',
                    ],
                    [
                        'year' => '2026',
                        'title' => ['id' => 'Digital Capability Session', 'en' => 'Digital Capability Session'],
                        'body' => ['id' => 'Kelas peningkatan kompetensi digital untuk tim operasional.', 'en' => 'Digital capability class for operational teams.'],
                        'image' => 'template/Logo/assets/Dokumentasi Training/03 CompTIA Sec+ tgl 13 -17 April 2026_PT. Muara Alam Sejahtera_PT. Antang Gunung Meratus.jpeg',
                    ],
                ],
            ]
        );
    }
}
