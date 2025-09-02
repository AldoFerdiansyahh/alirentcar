<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Laravel akan otomatis membuat nama tabel "mobils" (jamak dari Mobil)
        Schema::create('mobils', function (Blueprint $table) {
            $table->id();
            $table->string('gambar')->nullable();
            $table->string('nama_mobil');
            $table->string('merek');
            $table->year('tahun');
            $table->string('transmisi');
            $table->integer('jumlah_kursi');
            $table->string('bahan_bakar');
            $table->integer('harga_sewa_lepas_kunci');
            $table->integer('harga_sewa_dengan_supir');
            $table->date('tersedia_mulai_tanggal')->nullable();
            $table->date('tersedia_selesai_tanggal')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mobils');
    }
};