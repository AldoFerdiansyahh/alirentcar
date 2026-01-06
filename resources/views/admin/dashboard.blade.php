@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div style="
        display: flex; 
        flex-direction: column; 
        justify-content: center; 
        align-items: center; 
        min-height: 70vh; 
        text-align: center;
    ">
        
        {{-- Ikon Admin Besar --}}
        <div style="font-size: 5rem; color: #d9252c; margin-bottom: 20px;">
            <i class="fa-solid fa-user-gear"></i>
        </div>

        {{-- Ucapan Selamat Datang --}}
        <h1 style="font-size: 2.5rem; font-weight: 700; color: #ffffff; margin-bottom: 10px;">
            Selamat Datang, {{ Auth::user()->name }}!
        </h1>

        {{-- Deskripsi Singkat --}}
        <p style="font-size: 1.1rem; color: #a0aec0; max-width: 600px; line-height: 1.6;">
            Anda berada di <strong>Dashboard Admin</strong> Ali Rent Car. <br>
            Silakan gunakan menu di samping untuk mengelola data mobil dan pelanggan.
        </p>
    </div>
@endsection