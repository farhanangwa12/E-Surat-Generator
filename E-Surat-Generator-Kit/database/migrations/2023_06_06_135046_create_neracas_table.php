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
        Schema::create('neracas', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_dokumen')->unique();
            $table->date('tanggal_neraca')->nullable();
            $table->decimal('aktiva_lancar', 10, 2)->nullable();
            $table->decimal('utang_jangka_pendek', 10, 2)->nullable();
            $table->decimal('kas', 10, 2)->nullable();
            $table->decimal('utang_dagang', 10, 2)->nullable();
            $table->decimal('utang_pajak', 10, 2)->nullable();
            $table->decimal('piutang', 10, 2)->nullable();
            $table->decimal('persediaan_barang', 10, 2)->nullable();
            $table->decimal('pekerjaan_dalam_proses', 10, 2)->nullable();
            $table->decimal('aktiva_tetap', 10, 2)->nullable();
            $table->decimal('kekayaan_bersih', 10, 2)->nullable();
            $table->decimal('peralatan_dan_mesin_1', 10, 2)->nullable();
            $table->decimal('peralatan_dan_mesin_2', 10, 2)->nullable();
            $table->decimal('inventaris', 10, 2)->nullable();
            $table->decimal('gedung_gedung', 10, 2)->nullable();
            $table->decimal('jumlah_a_b', 10, 2)->nullable();
            $table->decimal('jumlah_d', 10, 2)->nullable();
            $table->decimal('piutang_jangka_pendek_sampai_6_bulan', 10, 2)->nullable();
            $table->decimal('piutang_jangka_pendek_lebih_dari_6_bulan', 10, 2)->nullable();
            $table->decimal('jumlah', 10, 2)->nullable();
            $table->timestamps();
            $table->foreign('id_dokumen')->references('id_dokumen')->on('kelengkapan_dokumen_vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('neracas');
    }
};
