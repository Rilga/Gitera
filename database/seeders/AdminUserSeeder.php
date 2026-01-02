<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            // =====================
            // ADMIN
            // =====================
            [
                'email' => 'admin@gitera.com',
                'name' => 'Admin Desa',
                'password' => 'admin123',
                'role' => 'admin',
                'status' => 'approved',
                'nik' => '0000000000000000',
                'no_hp' => '081234567890',
            ],

            // =====================
            // USER / WARGA
            // =====================
            [
                'email' => 'rilga@gitera.com',
                'name' => 'Rilga Lingga',
                'password' => 'user12345',
                'role' => 'user',
                'status' => 'approved',
                'nik' => '3201010101010001',
                'no_hp' => '082118952929',
            ],

            [
                'email' => 'johan@gitera.com',
                'name' => 'Ignatius Jonathan',
                'password' => 'user12345',
                'role' => 'user',
                'status' => 'approved',
                'nik' => '3201010101010002',
                'no_hp' => '082113377042',
            ],

            [
                'email' => 'dilla@gitera.com',
                'name' => 'Fitrotin Nadzillah',
                'password' => 'user12345',
                'role' => 'user',
                'status' => 'approved',
                'nik' => '3201010101010003',
                'no_hp' => '085732223244',
            ],
        ];

        foreach ($users as $user) {
            User::firstOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make($user['password']),
                    'role' => $user['role'],
                    'status' => $user['status'],
                    'nik' => $user['nik'],
                    'no_hp' => $user['no_hp'],
                    'email_verified_at' => now(),
                ]
            );
        }
    }
}