<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratKtm;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;

class SuratKtmApiController extends Controller
{
    // GET /api/surat-ktm
    public function index(Request $request)
    {
        $user = $request->user();
        $surat = SuratKtm::where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data surat berhasil diambil',
            'data' => $surat
        ]);
    }

    // POST /api/surat-ktm
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_kawin' => 'required|in:Belum kawin,Sudah kawin,Cerai',
            'kewarganegaraan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat = SuratKtm::create([
            'user_id' => $user->id,
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

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil diajukan',
            'data' => $surat
        ]);
    }

    // PUT /api/surat-ktm/{id}
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtm::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
            ], 404);
        }

        if ($surat->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah surat ini',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama' => 'required|string|max:255',
            'tempat_lahir' => 'required|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'status_kawin' => 'required|in:Belum kawin,Sudah kawin,Cerai',
            'kewarganegaraan' => 'required|string|max:255',
            'alamat' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat->update([
            'nama' => $request->nama,
            'tempat_lahir' => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'jenis_kelamin' => $request->jenis_kelamin,
            'status_kawin' => $request->status_kawin,
            'kewarganegaraan' => $request->kewarganegaraan,
            'alamat' => $request->alamat,
            'keterangan' => $request->keterangan,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data surat berhasil diperbarui',
            'data' => $surat
        ]);
    }

    // GET /api/surat-ktm/{id}
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtm::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
            ], 404);
        }

        if ($surat->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk melihat surat ini',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail surat ditemukan',
            'data' => $surat
        ]);
    }

    // GET /api/surat-ktm/{id}/export
    public function exportPdf(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtm::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
            ], 404);
        }

        if ($surat->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengunduh surat ini',
            ], 403);
        }

        if ($surat->status !== 'Approve') {
            return response()->json([
                'success' => false,
                'message' => 'Surat belum disetujui',
            ], 403);
        }

        $tanggal_dikeluarkan = $surat->tanggal_terbit
            ? Carbon::parse($surat->tanggal_terbit)->locale('id')->isoFormat('D MMMM Y')
            : Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        // Tambahkan URL verifikasi
        $verifikasiUrl = route('verifikasi.surat', $surat->verifikasi_token);

        $pdf = Pdf::loadView('suratktm.pdf', compact('surat', 'tanggal_dikeluarkan', 'verifikasiUrl'));

        return response()->streamDownload(function () use ($pdf) {
            echo $pdf->output();
        }, "SuratKTM_{$id}.pdf", [
            'Content-Type' => 'application/pdf',
        ]);
    }

    public function getDownloadUrl(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtm::find($id);

        if (!$surat || $surat->user_id !== $user->id || $surat->status !== 'Approve') {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat membuat URL download',
            ], 403);
        }

        // Generate a signed URL that expires in 5 minutes
        $url = URL::temporarySignedRoute(
            'suratktm.download',
            now()->addMinutes(5),
            ['id' => $id, 'token' => $user->id]
        );

        return response()->json([
            'success' => true,
            'download_url' => $url
        ]);
    }

    public function downloadPdf(Request $request, $id, $token)
    {
        // Verifikasi tanda tangan
        if (!$request->hasValidSignature()) {
            abort(401, 'URL tidak valid atau sudah kadaluarsa');
        }

        // Verifikasi bahwa token cocok dengan user ID pemilik
        $surat = SuratKtm::find($id);
        if (!$surat || $surat->user_id != $token || $surat->status !== 'Approve') {
            abort(403, 'Akses ditolak');
        }

        $tanggal_dikeluarkan = $surat->tanggal_terbit
            ? Carbon::parse($surat->tanggal_terbit)->locale('id')->isoFormat('D MMMM Y')
            : Carbon::now()->locale('id')->isoFormat('D MMMM Y');

        // Tambahkan URL verifikasi
        $verifikasiUrl = route('verifikasi.surat', $surat->verifikasi_token);

        $pdf = Pdf::loadView('suratktm.pdf', compact('surat', 'tanggal_dikeluarkan', 'verifikasiUrl'));

        // Set headers untuk pengunduhan PDF
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="SuratKTM_' . $id . '.pdf"',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
            'Pragma' => 'no-cache',
            'Expires' => '0',
        ];

        // Menggunakan stream untuk menghindari masalah dengan file besar
        return response()->stream(function () use ($pdf) {
            echo $pdf->output();
        }, 200, $headers);
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtm::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
            ], 404);
        }

        // Pastikan surat ini milik user yang login
        if ($surat->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus surat ini',
            ], 403);
        }

        $surat->delete(); // Soft delete

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil dihapus',
        ]);
    }
}
