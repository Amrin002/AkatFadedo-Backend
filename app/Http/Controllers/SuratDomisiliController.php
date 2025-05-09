<?php

namespace App\Http\Controllers;

use App\Models\SuratDomisili;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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

        SuratDomisili::create([
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
        } catch (\Exception $e) {
            Log::error("Gagal Validasi Data Domisili: " . $e->getMessage());
            return redirect()->back()->withErrors(['validasi_error' => 'Terjadi kesalahan saat memvalidasi data.']);
        }

        $suratDomisili = SuratDomisili::findOrFail($id);
        // Cek status baru
        $statusBaru = $request->status;

        // Jika status diubah menjadi Approve dan no_surat masih kosong, generate otomatis
        $noSurat = $suratDomisili->no_surat;

        // Jika status diubah jadi Approve, dan no_surat masih kosong
        if ($statusBaru === 'Approve' && empty($noSurat)) {
            $nomorManual = $request->input('nomor_manual');

            // Jika admin isi nomor manual
            if ($nomorManual) {
                $bulanRomawi = $this->getRomawi(now()->month);
                $tahun = now()->year;
                $jenisSurat = 'SKD';
                $kodeNegeri = 'NA-AF';

                $noSurat = sprintf('%02d / %s / %s / %s / %d', $nomorManual, $jenisSurat, $kodeNegeri, $bulanRomawi, $tahun);
            }
        }
        if ($statusBaru === 'Cancel') {
            $noSurat = null;
        }

        // Always assign verifikasi_token and tanggal_terbit if status becomes Approve
        if ($statusBaru === 'Approve') {
            if (empty($suratDomisili->verifikasi_token)) {
                $suratDomisili->verifikasi_token = \Illuminate\Support\Str::uuid(); // Token unik
            }

            // Always set tanggal_terbit to current date if status is Approve
            $suratDomisili->tanggal_terbit = now();
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
            'verifikasi_token' => $suratDomisili->verifikasi_token,
            'tanggal_terbit' => $suratDomisili->tanggal_terbit,
        ]);

        // Generate QR code for approved documents
        if ($statusBaru === 'Approve') {
            // Generate verifikasi token and QR code
            $suratDomisili->generateVerifikasiToken()
                ->buatQrCode();

            // Get verification URL
            $verifikasiUrl = route('verifikasi.surat', $suratDomisili->verifikasi_token);
        }

        return redirect()->route('suratdomisili.index')->with('success', 'Surat Domisili berhasil diubah');
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
