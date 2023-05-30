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
        Schema::create('pembuatan_surat_kontraks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrakkerja');
            $table->foreign('id_kontrakkerja')->references('id_kontrakkerja')->on('kontrak_kerjas')->onDelete('cascade');
            $table->string('nama_surat');
            $table->string('no_surat')->nullable();
            $table->date('tanggal_pembuatan');
            $table->text('datasurat')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembuatan_surat_kontraks');
    }
};
