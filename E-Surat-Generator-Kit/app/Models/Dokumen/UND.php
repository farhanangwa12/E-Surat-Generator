<?php

namespace App\Models\Dokumen;

use App\Models\KontrakKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UND extends Model
{
    protected $fillable = [
        'id_kontrakkerja', 'tandatangan_pengadaan','tanggal_tandatanganpengadaan'
    ];
    public function kontrakKerjas()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja');
    }
    
    use HasFactory;
}
