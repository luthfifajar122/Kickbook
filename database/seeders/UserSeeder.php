<?php

namespace Database\Seeders;

use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserModel::create([
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'alamat' => 'jalan lorem',
            'no_hp' => '0898989898',
            'password' => Hash::make('qwerty'),
            'role' => 'admin',
        ]);

        UserModel::create([
            'username' => 'customer',
            'email' => 'customer@gmail.com',
            'alamat' => 'jalan lorem',
            'no_hp' => '0898989898',
            'password' => Hash::make('qwerty'),
            'role' => 'customer',
        ]);
    }
}