<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SuratLainnya;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SuratLainnyaApiController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $suratLainnya = SuratLainnya::where('user_id', $user->id)
            ->whereNull('deleted_at')
            ->orderBy('created_at', 'desc')
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Data Surat Berhasil Diambil',
            'data' => $suratLainnya
        ]);
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,docx|max:2048',
            'status' => 'nullable|in:On Progress, Approve, Cancel',
        ]);

        $filePath = $request->file('file')->storeAs('surat_lainnya', $request->file('file')->getClientOriginalName(), 'public');
        $surat = SuratLainnya::create([
            'user_id' => $user->id,
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'file' => $filePath,
            'status' => $request->status ?? 'On Progress',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Surat Berhasil ditambahkan',
            'data' => $surat,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratLainnya::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat Tidak di temukan',
            ], 404);
        }
        if ($surat->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah surat ini',
            ], 403);
        }
        $request->validate([
            'nama' => 'required|string|max:255',
            'keterangan' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,docx|max:2048',
            'status' => 'nullable|in:On Progress, Approve, Cancel',
        ]);
        if ($request->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $request->errors()
            ], 422);
        }
        $filePath = $surat->file; // default ke file lama
        // Jika ada file baru di upload
        if ($request->hasFile('file')) {
            // Hapus file lama jika ada
            if ($surat->file) {
                Storage::disk('public')->delete($surat->file);
            }

            // Simpan file baru dengan nama asli
            $originalFileName = $request->file('file')->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('surat_lainnya', $originalFileName, 'public');
        }

        $surat->update([
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'file' => $filePath,
            'status' => $request->status ?? $surat->status,
        ]);
        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil diperbarui',
            'data' => $surat,
        ]);
    }
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratLainnya::find($id);

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
            'data' => $surat,
        ]);
    }

    /**
     * Hapus surat berdasarkan id, hanya jika milik user
     */
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $surat = SuratLainnya::find($id);

        if (!$surat) {
            return response()->json([
                'success' => false,
                'message' => 'Surat tidak ditemukan',
            ], 404);
        }
        if ($surat->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus surat ini',
            ], 403);
        }

        // Hapus file jika ada
        if ($surat->file) {
            Storage::disk('public')->delete($surat->file);
        }

        $surat->delete();

        return response()->json([
            'success' => true,
            'message' => 'Surat berhasil dihapus',
        ]);
    }
}
