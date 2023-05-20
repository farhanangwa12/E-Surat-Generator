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
        Schema::create('bar_jas_b_o_q_s', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_boq');
            $table->unsignedBigInteger('id_barjas');
            $table->decimal('harga_satuan', 10, 2);
            $table->decimal('jumlah', 10, 2);
            $table->timestamps();
            $table->foreign('id_barjas')->references('id')->on('bar_jas')->onDelete('cascade');
            $table->foreign('id_boq')->references('id')->on('b_o_q_s')->onDelete('cascade');
           
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bar_jas_b_o_q_s');
    }
};
