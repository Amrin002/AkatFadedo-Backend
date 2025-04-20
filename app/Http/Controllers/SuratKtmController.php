<?php

namespace App\Http\Controllers;

use App\Models\SuratKtm;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuratKtmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Pengguna';
        $halaman = 'Surat Keterang Orang Tua Tidak Mampu';
        $user = $request->user();

        $suratKtm = DB::table('surat_ktms')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('suratktm.index', compact('title', 'halaman', 'user', 'suratKtm'));
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
            'status_kawin' => 'required|in:Belum kawin,Sudah kawin,Cerai',
            'kewarganegaraan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in: On Progress,Approve,Cancel',
        ]);

        SuratKtm::create([
            'no_surat' => $request->no_surat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'status' => 'On Progress',
        ]);

        return redirect()->route('suratktm.index')->with('success', "Surat Keterangan Tidak Mampu Berhasil di Tambahkan");
    }

    public function exportPdf($id)
    {
        $surat = SuratKtm::findOrFail($id);

        if ($surat->status !== 'Approve') {
            return redirect()->route('suratktm.index')
                ->withErrors(['export_error' => 'Surat belum di-Approve dan tidak bisa diexport.']);
        }

        $tanggal_dikeluarkan = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $response = Pdf::loadView('suratktm.pdf', compact('surat', 'tanggal_dikeluarkan'))
            ->download('surat-ktm-' . $surat->nama . '.pdf');

        return ($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratKtm $suratKtm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratKtm $suratKtm)
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
                'alamat' => 'required|string|max:255',
                'keterangan' => 'nullable|string',
                'status' => 'nullable|in:On Progress,Approve,Cancel',
            ]);
        } catch (Exception $e) {
            Log::error("Gagal Ubah Data: " . $e->getMessage());
        }

        $suratKtm = SuratKtm::findOrFail($id);

        // Cek status baru
        $statusBaru = $request->status;

        // Jika status diubah menjadi Approve dan no_surat masih kosong, generate otomatis
        $noSurat = $suratKtm->no_surat;
        if ($statusBaru === 'Approve' && empty($noSurat)) {
            $count = SuratKtm::where('status', 'Approve')
                ->whereYear('created_at', now()->year)
                ->count() + 1;

            $bulanRomawi = $this->getRomawi(now()->month);
            $tahun = now()->year;
            $jenisSurat = 'SKTM';
            $kodeNegeri = 'NA-AF';

            $noSurat = sprintf('%02d / %s / %s / %s / %d', $count, $jenisSurat, $kodeNegeri, $bulanRomawi, $tahun);
        }
        // Jika status diubah menjadi Cancel, hapus no_surat
        if ($statusBaru === 'Cancel') {
            $noSurat = null;
        }


        $suratKtm->update([
            'no_surat' => $noSurat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'status' => $statusBaru,
        ]);

        return redirect()->route('suratktm.index')->with('success', 'Surat Keterangan Tidak Mampu berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $suratKtm = SuratKtm::findOrFail($id);
        $suratKtm->delete();
        return redirect()->route('suratktm.index')->with('success', 'Surat Keterangan Tidak Mampu berhasil di hapus');
    }
}
