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
        Schema::create('kelengkapan_dokumen_vendors', function (Blueprint $table) {
            $table->bigIncrements('id_dokumen');
            $table->unsignedBigInteger('id_jenis_dokumen');
            $table->unsignedBigInteger('id_vendor');
            $table->unsignedBigInteger('id_kontrakkerja')->nullable();
            $table->foreign('id_jenis_dokumen')->references('id_jenis')->on('jenis_dokumen_kelengkapans');
            $table->foreign('id_vendor')->references('id_vendor')->on('vendors');
            $table->foreign('id_kontrakkerja')->references('id_kontrakkerja')->on('kontrak_kerjas');
            $table->string('file_upload')->nullable();
            $table->string('tandatangan')->nullable();
            $table->json('data_dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kelengkapan_dokumen_vendors');
    }
};
