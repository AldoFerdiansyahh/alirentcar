<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Ali Rent')</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- Stylesheet Utama Anda --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">


    @vite(['resources/css/app.css', 'resources/js/app.js'])


    {{-- 👇 TAMBAHKAN 'KOTAK POS' UNTUK CSS TAMBAHAN DI SINI 👇 --}}
    @stack('styles')

</head>
<body class="font-sans antialiased">
    
    @include('partials.header')

    <main>
        @if (isset($slot))
            {{ $slot }}
        @else
            @yield('content')
        @endif
    </main>
    
    @include('partials.footer') 

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const hamburgerButton = document.getElementById('hamburger-button');
        const navbar = document.getElementById('navbar');
        const profileToggle = document.querySelector('.profile-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        // Buka/Tutup menu mobile saat hamburger di-klik
        hamburgerButton.addEventListener('click', function(e) {
            e.stopPropagation();
            this.classList.toggle('active');
            navbar.classList.toggle('active');
        });

        // Buka/Tutup dropdown profil saat ikon user di-klik
        if (profileToggle) {
            profileToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('active');
            });
        }
    });
</script>
    </body>
</html>