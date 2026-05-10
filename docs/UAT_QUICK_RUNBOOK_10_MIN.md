# UAT Quick Runbook (10 Menit)

## Tujuan
- Memastikan CMS 8 halaman siap demo internal tanpa regresi utama.

## Data Login Demo
- Super Admin: `superadmin@mail.com` / `admin!`
- Admin: `admin@mail.com` / `admin!`
- Editor: `editor@mail.com` / `88888888!`
- Viewer: `viewer@mail.com` / `88888888!`

## Persiapan (1 Menit)
1. Jalankan:
```bash
npm install
npm run build
php artisan migrate --seed
php artisan optimize:clear
```
2. Buka:
- Frontend: `http://127.0.0.1:8000`
- Admin: `http://127.0.0.1:8000/admin/login`
3. Quick verify:
- Jika menu header tampil bullet list default browser, berarti asset belum loaded (ulang `npm run build` atau jalankan `npm run dev`).

## Eksekusi UAT

### Menit 1-3: Validasi 8 Halaman Publik
1. Buka:
- `/`
- `/about`
- `/services`
- `/vision-mission`
- `/portfolio`
- `/training`
- `/outsourcing`
- `/contact`
2. Expected:
- Hero/title muncul normal.
- Tidak ada error page.

### Menit 3-5: Validasi Edit Konten (Admin)
1. Login `admin@mail.com`.
2. Buka `Pages`, edit `hero_title` halaman `training`, simpan.
3. Refresh `/training`.
4. Expected:
- Perubahan teks langsung terlihat di frontend.

### Menit 5-6: Validasi Edit Section Item
1. Di admin, buka `Section Items`.
2. Edit 1 item pada `training_domains` atau `benefit_cards`, simpan.
3. Refresh halaman terkait.
4. Expected:
- Konten section ter-update sesuai edit.

### Menit 6-8: Validasi Upload Media
1. Upload `logo_light` di `Site Settings`.
2. Upload `hero_background` di `Pages` (1 halaman).
3. Upload `section_images` di `Section Blocks` (1 section).
4. Expected:
- Upload sukses, preview tampil di admin.
- Frontend tetap aman bila media kosong.

### Menit 8-9: Validasi Contact Flow
1. Buka `/contact` dan submit form valid.
2. Cek `Contact Inquiries` di admin.
3. Expected:
- Inquiry tersimpan dengan status `new`.

### Menit 9-10: Validasi Role Boundary
1. Logout, login sebagai `viewer@mail.com`.
2. Coba akses resource konten.
3. Expected:
- Viewer hanya `view`.
- Tidak bisa create/update/delete.

## Kriteria Lulus UAT
- Semua 8 halaman terbuka normal.
- Edit konten admin tercermin di frontend.
- Upload media berhasil pada 3 konteks utama.
- Contact inquiry masuk dengan status `new`.
- Viewer read-only.

## Jika Ada Gagal UAT
1. Catat langkah, role, URL, dan screenshot error.
2. Jalankan:
```bash
php artisan test
```
3. Laporkan ke tim dev dengan ringkasan reproduksi singkat.
