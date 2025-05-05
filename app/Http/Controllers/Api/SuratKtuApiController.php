<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratKtu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\URL;


class SuratKtuApiController extends Controller
{
    // GET /api/surat-ktu
    public function index(Request $request)
    {
        $user = $request->user();
        $surat = SuratKtu::where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data surat berhasil diambil',
            'data' => $surat
        ]);
    }

    // POST /api/surat-ktu
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
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
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat = SuratKtu::create([
            'user_id' => $user->id,
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

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil diajukan',
            'data' => $surat
        ]);
    }

    // PUT /api/surat-ktu/{id}
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtu::find($id);

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
            'kewarganegaraan' => 'required|string|max:255',
            'agama' => 'required|string|max:20',
            'pekerjaan' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'nama_usaha' => 'required|string|max:255',
            'jenis_usaha' => 'required|string|max:20',
            'alamat_usaha' => 'required|string|max:255',
            'pemilik_usaha' => 'required|string|max:50',
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
            'user_id' => $user->id,
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
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Data surat berhasil diperbarui',
            'data' => $surat
        ]);
    }

    // GET /api/surat-ktu/{id}
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtu::find($id);

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

    // GET /api/surat-ktu/{id}/export
    public function exportPdf(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtu::find($id);

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

        $tanggal_dikeluarkan = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
        $pdf = Pdf::loadView('suratktu.pdf', compact('surat', 'tanggal_dikeluarkan'));

        return $pdf->download('surat-ktu-' . $surat->nama . '.pdf');
    }

    public function getDownloadUrl(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratKtu::find($id);

        if (!$surat || $surat->user_id !== $user->id || $surat->status !== 'Approve') {
            return response()->json([
                'success' => false,
                'message' => 'Tidak dapat membuat URL download',
            ], 403);
        }

        // Generate a signed URL that expires in 5 minutes
        $url = URL::temporarySignedRoute(
            'suratktu.download',
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
        $surat = SuratKtu::find($id);
        if (!$surat || $surat->user_id != $token || $surat->status !== 'Approve') {
            abort(403, 'Akses ditolak');
        }

        $tanggal_dikeluarkan = Carbon::now()->locale('id')->isoFormat('D MMMM Y');
        $pdf = Pdf::loadView('suratktu.pdf', compact('surat', 'tanggal_dikeluarkan'));

        // Set headers untuk pengunduhan PDF
        $headers = [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="SuratKTU_' . $id . '.pdf"',
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
        $surat = SuratKtu::find($id);

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
