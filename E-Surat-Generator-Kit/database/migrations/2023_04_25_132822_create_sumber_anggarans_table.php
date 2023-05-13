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
        Schema::create('sumber_anggarans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrakkerja');
            $table->foreign('id_kontrakkerja')->references('id_kontrakkerja')->on('kontrak_kerjas');
            $table->string('skk_ao');
            $table->date('tanggal_anggaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sumber_anggarans');
    }
};
