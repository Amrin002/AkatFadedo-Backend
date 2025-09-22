<?php

namespace Database\Seeders;

use App\Models\Apbdes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApbdesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate table untuk memastikan data bersih
        DB::table('apbdes')->truncate();

        // Data APBDes untuk beberapa tahun (2021-2024)
        $apbdesData = [
            // Data tahun 2021
            [
                'pendapatan' => 850000000, // 850 juta
                'penyelenggaraan' => 170000000, // 20% - Penyelenggaraan Pemerintahan
                'pelaksanaan' => 255000000, // 30% - Pelaksanaan Pembangunan
                'pembinaan' => 127500000, // 15% - Pembinaan Kemasyarakatan
                'pemberdayaan' => 127500000, // 15% - Pemberdayaan Masyarakat
                'penanggulangan' => 85000000, // 10% - Penanggulangan Bencana
                'pejabat' => 'Kepala Desa Sumber Makmur',
                'tahun' => 2021,
                'file' => 'apbdes_2021.pdf',
            ],

            // Data tahun 2022
            [
                'pendapatan' => 920000000, // 920 juta (naik 8.2%)
                'penyelenggaraan' => 184000000, // 20%
                'pelaksanaan' => 276000000, // 30%
                'pembinaan' => 138000000, // 15%
                'pemberdayaan' => 138000000, // 15%
                'penanggulangan' => 92000000, // 10%
                'pejabat' => 'Kepala Desa Sumber Makmur',
                'tahun' => 2022,
                'file' => 'apbdes_2022.pdf',
            ],

            // Data tahun 2023
            [
                'pendapatan' => 1050000000, // 1.05 miliar (naik 14.1%)
                'penyelenggaraan' => 210000000, // 20%
                'pelaksanaan' => 315000000, // 30%
                'pembinaan' => 157500000, // 15%
                'pemberdayaan' => 157500000, // 15%
                'penanggulangan' => 105000000, // 10%
                'pejabat' => 'Kepala Desa Sumber Makmur',
                'tahun' => 2023,
                'file' => 'apbdes_2023.pdf',
            ],

            // Data tahun 2024 (dengan alokasi berbeda untuk variasi)
            [
                'pendapatan' => 1200000000, // 1.2 miliar (naik 14.3%)
                'penyelenggaraan' => 216000000, // 18%
                'pelaksanaan' => 420000000, // 35% - diperbesar untuk pembangunan
                'pembinaan' => 144000000, // 12%
                'pemberdayaan' => 216000000, // 18% - diperbesar untuk pemberdayaan
                'penanggulangan' => 120000000, // 10%
                'pejabat' => 'Kepala Desa Maju Sejahtera',
                'tahun' => 2024,
                'file' => 'apbdes_2024.pdf',
            ],

            // Data tahun 2025 (proyeksi)
            [
                'pendapatan' => 1350000000, // 1.35 miliar (naik 12.5%)
                'penyelenggaraan' => 202500000, // 15%
                'pelaksanaan' => 472500000, // 35%
                'pembinaan' => 162000000, // 12%
                'pemberdayaan' => 270000000, // 20%
                'penanggulangan' => 135000000, // 10%
                'pejabat' => 'Kepala Desa Maju Sejahtera',
                'tahun' => 2025,
                'file' => 'apbdes_2025.pdf',
            ],
        ];

        // Insert data ke database
        foreach ($apbdesData as $data) {
            Apbdes::create($data);
        }

        // Tambahan data untuk testing edge cases
        $edgeCaseData = [
            // Case: Anggaran tidak seimbang (pengeluaran > pendapatan)
            [
                'pendapatan' => 500000000,
                'penyelenggaraan' => 120000000,
                'pelaksanaan' => 200000000,
                'pembinaan' => 100000000,
                'pemberdayaan' => 150000000,
                'penanggulangan' => 80000000, // Total: 650 juta > 500 juta pendapatan
                'pejabat' => 'Kepala Desa Testing',
                'tahun' => 2020,
                'file' => 'apbdes_2020_test.pdf',
            ],

            // Case: Alokasi pembangunan rendah
            [
                'pendapatan' => 800000000,
                'penyelenggaraan' => 400000000, // 50% - terlalu tinggi
                'pelaksanaan' => 120000000, // 15% - terlalu rendah untuk pembangunan
                'pembinaan' => 120000000, // 15%
                'pemberdayaan' => 80000000, // 10% - terlalu rendah
                'penanggulangan' => 80000000, // 10%
                'pejabat' => 'Kepala Desa Contoh',
                'tahun' => 2019,
                'file' => 'apbdes_2019_contoh.pdf',
            ],

            // Case: Anggaran seimbang optimal
            [
                'pendapatan' => 1000000000,
                'penyelenggaraan' => 150000000, // 15%
                'pelaksanaan' => 350000000, // 35%
                'pembinaan' => 150000000, // 15%
                'pemberdayaan' => 200000000, // 20%
                'penanggulangan' => 100000000, // 10%
                'pejabat' => 'Kepala Desa Optimal',
                'tahun' => 2026,
                'file' => 'apbdes_2026_optimal.pdf',
            ],
        ];

        // Insert edge case data
        foreach ($edgeCaseData as $data) {
            Apbdes::create($data);
        }

        $this->command->info('✅ APBDes seeder berhasil dijalankan!');
        $this->command->info('📊 Total data yang dibuat: ' . (count($apbdesData) + count($edgeCaseData)) . ' records');

        // Tampilkan ringkasan data yang dibuat
        $this->showSummary();
    }

    /**
     * Menampilkan ringkasan data yang telah dibuat
     */
    private function showSummary(): void
    {
        $this->command->info("\n📈 Ringkasan Data APBDes:");
        $this->command->line("├── Data Normal (2021-2025): 5 records");
        $this->command->line("├── Data Testing Edge Cases: 3 records");
        $this->command->line("├── Total Pendapatan Tertinggi: Rp 1.35 Miliar (2025)");
        $this->command->line("├── Total Pendapatan Terendah: Rp 500 Juta (2020 - Testing)");
        $this->command->line("└── Rentang Tahun: 2019 - 2026");

        $this->command->info("\n🎯 Data ini mencakup:");
        $this->command->line("• Tren kenaikan anggaran yang realistis");
        $this->command->line("• Berbagai skenario alokasi bidang");
        $this->command->line("• Case testing untuk validasi business logic");
        $this->command->line("• Data edge cases untuk robust testing");
    }
}
