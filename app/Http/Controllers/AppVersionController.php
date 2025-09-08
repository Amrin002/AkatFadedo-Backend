<?php

namespace App\Http\Controllers;

use App\Models\AppVersion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class AppVersionController extends Controller
{
    /**
     * Store a newly created app version
     */
    public function store(Request $request)
    {
        Log::info('Masuk ke fungsi store AppVersion');

        // Debug file information
        if ($request->hasFile('apk_file')) {
            $file = $request->file('apk_file');
            Log::info('File Details:', [
                'original_name' => $file->getClientOriginalName(),
                'mime_type' => $file->getMimeType(),
                'extension' => $file->getClientOriginalExtension(),
                'size' => $file->getSize()
            ]);
        }

        $validator = Validator::make($request->all(), [
            'version' => 'required|string|max:20|unique:app_versions,version',
            'version_code' => 'required|integer|min:1|unique:app_versions,version_code',
            'minimum_version' => 'nullable|string|max:20',
            'minimum_version_code' => 'nullable|integer|min:1',
            // Updated validation - more flexible MIME types for APK
            'apk_file' => 'required|file|max:51200',
            'is_force_update' => 'boolean',
            'changelog' => 'nullable|string',
            'platform' => 'required|string|in:android,ios'
        ], [
            'apk_file.required' => 'File APK wajib diupload!',
            'apk_file.max' => 'Ukuran file APK maksimal 50MB!',
            'version.unique' => 'Versi ini sudah ada!',
            'version_code.required' => 'Version code wajib diisi!',
            'version_code.unique' => 'Version code ini sudah ada!',
            'version_code.min' => 'Version code minimal 1!',
            'minimum_version_code.min' => 'Minimum version code minimal 1!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Manual APK file validation
        if ($request->hasFile('apk_file')) {
            $file = $request->file('apk_file');
            $extension = strtolower($file->getClientOriginalExtension());
            $mimeType = $file->getMimeType();
            
            // Allow common APK MIME types
            $allowedMimeTypes = [
                'application/vnd.android.package-archive',
                'application/octet-stream',
                'application/zip',
                'application/x-zip-compressed'
            ];
            
            // Check extension and MIME type
            if ($extension !== 'apk' || !in_array($mimeType, $allowedMimeTypes)) {
                Log::warning('Invalid APK file:', [
                    'extension' => $extension,
                    'mime_type' => $mimeType,
                    'filename' => $file->getClientOriginalName()
                ]);
                
                return back()->withErrors([
                    'apk_file' => 'File harus berformat APK! (Detected: ' . $extension . ', MIME: ' . $mimeType . ')'
                ])->withInput();
            }
        }

        // Validasi tambahan: version_code harus lebih besar dari version_code yang sudah ada
        $latestVersionCode = AppVersion::where('platform', $request->platform)
            ->max('version_code');
            
        if ($latestVersionCode && $request->version_code <= $latestVersionCode) {
            return back()->withErrors([
                'version_code' => 'Version code harus lebih besar dari version code terbaru (' . $latestVersionCode . ')!'
            ])->withInput();
        }

        // Validasi minimum_version_code tidak boleh lebih besar dari version_code
        if ($request->minimum_version_code && $request->minimum_version_code >= $request->version_code) {
            return back()->withErrors([
                'minimum_version_code' => 'Minimum version code harus lebih kecil dari version code!'
            ])->withInput();
        }

        try {
            // Upload APK file
            $apkFile = $request->file('apk_file');
            $filename = AppVersion::generateApkFilename($request->version);
            $filePath = $apkFile->storeAs('apk', $filename, 'public');
            
            // Get file size
            $fileSize = $this->formatFileSize($apkFile->getSize());

            // Nonaktifkan versi yang aktif sebelumnya untuk platform yang sama
            AppVersion::where('platform', $request->platform)
                ->where('is_active', true)
                ->update(['is_active' => false]);

            // Buat version baru
            AppVersion::create([
                'version' => $request->version,
                'version_code' => $request->version_code,
                'minimum_version' => $request->minimum_version,
                'minimum_version_code' => $request->minimum_version_code,
                'download_url' => $filePath,
                'is_force_update' => $request->boolean('is_force_update'),
                'changelog' => $request->changelog,
                'file_size' => $fileSize,
                'is_active' => true,
                'platform' => $request->platform
            ]);

            Log::info('AppVersion berhasil dibuat: ' . $request->version . ' (Code: ' . $request->version_code . ')');
            
            return redirect()->route('app-version.index')
                ->with('success', "App version {$request->version} (Code: {$request->version_code}) berhasil ditambahkan!");

        } catch (\Exception $e) {
            Log::error('Gagal menyimpan AppVersion: ' . $e->getMessage());
            
            // Hapus file yang sudah diupload jika ada error
            if (isset($filePath) && Storage::exists('public/' . $filePath)) {
                Storage::delete('public/' . $filePath);
            }
            
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menyimpan data.'])
                ->withInput();
        }
    }

    /**
     * Update app version
     */
    public function update(Request $request, $id)
    {
        $version = AppVersion::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'minimum_version' => 'nullable|string|max:20',
            'minimum_version_code' => 'nullable|integer|min:1',
            'apk_file' => 'nullable|file|max:51200', // Remove mimes validation
            'is_force_update' => 'boolean',
            'changelog' => 'nullable|string',
            'is_active' => 'boolean'
        ], [
            'apk_file.max' => 'Ukuran file APK maksimal 50MB!',
            'minimum_version_code.min' => 'Minimum version code minimal 1!'
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        // Manual APK validation for update
        if ($request->hasFile('apk_file')) {
            $file = $request->file('apk_file');
            $extension = strtolower($file->getClientOriginalExtension());
            $mimeType = $file->getMimeType();
            
            $allowedMimeTypes = [
                'application/vnd.android.package-archive',
                'application/octet-stream',
                'application/zip',
                'application/x-zip-compressed'
            ];
            
            if ($extension !== 'apk' || !in_array($mimeType, $allowedMimeTypes)) {
                return back()->withErrors([
                    'apk_file' => 'File harus berformat APK!'
                ])->withInput();
            }
        }

        // Validasi minimum_version_code tidak boleh lebih besar dari version_code
        if ($request->minimum_version_code && $request->minimum_version_code >= $version->version_code) {
            return back()->withErrors([
                'minimum_version_code' => 'Minimum version code harus lebih kecil dari version code saat ini (' . $version->version_code . ')!'
            ])->withInput();
        }

        try {
            $updateData = [
                'minimum_version' => $request->minimum_version,
                'minimum_version_code' => $request->minimum_version_code,
                'is_force_update' => $request->boolean('is_force_update'),
                'changelog' => $request->changelog,
                'is_active' => $request->boolean('is_active')
            ];

            // Jika ada file APK baru
            if ($request->hasFile('apk_file')) {
                // Hapus file lama
                if ($version->download_url && Storage::exists('public/' . $version->download_url)) {
                    Storage::delete('public/' . $version->download_url);
                }

                // Upload file baru
                $apkFile = $request->file('apk_file');
                $filename = AppVersion::generateApkFilename($version->version);
                $filePath = $apkFile->storeAs('apk', $filename, 'public');
                
                $updateData['download_url'] = $filePath;
                $updateData['file_size'] = $this->formatFileSize($apkFile->getSize());
            }

            // Jika di-set aktif, nonaktifkan yang lain
            if ($request->boolean('is_active')) {
                AppVersion::where('platform', $version->platform)
                    ->where('id', '!=', $version->id)
                    ->update(['is_active' => false]);
            }

            $version->update($updateData);

            return redirect()->route('app-version.index')
                ->with('success', "App version {$version->version} berhasil diupdate!");

        } catch (\Exception $e) {
            Log::error('Gagal update AppVersion: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat mengupdate data.']);
        }
    }

    // Method lainnya tetap sama...
    public function index()
    {
        $title = 'Management App Version';
        $halaman = 'App Version Management';
        
        $versions = AppVersion::orderBy('version_code', 'desc')->get();
        
        return view('app-version.index', compact('title', 'halaman', 'versions'));
    }

    public function create()
    {
        $title = 'Tambah App Version';
        $halaman = 'Tambah Version Baru';
        
        return view('app-version.create', compact('title', 'halaman'));
    }

    public function show($id)
    {
        $version = AppVersion::findOrFail($id);
        $title = 'Detail App Version';
        $halaman = "Detail Version {$version->version}";
        
        return view('app-version.show', compact('title', 'halaman', 'version'));
    }

    public function edit($id)
    {
        $version = AppVersion::findOrFail($id);
        $title = 'Edit App Version';
        $halaman = "Edit Version {$version->version}";
        
        return view('app-version.edit', compact('title', 'halaman', 'version'));
    }

    public function destroy($id)
    {
        try {
            $version = AppVersion::findOrFail($id);
            
            // Hapus file APK
            if ($version->download_url && Storage::exists('public/' . $version->download_url)) {
                Storage::delete('public/' . $version->download_url);
            }

            $versionName = $version->version;
            $version->delete();

            return redirect()->route('app-version.index')
                ->with('success', "App version {$versionName} berhasil dihapus!");

        } catch (\Exception $e) {
            Log::error('Gagal menghapus AppVersion: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat menghapus data.']);
        }
    }

    public function toggleActive($id)
    {
        try {
            $version = AppVersion::findOrFail($id);
            
            if (!$version->is_active) {
                // Nonaktifkan versi lain di platform yang sama
                AppVersion::where('platform', $version->platform)
                    ->where('id', '!=', $version->id)
                    ->update(['is_active' => false]);
                
                $version->update(['is_active' => true]);
                $message = "Version {$version->version} diaktifkan!";
            } else {
                $version->update(['is_active' => false]);
                $message = "Version {$version->version} dinonaktifkan!";
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            Log::error('Gagal toggle active AppVersion: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan.']);
        }
    }

    private function formatFileSize($bytes)
    {
        if ($bytes >= 1073741824) {
            return number_format($bytes / 1073741824, 2) . ' GB';
        } elseif ($bytes >= 1048576) {
            return number_format($bytes / 1048576, 2) . ' MB';
        } elseif ($bytes >= 1024) {
            return number_format($bytes / 1024, 2) . ' KB';
        } else {
            return $bytes . ' bytes';
        }
    }
}