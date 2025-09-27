<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mobil_id',
        'nama_lengkap',
        'no_hp',
        'alamat',
        'provinsi',
        'kota',
        'foto_ktp',
        'foto_kk',
        'foto_sim_a',
        'foto_npwp',
        'foto_jaminan',
        'tanggal_mulai',
        'tanggal_selesai',
        'tipe_sewa',
        'total_harga',
        'status',
    ];

    /**
     * Mendefinisikan relasi "belongsTo" ke model Mobil.
     * Artinya, satu data penyewaan dimiliki oleh satu mobil.
     */
    public function mobil()
    {
        return $this->belongsTo(Mobil::class);
    }

    /**
     * Mendefinisikan relasi "belongsTo" ke model User.
     * Artinya, satu data penyewaan dimiliki oleh satu user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}