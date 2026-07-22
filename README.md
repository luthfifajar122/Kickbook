# Garage64

Garage64 adalah aplikasi **e-commerce diecast** berbasis **Laravel** yang dirancang untuk memudahkan pengguna dalam mencari, melihat, dan membeli berbagai koleksi diecast. Aplikasi ini menyediakan halaman katalog produk, detail produk, keranjang belanja, serta panel admin untuk mengelola produk, kategori, dan transaksi.

## Fitur

### Customer

* Landing page
* Katalog produk
* Detail produk
* Pencarian produk
* Keranjang belanja
* Checkout
* Riwayat transaksi
* Profil pengguna
* Login & Register

### Admin

* Dashboard Admin
* Manajemen Produk (Create, Read, Update, Delete)
* Manajemen Kategori
* Manajemen Transaksi
* Aktivasi / Nonaktif Produk
* Pelaporan Penjualan
* Manajemen Profil Admin

## Tech Stack

### Bahasa:

* Php 8.2
* JavaScript
* CSS

### Framework:

* Laravel 12
* Tailwind CSS 4

### Module & Library:

* Vite

---

# Instalasi:

## 1. Clone Repository

Jika menggunakan xampp:

```bash
cd xampp/htdocs
```

Linux:

```bash
cd /opt/lampp/htdocs
```

```bash
git clone https://github.com/Adityammar65/Garage64.git
cd Garage64
```

---

## 2. Install Dependency PHP

```bash
composer install
```

---

## 3. Install Dependency JavaScript

```bash
npm install
```

---

## 4. Salin File Environment

Jika menggunakan windows:

```bash
copy .env.example .env
```

Jika menggunakan linux:

```bash
cp .env.example .env
```

---

## 5. Generate Application Key

```bash
php artisan key:generate
```

---

## 6. Konfigurasi Database

Edit file `.env`

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=garage64
DB_USERNAME=root
DB_PASSWORD=
```

Jika belum ada database di phpmyadmin silahkan membuat database baru,
jika sudah ada sesuaikan dengan konfigurasi database yang digunakan.

---

## 7. Jalankan Migration

```bash
php artisan migrate --seed
```

---

## 8. Membuat Symbolic Link Storage

Digunakan agar asset dapat dimuat oleh browser.

```bash
php artisan storage:link
```

---

## 9. Copy/Move Konfigurasi Data Toko (Pilih Salah 1)

```bash
cp /public/assets/blueprints/store.json /storage/app/private/store.json
mv /public/assets/blueprints/store.json /storage/app/private/store.json
```

---

## 10. Build Asset

```bash
npm run dev
```

---

## 11. Jalankan Server

Jika menggunakan xampp akses melalui:

```
localhost/Garage64
```

Atau jika menggunakan artisan:

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```
http://127.0.0.1:8000
```

---

# Langkah Tambahan Bagi Perangkat Linux:

## Setelah Clone Repository Atur Permission dan Ownership

Jika menggunakan xampp:

```bash
cd /opt/lampp/htdocs
```

Set ownership

```bash
sudo chown -R $USER:daemon /Garage64
```

Set permission

```bash
sudo chmod -R 775 /Garage64
```

```bash
cd /Garage64
sudo chmod -R 775 storage bootstrap/cache
```

Jika menggunakan server stack lainnya silahkan menyesuaikan direktori clone

---

# Struktur Penyimpanan File

### Gambar Produk

```
storage/app/public/produk
```

### Foto Profil

```
storage/app/public/foto-profil
```

---

# Akun

Apabila project menggunakan seeder, jalankan:

```bash
php artisan db:seed
```

Kemudian login menggunakan akun yang tersedia pada seeder.

---

# Catatan

* Pastikan ekstensi PHP yang dibutuhkan Laravel telah aktif.
* Jalankan `php artisan storage:link` agar asset dapat ditampilkan.
* Jalankan `npm run dev` selama proses development.
* Pastikan konfigurasi database pada file `.env` sudah benar sebelum menjalankan migration.

---

# Contributor:

## Aditya Ammar Al Haqqi

https://github.com/Adityammar65

## Luthfi Fajar Prasetyo

https://github.com/luthfifajar122