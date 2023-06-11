<?php

namespace App\Models;

use App\Models\Dokumen\LampNego;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PembuatanSuratKontrak extends Model
{
    use HasFactory;
    protected $fillable = [
        'id_kontrakkerja', 'nama_surat', 'no_surat', 'tanggal_pembuatan'
    ];
    public function kontrakkerja()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrakkerja', 'id_kontrakkerja');
    }
    public function lampnego()
    {
        return $this->hasOne(LampNego::class, 'id_surat');
    }
}
