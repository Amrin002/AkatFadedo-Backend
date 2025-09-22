<?php

namespace Database\Seeders;

use App\Models\GaleriDesa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class GaleriDesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table untuk memastikan data bersih
        DB::table('galeri_desas')->truncate();

        // Buat folder galeri jika belum ada
        if (!Storage::disk('public')->exists('galeri')) {
            Storage::disk('public')->makeDirectory('galeri');
        }

          $galeriData = [
            [
                'nama_kegiatan' => 'Gotong Royong Pembersihan Lingkungan',
                'image_url' => 'https://picsum.photos/800/600?random=1',

            ],
            [
                'nama_kegiatan' => 'Pembangunan Jalan Desa',
                'image_url' => 'https://picsum.photos/800/600?random=2',

            ],
            [
                'nama_kegiatan' => 'Pelatihan UMKM Desa',
                'image_url' => 'https://picsum.photos/800/600?random=3',

            ],
            [
                'nama_kegiatan' => 'Festival Budaya Desa',
                'image_url' => 'https://picsum.photos/800/600?random=4',

            ],
            [
                'nama_kegiatan' => 'Posyandu Balita',
                'image_url' => 'https://picsum.photos/800/600?random=5',

            ],
            [
                'nama_kegiatan' => 'Panen Raya Padi',
                'image_url' => 'https://picsum.photos/800/600?random=6',

            ],
            [
                'nama_kegiatan' => 'Senam Sehat Lansia',
                'image_url' => 'https://picsum.photos/800/600?random=7',

            ],
            [
                'nama_kegiatan' => 'Musyawarah Desa',
                'image_url' => 'https://picsum.photos/800/600?random=8',

            ],
            [
                'nama_kegiatan' => 'Pembagian Bantuan Sosial',
                'image_url' => 'https://picsum.photos/800/600?random=9',

            ],
            [
                'nama_kegiatan' => 'Pelatihan Pertanian Organik',
                'image_url' => 'https://picsum.photos/800/600?random=10',

            ],
            [
                'nama_kegiatan' => 'Lomba 17 Agustus',
                'image_url' => 'https://picsum.photos/800/600?random=11',

            ],
            [
                'nama_kegiatan' => 'Bakti Sosial Kesehatan',
                'image_url' => 'https://picsum.photos/800/600?random=12',

            ],
            [
                'nama_kegiatan' => 'Penanaman Pohon',
                'image_url' => 'https://picsum.photos/800/600?random=13',

            ],
            [
                'nama_kegiatan' => 'Pembukaan Jalan Tani',
                'image_url' => 'https://picsum.photos/800/600?random=14',

            ],
            [
                'nama_kegiatan' => 'Pelatihan Komputer Remaja',
                'image_url' => 'https://picsum.photos/800/600?random=15',

            ]
        ];


        // Alternatif menggunakan Unsplash (perlu API key, tapi ada free tier)
        $unsplashImages = [
            'https://source.unsplash.com/800x600/?village,community',
            'https://source.unsplash.com/800x600/?construction,development',
            'https://source.unsplash.com/800x600/?workshop,training',
            'https://source.unsplash.com/800x600/?culture,festival',
            'https://source.unsplash.com/800x600/?health,medical',
            'https://source.unsplash.com/800x600/?agriculture,farming',
            'https://source.unsplash.com/800x600/?exercise,seniors',
            'https://source.unsplash.com/800x600/?meeting,discussion',
            'https://source.unsplash.com/800x600/?community,help',
            'https://source.unsplash.com/800x600/?organic,farm',
            'https://source.unsplash.com/800x600/?celebration,festival',
            'https://source.unsplash.com/800x600/?healthcare,service',
            'https://source.unsplash.com/800x600/?tree,environment',
            'https://source.unsplash.com/800x600/?rural,road',
            'https://source.unsplash.com/800x600/?computer,learning'
        ];

        $this->command->info('🖼️  Mulai download gambar dan membuat data galeri...');

        // Loop untuk membuat data galeri
        foreach ($galeriData as $index => $data) {
            try {
                // Pilih menggunakan Picsum atau Unsplash (bisa disesuaikan)
                $useUnsplash = rand(0, 1); // Random pilih source
                $imageUrl = $useUnsplash && isset($unsplashImages[$index])
                    ? $unsplashImages[$index]
                    : $data['image_url'];

                $this->command->line("📥 Downloading: {$data['nama_kegiatan']}");

                // Download gambar dari URL
                $imageContent = $this->downloadImage($imageUrl);

                if ($imageContent) {
                    // Generate nama file unique
                    $fileName = Str::slug($data['nama_kegiatan']) . '-' . time() . '-' . $index . '.jpg';
                    $filePath = 'galeri/' . $fileName;

                    // Simpan gambar ke storage
                    Storage::disk('public')->put($filePath, $imageContent);

                    // Buat record di database
                    GaleriDesa::create([
                        'nama_kegiatan' => $data['nama_kegiatan'],
                        'image' => $filePath
                    ]);

                    $this->command->info("✅ {$data['nama_kegiatan']} - Berhasil");
                } else {
                    // Jika download gagal, gunakan path dummy
                    GaleriDesa::create([
                        'nama_kegiatan' => $data['nama_kegiatan'],
                        'image' => 'galeri/dummy-' . ($index + 1) . '.jpg'
                    ]);

                    $this->command->warn("⚠️  {$data['nama_kegiatan']} - Menggunakan dummy image");
                }

                // Delay kecil untuk menghindari rate limiting
                usleep(200000); // 0.2 detik

            } catch (\Exception $e) {
                // Jika ada error, gunakan dummy path
                GaleriDesa::create([
                    'nama_kegiatan' => $data['nama_kegiatan'],
                    'image' => 'galeri/dummy-' . ($index + 1) . '.jpg'
                ]);

                $this->command->error("❌ Error untuk {$data['nama_kegiatan']}: " . $e->getMessage());
            }
        }

        // Tambahan data dengan URL langsung (tanpa download)
        $directUrlData = [
            [
                'nama_kegiatan' => 'Rapat Koordinasi BPD',
                'image' => 'https://picsum.photos/id/1/800/600', // Fixed image ID
            ],
            [
                'nama_kegiatan' => 'Kerja Bakti Masjid',
                'image' => 'https://picsum.photos/id/10/800/600',
            ],
            [
                'nama_kegiatan' => 'Sosialisasi Program Desa',
                'image' => 'https://picsum.photos/id/20/800/600',
            ],
        ];

        // Insert data dengan URL langsung (tidak didownload)
        foreach ($directUrlData as $data) {
            GaleriDesa::create($data);
            $this->command->line("🔗 {$data['nama_kegiatan']} - URL langsung");
        }

        $totalRecords = count($galeriData) + count($directUrlData);
        $this->command->info("✅ GaleriDesa seeder berhasil dijalankan!");
        $this->command->info("📷 Total galeri yang dibuat: {$totalRecords} records");

        $this->showSummary();
    }

    /**
     * Download gambar dari URL
     */
    private function downloadImage($url): ?string
    {
        try {
            $response = Http::timeout(10)->get($url);

            if ($response->successful()) {
                return $response->body();
            }

            return null;
        } catch (\Exception $e) {
            return null;
        }
    }

    /**
     * Menampilkan ringkasan data yang telah dibuat
     */
    private function showSummary(): void
    {
        $total = GaleriDesa::count();

        $this->command->info("\n📊 Ringkasan Galeri Desa:");
        $this->command->line("├── Total Galeri: {$total} records");
        $this->command->line("├── Gambar Downloaded: " . ($total - 3) . " files");
        $this->command->line("├── URL Langsung: 3 files");
        $this->command->line("└── Lokasi Storage: storage/app/public/galeri/");

        $this->command->info("\n🎯 Jenis Kegiatan yang Tersedia:");
        $activities = [
            'Gotong Royong & Kebersihan',
            'Pembangunan & Infrastruktur',
            'Pelatihan & Pendidikan',
            'Budaya & Tradisi',
            'Kesehatan & Sosial',
            'Pertanian & Lingkungan',
            'Pemerintahan & Koordinasi'
        ];

        foreach ($activities as $activity) {
            $this->command->line("• {$activity}");
        }

        $this->command->info("\n🌐 Sumber Gambar:");
        $this->command->line("• Picsum Photos (Lorem Ipsum for photos)");
        $this->command->line("• Unsplash Source (High quality stock photos)");
        $this->command->line("• Mixed random selection untuk variasi");

        $this->command->info("\n💡 Tips Penggunaan:");
        $this->command->line("• Jalankan 'php artisan storage:link' untuk akses publik");
        $this->command->line("• Folder 'storage/app/public/galeri' otomatis dibuat");
        $this->command->line("• Gambar ter-download dengan resolusi 800x600px");
        $this->command->line("• Fallback ke dummy jika download gagal");

        $this->command->warn("\n⚠️  Catatan:");
        $this->command->line("• Pastikan koneksi internet stabil saat menjalankan seeder");
        $this->command->line("• Beberapa gambar menggunakan URL langsung (butuh internet untuk ditampilkan)");
        $this->command->line("• Untuk production, pertimbangkan upload gambar manual");
    }
}
