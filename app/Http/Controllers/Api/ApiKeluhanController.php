<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Keluhan;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
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
    public function show($id)
    {
        $keluhan = Keluhan::findOrFail($id);

        if ($keluhan->user_id !== Auth::id()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak diizinkan',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail keluhan',
            'data'    => $keluhan->load('user')
        ]);
    }




    public function update(Request $request, $id)
    {
        $user = $request->user();
        $keluhan = Keluhan::find($id);

        if (!$keluhan) {
            return response()->json([
                'success' => false,
                'message' => 'Keluhan tidak ditemukan',
            ], 404);
        }

        if ($keluhan->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah keluhan ini',
            ], 403);
        }

        // Log untuk debug
        Log::info('Raw request data:', $request->all());
        Log::info('Has judul: ' . $request->has('judul'));
        Log::info('Has isi: ' . $request->has('isi'));

        $validator = Validator::make($request->all(), [
            'judul'  => 'required|string|max:255',
            'isi'    => 'required|string',
            'gambar' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Siapkan data update
        $updateData = [
            'judul' => $request->input('judul'),
            'isi' => $request->input('isi'),
        ];

        // Handle gambar jika ada
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($keluhan->gambar && Storage::disk('public')->exists($keluhan->gambar)) {
                Storage::disk('public')->delete($keluhan->gambar);
            }

            // Upload gambar baru
            $path = $request->file('gambar')->store('keluhan', 'public');
            $updateData['gambar'] = $path;
        }

        // Update keluhan
        $keluhan->update($updateData);

        // Load relasi user
        $keluhan->load('user');

        return response()->json([
            'success' => true,
            'message' => 'Keluhan berhasil diperbarui',
            'data' => $keluhan
        ]);
    }



    // DELETE: /api/keluhan/{id}
    public function destroy($id)
    {
        $keluhan = Keluhan::findOrFail($id);

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
