<?php

namespace Database\Seeders;

use App\Models\Berita;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class BeritaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table untuk memastikan data bersih
        DB::table('beritas')->truncate();

        // Pastikan ada user untuk relasi (ambil user pertama atau buat dummy)
        $users = User::all();
        if ($users->isEmpty()) {
            // Jika belum ada user, buat user dummy atau jalankan UserSeeder dulu
            $this->command->warn('⚠️  Tidak ada user ditemukan. Pastikan UserSeeder sudah dijalankan terlebih dahulu.');
            return;
        }

        // Data kategori berita yang umum untuk website desa
        $kategoris = [
            'Pemerintahan',
            'Pembangunan',
            'Sosial',
            'Ekonomi',
            'Pendidikan',
            'Kesehatan',
            'Keagamaan',
            'Budaya',
            'Lingkungan',
            'Keamanan'
        ];

        // Data berita sample
        $beritaData = [
            [
                'judul' => 'Pembangunan Jalan Desa Tahap II Dimulai',
                'konten' => 'Pemerintah Desa Sumber Makmur memulai pembangunan jalan desa tahap II yang menghubungkan dusun utara dengan pusat desa. Proyek ini menggunakan dana APBDes 2024 dengan total anggaran Rp 350 juta. Kepala Desa menyampaikan bahwa pembangunan ini diharapkan dapat memperlancar akses masyarakat menuju fasilitas umum seperti puskesmas, sekolah, dan pasar desa. Pembangunan ditargetkan selesai dalam 3 bulan ke depan dengan melibatkan tenaga kerja lokal untuk meningkatkan perekonomian masyarakat.',
                'kategori' => 'Pembangunan',
                'created_at' => Carbon::now()->subDays(2),
            ],
            [
                'judul' => 'Musrenbangdes 2025 Tetapkan Prioritas Pembangunan',
                'konten' => 'Musyawarah Perencanaan Pembangunan Desa (Musrenbangdes) tahun 2025 telah berhasil diselenggarakan dengan partisipasi seluruh elemen masyarakat. Dalam forum tersebut, disepakati beberapa prioritas pembangunan meliputi renovasi balai desa, pembangunan MCK umum, dan program pemberdayaan UMKM. Kepala Desa menekankan pentingnya partisipasi aktif masyarakat dalam setiap tahapan pembangunan desa. Total anggaran yang dialokasikan untuk program-program tersebut mencapai Rp 500 juta dari APBDes 2025.',
                'kategori' => 'Pemerintahan',
                'created_at' => Carbon::now()->subDays(5),
            ],
            [
                'judul' => 'Program Bantuan Bibit Tanaman Produktif Untuk Warga',
                'konten' => 'Pemerintah Desa meluncurkan program pembagian bibit tanaman produktif kepada 150 kepala keluarga sebagai upaya meningkatkan ketahanan pangan dan ekonomi masyarakat. Bibit yang dibagikan meliputi cabai, tomat, kangkung, dan tanaman obat keluarga (TOGA). Program ini merupakan bagian dari kegiatan pemberdayaan masyarakat dengan anggaran Rp 75 juta. Diharapkan program ini dapat mengurangi pengeluaran rumah tangga untuk kebutuhan sayuran sekaligus membuka peluang usaha bagi masyarakat.',
                'kategori' => 'Ekonomi',
                'created_at' => Carbon::now()->subWeeks(1),
            ],
            [
                'judul' => 'Vaksinasi Massal COVID-19 Dosis Booster di Balai Desa',
                'konten' => 'Puskesmas Kecamatan bekerja sama dengan Pemerintah Desa menyelenggarakan vaksinasi massal COVID-19 dosis booster untuk masyarakat berusia 18 tahun ke atas. Kegiatan ini dilaksanakan di Balai Desa dengan target 300 warga per hari selama 3 hari berturut-turut. Kepala Desa mengajak seluruh masyarakat untuk berpartisipasi dalam program vaksinasi ini sebagai bentuk gotong royong menjaga kesehatan bersama. Peserta vaksinasi juga mendapat paket sembako dan vitamin gratis.',
                'kategori' => 'Kesehatan',
                'created_at' => Carbon::now()->subWeeks(2),
            ],
            [
                'judul' => 'Pelatihan Digital Marketing untuk UMKM Desa',
                'konten' => 'Dinas Koperasi dan UMKM Kabupaten mengadakan pelatihan digital marketing untuk pelaku UMKM di desa dengan peserta 50 orang. Materi pelatihan mencakup cara membuat konten menarik di media sosial, strategi pemasaran online, dan penggunaan platform e-commerce. Pelatihan ini diharapkan dapat membantu UMKM lokal memperluas jangkauan pasar dan meningkatkan omzet penjualan. Setiap peserta mendapat sertifikat dan modul panduan digital marketing.',
                'kategori' => 'Ekonomi',
                'created_at' => Carbon::now()->subWeeks(3),
            ],
            [
                'judul' => 'Gotong Royong Bersih Desa Sambut Hari Kemerdekaan',
                'konten' => 'Seluruh warga desa berpartisipasi dalam kegiatan gotong royong bersih desa dalam rangka menyambut peringatan Hari Kemerdekaan RI. Kegiatan dimulai pukul 06.00 WIB dengan membersihkan jalan utama, saluran air, dan area publik lainnya. Selain itu, juga dilakukan penanaman pohon di sepanjang jalan desa dan pembuatan taman kecil di depan balai desa. Kepala Desa menyampaikan apresiasi atas semangat gotong royong masyarakat yang masih terjaga dengan baik.',
                'kategori' => 'Sosial',
                'created_at' => Carbon::now()->subMonths(1),
            ],
            [
                'judul' => 'Bantuan Beasiswa Pendidikan untuk Siswa Berprestasi',
                'konten' => 'Pemerintah Desa memberikan bantuan beasiswa pendidikan kepada 25 siswa berprestasi dari keluarga kurang mampu. Beasiswa diberikan untuk jenjang SD, SMP, dan SMA dengan nominal berbeda sesuai tingkatan. Total anggaran beasiswa mencapai Rp 125 juta yang bersumber dari APBDes 2024. Kriteria penerima beasiswa adalah siswa dengan prestasi akademik baik dan berasal dari keluarga pra-sejahtera. Pemberian beasiswa ini diharapkan dapat mendorong semangat belajar anak-anak desa.',
                'kategori' => 'Pendidikan',
                'created_at' => Carbon::now()->subMonths(2),
            ],
            [
                'judul' => 'Festival Budaya Desa Lestarikan Tradisi Lokal',
                'konten' => 'Festival budaya desa berhasil diselenggarakan dengan menampilkan berbagai kesenian tradisional seperti tari-tarian daerah, musik tradisional, dan pameran kerajinan khas desa. Acara ini dihadiri oleh ribuan pengunjung dari desa sekitar dan menjadi ajang promosi potensi wisata budaya desa. Selain pertunjukan seni, juga digelar bazar kuliner khas daerah dan pameran produk UMKM lokal. Kepala Desa berharap festival ini dapat menjadi agenda tahunan untuk melestarikan budaya dan meningkatkan ekonomi masyarakat.',
                'kategori' => 'Budaya',
                'created_at' => Carbon::now()->subMonths(3),
            ],
            [
                'judul' => 'Program Bedah Rumah untuk Keluarga Kurang Mampu',
                'konten' => 'Program bedah rumah untuk keluarga kurang mampu telah selesai dilaksanakan dengan total 10 rumah yang direnovasi. Program ini merupakan kerja sama antara Pemerintah Desa, CSR perusahaan, dan partisipasi masyarakat. Renovasi meliputi perbaikan atap, dinding, lantai, dan fasilitas MCK. Total anggaran program mencapai Rp 200 juta dengan sistem gotong royong dalam pelaksanaannya. Keluarga penerima program sangat bersyukur karena kini memiliki tempat tinggal yang layak dan sehat.',
                'kategori' => 'Sosial',
                'created_at' => Carbon::now()->subMonths(4),
            ],
            [
                'judul' => 'Sosialisasi Program Kartu Indonesia Pintar untuk Siswa',
                'konten' => 'Dinas Pendidikan Kabupaten bersama Pemerintah Desa mengadakan sosialisasi Program Kartu Indonesia Pintar (KIP) untuk membantu biaya pendidikan siswa dari keluarga kurang mampu. Sosialisasi dihadiri oleh 200 orang tua siswa dan dijelaskan prosedur pendaftaran serta persyaratan yang harus dipenuhi. Program KIP memberikan bantuan biaya pendidikan mulai dari SD hingga perguruan tinggi. Diharapkan dengan adanya program ini, tidak ada lagi anak putus sekolah karena kendala ekonomi.',
                'kategori' => 'Pendidikan',
                'created_at' => Carbon::now()->subMonths(5),
            ]
        ];

        // Insert berita ke database
        foreach ($beritaData as $index => $data) {
            // Randomly assign user_id dari user yang ada
            $randomUser = $users->random();

            $berita = Berita::create([
                'judul' => $data['judul'],
                'konten' => $data['konten'],
                'kategori' => $data['kategori'],
                'user_id' => $randomUser->id,
                'gambar' => $this->generateDummyImagePath($data['kategori']),
                'created_at' => $data['created_at'],
                'updated_at' => $data['created_at'],
            ]);
        }

        // Tambahan berita untuk testing dengan berbagai kondisi
        $testingData = [
            [
                'judul' => 'Berita Dengan Judul Sangat Panjang Untuk Testing Slug Generation Dan Display',
                'konten' => 'Konten singkat untuk testing.',
                'kategori' => 'Testing',
                'created_at' => Carbon::now(),
            ],
            [
                'judul' => 'Berita Tanpa Gambar',
                'konten' => 'Berita ini tidak memiliki gambar untuk testing default image.',
                'kategori' => 'Testing',
                'gambar' => null,
                'created_at' => Carbon::now()->subHours(2),
            ],
            [
                'judul' => 'BERITA DENGAN HURUF KAPITAL SEMUA',
                'konten' => 'Testing bagaimana slug generation menangani huruf kapital.',
                'kategori' => 'Testing',
                'created_at' => Carbon::now()->subHours(4),
            ]
        ];

        // Insert testing data
        foreach ($testingData as $data) {
            $randomUser = $users->random();

            Berita::create([
                'judul' => $data['judul'],
                'konten' => $data['konten'],
                'kategori' => $data['kategori'],
                'user_id' => $randomUser->id,
                'gambar' => $data['gambar'] ?? $this->generateDummyImagePath($data['kategori']),
                'created_at' => $data['created_at'],
                'updated_at' => $data['created_at'],
            ]);
        }

        $this->command->info('✅ Berita seeder berhasil dijalankan!');
        $this->command->info('📰 Total berita yang dibuat: ' . (count($beritaData) + count($testingData)) . ' records');

        // Tampilkan ringkasan
        $this->showSummary();
    }

    /**
     * Generate dummy image path berdasarkan kategori
     */
    private function generateDummyImagePath($kategori): string
    {
        $imageNames = [
            'Pemerintahan' => 'berita/pemerintahan_' . rand(1, 5) . '.jpg',
            'Pembangunan' => 'berita/pembangunan_' . rand(1, 5) . '.jpg',
            'Sosial' => 'berita/sosial_' . rand(1, 5) . '.jpg',
            'Ekonomi' => 'berita/ekonomi_' . rand(1, 5) . '.jpg',
            'Pendidikan' => 'berita/pendidikan_' . rand(1, 5) . '.jpg',
            'Kesehatan' => 'berita/kesehatan_' . rand(1, 5) . '.jpg',
            'Keagamaan' => 'berita/keagamaan_' . rand(1, 5) . '.jpg',
            'Budaya' => 'berita/budaya_' . rand(1, 5) . '.jpg',
            'Lingkungan' => 'berita/lingkungan_' . rand(1, 5) . '.jpg',
            'Keamanan' => 'berita/keamanan_' . rand(1, 5) . '.jpg',
            'Testing' => 'berita/testing_' . rand(1, 3) . '.jpg',
        ];

        return $imageNames[$kategori] ?? 'berita/default_' . rand(1, 3) . '.jpg';
    }

    /**
     * Menampilkan ringkasan data yang telah dibuat
     */
    private function showSummary(): void
    {
        $totalBerita = Berita::count();
        $kategoriCount = Berita::selectRaw('kategori, COUNT(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $this->command->info("\n📊 Ringkasan Data Berita:");
        $this->command->line("├── Total Berita: {$totalBerita} records");
        $this->command->line("├── Rentang Waktu: " . Carbon::now()->subMonths(5)->format('M Y') . " - " . Carbon::now()->format('M Y'));
        $this->command->line("└── Distribusi per Kategori:");

        foreach ($kategoriCount as $kategori => $total) {
            $this->command->line("    ├── {$kategori}: {$total} berita");
        }

        $this->command->info("\n🎯 Fitur Testing yang Tersedia:");
        $this->command->line("• Slug generation otomatis");
        $this->command->line("• Relasi ke User model");
        $this->command->line("• Default image handling");
        $this->command->line("• Berbagai kategori berita desa");
        $this->command->line("• Testing edge cases");

        $this->command->info("\n💡 Tips:");
        $this->command->line("• Pastikan folder 'storage/app/public/berita' sudah dibuat");
        $this->command->line("• Jalankan 'php artisan storage:link' untuk akses gambar");
        $this->command->line("• Upload gambar dummy ke folder berita sesuai nama yang di-generate");
    }
}
