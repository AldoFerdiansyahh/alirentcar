@extends('layouts.app')

@section('title', 'Ali Rent - Sewa Mobil Terpercaya')

@section('content')

    {{-- BAGIAN HERO DENGAN BACKGROUND GAMBAR --}}
    <section class="hero">
        {{-- Background dikembalikan ke sini --}}
        <div class="hero-image" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('/images/bg.png'); background-position: center 75%; background-size: cover;"></div>
        <div class="hero-text">
            <h1>READY FOR RENT</h1>
            <h2>TOUR & TRAVEL</h2>
        </div>
    </section>

    {{-- BAGIAN KATALOG MOBIL --}}
    <div class="catalog-container">
        <div class="car-catalog">
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