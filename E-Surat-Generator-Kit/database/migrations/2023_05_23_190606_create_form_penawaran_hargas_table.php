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
        Schema::create('form_penawaran_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_dokumen');
            $table->string('kopsurat')->nullable();
            $table->string('kopsuratpath')->default('dokumenvendor/kopsurat');
            $table->string('nomor')->nullable();
            $table->string('lampiran')->nullable();
            $table->string('nama_kota')->nullable();
            $table->date('tanggal_pembuatan_surat')->nullable();
            $table->json('data_surat')->nullable();
            // $table->string('nama_vendor')->nullable();
            // $table->string('jabatan')->nullable();
            // $table->string('nama_perusahaan')->nullable();
       
            // $table->string('alamat_perusahaan')->nullable();
            // $table->string('telepon_fax')->nullable();
            // $table->string('email_perusahaan')->nullable();
            $table->string('harga_penawaran')->nullable();
            $table->string('ppn11')->nullable();
            $table->string('jumlah_harga')->nullable();
            $table->timestamps();
            $table->foreign('id_dokumen')->references('id_dokumen')->on('kelengkapan_dokumen_vendors')->onDelete('cascade');
            // Tambahkan kolom tanggal_tandatangan
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_penawaran_harga');
    }
};
