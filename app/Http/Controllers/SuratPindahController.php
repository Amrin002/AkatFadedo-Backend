<?php

namespace App\Http\Controllers;

use App\Models\SuratPindah;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SuratPindahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $title = 'Halaman Pengguna';
        $halaman = 'Surat Keterangan Pindah Domisili';
        $user = $request->user();

        $suratPindah = DB::table('surat_pindahs')
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return view('suratpindah.index', compact('title', 'halaman', 'user', 'suratPindah'));
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
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_kawin' => 'required|in:Belum kawin,Sudah kawin,Cerai',
            'kewarganegaraan' => 'required|string|max:255',
            'pekerjaan' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'kecamatan'=> 'required|string|max:255',
            'kabupaten'=> 'required|string|max:255',
            'desa_pindah' => 'required|string|max:255',
            'rt' => 'required|string|max:20',
            'rw' => 'required|string|max:20',
            'jalan' => 'required|string|max:255',
            'kecamatan_pindah' => 'required|string|max:255',
            'kabupaten_pindah' => 'required|string|max:255',
            'provinsi' => 'required|string|max:255',
            'keterangan' => 'required|string',
            'status' => 'required|in: On Progress,Approve,Cancel',
        ]);

        SuratPindah::create([
            'no_surat' => $request->no_surat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin'=> $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'kecamatan'=> $request->kecamatan,
            'kabupaten'=> $request->kabupaten,
            'desa_pindah'=> $request->desa_pindah,
            'rt'=> $request->rt,
            'rw'=> $request->rw,
            'jalan'=> $request->jalan,
            'kecamatan_pindah'=> $request->kecamatan_pindah,
            'kabupaten_pindah'=> $request->kabupaten_pindah,
            'provinsi'=> $request->provinsi,
            'keterangan' => $request->keterangan,
            'status' => 'On Progress',
        ]);

        return redirect()->route('suratpindah.index')->with('success', "Surat Keterangan Pindah Domisili Berhasil di Tambahkan");
    }

    public function exportPdf($id)
    {
        $surat = SuratPindah::findOrFail($id);

        if ($surat->status !== 'Approve') {
            return redirect()->route('suratpindah.index')
                ->withErrors(['export_error' => 'Surat belum di-Approve dan tidak bisa diexport.']);
        }

        $tanggal_dikeluarkan = Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        $response = Pdf::loadView('suratpindah.pdf', compact('surat', 'tanggal_dikeluarkan'))
            ->download('surat-pindah-' . $surat->nama . '.pdf');

        return ($response);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuratPindah $suratPindah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratPindah $suratPindah)
    {
        //
    }

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

    /**
     * Update the specified resource in storage.
     */
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
                'pekerjaan' => 'required|string|max:20',
                'alamat' => 'required|string|max:255',
                'kecamatan'=> 'required|string|max:255',
                'kabupaten'=> 'required|string|max:255',
                'desa_pindah' => 'required|string|max:255',
                'rt' => 'required|string|max:20',
                'rw' => 'required|string|max:20',
                'jalan' => 'required|string|max:255',
                'kecamatan_pindah' => 'required|string|max:255',
                'kabupaten_pindah' => 'required|string|max:255',
                'provinsi' => 'required|string|max:255',
                'keterangan' => 'required|string',
                'status' => 'required|in:On Progress,Approve,Cancel',
            ]);
        } catch (Exception $e) {
            Log::error("Gagal Ubah Data: " . $e->getMessage());
        }

        $suratPindah = SuratPindah::findOrFail($id);

        // Cek status baru
        $statusBaru = $request->status;

        // Jika status diubah menjadi Approve dan no_surat masih kosong, generate otomatis
        $noSurat = $suratPindah->no_surat;

        // Jika status diubah jadi Approve, dan no_surat masih kosong
        if ($statusBaru === 'Approve' && empty($noSurat)) {
            $nomorManual = $request->input('nomor_manual');

            // Jika admin isi nomor manual
            if ($nomorManual) {
                $bulanRomawi = $this->getRomawi(now()->month);
                $tahun = now()->year;
                $jenisSurat = 'SKPD';
                $kodeNegeri = 'NA-AF';

                $noSurat = sprintf('%02d / %s / %s / %s / %d', $nomorManual, $jenisSurat, $kodeNegeri, $bulanRomawi, $tahun);
            }
        }
        if ($statusBaru === 'Cancel') {
            $noSurat = null;
        }

        $suratPindah->update([
            'no_surat' => $noSurat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin'=> $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'kecamatan'=> $request->kecamatan,
            'kabupaten'=> $request->kabupaten,
            'desa_pindah'=> $request->desa_pindah,
            'rt'=> $request->rt,
            'rw'=> $request->rw,
            'jalan'=> $request->jalan,
            'kecamatan_pindah'=> $request->kecamatan_pindah,
            'kabupaten_pindah'=> $request->kabupaten_pindah,
            'provinsi'=> $request->provinsi,
            'keterangan' => $request->keterangan,
            'status' => $statusBaru,
        ]);

        return redirect()->route('suratpindah.index')->with('success', 'Surat Keteranan Pindah Domisili berhasil di ubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $suratPindah = SuratPindah::findOrFail($id);
        $suratPindah->delete();
        return redirect()->route('suratpindah.index')->with('success', 'Surat Keterangan Pindah Domisili berhasil di hapus');
    }
}
