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
        Schema::table('kelengkapan_dokumen_vendors', function (Blueprint $table) {
          
            $table->foreign('id_jenis_dokumen')->references('id_jenis')->on('jenis_dokumen_kelengkapans');

            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kelengkapan_dokumen_vendors', function (Blueprint $table) {
            $table->dropForeign(['id_jenis_dokumen']);
      
        });
    }
};
