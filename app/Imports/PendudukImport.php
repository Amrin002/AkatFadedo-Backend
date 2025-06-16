<?php

namespace App\Imports;

use App\Models\KK;
use App\Models\Penduduk;
use Illuminate\Support\Collection;

use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class PendudukImport implements ToCollection, WithHeadingRow
{
    /**
     * Proses impor data penduduk dari file Excel
     *
     * @param Collection $rows
     */
    public $gagal = []; // Kumpulkan data gagal
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            // Normalize NIK & No KK jadi string bersih
            $nik   = trim((string) $row['nik']);
            $no_kk = trim((string) $row['no_kk']);

            // Skip jika status admin
            if (strtolower($row['status']) === 'admin') {
                continue;
            }

            // Skip jika sudah ada (pakai NIK yang sudah dinormalisasi)
            if (Penduduk::where('nik', $nik)->exists()) {
                continue;
            }
            // Cek apakah no_kk valid
            if (!KK::where('no_kk', (string)$row['no_kk'])->exists()) {
                // Tambahkan ke array gagal
                $this->gagal[] = [
                    'nik' => $row['nik'],
                    'no_kk' => $row['no_kk'],
                    'nama_lengkap' => $row['nama_lengkap'],
                    'alasan' => 'No KK tidak ditemukan'
                ];
                continue;
            }
            // Cek dan konversi tanggal_lahir jika perlu
            $tanggal_lahir = $row['tanggal_lahir'];

            // Jika tanggal_lahir adalah angka (format serial Excel)
            if (is_numeric($tanggal_lahir)) {
                $tanggal_lahir = Date::excelToDateTimeObject($tanggal_lahir)->format('Y-m-d');
            }

            Penduduk::create([
                'nik'               => $nik,
                'no_kk'             => $no_kk,
                'nama_lengkap'      => $row['nama_lengkap'],
                'tempat_lahir'      => $row['tempat_lahir'],
                'tanggal_lahir'     => $row['tanggal_lahir'],
                'jenis_kelamin'     => $row['jenis_kelamin'],
                'agama'             => $row['agama'],
                'pendidikan'        => $row['pendidikan'],
                'pekerjaan'         => $row['pekerjaan'],
                'status'            => $row['status'],
                'status_keluarga'   => $row['status_keluarga'],
                'golongan_darah'    => $row['golongan_darah'],
                'kewarganegaraan'   => $row['kewarganegaraan'],
                'nama_ayah'         => $row['nama_ayah'],
                'nama_ibu'          => $row['nama_ibu'],
                'email'             => $row['email'],
                'no_hp'             => $row['no_hp'],
            ]);
        }
    }
    public function getGagal()
    {
        return $this->gagal;
    }
}
