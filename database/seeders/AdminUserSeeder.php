<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // Pastikan import Model User
use Illuminate\Support\Facades\Hash; // Pastikan import Hash

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Gunakan firstOrCreate untuk menghindari duplikat jika seeder dijalankan berkali-kali
        User::firstOrCreate(
            [
                'email' => 'admin@gitera.com' // Email unik sebagai acuan
            ],
            [
                'name' => 'Admin Desa',
                'password' => Hash::make('admin123'), // Ganti dengan password aman Anda
                'role' => 'admin',
                'status' => 'approved', // Admin harus langsung 'approved'
                'nik' => '0000000000000000', // NIK 16 digit, bisa diisi NIK asli admin
                'no_hp' => '08123456789', // No HP admin
                'email_verified_at' => now(), // Admin bisa langsung diverifikasi
            ]
        );
    }
}