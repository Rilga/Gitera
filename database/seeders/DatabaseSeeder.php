<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. HAPUS ATAU BERI KOMENTAR KODE FACTORY LAMA
        // Kode seperti di bawah ini adalah penyebab error, 
        // karena factory default tidak tahu tentang kolom 'nik' baru Anda.
        /*
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        */


        // 2. TAMBAHKAN PEMANGGILAN UNTUK SEEDER YANG ANDA BUAT
        // Ini akan menjalankan kode dari AdminUserSeeder.php
        $this->call([
            AdminUserSeeder::class,
            // Jika Anda punya seeder lain, tambahkan di sini
        ]);
    }
}