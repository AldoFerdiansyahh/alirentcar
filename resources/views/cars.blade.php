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
                    <img src="https://i.ibb.co/h9Ww1Vn/brio.png" alt="Honda Brio">
                    <h3>BRIO E CVT</h3>
                    <div class="price">375K/DAY</div>
                </div>
            </a>

            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/L5hY59V/raize.png" alt="Toyota Raize">
                    <h3>RAIZE G A/T</h3>
                    <div class="price">450K/DAY</div>
                </div>
            </a>

            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/9gPGRN4/hiace.png" alt="Toyota Hiace">
                    <h3>HIACE</h3>
                    <div class="price">1300K/DAY</div>
                </div>
            </a>
            
            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/3sD82d7/avanza.png" alt="Toyota Avanza">
                    <h3>AVANZA Q MATIC</h3>
                    <div class="price">450K/DAY</div>
                </div>
            </a>

            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/P9tPq2B/fortuner.png" alt="Toyota Fortuner">
                    <h3>FORTUNER GR</h3>
                    <div class="price">1300K/DAY</div>
                </div>
            </a>

            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/J3F6YJ0/jazz.png" alt="Honda Jazz">
                    <h3>JAZZ</h3>
                    <div class="price">400K/DAY</div>
                </div>
            </a>
            
            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/gR1Jj0m/zenix.png" alt="Toyota Zenix">
                    <h3>ZENIX MATIC</h3>
                    <div class="price">1100K/DAY</div>
                </div>
            </a>
            
            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/z5p5Dpk/innova.png" alt="Toyota Innova Reborn">
                    <h3>INNOVA REBORN</h3>
                    <div class="price">650K/DAY</div>
                </div>
            </a>

            <a href="#">
                <div class="car-card">
                    <img src="https://i.ibb.co/Wc63L7g/calya.png" alt="Toyota Calya">
                    <h3>CALYA</h3>
                    <div class="price">350K/DAY</div>
                </div>
            </a>
            {{-- ... Tambahkan semua mobil lainnya di sini ... --}}
        </div>
    </div>
@endsection