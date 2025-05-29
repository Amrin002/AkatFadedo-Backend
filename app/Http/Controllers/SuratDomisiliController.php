<?php

namespace App\Http\Controllers;

use App\Mail\SuratApprovedMail;
use App\Models\SuratDomisili;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Exception;
use App\Models\Notification;
use Illuminate\Support\Str;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class SuratDomisiliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Pengguna';
        $halaman = 'Surat Domisili';
        $user = $request->user();

        $suratDomisili = DB::table('surat_domisilis')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('suratdomisili.index', compact('title', 'halaman', 'user', 'suratDomisili'));
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
        //
        $request->validate([
            'no_surat' => 'nullable|string|max:100',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_kawin' => 'required|in:Belum kawin,Sudah kawin, Cerai',
            'kewarganegaraan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:225',
            'alamat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in:On Progress,Approve,Cancel',
        ]);

        $surat = SuratDomisili::create([
            'no_surat' => $request->no_surat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'status' => 'On Progress',
        ]);

        // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'surat_domisili',
                "Pengajuan surat Domisili oleh {$surat->nama}",
                $surat->id,
                SuratDomisili::class,
                [
                    'nama' => $surat->nama,
                    'jenis_kelamin' => $surat->jenis_kelamin,
                    'tanggal_lahir' => $surat->tanggal_lahir,
                ]
            );
        }

        return redirect()->route('suratdomisili.index')->with('success', "Surat Domisili Berhasil di Tambahkan");
    }

    public function exportPdf($id)
    {
        $surat = SuratDomisili::findOrFail($id);

        if ($surat->status !== 'Approve') {
            return redirect()->route('suratdomisili.index')
                ->withErrors(['export_error' => 'Surat belum di-Approve dan tidak bisa diexport.']);
        }

        $tanggal_dikeluarkan = $surat->tanggal_terbit
            ? Carbon::parse($surat->tanggal_terbit)->locale('id')->isoFormat('D MMMM Y')
            : Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        // Tambahkan URL verifikasi
        $verifikasiUrl = route('verifikasi.surat', $surat->verifikasi_token);
        $response = Pdf::loadView('suratdomisili.pdf', compact('surat', 'tanggal_dikeluarkan', 'verifikasiUrl'))
            ->download('surat-domisili-' . $surat->nama . '.pdf');

        return ($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratDomisili $suratDomisili)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratDomisili $suratDomisili)
    {
        //

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
                'nama' => 'required|string|max:255',
                'tempat_lahir' => 'required|string|max:255',
                'tanggal_lahir' => 'required|date',
                'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
                'status_kawin' => 'required|in:Belum kawin,Sudah kawin,Cerai',
                'kewarganegaraan' => 'required|string|max:255',
                'pekerjaan' => 'required|string|max:225',
                'alamat' => 'required|string|max:255',
                'keterangan' => 'nullable|string',
                'status' => 'nullable|in:On Progress,Approve,Cancel',
            ]);
        } catch (Exception $e) {
            Log::error("Gagal Validasi Data Domisili: " . $e->getMessage());
            return redirect()->back()->withErrors(['validasi_error' => 'Terjadi kesalahan saat memvalidasi data.']);
        }

        $suratDomisili = SuratDomisili::findOrFail($id);
        $oldStatus = $suratDomisili->status;
        $statusBaru = $request->status;

        // Default values
        $noSurat = $suratDomisili->no_surat;
        $verifikasiToken = $suratDomisili->verifikasi_token;
        $tanggalTerbit = $suratDomisili->tanggal_terbit;
        $qrCode = $suratDomisili->qr_code;
        $nomorManual = '';

        if ($statusBaru === 'Approve' && empty($noSurat) && $request->filled('nomor_manual')) {
            return redirect()->back()->withErrors(['nomor_manual' => 'Nomor manual harus di isi sebelum menyetujui surat'])->withInput();
        }

        // Handle status changes
        if ($statusBaru === 'Approve') {
            // If changing to Approve
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
                        $jenisSurat = 'SKD';
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
            // We keep the verifikasi_token to track history but mark as invalid in verifikasi method
        }

        $suratDomisili->update([
            'no_surat' => $noSurat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'status' => $statusBaru,
            'verifikasi_token' => $verifikasiToken,
            'tanggal_terbit' => $tanggalTerbit,
        ]);
        try {
            // Pastikan relasi user ada
            if ($suratDomisili->user) {
                // Debugging untuk memeriksa type_surat
                Log::info("Type Surat: " . $suratDomisili->type_surat);

                Mail::to($suratDomisili->user->email)->send(new SuratApprovedMail($suratDomisili));
            } else {
                Log::error("User tidak ditemukan untuk surat dengan ID: " . $suratDomisili->id);
            }
        } catch (Exception $e) {
            Log::error("Gagal mengirim email pemberitahuan: " . $e->getMessage());
        }
        // Generate QR code only for approved documents
        if ($statusBaru === 'Approve' && ($oldStatus !== 'Approve' || !$qrCode)) {
            try {
                // Generate QR code
                $suratDomisili->buatQrCode();
            } catch (Exception $e) {
                Log::error("Gagal membuat QR Code: " . $e->getMessage());
                // Continue without failing the whole operation
            }
        }

        return redirect()->route('suratdomisili.index')
            ->with('success', 'Surat Domisili berhasil di ubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $suratDomisili = SuratDomisili::findOrFail($id);
        $suratDomisili->delete();
        return redirect()->route('suratdomisili.index')->with('success', 'Surat Domisili berhasil di hapus');
    }
}
