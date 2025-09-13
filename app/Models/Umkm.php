<?php

namespace App\Models;

use App\Services\WhatsAppHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $table = 'umkms';

    protected $fillable = [
        'user_id',
        'nik',
        'nama_usaha',
        'kategori',
        'nama_produk',
        'deskripsi_produk',
        'harga_produk',
        'foto_produk',
        'nomor_telepon',
        'link_facebook',
        'link_instagram',
        'link_tiktok',
        'status',
        'catatan_admin',
        'approved_at',
        'approved_by'
    ];

    protected $casts = [
        'approved_at' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    // Konstanta untuk enum status
    const STATUS_PENDING = 'pending';
    const STATUS_APPROVED = 'approved';
    const STATUS_REJECTED = 'rejected';

    // Konstanta untuk enum kategori
    const KATEGORI_MAKANAN = 'makanan';
    const KATEGORI_JASA = 'jasa';
    const KATEGORI_KERAJINAN = 'kerajinan';
    const KATEGORI_PERTANIAN = 'pertanian';
    const KATEGORI_PERDAGANGAN = 'perdagangan';
    const KATEGORI_LAINNYA = 'lainnya';

    /**
     * Relasi ke model User (yang mendaftar UMKM)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Relasi ke model Penduduk
     */
    public function penduduk()
    {
        return $this->belongsTo(Penduduk::class, 'nik', 'nik');
    }

    /**
     * Relasi ke model User (admin yang approve)
     */
    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }

    /**
     * Scope untuk filter status
     */
    public function scopeByStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope untuk filter kategori
     */
    public function scopeByKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope untuk UMKM yang sudah disetujui
     */
    public function scopeApproved($query)
    {
        return $query->where('status', self::STATUS_APPROVED);
    }

    /**
     * Scope untuk UMKM yang pending
     */
    public function scopePending($query)
    {
        return $query->where('status', self::STATUS_PENDING);
    }

    /**
     * Scope untuk UMKM yang ditolak
     */
    public function scopeRejected($query)
    {
        return $query->where('status', self::STATUS_REJECTED);
    }

    /**
     * Accessor untuk mendapatkan URL foto produk lengkap
     */
    public function getFotoUrlAttribute()
    {
        if ($this->foto_produk) {
            return asset('storage/' . $this->foto_produk);
        }
        return asset('images/default-product.jpg'); // fallback image
    }

    /**
     * Accessor untuk mendapatkan badge status
     */
    public function getStatusBadgeAttribute()
    {
        $badges = [
            self::STATUS_PENDING => 'warning',
            self::STATUS_APPROVED => 'success',
            self::STATUS_REJECTED => 'danger',
        ];

        return $badges[$this->status] ?? 'secondary';
    }

    /**
     * Accessor untuk mendapatkan label status dalam bahasa Indonesia
     */
    public function getStatusLabelAttribute()
    {
        $labels = [
            self::STATUS_PENDING => 'Menunggu Persetujuan',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
        ];

        return $labels[$this->status] ?? 'Tidak Diketahui';
    }

    /**
     * Accessor untuk mendapatkan label kategori dalam bahasa Indonesia
     */
    public function getKategoriLabelAttribute()
    {
        $labels = [
            self::KATEGORI_MAKANAN => 'Makanan & Minuman',
            self::KATEGORI_JASA => 'Jasa',
            self::KATEGORI_KERAJINAN => 'Kerajinan',
            self::KATEGORI_PERTANIAN => 'Pertanian',
            self::KATEGORI_PERDAGANGAN => 'Perdagangan',
            self::KATEGORI_LAINNYA => 'Lainnya',
        ];

        return $labels[$this->kategori] ?? 'Tidak Diketahui';
    }

    /**
     * Method untuk approve UMKM
     */
    public function approve($adminId)
    {
        $this->update([
            'status' => self::STATUS_APPROVED,
            'approved_at' => now(),
            'approved_by' => $adminId,
            'catatan_admin' => null
        ]);
    }

    /**
     * Method untuk reject UMKM
     */
    public function reject($adminId, $catatan = null)
    {
        $this->update([
            'status' => self::STATUS_REJECTED,
            'approved_at' => null,
            'approved_by' => $adminId,
            'catatan_admin' => $catatan
        ]);
    }

    /**
     * Method untuk reset status ke pending
     */
    public function resetToPending()
    {
        $this->update([
            'status' => self::STATUS_PENDING,
            'approved_at' => null,
            'approved_by' => null,
            'catatan_admin' => null
        ]);
    }

    /**
     * Method untuk mendapatkan semua kategori
     */
    public static function getKategoriOptions()
    {
        return [
            self::KATEGORI_MAKANAN => 'Makanan & Minuman',
            self::KATEGORI_JASA => 'Jasa',
            self::KATEGORI_KERAJINAN => 'Kerajinan',
            self::KATEGORI_PERTANIAN => 'Pertanian',
            self::KATEGORI_PERDAGANGAN => 'Perdagangan',
            self::KATEGORI_LAINNYA => 'Lainnya',
        ];
    }

    /**
     * Method untuk mendapatkan semua status
     */
    public static function getStatusOptions()
    {
        return [
            self::STATUS_PENDING => 'Menunggu Persetujuan',
            self::STATUS_APPROVED => 'Disetujui',
            self::STATUS_REJECTED => 'Ditolak',
        ];
    }

    /**
     * Accessor untuk WhatsApp URL
     */
    public function getWhatsappUrlAttribute()
    {
        return WhatsAppHelper::generateUmkmWhatsAppUrl($this);
    }

    /**
     * Accessor untuk nomor telepon yang diformat
     */
    public function getFormattedPhoneAttribute()
    {
        return WhatsAppHelper::formatForDisplay($this->nomor_telepon);
    }
}