@extends('layouts.app')

@section('title', 'Ali Rent - Sewa Mobil Terpercaya')

@section('content')

@include('partials._hero', [
    'title' => 'READY FOR RENT', 
    'subtitle' => 'TOUR & TRAVEL'
])

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