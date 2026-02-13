<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Siswa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class SiswaSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        for ($i = 1; $i <= 120; $i++) {
            $nipd = '2122' . str_pad($i, 5, '0', STR_PAD_LEFT);
            $tgl_lahir = $faker->date('Y-m-d', '2008-12-31');

            $user = User::create([
                'name' => $faker->name,
                'username' => $nipd,
                'password' => Hash::make($tgl_lahir),
                'role' => 'siswa'
            ]);

            Siswa::create([
                'id' => $user->id,
                'nipd' => $nipd,
                'nama' => $user->name,
                'tempat_lahir' => $faker->city,
                'tgl_lahir' => $tgl_lahir,
                'no_hp' => '08' . $faker->numerify('##########'),
                'alamat' => $faker->address,
                'kelas' => $faker->randomElement(['X', 'XI', 'XII']),
                'jurusan' => $faker->randomElement(['PPLG', 'BRP', 'DKV']), 
                'status_penempatan' => 'belum'
            ]);
        }
    }
}