<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\KK;
use Faker\Factory as Faker;

class KKSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $dusun_list = ['Dusun Sari', 'Dusun Mawar', 'Dusun Melati', 'Dusun Kenanga', 'Dusun Cempaka'];
        $desa_list = ['Sukamaju', 'Sumberejo', 'Makmur Jaya', 'Sejahtera', 'Merdeka'];
        $kecamatan_list = ['Sukabumi', 'Bogor Utara', 'Cibinong', 'Parung', 'Gunung Putri'];
        $kabupaten_list = ['Bogor', 'Sukabumi', 'Cianjur', 'Depok', 'Bekasi'];

        for ($i = 1; $i <= 30; $i++) {
            KK::create([
                'no_kk' => $faker->unique()->numerify('################'), // 16 digit
                'dusun' => $faker->randomElement($dusun_list),
                'rt' => str_pad($faker->numberBetween(1, 15), 3, '0', STR_PAD_LEFT),
                'rw' => str_pad($faker->numberBetween(1, 10), 3, '0', STR_PAD_LEFT),
                'desa' => $faker->randomElement($desa_list),
                'kecamatan' => $faker->randomElement($kecamatan_list),
                'kabupaten' => $faker->randomElement($kabupaten_list),
                'provinsi' => 'Jawa Barat',
            ]);
        }
    }
}
