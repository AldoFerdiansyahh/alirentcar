@extends('layouts.app')

@section('title', 'Detail Mobil - ' . $mobil->nama_mobil)

@section('content')
    <div class="page-header" style="padding: 60px 20px;">
        <h1>{{ $mobil->nama_mobil }}</h1>
        <h2 style="font-size: 1.5em;">{{ $mobil->merek }} - {{ $mobil->tahun }}</h2>
    </div>

    <div class="container">
        <div class="detail-layout">
            
            {{-- KOLOM KIRI: DETAIL SPESIFIKASI MOBIL --}}
            <div class="detail-specs-card">
                <div class="detail-image">
                    <img src="{{ asset('storage/' . $mobil->gambar) }}" alt="{{ $mobil->nama_mobil }}">
                </div>
                <div class="specs-content">
                    <h3>Spesifikasi Lengkap</h3>
                    <ul>
                        <li><strong><i class="fa-solid fa-gears"></i> Transmisi:</strong> {{ $mobil->transmisi }}</li>
                        <li><strong><i class="fa-solid fa-chair"></i> Jumlah Kursi:</strong> {{ $mobil->jumlah_kursi }}</li>
                        <li><strong><i class="fa-solid fa-gas-pump"></i> Bahan Bakar:</strong> {{ $mobil->bahan_bakar }}</li>
                    </ul>
                    <hr>
                    {{-- BAGIAN INI SUDAH DIUBAH --}}
                    <h3>Harga Sewa</h3>
                    <p style="font-size: 1.2em; font-weight: bold;">
                        Rp {{ number_format($mobil->harga_sewa_lepas_kunci, 0, ',', '.') }}/hari
                    </p>
                </div>
            </div>

            {{-- KOLOM KANAN: TAMPILKAN FORM JIKA SUDAH LOGIN --}}
            @auth
            <div class="penyewaan-form-card">
                <h3>Formulir Penyewaan</h3>
                <form action="{{ route('sewa.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <input type="hidden" name="mobil_id" value="{{ $mobil->id }}">
                    <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

                    <div class="form-group">
                        <label for="nama_lengkap">Nama Lengkap</label>
                        <input type="text" id="nama_lengkap" name="nama_lengkap" class="form-control" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>

                    <div class="form-group">
                        <label for="no_hp">No. HP</label>
                        <input type="tel" id="no_hp" name="no_hp" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="provinsi">Provinsi</label>
                        <select id="provinsi" name="provinsi" class="form-control" required>
                            <option value="">Memuat provinsi...</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="kota">Kota/Kabupaten</label>
                        <select id="kota" name="kota" class="form-control" required>
                            <option value="">Pilih Provinsi Terlebih Dahulu</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="alamat">Alamat Lengkap</label>
                        <textarea id="alamat" name="alamat" class="form-control" rows="3" required></textarea>
                    </div>

                    <div class="form-group">
                        <label>Upload Dokumen (KTP, KK, SIM A)</label>
                        <div class="file-input"><label for="foto_ktp">KTP:</label><input type="file" id="foto_ktp" name="foto_ktp" required></div>
                        <div class="file-input"><label for="foto_kk">KK:</label><input type="file" id="foto_kk" name="foto_kk" required></div>
                        <div class="file-input"><label for="foto_sim_a">SIM A:</label><input type="file" id="foto_sim_a" name="foto_sim_a" required></div>
                        <div class="file-input"><label for="foto_npwp">NPWP (Opsional):</label><input type="file" id="foto_npwp" name="foto_npwp"></div>
                    </div>

                    <div class="form-group">
                        <label for="foto_jaminan">Jaminan (Kartu Karyawan/Mahasiswa)</label>
                        <input type="file" id="foto_jaminan" name="foto_jaminan" required>
                    </div>

                    <hr>

                    {{-- DROPDOWN TIPE SEWA SUDAH DIHAPUS DARI SINI --}}
                    
                    <div class="form-group">
                        <label for="tanggal_mulai">Tanggal Mulai</label>
                        <input type="date" id="tanggal_mulai" name="tanggal_mulai" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tanggal_selesai">Tanggal Selesai</label>
                        <input type="date" id="tanggal_selesai" name="tanggal_selesai" class="form-control" required>
                    </div>
                    
                    <div class="price-calculation">
                        <h4>Total Harga:</h4>
                        <p id="total-harga">Rp 0</p>
                        <input type="hidden" name="total_harga" id="input-total-harga" value="0">
                    </div>

                    <button type="submit" class="btn-pesan">Kirim Permintaan Sewa</button>
                </form>
            </div>
            @endauth

            {{-- KOLOM KANAN: TAMPILKAN PESAN JIKA BELUM LOGIN --}}
            @guest
            <div class="penyewaan-form-card">
                <h3>Formulir Penyewaan</h3>
                <div class="login-prompt" style="text-align: center; padding: 20px;">
                    <p style="margin-bottom: 20px;">Anda harus login terlebih dahulu untuk dapat menyewa mobil.</p>
                    <a href="{{ route('login') }}" class="btn-pesan" style="text-decoration: none; display: inline-block; margin-right: 10px;">Login</a>
                    <a href="{{ route('register') }}" class="btn-sekunder" style="text-decoration: none; display: inline-block;">Daftar</a>
                </div>
            </div>
            @endguest

        </div>
    </div>

    {{-- SCRIPT SUDAH DIUBAH TOTAL --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Cek apakah form ada sebelum menjalankan script
            const penyewaanForm = document.querySelector('.penyewaan-form-card form');
            if (!penyewaanForm) {
                return; // Hentikan script jika form tidak ada (user belum login)
            }
    
            // --- BAGIAN DROPDOWN WILAYAH (TETAP SAMA) ---
            const provinsiDropdown = document.getElementById('provinsi');
            const kotaDropdown = document.getElementById('kota');
    
            fetch('https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json')
                .then(response => response.json())
                .then(provinces => {
                    provinsiDropdown.innerHTML = '<option value="">Pilih Provinsi...</option>';
                    provinces.forEach(province => {
                        const option = document.createElement('option');
                        option.value = province.id;
                        option.textContent = province.name;
                        provinsiDropdown.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error fetching provinces:', error);
                    provinsiDropdown.innerHTML = '<option value="">Gagal memuat data</option>';
                });
    
            provinsiDropdown.addEventListener('change', function() {
                const provinceId = this.value;
                kotaDropdown.innerHTML = '<option value="">Memuat kota...</option>';
                if (provinceId) {
                    fetch(`https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${provinceId}.json`)
                        .then(response => response.json())
                        .then(regencies => {
                            kotaDropdown.innerHTML = '<option value="">Pilih Kota/Kabupaten...</option>';
                            regencies.forEach(regency => {
                                const option = document.createElement('option');
                                option.value = regency.id;
                                option.textContent = regency.name;
                                kotaDropdown.appendChild(option);
                            });
                        })
                        .catch(error => {
                            console.error('Error fetching regencies:', error);
                            kotaDropdown.innerHTML = '<option value="">Gagal memuat data</option>';
                        });
                } else {
                    kotaDropdown.innerHTML = '<option value="">Pilih Provinsi Terlebih Dahulu</option>';
                }
            });
    
            // --- BAGIAN KALKULASI HARGA OTOMATIS (VERSI BARU) ---
            const tanggalMulaiInput = document.getElementById('tanggal_mulai');
            const tanggalSelesaiInput = document.getElementById('tanggal_selesai');
            const totalHargaElement = document.getElementById('total-harga');
            
            // Hanya menggunakan satu harga
            const hargaPerHari = {{ $mobil->harga_sewa_lepas_kunci }};
    
            function calculateTotalPrice() {
                const tanggalMulai = new Date(tanggalMulaiInput.value);
                const tanggalSelesai = new Date(tanggalSelesaiInput.value);
    
                if (!tanggalMulaiInput.value || !tanggalSelesaiInput.value || tanggalSelesai < tanggalMulai || isNaN(tanggalMulai) || isNaN(tanggalSelesai)) {
                    totalHargaElement.textContent = 'Rp 0';
                    document.getElementById('input-total-harga').value = 0;
                    return;
                }
    
                const timeDiff = tanggalSelesai.getTime() - tanggalMulai.getTime();
                const jumlahHari = Math.max(0, Math.round(timeDiff / (1000 * 3600 * 24))) + 1;
    
                const totalHarga = jumlahHari * hargaPerHari;
    
                totalHargaElement.textContent = 'Rp ' + totalHarga.toLocaleString('id-ID');
                document.getElementById('input-total-harga').value = totalHarga;
            }
    
            tanggalMulaiInput.addEventListener('change', calculateTotalPrice);
            tanggalSelesaiInput.addEventListener('change', calculateTotalPrice);
        });
    </script>
@endsection