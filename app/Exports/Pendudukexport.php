<?php

namespace App\Exports;

use App\Models\Penduduk;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PendudukExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize
{
    /**
     * Ambil data yang akan diekspor ke Excel
     */
    public function collection()
    {
        return Penduduk::where('status', '!=', 'Admin')
            ->select([
                'nik',
                'no_kk',
                'nama_lengkap',
                'tempat_lahir',
                'tanggal_lahir',
                'jenis_kelamin',
                'agama',
                'pendidikan',
                'pekerjaan',
                'status',
                'status_keluarga',
                'golongan_darah',
                'kewarganegaraan',
                'nama_ayah',
                'nama_ibu',
                'email',
                'no_hp',
            ])
            ->get()
            ->map(function ($item) {
                return [
                    'nik' => "'" . $item->nik, // agar tidak diubah ke format numerik oleh Excel
                    'no_kk' => "'" . $item->no_kk,
                    'nama_lengkap' => $item->nama_lengkap,
                    'tempat_lahir' => $item->tempat_lahir,
                    'tanggal_lahir' => $item->tanggal_lahir,
                    'jenis_kelamin' => $item->jenis_kelamin,
                    'agama' => $item->agama,
                    'pendidikan' => $item->pendidikan,
                    'pekerjaan' => $item->pekerjaan,
                    'status' => $item->status,
                    'status_keluarga' => $item->status_keluarga,
                    'golongan_darah' => $item->golongan_darah,
                    'kewarganegaraan' => $item->kewarganegaraan,
                    'nama_ayah' => $item->nama_ayah,
                    'nama_ibu' => $item->nama_ibu,
                    'email' => $item->email,
                    'no_hp' => $item->no_hp,
                ];
            });
    }

    /**
     * Judul kolom
     */
    public function headings(): array
    {
        return [
            'NIK',
            'No KK',
            'Nama Lengkap',
            'Tempat Lahir',
            'Tanggal Lahir',
            'Jenis Kelamin',
            'Agama',
            'Pendidikan',
            'Pekerjaan',
            'Status',
            'Status Keluarga',
            'Golongan Darah',
            'Kewarganegaraan',
            'Nama Ayah',
            'Nama Ibu',
            'Email',
            'No HP',
        ];
    }

    /**
     * Styling untuk sheet Excel
     */
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
