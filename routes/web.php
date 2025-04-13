<?php

use App\Exports\KKExport;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\FasilitasDesaController;
use App\Http\Controllers\GaleriDesaController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukturDesaController;
use App\Http\Controllers\SuratKtmController;
use App\Http\Controllers\SuratKtuController;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
Route::get('/', [LandingPageController::class, 'index'])->name('home');

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');
    // Route::resource('dashboard', AdminController::class,);
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('/pengguna', PenggunaController::class);
    Route::resource('/penduduk', PendudukController::class);
    Route::resource('/kk', KKController::class);
    Route::resource('/suratktu', SuratKtuController::class);
    Route::resource('/suratktm', SuratKtmController::class);
    Route::resource('/fasilitas', FasilitasDesaController::class);
    Route::resource('/struktur', StrukturDesaController::class);
    Route::resource('/galeri', GaleriDesaController::class);
    Route::get('/suratktu/export/pdf/{id}', [SuratKtuController::class, 'exportPdf'])->name('suratktu.export.pdf');
    Route::get('/suratktm/export/pdf/{id}', [SuratKtmController::class, 'exportPdf'])->name('suratktm.export.pdf');
    Route::post('/kk/importkk', [KKController::class, 'importKK'])->name('kk.importkk');
    Route::post('/kk/export', [KKController::class, 'export'])->name('kk.export');
    Route::post('/penduduk/import', [PendudukController::class, 'importPenduduk'])->name('penduduk.import');
    Route::post('/penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
});
require __DIR__ . '/auth.php';
