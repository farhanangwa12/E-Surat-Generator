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
        Schema::create('kontrak_kerjas', function (Blueprint $table) {
            $table->id('id_kontrakkerja');
            $table->string('nama_kontrak');
            $table->unsignedBigInteger('id_vendor');
            $table->date('tanggal_pekerjaan');
            $table->date('tanggal_akhir_pekerjaan');
            $table->string('lokasi_pekerjaan');
            $table->string('no_urut');
            $table->string('tahun');
            $table->string('kode_masalah');


            $table->enum('status', ['Input pengadaan Fase 1', 'Validasi Tanda Tangan Pengadaan', 'Input Kontrak Vendor', 'Input Pengadaan Fase 2', 'Tanda Tangan Vendor', 'Tanda Tangan Manager']);
            $table->string('filemaster')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontrak_kerjas');
    }
};
