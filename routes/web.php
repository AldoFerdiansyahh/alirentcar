<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Admin\MobilController;

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

require __DIR__.'/auth.php';