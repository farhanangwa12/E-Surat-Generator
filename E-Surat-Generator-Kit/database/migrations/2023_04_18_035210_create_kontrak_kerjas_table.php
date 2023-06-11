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
            $table->date('tanggal_spmk')->nullable();
            $table->string('no_spmk')->nullable();
            $table->date('tanggal_kontrak')->nullable();
            $table->date('tanggal_pekerjaan')->nullable();
            $table->date('tanggal_akhir_pekerjaan')->nullable();
            $table->string('lokasi_pekerjaan');
            $table->string('no_urut');
            $table->string('tahun');
            $table->enum('kode_masalah', [
                'DAN.01.01',
                'DAN.01.02',
                'DAN.01.03'
            ]);


            // $table->enum('status', ['Input pengadaan Fase 1', 'Validasi Tanda Tangan Pengadaan', 'Input Kontrak Vendor', 'Input Pengadaan Fase 2', 'Tanda Tangan Vendor', 'Tanda Tangan Manager']);
            $table->enum('status', [
                'Dokumen Input Pengadaan Tahap 1',
                'Validasi Dokumen Pengadaan Tahap 1',
                'Dokumen Input Vendor',
                'Dokumen Input Pengadaan Tahap 2',
                'Validasi Dokumen Pengadaan Tahap 2',
                'Tanda Tangan Vendor',
                'Kontrak dibatalkan',
                'Kontrak disetujui',
                'Tanda Tangan Manager',
                'Kontrak Kerja Berjalan'
            ]);
        
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
