<?php

use App\Http\Controllers\Api\AppVersionApiController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BeritaApiController;
use App\Http\Controllers\Api\PasswordResetApiController;
use App\Http\Controllers\Api\SuratPindahApiController;
use App\Http\Controllers\Api\SuratDomisiliApiController;
use App\Http\Controllers\Api\SuratKtmApiController;
use App\Http\Controllers\Api\SuratKtuApiController;
use App\Http\Controllers\Api\ApiKeluhanController;
use App\Http\Controllers\Api\ApbdesApiController;
use App\Http\Controllers\Api\UmkmApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
// Route::get('/users/{id}', [AuthController::class, 'show']);
// Routes untuk App Version - Public (tidak perlu authentication)
Route::prefix('app-version')->group(function () {
    // Cek apakah ada update tersedia
    Route::post('/check', [AppVersionApiController::class, 'checkVersion']);

    // Mendapatkan informasi versi terbaru
    Route::get('/latest', [AppVersionApiController::class, 'getLatestVersion']);

    // Mendapatkan riwayat versi (optional)
    Route::get('/history', [AppVersionApiController::class, 'getVersionHistory']);
});
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/users', [AuthController::class, 'index']);
Route::get('/apbdes', [ApbdesApiController::class, 'index']);
Route::get('/apbdes/{id}', [ApbdesApiController::class, 'show']);
Route::post('/forgot-password', [PasswordResetApiController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetApiController::class, 'reset']);
Route::post('/send-otp', [PasswordResetApiController::class, 'sendOtp']);
Route::post('/reset-password/otp', [PasswordResetApiController::class, 'resetWithOtp']);

Route::get('/download/suratktm/{id}/{token}', [SuratKtmApiController::class, 'downloadPdf'])
    ->name('suratktm.download');
Route::get('/download/suratdomisili/{id}/{token}', [SuratDomisiliApiController::class, 'downloadPdf'])
    ->name('suratdomisili.download');
Route::get('/download/suratktu/{id}/{token}', [SuratKtuApiController::class, 'downloadPdf'])
    ->name('suratktu.download');
Route::get('/download/suratpindah/{id}/{token}', [SuratPindahApiController::class, 'downloadPdf'])
    ->name('suratpindah.download');

Route::get('/berita', [BeritaApiController::class, 'index']);        // ambil semua berita
Route::get('/berita/{id}', [BeritaApiController::class, 'show']);


Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::put('/update/{id}', [AuthController::class, 'update']);
    Route::get('/users', [AuthController::class, 'index']);

    // Surat KTM API
    Route::prefix('suratktm')->group(function () {
        Route::get('/{id}/export', [SuratKtmApiController::class, 'exportPdf']);
        Route::get('/', [SuratKtmApiController::class, 'index']);
        Route::post('/', [SuratKtmApiController::class, 'store']);
        Route::get('/{id}', [SuratKtmApiController::class, 'show']);
        Route::put('/{id}', [SuratKtmApiController::class, 'update']);
        Route::delete('/{id}', [SuratKtmApiController::class, 'destroy']);
        Route::get('/{id}/get-download-url', [SuratKtmApiController::class, 'getDownloadUrl']); // Add this line
    });

    // Surat KTU API
    Route::prefix('suratktu')->group(function () {
        Route::get('/{id}/export', [SuratKtuApiController::class, 'exportPdf']);
        Route::get('/', [SuratKtuApiController::class, 'index']);
        Route::post('/', [SuratKtuApiController::class, 'store']);
        Route::get('/{id}', [SuratKtuApiController::class, 'show']);
        Route::put('/{id}', [SuratKtuApiController::class, 'update']);
        Route::delete('/{id}', [SuratKtuApiController::class, 'destroy']);
        Route::get('/{id}/get-download-url', [SuratKtuApiController::class, 'getDownloadUrl']);
    });

    // Surat Domisili API
    Route::prefix('suratdomisili')->group(function () {
        Route::get('/{id}/export', [SuratDomisiliApiController::class, 'exportPdf']);
        Route::get('/', [SuratDomisiliApiController::class, 'index']);
        Route::post('/', [SuratDomisiliApiController::class, 'store']);
        Route::get('/{id}', [SuratDomisiliApiController::class, 'show']);
        Route::put('/{id}', [SuratDomisiliApiController::class, 'update']);
        Route::delete('/{id}', [SuratDomisiliApiController::class, 'destroy']);
        Route::get('/{id}/get-download-url', [SuratDomisiliApiController::class, 'getDownloadUrl']); // Add this line
    });
    Route::prefix('suratpindah')->group(function () {
        Route::get('/{id}/export', [SuratPindahApiController::class, 'exportPdf']);
        Route::get('/', [SuratPindahApiController::class, 'index']);
        Route::post('/', [SuratPindahApiController::class, 'store']);
        Route::get('/{id}', [SuratPindahApiController::class, 'show']);
        Route::put('/{id}', [SuratPindahApiController::class, 'update']);
        Route::delete('/{id}', [SuratPindahApiController::class, 'destroy']);
        Route::get('/{id}/get-download-url', [SuratPindahApiController::class, 'getDownloadUrl']); // Add this line
    });

    // // Keluhan API

    Route::prefix('keluhan')->group(function () {
        Route::get('/', [ApiKeluhanController::class, 'index']);
        Route::post('/', [ApiKeluhanController::class, 'store']);
        Route::get('/{keluhan}', [ApiKeluhanController::class, 'show']);
        Route::put('/{keluhan}', [ApiKeluhanController::class, 'update']);
        Route::delete('/{keluhan}', [ApiKeluhanController::class, 'destroy']);
        Route::post('/{keluhan}/tanggapi', [ApiKeluhanController::class, 'tanggapi']);
        Route::post('/{keluhan}/selesaikan', [ApiKeluhanController::class, 'selesaikan']);
    });
    // TAMBAHAN: UMKM API (authenticated routes)
    Route::prefix('umkm')->group(function () {
        Route::get('/', [UmkmApiController::class, 'index']);
        Route::post('/', [UmkmApiController::class, 'store']);
        Route::get('/{id}', [UmkmApiController::class, 'show']);
        Route::put('/{id}', [UmkmApiController::class, 'update']);
        // TAMBAHAN: Route POST untuk update dengan file upload
        Route::post('/{id}/update', [UmkmApiController::class, 'updateWithFile']);

        Route::delete('/{id}', [UmkmApiController::class, 'destroy']);
    });

    // APBDes API


});
