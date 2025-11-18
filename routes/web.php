<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
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

});

// admin routes
Route::middleware(['auth', 'adminMiddleware'])->group(function (){

    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Route untuk verifikasi user baru
    Route::get('verifikasi', [AdminController::class, 'showVerificationList'])
        ->name('verification.list');
    Route::patch('verifikasi/{user}/approve', [AdminController::class, 'approveUser'])
        ->name('verification.approve');
    Route::delete('verifikasi/{user}/reject', [AdminController::class, 'rejectUser'])
        ->name('verification.reject');

    // Menampilkan daftar warga aktif
    Route::get('users', [AdminController::class, 'showUserList'])
        ->name('users.list');
    // Menghapus warga aktif (jika diperlukan)
    Route::delete('users/{user}', [AdminController::class, 'destroyUser'])
        ->name('users.destroy');
});
