# MX100 - Job Portal API

MX100 adalah RESTful API Job Portal yang menghubungkan Perusahaan (Employer) dan Freelancer. Dibangun menggunakan Laravel dengan implementasi keamanan autentikasi dan pemisahan logika bisnis.

## Persyaratan Sistem
- PHP >= 8.1
- Composer
- MySQL

## Langkah Instalasi & Konfigurasi

**1. Clone Repositori & Install**
Buka terminal dan jalankan:
* git clone [https://github.com/Joann-code/Mx100_API.git](https://github.com/Joann-code/Mx100_API.git)
* cd Mx100_API
* composer install

**2. Konfigurasi Database**
Salin file .env.example menjadi .env, lalu ubah pengaturan database :
* DB_DATABASE=kopnus_mx100
* DB_USERNAME=root
* DB_PASSWORD=

**3. Setup Keamanan & Struktur Data**
Jalankan perintah ini secara berurutan:
* php artisan key:generate
* php artisan migrate --seed
* php artisan storage:link

**4. Jalankan Server**
* php artisan serve
(Aplikasi akan berjalan di [http://127.0.0.1:8000](http://127.0.0.1:8000))

---

## Dokumentasi & Database (Terlampir di Root Folder)
Untuk memenuhi persyaratan tugas Koperasi Nusantara, berikut adalah file pendukung yang tersedia:
- kopnus_mx100.sql : Skema database dan sample data.
- Dokumentasi mx100.pdf : Panduan visual Request dan Response API.
- mx100 API.json : File untuk pengujian langsung di Postman.
