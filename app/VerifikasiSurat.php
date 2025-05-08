<?php

namespace App;

use App\Models\SuratVerifikasi;
use Illuminate\Support\Str;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

trait VerifikasiSurat
{
    public function generateVerifikasiToken()
    {
        $this->verifikasi_token = Str::random(20);
        $this->save();
        return $this;
    }
    public function buatQrCode($routeName = 'verifikasi.surat')
    {
        // Lokasi lengkap penyimpanan QR Code
        $folderPath = public_path('storage/qrcodes');

        // Buat folder jika belum ada
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0755, true); // 0755 = permission, true = recursive
        }

        // Nama file QR Code
        $qrCodeFileName = class_basename($this) . '_' . $this->id . '.svg';

        // Path untuk menyimpan file
        $qrCodePath = 'storage/qrcodes/' . $qrCodeFileName;
        $fullPath = public_path($qrCodePath);

        // Generate dan simpan QR Code
        QrCode::format('svg')
            ->size(300)
            ->generate(
                route($routeName, $this->verifikasi_token),
                $fullPath
            );

        // Simpan path QR Code ke model
        $this->qr_code = $qrCodePath;
        $this->save();

        return $this;
    }


    public static function verifikasi($token)
    {
        // Cari surat dengan token yang diberikan
        $surat = self::where('verifikasi_token', $token)->first();

        // Jika surat tidak ditemukan, kembalikan null
        if (!$surat) {
            return null;
        }

        // Pastikan tanggal_terbit tidak null
        $tanggalTerbit = $surat->tanggal_terbit ?? now();

        // Cek nomor surat
        $nomorSurat = $surat->no_surat ?? $surat->nomor_surat;

        // Cek apakah verifikasi untuk nomor surat ini sudah ada
        $existingVerifikasi = SuratVerifikasi::where('nomor_surat', $nomorSurat)->first();

        if ($existingVerifikasi) {
            // Jika sudah ada verifikasi dengan nomor surat yang sama, kembalikan yang sudah ada
            return $existingVerifikasi;
        }

        // Buat record verifikasi baru jika belum ada
        $verifikasi = SuratVerifikasi::create([
            'type_surat' => $surat->type_surat ?? class_basename(self::class),
            'nama_pemohon' => $surat->nama ?? 'Tidak Diketahui',
            'nomor_surat' => $nomorSurat,
            'tanggal_terbit' => $tanggalTerbit,
            'nama_pejabat' => 'Nama Pejabat',
            'nip' => 'NIP 123321123',
            'jabatan' => 'Pejabat Desa',
            'status' => 'TERVERIFIKASI'
        ]);

        return $verifikasi;
    }
}
