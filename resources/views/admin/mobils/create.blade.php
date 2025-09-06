@extends('layouts.admin')

@section('title', 'Tambah Mobil Baru')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Formulir Data Mobil</h4>
        </div>
        <div class="card-body">
            {{-- Form akan mengirim data ke rute mobils.store --}}
            <form action="{{ route('mobils.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                {{-- Blok untuk menampilkan error validasi --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Whoops!</strong> Ada masalah dengan input Anda.<br><br>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Baris untuk Nama Mobil & Merek --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_mobil">Nama Mobil</label>
                            <input type="text" name="nama_mobil" class="form-control" id="nama_mobil" value="{{ old('nama_mobil') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" name="merek" class="form-control" id="merek" value="{{ old('merek') }}" required>
                        </div>
                    </div>
                </div>
                
                {{-- Baris untuk Tahun & Transmisi --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" name="tahun" class="form-control" id="tahun" value="{{ old('tahun') }}" required placeholder="Contoh: 2023">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transmisi">Transmisi</label>
                            <select name="transmisi" id="transmisi" class="form-control" required>
                                <option value="" disabled selected>Pilih Tipe Transmisi</option>
                                <option value="Manual" {{ old('transmisi') == 'Manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Matic" {{ old('transmisi') == 'Matic' ? 'selected' : '' }}>Matic</option>
                            </select>
                        </div>
                    </div>
                </div>

                {{-- Baris untuk Kursi & Bahan Bakar --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_kursi">Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control" id="jumlah_kursi" value="{{ old('jumlah_kursi') }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bahan_bakar">Bahan Bakar</label>
                            <input type="text" name="bahan_bakar" class="form-control" id="bahan_bakar" value="{{ old('bahan_bakar') }}" required placeholder="Contoh: Bensin, Solar">
                        </div>
                    </div>
                </div>

                {{-- Baris untuk Harga Sewa --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_sewa_lepas_kunci">Harga Sewa (Lepas Kunci)</label>
                            <input type="number" name="harga_sewa_lepas_kunci" class="form-control" id="harga_sewa_lepas_kunci" value="{{ old('harga_sewa_lepas_kunci') }}" required placeholder="Contoh: 350000">
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_sewa_dengan_supir">Harga Sewa (Dengan Supir)</label>
                            <input type="number" name="harga_sewa_dengan_supir" class="form-control" id="harga_sewa_dengan_supir" value="{{ old('harga_sewa_dengan_supir') }}" required placeholder="Contoh: 500000">
                        </div>
                    </div>
                </div>

                {{-- Input untuk Gambar --}}
                <div class="form-group">
                    <label for="gambar">Gambar Mobil</label>
                    <input type="file" name="gambar" class="form-control" id="gambar">
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

