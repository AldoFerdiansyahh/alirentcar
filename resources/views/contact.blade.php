@extends('layouts.app')

@section('title', 'Hubungi Kami - Ali Rent')

@section('content')

@include('partials._hero', [
    'title' => 'Contact Us',
    'titleClass' => 'page-title'
])

    <div class="page-header">
    </div>
    
    <div class="container">
        <div class="page-content">
            <h2>Informasi Kontak</h2>
            <p>
                Jangan ragu untuk menghubungi kami jika Anda memiliki pertanyaan atau ingin melakukan pemesanan. Tim kami siap membantu Anda.
            </p>
            <ul>
                <li><strong>Telepon / WhatsApp:</strong> 0882-0002-39168</li>
                <li><strong>Email:</strong> contact@alirent.com</li>
                <li><strong>Alamat:</strong> Jl. Contoh No. 123, Bandung, Jawa Barat</li>
            </ul>
        </div>
    </div>
@endsection