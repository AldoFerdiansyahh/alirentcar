<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\PenyewaanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE UNTUK HALAMAN PUBLIK (INI YANG BENAR) ==
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/cars', [PageController::class, 'cars'])->name('cars');
Route::get('/cars/{mobil}', [PageController::class, 'show'])->name('cars.show');

Route::get('/about', function () {
    return view('about');
})->name('about');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');


// == RUTE UNTUK PENGGUNA YANG SUDAH LOGIN ==
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// GRUP RUTE KHUSUS ADMIN
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    
    Route::resource('/admin/mobils', MobilController::class);
});

// Route untuk menyimpan data permintaan sewa dari form user
Route::post('/sewa/store', [PenyewaanController::class, 'store'])->name('sewa.store');

// Route untuk menampilkan data pelanggan di panel admin
Route::get('/admin/pelanggan', [PenyewaanController::class, 'indexAdmin'])->name('admin.pelanggan.index');

// == TAMBAHKAN DUA BARIS DI BAWAH INI ==
Route::get('/admin/pelanggan/{penyewaan}', [PenyewaanController::class, 'showAdmin'])->name('admin.pelanggan.show');
Route::post('/admin/pelanggan/{penyewaan}/update-status', [PenyewaanController::class, 'updateStatusAdmin'])->name('admin.pelanggan.updateStatus');
// ======================================

// Route untuk menampilkan  Riwayat Pelanggan
Route::get('/riwayat', [\App\Http\Controllers\PenyewaanController::class, 'riwayat'])->middleware('auth')->name('riwayat.index');

// Route untuk menampilkan dan mencetak struk
Route::get('/struk/{penyewaan}', [PenyewaanController::class, 'cetakStruk'])
     ->middleware('auth')
     ->name('struk.cetak');

require __DIR__.'/auth.php';