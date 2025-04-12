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
                'no_kk'     => $row['no_kk'],
                'dusun'     => $row['dusun'],
                'rt'        => $row['rt'],
                'rw'        => $row['rw'],
                'desa'      => $row['desa'],
                'kecamatan' => $row['kecamatan'],
                'kabupaten' => $row['kabupaten'],
                'provinsi'  => $row['provinsi'],
            ]);
        }
    }
}
