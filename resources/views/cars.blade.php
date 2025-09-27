@extends('layouts.app')

@section('title', 'Daftar Mobil - Ali Rent')

@section('content')

@include('partials._hero', [
    'title' => 'Our Car Collection',
    'titleClass' => 'page-title' // Ini akan memanggil style judul merah
])

<div class="page-header">
    </div>

    <div class="catalog-container">
        <div class="car-catalog">
            
            {{-- Memulai perulangan untuk setiap data mobil dari database --}}
            @forelse ($mobils as $mobil)
                {{-- Setiap mobil dibungkus dalam div .car-card agar stylenya sama --}}
                <div class="car-card">
                    {{-- Cek jika ada gambar, jika tidak, tampilkan gambar default --}}
                    @if($mobil->gambar)
                        <img src="{{ asset('storage/' . $mobil->gambar) }}" alt="{{ $mobil->nama_mobil }}">
                    @else
                        {{-- Anda bisa membuat gambar default di public/images/default-car.png --}}
                        <img src="{{ asset('images/default-car.png') }}" alt="{{ $mobil->nama_mobil }}">
                    @endif
                    
                    <h3>{{ $mobil->merek }}</h3>
                    <h2 style="font-size: 1.5em; margin: 5px 0 15px 0;">{{ $mobil->nama_mobil }}</h2>
                    
                    {{-- Tombol "Lihat Detail" yang mengarah ke halaman detail mobil --}}
                    <a href="{{ route('cars.show', $mobil->id) }}" class="price">Lihat Detail</a>
                </div>
            @empty
                {{-- Tampilan ini akan muncul jika tidak ada mobil di database --}}
                <div style="text-align: center; grid-column: 1 / -1; color: white; background-color: rgba(35,35,35,0.5); padding: 40px; border-radius: 15px;">
                    <h3>Mohon Maaf</h3>
                    <p>Belum ada mobil yang tersedia saat ini. Silakan cek kembali nanti.</p>
                </div>
            @endforelse

        </div>
    </div>
@endsection

