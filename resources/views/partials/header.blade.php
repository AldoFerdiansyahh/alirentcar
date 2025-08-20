<header class="header">
    <a href="{{ route('home') }}" class="logo">ALI <span>RENT</span></a>
    <nav class="navbar">
        {{-- Logic untuk class 'active' agar link menyala sesuai halaman --}}
        <a href="{{ route('home') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
        <a href="{{ route('cars') }}" class="{{ request()->is('cars') ? 'active' : '' }}">Car List</a>
        <a href="{{ route('about') }}" class="{{ request()->is('about') ? 'active' : '' }}">About Us</a>
        <a href="{{ route('contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}">Contact</a>
    </nav>
</header>