<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class AppVersion extends Model
{
    use HasFactory;

    protected $fillable = [
        'version',
        'version_code',
        'minimum_version',
        'minimum_version_code',
        'download_url',
        'is_force_update',
        'changelog',
        'file_size',
        'is_active',
        'platform'
    ];

    protected $casts = [
        'is_force_update' => 'boolean',
        'is_active' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Scope untuk mendapatkan versi yang aktif
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope untuk platform tertentu
     */
    public function scopePlatform($query, $platform = 'android')
    {
        return $query->where('platform', $platform);
    }

    /**
     * Mendapatkan versi terbaru yang aktif
     */
    public static function getLatestVersion($platform = 'android')
    {
        return self::active()
            ->platform($platform)
            ->orderBy('version_code', 'desc')
            ->first();
    }

    /**
     * Cek apakah perlu update
     */
    public static function needsUpdate($currentVersionCode, $platform = 'android')
    {
        $latestVersion = self::getLatestVersion($platform);
        
        if (!$latestVersion) {
            return [
                'needs_update' => false,
                'is_force_update' => false,
                'latest_version' => null
            ];
        }

        $needsUpdate = $currentVersionCode < $latestVersion->version_code;
        
        // Langsung ambil dari database tanpa logika tambahan
        $isForceUpdate = $latestVersion->is_force_update;

        return [
            'needs_update' => $needsUpdate,
            'is_force_update' => $isForceUpdate,
            'latest_version' => $latestVersion
        ];
    }

    /**
     * Accessor untuk format tanggal yang readable
     */
    public function getFormattedReleaseDateAttribute()
    {
        return $this->created_at->format('d M Y');
    }

    /**
     * Accessor untuk changelog dalam format array
     */
    public function getChangelogArrayAttribute()
    {
        if (!$this->changelog) {
            return [];
        }
        
        return array_filter(array_map('trim', explode("\n", $this->changelog)));
    }

    /**
     * Generate unique filename untuk APK
     */
    public static function generateApkFilename($version)
    {
        $timestamp = now()->format('YmdHis');
        return "desaku-v{$version}-{$timestamp}.apk";
    }

    /**
     * Get full URL untuk download APK
     */
    public function getFullDownloadUrlAttribute()
    {
        if (filter_var($this->download_url, FILTER_VALIDATE_URL)) {
            return $this->download_url; // URL lengkap
        }
        
        return url('storage/' . $this->download_url); // Relative path
    }
}