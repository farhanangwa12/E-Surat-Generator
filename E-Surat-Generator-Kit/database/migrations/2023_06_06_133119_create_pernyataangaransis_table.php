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
        Schema::create('pernyataangaransis', function (Blueprint $table) {
            $table->unsignedBigInteger('id_dokumen')->unique();
            $table->string('pekerjaan')->nullable();
            $table->string('tahun_anggaran')->nullable();
            $table->string('nama')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('nama_perusahaan')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('alamat')->nullable();
            $table->string('telepon_fax')->nullable();
            $table->string('email_perusahaan')->nullable();
            $table->string('nama_pekerjaan')->nullable();
            $table->string('no_rks')->nullable();
            $table->date('tanggal_rks')->nullable();
            $table->string('kota_surat')->nullable();
            $table->date('tanggal_surat')->nullable();
            $table->timestamps();

            $table->foreign('id_dokumen')->references('id_dokumen')->on('kelengkapan_dokumen_vendors')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pernyataangaransis');
    }
};
