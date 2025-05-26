<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiKeluhanController extends Controller
{
    // Ambil semua keluhan milik user
    public function index()
    {
        $userId = Auth::id();

        $keluhan = Keluhan::with('user')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar keluhan berhasil diambil',
            'data' => $keluhan
        ], 200);
    }

    // Tambah keluhan
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 422);
        }

        $keluhan = Keluhan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id(),
            'status' => 'pending',
        ]);

        // Kirim notifikasi ke semua admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'keluhan',
                "Pengajuan Keluhan oleh {$keluhan->user->name}",
                $keluhan->id,
                Keluhan::class,
                ['judul' => $keluhan->judul]
            );
        }

        return response()->json([
            'success' => true,
            'message' => 'Keluhan berhasil dibuat',
            'data' => $keluhan
        ], 201);
    }

    // Tampilkan detail keluhan milik user
    public function show(Keluhan $keluhan)
    {
        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Akses tidak diizinkan',
                'data' => null
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail keluhan',
            'data' => $keluhan
        ], 200);
    }

    // Update keluhan (judul/isi/status)
    public function update(Request $request, Keluhan $keluhan)
    {
        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan',
                'data' => null
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|string|max:255',
            'isi' => 'sometimes|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 422);
        }

        $keluhan->update($request->only('judul', 'isi'));

        return response()->json([
            'success' => true,
            'message' => 'Keluhan diperbarui',
            'data' => $keluhan
        ]);
    }

    // Hapus keluhan
    public function destroy(Keluhan $keluhan)
    {
        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan menghapus',
                'data' => null
            ], 403);
        }

        $keluhan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Keluhan berhasil dihapus'
        ]);
    }

    // Tanggapi keluhan (ADMIN only)
    public function tanggapi(Request $request, Keluhan $keluhan)
    {
        $request->validate([
            'respon_admin' => 'required|string',
        ]);

        $keluhan->update([
            'status' => 'diproses',
            'respon_admin' => $request->respon_admin,
            'tanggal_diproses' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Keluhan ditanggapi (diproses)',
            'data' => $keluhan
        ]);
    }

    // Tandai selesai
    public function selesai(Keluhan $keluhan)
    {
        $keluhan->update([
            'status' => 'selesai',
            'tanggal_selesai' => now()
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Keluhan diselesaikan',
            'data' => $keluhan
        ]);
    }
}
