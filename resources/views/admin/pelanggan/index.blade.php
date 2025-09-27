@extends('layouts.admin') {{-- Pastikan Anda punya layout untuk admin --}}

@section('title', 'Data Pelanggan')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Data Pelanggan & Penyewaan</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Permintaan Sewa</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Pemesan</th>
                            <th>Mobil</th>
                            <th>Tanggal Sewa</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($semua_penyewaan as $penyewaan)
                            <tr>
                                <td>{{ $penyewaan->id }}</td>
                                <td>{{ $penyewaan->nama_lengkap }}</td>
                                <td>{{ $penyewaan->mobil->nama_mobil ?? 'Mobil Dihapus' }}</td>
                                <td>{{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d M Y') }} - {{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d M Y') }}</td>
                                <td>Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    <span class="badge 
                                        @if($penyewaan->status == 'pending') badge-warning 
                                        @elseif($penyewaan->status == 'approved') badge-success 
                                        @else badge-danger @endif">
                                        {{ ucfirst($penyewaan->status) }}
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('admin.pelanggan.show', $penyewaan->id) }}" class="btn btn-secondary">Detail</a>
                                    {{-- Tambahkan tombol lain jika perlu (misal: approve, reject) --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada data permintaan sewa.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection