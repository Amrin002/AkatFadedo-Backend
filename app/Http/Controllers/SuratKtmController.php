<?php

namespace App\Http\Controllers;

use App\Models\SuratKtm;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        $suratKtm = DB::table('surat_ktms')->whereNull('deleted_at')->get();
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
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'status_kawin' => 'required|in:belum_kawin,sudah_kawin,cerai',
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

        return Pdf::loadView('suratktm.pdf', compact('surat', 'tanggal_dikeluarkan'))
            ->download('surat-ktm-' . $surat->nama . '.pdf');
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
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'no_surat' => 'nullable|string|max:100',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:laki,perempuan',
            'status_kawin' => 'required|in:belum_kawin,sudah_kawin,cerai',
            'kewarganegaraan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in:On Progress,Approve,Cancel',
        ]);
        // Validasi tambahan: jika status ingin di-Approve tapi no_surat kosong
        if ($request->status === 'Approve' && empty($request->no_surat)) {
            return redirect()->route('suratktm.index')
                ->withErrors(['no_surat_required' => 'Tidak dapat mengubah status Approve surat tanpa nomor surat.']);
        }
        $suratKtm = SuratKtm::findOrFail($id);
        $suratKtm->update([
            'no_surat' => $request->no_surat,
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
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
