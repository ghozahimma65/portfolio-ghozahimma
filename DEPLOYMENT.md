# Panduan Deploy Produksi

Panduan ini berisi langkah-langkah untuk melakukan deploy website portfolio ke server Linux (seperti Ubuntu 22.04 LTS atau 24.04 LTS) pada lingkungan produksi.

---

## 1. Kebutuhan Sistem

Pastikan server Anda sudah terinstall komponen-komponen minimum berikut:

- **Sistem Operasi**: Linux (Ubuntu, Debian, atau sejenisnya)
- **Web Server**: Nginx atau Apache
- **Versi PHP**: `^8.2` (dengan ekstensi PHP yang wajib aktif: `bcmath`, `ctype`, `curl`, `dom`, `fileinfo`, `filter`, `hash`, `mbstring`, `openssl`, `pcre`, `pdo_mysql`, `session`, `tokenizer`, `xml`, `xmlwriter`)
- **Database**: MySQL `^8.0` atau MariaDB `^10.5` (bisa juga memakai SQLite `^3.35`)
- **Composer**: `^2.6`
- **Node.js & NPM**: Node `^18.x` / NPM `^10.x` (hanya digunakan untuk proses compile aset frontend)

---

## 2. Instalasi & Konfigurasi Server

### Langkah 1: Install Paket Dependensi OS
Lakukan pembaruan sistem dan install PHP, MySQL, Nginx, serta library tambahan yang dibutuhkan Laravel:
```bash
sudo apt update && sudo apt upgrade -y
sudo apt install -y git unzip curl nginx mysql-server \
    php-fpm php-cli php-mysql php-mbstring php-xml php-bcmath php-curl php-zip
```

### Langkah 2: Clone Repository Project
Clone codebase project ini ke direktori web server Anda (misalnya di `/var/www/portfolio`):
```bash
cd /var/www
sudo git clone https://github.com/ghozahimma65/portfolio.git portfolio
sudo chown -R $USER:$USER /var/www/portfolio
cd portfolio
```

### Langkah 3: Install Dependensi Project & Build Aset
Jalankan Composer untuk menginstall dependensi backend, lalu gunakan NPM untuk mengompilasi file CSS/JS frontend:
```bash
# Install package PHP khusus produksi (tanpa package development)
composer install --no-dev --optimize-autoloader

# Install package Node modules & compile aset produksi
npm install
npm run build
```

---

## 3. Konfigurasi Environment & Laravel

### Langkah 1: Konfigurasi File .env
Salin file `.env.example` ke `.env` untuk membuat konfigurasi baru:
```bash
cp .env.example .env
```
Buka file `.env` menggunakan editor teks (misalnya `nano .env`) dan sesuaikan parameter berikut untuk tahap produksi:
```env
APP_NAME="Portfolio CMS"
APP_ENV=production
APP_DEBUG=false
APP_URL=https://domainanda.com

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_db_produksi
DB_USERNAME=user_db_anda
DB_PASSWORD=password_db_anda

SESSION_DRIVER=database
CACHE_STORE=database
```

Setelah file `.env` disimpan, generate application key baru yang aman untuk enkripsi session:
```bash
php artisan key:generate --force
```

### Langkah 2: Migrasi & Seed Database
Pastikan Anda sudah membuat database kosong di server MySQL Anda terlebih dahulu, kemudian jalankan migrasi tabel dan pengisian data seed profil portfolio:
```bash
php artisan migrate --force --seed
```

### Langkah 3: Buat Symbolic Link Direktori Storage
Buat symlink dari folder `public/storage` ke `storage/app/public` agar semua gambar proyek, sertifikat, atau resume PDF yang diunggah dari dashboard CMS dapat diakses secara publik oleh browser:
```bash
php artisan storage:link
```

---

## 4. Optimasi Sisi Server (Produksi)

Jalankan perintah cache bawaan Laravel untuk meningkatkan performa pembacaan konfigurasi, route, view, dan event listener di server:
```bash
# Membuat cache konfigurasi, route, dan view
php artisan optimize

# Membuat cache untuk event listener
php artisan event:cache
```

*Catatan: Setiap kali Anda melakukan perubahan pada konfigurasi file `.env` atau mengubah rute file di `routes/web.php`, pastikan untuk menjalankan kembali perintah `php artisan optimize` agar cache diperbarui.*

---

## 5. Konfigurasi Web Server (Nginx)

Berikut adalah contoh blok konfigurasi server Nginx yang direkomendasikan untuk project ini. Simpan konfigurasi ini pada file konfigurasi Nginx Anda (misalnya di `/etc/nginx/sites-available/portfolio`):
```nginx
server {
    listen 80;
    listen [::]:80;
    server_name domainanda.com www.domainanda.com;
    root /var/www/portfolio/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";
    add_header Referrer-Policy "strict-origin-when-cross-origin";

    index index.php;

    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```
Aktifkan konfigurasi Nginx tersebut dan muat ulang service web server Anda:
```bash
sudo ln -s /etc/nginx/sites-available/portfolio /etc/nginx/sites-enabled/
sudo nginx -t
sudo systemctl reload nginx
```

---

## 6. Pengaturan Hak Akses Direktori (Permissions)

Berikan hak akses kepemilikan dan perizinan menulis (write permissions) untuk direktori `storage` dan `bootstrap/cache` kepada user web server (biasanya secara default adalah `www-data` di Ubuntu):
```bash
sudo chown -R www-data:www-data /var/www/portfolio/storage /var/www/portfolio/bootstrap/cache
sudo chmod -R 775 /var/www/portfolio/storage /var/www/portfolio/bootstrap/cache
```
