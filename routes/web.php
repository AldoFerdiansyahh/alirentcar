<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\MobilController;
use App\Http\Controllers\PenyewaanController;
use App\Http\Controllers\Admin\DashboardController; // <--- PENTING: Ini memanggil Koki Dashboard
use App\Http\Controllers\Admin\LaporanController; // Tambahkan di atas

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE UNTUK HALAMAN PUBLIK ==
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

// == GRUP RUTE KHUSUS ADMIN ==
Route::middleware(['auth', 'is_admin'])->group(function () {
    
    // Perhatikan bagian ini baik-baik:
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/laporan', [LaporanController::class, 'index'])->name('admin.laporan');
    Route::resource('/admin/mobils', MobilController::class );
});

// Route untuk menyimpan data permintaan sewa dari form user
Route::post('/sewa/store', [PenyewaanController::class, 'store'])->name('sewa.store');

// Route untuk menampilkan data pelanggan di panel admin
Route::get('/admin/pelanggan', [PenyewaanController::class, 'indexAdmin'])->name('admin.pelanggan.index');

// Route detail & update status
Route::get('/admin/pelanggan/{penyewaan}', [PenyewaanController::class, 'showAdmin'])->name('admin.pelanggan.show');
Route::post('/admin/pelanggan/{penyewaan}/update-status', [PenyewaanController::class, 'updateStatusAdmin'])->name('admin.pelanggan.updateStatus');

// Route untuk menampilkan Riwayat Pelanggan
Route::get('/riwayat', [\App\Http\Controllers\PenyewaanController::class, 'riwayat'])->middleware('auth')->name('riwayat.index');

// Route untuk menampilkan dan mencetak struk
Route::get('/struk/{penyewaan}', [PenyewaanController::class, 'cetakStruk'])
     ->middleware('auth')
     ->name('struk.cetak');

require __DIR__.'/auth.php';