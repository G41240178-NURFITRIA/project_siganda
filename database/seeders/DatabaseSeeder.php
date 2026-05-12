<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed akun default untuk semua role SIGANDA.
     */
    public function run(): void
    {
        $users = [
            [
                'name'              => 'Administrator',
                'email'             => 'admin@siganda.com',
                'password'          => Hash::make('password'),
                'role'              => 'admin',
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Dr. Budi Santoso',
                'email'             => 'dokter@siganda.com',
                'password'          => Hash::make('password'),
                'role'              => 'dokter',
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Ns. Siti Rahayu',
                'email'             => 'perawat@siganda.com',
                'password'          => Hash::make('password'),
                'role'              => 'perawat',
                'email_verified_at' => now(),
            ],
            [
                'name'              => 'Ahmad PMIK',
                'email'             => 'pmik@siganda.com',
                'password'          => Hash::make('password'),
                'role'              => 'pmik',
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $data) {
            User::updateOrCreate(
                ['email' => $data['email']],
                $data
            );
        }

        $this->command->info('✅ Seeder selesai! Akun yang dibuat:');
        $this->command->table(
            ['Nama', 'Email', 'Role', 'Password'],
            collect($users)->map(fn($u) => [
                $u['name'], $u['email'], strtoupper($u['role']), 'password'
            ])->toArray()
        );
    }
}
