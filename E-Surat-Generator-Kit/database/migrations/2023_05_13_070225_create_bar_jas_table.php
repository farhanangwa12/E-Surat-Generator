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
        Schema::create('bar_jas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_jenis_kontrak');
            $table->string('uraian');
            $table->decimal('volume', 10, 2);
            $table->string('satuan');
            // $table->decimal('harga_satuan', 10, 2);
            // $table->decimal('jumlah', 10, 2);
            $table->timestamps();
        
            $table->foreign('id_jenis_kontrak')->references('id')->on('jenis_kontrak')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_jas');
    }
};
