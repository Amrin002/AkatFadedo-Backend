<?php


use App\Http\Controllers\NotificationController;
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
use App\Http\Controllers\SuratPindahController;
use App\Http\Controllers\KeluhanController;
use App\Http\Controllers\NotificationsController;
use App\Models\SuratPindah;

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
// Route::get('/berita-desa', [LandingPageController::class, 'berita'])->name('home');
// routes/web.php
Route::get('/daftar-berita', [LandingPageController::class, 'semua'])->name('home.daftar-berita');
Route::get('/daftar-galeri', [LandingPageController::class, 'galeri'])->name('home.daftar-galeri');
Route::get('/daftar-sturktur-desa', [LandingPageController::class, 'struktur'])->name('home.daftar-sturktur-desa');
Route::get('/berita/{slug}', [LandingPageController::class, 'show'])->name('home.berita');

// Tambahkan di bagian route publik (di luar middleware admin)
Route::get('/verifikasi/{token}', [App\Http\Controllers\SuratVerifikasiController::class, 'verifikasi'])
    ->name('verifikasi.surat');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');
    Route::get('/verifikasi', [App\Http\Controllers\SuratVerifikasiController::class, 'index'])
        ->name('verifikasi.index');

    // Notifications
    // Get unread notifications
    Route::get('/notifications/unread', [NotificationController::class, 'getUnreadNotifications'])
        ->name('notifications.unread');
    Route::post('/notifications/{notificationId}/read', [NotificationController::class, 'markAsRead'])
        ->name('notifications.mark-read');

    // Mark a specific notification as read
    Route::get('/notifications/{notificationId}/read-link', [NotificationController::class, 'markAsReadFromBlade'])
        ->name('notifications.mark-read-link');


    // Mark all notifications as read
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllAsRead'])
        ->name('notifications.mark-all-read');
    // Untuk link dari Blade (GET)
    Route::get('/notifications/{notificationId}/read-link', [NotificationController::class, 'markAsReadFromBlade'])
        ->name('notifications.mark-read-link');


    Route::get('/notifications/mark-all-read-link', [NotificationController::class, 'markAllAsReadFromBlade'])
        ->name('notifications.mark-all-read-link');


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
    Route::resource('/suratpindah', SuratPindahController::class);
    Route::resource('/suratlainnya', SuratLainnyaController::class);
    Route::resource('/fasilitas', FasilitasDesaController::class);
    Route::resource('/struktur', StrukturDesaController::class);
    Route::resource('/galeri', GaleriDesaController::class);
    Route::resource('/berita', BeritaController::class);
    Route::resource('/keluhan', KeluhanController::class);
    Route::get('/suratktu/export/pdf/{id}', [SuratKtuController::class, 'exportPdf'])->name('suratktu.export.pdf');
    Route::get('/suratktm/export/pdf/{id}', [SuratKtmController::class, 'exportPdf'])->name('suratktm.export.pdf');
    Route::get('/suratdomisili/export/pdf/{id}', [SuratDomisiliController::class, 'exportPdf'])->name('suratdomisili.export.pdf');
    Route::get('/suratpindah/export/pdf/{id}', [SuratPindahController::class, 'exportPdf'])->name('suratpindah.export.pdf');
    Route::post('/kk/importkk', [KKController::class, 'importKK'])->name('kk.importkk');
    Route::post('/kk/export', [KKController::class, 'export'])->name('kk.export');
    Route::post('/penduduk/import', [PendudukController::class, 'importPenduduk'])->name('penduduk.import');
    Route::post('/penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::post('/keluhan/{keluhan}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');
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
