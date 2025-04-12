<?php

namespace App\Exports;

use App\Models\KK;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class KKExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{

    public function collection()
    {
        return Kk::where('dusun',  '!=', 'admin')->get([
            'no_kk',
            'dusun',
            'rt',
            'rw',
            'desa',
            'kecamatan',
            'kabupaten',
            'provinsi'
        ])->map(function ($item) {
            // Pastikan no_kk tidak diparsing sebagai angka ilmiah
            $item->no_kk = "'" . $item->no_kk; // kasih kutip satu di awal biar jadi string
            return $item;
        });
    }

    public function headings(): array
    {
        return [
            'No KK',
            'Dusun',
            'RT',
            'RW',
            'Desa',
            'Kecamatan',
            'Kabupaten',
            'Provinsi'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [ // Baris pertama (header)
                'font' => ['bold' => true, 'color' => ['rgb' => 'FFFFFF']],
                'fill' => [
                    'fillType' => Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '28A745'], // hijau seperti Bootstrap success
                ],
            ],
        ];
    }
}
