# Demo Script CMS 8 Halaman (10-15 Menit)

## Akun Demo

- Super Admin: `superadmin@mail.com` / `admin!`
- Admin: `admin@mail.com` / `admin!`
- Editor: `editor@mail.com` / `88888888!`
- Viewer: `viewer@mail.com` / `88888888!`

## Pre-flight

1. Jalankan:

```bash
php artisan migrate --seed
php artisan test
```

2. Buka:
- Frontend: `http://127.0.0.1:8000`
- Admin: `http://127.0.0.1:8000/admin/login`

## Alur Demo

1. **Buka 8 halaman publik**
- `/`
- `/about`
- `/services`
- `/vision-mission`
- `/portfolio`
- `/training`
- `/outsourcing`
- `/contact`

Validasi: hero/title tampil dari CMS (bukan hardcoded murni).

2. **Login sebagai Admin**
- Masuk ke resource `Pages`.
- Ubah `hero_title` pada 1 halaman (contoh: `training`).
- Simpan lalu refresh frontend halaman terkait.

Validasi: perubahan muncul real-time dari data CMS.

3. **Edit section item**
- Masuk `Section Items`.
- Ubah 1 item pada section `training_domains` atau `benefit_cards`.
- Simpan dan refresh halaman target.

Validasi: isi section berubah sesuai data admin.

4. **Upload media**
- `Site Settings`: upload `logo_light`.
- `Pages`: upload `hero_background` untuk 1 halaman.
- `Section Blocks`: upload `section_images`.

Validasi: upload berhasil, preview/list media muncul, frontend tetap aman saat media kosong.

5. **Contact flow**
- Submit form contact valid.
- Cek `Contact Inquiries` di admin.

Validasi: data masuk dengan status `new`.

6. **Role boundary check**
- Login sebagai `viewer@mail.com`.
- Coba akses/create/update/delete pada resource.

Validasi: viewer hanya bisa lihat data (read-only).

## Go/No-Go Kriteria Demo

- 8 halaman publik terbuka normal.
- Edit konten di admin langsung tercermin di frontend.
- Upload media berhasil di 3 konteks (`SiteSetting`, `Page`, `SectionBlock`).
- Contact inquiry tercatat.
- Viewer tidak bisa aksi non-view.
