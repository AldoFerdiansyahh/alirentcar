<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mobil extends Model
{
    use HasFactory;

    // Mendefinisikan kolom yang boleh diisi
    protected $fillable = [
        'gambar',
        'nama_mobil',
        'merek',
        'tahun',
        'transmisi',
        'jumlah_kursi',
        'bahan_bakar',
        'harga_sewa_lepas_kunci',
        'harga_sewa_dengan_supir',
        'tersedia_mulai_tanggal',
        'tersedia_selesai_tanggal',
    ];
}