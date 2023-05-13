<?php

namespace App\Models\SubKontrak;

use App\Models\KontrakKerja;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisKontrak extends Model
{
    use HasFactory;


    protected $table = 'jenis_kontrak';

    protected $fillable = [
        'id_kontrak', 'nama_jenis'
    ];

    public function kontrak_kerja()
    {
        return $this->belongsTo(KontrakKerja::class, 'id_kontrak');
    }

    public function barJas()
    {
        return $this->hasMany(BarJas::class, 'id_jenis_kontrak');
    }
}
