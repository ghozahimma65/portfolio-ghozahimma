# Portfolio CMS

## Tentang Project

Project ini adalah website portfolio pribadi sekaligus Content Management System (CMS) minimalis berbasis web. Saya merancang sistem ini untuk mempermudah pengelolaan data portfolio seperti proyek, riwayat pekerjaan, pendidikan, sertifikat, keahlian, dan pesan masuk (inbox) langsung dari satu dashboard admin. Website portfolio ini berfokus pada performa optimal, optimasi SEO, keamanan data, dan desain visual monokromatik modern yang bersih agar nyaman dibaca oleh recruiter atau calon klien.

---

## Fitur

- **Theme Engine Mandiri**: Mendukung mode gelap (dark mode) dan mode terang (light mode) yang otomatis tersimpan di `localStorage`. Saya menggunakan skrip pemblokir inline di bagian atas layout agar tidak terjadi efek kedipan (theme flickering) saat halaman dimuat.
- **Arsitektur Resilient Controller**: Website tetap berjalan normal meskipun database belum dikonfigurasi atau belum dimigrasi (plug-and-play). Sistem secara otomatis mendeteksi kondisi tersebut dan beralih menyajikan data dummy terstruktur yang tersimpan di controller.
- **Manajemen Dashboard CMS**: Dashboard interaktif untuk melacak statistik pengunjung, unduhan CV, data inbox, dan performa proyek terpopuler secara real-time.
- **Kategori Filter Proyek Interaktif**: Halaman depan dilengkapi penyaringan proyek berbasis kategori (seperti Laravel, Flutter, MySQL, ESP32) dengan transisi visual scale-fade yang mulus.
- **Mapping Detail Proyek Single-Modal**: Informasi detail studi kasus proyek (masalah, solusi, dan hasil) dimuat secara dinamis ke dalam satu modal Bootstrap menggunakan Vanilla JS data-attributes untuk meminimalkan beban rendering DOM.
- **Formulir Kontak Asinkron**: Pengiriman pesan kontak menggunakan AJAX dengan validasi input, status loading visual, dan pemberitahuan pop-up toast animasi.
- **Export Data Aman**: Ekspor data pesan masuk ke format CSV menggunakan database cursor untuk menjaga penggunaan memori server tetap efisien.
- **Optimasi Performa & Cache**: Mengurangi query database dengan menyatukan pengambilan pengaturan (settings) ke dalam satu query cache terpadu, serta menerapkan cache 24 jam untuk keahlian, pendidikan, dan tautan sosial. Cache otomatis dibersihkan saat administrator melakukan perubahan data.
- **Optimasi SEO Terintegrasi**: Dilengkapi meta tag Open Graph dinamis, pembuatan peta situs otomatis (`sitemap.xml`), dan aturan perayapan (`robots.txt`).

---

## Teknologi yang Digunakan

- **Framework**: Laravel 12
- **PHP**: PHP 8.2
- **Database**: SQLite (default lokal) / MySQL (produksi)
- **CSS Framework**: Bootstrap 5 (Monochromatic Custom HSL)
- **Interaksi**: Vanilla JavaScript
- **Templating**: Blade Engine

---

## Tampilan Aplikasi

*(Screenshot halaman aplikasi akan ditambahkan di bagian ini)*
- **Halaman Utama Portfolio (Mode Gelap & Terang)**
- **Detail Modal Studi Kasus Proyek**
- **Dashboard CMS Admin Panel**

---

## Cara Instalasi

Ikuti langkah-langkah di bawah ini untuk menjalankan project di komputer lokal Anda:

### 1. Clone Project
```bash
git clone https://github.com/ghozahimma65/portfolio.git
cd portfolio
```

### 2. Install Dependensi PHP
```bash
composer install
```

### 3. Install Dependensi Frontend (Node.js & NPM)
```bash
npm install
```

### 4. Setup File Environment
Salin template konfigurasi `.env`:
```bash
cp .env.example .env
```
Generate key aplikasi baru:
```bash
php artisan key:generate
```

### 5. Setup Database & Seeding
Secara default, project ini dikonfigurasi menggunakan **SQLite** agar bisa langsung digunakan tanpa instalasi server database. Jalankan perintah berikut untuk membuat file database kosong, melakukan migrasi skema tabel, dan mengisi data awal (seeding):
```bash
# Untuk Windows (PowerShell)
New-Item -ItemType File -Path database\database.sqlite -Force

# Untuk Linux / macOS
touch database/database.sqlite

# Migrasi dan seeding database
php artisan migrate --seed
```

### 6. Hubungkan Direktori Storage
Buat symbolic link agar file yang diunggah ke storage (seperti file PDF resume atau gambar proyek) dapat diakses publik dari web server:
```bash
php artisan storage:link
```

### 7. Compile Aset Frontend & Jalankan Server
Kompilasi aset frontend menggunakan Vite:
```bash
npm run build
```
Jalankan server pengembangan Laravel:
```bash
php artisan serve
```
Buka peramban (browser) Anda dan akses alamat [http://127.0.0.1:8000](http://127.0.0.1:8000).

---

## Konfigurasi

Jika Anda ingin beralih ke database **MySQL** untuk tahap produksi, silakan ubah konfigurasi koneksi database di file `.env` Anda:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=portfolio_ghozahimma
DB_USERNAME=username_mysql_anda
DB_PASSWORD=password_mysql_anda
```
Setelah mengubah konfigurasi, Anda perlu membuat database tersebut di server MySQL Anda terlebih dahulu sebelum menjalankan kembali perintah migrasi:
```bash
php artisan migrate:fresh --seed
```

---

## Akun Administrator

Seeder database akan membuat satu akun admin default secara otomatis untuk masuk ke halaman login CMS di `/admin/login`:

- **Email**: `admin@admin.com`
- **Password**: `password`

*Penting: Ganti email dan password admin default ini melalui menu pengaturan di panel admin segera setelah Anda berhasil login.*

---

## Struktur Folder

Berikut adalah direktori utama yang sering diubah selama pengembangan:
```bash
app/
 ├── Http/Controllers/        # Logic website publik dan dashboard admin
 ├── Models/                  # Model Eloquent database (Setting, Project, Skill, dll)
 └── View/Composers/          # Provider pengiriman data konfigurasi global ke view
database/
 ├── migrations/              # Definisi tabel database dan indeks optimasi query
 └── seeders/                 # Pengisian data awal profile portfolio dan akun admin
resources/
 ├── css/                     # File style CSS kustom monokromatik
 ├── js/                      # Script interaktif (efek ketik, AJAX, filter kategori)
 └── views/
      ├── admin/              # Tampilan menu pengelolaan CMS
      ├── layouts/            # Template master pembungkus halaman utama
      └── sections/           # Bagian-bagian modular halaman portfolio (hero, about, dll)
```

---

## Pengembangan Selanjutnya

Rencana pengembangan fitur berikutnya untuk project ini meliputi:
- **Lokalisasi Bahasa**: Dukungan multi-bahasa terintegrasi (Bahasa Indonesia & Inggris).
- **Visualisasi Analytics**: Grafik performa log kunjungan di dashboard admin menggunakan chart library ringan.
- **Media Optimizer**: Kompresi otomatis gambar ke format WebP saat file diunggah.
- **Sistem Komentar Artikel**: Penambahan fitur komentar terkurasi pada bagian blog post.

---

## Lisensi

Project ini dirilis di bawah lisensi MIT. Silakan lihat berkas `LICENSE` untuk detail lisensi selengkapnya.
