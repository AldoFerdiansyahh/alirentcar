@extends('layouts.admin')

@section('title', 'Laporan & Statistik')

@section('content')
<style>
    .dashboard-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 20px; margin-bottom: 30px; }
    .stat-card { background-color: var(--card-bg); padding: 20px; border-radius: 8px; border: 1px solid var(--border-color); display: flex; align-items: center; justify-content: space-between; }
    .stat-info h3 { font-size: 2rem; margin: 0; color: var(--text-dark); }
    .stat-info p { margin: 5px 0 0; color: var(--text-light); font-size: 0.9rem; }
    .stat-icon { font-size: 2.5rem; color: var(--brand-color); opacity: 0.8; }

    .charts-grid { display: grid; grid-template-columns: 2fr 1fr; gap: 20px; }
    @media (max-width: 992px) { .charts-grid { grid-template-columns: 1fr; } }
    
    .chart-container { background-color: var(--card-bg); padding: 20px; border-radius: 8px; border: 1px solid var(--border-color); }
    .chart-header { margin-bottom: 15px; font-weight: 600; color: var(--text-light); }
    
    .list-item { display: flex; justify-content: space-between; padding: 10px 0; border-bottom: 1px solid var(--border-color); }
    .list-item:last-child { border-bottom: none; }

    /* Style untuk Form Filter */
    .filter-box {
        background: var(--card-bg); padding: 15px; border-radius: 8px; 
        margin-bottom: 20px; display: flex; align-items: center; 
        justify-content: space-between; border: 1px solid var(--border-color);
        flex-wrap: wrap; gap: 10px;
    }
    .filter-select {
        background: #333; color: white; border: 1px solid #555; 
        padding: 8px 15px; border-radius: 5px; outline: none;
    }
</style>

{{-- 1. KARTU STATISTIK (RINGKASAN TOTAL) --}}
<div class="dashboard-grid">
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalMobil }}</h3>
            <p>Total Mobil</p>
        </div>
        <i class="fa-solid fa-car stat-icon"></i>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalPenyewaan }}</h3>
            <p>Total Transaksi</p>
        </div>
        <i class="fa-solid fa-file-invoice-dollar stat-icon"></i>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ number_format($totalPendapatan / 1000000, 1, ',', '.') }}jt</h3>
            <p>Total Pendapatan</p>
        </div>
        <i class="fa-solid fa-sack-dollar stat-icon"></i>
    </div>
    <div class="stat-card">
        <div class="stat-info">
            <h3>{{ $totalUser }}</h3>
            <p>Pelanggan Terdaftar</p>
        </div>
        <i class="fa-solid fa-users stat-icon"></i>
    </div>
</div>

{{-- 2. FORM FILTER BULAN & TAHUN --}}
<div class="filter-box">
    <h3 style="margin: 0; color: white; font-size: 1.2rem;">
        <i class="fa-solid fa-filter" style="color: #d9252c; margin-right:8px;"></i> Filter Laporan
    </h3>
    <form action="{{ route('admin.laporan') }}" method="GET" style="display: flex; gap: 10px;">
        <select name="bulan" class="filter-select">
            @foreach(range(1, 12) as $m)
                <option value="{{ $m }}" {{ $selectedMonth == $m ? 'selected' : '' }}>
                    {{ date('F', mktime(0, 0, 0, $m, 1)) }}
                </option>
            @endforeach
        </select>
        <select name="tahun" class="filter-select">
            @for($y = date('Y'); $y >= 2024; $y--)
                <option value="{{ $y }}" {{ $selectedYear == $y ? 'selected' : '' }}>{{ $y }}</option>
            @endfor
        </select>
        <button type="submit" class="btn btn-primary" style="padding: 8px 20px;">Tampilkan</button>
    </form>
</div>

<div class="charts-grid">
    {{-- 3. GRAFIK PENDAPATAN HARIAN --}}
    <div class="chart-container">
        <div class="chart-header">
            Grafik Pendapatan Harian ({{ date('F Y', mktime(0, 0, 0, $selectedMonth, 1, $selectedYear)) }})
        </div>
        <canvas id="incomeChart"></canvas>
    </div>

    {{-- 4. MOBIL TERLARIS & SEDANG DISEWA --}}
    <div style="display: flex; flex-direction: column; gap: 20px;">
        
        {{-- Top Mobil --}}
        <div class="chart-container">
            <div class="chart-header">Top 5 Mobil Terlaris</div>
            @foreach($mobilTerlaris as $item)
            <div class="list-item">
                <span style="color:white;">{{ $item->mobil->nama_mobil ?? 'Dihapus' }}</span>
                <span style="font-weight:bold; color: var(--brand-color);">{{ $item->total }}x Sewa</span>
            </div>
            @endforeach
        </div>

        {{-- Mobil Active --}}
        <div class="chart-container">
            <div class="chart-header">Mobil Sedang Disewa (Active)</div>
            @forelse($mobilSedangDisewa as $sewa)
            <div class="list-item">
                <div>
                    <div style="color:white; font-weight:500;">{{ $sewa->mobil->nama_mobil ?? '-' }}</div>
                    <small style="color:#aaa;">Penyewa: {{ $sewa->nama_lengkap }}</small>
                </div>
                <div style="text-align: right;">
                    <small style="color: var(--brand-color);">Kembali:</small><br>
                    <small style="color: white;">{{ \Carbon\Carbon::parse($sewa->tanggal_selesai)->format('d M') }}</small>
                </div>
            </div>
            @empty
                <p style="color:#aaa; text-align:center;">Tidak ada mobil yang sedang jalan.</p>
            @endforelse
        </div>

    </div>
</div>

{{-- SCRIPT CHART.JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('incomeChart');

    new Chart(ctx, {
        type: 'line', // Ganti ke LINE chart agar lebih enak dilihat per hari
        data: {
            labels: [{{ implode(',', $chartLabels) }}], // Label Tanggal 1 - 31
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: [{{ implode(',', array_values($chartData)) }}], // Data Harian
                backgroundColor: 'rgba(217, 37, 44, 0.2)', // Warna area bawah garis
                borderColor: '#d9252c', // Warna Garis Merah
                borderWidth: 2,
                pointBackgroundColor: '#fff',
                pointRadius: 4,
                fill: true, // Isi warna di bawah garis
                tension: 0.3 // Garis agak melengkung halus
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#333' },
                    ticks: { color: '#aaa' }
                },
                x: {
                    grid: { display: false },
                    ticks: { color: '#aaa' }
                }
            },
            plugins: {
                legend: { labels: { color: '#fff' } },
                tooltip: {
                    callbacks: {
                        title: function(tooltipItems) {
                            return 'Tanggal ' + tooltipItems[0].label;
                        }
                    }
                }
            }
        }
    });
</script>
@endsection