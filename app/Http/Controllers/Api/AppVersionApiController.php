<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\AppVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;

class AppVersionApiController extends Controller
{
    /**
     * Check apakah ada update tersedia
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function checkVersion(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'current_version' => 'required|string',
                'current_version_code' => 'required|integer',
                'platform' => 'nullable|string|in:android,ios'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $platform = $request->get('platform', 'android');
            $currentVersionCode = $request->get('current_version_code');
            $currentVersion = $request->get('current_version');

            // Cek apakah perlu update
            $updateInfo = AppVersion::needsUpdate($currentVersionCode, $platform);

            if (!$updateInfo['needs_update']) {
                return response()->json([
                    'success' => true,
                    'message' => 'Aplikasi sudah versi terbaru',
                    'data' => [
                        'needs_update' => false,
                        'is_force_update' => false,
                        'current_version' => $currentVersion,
                        'is_latest' => true
                    ]
                ]);
            }

            $latestVersion = $updateInfo['latest_version'];

            return response()->json([
                'success' => true,
                'message' => $updateInfo['is_force_update'] ? 'Update wajib tersedia' : 'Update tersedia',
                'data' => [
                    'needs_update' => true,
                    'is_force_update' => $updateInfo['is_force_update'],
                    'current_version' => $currentVersion,
                    'current_version_code' => $currentVersionCode,
                    'latest_version' => $latestVersion->version,
                    'latest_version_code' => $latestVersion->version_code,
                    'minimum_version' => $latestVersion->minimum_version,
                    'minimum_version_code' => $latestVersion->minimum_version_code,
                    'download_url' => $latestVersion->full_download_url,
                    'changelog' => $latestVersion->changelog_array,
                    'file_size' => $latestVersion->file_size,
                    'release_date' => $latestVersion->formatted_release_date,
                    'is_latest' => false
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error checking app version: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengecek versi aplikasi',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan informasi versi terbaru
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getLatestVersion(Request $request)
    {
        try {
            $platform = $request->get('platform', 'android');
            $latestVersion = AppVersion::getLatestVersion($platform);

            if (!$latestVersion) {
                return response()->json([
                    'success' => false,
                    'message' => 'Tidak ada versi aplikasi yang tersedia'
                ], 404);
            }

            return response()->json([
                'success' => true,
                'message' => 'Informasi versi terbaru',
                'data' => [
                    'version' => $latestVersion->version,
                    'version_code' => $latestVersion->version_code,
                    'minimum_version' => $latestVersion->minimum_version,
                    'minimum_version_code' => $latestVersion->minimum_version_code,
                    'download_url' => $latestVersion->download_url,
                    'is_force_update' => $latestVersion->is_force_update,
                    'changelog' => $latestVersion->changelog_array,
                    'file_size' => $latestVersion->file_size,
                    'release_date' => $latestVersion->formatted_release_date,
                    'platform' => $latestVersion->platform
                ]
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting latest app version: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil informasi versi terbaru',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    /**
     * Mendapatkan riwayat versi aplikasi
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getVersionHistory(Request $request)
    {
        try {
            $platform = $request->get('platform', 'android');
            $limit = $request->get('limit', 10);

            $versions = AppVersion::platform($platform)
                ->orderBy('version_code', 'desc')
                ->limit($limit)
                ->get()
                ->map(function ($version) {
                    return [
                        'version' => $version->version,
                        'version_code' => $version->version_code,
                        'changelog' => $version->changelog_array,
                        'file_size' => $version->file_size,
                        'release_date' => $version->formatted_release_date,
                        'is_active' => $version->is_active,
                        'is_force_update' => $version->is_force_update
                    ];
                });

            return response()->json([
                'success' => true,
                'message' => 'Riwayat versi aplikasi',
                'data' => $versions
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting version history: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil riwayat versi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}