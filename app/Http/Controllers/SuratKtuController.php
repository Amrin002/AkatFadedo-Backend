<?php

namespace App\Http\Controllers;

use App\Models\SuratKtu;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

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

        $suratKtu = DB::table('surat_ktus')->whereNull('deleted_at')->get();
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
            'agama'=> 'required|string|max:20',
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
            'agama'=> $request->agama,
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
    public function update(Request $request, $id)
    {
        //
        $request->validate([
            'no_surat' => 'nullable|string|max:100',
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'kewarganegaraan' => 'required|string|max:255',
            'agama'=> 'required|string|max:20',
            'pekerjaan' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:255',
            'pemilik_usaha' => 'required|string|max:50',
            'keterangan' => 'nullable|string',
            'status' => 'nullable|in:On Progress,Approve,Cancel',
        ]);
        // Validasi tambahan: jika status ingin di-Approve tapi no_surat kosong
        if ($request->status === 'Approve' && empty($request->no_surat)) {
            return redirect()->route('suratktu.index')
                ->withErrors(['no_surat_required' => 'Tidak dapat mengubah status Approve surat tanpa nomor surat.']);
        }
        $suratKtu = SuratKtu::findOrFail($id);
        $suratKtu->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'agama'=> $request->agama,
            'pekerjaan' => $request->pekerjaan,
            'alamat' => $request->alamat,
            'no_surat' => $request->no_surat,
            'nama_usaha' => $request->nama_usaha,
            'jenis_usaha' => $request->jenis_usaha,
            'alamat_usaha' => $request->alamat_usaha,
            'pemilik_usaha' => $request->pemilik_usaha,
            'keterangan' => $request->keterangan,
            'status' => $request->status,
        ]);

        return redirect()->route('suratktu.index')->with('success', 'Surat Keterangan Tempat Usaha berhasil di ubah');
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
