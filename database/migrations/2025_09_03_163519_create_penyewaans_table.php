<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Penyewa
            $table->foreignId('mobil_id')->constrained('mobils')->onDelete('cascade'); // ID Mobil yang disewa
            $table->string('nama_lengkap');
            $table->string('no_hp');
            $table->text('alamat');
            $table->string('provinsi');
            $table->string('kota');
            $table->string('foto_ktp');
            $table->string('foto_kk');
            $table->string('foto_sim_a');
            $table->string('foto_npwp')->nullable(); // Opsional
            $table->string('foto_jaminan');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('tipe_sewa'); // Lepas Kunci / Dengan Supir
            $table->decimal('total_harga', 15, 2);
            $table->string('status')->default('Menunggu Konfirmasi');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};