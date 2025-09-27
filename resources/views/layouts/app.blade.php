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
        // Script untuk Hamburger Menu
        const hamburgerButton = document.getElementById('hamburger-button');
        const navbar = document.getElementById('navbar');

        hamburgerButton.addEventListener('click', (e) => {
            e.stopPropagation(); // Mencegah klik menyebar ke window
            navbar.classList.toggle('active');
        });

        // Script untuk Profile Dropdown
        const profileToggle = document.querySelector('.profile-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        if (profileToggle) {
            profileToggle.addEventListener('click', function(event) {
                event.stopPropagation(); // Mencegah klik menyebar ke window
                dropdownMenu.classList.toggle('active');
            });
        }

        // Klik di mana saja di luar menu untuk menutupnya
        window.addEventListener('click', function(event) {
            // Tutup navbar mobile jika klik di luar navbar dan hamburger
            if (navbar.classList.contains('active') && !navbar.contains(event.target) && !hamburgerButton.contains(event.target)) {
                navbar.classList.remove('active');
            }
            
            // Tutup dropdown profile jika klik di luar dropdown dan tombolnya
            if (dropdownMenu && dropdownMenu.classList.contains('active') && !dropdownMenu.contains(event.target) && !profileToggle.contains(event.target)) {
                dropdownMenu.classList.remove('active');
            }
        });
    </script>
    </body>
</html>