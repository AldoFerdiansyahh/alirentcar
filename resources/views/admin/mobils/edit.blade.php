@extends('layouts.admin')

@section('title', 'Edit Data Mobil')

@section('content')
    <div class="card">
        <div class="card-header">
            <h4>Formulir Edit Mobil</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('mobils.update', $mobil->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') {{-- Metode khusus untuk update --}}

                {{-- Semua kolom diisi dengan data mobil yang dipilih --}}
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nama_mobil">Nama Mobil</label>
                            <input type="text" name="nama_mobil" class="form-control" id="nama_mobil" value="{{ old('nama_mobil', $mobil->nama_mobil) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="merek">Merek</label>
                            <input type="text" name="merek" class="form-control" id="merek" value="{{ old('merek', $mobil->merek) }}" required>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="tahun">Tahun</label>
                            <input type="number" name="tahun" class="form-control" id="tahun" value="{{ old('tahun', $mobil->tahun) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="transmisi">Transmisi</label>
                            <select name="transmisi" id="transmisi" class="form-control" required>
                                <option value="Manual" {{ old('transmisi', $mobil->transmisi) == 'Manual' ? 'selected' : '' }}>Manual</option>
                                <option value="Matic" {{ old('transmisi', $mobil->transmisi) == 'Matic' ? 'selected' : '' }}>Matic</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="jumlah_kursi">Jumlah Kursi</label>
                            <input type="number" name="jumlah_kursi" class="form-control" id="jumlah_kursi" value="{{ old('jumlah_kursi', $mobil->jumlah_kursi) }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="bahan_bakar">Bahan Bakar</label>
                            <input type="text" name="bahan_bakar" class="form-control" id="bahan_bakar" value="{{ old('bahan_bakar', $mobil->bahan_bakar) }}" required>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_sewa_lepas_kunci">Harga Sewa (Lepas Kunci)</label>
                            <input type="number" name="harga_sewa_lepas_kunci" class="form-control" id="harga_sewa_lepas_kunci" value="{{ old('harga_sewa_lepas_kunci', $mobil->harga_sewa_lepas_kunci) }}" required>
                        </div>
                    </div>
                     <div class="col-md-6">
                        <div class="form-group">
                            <label for="harga_sewa_dengan_supir">Harga Sewa (Dengan Supir)</label>
                            <input type="number" name="harga_sewa_dengan_supir" class="form-control" id="harga_sewa_dengan_supir" value="{{ old('harga_sewa_dengan_supir', $mobil->harga_sewa_dengan_supir) }}" required>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="gambar">Gambar Mobil (Kosongkan jika tidak ingin diubah)</label>
                    <input type="file" name="gambar" class="form-control" id="gambar">
                    @if($mobil->gambar)
                        <img src="{{ asset('storage/' . $mobil->gambar) }}" alt="Gambar saat ini" class="mt-2" width="150" style="border-radius: 8px;">
                    @endif
                </div>

                <hr>

                <button type="submit" class="btn btn-primary">Update Data</button>
                <a href="{{ route('mobils.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection

