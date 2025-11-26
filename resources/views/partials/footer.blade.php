<footer class="footer">
    <div class="footer-container">
        
        {{-- Kolom 1: Logo dan Deskripsi Singkat --}}
        <div class="footer-column">
            <img src="{{ asset('images/logo.png') }}" alt="Ali Rent Logo" class="footer-logo">
            <p class="footer-description">
                Kami adalah mitra perjalanan tepercaya Anda, menyediakan koleksi mobil sewa premium yang terawat dengan baik untuk memastikan setiap perjalanan Anda, baik untuk bisnis maupun liburan, berlangsung aman, nyaman, dan berkesan.
            </p>
        </div>

        {{-- Kolom 2: Informasi / Link Cepat --}}
        <div class="footer-column">
            <h4>Informasi</h4>
            <ul>
                <li><a href="{{ route('home') }}">Beranda</a></li>
                <li><a href="{{ route('cars') }}">Daftar Mobil</a></li>
                <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                <li><a href="{{ route('contact') }}">Kontak</a></li>
            </ul>
        </div>

        {{-- Kolom 3: Kontak dan Alamat --}}
        <div class="footer-column">
            <h4>Kontak Kami</h4>
            <p><strong>Telepon:</strong><br> +62 812 3456 7890</p>
            <p><strong>Email:</strong><br> info@alirentcar.com</p>
            <p><strong>Alamat:</strong><br> Jl. Kopo Permai I Blok Y No. 6, Sukamenak, Kecamatan Margahayu, Kabupaten Bandung</p>
        </div>

    </div>
    
    {{-- Bagian Bawah Footer: Copyright --}}
    <div class="footer-bottom">
        <p>&copy; {{ date('Y') }} Ali Rent Car. All Rights Reserved.</p>
    </div>
</footer>