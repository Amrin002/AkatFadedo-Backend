<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratPindah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class SuratPindahApiController extends Controller
{
    // GET /api/surat-pindah
    public function index(Request $request)
    {
        $user = $request->user();
        $surat = SuratPindah::where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data surat berhasil diambil',
            'data' => $surat
        ]);
    }

    // POST /api/surat-pindah
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
            'pekerjaan' => 'required|string|max:20',
            'alamat' => 'required|string|max:255',
            'kecamatan'=> 'required|string|max:255',
            'kabupaten'=> 'required|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        $surat = SuratPindah::create([
            'user_id' => $user->id,
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
            'keterangan' => $request->keterangan,
            'status' => 'On Progress',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil diajukan',
            'data' => $surat
        ]);
    }

    // GET /api/surat-ktu/{id}
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratPindah::find($id);

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

    // GET /api/surat-pindah/{id}/export
    public function exportPdf(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratPindah::find($id);

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

        return $pdf->download('surat-pindah-' . $surat->nama . '.pdf');
    }

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratPindah::find($id);

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
