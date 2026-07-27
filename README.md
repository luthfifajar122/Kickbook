# KickBook

KickBook adalah aplikasi booking lapangan futsal berbasis web yang dibangun menggunakan Laravel 12.

## Teknologi
- Laravel 12
- Laravel Breeze
- Blade
- Tailwind CSS
- MySQL

## Fitur
- Login & Register
- Role Admin & Customer
- Dashboard Admin
- CRUD Lapangan
- Booking Lapangan (On Progress)

## Cara Menjalankan
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed
npm install
npm run dev
php artisan serve
```