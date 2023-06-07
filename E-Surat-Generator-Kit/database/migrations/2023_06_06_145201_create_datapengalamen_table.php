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
        Schema::create('datapengalamen', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->unsignedBigInteger('id_vendor');

            $table->string('kota_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('nama_jelas')->nullable();
            $table->string('jabatan')->nullable();
            $table->timestamps();
            $table->foreign('id_dokumen')->references('id_dokumen')->on('kelengkapan_dokumen_vendors')->onDelete('cascade');
            $table->foreign('id_vendor')->references('id_vendor')->on('vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('datapengalamen');
    }
};
