@extends('layouts.app')

@section('title', 'Ali Rent - Sewa Mobil Terpercaya')

@section('content')
    <section class="hero">
        <h1>READY FOR RENT</h1>
        <h2>CAR LIST</h2>
    </section>

    <div class="catalog-container">
        <div class="car-catalog">
            {{-- Letakkan semua .car-card di sini, sama seperti prototipe --}}
            {{-- Ganti path gambar menggunakan helper asset() --}}
            <a href="#">
                <div class="car-card">
                    <img src="{{ asset('images/cars/brio.png') }}" alt="Honda Brio">
                    <h3>BRIO E CVT</h3>
                    <div class="price">375K/DAY</div>
                </div>
            </a>
            <a href="#">
                <div class="car-card">
                    <img src="{{ asset('images/cars/raize.png') }}" alt="Toyota Raize">
                    <h3>RAIZE G A/T</h3>
                    <div class="price">450K/DAY</div>
                </div>
            </a>
            {{-- ... Tambahkan mobil lainnya di sini ... --}}
        </div>
    </div>
@endsection