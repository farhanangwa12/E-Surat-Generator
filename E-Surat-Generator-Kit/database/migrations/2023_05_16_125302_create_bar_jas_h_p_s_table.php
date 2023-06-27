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
        Schema::create('bar_jas_h_p_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_hps');
            $table->unsignedBigInteger('id_barjas');
            $table->string('harga_satuan');
            $table->string('jumlah');
            $table->timestamps();
            $table->foreign('id_barjas')->references('id')->on('bar_jas')->onDelete('cascade');
            $table->foreign('id_hps')->references('id')->on('h_p_s')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_jas_h_p_s');
    }
};
