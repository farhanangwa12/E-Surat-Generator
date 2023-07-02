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
        Schema::create('lampiranpenawaranhargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->string('total_jumlah')->default(0);
            $table->string('dibulatkan')->default(0);
            $table->string('ppn11')->default(0);
            $table->string('total_harga')->default(0);
            $table->json('datalamp')->nullable();
            // $table->string('kota_surat')->nullable();
            // $table->date('tanggal_surat')->nullable();
            // $table->string('nama_perusahaan')->nullable();
            // $table->string('direktur')->nullable();
            $table->timestamps();
            $table->foreign('id_dokumen')->references('id_dokumen')->on('kelengkapan_dokumen_vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lampiranpenawaranhargas');
    }
};
