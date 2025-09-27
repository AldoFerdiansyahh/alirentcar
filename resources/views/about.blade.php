@extends('layouts.app')

@section('title', 'Tentang Kami - Ali Rent')

@section('content')

@include('partials._hero', [
    'title' => 'About Us',
    'titleClass' => 'page-title'
])

    <div class="page-header">
    </div>

    <div class="container">
        <div class="page-content">
            <h2>Mitra Perjalanan Tepercaya Anda</h2>
            <p>
                Kami adalah mitra perjalanan tepercaya Anda, menyediakan koleksi mobil sewa premium yang terawat dengan baik untuk memastikan setiap perjalanan Anda, baik untuk bisnis maupun liburan, berlangsung aman, nyaman, dan berkesan.
            </p>
        </div>
    </div>
@endsection