<?php

namespace Database\Seeders;

use App\Models\KK;
use App\Models\Penduduk;
use App\Models\User;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Buat data KK terlebih dahulu
        KK::create([
            'no_kk' => '1234567890123456',
            'dusun' => 'Admin',
            'rt' => '000',
            'rw' => '000',
            'desa' => 'Admin',
            'kecamatan' => 'Admin',
            'kabupaten' => 'Admin',
            'provinsi' => 'Admin',
        ]);

        // 2. Buat data Penduduk
        Penduduk::create([
            'no_kk' => '1234567890123456',
            'nik' => '1234567890098765',
            'nama_lengkap' => 'Admin',
            'tempat_lahir' => 'Admin',
            'tanggal_lahir' => '1999/01/01',
            'jenis_kelamin' => 'Laki - laki',
            'agama' => 'Islam',
            'pendidikan' => 'S1',
            'pekerjaan' => 'Admin',
            'status' => 'Admin',
            'status_keluarga' => 'Admin',
            'golongan_darah' => 'O',
            'kewarganegaraan' => 'WNI',
            'nama_ayah' => 'Ayah Admin',
            'nama_ibu' => 'Ibu Admin',
            'email' => 'admin@gmail.com',
            'no_hp' => '0812345567890',
        ]);

        // 3. Buat akun User
        User::create([
            'nik' => '1234567890098765',
            'name' => 'Admin Desa',
            'no_telp' => '081234567890',
            'email' => 'admin@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('1234567890'),
        ]);
    }
}
