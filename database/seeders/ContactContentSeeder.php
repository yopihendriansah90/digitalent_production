<?php

namespace Database\Seeders;

use App\Models\ContactContent;
use Illuminate\Database\Seeder;

class ContactContentSeeder extends Seeder
{
    public function run(): void
    {
        ContactContent::query()->updateOrCreate(
            ['id' => 1],
            [
                'hero_title' => [
                    'id' => 'Hubungi DigiTalent untuk rencana training, kebutuhan talenta, dan diskusi kemitraan.',
                    'en' => 'Contact DigiTalent for training plans, talent needs, and partnership discussion.',
                ],
                'contact_info_title' => [
                    'id' => 'Informasi Kontak',
                    'en' => 'Contact Information',
                ],
                'contact_items' => [
                    [
                        'label' => ['id' => 'Telepon', 'en' => 'Phone'],
                        'value' => ['id' => '(+62) 21 522 4520', 'en' => '(+62) 21 522 4520'],
                        'link' => null,
                    ],
                    [
                        'label' => ['id' => 'Email', 'en' => 'Email'],
                        'value' => ['id' => 'info@digitalent.co.id', 'en' => 'info@digitalent.co.id'],
                        'link' => 'mailto:info@digitalent.co.id',
                    ],
                    [
                        'label' => ['id' => 'Website', 'en' => 'Website'],
                        'value' => ['id' => 'www.digitalent.co.id', 'en' => 'www.digitalent.co.id'],
                        'link' => 'https://www.digitalent.co.id',
                    ],
                    [
                        'label' => ['id' => 'Alamat', 'en' => 'Address'],
                        'value' => [
                            'id' => 'Wisma Bumiputera Lantai 1, Jl. Jend. Sudirman Kav. 75 Jakarta Selatan 12910 Indonesia',
                            'en' => 'Wisma Bumiputera 1st Floor, Jl. Jend. Sudirman Kav. 75 South Jakarta 12910 Indonesia',
                        ],
                        'link' => null,
                    ],
                    [
                        'label' => ['id' => 'WhatsApp', 'en' => 'WhatsApp'],
                        'value' => ['id' => '+62 813 1337 687', 'en' => '+62 813 1337 687'],
                        'link' => 'https://wa.me/628131337687',
                    ],
                    [
                        'label' => ['id' => 'Instagram', 'en' => 'Instagram'],
                        'value' => ['id' => 'digitalent.systech', 'en' => 'digitalent.systech'],
                        'link' => 'https://www.instagram.com/digitalent.systech',
                    ],
                    [
                        'label' => ['id' => 'LinkedIn', 'en' => 'LinkedIn'],
                        'value' => ['id' => 'PT Systech Talenta Digital', 'en' => 'PT Systech Talenta Digital'],
                        'link' => 'https://www.linkedin.com/company/pt-systech-talenta-digital-digitalent',
                    ],
                ],
                'form_title' => [
                    'id' => 'Formulir Kontak',
                    'en' => 'Contact Form',
                ],
                'form_labels' => [
                    'name' => ['id' => 'Nama', 'en' => 'Name'],
                    'name_placeholder' => ['id' => 'Nama lengkap', 'en' => 'Full name'],
                    'email' => ['id' => 'Email', 'en' => 'Email'],
                    'email_placeholder' => ['id' => 'email@company.com', 'en' => 'email@company.com'],
                    'service_type' => ['id' => 'Jenis Services', 'en' => 'Service Type'],
                    'service_placeholder' => ['id' => 'Pilih layanan', 'en' => 'Select service'],
                    'message' => ['id' => 'Pertanyaan', 'en' => 'Message'],
                    'message_placeholder' => ['id' => 'Jelaskan kebutuhan Anda', 'en' => 'Tell us about your needs'],
                ],
                'service_options' => [
                    ['id' => 'IT Training', 'en' => 'IT Training'],
                    ['id' => 'IT Outsourcing', 'en' => 'IT Outsourcing'],
                    ['id' => 'Corporate In-House Training', 'en' => 'Corporate In-House Training'],
                    ['id' => 'ODP (Office Development Program)', 'en' => 'ODP (Office Development Program)'],
                    ['id' => 'Partnership', 'en' => 'Partnership'],
                ],
                'button_labels' => [
                    'submit' => ['id' => 'Kirim Pertanyaan', 'en' => 'Send Inquiry'],
                    'success' => ['id' => 'Pesan Anda sudah terkirim. Tim kami akan segera menghubungi Anda.', 'en' => 'Your message has been sent. Our team will contact you soon.'],
                    'error' => ['id' => 'Mohon cek kembali input form Anda.', 'en' => 'Please review your form input and try again.'],
                ],
            ]
        );
    }
}
