<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DummyUsersSeeder extends Seeder
{
    public function run(): void
    {
        $userData = [
            [
                'name' => 'Mas Admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Pak Guru',
                'username' => 'guru',
                'email' => 'guru@gmail.com',
                'role' => 'guru',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Mas Siswa',
                'username' => 'siswa',
                'email' => 'siswa@gmail.com',
                'role' => 'siswa',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'Bu mentor',
                'username' => 'mentor',
                'email' => 'mentor@gmail.com',
                'role' => 'mentor',
                'password' => bcrypt('123456')
            ],
        ];

        foreach ($userData as $key => $val) {
            User::create($val);
        }
    }
}