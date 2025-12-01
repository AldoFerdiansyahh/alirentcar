<header class="header">
    {{-- Logo --}}
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" style="height: 40px;">
    </a>

    {{-- Navigasi --}}
    <nav class="navbar" id="navbar">
        <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Home</a>
        <a href="{{ route('cars') }}" class="{{ request()->routeIs('cars') ? 'active' : '' }}">Car List</a>
        
        {{-- Divider untuk Mobile --}}
        <hr class="navbar-divider">

        @guest
            {{-- Tombol untuk Pengguna yang belum Login --}}
            <div class="navbar-auth-buttons">
                <a href="{{ route('login') }}" class="navbar-button">Login</a>
                <a href="{{ route('register') }}" class="navbar-button navbar-button-primary">Register</a>
            </div>
        @endguest

        @auth
            {{-- Dropdown untuk Pengguna yang sudah Login --}}
            <div class="profile-dropdown">
                <button class="profile-toggle">
                    <i class="fa-solid fa-user"></i>
                </button>
                <div class="dropdown-menu">
                    <div class="dropdown-header">
                        Signed in as<br>
                        <strong>{{ Auth::user()->name }}</strong>
                    </div>
                    <hr class="dropdown-divider">

                    @if(Auth::user()->is_admin)
                        <a href="{{ url('/admin/mobils') }}" class="dropdown-item">Admin Panel</a>
                    @endif

                    {{-- 👇 LINK BARU SUDAH DITAMBAHKAN DI SINI 👇 --}}
                    <a href="{{ route('riwayat.index') }}" class="dropdown-item">Riwayat Penyewaan</a>                    
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">Profile</a>
                    
                    <hr class="dropdown-divider">

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item logout-button">Logout</button>
                    </form>
                </div>
            </div>
        @endauth
    </nav>
    
    {{-- Tombol Hamburger untuk Mobile --}}
    <button class="hamburger-button" id="hamburger-button">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
    </button>
    
    <button class="hamburger-button" id="hamburger-button">
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
        <div class="hamburger-line"></div>
    </button>
</header>