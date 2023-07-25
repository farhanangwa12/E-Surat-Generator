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
        // Schema::create('data_vendors', function (Blueprint $table) {
        //     $table->id();
        //     $table->unsignedBigInteger('id_kontrakkerja')->nullable();
        //     $table->unsignedBigInteger('id_vendor')->nullable();
        //     $table->string('penyedia');
        //     $table->string('direktur');
        //     $table->string('alamat_jalan');
        //     $table->string('alamat_kota');
        //     $table->string('alamat_provinsi');
        //     $table->string('bank');
        //     $table->string('nomor_rek');
        //     $table->string('telepon')->nullable();
        //     $table->string('website')->nullable();
        //     $table->string('faksimili')->nullable();
        //     $table->string('email_perusahaan')->nullable();
        //     $table->string('pengawas_pekerjaan')->nullable();
        //     $table->string('pengawas_k3')->nullable();
        //     $table->timestamps();
        //     $table->foreign('id_kontrakkerja')->references('id_kontrakkerja')->on('kontrak_kerjas');
        //     $table->foreign('id_vendor')->references('id_vendor')->on('vendors');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::dropIfExists('data_vendors');
    }
};
