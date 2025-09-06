@extends('layouts.admin')

@section('title', 'Data Mobil')

@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('mobils.create') }}" class="btn btn-primary">Tambah Mobil</a>
        </div>
        <div class="card-body">
            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th style="width: 5%;">ID</th>
                            <th style="width: 20%; text-align: center;">Gambar</th>
                            <th style="width: 30%;">Mobil</th>
                            <th style="width: 20%;">Harga Lepas Kunci</th>
                            <th style="width: 25%;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($mobils as $mobil)
                            <tr>
                                <td>{{ $mobil->id }}</td>
                                <td style="text-align: center;">
                                    @if($mobil->gambar)
                                        <img src="{{ asset('storage/' . $mobil->gambar) }}" alt="{{ $mobil->nama_mobil }}" width="120" style="border-radius: 8px;">
                                    @else
                                        <span>Tidak ada gambar</span>
                                    @endif
                                </td>
                                <td>
                                    {{-- NAMA MOBIL DI ATAS (lebih besar) --}}
                                    <div style="font-weight: 600; font-size: 1.1em;">{{ $mobil->nama_mobil }}</div>
                                    {{-- MEREK DI BAWAH (lebih kecil) --}}
                                    <small style="color: #a0aec0;">{{ $mobil->merek }}</small>
                                </td>
                                <td>Rp {{ number_format($mobil->harga_sewa_lepas_kunci, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('mobils.edit', $mobil->id) }}" class="btn btn-warning">Edit</a>
                                    <form action="{{ route('mobils.destroy', $mobil->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus mobil ini?')">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center">Data belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

