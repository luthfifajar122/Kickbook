<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\KategoriModel;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $kategori = [
            [
                'nama_kategori' => 'Race Car',
                'deskripsi' => 'Mobil balap dari berbagai ajang seperti GT, Le Mans, Formula, dan Touring.',
            ],
            [
                'nama_kategori' => 'JDM',
                'deskripsi' => 'Mobil ikonik asal Jepang seperti Nissan, Toyota, Honda, Mazda, dan Subaru.',
            ],
            [
                'nama_kategori' => 'Classic & Vintage',
                'deskripsi' => 'Mobil klasik dan vintage dari berbagai era.',
            ],
            [
                'nama_kategori' => 'Supercar',
                'deskripsi' => 'Mobil performa tinggi seperti Ferrari, Lamborghini, Porsche, McLaren, dan Bugatti.',
            ],
            [
                'nama_kategori' => 'Muscle Car',
                'deskripsi' => 'Mobil otot Amerika seperti Mustang, Camaro, Challenger, dan Charger.',
            ],
            [
                'nama_kategori' => 'Off-Road',
                'deskripsi' => 'SUV, Jeep, Rally Raid, dan kendaraan petualangan.',
            ],
            [
                'nama_kategori' => 'Pickup & Truck',
                'deskripsi' => 'Pickup, truk ringan, dan kendaraan utilitas.',
            ],
            [
                'nama_kategori' => 'Fantasy',
                'deskripsi' => 'Diecast bertema fantasi, custom, dan desain imajinatif.',
            ],
            [
                'nama_kategori' => 'Movie & Pop Culture',
                'deskripsi' => 'Diecast dari film, anime, game, atau serial televisi.',
            ],
            [
                'nama_kategori' => 'Police & Emergency',
                'deskripsi' => 'Kendaraan polisi, ambulans, pemadam kebakaran, dan layanan darurat.',
            ],
            [
                'nama_kategori' => 'Construction',
                'deskripsi' => 'Alat berat dan kendaraan konstruksi.',
            ],
            [
                'nama_kategori' => 'Limited Edition',
                'deskripsi' => 'Produk edisi terbatas dan koleksi eksklusif.',
            ],
        ];

        foreach ($kategori as $item) {
            KategoriModel::firstOrCreate(
                ['nama_kategori' => $item['nama_kategori']],
                $item
            );
        }
    }
}