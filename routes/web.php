<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Rute untuk Halaman Home
Route::get('/', function () {
    return view('home');
})->name('home');

// Rute untuk Halaman Car List
Route::get('/cars', function () {
    return view('cars');
})->name('cars');

// Rute untuk Halaman About Us
Route::get('/about', function () {
    return view('about');
})->name('about');

// Rute untuk Halaman Contact
Route::get('/contact', function () {
    return view('contact');
})->name('contact');