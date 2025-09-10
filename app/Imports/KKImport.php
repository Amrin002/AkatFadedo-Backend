<?php

namespace App\Imports;

use App\Models\KK;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;

class KKImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {

        foreach ($rows as $row) {
            $no_kk = trim((string) ($row['no_kk'] ?? $row['No KK'] ?? ''));
            $dusun = trim((string) ($row['dusun'] ?? $row['Dusun'] ?? ''));
            $rt = $row['rt'] ?? $row['RT'] ?? 0;
            $rw = $row['rw'] ?? $row['RW'] ?? 0;
            $desa = trim((string) ($row['desa'] ?? $row['Desa'] ?? ''));
            $kecamatan = trim((string) ($row['kecamatan'] ?? $row['Kecamatan'] ?? ''));
            $kabupaten = trim((string) ($row['kabupaten'] ?? $row['Kabupaten'] ?? ''));
            $provinsi = trim((string) ($row['provinsi'] ?? $row['Provinsi'] ?? ''));

            // Lewati jika dusun = admin
            if (strtolower($row['dusun']) === 'admin') {
                continue;
            }

            // Cek apakah KK sudah ada
            $exists = KK::where('no_kk', $row['no_kk'])->exists();
            if ($exists) {
                continue; // skip jika sudah ada
            }
            //dd($row);
            KK::create([
                'no_kk' => $no_kk,
                'dusun' => $dusun,
                'rt' => $rt,
                'rw' => $rw,
                'desa' => $desa,
                'kecamatan' => $kecamatan,
                'kabupaten' => $kabupaten,
                'provinsi' => $provinsi,
            ]);
        }
    }
}
