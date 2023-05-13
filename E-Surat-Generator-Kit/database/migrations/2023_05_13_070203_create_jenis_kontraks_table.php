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
        Schema::create('jenis_kontrak', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrak');
            $table->string('nama_jenis');
            $table->foreign('id_kontrak')->references('id_kontrakkerja')->on('kontrak_kerjas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jenis_kontraks');
    }
};
