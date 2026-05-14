<?php

namespace Database\Seeders;

use App\Models\ServicesContent;
use Illuminate\Database\Seeder;

class ServicesContentSeeder extends Seeder
{
    public function run(): void
    {
        ServicesContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'IT Training dan IT Outsourcing',
                    'en' => 'IT Training and IT Outsourcing',
                ],
                'hero_cards' => [
                    ['title' => ['id' => 'Layanan Inti', 'en' => 'Core Services'], 'body' => ['id' => 'Pengembangan kapabilitas dan talenta IT siap deploy.', 'en' => 'Capability development and deployment-ready IT talent.']],
                    ['title' => ['id' => 'Standar Delivery', 'en' => 'Delivery Standard'], 'body' => ['id' => 'Kualitas, efisiensi, kinerja tinggi, dan keamanan data.', 'en' => 'Quality, efficiency, high performance, and data security.']],
                ],
                'training_kicker' => ['id' => 'IT Training', 'en' => 'IT Training'],
                'training_title' => ['id' => 'Pelatihan IT relevan industri dan persiapan sertifikasi.', 'en' => 'Industry-relevant IT training and certification preparation.'],
                'training_body' => ['id' => 'Kami mengakomodasi berbagai kebutuhan pelatihan dan sertifikasi IT yang relevan dengan industri.', 'en' => 'We accommodate a wide range of industry-relevant IT training and certification needs. We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.'],
                'training_overview_items' => [
                    ['title' => ['id' => 'Fundamental hingga Advanced Training', 'en' => 'Fundamental to Advanced Training'], 'body' => ['id' => 'Kami menawarkan sistem Mentored Learning khusus dengan jadwal fleksibel dan harga terjangkau tanpa mengorbankan kualitas belajar.', 'en' => 'We offer a specialized Mentored Learning system where professionals can learn with flexible schedules and affordable pricing, without compromising on the quality of the learning experience.']],
                    ['title' => ['id' => 'Instruktur Berpengalaman', 'en' => 'Experienced Instructors'], 'body' => ['id' => 'Proses pembelajaran dipandu praktisi senior bersertifikat global dengan pengalaman mengajar rata-rata lebih dari 5 tahun.', 'en' => 'Our learning process is guided by senior practitioners who are not only globally certified but also possess an average of over 5 years of teaching experience.']],
                ],
                'domain_kicker' => ['id' => 'Domain Training', 'en' => 'Domain Training'],
                'domain_title' => ['id' => 'IT Training Domain', 'en' => 'IT Training Domain'],
                'domain_body' => ['id' => 'DigiTalent mengakomodasi berbagai domain pelatihan relevan industri untuk penguatan fondasi dan pengembangan profesional spesialis.', 'en' => 'DigiTalent accommodates a broad range of industry-relevant training domains to support both foundational capability building and specialized professional development.'],
                'mentored_kicker' => ['id' => 'Mentored Learning', 'en' => 'Mentored Learning'],
                'mentored_title' => ['id' => 'Model pembelajaran terstruktur untuk pengembangan kapabilitas praktis.', 'en' => 'A structured learning model for practical capability development.'],
                'mentored_items' => [
                    ['title' => ['id' => 'Direct Online Access', 'en' => 'Direct Online Access'], 'body' => ['id' => 'Diskusi interaktif bersama trainer.', 'en' => 'Interactive discussions with Trainers.']],
                    ['title' => ['id' => 'Active Learning', 'en' => 'Active Learning'], 'body' => ['id' => 'Didukung teknologi virtual.', 'en' => 'Supported by virtual technology.']],
                    ['title' => ['id' => 'Hands-on Labs', 'en' => 'Hands-on Labs'], 'body' => ['id' => 'Lingkungan pelatihan praktis.', 'en' => 'Practical training environments.']],
                    ['title' => ['id' => 'Project-Based Assessments', 'en' => 'Project-Based Assessments'], 'body' => ['id' => 'Evaluasi melalui proyek kerja nyata.', 'en' => 'Evaluation through real-work projects.']],
                    ['title' => ['id' => 'Real-World Scenarios', 'en' => 'Real-World Scenarios'], 'body' => ['id' => 'Dilengkapi studi kasus dan contoh industri.', 'en' => 'Equipped with case studies and industry examples.']],
                ],
                'support_items' => [
                    ['title' => ['id' => 'Metode Delivery Fleksibel', 'en' => 'Flexible Delivery Methods'], 'body' => ['id' => 'Kami mengakomodasi kebutuhan melalui kelas publik, hybrid learning, corporate in-house training, dan ODP.', 'en' => 'We accommodate your needs through Public Classes (Online or Offline), Hybrid learning, as well as Corporate In-House Training and ODP (Office Development Program) tailored for your team.']],
                    ['title' => ['id' => 'Fokus Hasil Pembelajaran', 'en' => 'Learning Outcome Focus'], 'body' => ['id' => 'Peserta mendapat pemahaman mendalam dan keahlian praktis melalui mentoring khusus persiapan sertifikasi.', 'en' => 'We ensure that participants gain in-depth understanding and practical expertise through dedicated mentoring in preparation for certification exams.']],
                ],
                'outsourcing_kicker' => ['id' => 'IT Outsourcing', 'en' => 'IT Outsourcing'],
                'outsourcing_title' => ['id' => 'Talenta IT terbaik untuk kebutuhan jangka pendek maupun jangka panjang.', 'en' => 'Top-tier IT experts for short-term and long-term engagements.'],
                'outsourcing_body' => ['id' => 'Kami membantu perusahaan mencari dan mengelola talenta IT terbaik dengan model outsourcing fleksibel, efisien, dan aman.', 'en' => 'We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements. Through our flexible outsourcing model, we ensure cost efficiency, high-quality performance, and data security.'],
                'outsourcing_overview_items' => [
                    ['title' => ['id' => 'Overview', 'en' => 'Overview'], 'body' => ['id' => 'Kami membantu perusahaan mencari dan mengelola talenta IT terbaik untuk kebutuhan jangka pendek maupun panjang.', 'en' => 'We assist companies in sourcing and managing top-tier IT experts for both short-term and long-term engagements.']],
                    ['title' => ['id' => 'Model Outsourcing Fleksibel', 'en' => 'Flexible Outsourcing Model'], 'body' => ['id' => 'Melalui model fleksibel, kami memastikan efisiensi biaya, performa berkualitas tinggi, dan keamanan data.', 'en' => 'Through our flexible outsourcing model, we ensure cost efficiency, high-quality performance, and data security.']],
                ],
                'talent_kicker' => ['id' => 'Talent Profiles', 'en' => 'Talent Profiles'],
                'talent_title' => ['id' => 'Peran siap deploy untuk kebutuhan operasional dan proyek.', 'en' => 'Deployment-ready roles for operational and project needs.'],
                'talent_profiles' => [
                    ['title' => ['id' => 'Dedicated IT Staff', 'en' => 'Dedicated IT Staff'], 'body' => ['id' => 'Programmer, Network Engineer, dan Data Analyst siap untuk deployment langsung.', 'en' => 'Programmers, Network Engineers, and Data Analysts ready for direct business deployment.']],
                    ['title' => ['id' => 'Managed IT Services', 'en' => 'Managed IT Services'], 'body' => ['id' => 'Dukungan operasional terkelola untuk eksekusi layanan IT yang stabil dan fleksibel.', 'en' => 'Managed operational support for stable and flexible IT service execution.']],
                    ['title' => ['id' => 'Technical Support & Maintenance', 'en' => 'Technical Support & Maintenance'], 'body' => ['id' => 'Dukungan teknis dan maintenance untuk menjaga operasi harian tetap andal.', 'en' => 'Technical support and maintenance to sustain reliable day-to-day operations.']],
                    ['title' => ['id' => 'Project-Based IT Teams', 'en' => 'Project-Based IT Teams'], 'body' => ['id' => 'Tim IT fokus sesuai scope, target delivery, dan timeline proyek.', 'en' => 'Focused IT teams aligned to defined scope, delivery target, and project timeline.']],
                ],
                'selection_kicker' => ['id' => 'Proses Seleksi Profesional', 'en' => 'Professional Selection Process'],
                'selection_title' => ['id' => 'Validasi terstruktur untuk menurunkan risiko hiring dan mempercepat deployment.', 'en' => 'Structured validation to reduce hiring risk and speed deployment.'],
                'selection_items' => [
                    ['title' => ['id' => 'Talenta Terseleksi', 'en' => 'Pre-qualified Talent'], 'body' => ['id' => 'Talenta terseleksi dengan pengalaman dan sertifikasi terverifikasi.', 'en' => 'Pre-qualified talent with verified experience and certifications.']],
                    ['title' => ['id' => 'Onboarding Lebih Cepat', 'en' => 'Faster Onboarding'], 'body' => ['id' => 'Onboarding lebih cepat dengan profesional siap deploy.', 'en' => 'Faster onboarding with deployment-ready professionals.']],
                    ['title' => ['id' => 'Risiko Hiring Lebih Rendah', 'en' => 'Lower Hiring Risk'], 'body' => ['id' => 'Risiko hiring lebih rendah melalui screening dan validasi terstruktur.', 'en' => 'Lower hiring risk through structured screening and validation.']],
                    ['title' => ['id' => 'Produktivitas Lebih Cepat', 'en' => 'Immediate Productivity'], 'body' => ['id' => 'Produktivitas langsung dari tim yang siap lingkungan kerja nyata.', 'en' => 'Immediate productivity from teams prepared for real-world environments.']],
                ],
            ]
        );
    }
}
