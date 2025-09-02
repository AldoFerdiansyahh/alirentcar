<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// == RUTE UNTUK HALAMAN PUBLIK ==
Route::get('/', function () {
    return view('home');
})->name('home'); // <-- NAMA 'home' DITAMBAHKAN DI SINI

Route::get('/cars', function () {
    return view('cars');
})->name('cars'); // <-- RUTE BARU DITAMBAHKAN

Route::get('/about', function () {
    return view('about');
})->name('about'); // <-- RUTE BARU DITAMBAHKAN

Route::get('/contact', function () {
    return view('contact');
})->name('contact'); // <-- RUTE BARU DITAMBAHKAN


// == RUTE UNTUK PENGGUNA YANG SUDAH LOGIN ==
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';