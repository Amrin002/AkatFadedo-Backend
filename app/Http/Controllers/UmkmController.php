<?php

namespace App\Http\Controllers;

use App\Mail\UmkmApprovedMail;
use App\Mail\UmkmRejectedMail;
use App\Models\Umkm;
use App\Models\Penduduk;
use App\Models\User;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

use Mail;

class UmkmController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Halaman UMKM';
        $halaman = 'UMKM';
        $user = $request->user();

        // Filter berdasarkan status jika ada
        $status = $request->get('status');
        $kategori = $request->get('kategori');

        $query = Umkm::with(['penduduk', 'approvedBy']);

        if ($status) {
            $query->where('status', $status);
        }

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        $umkms = $query->latest()->get();

        // Data untuk dropdown
        $penduduks = Penduduk::where('nama_lengkap', '!=', 'Admin')->get();
        $kategoriOptions = Umkm::getKategoriOptions();
        $statusOptions = Umkm::getStatusOptions();

        return view('umkm.index', compact(
            'title',
            'halaman',
            'user',
            'umkms',
            'penduduks',
            'kategoriOptions',
            'statusOptions',
            'status',
            'kategori'
        ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Tidak digunakan karena create di modal
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nik' => 'required|string|size:16|exists:penduduks,nik',
            'nama_usaha' => 'required|string|max:255',
            'kategori' => 'required|in:makanan,jasa,kerajinan,pertanian,perdagangan,lainnya',
            'nama_produk' => 'required|string|max:255',
            'deskripsi_produk' => 'required|string',
            'foto_produk' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'nomor_telepon' => 'required|string|max:20',
            'link_facebook' => 'nullable|url|max:500',
            'link_instagram' => 'nullable|url|max:500',
            'link_tiktok' => 'nullable|url|max:500',
        ]);

        // Cek apakah NIK sudah memiliki UMKM yang aktif (pending atau approved)
        $existingUmkm = Umkm::where('nik', $request->nik)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingUmkm) {
            return redirect()->back()->with('error', 'NIK ini sudah memiliki UMKM yang aktif!');
        }

        // Simpan foto produk
        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $foto = $request->file('foto_produk');
            $timestamp = now()->format('YmdHis');
            $filename = $timestamp . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('umkm', $filename, 'public');
        }

        // Simpan data ke database
        $umkm = Umkm::create([
            'nik' => $request->nik,
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'foto_produk' => $fotoPath,
            'nomor_telepon' => $request->nomor_telepon,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
            'status' => 'pending'
        ]);

        // Kirim notifikasi ke admin
        $admins = User::where('role', 'admin')->get();
        foreach ($admins as $admin) {
            Notification::createNotification(
                $admin->id,
                'umkm',
                "Pendaftaran UMKM baru: {$umkm->nama_usaha}",
                $umkm->id,
                Umkm::class,
                [
                    'nama_usaha' => $umkm->nama_usaha,
                    'kategori' => $umkm->kategori_label,
                ]
            );
        }

        return redirect()->route('umkm.index')->with('success', 'UMKM berhasil didaftarkan dan menunggu persetujuan admin!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Umkm $umkm)
    {
        $umkm->load(['penduduk', 'approvedBy']);
        $title = 'Detail UMKM';
        return view('umkm.show', compact('umkm', 'title'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Umkm $umkm)
    {
        // Tidak digunakan karena edit di modal
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nik' => 'required|string|size:16|exists:penduduks,nik',
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

        $umkm = Umkm::findOrFail($id);

        // Cek apakah NIK sudah digunakan UMKM lain (kecuali yang sedang diedit)
        $existingUmkm = Umkm::where('nik', $request->nik)
            ->whereIn('status', ['pending', 'approved'])
            ->where('id', '!=', $id)
            ->first();

        if ($existingUmkm) {
            return redirect()->back()->with('error', 'NIK ini sudah digunakan oleh UMKM lain!');
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

        // Update data
        $umkm->update([
            'nik' => $request->nik,
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

        // Reset status ke pending jika ada perubahan data penting
        if ($umkm->status === 'approved') {
            $umkm->resetToPending();

            // Notifikasi ke admin bahwa ada perubahan data
            $admins = User::where('role', 'admin')->get();
            foreach ($admins as $admin) {
                Notification::createNotification(
                    $admin->id,
                    'umkm',
                    "UMKM {$umkm->nama_usaha} telah diperbarui dan perlu review ulang",
                    $umkm->id,
                    Umkm::class,
                    [
                        'nama_usaha' => $umkm->nama_usaha,
                        'action' => 'updated'
                    ]
                );
            }
        }

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);

        // Hapus foto jika ada
        if ($umkm->foto_produk && Storage::disk('public')->exists($umkm->foto_produk)) {
            Storage::disk('public')->delete($umkm->foto_produk);
        }

        $umkm->delete();

        return redirect()->route('umkm.index')->with('success', 'Data UMKM berhasil dihapus!');
    }

    /**
     * Approve UMKM
     */
    public function approve($id)
    {
        $umkm = Umkm::with('user')->findOrFail($id);

        if ($umkm->status !== 'pending') {
            return redirect()->back()->with('error', 'UMKM ini tidak dalam status pending!');
        }

        $umkm->approve(Auth::id());

        // Kirim email notifikasi ke pemilik UMKM jika ada user_id
        try {
            if ($umkm->user && $umkm->user->email) {
                Mail::to($umkm->user->email)->send(new UmkmApprovedMail($umkm));
                Log::info("Email approval berhasil dikirim untuk UMKM ID: {$umkm->id}");
            } else {
                Log::warning("User tidak ditemukan atau email kosong untuk UMKM ID: {$umkm->id}");
            }
        } catch (Exception $e) {
            Log::error("Gagal mengirim email approval UMKM ID: {$umkm->id}, Error: " . $e->getMessage());
            // Tidak gagalkan proses approval meskipun email gagal
        }

        return redirect()->route('umkm.index')->with('success', "UMKM {$umkm->nama_usaha} berhasil disetujui!");
    }

    /**
     * Reject UMKM
     */
    public function reject(Request $request, $id)
    {
        $request->validate([
            'catatan_admin' => 'required|string|max:1000'
        ]);

        $umkm = Umkm::findOrFail($id);

        if ($umkm->status !== 'pending') {
            return redirect()->back()->with('error', 'UMKM ini tidak dalam status pending!');
        }

        $umkm->reject(Auth::id(), $request->catatan_admin);

        // Kirim email notifikasi penolakan ke pemilik UMKM
        try {
            if ($umkm->user && $umkm->user->email) {
                Mail::to($umkm->user->email)->send(new UmkmRejectedMail($umkm));
                Log::info("Email rejection berhasil dikirim untuk UMKM ID: {$umkm->id}");
            } else {
                Log::warning("User tidak ditemukan atau email kosong untuk UMKM ID: {$umkm->id}");
            }
        } catch (Exception $e) {
            Log::error("Gagal mengirim email rejection UMKM ID: {$umkm->id}, Error: " . $e->getMessage());
            // Tidak gagalkan proses rejection meskipun email gagal
        }

        return redirect()->route('umkm.index')->with('success', "UMKM {$umkm->nama_usaha} telah ditolak!");
    }

    /**
     * Reset UMKM status to pending
     */
    public function resetToPending($id)
    {
        $umkm = Umkm::findOrFail($id);

        if ($umkm->status === 'pending') {
            return redirect()->back()->with('error', 'UMKM ini sudah dalam status pending!');
        }

        $umkm->resetToPending();

        return redirect()->route('umkm.index')->with('success', "Status UMKM {$umkm->nama_usaha} telah direset ke pending!");
    }

    /**
     * View untuk publik - menampilkan UMKM yang sudah disetujui
     */
    public function publicIndex(Request $request)
    {
        $kategori = $request->get('kategori');
        $search = $request->get('search');

        $query = Umkm::approved()->with('penduduk');

        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        // TAMBAHAN: Search functionality
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nama_usaha', 'LIKE', "%{$search}%")
                    ->orWhere('nama_produk', 'LIKE', "%{$search}%")
                    ->orWhere('deskripsi_produk', 'LIKE', "%{$search}%")
                    ->orWhereHas('penduduk', function ($penduduk) use ($search) {
                        $penduduk->where('nama_lengkap', 'LIKE', "%{$search}%");
                    });
            });
        }

        $umkms = $query->latest('approved_at')->paginate(12);
        $kategoriOptions = Umkm::getKategoriOptions();

        // TAMBAHAN: Statistics untuk tampilan
        $totalUmkm = Umkm::approved()->count();
        $totalByKategori = Umkm::approved()
            ->selectRaw('kategori, count(*) as total')
            ->groupBy('kategori')
            ->pluck('total', 'kategori');

        $title = 'Daftar UMKM Desa';

        return view('home.umkm', compact(
            'umkms',
            'kategoriOptions',
            'kategori',
            'search',
            'totalUmkm',
            'totalByKategori',
            'title'
        ));
    }
    /**
     * Show detail UMKM untuk publik
     */
    public function publicShow($id)
    {
        $umkm = Umkm::approved()
            ->with('penduduk')
            ->findOrFail($id);

        $title = $umkm->nama_usaha;

        return view('home.umkm-detail', compact('umkm', 'title'));
    }
}