<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use App\Models\Penyewaan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request; // PENTING: Tambahkan ini

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        // --- 1. AMBIL FILTER DARI REQUEST ---
        // Default ke bulan & tahun sekarang jika tidak ada pilihan
        $selectedMonth = $request->input('bulan', date('m'));
        $selectedYear = $request->input('tahun', date('Y'));

        // --- 2. DATA RINGKASAN (TETAP GLOBAL/SEMUA WAKTU) ---
        $totalMobil = Mobil::count();
        $totalUser = User::where('is_admin', false)->count();
        $totalPenyewaan = Penyewaan::count();
        $totalPendapatan = Penyewaan::whereIn('status', ['Selesai', 'Disetujui', 'Sedang Disewa'])->sum('total_harga');

        // --- 3. GRAFIK PENDAPATAN HARIAN (BERDASARKAN FILTER) ---
        $pendapatanHarian = Penyewaan::select(
                DB::raw('DAY(created_at) as tanggal'),
                DB::raw('SUM(total_harga) as total')
            )
            ->whereYear('created_at', $selectedYear)
            ->whereMonth('created_at', $selectedMonth)
            ->whereIn('status', ['Selesai', 'Disetujui', 'Sedang Disewa'])
            ->groupBy('tanggal')
            ->orderBy('tanggal')
            ->get();

        // Hitung jumlah hari dalam bulan yang dipilih (28/29/30/31)
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, $selectedYear);
        
        // Siapkan Label (1, 2, 3 ... 31) dan Data (0, 0, 500000 ...)
        $chartLabels = range(1, $daysInMonth);
        $chartData = array_fill(1, $daysInMonth, 0);

        foreach ($pendapatanHarian as $data) {
            $chartData[$data->tanggal] = $data->total;
        }

        // --- 4. DATA LAINNYA ---
        $mobilSedangDisewa = Penyewaan::where('status', 'Sedang Disewa')
                                      ->with('mobil', 'user')->latest()->take(5)->get();

        $mobilTerlaris = Penyewaan::select('mobil_id', DB::raw('count(*) as total'))
            ->groupBy('mobil_id')->orderByDesc('total')
            ->take(5)->with('mobil')->get();

        return view('admin.laporan', compact(
            'totalMobil', 'totalUser', 'totalPenyewaan', 'totalPendapatan',
            'chartLabels', 'chartData', // Data grafik baru
            'mobilSedangDisewa', 'mobilTerlaris',
            'selectedMonth', 'selectedYear' // Kirim pilihan user kembali ke view
        ));
    }
} 