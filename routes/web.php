<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\FasilitasDesaController;
use App\Http\Controllers\GaleriDesaController;
use App\Http\Controllers\KKController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\SuratLainnyaController;
use App\Http\Controllers\PendudukController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StrukturDesaController;
use App\Http\Controllers\SuratKtmController;
use App\Http\Controllers\SuratKtuController;
use App\Http\Controllers\SuratDomisiliController;
use App\Http\Controllers\KeluhanController;



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
    Route::resource('/suratdomisili', SuratDomisiliController::class);
    Route::resource('/suratlainnya', SuratLainnyaController::class);
    Route::resource('/fasilitas', FasilitasDesaController::class);
    Route::resource('/struktur', StrukturDesaController::class);
    Route::resource('/galeri', GaleriDesaController::class);
    Route::resource('/berita', BeritaController::class);
    Route::resource('/keluhan', KeluhanController::class);
    Route::get('/suratktu/export/pdf/{id}', [SuratKtuController::class, 'exportPdf'])->name('suratktu.export.pdf');
    Route::get('/suratktm/export/pdf/{id}', [SuratKtmController::class, 'exportPdf'])->name('suratktm.export.pdf');
    Route::get('/suratdomisili/export/pdf/{id}', [SuratDomisiliController::class, 'exportPdf'])->name('suratdomisili.export.pdf');
    Route::post('/kk/importkk', [KKController::class, 'importKK'])->name('kk.importkk');
    Route::post('/kk/export', [KKController::class, 'export'])->name('kk.export');
    Route::post('/penduduk/import', [PendudukController::class, 'importPenduduk'])->name('penduduk.import');
    Route::post('/penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::post('keluhan/{keluhan}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');
});
Route::get('/forgot-password', [PasswordResetLinkController::class, 'create'])
    ->middleware('guest')
    ->name('password.request');

Route::post('/forgot-password', [PasswordResetLinkController::class, 'store'])
    ->middleware('guest')
    ->name('password.email');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::get('send-email', [MailController::class, 'sendMail']);

require __DIR__ . '/auth.php';
