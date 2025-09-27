<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            // Perintah untuk HAPUS kolom 'tipe_sewa'
            $table->dropColumn('tipe_sewa');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            // Perintah untuk MENGEMBALIKAN kolom 'tipe_sewa' jika diperlukan
            $table->string('tipe_sewa')->after('tanggal_selesai');
        });
    }
};