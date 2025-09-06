<?php

namespace App\Http\Controllers;

use App\Models\Mobil;
use Illuminate\Http\Request;

class PageController extends Controller
{
    // Menampilkan halaman utama dengan beberapa mobil
    public function home()
    {
        $mobils = Mobil::latest()->take(6)->get(); // Ambil 6 mobil terbaru
        return view('home', compact('mobils'));
    }

    // Menampilkan semua mobil di halaman Car List
    public function cars()
    {
        $mobils = Mobil::all(); // Ambil SEMUA data mobil
        return view('cars', compact('mobils'));
    }

    // Menampilkan detail satu mobil
    public function show(Mobil $mobil)
    {
        return view('detail', compact('mobil'));
    }
}