<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('form_penawaran_harga', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_kontrakkerja');
            $table->unsignedBigInteger('id_vendor');
            $table->string('kopsurat')->nullable();
            $table->string('file_path');
            $table->string('file_tandatangan')->nullable();
            $table->string('no_unik_ttd')->nullable();
            $table->timestamp('tanggal_tandatangan')->nullable();
            // Tambahkan kolom tanggal_tandatangan

            // Tambahkan foreign key atau atribut lainnya sesuai kebutuhan

            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('form_penawaran_harga');
    }
};
