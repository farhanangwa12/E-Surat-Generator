<?php

namespace App\Models\DokumenVendor;

use App\Models\KelengkapanDokumenVendor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lampiranpenawaranharga extends Model
{
    use HasFactory;

    protected $table = 'lampiranpenawaranhargas';

    protected $fillable = [
        'id_dokumen',
        'kopsurat',
        'kopsuratpath',
        'total_jumlah',
        'dibulatkan',
        'ppn11',
        'total_harga',
        'datalampiran',
        'kota_surat',
        'tanggal_surat',
        'nama_perusahaan',
        'direktur',
    ];


    protected $casts = [
        'datalampiran' => 'json',
    ];

    public function dokumen()
    {
        return $this->belongsTo(KelengkapanDokumenVendor::class, 'id_dokumen');
    }
}
