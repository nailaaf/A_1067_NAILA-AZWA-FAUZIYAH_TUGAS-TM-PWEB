<!-- <p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

In addition, [Laracasts](https://laracasts.com) contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

You can also watch bite-sized lessons with real-world projects on [Laravel Learn](https://laravel.com/learn), where you will be guided through building a Laravel application from scratch while learning PHP fundamentals.

## Agentic Development

Laravel's predictable structure and conventions make it ideal for AI coding agents like Claude Code, Cursor, and GitHub Copilot. Install [Laravel Boost](https://laravel.com/docs/ai) to supercharge your AI workflow:

```bash
composer require laravel/boost --dev

php artisan boost:install
```

Boost provides your agent 15+ tools and skills that help agents build Laravel applications while following best practices.

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->

# 🍰 CAKEYS - Sistem Pemesanan Kue Custom Berbasis Website

![PHP](https://img.shields.io/badge/PHP-8.2%2B-777BB4?style=for-the-badge&logo=php&logoColor=white)
![Laravel](https://img.shields.io/badge/Laravel-11-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-Semantic-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black)
![MySQL](https://img.shields.io/badge/MySQL-Ready-4479A1?style=for-the-badge&logo=mysql&logoColor=white)

**CAKEYS** adalah sebuah sistem informasi berbasis website yang dirancang khusus untuk memanajemen pemesanan custom cake. Sistem ini dibangun untuk mengatasi permasalahan pendataan manual dan memberikan solusi digital yang efisien, responsif, dan aman bagi pemilik usaha maupun pelanggan. 

Website ini dikembangkan untuk memenuhi syarat unjuk kerja pada Ujian Akhir Semester (UAS) mata kuliah Pemrograman Berbasis Web.

**Dibuat oleh:** Naila Azwa Fauziyah (NIM: 242410101067)  
**Program Studi:** Sistem Informasi  
**Fakultas:** Fakultas Ilmu Komputer, Universitas Jember  
**Website:** [cakeys-production.up.railway.app](https://cakeys-production.up.railway.app/)  
**Video Demo:** [Demo Projek Akhir : di Youtube](https://youtu.be/OPGKjxXhY6Q)

---

## 📑 Daftar Isi

- [Fitur Utama](#-fitur-utama)
- [Keunggulan Sistem](#-keunggulan-sistem)
- [Struktur Database](#-struktur-database)
- [Persyaratan Sistem](#-persyaratan-sistem)
- [Panduan Instalasi & Menjalankan Website](#-panduan-instalasi--menjalankan-website)
- [Akun Akses Default](#-akun-akses-default-demo)
- [Alur Penggunaan Aplikasi](#-alur-penggunaan-aplikasi)

---

## ✨ Fitur Utama

Sistem ini membagi hak akses pengguna menjadi dua kelompok utama, yaitu Customer (pelanggan) dan Owner (pengelola/pemilik usaha):

### 👤 Untuk Pelanggan (Customer)
* **Akses Tanpa Akun:** Pelanggan bisa langsung berbelanja tanpa harus membuat akun (login).
* **Katalog & Live Search:** Fitur pencarian produk menggunakan AJAX sehingga ketika pelanggan mengetik nama produk, hasilnya langsung muncul tanpa perlu loading ulang.
* **Checkout & Pesanan:** Formulir untuk memproses pesanan dan otomatis membuat Nomor Pesanan (Resi).
* **Pelacakan Pesanan:** Fitur pengecekan resi pesanan secara asinkronus menggunakan Fetch API (AJAX) untuk mencari status pesanan.
* **Preferensi Tampilan:** Opsi untuk menyesuaikan ukuran font dan mengubah tampilan menjadi Dark Mode atau Light Mode. Pilihan ini disimpan menggunakan teknologi cookies di browser.
* **Widget Cuaca Real-time:** Menampilkan informasi cuaca kota Jember menggunakan layanan API publik gratis dari wttr.in.

### 👑 Untuk Administrator (Owner)
* **Keamanan Autentikasi:** Sistem login dan registrasi yang diamankan dengan session agar tidak bisa diakses sembarang orang.
* **Dashboard Statistik:** Pusat ringkasan bisnis yang menampilkan total pendapatan, jumlah pesanan selesai, dan pesanan menunggu pembayaran.
* **Manajemen Produk (CRUD):** Fitur untuk mengunggah kue baru, mengedit harga/stok, dan menghapus data kue.
* **Manajemen Pesanan:** Halaman untuk mengelola seluruh transaksi yang masuk dan mengubah status pesanan pelanggan.
* **Laporan Penjualan:** Laporan rekapitulasi penjualan yang dapat difilter berdasarkan rentang tanggal tertentu.

---

## 🎯 Keunggulan Sistem

Website CAKEYS dikembangkan menggunakan pendekatan Full-Stack Web Development dengan teknologi modern:
* **HTML5 Semantik:** Digunakan untuk membuat struktur elemen yang rapi seperti menyusun kartu katalog kue.
* **Komunikasi Asinkronus (AJAX):** Menggunakan Fetch API untuk mengambil data dari database secara asinkronus saat pelanggan mencari produk atau mengecek status pesanan.
* **Sistem Template Dinamis:** Menggunakan Blade Template bawaan Laravel agar visual situs lebih modular.
* **Integrasi API Eksternal:** Proses pengambilan data cuaca dieksekusi secara asinkronus menggunakan metode async/await pada JavaScript.

---

## 🗄️ Struktur Database

Database sistem ini menggunakan MySQL relasional dengan tabel-tabel utama yang saling berelasi:
* **`users`**: Berfungsi untuk menyimpan data autentikasi dan informasi identitas administrator sistem atau Owner.
* **`produks`**: Bertindak sebagai master data untuk menyimpan informasi detail katalog kue CAKEYS.
* **`pesanans`**: Dirancang untuk mencatat data transaksi pemesanan utama yang dilakukan oleh pelanggan.
* **`detail_pesanans`**: Berfungsi untuk menyimpan rincian spesifik dari setiap keranjang belanja.
* **`toppings` & `produk_topping`**: Tabel master dan tabel pivot untuk memetakan kombinasi topping dengan relasi Many-to-Many.
* **`sessions`**: Digunakan untuk mengelola riwayat sesi akses pengguna pada website guna menjaga keamanan autentikasi.

---

## 🚀 Panduan Instalasi & Menjalankan Website

Ikuti langkah-langkah di bawah ini untuk menjalankan **CAKEYS** di komputer/laptop Anda secara lokal.

### 1. Persyaratan Sistem
Pastikan Anda sudah menginstal perangkat lunak berikut:
* **PHP** (Minimal versi 8.2)
* **Composer** (Untuk manajemen library PHP/Laravel)
* **Node.js & NPM** (Jika diperlukan untuk compile asset)
* **XAMPP / Laragon** (Sebagai local web server dan MySQL database)
* **Git** (Untuk cloning repositori)

### 2. Kloning Repositori
Buka Terminal / Command Prompt, lalu jalankan perintah berikut:
```bash
git clone <URL_REPOSITORI_GITHUB_ANDA>
cd cakeys

```

### 3. Instalasi Dependensi

Unduh seluruh paket library yang dibutuhkan oleh aplikasi:

```bash
composer install
npm install

```

### 4. Konfigurasi Lingkungan (.env)

Salin file pengaturan lingkungan bawaan menjadi file utama:

```bash
cp .env.example .env

```

Buka file `.env` dan sesuaikan pengaturan database Anda:

```env
APP_TIMEZONE=Asia/Jakarta

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=cakeys_db
DB_USERNAME=root
DB_PASSWORD=

```

*(Biarkan DB_PASSWORD kosong jika menggunakan XAMPP bawaan).*

### 5. Generate Application Key

Jalankan perintah berikut untuk mengamankan session dan enkripsi:

```bash
php artisan key:generate

```

### 6. Migrasi Database dan Storage

Pastikan service MySQL Anda sudah berjalan, lalu buat database kosong bernama `cakeys_db` di phpMyAdmin. Setelah itu, jalankan:

```bash
php artisan migrate --seed
php artisan storage:link

```

*(Catatan: `storage:link` wajib dijalankan agar gambar katalog kue dapat tampil).*

### 7. Jalankan Server Lokal

Jalankan perintah ini di terminal untuk menyalakan server Laravel:

```bash
php artisan serve

```

Aplikasi dapat diakses melalui browser di alamat: 👉 **http://127.0.0.1:8000**

---

## 🔐 Akun Akses Default (Demo)

Sistem telah dilengkapi dengan data *dummy* melalui proses *Seeder*. Gunakan kredensial berikut untuk masuk ke dasbor Owner:

| Peran (Role) | Email | Password |
| --- | --- | --- |
| **Administrator (Owner)** | `nailaazwaf@gmail.com` | `naila1234` |

---

## 🧪 Alur Penggunaan Aplikasi

### Alur Customer

1. Buka halaman utama CAKEYS.
2. Atur preferensi tema (Dark/Light mode) atau ukuran font sesuai kenyamanan.
3. Eksplorasi katalog kue atau cari produk spesifik menggunakan *Live Search*.
4. Buka detail produk, tentukan *topping* tambahan, dan masukkan ke Keranjang.
5. Isi formulir *checkout* (Nama, Alamat, Tanggal Pengiriman).
6. Simpan **Nomor Resi** yang diberikan sistem secara otomatis.
7. Gunakan Nomor Resi pada halaman "Cek Pesanan" untuk melacak status proses kue Anda.

### Alur Owner

1. Login ke sistem melalui `/login`.
2. Tinjau statistik pendapatan dan pesanan baru di halaman Dashboard.
3. Kelola katalog produk pada menu **Produk** (menambah varian baru, mengedit harga, atau mengatur stok).
4. Buka menu **Pesanan** untuk memverifikasi pesanan masuk dan memperbarui status pesanan pelanggan (Menunggu Pembayaran ➔ Diproses ➔ Selesai).
5. Unduh atau tinjau rekapitulasi penjualan bulanan melalui menu **Laporan**.

---

<!-- *CAKEYS - Create Your Own Cake.* 🍰 -->

*© 2026 Cakeys | Naila's Project*

<!-- ```</URL_REPOSITORI_GITHUB_ANDA>

``` -->
