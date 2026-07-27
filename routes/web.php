<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LapanganController;
use App\Http\Controllers\Admin\JadwalController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\PembayaranController as AdminPembayaranController;

Route::get('/', function () {
    return view('welcome');
});
// ADMIN //
Route::get('/admin/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('admin.dashboard');

Route::resource('admin/lapangan', LapanganController::class)
    ->names('admin.lapangan')
    ->middleware(['auth','admin']);

Route::resource('admin/jadwal', JadwalController::class)
    ->names('admin.jadwal')
    ->middleware(['auth', 'admin']);

Route::resource('admin/booking', BookingController::class)
    ->names('admin.booking')
    ->middleware(['auth', 'admin']);

Route::resource('admin/pembayaran', AdminPembayaranController::class)
    ->names('admin.pembayaran')
    ->only(['index', 'show', 'update', 'destroy'])
    ->middleware(['auth', 'admin']);

// CUSTOMER //
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/lapangan', [App\Http\Controllers\Customer\LapanganController::class, 'index'])
    ->middleware(['auth'])
    ->name('customer.lapangan.index');

Route::middleware(['auth'])->prefix('booking')->name('booking.')->group(function () {
    Route::get('/', [App\Http\Controllers\Customer\BookingController::class, 'index'])->name('index');
    Route::get('/create/{lapangan?}', [App\Http\Controllers\Customer\BookingController::class, 'create'])->name('create');
    Route::post('/', [App\Http\Controllers\Customer\BookingController::class, 'store'])->name('store');
    Route::get('/{id}', [App\Http\Controllers\Customer\BookingController::class, 'show'])->name('show');
});

Route::middleware(['auth'])->prefix('pembayaran')->name('pembayaran.')->group(function () {
    Route::get('/{bookingId}', [App\Http\Controllers\Customer\PembayaranController::class, 'create'])->name('create');
    Route::post('/{bookingId}', [App\Http\Controllers\Customer\PembayaranController::class, 'store'])->name('store');
});

Route::middleware(['auth'])->prefix('ulasan')->name('ulasan.')->group(function () {
    Route::get('/{bookingId}', [App\Http\Controllers\Customer\UlasanController::class, 'create'])->name('create');
    Route::post('/{bookingId}', [App\Http\Controllers\Customer\UlasanController::class, 'store'])->name('store');
});

// PROFILE //
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// SOCIALITE //
Route::get('/auth/google', [App\Http\Controllers\Auth\SocialiteController::class, 'redirectToGoogle'])
    ->name('auth.google');
Route::get('/auth/google/callback', [App\Http\Controllers\Auth\SocialiteController::class, 'handleGoogleCallback'])
    ->name('auth.google.callback');

require __DIR__.'/auth.php';
