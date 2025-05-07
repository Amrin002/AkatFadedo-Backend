<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ApiKeluhanController extends Controller
{
    // Tampilkan semua keluhan milik user yang sedang login
    public function index()
    {
        $userId = Auth::id() ?? 1;

        $keluhan = Keluhan::with('user')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return response()->json([
            'status' => 'success',
            'message' => 'Daftar keluhan berhasil diambil',
            'data' => $keluhan
        ], 200);
    }


    // Tambah keluhan baru
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul' => 'required|string|max:255',
            'isi' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        $keluhan = Keluhan::create([
            'judul' => $request->judul,
            'isi' => $request->isi,
            'user_id' => Auth::id() ?? 1,
            'status' => 'pending',
        ]);

        return response()->json([
            'message' => 'Keluhan berhasil dibuat',
            'data' => $keluhan
        ], 201);
    }

    // Tampilkan detail keluhan milik user
    public function show(Keluhan $keluhan)
    {
        $userId = Auth::id() ?? 1;

        if ($keluhan->user_id !== $userId) {
            return response()->json([
                'status' => 'error',
                'message' => 'Keluhan tidak ditemukan atau bukan milik pengguna ini'
            ], 403);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Detail keluhan berhasil diambil',
            'data' => $keluhan
        ], 200);
    }


    // Update keluhan
    public function update(Request $request, Keluhan $keluhan)
    {
        $userId = Auth::id() ?? 1;

        if ($keluhan->user_id !== $userId) {
            return response()->json(['message' => 'Tidak diizinkan mengubah keluhan ini'], 403);
        }

        $validator = Validator::make($request->all(), [
            'judul' => 'sometimes|string|max:255',
            'isi' => 'sometimes|string',
            'status' => 'in:pending,diproses,selesai',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors(),
                'message' => 'Validasi gagal'
            ], 422);
        }

        $keluhan->update($request->only('judul', 'isi', 'status'));

        return response()->json([
            'message' => 'Keluhan berhasil diperbarui',
            'data' => $keluhan
        ]);
    }

    // Hapus keluhan
    public function destroy(Keluhan $keluhan)
    {
        $userId = Auth::id() ?? 1;

        if ($keluhan->user_id !== $userId) {
            return response()->json(['message' => 'Tidak diizinkan menghapus keluhan ini'], 403);
        }

        $keluhan->delete();

        return response()->json([
            'message' => 'Keluhan berhasil dihapus'
        ]);
    }
}
