# UI/UX Rationale: Home and About

Dokumen ini menjelaskan alasan desain UI/UX untuk halaman `Home` dan `About` pada website company profile DigiTalent berdasarkan implementasi saat ini dan arah konten dari `Draft Konten Website DigiTalent.pdf`.

## Prinsip Umum

Desain halaman `Home` dan `About` dibuat dengan beberapa prinsip utama:

1. Company profile harus terasa kredibel, rapi, dan stabil.
2. Hirarki informasi harus jelas dalam 5-10 detik pertama.
3. Warna harus konsisten dengan identitas visual DigiTalent pada logo terang.
4. Layout harus modern, tetapi tidak terasa seperti landing page produk SaaS yang terlalu agresif.
5. Setiap section harus punya fungsi komunikasi yang jelas, bukan hanya dekoratif.

## Dasar Visual

Palet utama yang dipakai:

- Biru tua `#09468a`
- Biru muda `#009adf`
- Oranye `#f3a836`

Alasan:

- Biru tua menjadi warna fondasi untuk membangun rasa profesional, terpercaya, dan korporat.
- Biru muda dipakai sebagai aksen identitas yang dekat dengan simbol dan tipografi logo DigiTalent.
- Oranye dipakai terbatas sebagai aksen penekanan agar tetap hidup tanpa mengganggu nuansa formal.

Warna turunan seperti `brand-sky` dan warna abu kebiruan dipakai untuk:

- memberi ruang napas visual,
- menjaga keterbacaan,
- dan menghindari halaman terlihat terlalu berat.

## Home

### 1. Header and Navigation

Header dibuat fixed agar navigasi selalu mudah dijangkau. Topbar dibuat muncul hanya saat posisi halaman berada di atas agar:

- informasi kontak tetap terlihat saat first impression,
- tetapi tidak mengganggu fokus saat user mulai membaca isi halaman,
- dan navbar utama tetap menjadi titik navigasi yang stabil.

Alasan UX:

- company profile biasanya dibaca secara scan cepat,
- akses cepat ke `About`, `Services`, `Contact`, dan `Training` harus tetap tersedia,
- tetapi kontak tambahan pada topbar tidak perlu terus-menerus memenuhi layar.

### 2. Hero Section

Hero dibuat dengan dua fungsi sekaligus:

- memperkenalkan positioning DigiTalent,
- dan memberi bukti visual bahwa perusahaan bergerak pada aktivitas nyata.

Elemen hero:

- badge identitas,
- headline utama,
- deskripsi singkat perusahaan,
- CTA,
- komposisi foto,
- proof panel kecil.

Alasan desain:

- Headline besar diperlukan untuk memperjelas positioning dalam satu pandangan.
- Copy dibuat ringkas agar user cepat memahami siapa DigiTalent dan apa fokusnya.
- Dua CTA dipakai untuk memisahkan kebutuhan eksplorasi layanan dan kebutuhan kontak langsung.
- Foto disusun dengan satu visual utama dan dua visual pendukung agar terasa seperti company profile, bukan galeri biasa.
- Proof panel kecil dipakai untuk merangkum `Core Services` dan `Operating Standard` tanpa membuat user harus scroll dulu.

### 3. Core Values

Section ini dibuat sebagai blok nilai perusahaan yang formal dan mudah dipindai.

Keputusan desain:

- layout desktop dibuat `3 atas + 2 bawah`,
- semua card konsisten,
- aksen garis atas digunakan sebagai identitas visual,
- teks dibuat lebih lega,
- shadow dibuat halus.

Alasan:

- lima value dalam satu baris penuh membuat kartu terlalu sempit dan melelahkan dibaca,
- pola `3 + 2` memberi ritme yang lebih seimbang,
- company values harus terasa authoritative, bukan seperti card interaktif produk digital,
- konsistensi antar kartu menghindari kesan ada card yang “terpilih”.

### 4. Progress Counter

Section angka dibuat di atas latar biru tua agar terasa sebagai blok data penting.

Keputusan desain:

- background biru tua untuk membedakan section ini dari bagian naratif,
- angka diberi warna biru muda agar kontras dan tetap sesuai brand,
- card dibuat konsisten tanpa active state,
- label kecil ditambahkan untuk mempermudah scan.

Alasan:

- data numerik lebih efektif jika dipisahkan secara visual dari narasi,
- angka adalah elemen bukti,
- karena ini company profile, tampilannya harus tenang dan kredibel, bukan seperti dashboard analitik.

### 5. Why Choose Us

Section ini dibuat sebagai argumen strategis mengapa DigiTalent layak dipilih.

Keputusan desain:

- pola visual disamakan dengan `Core Values`,
- layout menggunakan grid `3 atas + 2 bawah`,
- tidak memakai badge nomor yang dominan,
- tiap card punya judul kuat dan body copy yang jelas.

Alasan:

- sebelumnya layout long list dengan ruang kosong besar di kiri terasa longgar dan kurang efisien,
- dengan grid, section terasa lebih rapat dan profesional,
- penyamaan bahasa desain dengan `Core Values` membuat home terasa satu sistem,
- user dapat membaca alasan utama secara modular tanpa kehilangan konteks.

### 6. Next Step Section

Section ini berfungsi sebagai penutup halaman home dan jembatan ke halaman lain.

Keputusan desain:

- satu visual sederhana di kiri,
- ringkasan arah navigasi di kanan,
- CTA menuju halaman penting.

Alasan:

- setelah user memahami profil umum perusahaan, langkah berikutnya harus jelas,
- section penutup membantu mengarahkan user tanpa harus kembali ke navbar,
- visual yang lebih tenang di akhir halaman menjaga ritme penutupan tetap rapi.

### 7. Motion and Interaction

Animasi di halaman home dibuat ringan:

- hero entrance,
- reveal on scroll,
- stagger on cards,
- counter animation.

Alasan:

- motion dipakai untuk meningkatkan kualitas presentasi,
- tetapi tidak boleh mengganggu karakter company profile,
- karena itu animasi dibatasi pada opacity dan transform yang halus,
- serta tetap mendukung `prefers-reduced-motion`.

## About

### 1. Hero Section

Hero `About` dibuat lebih tenang dibanding home karena fungsinya bukan menjual perhatian, tetapi memberi konteks identitas perusahaan.

Keputusan desain:

- breadcrumb tetap ditampilkan,
- heading besar dipertahankan,
- subcopy disederhanakan agar tetap dekat dengan isi draft.

Alasan:

- user yang masuk ke halaman About biasanya sudah punya intensi membaca,
- sehingga struktur harus lebih informatif dan tidak seagresif home,
- breadcrumb membantu orientasi halaman dalam struktur website.

### 2. Main Narrative Section

Isi utama About dibagi ke tiga blok:

- `Who We Are`
- `Where We Come From`
- `Our Commitment`

Alasan:

- tiga blok ini langsung mengikuti struktur isi dari draft,
- pemisahan per blok membantu keterbacaan,
- user bisa memahami identitas, latar belakang, dan komitmen tanpa harus membaca paragraf panjang yang menyatu.

Keputusan visual:

- card putih dipakai untuk menjaga keterbacaan tinggi,
- spacing cukup lega agar narasi terasa formal,
- warna biru digunakan pada label section untuk konsistensi brand.

### 3. Sidebar Visual and Snapshot

Bagian kanan halaman About berisi:

- foto perusahaan,
- info singkat `Founded` dan `Group`,
- `Business Focus`.

Alasan:

- halaman About tidak cukup hanya berisi narasi teks,
- user perlu anchor visual dan summary facts,
- snapshot ini membantu mempercepat pemahaman tanpa mengganggu struktur utama draft.

Keputusan desain:

- foto besar menjaga dimensi human dan organisasi,
- dua info kecil memperkuat kredibilitas dasar,
- business focus mengulang dua layanan utama agar positioning tetap konsisten.

### 4. Konsistensi dengan Home

About dirancang untuk tetap terasa satu keluarga dengan Home melalui:

- warna brand yang sama,
- radius card yang serupa,
- shadow yang lembut,
- heading style yang kuat,
- layout yang bersih dan formal.

Alasan:

- user tidak boleh merasa pindah ke website lain ketika membuka halaman About,
- konsistensi visual membangun kepercayaan,
- terutama untuk company profile yang menekankan stabilitas dan profesionalisme.

## Kenapa Tidak Dibuat Terlalu Ramai

Beberapa hal sengaja dihindari:

- terlalu banyak gradient kuat,
- terlalu banyak accent color sekaligus,
- animasi berlebihan,
- card dengan gaya berbeda-beda,
- pola UI yang terlalu mirip website startup pitch deck.

Alasannya:

- DigiTalent perlu tampil sebagai perusahaan yang siap dipercaya,
- bukan sekadar brand yang terlihat modern,
- sehingga estetika diarahkan ke `professional clarity`, bukan `visual novelty`.

## Ringkasan Arah Desain

`Home` difokuskan untuk:

- menarik perhatian,
- menjelaskan positioning,
- menunjukkan bukti,
- dan mengarahkan user ke halaman lanjutan.

`About` difokuskan untuk:

- memperjelas identitas perusahaan,
- menjelaskan latar belakang,
- dan menegaskan komitmen DigiTalent sesuai isi draft.

Dengan pendekatan ini, kedua halaman saling melengkapi:

- `Home` sebagai pintu masuk dan presentasi utama,
- `About` sebagai halaman validasi identitas perusahaan.
