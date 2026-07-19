# Changelog

Semua perubahan penting pada project ini dicatat dalam berkas ini.

---

## [Phase 1] — Perancangan Sistem Desain Tema & Tipografi
- **Tema Monokromatik**: Menerapkan skema warna HSL monokromatik modern (warna utama hitam `#0d0d0e` dan warna sekunder putih `#f5f5f7`).
- **Toggle Mode Gelap & Terang**: Membangun engine tema menggunakan skrip pemblokir inline agar tidak terjadi efek kedipan saat halaman dimuat (mencegah FOUC), dengan preferensi tema tersimpan di `localStorage`.
- **Animasi Ringan (Vanilla JS)**: Membuat efek teks mengetik (typing effect) dan penghitung statistik (stats counter) yang berjalan otomatis saat discroll tanpa menggunakan library eksternal.
- **Penyempurnaan Visual**: Menambahkan kustomisasi scrollbar, efek navigasi transparan blur (glassmorphism), dan tata letak jarak halaman yang rapi.

## [Phase 2] — Arsitektur Resilient Controller
- **Penyajian Data Cadangan (Mock Data)**: Mengonfigurasi controller utama agar otomatis menyajikan data array dummy terstruktur jika koneksi database belum dikonfigurasi atau skema tabel belum dimigrasi.
- **Pemulihan Error Otomatis**: Memastikan website portfolio dapat langsung diuji coba setelah instalasi awal tanpa langsung bergantung pada konfigurasi database yang rumit.

## [Phase 3] — Formulir Kontak Asinkron & Optimasi Komponen UI
- **Single-Modal Data Mapping**: Menyederhanakan detail studi kasus proyek ke dalam satu modal Bootstrap yang dipetakan secara dinamis melalui atribut data (data-attributes) JavaScript untuk mengurangi jumlah elemen DOM.
- **Formulir AJAX Kontak**: Membangun handler pengiriman formulir kontak secara asinkron lengkap dengan validasi input, animasi loading tombol, dan pop-up notifikasi toast.
- **Filter Portfolio Kategori**: Membuat efek penyaringan (filter) proyek berdasarkan kategori teknologi menggunakan animasi transisi transparan CSS yang halus.

## [Phase 4] — Optimasi SEO & Sistem Admin Panel
- **SEO & Sitemap**: Mengintegrasikan pengaturan meta tag Open Graph untuk share media sosial secara otomatis, sitemap dinamis (`sitemap.xml`), serta konfigurasi robot crawling (`robots.txt`).
- **Ekspor CSV Pesan Masuk**: Menambahkan fitur ekspor data inbox ke format CSV berbasis stream cursor database untuk meminimalkan beban memori RAM server.
- **Indeks Database**: Menambahkan indeks performa pada kolom database yang sering dicari (`status`, `published_at`, `is_read`, `event_type`, `created_at`).

## [Phase 5] — Optimasi Query & Sistem Caching Data
- **Pembersihan Query Duplikat**: Menghapus query pengaturan profil redundan di controller dengan memanfaatkan View Composer global (`SettingsComposer`).
- **Cache Pengaturan Profil**: Menerapkan cache terpadu (`settings_all`) sehingga seluruh konfigurasi website hanya memerlukan satu kali pemanggilan cache atau satu query database saja.
- **Cache Data Keahlian, Pendidikan & Tautan Sosial**: Menyimpan data yang jarang berubah ke dalam cache selama 24 jam untuk mempercepat waktu pemuatan halaman utama.
- **Invalidasi Cache Otomatis**: Mendaftarkan trigger pada event model Eloquent (`saved` dan `deleted`) agar sistem otomatis menghapus cache yang lama saat administrator memperbarui data.
- **Kesesuaian Optimasi Framework**: Memastikan seluruh konfigurasi, file route, dan file view kompatibel saat dioptimalkan menggunakan perintah `php artisan optimize`.
