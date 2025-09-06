<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mobil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Import Storage untuk mengelola file

class MobilController extends Controller
{
    /**
     * Menampilkan daftar semua mobil.
     */
    public function index()
    {
        $mobils = Mobil::latest()->get(); // Ambil data mobil, diurutkan dari yang terbaru
        return view('admin.mobils.index', compact('mobils'));
    }

    /**
     * Menampilkan form untuk membuat mobil baru.
     */
    public function create()
    {
        return view('admin.mobils.create');
    }

    /**
     * Menyimpan mobil baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi data yang masuk dari form
        $validatedData = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'transmisi' => 'required|string',
            'jumlah_kursi' => 'required|integer',
            'bahan_bakar' => 'required|string',
            'harga_sewa_lepas_kunci' => 'required|integer',
            'harga_sewa_dengan_supir' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Jika ada file gambar yang diupload
        if ($request->hasFile('gambar')) {
            // Simpan gambar ke folder 'storage/app/public/mobil_images'
            // dan simpan path-nya ke data yang akan divalidasi
            $validatedData['gambar'] = $request->file('gambar')->store('mobil_images', 'public');
        }

        // Buat data mobil baru di database
        Mobil::create($validatedData);

        return redirect()->route('mobils.index')->with('success', 'Data mobil berhasil ditambahkan.');
    }

    /**
     * Menampilkan form untuk mengedit mobil.
     * Laravel akan otomatis mencari mobil berdasarkan ID dari URL ($mobil).
     */
    public function edit(Mobil $mobil)
    {
        // Kirim data mobil yang akan diedit ke view 'edit.blade.php'
        return view('admin.mobils.edit', compact('mobil'));
    }

    /**
     * Memperbarui data mobil di database.
     */
    public function update(Request $request, Mobil $mobil)
    {
        // Validasi data yang masuk dari form edit
        $validatedData = $request->validate([
            'nama_mobil' => 'required|string|max:255',
            'merek' => 'required|string|max:255',
            'tahun' => 'required|integer',
            'transmisi' => 'required|string',
            'jumlah_kursi' => 'required|integer',
            'bahan_bakar' => 'required|string',
            'harga_sewa_lepas_kunci' => 'required|integer',
            'harga_sewa_dengan_supir' => 'required|integer',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048'
        ]);

        // Cek jika ada gambar baru yang diupload
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama jika ada
            if ($mobil->gambar) {
                Storage::disk('public')->delete($mobil->gambar);
            }
            // Upload gambar baru dan simpan path-nya
            $validatedData['gambar'] = $request->file('gambar')->store('mobil_images', 'public');
        }

        // Update data mobil di database
        $mobil->update($validatedData);

        return redirect()->route('mobils.index')->with('success', 'Data mobil berhasil diperbarui.');
    }

    /**
     * Menghapus mobil dari database.
     */
    public function destroy(Mobil $mobil)
    {
        // Hapus file gambar dari storage jika ada
        if ($mobil->gambar) {
            Storage::disk('public')->delete($mobil->gambar);
        }

        // Hapus data mobil dari database
        $mobil->delete();

        return redirect()->route('mobils.index')->with('success', 'Data mobil berhasil dihapus.');
    }
    
}

