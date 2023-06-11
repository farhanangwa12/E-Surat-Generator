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
        Schema::create('subdatapengalamen', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('id_datapengalaman');



            $table->string('bidang_pekerjaan');
            $table->string('sub_bidang_pekerjaan');
            $table->string('lokasi');
            $table->string('nama_pemberi_tugas');
            $table->string('alamat_pemberi_tugas');
            $table->string('no_tanggal_kontrak');
            $table->string('nilai');

            $table->string('kontrak');
            $table->string('ba_serah_terima');
            $table->timestamps();
            $table->foreign('id_datapengalaman')->references('id')->on('datapengalamen')->onDelete('cascade');
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subdatapengalamen');
    }
};
