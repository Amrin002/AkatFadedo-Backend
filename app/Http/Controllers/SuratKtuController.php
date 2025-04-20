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

        $tanggal_dikeluarkan = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        return Pdf::loadView('suratktu.pdf', compact('surat', 'tanggal_dikeluarkan'))
            ->download('surat-ktu-' . $surat->nama . '.pdf');
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
                'status' => 'nullable|in:On Progress,Approve,Cancel',
            ]);
        } catch (Exception $e) {
            Log::error("Gagal Validasi Update SKTU: " . $e->getMessage());
        }

        $suratKtu = SuratKtu::findOrFail($id);
        $statusBaru = $request->status;
        $noSurat = $suratKtu->no_surat;

        // Auto-generate nomor surat jika status Approve dan belum ada no_surat
        if ($statusBaru === 'Approve' && empty($noSurat)) {
            $count = SuratKtu::where('status', 'Approve')
                ->whereYear('created_at', now()->year)
                ->count() + 1;

            $bulanRomawi = $this->getRomawi(now()->month);
            $tahun = now()->year;
            $jenisSurat = 'SKTU';
            $kodeDesa = 'NA-AF'; // Ganti sesuai kode desamu

            $noSurat = sprintf('%02d / %s / %s / %s / %d', $count, $jenisSurat, $kodeDesa, $bulanRomawi, $tahun);
        }
        if ($statusBaru === 'Cancel') {
            $noSurat = null;
        }

        $suratKtu->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'agama' => $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'no_surat' => $noSurat,
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'pemilik_usaha' => $request->pemilik_usaha,
            'keterangan' => $request->keterangan,
            'status' => $statusBaru,
        ]);

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
