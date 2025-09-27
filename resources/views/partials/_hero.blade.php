<section class="hero">
    <div class="hero-image" style="background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.5)), url('/images/bg.png'); background-position: center 75%; background-size: cover;"></div>
    <div class="hero-text">
        {{-- Jika ada class khusus (seperti judul merah), gunakan. Jika tidak, kosongkan. --}}
        <h1 class="{{ $titleClass ?? '' }}">{{ $title }}</h1>

        {{-- Tampilkan subtitle hanya jika ada isinya --}}
        @if(isset($subtitle))
            <h2>{{ $subtitle }}</h2>
        @endif
    </div>
</section>