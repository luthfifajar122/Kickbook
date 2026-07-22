<?php

namespace Database\Seeders;

use App\Models\ProdukModel;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    public function run(): void
    {
        $produk = [

            // JDM (2)
            [
                'kode_produk' => 'PRD001',
                'id_kategori' => 2,
                'nama_produk' => 'Nissan Skyline GT-R R34',
                'brand' => 'Hot Wheels',
                'skala' => '1:64',
                'deskripsi' => 'Diecast Nissan Skyline GT-R R34 dengan detail premium.',
                'gambar' => 'produk/TEST-PRODUCT-1.jpg',
                'harga' => 79000,
                'stok' => 20,
                'is_active' => true,
            ],

            [
                'kode_produk' => 'PRD002',
                'id_kategori' => 2,
                'nama_produk' => 'Toyota Supra MK4',
                'brand' => 'Mini GT',
                'skala' => '1:64',
                'deskripsi' => 'Toyota Supra MK4 koleksi Mini GT.',
                'gambar' => 'produk/TEST-PRODUCT-2.jpg',
                'harga' => 189000,
                'stok' => 15,
                'is_active' => true,
            ],

            // Race Car (1)
            [
                'kode_produk' => 'PRD003',
                'id_kategori' => 1,
                'nama_produk' => 'Porsche 911 RSR',
                'brand' => 'Tarmac Works',
                'skala' => '1:64',
                'deskripsi' => 'Mobil balap Porsche 911 RSR edisi Le Mans.',
                'gambar' => 'produk/TEST-PRODUCT-3.jpg',
                'harga' => 229000,
                'stok' => 10,
                'is_active' => true,
            ],

            // Classic & Vintage (3)
            [
                'kode_produk' => 'PRD004',
                'id_kategori' => 3,
                'nama_produk' => 'Volkswagen Beetle',
                'brand' => 'Matchbox',
                'skala' => '1:64',
                'deskripsi' => 'Volkswagen Beetle klasik.',
                'gambar' => 'produk/TEST-PRODUCT-4.jpg',
                'harga' => 69000,
                'stok' => 18,
                'is_active' => true,
            ],

            // Supercar (4)
            [
                'kode_produk' => 'PRD005',
                'id_kategori' => 4,
                'nama_produk' => 'Lamborghini Aventador SVJ',
                'brand' => 'Mini GT',
                'skala' => '1:64',
                'deskripsi' => 'Lamborghini Aventador SVJ dengan detail tinggi.',
                'gambar' => 'produk/TEST-PRODUCT-5.jpg',
                'harga' => 215000,
                'stok' => 12,
                'is_active' => true,
            ],

            [
                'kode_produk' => 'PRD006',
                'id_kategori' => 4,
                'nama_produk' => 'Ferrari F40',
                'brand' => 'Tomica',
                'skala' => '1:64',
                'deskripsi' => 'Ferrari F40 salah satu supercar legendaris.',
                'gambar' => 'produk/TEST-PRODUCT-6.jpg',
                'harga' => 99000,
                'stok' => 14,
                'is_active' => true,
            ],

            // Muscle Car (5)
            [
                'kode_produk' => 'PRD007',
                'id_kategori' => 5,
                'nama_produk' => 'Ford Mustang GT',
                'brand' => 'Hot Wheels',
                'skala' => '1:64',
                'deskripsi' => 'Ford Mustang GT American Muscle.',
                'gambar' => 'produk/TEST-PRODUCT-7.jpg',
                'harga' => 85000,
                'stok' => 17,
                'is_active' => true,
            ],

            // Off-Road (6)
            [
                'kode_produk' => 'PRD008',
                'id_kategori' => 6,
                'nama_produk' => 'Jeep Wrangler Rubicon',
                'brand' => 'Matchbox',
                'skala' => '1:64',
                'deskripsi' => 'Jeep Wrangler Rubicon untuk medan off-road.',
                'gambar' => 'produk/TEST-PRODUCT-8.jpg',
                'harga' => 79000,
                'stok' => 11,
                'is_active' => true,
            ],

            // Movie & Pop Culture (9)
            [
                'kode_produk' => 'PRD009',
                'id_kategori' => 9,
                'nama_produk' => 'Batmobile',
                'brand' => 'Hot Wheels',
                'skala' => '1:64',
                'deskripsi' => 'Batmobile dari film Batman.',
                'gambar' => 'produk/TEST-PRODUCT-9.jpg',
                'harga' => 89000,
                'stok' => 9,
                'is_active' => true,
            ],

            // Limited Edition (12)
            [
                'kode_produk' => 'PRD010',
                'id_kategori' => 12,
                'nama_produk' => 'Nissan GT-R R35 Nismo Special Edition',
                'brand' => 'Inno64',
                'skala' => '1:64',
                'deskripsi' => 'Diecast edisi terbatas Nissan GT-R R35 Nismo.',
                'gambar' => 'produk/TEST-PRODUCT-10.jpg',
                'harga' => 329000,
                'stok' => 5,
                'is_active' => true,
            ],

        ];

        foreach ($produk as $item) {
            ProdukModel::create($item);
        }
    }
}