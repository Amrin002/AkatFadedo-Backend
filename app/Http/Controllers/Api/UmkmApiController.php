<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Notification;
use App\Models\Umkm;
use App\Models\User;
use App\Models\Penduduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class UmkmApiController extends Controller
{
    // GET /api/umkm
    public function index(Request $request)
    {
        $user = $request->user();
        $umkms = Umkm::where('user_id', $user->id)
            ->with(['penduduk', 'approvedBy'])
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Data UMKM berhasil diambil',
            'data' => $umkms
        ]);
    }

    private function createUmkmNotification(Umkm $umkm)
    {
        // Kirim notifikasi ke admin
        $admins = User::where('role', 'admin')->get();

        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'umkm_api',
                "{$umkm->nama_usaha} - Pendaftaran UMKM baru dari Aplikasi Layanan Desa",
                $umkm->id,
                Umkm::class,
                [
                    'nama_usaha' => $umkm->nama_usaha,
                    'kategori' => $umkm->kategori_label,
                    'submitted_via' => 'api'
                ]
            );
        }
        Log::info('Admin users found: ' . $admins->pluck('id')->implode(', '));
    }

    // POST /api/umkm
    public function store(Request $request)
    {
        $user = $request->user();

        $validator = Validator::make($request->all(), [
            'nama_usaha' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,jasa,kerajinan,pertanian,perdagangan,lainnya',
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'nomor_telepon' => 'required|string|max:20',
            'link_facebook' => 'nullable|url|max:500',
            'link_instagram' => 'nullable|url|max:500',
            'link_tiktok' => 'nullable|url|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Ambil NIK dari user yang login
        $penduduk = Penduduk::where('nik', $user->nik)->first();
        if (!$penduduk) {
            return response()->json([
                'success' => false,
                'message' => 'Data penduduk tidak ditemukan untuk user ini',
            ], 404);
        }

        // Cek apakah user sudah memiliki UMKM yang aktif
        $existingUmkm = Umkm::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingUmkm) {
            return response()->json([
                'success' => false,
                'message' => 'Anda sudah memiliki UMKM yang aktif!',
            ], 422);
        }

        // Simpan foto produk
        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $foto = $request->file('foto_produk');
            $timestamp = now()->format('YmdHis');
            $filename = $timestamp . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('umkm', $filename, 'public');
        }

        $umkm = Umkm::create([
            'user_id' => $user->id,
            'nik' => $user->nik, // Ambil NIK dari user yang login
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'foto_produk' => $fotoPath,
            'nomor_telepon' => $request->nomor_telepon,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
            'status' => 'pending',
        ]);

        $this->createUmkmNotification($umkm);

        // Load relasi untuk response
        $umkm->load(['penduduk', 'approvedBy']);

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil didaftarkan dan menunggu persetujuan admin',
            'data' => $umkm
        ]);
    }

    // PUT /api/umkm/{id}
    public function update(Request $request, $id)
    {
        $user = $request->user();
        $umkm = Umkm::find($id);

        if (!$umkm) {
            return response()->json([
                'success' => false,
                'message' => 'UMKM tidak ditemukan',
            ], 404);
        }

        if ($umkm->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk mengubah UMKM ini',
            ], 403);
        }

        $validator = Validator::make($request->all(), [
            'nama_usaha' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,jasa,kerajinan,pertanian,perdagangan,lainnya',
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'nomor_telepon' => 'required|string|max:20',
            'link_facebook' => 'nullable|url|max:500',
            'link_instagram' => 'nullable|url|max:500',
            'link_tiktok' => 'nullable|url|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        // Handle foto produk
        $fotoPath = $umkm->foto_produk;
        if ($request->hasFile('foto_produk')) {
            // Hapus foto lama jika ada
            if ($umkm->foto_produk && Storage::disk('public')->exists($umkm->foto_produk)) {
                Storage::disk('public')->delete($umkm->foto_produk);
            }

            $foto = $request->file('foto_produk');
            $timestamp = now()->format('YmdHis');
            $filename = $timestamp . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('umkm', $filename, 'public');
        }

        $oldStatus = $umkm->status;

        $umkm->update([
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'foto_produk' => $fotoPath,
            'nomor_telepon' => $request->nomor_telepon,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
        ]);

        // Reset status ke pending jika sebelumnya approved
        if ($oldStatus === 'approved') {
            $umkm->resetToPending();

            // Notifikasi ke admin
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::createNotification(
                    $admin->id,
                    'umkm_api',
                    "UMKM {$umkm->nama_usaha} telah diperbarui dari aplikasi dan perlu review ulang",
                    $umkm->id,
                    Umkm::class,
                    [
                        'nama_usaha' => $umkm->nama_usaha,
                        'action' => 'updated',
                        'submitted_via' => 'api'
                    ]
                );
            }
        }

        // Load relasi untuk response
        $umkm->load(['penduduk', 'approvedBy']);

        return response()->json([
            'success' => true,
            'message' => 'Data UMKM berhasil diperbarui',
            'data' => $umkm
        ]);
    }

    // GET /api/umkm/{id}
    public function show(Request $request, $id)
    {
        $user = $request->user();
        $umkm = Umkm::with(['penduduk', 'approvedBy'])->find($id);

        if (!$umkm) {
            return response()->json([
                'success' => false,
                'message' => 'UMKM tidak ditemukan',
            ], 404);
        }

        if ($umkm->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk melihat UMKM ini',
            ], 403);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail UMKM ditemukan',
            'data' => $umkm
        ]);
    }

    // DELETE /api/umkm/{id}
    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        $umkm = Umkm::find($id);

        if (!$umkm) {
            return response()->json([
                'success' => false,
                'message' => 'UMKM tidak ditemukan',
            ], 404);
        }

        if ($umkm->user_id !== $user->id) {
            return response()->json([
                'success' => false,
                'message' => 'Anda tidak memiliki izin untuk menghapus UMKM ini',
            ], 403);
        }

        // Hapus foto jika ada
        if ($umkm->foto_produk && Storage::disk('public')->exists($umkm->foto_produk)) {
            Storage::disk('public')->delete($umkm->foto_produk);
        }

        $umkm->delete();

        return response()->json([
            'success' => true,
            'message' => 'UMKM berhasil dihapus',
        ]);
    }

    // GET /api/umkm-public - Untuk melihat daftar UMKM yang sudah disetujui
    public function publicIndex(Request $request)
    {
        $kategori = $request->get('kategori');
        $limit = $request->get('limit', 12);

        $query = Umkm::approved()->with('penduduk');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $umkms = $query->latest('approved_at')->paginate($limit);

        return response()->json([
            'success' => true,
            'message' => 'Daftar UMKM berhasil diambil',
            'data' => $umkms->items(),
            'pagination' => [
                'current_page' => $umkms->currentPage(),
                'last_page' => $umkms->lastPage(),
                'per_page' => $umkms->perPage(),
                'total' => $umkms->total(),
            ],
            'kategori_options' => Umkm::getKategoriOptions()
        ]);
    }

    // GET /api/umkm-public/{id} - Detail UMKM untuk publik
    public function publicShow($id)
    {
        $umkm = Umkm::approved()
            ->with('penduduk')
            ->find($id);

        if (!$umkm) {
            return response()->json([
                'success' => false,
                'message' => 'UMKM tidak ditemukan atau belum disetujui',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail UMKM ditemukan',
            'data' => $umkm
        ]);
    }

    // GET /api/umkm-options - Untuk mendapatkan data dropdown (tanpa penduduk karena tidak diperlukan)
    public function getOptions()
    {
        return response()->json([
            'success' => true,
            'message' => 'Data options berhasil diambil',
            'data' => [
                'kategori_options' => Umkm::getKategoriOptions(),
                'status_options' => Umkm::getStatusOptions()
            ]
        ]);
    }
}