<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class ApiKeluhanController extends Controller
{
    // GET: /api/keluhan
    public function index()
    {
        $userId = Auth::id();
        $keluhan = Keluhan::with('user')
            ->where('user_id', $userId)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar keluhan ditemukan',
            'data' => $keluhan
        ]);
    }

    // POST: /api/keluhan
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        $path = null;
        if ($request->hasFile('gambar')) {
            $path = $request->file('gambar')->store('keluhan', 'public');
        }

        $keluhan = Keluhan::create([
            'judul'   => $request->judul,
            'isi'     => $request->isi,
            'gambar'  => $path,
            'user_id' => Auth::id(),
            'status'  => 'pending'
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
            'message' => 'Keluhan berhasil ditambahkan',
            'data'    => $keluhan
        ]);
    }



    // GET: /api/keluhan/{id}
    public function show(Keluhan $keluhan)
    {
        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail keluhan',
            'data'    => $keluhan
        ]);
    }


    // PUT/PATCH: /api/keluhan/{id}
    public function update(Request $request, Keluhan $keluhan)
    {
        // Hanya pemilik keluhan yang boleh mengedit
        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan untuk mengedit keluhan ini.',
            ], 403);
        }

        // Validasi data
        $validator = Validator::make($request->all(), [
            'judul'  => 'sometimes|required|string|max:255',
            'isi'    => 'sometimes|required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors'  => $validator->errors(),
            ], 422);
        }

        // Update data
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($keluhan->gambar && Storage::disk('public')->exists($keluhan->gambar)) {
                Storage::disk('public')->delete($keluhan->gambar);
            }
            $gambarBaru = $request->file('gambar')->store('keluhan', 'public');
            $keluhan->gambar = $gambarBaru;
        }

        if ($request->filled('judul')) {
            $keluhan->judul = $request->judul;
        }

        if ($request->filled('isi')) {
            $keluhan->isi = $request->isi;
        }

        $keluhan->save();

        return response()->json([
            'success' => true,
            'message' => 'Keluhan berhasil diperbarui.',
            'data'    => $keluhan,
        ]);
    }



    // SELESAIKAN: /api/keluha{id}/selesaikan



    // DELETE: /api/keluhan/{id}
    public function destroy(Keluhan $keluhan)
    {
        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan',
            ], 403);
        }

        if ($keluhan->gambar && Storage::disk('public')->exists($keluhan->gambar)) {
            Storage::disk('public')->delete($keluhan->gambar);
        }

        $keluhan->delete();

        return response()->json([
            'success' => true,
            'message' => 'Keluhan berhasil dihapus',
        ]);
    }
}
