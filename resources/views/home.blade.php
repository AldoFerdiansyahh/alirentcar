@extends('layouts.app')

@section('title', 'Ali Rent - Sewa Mobil Terpercaya')

@section('content')
    <section class="hero">
        <div class="hero-image" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('/images/bg.png'); background-position: center 75%; background-size: cover;"></div>
        <div class="hero-text">
            <h1>READY FOR RENT</h1>
            <h2>TOUR & TRAVEL</h2>
        </div>
    </section>

    {{-- BAGIAN KATALOG MOBIL --}}
    <div class="catalog-container">
        <div class="car-catalog">
            
            {{-- Mulai perulangan untuk setiap mobil dari database --}}
            @forelse ($mobils as $mobil)
                <div class="car-card">
                    {{-- Cek jika ada gambar, jika tidak tampilkan gambar default --}}
                    @if($mobil->gambar)
                        <img src="{{ asset('storage/' . $mobil->gambar) }}" alt="{{ $mobil->nama_mobil }}">
                    @else
                        {{-- Buat gambar default di public/images/default-car.png --}}
                        <img src="{{ asset('images/default-car.png') }}" alt="{{ $mobil->nama_mobil }}">
                    @endif
                    
                    <h3>{{ $mobil->merek }}</h3>
                    <h2>{{ $mobil->nama_mobil }}</h2>
                    
                    <a href="{{ route('cars.show', $mobil->id) }}" class="price">Lihat Detail</a>
                </div>
            @empty
                {{-- Tampilan ini akan muncul jika tidak ada mobil di database --}}
                <p style="text-align: center; grid-column: 1 / -1; color: white;">Belum ada mobil yang tersedia. Silakan tambahkan data dari panel admin.</p>
            @endforelse

        </div>
    </div>
@endsection