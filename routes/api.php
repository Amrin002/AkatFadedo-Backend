<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\Api\PasswordResetApiController;
use App\Http\Controllers\Api\SuratDomisiliApiController;
use App\Http\Controllers\Api\SuratKtmApiController;
use App\Http\Controllers\Api\SuratKtuApiController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
// Route::get('/users', [AuthController::class, 'index']);

Route::post('/forgot-password', [PasswordResetApiController::class, 'sendResetLinkEmail']);
Route::post('/reset-password', [PasswordResetApiController::class, 'reset']);
Route::post('/send-otp', [PasswordResetApiController::class, 'sendOtp']);
Route::post('/reset-password/otp', [PasswordResetApiController::class, 'resetWithOtp']);




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
    });

    // Surat KTU API
    Route::prefix('suratktu')->group(function () {
        Route::get('/{id}/export', [SuratKtuApiController::class, 'exportPdf']);
        Route::get('/', [SuratKtuApiController::class, 'index']);
        Route::post('/', [SuratKtuApiController::class, 'store']);
        Route::get('/{id}', [SuratKtuApiController::class, 'show']);
        Route::put('/{id}', [SuratKtuApiController::class, 'update']);
        Route::delete('/{id}', [SuratKtuApiController::class, 'destroy']);
    });

    // Surat Domisili API
    Route::prefix('suratdomisili')->group(function () {
        Route::get('/{id}/export', [SuratDomisiliApiController::class, 'exportPdf']);
        Route::get('/', [SuratDomisiliApiController::class, 'index']);
        Route::post('/', [SuratDomisiliApiController::class, 'store']);
        Route::get('/{id}', [SuratDomisiliApiController::class, 'show']);
        Route::put('/{id}', [SuratDomisiliApiController::class, 'update']);
        Route::delete('/{id}', [SuratDomisiliApiController::class, 'destroy']);
    });
});


