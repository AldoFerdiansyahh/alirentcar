@extends('layouts.app')

@section('title', 'Riwayat Penyewaan Saya')

@push('styles')
<style>
    .history-panel {
        background-color: #2c2c2e; /* Warna panel seperti di admin */
        border: 1px solid #444;
        border-radius: 8px;
        overflow: hidden;
    }
    .panel-header {
        background-color: #1e1e1e; /* Header panel lebih gelap */
        padding: 1rem 1.5rem;
        font-size: 1.1rem;
        font-weight: 600;
        border-bottom: 1px solid #444;
    }
    .history-table {
        width: 100%;
        border-collapse: collapse;
    }
    .history-table thead {
        background-color: #3a3a3c; /* Warna header tabel */
    }
    .history-table th {
        padding: 1rem 1.5rem;
        text-align: left;
        font-weight: 500;
        color: #e0e0e0;
        text-transform: uppercase;
        font-size: 0.8rem;
        border-bottom: 1px solid #444;
    }
    .history-table tbody tr {
        border-bottom: 1px solid #444;
        transition: background-color 0.2s ease-in-out;
    }
    .history-table tbody tr:last-child {
        border-bottom: none;
    }
    .history-table tbody tr:hover {
        background-color: #38383a;
    }
    .history-table td {
        padding: 1.2rem 1.5rem; /* Padding lebih besar agar tidak sempit */
        vertical-align: middle;
        color: #f0f0f0;
    }
    .history-table td .car-name {
        font-weight: 600;
    }
    .status-badge {
        padding: 0.4em 0.8em;
        border-radius: 20px;
        font-size: 0.85em;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        gap: 0.5em;
    }
    .status-approved { background-color: #28a745; color: white; }
    .status-cancelled { background-color: #dc3545; color: white; }
    .status-pending { background-color: #ffc107; color: #212529; }

    .action-buttons {
        display: flex;
        gap: 0.75rem;
    }
    .btn-action {
        text-decoration: none;
        padding: 0.5rem 1rem;
        border-radius: 5px;
        font-size: 0.9rem;
        transition: all 0.2s;
        border: 1px solid transparent;
        cursor: pointer;
        font-weight: 500;
    }
    .btn-cetak {
        background-color: #0d6efd;
        border-color: #0d6efd;
        color: white;
    }
    .btn-cetak:hover {
        background-color: #0b5ed7;
        border-color: #0a58ca;
    }
    .btn-sewa-lagi {
        background-color: transparent;
        border-color: #28a745;
        color: #28a745;
    }
    .btn-sewa-lagi:hover {
        background-color: #28a745;
        color: white;
    }
    .empty-row td {
        text-align: center;
        padding: 3rem;
        color: #888;
    }
    .page-title {
        text-align: center;
        font-style: italic;
        color: #e53935; /* Warna merah seperti contoh */
        font-size: 2.5rem; /* Ukuran font lebih besar */
        margin-top: 40px;
        margin-bottom: 40px; /* Jarak bawah lebih besar */
        font-weight: bold;
    }

    /* === 👇 KODE TAMBAHAN UNTUK TAMPILAN MOBILE DIMULAI DARI SINI 👇 === */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.8rem; /* Perkecil judul di HP */
        }
        .history-table thead {
            display: none; /* Sembunyikan header tabel di HP */
        }
        .history-table tr {
            display: block; /* Ubah baris menjadi blok/kartu */
            border: 1px solid #555;
            border-radius: 8px;
            margin-bottom: 1rem;
            background-color: #343a40 !important; /* Pakai !important untuk menimpa hover effect */
        }
        .history-table td {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: right;
            padding: 0.8rem 1rem;
            border-bottom: 1px solid #444;
        }
        .history-table td:last-child {
            border-bottom: none;
        }
        .history-table td::before {
            content: attr(data-label); /* Tampilkan label dari atribut data-label */
            font-weight: 600;
            text-align: left;
            margin-right: 1rem;
            color: #ccc;
        }
        .action-buttons {
            justify-content: flex-end;
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="container" style="padding-top: 80px; padding-bottom: 80px;">
    <div class="row">
        <div class="col-md-12">
                
            <h1 class="page-title">Riwayat Penyewaan Saya</h1>

            <div class="history-panel">
                <div class="table-responsive">
                    <table class="history-table">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Mobil</th>
                                <th>Tanggal Sewa</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            {{-- 👇 ATRIBUT DATA-LABEL DITAMBAHKAN PADA SETIAP <td> DI BAWAH INI 👇 --}}
                            @forelse ($penyewaanUser as $sewa)
                                <tr>
                                    <td data-label="ID"><strong>#{{ $sewa->id }}</strong></td>
                                    <td data-label="Mobil"><span class="car-name">{{ $sewa->mobil->nama_mobil ?? 'Mobil Dihapus' }}</span></td>
                                    <td data-label="Tanggal Sewa">{{ \Carbon\Carbon::parse($sewa->tanggal_mulai)->format('d M Y') }} &mdash; {{ \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('d M Y') }}</td>
                                    <td data-label="Total Harga">Rp {{ number_format($sewa->total_harga, 0, ',', '.') }}</td>
                                    <td data-label="Status">
                                        @php
                                            $statusInfo = ['class' => '', 'icon' => ''];
                                            if(in_array($sewa->status, ['Disetujui', 'Selesai', 'Sedang Disewa'])) {
                                                $statusInfo['class'] = 'status-approved'; $statusInfo['icon'] = 'fa-solid fa-check-circle';
                                            } elseif ($sewa->status == 'Dibatalkan') {
                                                $statusInfo['class'] = 'status-cancelled'; $statusInfo['icon'] = 'fa-solid fa-times-circle';
                                            } else {
                                                $statusInfo['class'] = 'status-pending'; $statusInfo['icon'] = 'fa-solid fa-clock';
                                            }
                                        @endphp
                                        <span class="status-badge {{ $statusInfo['class'] }}">
                                            <i class="{{ $statusInfo['icon'] }}"></i>
                                            {{ $sewa->status }}
                                        </span>
                                    </td>
                                    <td data-label="Aksi">
                                        <div class="action-buttons">
                                            @if(in_array($sewa->status, ['Disetujui', 'Sedang Disewa', 'Selesai']))
                                                <a href="{{ route('struk.cetak', $sewa) }}" target="_blank" class="btn-action btn-cetak">Cetak</a>
                                            @endif
                                            @if($sewa->mobil)
                                                <a href="{{ route('cars.show', $sewa->mobil->id) }}" class="btn-action btn-sewa-lagi">Sewa Lagi</a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr class="empty-row">
                                    <td colspan="6">Anda belum pernah melakukan penyewaan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection