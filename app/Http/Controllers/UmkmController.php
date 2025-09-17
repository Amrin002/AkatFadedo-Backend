<?php

namespace App\Http\Controllers;

use App\Mail\UmkmApprovedMail;
use App\Mail\UmkmRejectedMail;
use App\Models\AppVersion;
use App\Models\Umkm;
use App\Models\Penduduk;
use App\Models\User;
use App\Models\Notification;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
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
            'harga_produk' => 'required|numeric|min:0|max:999999999999.99',
            'foto_produk' => 'required|image|mimes:jpg,png,jpeg|max:2048',
            'nomor_telepon' => 'required|string|max:20',
            'link_facebook' => 'nullable|url|max:500',
            'link_instagram' => 'nullable|url|max:500',
            'link_tiktok' => 'nullable|url|max:500',
        ]);

        // Cek apakah nama usaha sudah ada untuk NIK yang sama
        $existingUmkm = Umkm::where('nik', $request->nik)
            ->where('nama_usaha', $request->nama_usaha)
            ->whereIn('status', ['pending', 'approved'])
            ->first();

        if ($existingUmkm) {
            return redirect()->back()->with('error', 'Nama usaha "' . $request->nama_usaha . '" sudah terdaftar untuk NIK ini!');
        }

        // Rest of the code remains the same...
        $fotoPath = null;
        if ($request->hasFile('foto_produk')) {
            $foto = $request->file('foto_produk');
            $timestamp = now()->format('YmdHis');
            $filename = $timestamp . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('umkm', $filename, 'public');
        }

        $umkm = Umkm::create([
            'nik' => $request->nik,
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
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
            'harga_produk' => 'nullable|numeric|min:0|max:999999999999.99',
            'deskripsi_produk' => 'required|string',
            'foto_produk' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
            'nomor_telepon' => 'required|string|max:20',
            'link_facebook' => 'nullable|url|max:500',
            'link_instagram' => 'nullable|url|max:500',
            'link_tiktok' => 'nullable|url|max:500',
        ]);

        $umkm = Umkm::findOrFail($id);

        // Cek apakah nama usaha sudah digunakan oleh UMKM lain dengan NIK yang sama (kecuali yang sedang diedit)
        $existingUmkm = Umkm::where('nik', $request->nik)
            ->where('nama_usaha', $request->nama_usaha)
            ->whereIn('status', ['pending', 'approved'])
            ->where('id', '!=', $id)
            ->first();

        if ($existingUmkm) {
            return redirect()->back()->with('error', 'Nama usaha "' . $request->nama_usaha . '" sudah terdaftar untuk NIK ini!');
        }

        // Rest of the code remains the same...
        $fotoPath = $umkm->foto_produk;
        if ($request->hasFile('foto_produk')) {
            if ($umkm->foto_produk && Storage::disk('public')->exists($umkm->foto_produk)) {
                Storage::disk('public')->delete($umkm->foto_produk);
            }

            $foto = $request->file('foto_produk');
            $timestamp = now()->format('YmdHis');
            $filename = $timestamp . '_' . uniqid() . '.' . $foto->getClientOriginalExtension();
            $fotoPath = $foto->storeAs('umkm', $filename, 'public');
        }

        $umkm->update([
            'nik' => $request->nik,
            'nama_usaha' => $request->nama_usaha,
            'kategori' => $request->kategori,
            'nama_produk' => $request->nama_produk,
            'deskripsi_produk' => $request->deskripsi_produk,
            'harga_produk' => $request->harga_produk,
            'foto_produk' => $fotoPath,
            'nomor_telepon' => $request->nomor_telepon,
            'link_facebook' => $request->link_facebook,
            'link_instagram' => $request->link_instagram,
            'link_tiktok' => $request->link_tiktok,
        ]);

        if ($umkm->status === 'approved') {
            $umkm->resetToPending();

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
        // Tambahkan ini - Caching AppVersion terbaru
        $latestAppVersion = AppVersion::getLatestVersion('android');

        return view('home.umkm', compact(
            'umkms',
            'kategoriOptions',
            'kategori',
            'search',
            'totalUmkm',
            'totalByKategori',
            'title',
            'latestAppVersion'
        ));
    }
    /**
     * Show detail UMKM untuk publik
     */
    /**
     * Show detail UMKM untuk publik
     */
    public function publicShow($id)
    {
        $umkm = Umkm::approved()
            ->with('penduduk')
            ->findOrFail($id);

        // Ambil UMKM terkait berdasarkan kategori yang sama
        $umkmTerkait = Umkm::approved()
            ->with('penduduk')
            ->where('kategori', $umkm->kategori)
            ->where('id', '!=', $umkm->id)
            ->latest('approved_at')
            ->take(6)
            ->get();

        $title = $umkm->nama_usaha;

        return view('home.umkm-detail', compact('umkm', 'umkmTerkait', 'title'));
    }
}