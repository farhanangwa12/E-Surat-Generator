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
        Schema::create('lamp_negos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_surat');
          
            $table->json('datalampnego')->nullable();
            $table->integer('total_jumlah')->default(0);
            $table->integer('dibulatkan')->default(0);
            $table->integer('ppn11')->default(0);
            $table->integer('total_harga')->default(0);
            $table->timestamps();
            $table->foreign('id_surat')->references('id')->on('pembuatan_surat_kontraks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lamp_negos');
    }
};
