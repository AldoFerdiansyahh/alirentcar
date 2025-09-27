@extends('layouts.admin')

@section('title', 'Detail Pesanan #' . $penyewaan->id)

@section('content')
    <div class="row">
        {{-- Kolom Kiri: Detail Pesanan --}}
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Detail Pesanan dari: {{ $penyewaan->nama_lengkap }}</h4>
                </div>
                <div class="card-body">
                    <table class="table">
                        <tr>
                            <th>Mobil</th>
                            <td>{{ $penyewaan->mobil->nama_mobil ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Sewa</th>
                            <td>{{ \Carbon\Carbon::parse($penyewaan->tanggal_mulai)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($penyewaan->tanggal_selesai)->format('d M Y') }}</td>
                        </tr>
                        <tr>
                            <th>Total Harga</th>
                            <td>Rp {{ number_format($penyewaan->total_harga, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <th>No HP</th>
                            <td>{{ $penyewaan->no_hp }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $penyewaan->alamat }}, {{ $penyewaan->kota }}, {{ $penyewaan->provinsi }}</td>
                        </tr>
                         <tr>
                            <th>Dokumen</th>
                            <td>
                                {{-- Anda bisa membuat link untuk melihat dokumen di sini --}}
                                <a href="{{ Storage::url($penyewaan->foto_ktp) }}" target="_blank">Lihat KTP</a> |
                                <a href="{{ Storage::url($penyewaan->foto_sim_a) }}" target="_blank">Lihat SIM A</a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        {{-- Kolom Kanan: Form Update Status --}}
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>Update Status Pesanan</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pelanggan.updateStatus', $penyewaan->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="status">Status Saat Ini: <strong>{{ $penyewaan->status }}</strong></label>
                            <select name="status" id="status" class="form-control">
                                <option value="Menunggu Konfirmasi" {{ $penyewaan->status == 'Menunggu Konfirmasi' ? 'selected' : '' }}>Menunggu Konfirmasi</option>
                                <option value="Disetujui" {{ $penyewaan->status == 'Disetujui' ? 'selected' : '' }}>Disetujui</option>
                                <option value="Sedang Disewa" {{ $penyewaan->status == 'Sedang Disewa' ? 'selected' : '' }}>Sedang Disewa</option>
                                <option value="Selesai" {{ $penyewaan->status == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                <option value="Dibatalkan" {{ $penyewaan->status == 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Update Status</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection