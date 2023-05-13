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
        Schema::create('tanda_tangans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrakkerja');
            $table->foreign('id_kontrakkerja')->references('id_kontrakkerja')->on('kontrak_kerjas');
            $table->string('tandatangan_pengadaan')->nullable();
            $table->date('tanggal_tandatangan_pengadaan')->nullable();
            $table->string('tandatangan_manager')->nullable();
            $table->date('tanggaltandatangan_manager')->nullable();
            $table->string('tandatangan_vendor')->nullable();
            $table->date('tanggal_tandatangan_vendor')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tanda_tangans');
    }
};
