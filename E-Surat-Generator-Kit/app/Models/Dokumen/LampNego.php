<?php

namespace App\Models\Dokumen;

use App\Models\PembuatanSuratKontrak;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampNego extends Model
{
    use HasFactory;
     protected $fillable = [
        'id_surat',
        'datalampnego',
        'total_jumlah',
        'dibulatkan',
        'ppn11',
        'total_harga',
    ];

    protected $casts = [
        'datalampnego' => 'json',
        'total_jumlah' => 'integer',
        'dibulatkan' => 'integer',
        'ppn11' => 'integer',
        'total_harga' => 'integer',
    ];

    public function pembuatansuratkontrak()
    {
        return $this->belongsTo(PembuatanSuratKontrak::class, 'id_surat');
    }
}
