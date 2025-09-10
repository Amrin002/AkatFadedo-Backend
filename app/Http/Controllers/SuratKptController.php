<?php

namespace App\Http\Controllers;

use App\Mail\SuratApprovedMail;
use App\Models\Notification;
use App\Models\StrukturDesa;
use App\Models\SuratKpt;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use App\Models\ArsipSurat;

class SuratKptController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman Pengguna';
        $halaman = 'Surat Keterangan Penghasilan Tetap';
        $user = $request->user();

        $suratKpt = DB::table('surat_kpts')
            ->orderBy('created_at', 'desc')
            ->get();
            
        return view('suratkpt.index', compact('title', 'halaman', 'user', 'suratKpt'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'no_surat' => 'nullable|string|max:100',
            'nama_yang_bersangkutan' => 'required|string|max:255',
            'nik' => 'required|string|max:16|unique:surat_kpts,nik',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'agama' => 'required|string|max:100',
            'pekerjaan' => 'required|string|max:255',
            'alamat_yang_bersangkutan' => 'required|string|max:255',
            'nama_ayah' => 'required|string|max:255',
            'nama_ibu' => 'required|string|max:255',
            'pekerjaan_orang_tua' => 'required|string|max:255',
            'penghasilan_per_bulan' => 'required|numeric|min:0',
            'keperluan' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in:On Progress,Approve,Cancel',
        ]);
        $kepalaDesa = StrukturDesa::where('posisi', 'LIKE', '%Kepala Desa%')
                        ->orWhere('posisi', 'LIKE', '%Kepala Pemerintah%')
                        ->first();
        $namaDefault = $kepalaDesa ? $kepalaDesa->nama : 'Muhamad Arsad Talahatu';
        $jabatanDefault = $kepalaDesa ? $kepalaDesa->posisi : 'Kepala Desa';

        $surat = SuratKpt::create([
            'no_surat' => $request->no_surat,
            'nama' => $namaDefault,
            'jabatan' => $jabatanDefault,
            'alamat' => "Akat Fadedo",
            'nama_yang_bersangkutan' => $request->nama_yang_bersangkutan,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat_yang_bersangkutan' => $request->alamat_yang_bersangkutan,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_orang_tua' => $request->pekerjaan_orang_tua,
            'penghasilan_per_bulan' => $request->penghasilan_per_bulan,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'status' => 'On Progress',
        ]);

        // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'surat_kpt',
                "Pengajuan surat KPT oleh {$surat->nama_yang_bersangkutan}",
                $surat->id,
                SuratKpt::class,
                [
                    'nama' => $surat->nama_yang_bersangkutan,
                    'nik' => $surat->nik,
                    'penghasilan' => $surat->penghasilan_per_bulan,
                    'keperluan' => $surat->keperluan,
                ]
            );
        }

        return redirect()->route('suratkpt.index')->with('success', "Surat Keterangan Penghasilan Tetap berhasil ditambahkan");
    }

    public function exportPdf($id)
    {
        $surat = SuratKpt::findOrFail($id);

        if ($surat->status !== 'Approve') {
            return redirect()->route('suratkpt.index')
                ->withErrors(['export_error' => 'Surat belum di-Approve dan tidak bisa diexport.']);
        }

        $tanggal_dikeluarkan = $surat->tanggal_terbit
            ? Carbon::parse($surat->tanggal_terbit)->locale('id')->isoFormat('D MMMM Y')
            : Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        // Tambahkan URL verifikasi
        $verifikasiUrl = route('verifikasi.surat', $surat->verifikasi_token);
        $response = Pdf::loadView('suratkpt.pdf', compact('surat', 'tanggal_dikeluarkan', 'verifikasiUrl'))
            ->download('surat-kpt-' . $surat->nama_yang_bersangkutan . '.pdf');

        return $response;
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKpt $suratKpt)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKpt $suratKpt)
    {
        //
    }
    
    // ArsipSurat
    private function buatArsipSurat($surat)
    {
        try {
            // 🎯 HAPUS ARSIP LAMA jika ada (untuk case edit nomor surat)
            $existingArsip = ArsipSurat::where('surat_type', get_class($surat))
                ->where('surat_id', $surat->id)
                ->first();

            if ($existingArsip) {
                Log::info("Menghapus arsip lama untuk update nomor surat", [
                    'arsip_lama_id' => $existingArsip->id,
                    'nomor_lama' => $existingArsip->nomor_surat,
                    'nomor_baru' => $surat->no_surat
                ]);

                $existingArsip->delete();
            }

            // 🎯 BUAT ARSIP BARU dengan nomor yang sudah diupdate
            $arsip = ArsipSurat::buatArsip($surat);

            Log::info("Arsip berhasil dibuat/diperbarui untuk surat KPT", [
                'surat_id' => $surat->id,
                'nomor_surat' => $surat->no_surat,
                'arsip_id' => $arsip->id,
                'nama_pemohon' => $surat->nama_yang_bersangkutan
            ]);

            return $arsip;
        } catch (Exception $e) {
            Log::error("Gagal membuat arsip untuk surat KPT ID: {$surat->id}", [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return null;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    private function getRomawi($bulan)
    {
        $romawi = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];
        return $romawi[intval($bulan)];
    }

    public function update(Request $request, $id)
    {
        try {
            $request->validate([
                'nama_yang_bersangkutan' => 'required|string|max:255',
                'nik' => 'required|string|max:16',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'agama' => 'required|string|max:100',
                'pekerjaan' => 'required|string|max:255',
                'alamat_yang_bersangkutan' => 'required|string|max:255',
                'nama_ayah' => 'required|string|max:255',
                'nama_ibu' => 'required|string|max:255',
                'pekerjaan_orang_tua' => 'required|string|max:255',
                'penghasilan_per_bulan' => 'required|numeric|min:0',
                'keperluan' => 'required|string|max:255',
                'keterangan' => 'nullable|string',
                'status' => 'nullable|in:On Progress,Approve,Cancel',
            ]);
        } catch (Exception $e) {
            Log::error("Gagal Ubah Data: " . $e->getMessage());
            return redirect()->back()->withErrors(['validation_error' => $e->getMessage()])->withInput();
        }

        $suratKpt = SuratKpt::findOrFail($id);
        $oldStatus = $suratKpt->status;
        $statusBaru = $request->status;

        // Default values
        $noSurat = $suratKpt->no_surat;
        $verifikasiToken = $suratKpt->verifikasi_token;
        $tanggalTerbit = $suratKpt->tanggal_terbit;
        $qrCode = $suratKpt->qr_code;
        $nomorManual = '';

        // Handle status changes
        // Tambahkan validasi manual ketika status di-Approve dan nomor surat kosong
        if ($statusBaru === 'Approve' && empty($suratKpt->no_surat) && !$request->filled('nomor_manual')) {
            return redirect()->back()->withErrors(['nomor_manual' => 'Nomor manual wajib diisi jika status disetujui dan nomor surat belum tersedia.'])->withInput();
        }

        if ($statusBaru === 'Approve') {
            if ($oldStatus !== 'Approve') {
                // Generate new verification token for new approvals or re-approvals
                $verifikasiToken = Str::uuid();
                $tanggalTerbit = now();

                // Generate number if empty
                if (empty($noSurat)) {
                    $nomorManual = $request->input('nomor_manual');

                    if ($nomorManual) {
                        $bulanRomawi = $this->getRomawi(now()->month);
                        $tahun = now()->year;
                        $jenisSurat = 'SKPT';
                        $kodeNegeri = 'NA-AF';

                        $noSurat = sprintf(
                            '%02d / %s / %s / %s / %d',
                            $nomorManual,
                            $jenisSurat,
                            $kodeNegeri,
                            $bulanRomawi,
                            $tahun
                        );
                    }
                }
            }
        } elseif ($statusBaru === 'Cancel') {
            // If canceling, invalidate verification data but keep history
            $noSurat = null;
            // 🎯 HAPUS ARSIP jika ada (karena surat di-cancel)
            $existingArsip = ArsipSurat::where('surat_type', get_class($suratKpt))
                ->where('surat_id', $suratKpt->id)
                ->first();

            if ($existingArsip) {
                Log::info("Menghapus arsip karena surat di-cancel", [
                    'arsip_id' => $existingArsip->id,
                    'nomor_surat' => $existingArsip->nomor_surat,
                    'surat_id' => $suratKpt->id
                ]);

                $existingArsip->delete();
            }
        }

        // Ambil data kepala desa dari struktur desa
        $kepalaDesa = StrukturDesa::where('posisi', 'LIKE', '%Kepala Desa%')
                                 ->orWhere('posisi', 'LIKE', '%Kepala Pemerintah%')
                                 ->first();
        
        // Set default values
        $namaDefault = $kepalaDesa ? $kepalaDesa->nama : 'Muhamad Arsad Talahatu';
        $jabatanDefault = $kepalaDesa ? $kepalaDesa->posisi : 'Kepala Desa';
        $alamatDefault = 'Akat Fadedo';

        // Update the document
        $suratKpt->update([
            'no_surat' => $noSurat,
            'nama' =>  $namaDefault,
            'jabatan' => $jabatanDefault,
            'alamat' => $alamatDefault,
            'nama_yang_bersangkutan' => $request->nama_yang_bersangkutan,
            'nik' => $request->nik,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat_yang_bersangkutan' => $request->alamat_yang_bersangkutan,
            'nama_ayah' => $request->nama_ayah,
            'nama_ibu' => $request->nama_ibu,
            'pekerjaan_orang_tua' => $request->pekerjaan_orang_tua,
            'penghasilan_per_bulan' => $request->penghasilan_per_bulan,
            'keperluan' => $request->keperluan,
            'keterangan' => $request->keterangan,
            'status' => $statusBaru,
            'verifikasi_token' => $verifikasiToken,
            'tanggal_terbit' => $tanggalTerbit,
        ]);
        
        // 🎯 IMPLEMENTASI ARSIP - Generate arsip otomatis ketika status menjadi Approve
        if ($statusBaru === 'Approve' && $noSurat && ($oldStatus !== 'Approve')) {
            $this->buatArsipSurat($suratKpt);
        }

        try {
            // Pastikan relasi user ada
            if ($suratKpt->user) {
                Mail::to($suratKpt->user->email)->send(new SuratApprovedMail($suratKpt));
            } else {
                Log::error("User tidak ditemukan untuk surat dengan ID: " . $suratKpt->id);
            }
        } catch (Exception $e) {
            Log::error("Gagal mengirim email pemberitahuan: " . $e->getMessage());
        }

        // Generate QR code only for approved documents
        if ($statusBaru === 'Approve' && ($oldStatus !== 'Approve' || !$qrCode)) {
            try {
                // Generate QR code
                $suratKpt->buatQrCode();
            } catch (Exception $e) {
                Log::error("Gagal membuat QR Code: " . $e->getMessage());
                // Continue without failing the whole operation
            }
        }

        return redirect()->route('suratkpt.index')
            ->with('success', 'Surat Keterangan Penghasilan Tetap berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $suratKpt = SuratKpt::findOrFail($id);
        $suratKpt->delete();
        return redirect()->route('suratkpt.index')->with('success', 'Surat Keterangan Penghasilan Tetap berhasil dihapus');
    }
}