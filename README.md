<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
## Aplikasi Kelontong - Sistem Manajemen Toko Modern

![Laravel](https://img.shields.io/badge/Laravel-v10-FF2D20?style=for-the-badge&logo=laravel)
![Filament](https://img.shields.io/badge/Filament-v3-FD7E14?style=for-the-badge)

Aplikasi Kelontong adalah sistem manajemen toko modern yang dirancang khusus untuk membantu pengelolaan toko kelontong atau minimarket. Dibangun menggunakan Laravel 10 dan Filament 3, aplikasi ini menyediakan antarmuka yang mudah digunakan untuk mengelola operasional toko Anda.

## ✨ Fitur Utama

- 👥 Manajemen Pengguna dengan Sistem Role
- 🛍️ Manajemen Produk dan Kategori
- 📦 Pelacakan Stok Barang
- 💰 Proses Transaksi Penjualan
- 📊 Laporan Penjualan
- 🔑 Manajemen Token Akses
- 🔐 Sistem Autentikasi yang Aman

## 🔧 Kebutuhan Sistem

- PHP >= 8.1
- Composer
- MySQL/PostgreSQL
- Node.js & NPM

## 🚀 Cara Instalasi

1. Clone repository
```bash
git clone https://github.com/aqilamuzafa917/tokokelontong.git
cd kelontong
```

2. Install dependency PHP
```bash
composer install
```

3. Salin file environment dan atur kredensial database
```bash
cp .env.example .env
php artisan key:generate
```

4. Jalankan migration dan seeder
```bash
php artisan migrate --seed
```

5. Install dan build asset frontend
```bash
npm install
npm run build
```

6. Jalankan server development
```bash
php artisan serve
```

## 🏗️ Struktur Aplikasi

Aplikasi ini menggunakan arsitektur MVC Laravel dan memanfaatkan TALL stack dari Filament (Tailwind, Alpine.js, Laravel, dan Livewire) untuk panel admin. Struktur database meliputi:

- Manajemen pengguna
- Kategori produk
- Inventaris barang
- Transaksi dan detail transaksi
- Token akses dan autentikasi
- Pencatatan failed jobs

## 💡 Cara Penggunaan

1. Akses panel admin di `/admin`
2. Login dengan kredensial Anda
3. Kelola toko melalui menu yang tersedia:
   - Produk dan kategori
   - Akun pengguna
   - Transaksi

## 🤝 Kontribusi

Kami sangat terbuka dengan kontribusi! Silakan ikuti langkah berikut untuk berkontribusi:

1. Fork Project ini
2. Buat Branch Fitur Baru (`git checkout -b fitur/FiturBaru`)
3. Commit Perubahan (`git commit -m 'Menambahkan FiturBaru'`)
4. Push ke Branch (`git push origin fitur/FiturBaru`)
5. Buat Pull Request

## 📝 Lisensi

Proyek ini dilisensikan di bawah Lisensi MIT - lihat file [LICENSE](LICENSE) untuk detail.

## 📧 Kontak

Aqila Bintang Muzafa - aqilamuzafa@gmail.com


## 💻 Tech Stack

- [Laravel 10](https://laravel.com)
- [Filament 3](https://filamentphp.com)
- [Tailwind CSS](https://tailwindcss.com)
- [Alpine.js](https://alpinejs.dev)
- [MySQL](https://www.mysql.com)

---
Dibuat dengan ❤️ untuk kemajuan UMKM Indonesia