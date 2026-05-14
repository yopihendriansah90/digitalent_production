<?php

namespace Database\Seeders;

use App\Models\VisionMissionContent;
use Illuminate\Database\Seeder;

class VisionMissionContentSeeder extends Seeder
{
    public function run(): void
    {
        VisionMissionContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Visi & Misi',
                    'en' => 'Vision & Mission',
                ],
                'vision_kicker' => [
                    'id' => 'Visi',
                    'en' => 'Vision',
                ],
                'vision_text' => [
                    'id' => 'Menjadi mitra strategis terdepan dalam mengembangkan dan menyediakan talenta digital unggul, inovatif, dan kompetitif secara global untuk mendukung transformasi digital berstandar internasional.',
                    'en' => 'To be the leading strategic partner in developing and providing superior, innovative, and globally competitive digital talent to support international-standard digital transformation.',
                ],
                'mission_kicker' => [
                    'id' => 'Misi',
                    'en' => 'Mission',
                ],
                'mission_items' => [
                    [
                        'body' => [
                            'id' => 'Menyelenggarakan program pelatihan dan sertifikasi IT berkualitas tinggi untuk menghasilkan talenta digital siap kerja sesuai standar global.',
                            'en' => 'Provide high-quality IT training and certification programs to produce job-ready digital talent that meets global standards.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Membangun ekosistem outsourcing yang profesional dan andal untuk memenuhi kebutuhan SDM dan solusi IT perusahaan mitra.',
                            'en' => 'Establish a professional and reliable outsourcing ecosystem to fulfill the human resource and IT solution needs of our partner companies.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Menjalin kolaborasi strategis dengan industri, institusi pendidikan, dan pemerintah untuk memperkuat pasokan talenta digital nasional.',
                            'en' => 'Forge strategic collaborations with industries, educational institutions, and the government to strengthen the national digital talent supply.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Mendorong inovasi berkelanjutan dalam sistem pembelajaran, proses rekrutmen, dan pelaksanaan proyek teknologi.',
                            'en' => 'Drive continuous innovation in learning systems, recruitment processes, and technology project execution.',
                        ],
                    ],
                    [
                        'body' => [
                            'id' => 'Menjunjung tinggi integritas, profesionalisme, dan kepuasan klien dalam setiap layanan pelatihan maupun teknologi yang diberikan.',
                            'en' => 'Uphold integrity, professionalism, and client satisfaction in every training and technology service delivered.',
                        ],
                    ],
                ],
            ]
        );
    }
}
