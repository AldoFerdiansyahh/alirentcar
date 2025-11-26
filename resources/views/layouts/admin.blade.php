<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - {{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body>
    <div class="admin-layout">
        
        {{-- DITAMBAHKAN: Tombol Hamburger untuk HP --}}
        <button class="admin-hamburger" id="admin-hamburger">
            <i class="fa-solid fa-bars"></i>
        </button>

        <aside class="sidebar" id="admin-sidebar">
            <div class="sidebar-header">
                <a href="{{ url('/admin/dashboard') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="sidebar-logo">
                </a>
            </div>
            <nav class="sidebar-nav">
                {{-- Logika 'active' di link mobil saya perbaiki sedikit --}}
                <a href="{{ url('/admin/mobils') }}" class="nav-link {{ request()->is('admin/mobils*') ? 'active' : '' }}">
                    <i class="fa-solid fa-car"></i>
                    <span>Data Mobil</span>
                </a>
                <a href="{{ route('admin.pelanggan.index') }}" class="nav-link {{ request()->is('admin/pelanggan*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Data Pelanggan</span>
                </a>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="{{ route('logout') }}"
                       onclick="event.preventDefault(); this.closest('form').submit();"
                       class="nav-link logout-link">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </form>
            </div>
        </aside>

        {{-- DITAMBAHKAN: Overlay untuk latar belakang gelap --}}
        <div class="admin-overlay" id="admin-overlay"></div>

        <main class="main-content">
            <header class="main-header">
                <h2>@yield('title', 'Dashboard')</h2>
            </header>
            <div class="content-wrapper">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                @yield('content')
            </div>
        </main>
    </div>

    {{-- DITAMBAHKAN: JavaScript untuk fungsionalitas menu --}}
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const hamburger = document.getElementById('admin-hamburger');
            const sidebar = document.getElementById('admin-sidebar');
            const overlay = document.getElementById('admin-overlay');

            function toggleMenu() {
                sidebar.classList.toggle('active');
                overlay.classList.toggle('active');
            }

            hamburger.addEventListener('click', toggleMenu);
            overlay.addEventListener('click', toggleMenu);
        });
    </script>
</body>
</html>