<?php


use App\Http\Controllers\AppVersionController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SuratKptController;
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
use App\Http\Controllers\ApbdesController;
use App\Http\Controllers\ArsipSuratController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\SuratVerifikasiController;
use App\Http\Controllers\WhatsappController;
use App\Models\Apbdes;
use App\Models\SuratPindah;
use Illuminate\Support\Facades\Log;

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
Route::fallback(function () {
    return response()->view('Errors.404', [], 404);
});

Route::get('/privacy', [LandingPageController::class, 'privacy']);
Route::get('/', [LandingPageController::class, 'index'])->name('home');
// Route::get('/berita-desa', [LandingPageController::class, 'berita'])->name('home');
// routes/web.php
Route::get('/daftar-berita', [LandingPageController::class, 'semua'])->name('home.daftar-berita');
Route::get('/daftar-galeri', [LandingPageController::class, 'galeri'])->name('home.daftar-galeri');
Route::get('/daftar-sturktur-desa', [LandingPageController::class, 'struktur'])->name('home.daftar-sturktur-desa');
Route::get('/berita/{slug}', [LandingPageController::class, 'show'])
    ->where('slug', '^(?!create$|[0-9]+).*')
    ->name('home.berita');

Route::get('/apbdes-view', [ApbdesController::class, 'tampilUntukUser'])->name('apbdes.view');
Route::delete('/apbdes/{id}', [ApbdesController::class, 'destroy'])->name('apbdes.destroy');
Route::get('/apbdes-view', [ApbdesController::class, 'viewUser'])->name('apbdes.viewUser');
Route::patch('/apbdes/{id}', [ApbdesController::class, 'update'])->name('apbdes.update');

// Tambahkan di bagian route publik (di luar middleware admin)
Route::get('/verifikasi/{token}', [App\Http\Controllers\SuratVerifikasiController::class, 'verifikasi'])
    ->name('verifikasi.surat');
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin'])->name('dashboard');
    Route::get('/verifikasi', [App\Http\Controllers\SuratVerifikasiController::class, 'index'])
        ->name('verifikasi.index');
    Route::delete('/verifikasi/{id}', [SuratVerifikasiController::class, 'destroy'])->name('verifikasi.destroy');

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
    Route::resource('/apbdes', ApbdesController::class);
    Route::resource('/fasilitas', FasilitasDesaController::class);
    Route::resource('/struktur', StrukturDesaController::class);
    Route::resource('/galeri', GaleriDesaController::class);
    Route::resource('/berita', BeritaController::class);
    Route::resource('/keluhan', KeluhanController::class);
    Route::get('/keluhan/{id}/edit', [KeluhanController::class, 'edit'])->name('keluhan.edit');
    Route::put('/keluhan/{id}', [KeluhanController::class, 'update'])->name('keluhan.update');

    Route::post('/keluhan/{keluhan}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');
    Route::post('/keluhan/{keluhan}/selesaikan', [KeluhanController::class, 'selesaikan'])->name('keluhan.selesaikan');
    Route::get('/suratktu/export/pdf/{id}', [SuratKtuController::class, 'exportPdf'])->name('suratktu.export.pdf');
    Route::get('/suratktm/export/pdf/{id}', [SuratKtmController::class, 'exportPdf'])->name('suratktm.export.pdf');
    Route::get('/suratdomisili/export/pdf/{id}', [SuratDomisiliController::class, 'exportPdf'])->name('suratdomisili.export.pdf');
    Route::get('/suratpindah/export/pdf/{id}', [SuratPindahController::class, 'exportPdf'])->name('suratpindah.export.pdf');
    Route::post('/kk/importkk', [KKController::class, 'importKK'])->name('kk.importkk');
    Route::post('/kk/export', [KKController::class, 'export'])->name('kk.export');
    Route::post('/penduduk/import', [PendudukController::class, 'importPenduduk'])->name('penduduk.import');
    Route::post('/penduduk/export', [PendudukController::class, 'export'])->name('penduduk.export');
    Route::post('/keluhan/{keluhan}/tanggapi', [KeluhanController::class, 'tanggapi'])->name('keluhan.tanggapi');

     Route::resource('/suratkpt', SuratKptController::class);
    
    // Route export PDF untuk Surat KPT
    Route::get('/suratkpt/export/pdf/{id}', [SuratKptController::class, 'exportPdf'])->name('suratkpt.export.pdf');
    // route arsip
    // Export route - HARUS sebelum resource
    Route::get('/arsip/export/csv', [ArsipSuratController::class, 'exportCsv'])->name('arsip.export.csv');
    Route::resource('arsip', ArsipSuratController::class);

    // Route AppVersion
    Route::prefix('/app-version')->name('app-version.')->group(function () {
        Route::get('/', [AppVersionController::class, 'index'])->name('index');
        Route::get('/create', [AppVersionController::class, 'create'])->name('create');
        Route::post('/', [AppVersionController::class, 'store'])->name('store');
        Route::get('/{id}', [AppVersionController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [AppVersionController::class, 'edit'])->name('edit');
        Route::put('/{id}', [AppVersionController::class, 'update'])->name('update');
        Route::delete('/{id}', [AppVersionController::class, 'destroy'])->name('destroy');
        Route::patch('/{id}/toggle-active', [AppVersionController::class, 'toggleActive'])->name('toggle-active');
    });
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
