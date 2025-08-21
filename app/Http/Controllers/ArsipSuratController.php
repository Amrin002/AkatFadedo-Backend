<?php

namespace App\Http\Controllers;

use App\Models\ArsipSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ArsipSuratController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Arsip Surat';
        $halaman = 'Daftar Arsip Surat';

        $query = ArsipSurat::with('surat')
            ->orderBy('tanggal_terbit', 'desc');

        // Filter berdasarkan jenis surat
        if ($request->filled('jenis_surat')) {
            $query->jenisSurat($request->jenis_surat);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_terbit', $request->tahun);
        }

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_terbit', $request->bulan);
        }

        // Search berdasarkan nomor surat atau nama pemohon
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('nama_pemohon', 'like', "%{$search}%");
            });
        }

        $arsipSurats = $query->paginate(20)->withQueryString();

        // Data untuk filter
        $jenisSurats = ArsipSurat::getAvailableJenisSurat();
        $tahunList = ArsipSurat::selectRaw('YEAR(tanggal_terbit) as tahun')
            ->distinct()
            ->orderBy('tahun', 'desc')
            ->pluck('tahun');

        // Statistik
        $statistik = ArsipSurat::getStatistik();

        return view('arsip.index', compact(
            'title',
            'halaman',
            'arsipSurats',
            'jenisSurats',
            'tahunList',
            'statistik'
        ));
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
    }
    /**
     * Display the specified resource.
     * ✅ Parameter harus sama dengan route: {arsip}
     */
    public function show(ArsipSurat $arsip)
    {
        $title = 'Detail Arsip';
        $halaman = 'Detail Arsip Surat';

        // Load relasi surat
        $arsip->load('surat');
        return view('arsip.show', compact('title', 'halaman', 'arsip'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArsipSurat $arsipSurat)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     * 
     * ⚠️ BUG FIX: redirect route dan logging
     */
    public function update(Request $request, ArsipSurat $arsip)
    {
        // Validate input
        $request->validate([
            'keterangan' => 'nullable|string|max:1000',
            'status' => 'required|in:Terarsip,Aktif'
        ]);

        // Update arsip
        $arsip->update($request->only(['keterangan', 'status']));

        // Refresh model to get updated data
        $arsip->refresh();

        // Log dengan data yang benar
        Log::info("Arsip surat diperbarui", [
            'arsip_id' => $arsip->id,
            'nomor_surat' => $arsip->nomor_surat,
            'status_lama' => $arsip->getOriginal('status'),
            'status_baru' => $arsip->status,
            'updated_by' => Auth::user()->name
        ]);

        // ✅ FIX: Redirect ke show, bukan index
        return redirect()->route('arsip.show', $arsip->id)
            ->with('success', 'Arsip surat berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArsipSurat $arsip)
    {
        // Hanya admin yang bisa menghapus arsip
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('arsip.index')
                ->with('error', 'Tidak memiliki akses untuk menghapus arsip');
        }

        $nomorSurat = $arsip->nomor_surat;
        $arsip->delete();

        Log::warning("Arsip surat dihapus", [
            'nomor_surat' => $nomorSurat,
            'dihapus_oleh' => Auth::user()->name
        ]);

        return redirect()->route('arsip.index')
            ->with('success', 'Arsip surat berhasil dihapus');
    }

    /**
     * Export arsip ke CSV
     */
    public function exportCsv(Request $request)
    {
        $query = ArsipSurat::orderBy('tanggal_terbit', 'desc');

        // Apply same filters as index
        if ($request->filled('jenis_surat')) {
            $query->jenisSurat($request->jenis_surat);
        }

        if ($request->filled('tahun')) {
            $query->whereYear('tanggal_terbit', $request->tahun);
        }

        if ($request->filled('bulan')) {
            $query->whereMonth('tanggal_terbit', $request->bulan);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('nama_pemohon', 'like', "%{$search}%");
            });
        }

        $arsipSurats = $query->get();

        $filename = 'arsip_surat_' . now()->format('Y-m-d_H-i-s') . '.csv';

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
        ];

        $callback = function () use ($arsipSurats) {
            $file = fopen('php://output', 'w');

            // Header CSV
            fputcsv($file, [
                'No',
                'Nomor Surat',
                'Jenis Surat',
                'Nama Pemohon',
                'Tanggal Terbit',
                'Status',
                'Nomor Urut',
                'Keterangan'
            ]);

            // Data
            foreach ($arsipSurats as $index => $arsip) {
                fputcsv($file, [
                    $index + 1,
                    $arsip->nomor_surat,
                    $arsip->jenis_surat,
                    $arsip->nama_pemohon,
                    $arsip->tanggal_terbit->format('d/m/Y'),
                    $arsip->status,
                    $arsip->nomor_urut,
                    $arsip->keterangan
                ]);
            }

            fclose($file);
        };

        Log::info("Export arsip CSV", [
            'total_records' => $arsipSurats->count(),
            'exported_by' => Auth::user()->name
        ]);

        return response()->stream($callback, 200, $headers);
    }
}
