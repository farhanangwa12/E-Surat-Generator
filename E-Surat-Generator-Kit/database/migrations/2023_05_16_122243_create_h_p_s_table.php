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
        Schema::create('h_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat');
            $table->integer('total_jumlah')->default(0);
            $table->integer('dibulatkan')->default(0);
            $table->integer('rok10')->default(0);
            $table->integer('ppn11')->default(0);
            $table->integer('total_harga')->default(0);
            
            // $table->string('tandatangan_pengadaan')->nullable();
            // $table->dateTime('tanggal_tandatangan_pengadaan')->nullable();
            // $table->string('tandatangan_manager')->nullable();
            // $table->dateTime('tanggal_tandatangan_manager')->nullable();
            $table->timestamps();
            $table->foreign('id_surat')->references('id')->on('pembuatan_surat_kontraks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('h_p_s');
    }
};
