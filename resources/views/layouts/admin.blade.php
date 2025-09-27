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
        <aside class="sidebar">
            <div class="sidebar-header">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="sidebar-logo">
            </div>
            <nav class="sidebar-nav">
                <a href="{{ url('/admin/mobils') }}" class="nav-link active">
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

        <main class="main-content">
            <header class="main-header">
                <h2>@yield('title', 'Dashboard')</h2>
            </header>
            <div class="content-wrapper">
                {{-- =================================== --}}
                {{-- == TAMBAHKAN BLOK KODE INI == --}}
                {{-- =================================== --}}
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
                {{-- =================================== --}}

                @yield('content')
            </div>
        </main>
    </div>
</body>
</html>