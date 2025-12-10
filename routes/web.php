<?php

use App\Http\Controllers\ProfileController;

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\LayananController;
use App\Http\Controllers\User\LayananPersuratanController;
use App\Http\Controllers\User\RiwayatController;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\PengajuanSuratController;

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

// user routes
Route::middleware(['auth', 'userMiddleware'])->group(function (){

    Route::get('dashboard', [UserController::class, 'index'])->name('user.dashboard');

    // Route untuk layanan pengguna
    Route::get('dashboard/layanan', [LayananController::class, 'index'])->name('user.layanan');
    Route::get('dashboard/layanan/kedatangan', [LayananController::class, 'kedatangan'])->name('user.layanan.kedatangan');
    Route::get('dashboard/layanan/kelahiran', [LayananController::class, 'kelahiran'])->name('user.layanan.kelahiran');
    Route::get('dashboard/layanan/kepindahan', [LayananController::class, 'kepindahan'])->name('user.layanan.kepindahan');

    // Route untuk list pengajuan surat
    Route::get('dashboard/layananDesa', [LayananPersuratanController::class, 'index'])->name('user.listlayanan');
    Route::get('/layanan/{slug}', [LayananPersuratanController::class, 'show'])->name('layanan.show');
    Route::post('/layanan/{slug}', [LayananPersuratanController::class, 'store'])->name('layanan.store');
    Route::get('/pengajuan/{id}/pdf', [LayananPersuratanController::class,'downloadPdf'])->name('pengajuan.pdf');

    // Route untuk riwayat pengajuan
    Route::get('dashboard/RiwayatPengajuan', [RiwayatController::class, 'index'])->name('user.riwayat');
        Route::get('riwayat/{id}', [RiwayatController::class, 'show'])->name('user.riwayat.show');
    Route::get('riwayat/{id}/download', [RiwayatController::class, 'download'])->name('user.riwayat.download');

});

// admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function (){

    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route untuk verifikasi user baru
    Route::get('verifikasi', [AdminController::class, 'showVerificationList'])->name('verification.list');
    Route::patch('verifikasi/{user}/approve', [AdminController::class, 'approveUser'])->name('verification.approve');
    Route::delete('verifikasi/{user}/reject', [AdminController::class, 'rejectUser'])->name('verification.reject');

    // Menampilkan daftar warga aktif
    Route::get('users', [AdminController::class, 'showUserList'])->name('users.list');
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');

    // Route untuk manajemen pengajuan surat
    Route::get('/admin/pengajuan', [PengajuanSuratController::class, 'index'])->name('admin.pengajuan.index');
    Route::get('/admin/pengajuan/{id}', [PengajuanSuratController::class, 'show'])->name('admin.pengajuan.show');
    Route::post('/admin/pengajuan/{id}/approve', [PengajuanSuratController::class, 'approve'])->name('admin.pengajuan.approve');
    Route::post('/admin/pengajuan/{id}/reject', [PengajuanSuratController::class, 'reject'])->name('admin.pengajuan.reject');
    Route::get('/admin/pengajuan/{id}/download', [PengajuanSuratController::class, 'download'])->name('admin.pengajuan.download');
});
