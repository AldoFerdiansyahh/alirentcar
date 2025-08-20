@extends('layouts.app')

@section('title', 'Daftar Mobil - Ali Rent')

@section('content')
    <div class="page-header">
        <h1>Our Car Collection</h1>
    </div>

    <div class="catalog-container">
        <div class="car-catalog">
            {{-- Tampilkan semua mobil di sini juga --}}
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
            <a href="#">
                <div class="car-card">
                    <img src="{{ asset('images/cars/hiace.png') }}" alt="Toyota Hiace">
                    <h3>HIACE</h3>
                    <div class="price">1300K/DAY</div>
                </div>
            </a>
            {{-- ... Tambahkan semua mobil lainnya di sini ... --}}
        </div>
    </div>
@endsection