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
        Schema::create('b_o_q_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrakkerja');
            $table->integer('total_jumlah')->default(0);
            $table->integer('dibulatkan')->default(0);
            // $table->integer('rok10')->default(0);
            $table->integer('ppn11')->default(0);
            $table->integer('total_harga')->default(0);
            $table->timestamps();
            $table->string('tandatangan_direktur')->nullable();
            $table->date('tanggal_tandatangan')->nullable();
            $table->foreign('id_kontrakkerja')->references('id_kontrakkerja')->on('kontrak_kerjas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('b_o_q_s');
    }
};
