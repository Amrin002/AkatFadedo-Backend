<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Penduduk;
use App\Models\KK;
use Faker\Factory as Faker;

class PendudukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        // Ambil semua nomor KK yang sudah ada
        $no_kk_list = KK::pluck('no_kk')->toArray();

        $agama_list = ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu'];
        $pendidikan_list = ['SD', 'SMP', 'SMA', 'SMK', 'D3', 'S1', 'S2', 'S3', 'Tidak Sekolah'];
        $pekerjaan_list = [
            'PNS',
            'Karyawan Swasta',
            'Wiraswasta',
            'Petani',
            'Pedagang',
            'Guru',
            'Dokter',
            'Perawat',
            'Polisi',
            'TNI',
            'Buruh',
            'Supir',
            'Tukang',
            'Nelayan',
            'Pensiunan',
            'Ibu Rumah Tangga',
            'Mahasiswa',
            'Pelajar',
            'Belum Bekerja'
        ];
        $status_list = ['Kawin', 'Belum Kawin', 'Cerai Hidup', 'Cerai Mati'];
        $status_keluarga_list = ['Kepala Keluarga', 'Istri', 'Anak', 'Menantu', 'Cucu', 'Orang Tua', 'Mertua', 'Famili Lain', 'Pembantu', 'Lainnya'];
        $golongan_darah_list = ['A', 'B', 'AB', 'O'];
        $kewarganegaraan_list = ['WNI', 'WNA'];
        $tempat_lahir_list = [
            'Jakarta',
            'Bogor',
            'Depok',
            'Tangerang',
            'Bekasi',
            'Sukabumi',
            'Cianjur',
            'Bandung',
            'Cirebon',
            'Tasikmalaya',
            'Garut',
            'Sumedang',
            'Karawang',
            'Purwakarta',
            'Subang',
            'Indramayu',
            'Majalengka'
        ];

        for ($i = 1; $i <= 100; $i++) {
            // Pilih nomor KK secara random, dengan kemungkinan beberapa penduduk dalam satu KK
            $selected_no_kk = $faker->randomElement($no_kk_list);

            // Generate jenis kelamin
            $jenis_kelamin = $faker->randomElement(['Laki-laki', 'Perempuan']);

            // Generate nama berdasarkan jenis kelamin
            $nama_lengkap = $jenis_kelamin == 'Laki-laki' ? $faker->name('male') : $faker->name('female');

            // Generate tanggal lahir (umur antara 1-80 tahun)
            $tanggal_lahir = $faker->dateTimeBetween('-80 years', '-1 years')->format('Y-m-d');

            // Tentukan status dan pekerjaan berdasarkan umur
            $umur = now()->year - date('Y', strtotime($tanggal_lahir));

            if ($umur < 5) {
                $pendidikan = 'Tidak Sekolah';
                $pekerjaan = 'Belum Bekerja';
                $status = 'Belum Kawin';
                $status_keluarga = 'Anak';
            } elseif ($umur >= 5 && $umur < 18) {
                $pendidikan = $faker->randomElement(['SD', 'SMP', 'SMA']);
                $pekerjaan = 'Pelajar';
                $status = 'Belum Kawin';
                $status_keluarga = 'Anak';
            } elseif ($umur >= 18 && $umur < 25) {
                $pendidikan = $faker->randomElement(['SMA', 'SMK', 'D3', 'S1']);
                $pekerjaan = $faker->randomElement(['Mahasiswa', 'Karyawan Swasta', 'Belum Bekerja']);
                $status = $faker->randomElement(['Belum Kawin', 'Kawin']);
                $status_keluarga = $faker->randomElement(['Anak', 'Menantu']);
            } else {
                $pendidikan = $faker->randomElement($pendidikan_list);
                $pekerjaan = $faker->randomElement($pekerjaan_list);
                $status = $faker->randomElement($status_list);
                $status_keluarga = $faker->randomElement($status_keluarga_list);
            }

            // Khusus untuk kepala keluarga, pastikan sudah dewasa dan menikah
            if ($status_keluarga == 'Kepala Keluarga') {
                $status = $faker->randomElement(['Kawin', 'Cerai Hidup', 'Cerai Mati']);
                if ($jenis_kelamin == 'Perempuan' && $pekerjaan != 'Ibu Rumah Tangga') {
                    $pekerjaan = $faker->randomElement(array_merge($pekerjaan_list, ['Ibu Rumah Tangga']));
                }
            }

            Penduduk::create([
                'nik' => $faker->unique()->numerify('################'), // 16 digit NIK
                'no_kk' => $selected_no_kk,
                'nama_lengkap' => $nama_lengkap,
                'tempat_lahir' => $faker->randomElement($tempat_lahir_list),
                'tanggal_lahir' => $tanggal_lahir,
                'jenis_kelamin' => $jenis_kelamin,
                'agama' => $faker->randomElement($agama_list),
                'pendidikan' => $pendidikan,
                'pekerjaan' => $pekerjaan,
                'status' => $status,
                'status_keluarga' => $status_keluarga,
                'golongan_darah' => $faker->optional(0.8)->randomElement($golongan_darah_list), // 80% kemungkinan ada
                'kewarganegaraan' => $faker->randomElement($kewarganegaraan_list),
                'nama_ayah' => $faker->name('male'),
                'nama_ibu' => $faker->name('female'),
                'email' => $faker->optional(0.6)->email(), // 60% kemungkinan punya email
                'no_hp' => $faker->optional(0.7)->phoneNumber(), // 70% kemungkinan punya HP
            ]);
        }
    }
}
