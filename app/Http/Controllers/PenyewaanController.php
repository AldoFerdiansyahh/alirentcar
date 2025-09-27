<?php

namespace App\Http\Controllers;

use App\Models\Penyewaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class PenyewaanController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'mobil_id' => 'required|exists:mobils,id',
            'user_id' => 'required|exists:users,id',
            'nama_lengkap' => 'required|string|max:255',
            'no_hp' => 'required|string|max:20',
            'alamat' => 'required|string',
            'provinsi' => 'required|string',
            'kota' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'total_harga' => 'required|numeric',
            'foto_ktp' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_kk' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_sim_a' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_jaminan' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'foto_npwp' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->file('foto_ktp')) {
            $validatedData['foto_ktp'] = $request->file('foto_ktp')->store('public/dokumen_penyewa');
        }
        if ($request->file('foto_kk')) {
            $validatedData['foto_kk'] = $request->file('foto_kk')->store('public/dokumen_penyewa');
        }
        if ($request->file('foto_sim_a')) {
            $validatedData['foto_sim_a'] = $request->file('foto_sim_a')->store('public/dokumen_penyewa');
        }
        if ($request->file('foto_jaminan')) {
            $validatedData['foto_jaminan'] = $request->file('foto_jaminan')->store('public/dokumen_penyewa');
        }
        if ($request->file('foto_npwp')) {
            $validatedData['foto_npwp'] = $request->file('foto_npwp')->store('public/dokumen_penyewa');
        }

        Penyewaan::create($validatedData);

        return redirect('/')->with('success', 'Permintaan sewa Anda telah berhasil dikirim! Kami akan segera menghubungi Anda untuk konfirmasi.');
    }

    public function indexAdmin()
    {
        $semua_penyewaan = Penyewaan::latest()->get();
        return view('admin.pelanggan.index', ['semua_penyewaan' => $semua_penyewaan]);
    }
    
    // ==========================================================
    // == TAMBAHKAN DUA METHOD DI BAWAH INI ==
    // ==========================================================

    /**
     * Menampilkan halaman detail penyewaan di panel admin.
     */
    public function showAdmin(Penyewaan $penyewaan)
    {
        // Cukup kirim data penyewaan yang ditemukan ke view 'show.blade.php'
        return view('admin.pelanggan.show', compact('penyewaan'));
    }

    /**
     * Memproses update status dari halaman detail admin.
     */
    public function updateStatusAdmin(Request $request, Penyewaan $penyewaan)
    {
        // Validasi input yang masuk dengan daftar status yang baru
        $request->validate([
            'status' => 'required|string|in:Menunggu Konfirmasi,Disetujui,Sedang Disewa,Selesai,Dibatalkan',
        ]);

        // Update kolom status di database
        $penyewaan->status = $request->status;
        $penyewaan->save();

        // Redirect kembali ke halaman daftar pelanggan dengan pesan sukses
        return redirect()->route('admin.pelanggan.index')->with('success', 'Status pemesanan berhasil diperbarui.');
    }
    public function riwayat()
    {
        // Ambil ID user yang sedang login
        $userId = Auth::id();

        // Cari semua data penyewaan yang user_id-nya cocok & urutkan dari yang terbaru
        $penyewaanUser = \App\Models\Penyewaan::where('user_id', $userId)
                                            ->with('mobil') // Ambil juga data mobilnya
                                            ->latest()
                                            ->get();

        // Kirim data tersebut ke halaman view yang akan kita buat nanti
        return view('riwayat', compact('penyewaanUser'));
    }

    public function cetakStruk(Penyewaan $penyewaan)
    {
        // KEAMANAN: Pastikan yang mengakses adalah pemilik struk
        if (Auth::id() !== $penyewaan->user_id) {
            abort(403, 'AKSES DITOLAK');
        }

        // KONDISI: Pastikan statusnya sudah disetujui atau selesai
        $allowedStatus = ['Disetujui', 'Sedang Disewa', 'Selesai'];
        if (!in_array($penyewaan->status, $allowedStatus)) {
            // Jika status tidak diizinkan, kembalikan ke halaman riwayat dengan pesan error
            return redirect()->route('riwayat.index')->with('error', 'Struk belum tersedia untuk pesanan ini.');
        }

        // Jika semua aman, tampilkan halaman struk dengan data yang relevan
        return view('struk', compact('penyewaan'));
    }
}