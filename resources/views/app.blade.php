<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Ali Rent')</title> {{-- Judul default jika tidak di-set --}}
    
    {{-- Memanggil file CSS dari folder public --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    {{-- Memasukkan partials header --}}
    @include('partials.header')

    <main>
        {{-- Di sini konten dari setiap halaman akan ditampilkan --}}
        @yield('content')
    </main>

    {{-- Anda bisa menambahkan footer di sini jika perlu --}}
    {{-- @include('partials.footer') --}}

</body>
</html>