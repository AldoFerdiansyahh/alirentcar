@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div style="background: #d9252c; padding: 20px; border-radius: 8px; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        <p>Selamat Datang di Halaman Admin, {{ Auth::user()->name }}!</p>
        <p>Dari sini Anda bisa mengelola seluruh data website.</p>
    </div>
@endsection