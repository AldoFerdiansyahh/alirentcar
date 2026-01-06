<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            // Menambahkan kolom tipe_sewa setelah kolom tanggal_selesai
            $table->string('tipe_sewa')->after('tanggal_selesai')->default('lepas_kunci'); 
        });
    }

    public function down()
    {
        Schema::table('penyewaans', function (Blueprint $table) {
            $table->dropColumn('tipe_sewa');
        });
    }
};
