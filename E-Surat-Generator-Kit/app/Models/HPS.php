<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HPS extends Model
{
    protected $table = 'h_p_s';

    protected $fillable = [
        'id_kontrakkerja',
        'total_jumlah',
        'dibulatkan',
        'rok10',
        'ppn11',
        'total_harga',
        'tandatangan_pengadaan',
        'tanggal_tandatangan_pengadaan',
        'tandatangan_manager',
        'tanggal_tandatangan_manager',
    ];

    public function kontrakKerjas()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    use HasFactory;
}
