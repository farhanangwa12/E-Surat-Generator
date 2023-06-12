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
            $table->integer('total_jumlah')->default(0);
            $table->integer('dibulatkan')->default(0);
            $table->integer('ppn11')->default(0);
            $table->integer('total_harga')->default(0);
            $table->json('datalampiran')->nullable();
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
