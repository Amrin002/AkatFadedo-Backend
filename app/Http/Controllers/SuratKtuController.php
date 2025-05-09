<?php

namespace App\Http\Controllers;

use App\Models\SuratKtu;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuratKtuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Pengguna';
        $halaman = 'Surat Keterang Tempat Usaha';
        $user = $request->user();

        $suratKtu = DB::table('surat_ktus')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('suratktu.index', compact('title', 'halaman', 'user', 'suratKtu'));
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
            'kewarganegaraan' => 'required|string|max:255',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:255',
            'pemilik_usaha' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in: On Progress,Approve,Cancel',
        ]);

        SuratKtu::create([
            'no_surat' => $request->no_surat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'pemilik_usaha' => $request->pemilik_usaha,
            'keterangan' => $request->keterangan,
            'status' => 'On Progress',
        ]);

        return redirect()->route('suratktu.index')->with('success', "Surat Keterangan Tempat Usaha Berhasil di Tambahkan");
    }

    public function exportPdf($id)
    {
        $surat = SuratKtu::findOrFail($id);

        if ($surat->status !== 'Approve') {
            return redirect()->route('suratktu.index')
                ->withErrors(['export_error' => 'Surat belum di-Approve dan tidak bisa diexport.']);
        }

        $tanggal_dikeluarkan = $surat->tanggal_terbit
            ? Carbon::parse($surat->tanggal_terbit)->locale('id')->isoFormat('D MMMM Y')
            : Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        // Tambahkan URL verifikasi
        $verifikasiUrl = route('verifikasi.surat', $surat->verifikasi_token);
        $response = Pdf::loadView('suratktu.pdf', compact('surat', 'tanggal_dikeluarkan', 'verifikasiUrl'))
            ->download('surat-ktu-' . $surat->nama . '.pdf');

        return ($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKtu $suratKtu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKtu $suratKtu)
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
                'kewarganegaraan' => 'required|string|max:255',
                'agama' => 'required|string|max:20',
                'pekerjaan' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
                'nama_usaha' => 'required|string|max:255',
                'jenis_usaha' => 'required|string|max:20',
                'alamat_usaha' => 'required|string|max:255',
                'pemilik_usaha' => 'required|string|max:50',
                'keterangan' => 'nullable|string',
                'status' => 'nullable|in:On Progress,Approve,Cancel',
            ]);
        } catch (Exception $e) {
            Log::error("Gagal Validasi Update SKTU: " . $e->getMessage());
        }

        $suratKtu = SuratKtu::findOrFail($id);

        // Cek status baru
        $statusBaru = $request->status;

        // Jika status diubah menjadi Approve dan no_surat masih kosong, generate otomatis
        $noSurat = $suratKtu->no_surat;

        // Jika status diubah jadi Approve, dan no_surat masih kosong
        if ($statusBaru === 'Approve' && empty($noSurat)) {
            $nomorManual = $request->input('nomor_manual');

            // Jika admin isi nomor manual
            if ($nomorManual) {
                $bulanRomawi = $this->getRomawi(now()->month);
                $tahun = now()->year;
                $jenisSurat = 'SKTU';
                $kodeNegeri = 'NA-AF';

                $noSurat = sprintf('%02d / %s / %s / %s / %d', $nomorManual, $jenisSurat, $kodeNegeri, $bulanRomawi, $tahun);
            }
        }
        if ($statusBaru === 'Cancel') {
            $noSurat = null;
        }

        // Always assign verifikasi_token and tanggal_terbit if status becomes Approve
        if ($statusBaru === 'Approve') {
            if (empty($suratKtu->verifikasi_token)) {
                $suratKtu->verifikasi_token = \Illuminate\Support\Str::uuid(); // Token unik
            }

            // Always set tanggal_terbit to current date if status is Approve
            $suratKtu->tanggal_terbit = now();
        }

        $suratKtu->update([
            'no_surat' => $noSurat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'pemilik_usaha' => $request->pemilik_usaha,
            'keterangan' => $request->keterangan,
            'status' => $statusBaru,
            'verifikasi_token' => $suratKtu->verifikasi_token,
            'tanggal_terbit' => $suratKtu->tanggal_terbit,
        ]);

        // Generate QR code for approved documents
        if ($statusBaru === 'Approve') {
            // Generate verifikasi token and QR code
            $suratKtu->generateVerifikasiToken()
                ->buatQrCode();

            // Get verification URL
            $verifikasiUrl = route('verifikasi.surat', $suratKtu->verifikasi_token);
        }

        return redirect()->route('suratktu.index')->with('success', 'Surat Keterangan Tempat Usaha berhasil diubah');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $suratKtu = SuratKtu::findOrFail($id);
        $suratKtu->delete();
        return redirect()->route('suratktu.index')->with('success', 'Surat Keterangan Tempat Usaha berhasil di hapus');
    }
}
