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

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT). -->
# Aplikasi Pendaftaran IGD & Penempatan Kamar Inap

Aplikasi ini merupakan sistem informasi berbasis web yang dibangun dengan Laravel 12 dan Filament v3.3.14. Sistem ini mendukung manajemen pendaftaran pasien di IGD, pengelolaan kamar rawat inap, serta sistem role dan permission menggunakan Spatie.
Jika Berkenan Bisa Donate Boss Buat Ngopi Ngopi Dana : +62 838-3738-9187

## 📦 Fitur Utama

- Pendaftaran IGD (Umum / BPJS)
- Penempatan pasien ke kamar rawat inap
- Manajemen data kamar (kapasitas otomatis berkurang/bertambah)
- Riwayat pasien pulang (dengan form pasien pulang)
- Role management menggunakan Spatie:
  - Admin IGD
  - Admin Rawat Inap
- Panel Admin berbasis Filament

## 🛠️ Teknologi yang Digunakan

- Laravel 12
- Filament v3.3.14
- Laravel Breeze (auth scaffolding)
- Spatie Laravel-Permission
- TailwindCSS (via Filament)
- MySQL / MariaDB
- PHP 8.2+

## 🧾 Kebutuhan Sistem

- PHP 8.2+
- Composer
- MySQL / MariaDB
- Node.js & NPM (untuk development frontend)
- Laravel CLI

## 🚀 Instalasi

1. **Clone repositori ini**

```bash
git clone https://github.com/nama-kamu/igd-inap-app.git
cd igd-inap-app
Install dependensi PHP

bash
Salin
Edit
composer install
Install dependensi frontend

bash
Salin
Edit
npm install
npm run build
Copy file .env dan atur konfigurasi

bash
Salin
Edit
cp .env.example .env
Edit .env dan atur database:

env
Salin
Edit
DB_DATABASE=igd_inap
DB_USERNAME=root
DB_PASSWORD=
Generate key dan migrate database

bash
Salin
Edit
php artisan key:generate
php artisan migrate --seed
Seeder akan otomatis membuat:

Super Admin (email: admin@admin.com, password: password)

Admin IGD dan Admin Rawat Inap (opsional tergantung seeder)

Install panel Filament (jika belum)

bash
Salin
Edit
php artisan filament:install
Buat user baru untuk login Filament

bash
Salin
Edit
php artisan make:filament-user
Jalankan server

bash
Salin
Edit
php artisan serve
Akses: http://localhost:8000/admin

🔑 Role & Permission
Role	Akses Modul
Admin IGD	Pendaftaran IGD, lihat status kamar, kirim ke rawat inap
Admin Rawat Inap	Penempatan kamar, kelola kamar, pasien pulang

📷 Preview
(Tambahkan screenshot aplikasi di sini)

🤝 Kontribusi
Silakan pull request jika ingin menambahkan fitur baru atau memperbaiki bug.

📄 Lisensi
Proyek ini dilisensikan di bawah MIT License.# gans
