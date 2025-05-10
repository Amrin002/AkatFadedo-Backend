<?php

namespace App;

use App\Models\SuratVerifikasi;
use Illuminate\Support\Facades\Log;
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
        // Find document with given token
        $model = self::class;

        // Check if the model has verifikasi_token column
        if (!in_array('verifikasi_token', (new $model)->getFillable())) {
            Log::error("Model {$model} does not have verifikasi_token column");
            return null;
        }

        // Find the document
        $surat = self::where('verifikasi_token', $token)->first();

        // If document not found, return null
        if (!$surat) {
            return null;
        }

        // Get document number
        $nomorSurat = $surat->no_surat ?? $surat->nomor_surat ?? null;

        // Create verification result
        $verifikasi = new SuratVerifikasi();
        $verifikasi->type_surat = class_basename(self::class);
        $verifikasi->nama_pemohon = $surat->nama ?? 'Tidak Diketahui';
        $verifikasi->nomor_surat = $nomorSurat;
        $verifikasi->tanggal_terbit = $surat->tanggal_terbit ?? now();
        $verifikasi->nama_pejabat = 'Nama Pejabat';
        $verifikasi->nip = 'NIP 123321123';
        $verifikasi->jabatan = 'Pejabat Desa';

        // Set status based on document status
        if ($surat->status === 'Approve' && !empty($nomorSurat)) {
            $verifikasi->status = 'TERVERIFIKASI';

            // Check if verification record already exists for this document number
            $existingVerifikasi = SuratVerifikasi::where('nomor_surat', $nomorSurat)->first();

            if (!$existingVerifikasi) {
                // Save new verification record
                $verifikasi->save();
            } else {
                // Return existing record with updated status
                $existingVerifikasi->status = 'TERVERIFIKASI';
                $existingVerifikasi->save();
                return $existingVerifikasi;
            }
        } else {
            // Document is not approved or has no number, mark as not valid
            $verifikasi->status = 'TIDAK VALID';
            // Don't save to database, just return for display
        }

        return $verifikasi;
    }
}
