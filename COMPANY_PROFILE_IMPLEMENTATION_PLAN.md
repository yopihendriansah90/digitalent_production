# Rancangan Web Company Profile DigiTalent

Dokumen ini merangkum rancangan implementasi website company profile DigiTalent berdasarkan aset dan template di folder `template`, dengan stack:

- Laravel 12
- Filament 4 (Admin Panel)
- Spatie Media Library (Manajemen file)
- Filament Shield (Role & Permission)

## 1. Tujuan Proyek

Membangun website company profile yang:

- menampilkan halaman publik profesional dan konsisten dengan template UI yang sudah ada,
- memiliki admin panel untuk kelola konten tanpa edit kode,
- memiliki manajemen media terstruktur (logo, dokumentasi training, ikon, dsb),
- memiliki role & permission agar proses update konten aman dan terkontrol.

## 2. Scope Halaman Publik

Rancangan halaman mengikuti struktur template yang sudah tersedia:

1. Home
2. About Us
3. Services
4. Vision & Mission
5. Client / Portfolio
6. Training
7. Outsourcing
8. Contact

## 3. Arsitektur Frontend (Laravel Blade)

### 3.1 Struktur Blade

- `resources/views/layouts/app.blade.php`
  - Layout utama (`<head>`, font, asset CSS/JS, meta default)
- `resources/views/partials/header.blade.php`
  - Navbar desktop/mobile, active menu, CTA
- `resources/views/partials/footer.blade.php`
  - Footer global, kontak, social, floating WhatsApp
- `resources/views/pages/*.blade.php`
  - Satu file per halaman publik sesuai scope

### 3.2 Routing

Gunakan route named agar aman dan mudah dipakai di Blade:

- `/` -> `home`
- `/about` -> `about`
- `/services` -> `services`
- `/vision-mission` -> `vision-mission`
- `/portfolio` -> `portfolio`
- `/training` -> `training`
- `/outsourcing` -> `outsourcing`
- `/contact` -> `contact`

### 3.3 Tailwind & Asset

- Migrasi dari CDN Tailwind ke setup Laravel (Vite + Tailwind) agar production-ready.
- Definisikan warna brand satu kali di `tailwind.config.js`:
  - `#09468a` (brand navy)
  - `#009adf` (brand blue)
  - `#f3a836` (brand orange)
  - turunan sky/cyan/ink sesuai template
- Rapikan class typo dari template (contoh `text-slate-600mt-4` -> `text-slate-600 mt-4`).

## 4. Arsitektur Konten (CMS-Ready)

Agar konten bisa dikelola via Filament, konten dibagi menjadi beberapa entitas:

### 4.1 Site Settings

Untuk data global website:

- nama perusahaan
- tagline
- email, telepon, WhatsApp
- alamat
- link social media
- copyright footer
- koordinat / embed map

### 4.2 Pages

Untuk konten per halaman statis:

- judul halaman
- slug
- hero title/subtitle
- hero highlights/summary
- status publish
- SEO metadata (meta title, meta description)

### 4.3 Section Blocks

Untuk section berulang yang fleksibel per halaman:

- page_id
- section_key (mis: `core_values`, `why_choose_us`, `training_domains`)
- section_title
- section_description
- order_index
- is_active

### 4.4 Items (Card/List)

Untuk item di dalam section:

- section_block_id
- title
- description
- badge/label
- order_index
- extra (JSON untuk field opsional)

### 4.5 Contact Inquiries

Untuk data masuk dari form kontak publik:

- nama
- email
- jenis layanan
- pesan
- status (new/read/replied)
- assigned_to (opsional)

## 5. Manajemen Media dengan Spatie Media Library

### 5.1 Koleksi Media yang Direkomendasikan

Pada tiap model, gunakan media collections yang jelas. Contoh:

- `site_settings`
  - `logo_light`
  - `logo_dark`
  - `favicon`
- `pages`
  - `hero_background`
  - `hero_images`
- `section_blocks`
  - `section_images`
  - `section_icons`
- `portfolio_entries` (jika dipisah model)
  - `client_logos`
  - `training_gallery`

### 5.2 Konversi Media

Gunakan conversion untuk optimasi:

- `thumb` (admin list)
- `web` (frontend standard)
- `webp` optional untuk performa

### 5.3 Aturan File

- Validasi tipe file (jpg/png/webp/svg sesuai kebutuhan)
- Batas ukuran upload
- Penamaan file konsisten dan folder terstruktur per collection

## 6. Admin Panel dengan Filament 4

### 6.1 Resource Utama

Buat Filament Resources untuk:

1. `SiteSettingResource`
2. `PageResource`
3. `SectionBlockResource`
4. `SectionItemResource`
5. `ContactInquiryResource`
6. (Opsional) `PortfolioEntryResource` untuk galeri/portfolio lebih dinamis

### 6.2 Dashboard Widget

Widget yang disarankan:

- jumlah inquiry baru
- jumlah konten draft vs publish
- statistik upload media

### 6.3 UX Admin

- form dengan tabs/sections per konteks
- repeater untuk item berulang
- toggle publish aktif/nonaktif
- reorderable untuk urutan section dan card

## 7. Role & Permission dengan Filament Shield

Gunakan Filament Shield untuk generate permission policy otomatis berdasarkan Resource.

### 7.1 Role yang Disarankan

1. `Super Admin`
  - full akses semua modul dan konfigurasi
2. `Content Admin`
  - kelola semua konten halaman + media + inquiry
3. `Editor`
  - edit konten tertentu, tanpa akses pengaturan sensitif
4. `Viewer` (opsional)
  - read-only untuk audit/monitoring

### 7.2 Permission Scope

- resource-level: view, create, update, delete
- page-level: access dashboard/settings tertentu
- media-level: upload/delete file
- inquiry-level: ubah status inquiry

## 8. Mapping Template -> Modul CMS

Berdasarkan template saat ini:

- Header/Footer: jadikan partial Blade, datanya dari `Site Settings`
- Home:
  - hero, core values, progress counter, why choose us, CTA
- About:
  - who we are, where we come from, commitment, snapshot
- Services:
  - IT Training blocks + IT Outsourcing blocks
- Vision & Mission:
  - vision text + mission list
- Portfolio:
  - client logos + training gallery per tahun
- Training:
  - domain cards
- Outsourcing:
  - talent profile cards + benefit cards
- Contact:
  - info kontak + form inquiry

## 9. Struktur Direktori yang Disarankan

- `app/Models`
  - `SiteSetting.php`
  - `Page.php`
  - `SectionBlock.php`
  - `SectionItem.php`
  - `ContactInquiry.php`
- `app/Filament/Resources`
  - resource sesuai daftar di atas
- `resources/views`
  - `layouts/app.blade.php`
  - `partials/header.blade.php`
  - `partials/footer.blade.php`
  - `pages/*.blade.php`
- `database/migrations`
  - migration tiap model
- `routes/web.php`
  - route halaman publik

## 10. Tahap Implementasi (Roadmap)

1. Setup foundation project (Tailwind, layout Blade, route publik)
2. Migrasi template HTML ke Blade per halaman
3. Setup model + migration + relasi konten
4. Integrasi Spatie Media Library pada model terkait
5. Bangun Filament 4 resources + form/table
6. Integrasi Filament Shield + role permission
7. Integrasi Contact Form -> Contact Inquiry
8. QA UI responsif + validasi data + hardening permission
9. Optimasi performa asset (image conversion, caching)
10. UAT dan final content population

## 11. Risiko Teknis yang Perlu Diwaspadai

- Repetisi style inline dari template perlu dipusatkan agar maintainable.
- Beberapa class typo di template dapat menyebabkan tampilan tidak konsisten.
- Jika semua section dipaksa terlalu dinamis sejak awal, kompleksitas admin akan naik.
- SVG/logo client dari banyak sumber perlu standarisasi ukuran/rasio agar carousel rapi.

## 12. Rekomendasi Eksekusi

Untuk fase awal, gunakan pendekatan hybrid:

- **Phase 1:** stabilisasi Blade sesuai tampilan template (pixel-approximate)
- **Phase 2:** buka editing konten inti via Filament
- **Phase 3:** perluas fleksibilitas block system jika kebutuhan bisnis bertambah

Dengan pendekatan ini, website bisa cepat go-live tanpa mengorbankan pondasi CMS jangka panjang.
