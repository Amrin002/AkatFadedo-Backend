<?php

namespace App\Http\Controllers;

use App\Models\SuratDomisili;
use App\Models\SuratKpt;
use App\Models\SuratKtm;
use App\Models\SuratPindah;
use App\Models\SuratKtu;
use App\Models\SuratVerifikasi;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class SuratVerifikasiController extends Controller
{
    /**
     * Verifikasi surat berdasarkan token
     */
    public function verifikasi($token)
    {
        // Coba verifikasi untuk berbagai model surat
        $modelClasses = [
            SuratKtm::class,
            SuratPindah::class,
            SuratKtu::class,
            SuratDomisili::class,
            SuratKpt::class,
            // Tambahkan model surat lain di sini nanti
        ];

        foreach ($modelClasses as $modelClass) {
            try {
                // Check if model has the verifikasiSurat trait and verifikasi_token column
                if (method_exists($modelClass, 'verifikasi')) {
                    $verifikasi = $modelClass::verifikasi($token);

                    if ($verifikasi) {
                        return view('verifikasi.detail', compact('verifikasi'));
                    }
                }
            } catch (\Exception $e) {
                // Log error and continue with next model
                Log::error("Error verifying token with {$modelClass}: " . $e->getMessage());
                continue;
            }
        }

        // Jika token tidak valid di semua model
        return view('verifikasi.tidak-valid');
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SuratVerifikasi::query();
        $title = 'Halaman Riwayat Verifikasi Surat';

        // Apply filters if they exist
        if ($request->filled('type_surat')) {
            $query->where('type_surat', $request->type_surat);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nomor_surat', 'like', "%{$search}%")
                    ->orWhere('nama_pemohon', 'like', "%{$search}%");
            });
        }

        $suratVerifikasi = $query->orderBy('created_at', 'desc')->get();

        // Tambahkan token untuk setiap surat
        $suratVerifikasi->transform(function ($item) {
            $modelMap = [
                'SKTM' => SuratKtm::class,
                'SKTU' => SuratKtu::class,
                'DOMISILI' => SuratDomisili::class,
                'PINDAH' => SuratPindah::class,
                'KPT' => SuratKpt::class
            ];

            $token = 'Tidak ada';
            try {
                if (isset($modelMap[$item->type_surat])) {
                    $surat = $modelMap[$item->type_surat]
                        ::where('no_surat', $item->nomor_surat)
                        ->orWhere('nomor_surat', $item->nomor_surat)
                        ->first();

                    $token = $surat ? $surat->verifikasi_token : 'Tidak ada';
                }
            } catch (\Exception $e) {
                Log::error('Error fetching verification token: ' . $e->getMessage());
                $token = 'Error';
            }

            // Tambahkan token ke item
            $item->verifikasi_token = $token;
            return $item;
        });

        // Ensure dates are Carbon instances
        $suratVerifikasi->transform(function ($item) {
            // Convert tanggal_terbit to Carbon if it's not already
            if (!($item->tanggal_terbit instanceof Carbon) && $item->tanggal_terbit) {
                try {
                    $item->tanggal_terbit = Carbon::parse($item->tanggal_terbit);
                } catch (\Exception $e) {
                    // Keep as is if parsing fails
                }
            }

            // created_at should be automatically handled by Eloquent, but just to be safe
            if (!($item->created_at instanceof Carbon) && $item->created_at) {
                try {
                    $item->created_at = Carbon::parse($item->created_at);
                } catch (\Exception $e) {
                    // Keep as is if parsing fails
                }
            }

            return $item;
        });

        return view('verifikasi.index', compact('suratVerifikasi', 'title'));
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
     */
    public function show(SuratVerifikasi $suratVerifikasi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuratVerifikasi $suratVerifikasi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuratVerifikasi $suratVerifikasi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $verifikasi = SuratVerifikasi::findOrFail($id);
        $verifikasi->delete();

        return redirect()->route('verifikasi.index')
            ->with('success', 'Riwayat verifikasi berhasil dihapus');
    }
}
