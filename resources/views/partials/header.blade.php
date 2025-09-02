<header class="header">
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/logo.png') }}" alt="Ali Rent Logo" style="height: 45px; vertical-align: middle;">
    </a>

    <button id="hamburger-button" class="hamburger-button">
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
        <span class="hamburger-line"></span>
    </button>

    <nav id="navbar" class="navbar">
        {{-- Menu Utama --}}
        <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('cars') }}" class="{{ request()->is('cars') ? 'active' : '' }}">Car List</a>
        <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
        <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
        
        <hr class="navbar-divider">

        {{-- Logika untuk Tombol Login/Logout --}}
        @auth
            {{-- Bagian ini akan tampil jika pengguna SUDAH LOGIN --}}
            <a href="{{ url('/dashboard') }}" class="navbar-user-name">
                {{ Auth::user()->name }}
            </a>
            <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                @csrf
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); this.closest('form').submit();"
                   class="navbar-button navbar-button-logout">
                    Logout
                </a>
            </form>
        @else
            {{-- Bagian ini akan tampil jika pengguna BELUM LOGIN --}}
            <a href="{{ route('login') }}" class="navbar-button">Login</a>
            <a href="{{ route('register') }}" class="navbar-button navbar-button-primary">Register</a>
        @endauth
    </nav>
</header>